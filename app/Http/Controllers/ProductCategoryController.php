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

            if ($products->isNotEmpty()) {
                $brand = $products->first()->brand; // Mengambil brand dari produk pertama jika ada produk
            } else {
                $brand = 'Tidak ada produk yang ditemukan';
            }
        } else {
            $products = Product::orderBy('created_at', 'DESC')
                ->join('brands', 'products.brand_id', '=', 'brands.brand_id')
                ->select('brands.*', 'products.*')
                ->get();

            if ($products->isNotEmpty()) {
                $brand = $products->first()->brand; // Mengambil brand dari produk pertama jika ada produk
            } else {
                $brand = 'Tidak ada produk yang ditemukan';
            }
        }

        return view('shop.productcategory', compact('products', 'brand'));
    }
}
