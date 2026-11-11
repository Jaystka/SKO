<?php

namespace App\Http\Controllers;

use App\Models\Expedition;
use App\Models\Transaction;
use App\Services\CartService;
use App\Services\CheckoutService;
use App\Services\Payment\PaymentGateway;
use App\Services\Payment\PaymentGatewayException;
use App\Services\PaymentStatusService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;

class CheckoutController extends Controller
{
    public function __construct(
        private readonly CheckoutService $checkout,
        private readonly CartService $carts,
    ) {
    }

    public function index(Request $request)
    {
        $customer = $request->user();
        $carts = $this->checkout->selectedItems($customer);

        if ($carts->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Pilih minimal satu produk untuk checkout.');
        }

        return view('cart.checkout', [
            'carts' => $carts,
            'customer' => $customer,
            'summary' => $this->checkout->summary($carts),
            'expeditions' => Expedition::query()->orderBy('expedition')->get(),
            'midtransClientKey' => config('midtrans.clientKey'),
            'midtransSnapUrl' => config('midtrans.snapUrl'),
        ]);
    }

    /** Menyimpan item yang dicentang di halaman keranjang. */
    public function checkoutProduct(Request $request): JsonResponse
    {
        $data = $request->validate([
            'options' => ['present', 'array', 'max:200'],
            'options.*.cart_id' => ['required', 'string'],
            'options.*.status' => ['required', 'boolean'],
        ]);

        $this->carts->setSelection($request->user(), $data['options']);

        return response()->json(['success' => true]);
    }

    public function process(Request $request): JsonResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:20', 'regex:/^[0-9+\-\s()]{8,20}$/'],
            'address' => ['required', 'string', 'max:1500'],
            'expedition' => ['required', 'string', Rule::exists('expeditions', 'expedition')],
        ], [
            'phone.regex' => 'Format nomor HP tidak valid.',
            'expedition.required' => 'Pilih kurir pengiriman.',
            'expedition.exists' => 'Kurir pengiriman tidak valid.',
        ]);

        try {
            $transaction = $this->checkout->placeOrder($request->user(), $data);
        } catch (PaymentGatewayException $e) {
            Log::error('Checkout gagal membuat Snap token', [
                'customer_id' => $request->user()->customer_id,
                'error' => $e->getMessage(),
            ]);

            return response()->json([
                'message' => 'Layanan pembayaran sedang bermasalah. Silakan coba beberapa saat lagi.',
            ], 502);
        }

        return response()->json([
            'token' => $transaction->snap_token,
            'order_id' => $transaction->transaction_id,
        ]);
    }

    /** Sinkronisasi status dari Midtrans setelah popup Snap ditutup. */
    public function checkStatus(Request $request, PaymentGateway $gateway, PaymentStatusService $statuses): JsonResponse
    {
        $data = $request->validate([
            'order_id' => ['required', 'string', 'max:64'],
        ]);

        $transaction = Transaction::query()
            ->where('transaction_id', $data['order_id'])
            ->where('customer_id', $request->user()->customer_id)
            ->firstOrFail();

        try {
            $status = $gateway->status($transaction->transaction_id);
        } catch (PaymentGatewayException $e) {
            Log::warning('Gagal cek status Midtrans', ['order_id' => $transaction->transaction_id, 'error' => $e->getMessage()]);

            return response()->json(['status' => $transaction->status], 202);
        }

        $transaction = $statuses->apply(
            $transaction->transaction_id,
            $status['transaction_status'],
            $status['payment_type'],
            $status['fraud_status'],
        );

        return response()->json([
            'status' => $transaction->status,
            'paid' => $transaction->isPaid(),
        ]);
    }
}
