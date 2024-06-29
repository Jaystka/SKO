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
        if (!$customer_id) {
            // Jika tidak ada pengguna yang terautentikasi, lakukan tindakan yang sesuai, misalnya lempar pengecualian atau redirect
            abort(403, 'Unauthorized action.');
        }

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
}
