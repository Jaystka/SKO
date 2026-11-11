<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex">
    <title>@yield('code') - SKO</title>
    <link rel="icon" href="{{ asset('dist/img/logosko.png') }}">
    <link rel="stylesheet" href="{{ asset('dist/css/sko.css') }}">
    <style>body { margin: 0; font-family: system-ui, -apple-system, 'Segoe UI', sans-serif; }</style>
</head>
<body>
    <main class="sko-error">
        <img src="{{ asset('dist/img/logoskoblack.png') }}" alt="SKO" style="height: 48px">
        <h1>@yield('code')</h1>
        <p>@yield('message')</p>
        <a href="{{ url('/') }}">Kembali ke Beranda</a>
    </main>
</body>
</html>
