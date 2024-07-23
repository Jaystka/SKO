<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no" />
    @vite('resources/css/app.css')
    <title>SKO</title>
    <style>
        .dropdown-content {
            right: 0;
            left: auto;
        }
    </style>
</head>

   {{-- Navbar Components --}}
   @include('components.navbar')
   {{-- Navbar Components --}}

<body class="bg-gray-100 font-sans">
  <div class="container mx-auto p-32">
    <div class="rounded-lg overflow-hidden max-w-4xl mx-auto">
      <div class="p-4 border-b flex justify-between items-center">
        <h1 class="text-2xl font-semibold">Notifications</h1>
        <a href="#" class="text-[#3C4043] text-md font-semibold">Tandai sebagai sudah dibaca</a>
      </div>
      <div class="divide-y space-y-4 p-4">
        <!-- Notification Item -->
        <div class="flex items-start p-4 bg-[#FFFAE2] rounded-lg shadow-lg">
          <img src="shoe.png" alt="Product Image" class="w-12 h-12 mr-4">
          <div class="flex-1">
            <h2 class="text-md font-semibold">Pesanan akan Diantar Hari Ini</h2>
            <p class="text-xs">Pesanan <strong>10PROTOPURPLE</strong> akan diantar ke alamat tujuan anda. <span class="text-gray-500">12-7-2024 09:37</span></p>
          </div>
        </div>
        <!-- Notification Item -->
        <div class="flex items-start p-4 bg-[#FFFAE2] rounded-lg shadow-lg">
          <img src="shoe.png" alt="Product Image" class="w-12 h-12 mr-4">
          <div class="flex-1">
            <h2 class="text-md font-semibold">Pesanan Dalam Perjalanan</h2>
            <p class="text-xs">Pesanan <strong>10PROTOPURPLE</strong> sudah dalam perjalanan menuju alamat lokasi anda. <span class="text-gray-500">11-7-2024 13:10</span></p>
          </div>
        </div>
        <!-- Notification Item -->
        <div class="flex items-start p-4 bg-[#FFFAE2] rounded-lg shadow-lg">
          <img src="shoe.png" alt="Product Image" class="w-12 h-12 mr-4">
          <div class="flex-1">
            <h2 class="text-md font-semibold">Pesanan Diserahkan ke Jasa Kirim</h2>
            <p class="text-xs">Pesanan <strong>10PROTOPURPLE</strong> akan diproses. <span class="text-gray-500">10-7-2024 18:56</span></p>
          </div>
        </div>
        <!-- Notification Item -->
        <div class="flex items-start p-4 bg-[#FFFAE2] rounded-lg shadow-lg">
          <img src="shoe.png" alt="Product Image" class="w-12 h-12 mr-4">
          <div class="flex-1">
            <h2 class="text-md font-semibold">Pembayaran Berhasil</h2>
            <p class="text-xs">Pembayaran berhasil dilakukan untuk pesanan <strong>10PROTOPURPLE</strong> produk Sepatu Compass Proto Lite Purple. Pesanan akan segera dikirim oleh kami. <span class="text-gray-500">10-7-2024 11:56</span></p>
          </div>
        </div>
        <!-- Notification Item -->
        <div class="flex items-start p-4 bg-[#C35454] rounded-lg shadow-lg text-white">
          <img src="shoe.png" alt="Product Image" class="w-12 h-12 mr-4">
          <div class="flex-1">
            <h2 class="text-md font-semibold">Pembayaran Gagal</h2>
            <p class="text-xs">Pembayaran untuk pesanan <strong>10PROTOPURPLE</strong> gagal. Silahkan ulangi pembayaran anda. <span class="text-gray-100">10-7-2024 11:56</span></p>
            <button class="mt-2 px-1 py-2 bg-[#FFF3B2] text-black text-xs font-semibold rounded">Ulangi Pembayaran</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
</html>
