<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ShopDisplays;

class ShopController extends Controller
{
    public function shopView()
    {
        // Setiap "display" menampilkan satu brand di halaman shop (urut berdasarkan number).
        $sections = ShopDisplays::query()
            ->with('brand')
            ->orderBy('number')
            ->get()
            ->filter(fn (ShopDisplays $display) => $display->brand !== null)
            ->map(fn (ShopDisplays $display) => [
                'brand' => $display->brand->brand,
                'products' => Product::query()
                    ->where('brand_id', $display->brand_id)
                    ->latest()
                    ->limit(8)
                    ->get(),
            ])
            ->values();

        // Fallback bila display belum dikonfigurasi: tampilkan produk terbaru.
        $latest = $sections->isEmpty()
            ? Product::query()->latest()->limit(12)->get()
            : collect();

        return view('shop.shop', compact('sections', 'latest'));
    }
}
