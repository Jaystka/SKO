<?php

return [
    'serverKey' => env('MIDTRANS_SERVER_KEY'),
    'clientKey' => env('MIDTRANS_CLIENT_KEY'),
    'isProduction' => (bool) env('MIDTRANS_IS_PRODUCTION', false),
    'isSanitized' => (bool) env('MIDTRANS_IS_SANITIZED', true),
    'is3ds' => (bool) env('MIDTRANS_IS_3DS', true),

    // URL script Snap untuk frontend, otomatis mengikuti mode produksi/sandbox.
    'snapUrl' => env('MIDTRANS_IS_PRODUCTION', false)
        ? 'https://app.midtrans.com/snap/snap.js'
        : 'https://app.sandbox.midtrans.com/snap/snap.js',
];
