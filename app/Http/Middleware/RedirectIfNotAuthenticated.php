<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class RedirectIfNotAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    // public function handle($request, Closure $next)
    // {
    //     if (!Auth::check()) {
    //         $request->session()->put('url.intended', $request->fullUrl());
    //         return redirect()->route('login');
    //     }

    //     return $next($request);
    // }

    public function handle($request, Closure $next)
    {
        if (Auth::guard('web')->check()) {
            return $next($request);
        }

        if (Auth::guard('admin')->check()) {
            return $next($request);
        }

        if (!$request->expectsJson()) {
            $request->session()->put('url.intended', $request->fullUrl());

            if ($request->is('admin/*')) {
                return redirect()->route('admin.login');
            } else {
                return redirect()->route('login');
            }
        }

        return $next($request);
    }
}
