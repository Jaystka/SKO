<?php

namespace App\Http\Middleware;

use App\Models\Cart;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectCheckout
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        $customer_id = Auth::id();
        $carts = Cart::where('customer_id', $customer_id)
            ->get();

        if ($carts->count() < 1) {
            return redirect()->route('shop');
        }

        return $next($request);
    }
}
