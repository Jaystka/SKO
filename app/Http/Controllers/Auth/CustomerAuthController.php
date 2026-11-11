<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Support\IdGenerator;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\ValidationException;

class CustomerAuthController extends Controller
{
    private const MAX_ATTEMPTS = 5;

    public function loginView()
    {
        return view('login.main');
    }

    public function registerView()
    {
        return view('register.main');
    }

    public function registerPost(Request $request): JsonResponse|RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:customers,email'],
            'password' => ['required', 'string', Password::min(8)],
        ], [
            'email.unique' => 'Email sudah digunakan.',
        ]);

        DB::transaction(function () use ($data) {
            Customer::create([
                'customer_id' => IdGenerator::next('customers', 'customer_id', 'C'),
                'username' => $data['name'],
                'email' => Str::lower($data['email']),
                'password' => $data['password'], // di-hash otomatis oleh cast "hashed"
            ]);
        });

        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Registrasi berhasil, silakan login.',
                'url' => route('login'),
            ], 201);
        }

        return redirect()->route('login')->with('success', 'Registrasi berhasil, silakan login.');
    }

    public function loginPost(Request $request): JsonResponse|RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ]);

        $throttleKey = 'login:'.Str::lower($credentials['email']).'|'.$request->ip();

        if (RateLimiter::tooManyAttempts($throttleKey, self::MAX_ATTEMPTS)) {
            $seconds = RateLimiter::availableIn($throttleKey);
            throw ValidationException::withMessages([
                'email' => "Terlalu banyak percobaan login. Coba lagi dalam {$seconds} detik.",
            ])->status(429);
        }

        $credentials['email'] = Str::lower($credentials['email']);

        if (! Auth::guard('web')->attempt($credentials, $request->boolean('remember'))) {
            RateLimiter::hit($throttleKey, 60);

            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Email atau Password salah',
                ], 401);
            }

            return back()->withInput($request->only('email'))->with('error', 'Email atau Password salah');
        }

        RateLimiter::clear($throttleKey);
        $request->session()->regenerate();

        $intended = $request->session()->pull('url.intended', url('/'));

        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Login berhasil',
                'url' => $intended,
            ]);
        }

        return redirect()->to($intended)->with('success', 'Login berhasil');
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
