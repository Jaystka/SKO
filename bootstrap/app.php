<?php

use App\Http\Middleware\SecurityHeaders;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->append(SecurityHeaders::class);

        // Webhook Midtrans dipanggil server-ke-server tanpa token CSRF;
        // keasliannya diverifikasi lewat signature_key.
        $middleware->validateCsrfTokens(except: [
            'payment/notification',
            'payment/midtrans-notification',
        ]);

        // Hosting di belakang proxy/CDN (mis. Cloudflare) agar HTTPS & IP terdeteksi benar.
        $middleware->trustProxies(at: env('TRUSTED_PROXIES', '*'));

        $middleware->redirectGuestsTo(fn (Request $request) => $request->is('admin', 'admin/*')
            ? route('admin.login')
            : route('login'));

        $middleware->redirectUsersTo(fn (Request $request) => $request->is('admin', 'admin/*')
            ? route('dashboard')
            : route('/'));
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
