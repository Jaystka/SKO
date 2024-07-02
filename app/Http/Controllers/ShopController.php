<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ShopController extends Controller
{
    function shopView()
    {
        $category1 = Product::where('brand_id', 'B0001')
            ->orderBy('created_at', 'DESC')
            ->paginate(7);

        return view('shop.shop', compact('category1'));
    }
}
