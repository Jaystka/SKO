<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;

class AdminAuthController extends Controller
{
    private const MAX_ATTEMPTS = 5;

    public function loginView()
    {
        return view('admin/login/main');
    }

    public function loginPost(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ]);

        $throttleKey = 'admin-login:'.Str::lower($credentials['email']).'|'.$request->ip();

        if (RateLimiter::tooManyAttempts($throttleKey, self::MAX_ATTEMPTS)) {
            $seconds = RateLimiter::availableIn($throttleKey);

            return back()->withInput($request->only('email'))
                ->with('error', "Terlalu banyak percobaan login. Coba lagi dalam {$seconds} detik.");
        }

        if (! Auth::guard('admin')->attempt($credentials)) {
            RateLimiter::hit($throttleKey, 60);

            return back()->withInput($request->only('email'))->with('error', 'Email atau Password salah');
        }

        RateLimiter::clear($throttleKey);
        $request->session()->regenerate();

        return redirect()->intended(route('dashboard'))->with('success', 'Login berhasil');
    }

    public function logoutadmin(Request $request): RedirectResponse
    {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login');
    }
}
