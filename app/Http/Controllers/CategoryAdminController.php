<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryAdminController extends Controller
{
    public function categoriesadminView()
    {
        $categories = Categories::all();
        return view('admin/category/categories', compact('categories'));
    }

    public function addcategories()
    {
        return view('admin/category/addcategories');
    }

    public function addCategory(Request $request)
    {
        $request->validate([
            'category' => 'required|string|max:255',
            'category_desc' => 'required|string|max:255',
        ]);

        // Generate new category_id
        $latestCategory = Categories::orderBy(DB::raw('CAST(SUBSTRING(category_id, 2) AS UNSIGNED)'), 'desc')->first();
        if ($latestCategory) {
            $lastCategoryId = intval(substr($latestCategory->category_id, 1));
            $newCategoryId = 'C' . str_pad($lastCategoryId + 1, 4, '0', STR_PAD_LEFT);
        } else {
            $newCategoryId = 'C0001';
        }

        Categories::create([
            'category_id' => $newCategoryId,
            'category' => $request->input('category'),
            'category_desc' => $request->input('category_desc'),
        ]);

        return redirect()->route('category')->with('success', 'Category added successfully');
    }

    public function editCategory($id)
    {
        $category = Categories::findOrFail($id);
        return view('admin/category/editcategories', compact('category'));
    }

    public function updateCategory(Request $request, $id)
    {
        $request->validate([
            'category' => 'required|string|max:255',
            'category_desc' => 'required|string|max:255',
        ]);

        $category = Categories::findOrFail($id);
        $category->update([
            'category' => $request->input('category'),
            'category_desc' => $request->input('category_desc'),
        ]);

        return redirect()->route('category')->with('success', 'Category updated successfully');
    }

    public function deleteCategory($id)
    {
        $category = Categories::findOrFail($id);
        $category->delete();

        return redirect()->route('category')->with('success', 'Category deleted successfully');
    }
}
