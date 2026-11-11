<?php

namespace App\Http\Controllers;

use App\Http\Requests\Admin\ProductRequest;
use App\Models\Brands;
use App\Models\Cart;
use App\Models\Categories;
use App\Models\Materials;
use App\Models\Product;
use App\Models\Stocks;
use App\Support\IdGenerator;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class ProductAdminController extends Controller
{
    private const IMAGE_DIR = 'dist/img/products';

    public function productsView()
    {
        $products = Product::query()
            ->with(['brand', 'stocks' => fn ($q) => $q->orderBy('size')])
            ->latest()
            ->paginate(20);

        return view('admin.products.products', compact('products'));
    }

    public function addproductsView()
    {
        return view('admin.products.addproducts', $this->formOptions());
    }

    public function addProduct(ProductRequest $request)
    {
        $imagePath = $this->storeImage($request->file('image'));

        try {
            DB::transaction(function () use ($request, $imagePath) {
                $product = Product::create([
                    'product_id' => IdGenerator::next('products', 'product_id', 'P'),
                    ...$request->safe()->only(['brand_id', 'category_id', 'material_id', 'series', 'price', 'description']),
                    'slug' => $this->uniqueSlug($request->validated('series')),
                    'image' => $imagePath,
                ]);

                $this->syncStocks($product, $request->sizes());
            });
        } catch (\Throwable $e) {
            $this->deleteImage($imagePath);
            throw $e;
        }

        return redirect()->route('products')->with('success', 'Produk berhasil ditambahkan.');
    }

    public function editProductView(string $slug)
    {
        $product = Product::query()->where('slug', $slug)->firstOrFail();
        $stocks = $product->stocks()->get();

        return view('admin.products.editproducts', [
            ...$this->formOptions(),
            'product' => $product,
            'stocks' => $stocks,
        ]);
    }

    public function updateProduct(ProductRequest $request, string $slug)
    {
        $product = Product::query()->where('slug', $slug)->firstOrFail();
        $oldImage = $product->image;
        $newImage = $request->hasFile('image') ? $this->storeImage($request->file('image')) : null;

        try {
            DB::transaction(function () use ($request, $product, $newImage) {
                $product->fill($request->safe()->only(['brand_id', 'category_id', 'material_id', 'series', 'price', 'description']));

                if ($product->isDirty('series')) {
                    $product->slug = $this->uniqueSlug($product->series, $product->product_id);
                }

                if ($newImage) {
                    $product->image = $newImage;
                }

                $product->save();
                $this->syncStocks($product, $request->sizes());

                // Harga keranjang mengikuti harga terbaru.
                Cart::query()
                    ->where('product_id', $product->product_id)
                    ->where('status', '!=', Cart::STATUS_ORDERED)
                    ->get()
                    ->each(fn (Cart $cart) => $cart->update(['cart_price' => $product->price * $cart->quantity]));
            });
        } catch (\Throwable $e) {
            $this->deleteImage($newImage);
            throw $e;
        }

        if ($newImage) {
            $this->deleteImage($oldImage);
        }

        return redirect()->route('products')->with('success', 'Produk berhasil diperbarui.');
    }

    public function deleteProduct(string $product_id)
    {
        $product = Product::query()->find($product_id);

        if (! $product) {
            return redirect()->route('products')->with('error', 'Produk tidak ditemukan.');
        }

        DB::transaction(function () use ($product) {
            Cart::query()->where('product_id', $product->product_id)->delete();
            Stocks::query()->where('product_id', $product->product_id)->delete();
            $product->delete();
        });

        $this->deleteImage($product->image);

        return redirect()->route('products')->with('success', 'Produk berhasil dihapus.');
    }

    private function formOptions(): array
    {
        return [
            'brands' => Brands::query()->orderBy('brand')->get(),
            'materials' => Materials::query()->orderBy('material')->get(),
            'categories' => Categories::query()->orderBy('category')->get(),
            'sizes' => Product::SIZES,
        ];
    }

    /** @param  array<string, int>  $sizes */
    private function syncStocks(Product $product, array $sizes): void
    {
        foreach ($sizes as $size => $total) {
            $stock = Stocks::query()
                ->where('product_id', $product->product_id)
                ->where('size', $size)
                ->first();

            if ($stock) {
                $stock->update(['total_stock' => $total]);
            } else {
                Stocks::create([
                    'stock_id' => IdGenerator::next('stocks', 'stock_id', 'S'),
                    'product_id' => $product->product_id,
                    'size' => $size,
                    'total_stock' => $total,
                ]);
            }
        }
    }

    private function uniqueSlug(string $series, ?string $ignoreProductId = null): string
    {
        $base = Str::slug($series) ?: 'produk';
        $slug = $base;
        $i = 2;

        while (Product::query()
            ->where('slug', $slug)
            ->when($ignoreProductId, fn ($q) => $q->where('product_id', '!=', $ignoreProductId))
            ->exists()) {
            $slug = $base.'-'.$i++;
        }

        return $slug;
    }

    private function storeImage(UploadedFile $file): string
    {
        $directory = public_path(self::IMAGE_DIR);
        File::ensureDirectoryExists($directory);

        // Nama acak + ekstensi hasil deteksi MIME (bukan dari nama file klien).
        $filename = Str::uuid()->toString().'.'.($file->guessExtension() ?: 'jpg');
        $file->move($directory, $filename);

        return self::IMAGE_DIR.'/'.$filename;
    }

    private function deleteImage(?string $path): void
    {
        if (! $path) {
            return;
        }

        // Hanya hapus file hasil upload di folder gambar produk; aset statis lain
        // (mis. dist/img/sepatu 1.png) bisa dipakai bersama dan tidak boleh terhapus.
        $full = realpath(public_path($path));
        $allowed = realpath(public_path(self::IMAGE_DIR));

        if ($full && $allowed && str_starts_with($full, $allowed.DIRECTORY_SEPARATOR) && is_file($full)) {
            @unlink($full);
        }
    }
}
