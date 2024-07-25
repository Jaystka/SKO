<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ShopDisplays;

class ShopController extends Controller
{
    function shopView()
    {
        $display1 = ShopDisplays::where('number', '1')
            ->firstOrFail();
        $categories1 = Product::where('brand_id', $display1['brand_id'])
            ->orderBy('created_at', 'DESC')
            ->paginate(7);
        $display2 = ShopDisplays::where('number', '2')
            ->firstOrFail();
        $categories2 = Product::where('brand_id', $display2['brand_id'])
            ->orderBy('created_at', 'DESC')
            ->paginate(7);

        return view('shop.shop', compact('categories1', 'categories2'));
    }
}
