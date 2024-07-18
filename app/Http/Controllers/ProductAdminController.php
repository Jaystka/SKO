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
use App\Models\Stocks;

class ProductAdminController extends Controller
{
    public function productsView()
    {
        $products = DB::table('products')
            ->join('brands', 'products.brand_id', '=', 'brands.brand_id')
            ->join('stocks', 'products.product_id', '=', 'stocks.product_id')
            ->select(
                'products.product_id',
                'products.image',
                'brands.brand',
                'products.series',
                'products.price',
                DB::raw('GROUP_CONCAT(stocks.size) AS available_sizes')
            )
            ->groupBy('products.product_id','products.image', 'brands.brand', 'products.series', 'products.price')
            ->get();

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
        $latestProduct = Product::orderBy(DB::raw('CAST(SUBSTRING(product_id, 2) AS UNSIGNED)'), 'desc')->first();
        if ($latestProduct) {
            $lastProductId = intval(substr($latestProduct->product_id, 1));
            $newProductId = 'P' . str_pad($lastProductId + 1, 4, '0', STR_PAD_LEFT);
        } else {
            $newProductId = 'P0001';
        }

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

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $filePath = 'dist/img/' . $filename;
            $file->move(public_path('dist/img'), $filename);
            $product->image = $filePath;
        }

        $product->save();

        foreach ($request->input('sizes', []) as $size => $totalStock) {
            if (!empty($totalStock)) {
                $latestStock = Stocks::orderBy(DB::raw('CAST(SUBSTRING(stock_id, 2) AS UNSIGNED)'), 'desc')->first();
                if ($latestStock) {
                    $lastStockId = intval(substr($latestStock->stock_id, 1));
                    $newStockId = 'S' . str_pad($lastStockId + 1, 4, '0', STR_PAD_LEFT);
                } else {
                    $newStockId = 'S0001';
                }

                $stock = new Stocks();
                $stock->stock_id = $newStockId;
                $stock->product_id = $newProductId;
                $stock->size = $size;
                $stock->total_stock = $totalStock;
                $stock->save();
            }
        }

        return redirect()->route('products')->with('success', 'Product added successfully.');
    }

    public function deleteProduct($product_id)
    {
        // Hapus stok terkait produk
        Stocks::where('product_id', $product_id)->delete();

        // Hapus produk
        Product::where('product_id', $product_id)->delete();

        return redirect()->route('products')->with('success', 'Product deleted successfully.');
    }

    public function editProductView($product_id)
{
    $product = Product::where('product_id', $product_id)->first();
    $brands = Brands::all();
    $materials = Materials::all();
    $categories = Categories::all();
    $stocks = Stocks::where('product_id', $product_id)->get();

    return view('admin.products.editproducts', compact('product', 'brands', 'materials', 'categories', 'stocks'));
}

public function updateProduct(Request $request, $product_id)
{
    $product = Product::where('product_id', $product_id)->first();

    // Update slug from series
    $slug = Str::slug($request['series'], '-');

    $product->brand_id = $request['brand_id'];
    $product->series = $request['series'];
    $product->price = $request['price'];
    $product->category_id = $request['category_id'];
    $product->description = $request['description'];
    $product->material_id = $request['material_id'];
    $product->slug = $slug;

    if ($request->hasFile('image')) {
        // Hapus gambar lama jika ada
        if ($product->image && file_exists(public_path($product->image))) {
            unlink(public_path($product->image));
        }

        // Simpan gambar baru
        $file = $request->file('image');
        $filename = time() . '.' . $file->getClientOriginalExtension();
        $filePath = 'dist/img/' . $filename;
        $file->move(public_path('dist/img'), $filename);
        $product->image = $filePath;
    }

    $product->save();

    foreach ($request->input('sizes', []) as $size => $totalStock) {
        if (!empty($totalStock)) {
            $stock = Stocks::where('product_id', $product_id)->where('size', $size)->first();
            if ($stock) {
                $stock->total_stock = $totalStock;
                $stock->save();
            } else {
                // Generate unique stock_id
                $latestStock = Stocks::orderBy(DB::raw('CAST(SUBSTRING(stock_id, 2) AS UNSIGNED)'), 'desc')->first();
                if ($latestStock) {
                    $lastStockId = intval(substr($latestStock->stock_id, 1));
                    $newStockId = 'S' . str_pad($lastStockId + 1, 4, '0', STR_PAD_LEFT);
                } else {
                    $newStockId = 'S0001';
                }

                $stock = new Stocks();
                $stock->stock_id = $newStockId;
                $stock->product_id = $product_id;
                $stock->size = $size;
                $stock->total_stock = $totalStock;
                $stock->save();
            }
        }
    }

    return redirect()->route('products')->with('success', 'Product updated successfully.');
}


}
