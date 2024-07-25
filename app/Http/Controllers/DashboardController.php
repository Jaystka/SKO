<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    function dashboardView()
    {
        return view('admin/dashboard/home');
    }
}
