<?php

namespace App\Http\Controllers;

use App\Models\Product;

class ProductController extends Controller
{
    public function show(string $slug)
    {
        $product = Product::query()
            ->with(['stocks', 'brand', 'category', 'material'])
            ->where('slug', $slug)
            ->firstOrFail();

        $stockBySize = $product->stocks->pluck('total_stock', 'size')->map(fn ($v) => (int) $v);

        return view('product.product', compact('product', 'stockBySize'));
    }
}
