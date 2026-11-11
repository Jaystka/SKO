<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="@yield('description', 'SKO — toko sepatu lokal Indonesia. Temukan sepatu Compass, Ventela, dan brand lokal lainnya.')">
    <meta property="og:site_name" content="SKO">
    <meta property="og:title" content="@yield('og_title', 'SKO')">
    <meta property="og:description" content="@yield('description', 'Toko sepatu lokal Indonesia.')">
    <link rel="icon" href="{{ asset('dist/img/logosko.png') }}">

    @hasSection('head')
        @yield('head')
    @else
        <title>SKO</title>
    @endif

    <link rel="stylesheet" href="{{ mix('dist/css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/css/sko.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.12/dist/sweetalert2.min.css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.12/dist/sweetalert2.all.min.js"></script>
    <script src="{{ mix('dist/js/app.js') }}" defer></script>
    <script>
        // Kirim token CSRF di semua request AJAX jQuery.
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json'
            }
        });

        window.SKO = {
            toast(icon, title) {
                Swal.fire({ toast: true, position: 'top-end', icon, title, showConfirmButton: false, timer: 3000, timerProgressBar: true });
            },
            // Ambil pesan error pertama dari response Laravel (validasi / umum).
            errorMessage(xhr, fallback = 'Terjadi kesalahan, silakan coba lagi.') {
                const data = xhr && (xhr.responseJSON || (xhr.response && xhr.response.data));
                if (xhr && xhr.status === 419) return 'Sesi Anda telah berakhir, silakan muat ulang halaman.';
                if (xhr && xhr.status === 429) return (data && data.message) || 'Terlalu banyak permintaan, coba lagi sebentar.';
                if (data && data.errors) return Object.values(data.errors)[0][0];
                return (data && data.message) || fallback;
            },
            formatRupiah(number) {
                return 'IDR ' + Number(number || 0).toLocaleString('id-ID');
            }
        };
    </script>
</head>

@yield('body')

</html>
