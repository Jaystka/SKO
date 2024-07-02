<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductCategoryController extends Controller
{
    function ProductCategoryView()
    {
        
        return view('shop/productcategory');
    }
}
