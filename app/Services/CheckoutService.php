<?php

namespace App\Services;

use App\Models\Cart;
use App\Models\Customer;
use App\Models\Payment;
use App\Models\Transaction;
use App\Services\Payment\PaymentGateway;
use App\Support\IdGenerator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class CheckoutService
{
    public function __construct(
        private readonly PaymentGateway $gateway,
        private readonly CartService $carts,
    ) {
    }

    /** Item keranjang yang dipilih untuk checkout. */
    public function selectedItems(Customer $customer, bool $lock = false): Collection
    {
        $query = Cart::query()
            ->with(['product.brand', 'product.taxRate'])
            ->where('customer_id', $customer->customer_id)
            ->where('status', Cart::STATUS_SELECTED)
            ->whereHas('product')
            ->latest();

        if ($lock) {
            $query->lockForUpdate();
        }

        return $query->get();
    }

    /**
     * Ringkasan harga dihitung ulang dari harga produk terkini, tidak
     * mempercayai nilai cart_price yang tersimpan.
     *
     * @return array{subtotal: int, tax: int, total: int}
     */
    public function summary(Collection $items): array
    {
        $subtotal = (int) $items->sum(fn (Cart $item) => $item->product->price * $item->quantity);
        $tax = (int) $items->sum(fn (Cart $item) => (int) ($item->product->taxRate?->tax ?? 0));

        return [
            'subtotal' => $subtotal,
            'tax' => $tax,
            'total' => $subtotal + $tax,
        ];
    }

    /**
     * Membuat transaksi + detail pembayaran lalu meminta Snap token ke Midtrans.
     * Seluruh proses atomik: bila Midtrans gagal, tidak ada data yang tersimpan.
     *
     * @param  array{name: string, phone: string, address: string, expedition: string}  $shipping
     */
    public function placeOrder(Customer $customer, array $shipping): Transaction
    {
        $lock = Cache::lock('checkout:'.$customer->customer_id, 30);

        if (! $lock->get()) {
            throw ValidationException::withMessages([
                'checkout' => 'Pesanan sedang diproses, mohon tunggu sebentar.',
            ]);
        }

        try {
            return DB::transaction(function () use ($customer, $shipping) {
                $items = $this->selectedItems($customer, lock: true);

                if ($items->isEmpty()) {
                    throw ValidationException::withMessages([
                        'checkout' => 'Pilih minimal satu produk di keranjang.',
                    ]);
                }

                foreach ($items as $item) {
                    $available = $this->carts->availableStock($item->product, $item->size);
                    if ($item->quantity > $available) {
                        throw ValidationException::withMessages([
                            'checkout' => "Stok {$item->product->series} ukuran {$item->size} tidak mencukupi (tersisa {$available}).",
                        ]);
                    }
                }

                $summary = $this->summary($items);
                $orderId = 'SKO-'.now()->format('ymdHis').'-'.Str::upper(Str::random(6));

                $transaction = Transaction::create([
                    'transaction_id' => $orderId,
                    'customer_id' => $customer->customer_id,
                    'recipient_name' => $shipping['name'],
                    'recipient_phone' => $shipping['phone'],
                    'address' => $shipping['address'],
                    'expedition' => $shipping['expedition'],
                    'status' => 'pending',
                    'total_payment' => $summary['total'],
                ]);

                foreach ($items as $item) {
                    Payment::create([
                        'payment_id' => IdGenerator::next('payments', 'payment_id', 'PY', 3),
                        'transaction_id' => $orderId,
                        'customer_id' => $customer->customer_id,
                        'cart_id' => $item->cart_id,
                        'product_id' => $item->product_id,
                        'size' => $item->size,
                        'qty' => $item->quantity,
                        'total_price' => $item->product->price * $item->quantity,
                        'status' => 'pending',
                    ]);
                }

                $transaction->snap_token = $this->gateway->createSnapToken(
                    $this->snapParams($transaction, $customer, $items, $summary)
                );
                $transaction->save();

                Cart::query()->whereIn('cart_id', $items->pluck('cart_id'))->delete();

                return $transaction;
            });
        } finally {
            $lock->release();
        }
    }

    /**
     * @return array<string, mixed>
     */
    private function snapParams(Transaction $transaction, Customer $customer, Collection $items, array $summary): array
    {
        $details = $items->map(fn (Cart $item) => [
            'id' => Str::limit($item->product_id.'-'.$item->size, 50, ''),
            'price' => $item->product->price,
            'quantity' => $item->quantity,
            'name' => Str::limit($item->product->series.' Size '.$item->size, 50, ''),
            'brand' => $item->product->brand?->brand,
            'merchant_name' => config('app.name', 'SKO'),
        ])->values()->all();

        if ($summary['tax'] > 0) {
            $details[] = [
                'id' => 'TAX',
                'price' => $summary['tax'],
                'quantity' => 1,
                'name' => 'Pajak',
            ];
        }

        return [
            'transaction_details' => [
                'order_id' => $transaction->transaction_id,
                'gross_amount' => $summary['total'],
            ],
            'item_details' => $details,
            'customer_details' => [
                'first_name' => $transaction->recipient_name,
                'email' => $customer->email,
                'phone' => $transaction->recipient_phone,
                'shipping_address' => [
                    'first_name' => $transaction->recipient_name,
                    'phone' => $transaction->recipient_phone,
                    'address' => Str::limit((string) $transaction->address, 200, ''),
                ],
            ],
        ];
    }
}
