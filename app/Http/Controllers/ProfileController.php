<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;


class ProfileController extends Controller
{
    function profileView()
    {
        return view('profile/profileuser');
    }

    function index()
    {
        return view('profile/editprofileuser');
    }

    public function update(Request $request, string $customer_id)
    {

        $user = Customer::findOrFail($customer_id);

        $user->username = $request->username;
        $user->name = $request->name;
        $user->phone = $request->phone;
        $user->address = $request->address;

        $user->update();

        return redirect()->route('profileView');
    }
}
