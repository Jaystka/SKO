<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductCategoryController extends Controller
{
    function ProductCategoriesView()
    {

        return view('shop/productcategories');
    }
}
