<?php

namespace App\Http\Controllers;
use App\Models\Categories;

use Illuminate\Http\Request;

class CategoryAdminController extends Controller
{
    public function categoriesadminView()
    {
        $categories = Categories::all();
        return view('admin/category/categories',compact('categories'));
    }

    public function addcategories()
    {
        return view('admin/category/addcategories');
    }

    public function addCategory(Request $request)
    {
        $request->validate([
            'category_id' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'category_desc' => 'required|string|max:255'
        ]);

        Categories::addcategories($request->all());
        return redirect()->route('admin.category.addcategory')->with('success','Product added successfully');
    }
}
