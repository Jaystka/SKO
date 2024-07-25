<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\URL;

class CustomerAuthController extends Controller
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

        $check = Customer::count();
        if ($check == 0) {
            $id = 'C0001';
        } else {
            $getId = Customer::all()->last();
            $number = (int)substr($getId->customer_id, -4);
            $new_id = str_pad($number + 1, 4, "0", STR_PAD_LEFT);
            $id = 'C' . $new_id;
        };

        // Simpan data pengguna
        $customer = new Customer();
        $customer->customer_id = $id;
        $customer->username = $request->name;
        $customer->email = $request->email;
        $customer->password = Hash::make($request->password);
        $customer->save();

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
                $intendedUrl = session('url.intended', url('home')); // Dapatkan URL yang dimaksud dari sesi atau default ke /home
                return response()->json([
                    'success' => true,
                    'message' => 'Login berhasil',
                    'url' => $intendedUrl
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
    public function logout(Request $request)
    {
        Auth::logout();

        // Hapus semua data session
        $request->session()->invalidate();

        // Hasilkan ulang token CSRF
        $request->session()->regenerateToken();

        return redirect('login');
    }
}
