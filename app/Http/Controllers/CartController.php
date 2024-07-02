<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class CartController extends Controller
{
    function index()
    {
        $customer_id = Auth::id(); // Mengambil ID pengguna yang sedang terautentikasi

        $carts = Cart::where('customer_id', $customer_id)
            ->join('products', 'carts.product_id', '=', 'products.product_id')
            ->select('carts.*', 'products.*')
            ->get();
        return view('cart.cart', compact('carts'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $cart_id)
    {

        $rental = Cart::findOrFail($cart_id);
        $rental->delete();
        return response()->json(['success' => 'Post created successfully.']);
    }

    public function store(Request $request)
    {
        $check = Cart::count();
        if ($check == 0) {
            $id = 'CA001';
        } else {
            $getId = Cart::all()->last();
            $number = (int)substr($getId->id_produk, -3);
            $new_id = str_pad($number + 1, 4, "0", STR_PAD_LEFT);
            $id = 'C' . $new_id;
        };
        Cart::create(['cart_id' => $id] + $request->all());

        // Alert::success('Berhasil ditambahkan')->background('#F2F2F0')->showConfirmButton('Ok', '#0b8a0b')->autoClose(3000);
        return redirect()->route('cart.cart');
    }
}
