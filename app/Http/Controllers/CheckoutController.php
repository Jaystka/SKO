<?php

namespace App\Http\Controllers;

use App\Enums\Status;
use App\Models\Cart;
use App\Models\Customer;
use App\Models\Expedition;
use App\Models\Payment;
use App\Models\Transaction;
use App\Services\Midtrans\CallbackService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class CheckoutController extends Controller
{
    public function index()
    {
        $customer_id = Auth::id();

        $carts = Cart::where('customer_id', $customer_id)
            ->whereAll(['status'], '=', '1')
            ->join('products', 'carts.product_id', '=', 'products.product_id')
            ->join('brands', 'brands.brand_id', '=', 'products.brand_id')
            ->join('tax', 'products.tax_id', '=', 'tax.tax_id')
            ->select('carts.*', 'products.*', 'brands.*', 'tax.tax')
            ->orderBy('carts.created_at', 'desc')
            ->get();

        if ($carts->count() > 0) {
            $customer = Customer::where('customer_id', $customer_id)
                ->select('name', 'phone', 'address')
                ->get();

            $expeditions = Expedition::get();

            $midtransClientKey = config('midtrans.clientKey');

            return view('cart/checkout', compact('carts', 'customer', 'midtransClientKey', 'expeditions'));
        } else {

            $carts = Cart::where('customer_id', $customer_id)
                ->join('products', 'carts.product_id', '=', 'products.product_id')
                ->join('brands', 'brands.brand_id', '=', 'products.brands_id')
                ->select('carts.*', 'products.*', 'brands.*')
                ->orderBy('carts.created_at', 'desc')
                ->get();
            return view('cart.cart', compact('carts'));
        }
    }

    public function checkoutProduct(Request $request)
    {
        $request->validate([
            'options' => 'array',
            'options.*.cart_id' => 'required|string|exists:carts,cart_id', // Ganti your_table_name dengan nama tabel Anda
            'options.*.status' => 'required|boolean',
            // 'options.*.status' => ['required', Rule::in(Status::getValues())],
        ]);

        $options = $request->input('options', []);

        foreach ($options as $option) {
            DB::table('carts')
                ->where('cart_id', $option['cart_id'])
                ->update(['status' => $option['status']]);
        }

        return response()->json(['success' => 'Options updated successfully']);
    }

    public function process(Request $request)
    {
        $customer_id = Auth::id();
        // Mengambil semua item dari cart dengan status 1 untuk customer saat ini
        $cartItems = Cart::where('customer_id', $customer_id)
            ->join('products', 'carts.product_id', '=', 'products.product_id')
            ->join('brands', 'brands.brand_id', '=', 'products.brand_id')
            ->select('carts.*', 'products.*', 'brands.*')
            ->whereAll(['status'], '=', '1')
            ->orderBy('carts.created_at', 'desc')
            ->get();

        // Mengambil semua cart_id dari cartItems
        $cartIds = $cartItems->pluck('cart_id')->toArray();

        // Melakukan pengecekan di tabel Payment untuk cart_id yang ada di cartItems
        $existingPayments = Payment::whereIn('cart_id', $cartIds)->pluck('cart_id')->count();

        $customer = Customer::findOrFail($customer_id);

        if ($existingPayments < 1) {
            $grossAmount = $cartItems->sum('cart_price');
            // Set your Merchant Server Key
            \Midtrans\Config::$serverKey = config('midtrans.serverKey');
            // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
            \Midtrans\Config::$isProduction = false;
            // Set sanitization on (default)
            \Midtrans\Config::$isSanitized = true;
            // Set 3DS transaction for credit card to true
            \Midtrans\Config::$is3ds = true;

            // Menyiapkan items_details array
            $itemsDetails = $cartItems->map(function ($cartItem) {
                return [
                    'id' => $cartItem->cart_id,
                    'price' => $cartItem->price,
                    'quantity' => $cartItem->quantity,
                    'name' => $cartItem->series . " Size " . $cartItem->size,
                    'brand' => $cartItem->brand,
                    "merchant_name" => "SKO",
                ];
            })->toArray();

            $customer_details = [
                "customer_details" => [
                    "first_name" => $customer->name,
                    "email" => $customer->email,
                    "phone" => $customer->phone,
                ]
            ];

            $transaction_id = rand();

            $params = [
                'transaction_details' => [
                    'order_id' => $transaction_id,
                    'gross_amount' => $grossAmount,
                ],
                'item_details' => $itemsDetails,
                "customer_details" =>  $customer_details,

            ];

            $transaction = Transaction::create([
                'transaction_id' => $transaction_id,
                'customer_id' => $customer_id,
                'address' => $request->address,
                'expedition' => $request->expedition,
            ]);
            $snapToken = \Midtrans\Snap::getSnapToken($params);

            $transaction->snap_token = $snapToken;
            $transaction->save();

            try {
                // Mulai transaksi
                DB::beginTransaction();

                // Loop melalui semua item di cart dan tambahkan ke payment
                foreach ($cartItems as $cartItem) {
                    $countCart = Payment::where('cart_id', $cartItem->cart_id)
                        ->get();
                    $lastPayment = Payment::latest('payment_id')->first();

                    if ($countCart->count() < 1) {
                        if ($lastPayment === null) {
                            $id = 'PY001';
                        } else {
                            $number = (int)substr($lastPayment->payment_id, 2);
                            $new_id = str_pad($number + 1, 3, "0", STR_PAD_LEFT);
                            $id = 'PY' . $new_id;
                        }
                        Payment::create([
                            'payment_id' => $id,
                            'transaction_id' => $transaction_id,
                            'customer_id' => $customer_id,
                            'cart_id' => $cartItem->cart_id,
                            'product_id' => $cartItem->product_id,
                            'total_price' => $cartItem->cart_price,  // Asumsi Anda memiliki kolom 'price' di tabel 'carts'
                            'qty' => $cartItem->quantity,
                            'status' => 'pending',
                        ]);

                        Cart::where('cart_id', $cartItem->cart_id)
                            ->whereAll(['status'], '=', '1')
                            ->delete();
                    }
                }

                DB::commit();
            } catch (\Exception $e) {
                DB::rollBack();
                return response()->json(['error' => 'Something went wrong!'], 500);
            }
        } else {
            $snapToken = Payment::whereIn('cart_id', $cartIds)
                ->join('transactions', 'payments.transaction_id', '=', 'transactions.transaction_id')
                ->select('transactions.snap_token as token')
                ->firstOrFail();

            return $snapToken->toArray();
        }

        return response()->json(['token' => $snapToken]);
        // return redirect()->route('checkout', $payment->id);
        //return view('checkout',  compact('transaction'));
    }

    // public function pay(Transaction $transaction)
    // {

    //     return view('checkout',  compact('transaction'));
    // }

    public function receive()
    {
        $callback = new CallbackService;

        if ($callback->isSignatureKeyVerified()) {
            $notification = $callback->getNotification();
            $Transaction = $callback->getTransaction();

            if ($callback->isSuccess()) {
                Transaction::where('transaction_id ', $Transaction->id)->update([
                    'payment_status' => 2,
                ]);
            }

            if ($callback->isExpire()) {
                Transaction::where('transaction_id ', $Transaction->id)->update([
                    'payment_status' => 3,
                ]);
            }

            if ($callback->isCancelled()) {
                Transaction::where('transaction_id ', $Transaction->id)->update([
                    'payment_status' => 4,
                ]);
            }

            return response()
                ->json([
                    'success' => true,
                    'message' => 'Notification successfully processed',
                ]);
        } else {
            return response()
                ->json([
                    'error' => true,
                    'message' => 'Signature key not verified',
                ], 403);
        }
    }

    public function checkStatus(Request $request)
    {
        \Midtrans\Config::$serverKey = config('midtrans.serverKey');
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = false;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;

        $transactionId = $request->input('order_id');

        $status = \Midtrans\Transaction::status($transactionId);

        // Mengambil status transaksi dari response Midtrans
        $transactionStatus = $status->transaction_status;
        $paymentMethod = $status->payment_type;

        var_dump($paymentMethod);
        Transaction::where('transaction_id', $transactionId)->update([
            'status' => $transactionStatus,
            'payment_method' => $paymentMethod,
            'total_payment' => $status->gross_amount,
        ]);


        return response()->json([
            'status' => $status->transaction_status, // 'success', 'pending', 'failed', etc.
        ]);
    }
}
