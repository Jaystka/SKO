<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Post;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Carbon\Carbon;


class CartController extends Controller
{
    public function generateUniqueId()
    {
        return date('YmdHis') . Str::random(6); // Kombinasi tanggal dan random string
    }

    public function index()
    {
        $customer_id = Auth::id(); // Mengambil ID pengguna yang sedang terautentikasi

        $carts = Cart::where('customer_id', $customer_id)
            ->join('products', 'carts.product_id', '=', 'products.product_id')
            ->join('brand', 'brand.brand_id', '=', 'products.brand_id')
            ->select('carts.*', 'products.*', 'brand.*')
            ->orderBy('carts.created_at', 'desc')
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

        $cartId = $this->generateUniqueId();

        $customer_id = $request->customer_id;
        $quantity = $request->quantity;
        $product_id = $request->product_id;
        $size = $request->size;
        Post::spInsertCart($cartId, $customer_id, $quantity, $product_id, $size);

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

    function itemsView()
    {
        $customer_id = Auth::id(); // Mengambil ID pengguna yang sedang terautentikasi

        $carts = Cart::where('customer_id', $customer_id)
            ->whereRaw("status NOT IN ('2')")
            ->join('products', 'carts.product_id', '=', 'products.product_id')
            ->join('brand', 'brand.brand_id', '=', 'products.brand_id')
            ->select('carts.*', 'products.*', 'brand.*')
            ->orderBy('carts.created_at', 'desc')
            ->get();
        return view('cart.items', compact('carts'));
    }
}
