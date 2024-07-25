<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductCategoryController extends Controller
{
    function ProductCategoriesView(Request $request)
    {
        if ($request->has('search')) {
            $products = Product::where('products.series', 'like', '%' . $request->search . '%')
                ->orWhere('brands.brand', 'like', '%' . $request->search . '%')
                ->join('brands', 'products.brand_id', '=', 'brands.brand_id')
                ->select('brands.*', 'products.*')
                ->paginate(10);
        } else {
            $products = Product::orderBy('created_at', 'DESC')
                ->join('brands', 'products.brand_id', '=', 'brands.brand_id')
                ->select('brands.*', 'products.*')
                ->get();
        }

        return view('shop.productcategory', compact('products'));
    }
}
