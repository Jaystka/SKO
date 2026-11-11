<?php

namespace App\Services;

use App\Models\Cart;
use App\Models\Customer;
use App\Models\Product;
use App\Models\Stocks;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

/**
 * Logika keranjang. Menggantikan stored procedure MySQL `cart_insert` agar
 * perilaku konsisten di semua database dan bisa diuji.
 */
class CartService
{
    /** Item keranjang aktif (belum dipesan) milik customer. */
    public function activeItems(Customer $customer): Collection
    {
        return Cart::query()
            ->with(['product.brand', 'product.stocks'])
            ->where('customer_id', $customer->customer_id)
            ->where('status', '!=', Cart::STATUS_ORDERED)
            ->whereHas('product')
            ->latest()
            ->get();
    }

    public function add(Customer $customer, Product $product, string $size, int $quantity = 1): Cart
    {
        return DB::transaction(function () use ($customer, $product, $size, $quantity) {
            $cart = Cart::query()
                ->where('customer_id', $customer->customer_id)
                ->where('product_id', $product->product_id)
                ->where('size', $size)
                ->where('status', '!=', Cart::STATUS_ORDERED)
                ->lockForUpdate()
                ->first();

            $newQuantity = ($cart?->quantity ?? 0) + $quantity;
            $this->assertStockAvailable($product, $size, $newQuantity);

            if ($cart) {
                $cart->fill([
                    'quantity' => $newQuantity,
                    'cart_price' => $product->price * $newQuantity,
                    'status' => Cart::STATUS_SELECTED,
                ])->save();

                return $cart;
            }

            return Cart::create([
                'customer_id' => $customer->customer_id,
                'product_id' => $product->product_id,
                'size' => $size,
                'quantity' => $newQuantity,
                'cart_price' => $product->price * $newQuantity,
                'status' => Cart::STATUS_SELECTED,
            ]);
        });
    }

    public function updateQuantity(Cart $cart, int $quantity): Cart
    {
        $product = $cart->product()->firstOrFail();
        $this->assertStockAvailable($product, $cart->size, $quantity);

        $cart->fill([
            'quantity' => $quantity,
            'cart_price' => $product->price * $quantity,
        ])->save();

        return $cart;
    }

    /**
     * Menyimpan pilihan item yang akan di-checkout.
     *
     * @param  array<int, array{cart_id: string, status: bool|int|string}>  $options
     */
    public function setSelection(Customer $customer, array $options): void
    {
        DB::transaction(function () use ($customer, $options) {
            foreach ($options as $option) {
                Cart::query()
                    ->where('customer_id', $customer->customer_id)
                    ->where('cart_id', $option['cart_id'])
                    ->where('status', '!=', Cart::STATUS_ORDERED)
                    ->update([
                        'status' => filter_var($option['status'], FILTER_VALIDATE_BOOL)
                            ? Cart::STATUS_SELECTED
                            : Cart::STATUS_UNSELECTED,
                    ]);
            }
        });
    }

    public function availableStock(Product $product, string $size): int
    {
        return (int) Stocks::query()
            ->where('product_id', $product->product_id)
            ->where('size', $size)
            ->value('total_stock');
    }

    private function assertStockAvailable(Product $product, string $size, int $quantity): void
    {
        $available = $this->availableStock($product, $size);

        if ($available <= 0) {
            throw ValidationException::withMessages([
                'size' => "Ukuran {$size} sedang habis.",
            ]);
        }

        if ($quantity > $available) {
            throw ValidationException::withMessages([
                'quantity' => "Stok ukuran {$size} hanya tersisa {$available}.",
            ]);
        }

        if ($quantity > Cart::MAX_QUANTITY) {
            throw ValidationException::withMessages([
                'quantity' => 'Jumlah maksimal per item adalah '.Cart::MAX_QUANTITY.'.',
            ]);
        }
    }
}
