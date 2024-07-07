<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Post;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;


class CartController extends Controller
{
    public function index()
    {
        $customer_id = Auth::id(); // Mengambil ID pengguna yang sedang terautentikasi

        $carts = Cart::where('customer_id', $customer_id)
            ->join('products', 'carts.product_id', '=', 'products.product_id')
            ->join('brand', 'brand.brand_id', '=', 'products.brand_id')
            ->select('carts.*', 'products.*', 'brand.*')
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

        $request->validate([
            'customer_id' => 'required|string|max:255',
            'quantity' => 'required|int',
            'product_id' => 'required|string|max:255',
            'size' => 'required|string|max:255',
        ]);

        $check = Cart::count();
        if ($check == 0) {
            $id = 'CA001';
        } else {
            $getId = Cart::all()->last();
            $number = (int)substr($getId->cart_id, -3);
            $new_id = str_pad($number + 1, 3, "0", STR_PAD_LEFT);
            $id = 'CA' . $new_id;
        };
        $customer_id = $request->customer_id;
        $quantity = $request->quantity;
        $product_id = $request->product_id;
        $size = $request->size;
        Post::spInsertCart($id, $customer_id, $quantity, $product_id, $size);

        // Alert::success('Berhasil ditambahkan')->background('#F2F2F0')->showConfirmButton('Ok', '#0b8a0b')->autoClose(3000);
        return redirect()->route('cart.index');
    }

    public function update(Request $request, $cart_id)
    {
        $cart = Cart::findOrFail($cart_id);

        $cart->update([
            'quantity' => $request->quantity,
            'cart_price' => DB::raw('quantity * (SELECT price FROM products WHERE product_id = carts.product_id)')
        ]);
        return response()->json(['success' => 'Cart updated successfully.']);
    }
}
