<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Cart;
use App\Models\Stock;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function show($slug)
    {
        // Mencari produk berdasarkan slug di database
        $product = Product::with('stock')
            ->join('category', 'products.category_id', '=', 'category.category_id')
            ->join('material', 'products.material_id', '=', 'material.material_id')
            ->select('products.*', 'category.category', 'category.category_desc', 'material.material', 'material.material_desc')
            ->where('slug', $slug)->firstOrFail();

        return view('product.product', compact('product'));
    }

    public function store(Request $request)
    {
        $check = Product::count();
        if ($check == 0) {
            $id = 'PR001';
        } else {
            $getId = Product::all()->last();
            $number = (int)substr($getId->id_produk, -3);
            $new_id = str_pad($number + 1, 3, "0", STR_PAD_LEFT);
            $id = 'PR' . $new_id;
        };
        Product::create(['id_produk' => $id] + $request->all());
        return redirect()->route('cart.cart');
    }
}
