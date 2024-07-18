<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\Brands;
use App\Models\Materials;
use App\Models\Categories;

class ProductAdminController extends Controller
{
    public function productsView()
    {

        // $products = Product::join('brand', 'products.brand_id', '=', 'brand.brand_id')
        //     ->join('material', 'products.material_id', '=', 'material.material_id')
        //     ->select('products.*', 'brand.brand', 'material.material', 'material.material_desc')
        //     ->get();
        
        // return view('admin.products.products', compact('products'));

        $products = DB::table('products')
            ->join('brands', 'products.brand_id', '=', 'brands.brand_id')
            ->join('stock', 'products.product_id', '=', 'stock.product_id')
            ->select(
                'products.image',
                'brands.brand',
                'products.series',
                'products.price',
                DB::raw('GROUP_CONCAT(stock.size) AS available_sizes')
            )
            ->groupBy('products.image', 'brands.brand', 'products.series', 'products.price')
            ->get();

        // Mengembalikan data ke view atau JSON response
        return view('admin.products.products', compact('products'));
    }

    public function addproductsView()
    {
        $brands = Brands::all();
        $materials = Materials::all();
        $categories = Categories::all();

        return view('admin.products.addproducts', compact('brands', 'materials', 'categories'));
    }

    public function addProduct(Request $request)
    {

        // Generate unique product_id
        $latestProduct = Product::orderBy(DB::raw('CAST(SUBSTRING(product_id, 2) AS UNSIGNED)'), 'desc')->first();
        if ($latestProduct) {
            $lastProductId = intval(substr($latestProduct->product_id, 1));
            $newProductId = 'P' . str_pad($lastProductId + 1, 4, '0', STR_PAD_LEFT);
        } else {
            $newProductId = 'P0001';
        }

        // Create slug from series
        $slug = Str::slug($request['series'], '-');

        $product = new Product();
        $product->product_id = $newProductId;
        $product->brand_id = $request['brand_id'];
        $product->series = $request['series'];
        $product->price = $request['price'];
        $product->category_id = $request['category_id'];
        $product->description = $request['description'];
        $product->material_id = $request['material_id'];
        $product->slug = $slug;

        // if ($request->hasFile('images')) {
        //     $file = $request->file('images');
        //     $filename = time() . '.' . $file->getClientOriginalExtension();
        //     $file->move(public_path('images'), $filename);
        //     $product->image = $filename;
        // }
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $filePath = 'dist/img/' . $filename;
            $file->move(public_path('dist/img'), $filename);
            $product->image = $filePath;
        }

        $product->save();

        return redirect()->route('products')->with('success', 'Product added successfully.');
    }

}

