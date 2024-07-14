<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductsController extends Controller
{
    public function productsView()
    {

        $products = Product::join('brand', 'products.brand_id', '=', 'brand.brand_id')
            ->join('material', 'products.material_id', '=', 'material.material_id')
            ->select('products.*', 'brand.brand', 'material.material', 'material.material_desc')
            ->get();
        
        return view('admin.dashboard.products', compact('products'));
    }
}

