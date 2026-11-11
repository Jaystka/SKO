<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Product;
use App\Support\IdGenerator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryAdminController extends Controller
{
    public function categoriesadminView()
    {
        $categories = Categories::query()->withCount('products')->orderBy('category')->get();

        return view('admin/category/categories', compact('categories'));
    }

    public function addcategories()
    {
        return view('admin/category/addcategories');
    }

    public function addCategory(Request $request)
    {
        $data = $this->validated($request);

        DB::transaction(fn () => Categories::create([
            'category_id' => IdGenerator::next('categories', 'category_id', 'C'),
            ...$data,
        ]));

        return redirect()->route('category')->with('success', 'Kategori berhasil ditambahkan.');
    }

    public function editCategory(string $id)
    {
        $category = Categories::findOrFail($id);

        return view('admin/category/editcategories', compact('category'));
    }

    public function updateCategory(Request $request, string $id)
    {
        Categories::findOrFail($id)->update($this->validated($request));

        return redirect()->route('category')->with('success', 'Kategori berhasil diperbarui.');
    }

    public function deleteCategory(string $id)
    {
        $category = Categories::findOrFail($id);

        if (Product::query()->where('category_id', $category->category_id)->exists()) {
            return redirect()->route('category')
                ->with('error', 'Kategori masih dipakai oleh produk, pindahkan produknya terlebih dahulu.');
        }

        $category->delete();

        return redirect()->route('category')->with('success', 'Kategori berhasil dihapus.');
    }

    private function validated(Request $request): array
    {
        return $request->validate([
            'category' => ['required', 'string', 'max:255'],
            'category_desc' => ['required', 'string', 'max:1000'],
        ]);
    }
}
