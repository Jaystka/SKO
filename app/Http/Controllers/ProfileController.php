<?php

namespace App\Http\Controllers;

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

    public function update(Request $request, string $id_user)
    {

        $user = User::findOrFail($id_user);

        $user->name = $request->username;
        $user->phone = $request->phone;
        $user->address = $request->address;

        $user->update();

        return redirect()->route('profileView');
    }
}
