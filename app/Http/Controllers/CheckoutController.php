<?php

namespace App\Http\Controllers;

use App\Enums\Status;
use App\Models\Customer;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class CheckoutController extends Controller
{
    public function index()
    {

        return view('cart/checkout');
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
        $data = $request->all();

        // Diubah ke database
        $payment = Payment::create([
            'customer_id' => Auth::user()->customer_id,
            'product_id' => $data['product_id'],
            'price' => $data['price'],
            'status' => 'pending',
        ]);

        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = config('midtrans.serverKey');
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = false;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;

        // Populate customer's shipping address
        $shipping_address = array(
            'first_name'   => "John",
            'last_name'    => "Watson",
            'address'      => "Bakerstreet 221B.",
            'city'         => "Jakarta",
            'postal_code'  => "51162",
            'phone'        => "081322311801",
            'country_code' => 'IDN'
        );

        // Populate customer's info
        $customer_details = array(
            'first_name'       => "Andri",
            'last_name'        => "Setiawan",
            'email'            => "test@test.com",
            'phone'            => "081322311801",
            'shipping_address' => $shipping_address
        );

        $params = array(
            'transaction_details' => array(
                'order_id' => rand(),
                'gross_amount' => $data['price'],
            ),
            // 'items_details' 
            'customer_detail' => $customer_details
        );

        $snapToken = \Midtrans\Snap::getSnapToken($params);

        $payment->snap_token = $snapToken;
        $payment->save();

        return redirect()->route('checkout', $payment->id);
    }

    public function checkout(Payment $payment)
    {
        $products = config('products');
        $product = collect($products)->firstWhere('product_id', $payment->product_id);

        return view('checkout',  compact('payment', 'product'));
    }
}
