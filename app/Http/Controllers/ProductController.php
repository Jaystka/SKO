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
        $product = Product::with('stocks')
            ->join('categories', 'products.category_id', '=', 'categories.category_id')
            ->join('materials', 'products.material_id', '=', 'materials.material_id')
            ->select('products.*', 'categories.category', 'categories.category_desc', 'materials.material', 'materials.material_desc')
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
