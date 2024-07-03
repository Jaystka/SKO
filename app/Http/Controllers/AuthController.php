<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;



class AuthController extends Controller
{
    /**
     * Show specified view.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function loginView()
    {
        return view('login.main');
    }

    public function registerView()
    {
        return view('register.main');
    }

    public function registerPost(Request $request)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        // Simpan data pengguna
        $user = new User();
        $user->id = $request->id;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();

        // $check = Customer::count();
        // if ($check == 0) {
        //     $id = 'C0001';
        // } else {
        //     $getId = Customer::all()->last();
        //     $number = (int)substr($getId->id_produk, -3);
        //     $new_id = str_pad($number + 1, 4, "0", STR_PAD_LEFT);
        //     $id = 'C' . $new_id;
        // };

        // // Simpan data pengguna
        // $customer = new Customer();
        // $customer->customer_id = $id;
        // $customer->username = $request->name;
        // $customer->email = $request->email;
        // $customer->password = Hash::make($request->password);
        // $customer->save();

        return back()->with('success', 'Register successfully');
    }

    /**
     * Authenticate login user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function loginPost(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'errors' => $validator->errors()
                ], 422);
            } else {
                return back()->withErrors($validator)->withInput();
            }
        }

        // Cek kredensial
        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        if (Auth::attempt($credentials)) {
            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Login berhasil'
                ]);
            } else {
                return redirect('/home')->with('success', 'Login berhasil');
            }
        }

        if ($request->ajax()) {
            return response()->json([
                'success' => false,
                'message' => 'Email atau Password salah'
            ], 401);
        } else {
            return back()->with('error', 'Email atau Password salah');
        }
    }

    /**
     * Logout user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout()
    {
        Auth::logout();
        return redirect('login');
    }
}
