<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
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
}
