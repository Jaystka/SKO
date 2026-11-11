<?php

namespace Database\Seeders;

use App\Models\Brands;
use App\Models\Categories;
use App\Models\Materials;
use App\Models\Product;
use App\Models\ShopDisplays;
use App\Models\Stocks;
use Illuminate\Database\Seeder;

/**
 * Produk contoh untuk development lokal.
 */
class DemoSeeder extends Seeder
{
    public function run(): void
    {
        $brands = [
            'B0001' => 'Compass',
            'B0002' => 'Ventela',
        ];
        foreach ($brands as $id => $name) {
            Brands::firstOrCreate(['brand_id' => $id], ['brand' => $name]);
        }

        Categories::firstOrCreate(['category_id' => 'C0001'], ['category' => 'Low', 'category_desc' => 'Sepatu potongan rendah']);
        Categories::firstOrCreate(['category_id' => 'C0002'], ['category' => 'High', 'category_desc' => 'Sepatu potongan tinggi']);
        Materials::firstOrCreate(['material_id' => 'M0001'], ['material' => 'Canvas', 'material_desc' => 'Kanvas tebal yang awet']);
        Materials::firstOrCreate(['material_id' => 'M0002'], ['material' => 'Suede', 'material_desc' => 'Kulit suede premium']);

        ShopDisplays::firstOrCreate(['display_id' => 'D0001'], ['brand_id' => 'B0001', 'number' => 1]);
        ShopDisplays::firstOrCreate(['display_id' => 'D0002'], ['brand_id' => 'B0002', 'number' => 2]);

        $products = [
            ['P0001', 'B0001', 'Gazelle Black Gum', 538000, 'C0001', 'M0001', 'dist/img/sepatu 1.png'],
            ['P0002', 'B0001', 'Retrograde White Blue', 538000, 'C0002', 'M0001', 'dist/img/sepatu 2.png'],
            ['P0003', 'B0002', 'Ventela Public Low', 289000, 'C0001', 'M0001', 'dist/img/ven1.png'],
            ['P0004', 'B0002', 'Ventela Back to 70s', 309000, 'C0002', 'M0002', 'dist/img/ven2.png'],
        ];

        foreach ($products as $i => [$id, $brand, $series, $price, $category, $material, $image]) {
            Product::firstOrCreate(['product_id' => $id], [
                'brand_id' => $brand,
                'category_id' => $category,
                'material_id' => $material,
                'tax_id' => 'T0000',
                'series' => $series,
                'price' => $price,
                'image' => $image,
                'description' => "{$series} — sepatu lokal dengan material berkualitas dan kenyamanan sepanjang hari.",
                'slug' => \Illuminate\Support\Str::slug($series),
                'rating' => 5,
            ]);

            foreach (['39', '40', '41', '42', '43'] as $j => $size) {
                Stocks::firstOrCreate(
                    ['product_id' => $id, 'size' => $size],
                    ['stock_id' => sprintf('S%04d', $i * 10 + $j + 1), 'total_stock' => 10]
                );
            }
        }
    }
}
