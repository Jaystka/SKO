<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginadminController extends Controller
{
    function loginadminView()
    {
        return view('admin/login/main');
    }
}
