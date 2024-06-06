<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller
{
    function index()
    {
        return view('cart/cart');
    }
}
