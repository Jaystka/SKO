<?php

namespace App\Http\Controllers;

use App\Models\Customer;

class CustomerAdminController extends Controller
{
    public function index()
    {
        $customers = Customer::query()->latest()->paginate(25);

        return view('admin/customer', compact('customers'));
    }
}
