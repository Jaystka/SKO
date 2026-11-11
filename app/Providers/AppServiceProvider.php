<?php

namespace App\Providers;

use App\Services\Payment\MidtransGateway;
use App\Services\Payment\PaymentGateway;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(PaymentGateway::class, fn () => new MidtransGateway(
            serverKey: config('midtrans.serverKey'),
            isProduction: (bool) config('midtrans.isProduction'),
            isSanitized: (bool) config('midtrans.isSanitized'),
            is3ds: (bool) config('midtrans.is3ds'),
        ));
    }

    public function boot(): void
    {
        Paginator::useTailwind();

        // Deteksi N+1 query saat development, tanpa memengaruhi produksi.
        Model::preventLazyLoading(! $this->app->isProduction());

        if ($this->app->isProduction() && str_starts_with((string) config('app.url'), 'https://')) {
            URL::forceScheme('https');
        }
    }
}
