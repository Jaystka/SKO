@extends('../layout/main')

@section('head')
<title>Home - SKO</title>
<link rel="stylesheet" href="dist/css/owl.carousel.min.css">
@endsection

@section('content')
<main class="bg-gray-100 py-24 font-MadeTomy-Medium">

<div class="container mx-auto px-4 sm:px-6 lg:px-8">
     <!-- Tombol Kembali -->
     <a href="shop" class="page-arrow flex items-center justify-center w-7 h-7 bg-transparent border border-black  rounded-full hover:bg-slate-400">
        <img src="dist/img/right-arrow.png" alt="Arrow-Compas" class="w-3 h-3 rotate-180">
        </a>
    <h1 class="text-2xl font-bold mb-4 pt-7 ">Sepatu Compas</h1>

    <div class="grid grid-cols-3 gap-4">
        <!-- Product Card -->
        <a href="product" class="bg-transparent rounded-lg overflow-hidden">
            <img src="dist/img/Cmp1.png" alt="Product" class="w-full h-30 md:h-40 xl:h-48 object-cover object-center">
            <div class="p-4 text-center">
                <h3 class="mb-2  text-xs sm:text-sm md:text-base lg:text-base xl:text-lg">Proto Lite Purple</h3>
                <p class="text-red-600 text-[10px] sm:text-xs md:text-sm lg:text-base xl:text-base">IDR 578.000</p>
            </div>
        </a>
        <!-- End Product Card -->

        <!-- Product Card -->
        <a href="product" class="bg-transparent rounded-lg overflow-hidden">
            <img src="dist/img/Cmp2.png" alt="Product" class="w-full h-30 md:h-40 xl:h-48 object-cover object-center">
            <div class="p-4 text-center">
                <h3 class="mb-2  text-xs sm:text-sm md:text-base lg:text-base xl:text-lg">Proto Lite Purple</h3>
                <p class="text-red-600 text-[10px] sm:text-xs md:text-sm lg:text-base xl:text-base">IDR 578.000</p>
            </div>
        </a>
        <!-- End Product Card -->

        <!-- Product Card -->
        <a href="product" class="bg-transparent rounded-lg overflow-hidden">
            <img src="dist/img/Cmp3.png" alt="Product" class="w-full h-30 md:h-40 xl:h-48 object-cover object-center">
            <div class="p-4 text-center">
                <h3 class="mb-2  text-xs sm:text-sm md:text-base lg:text-base xl:text-lg">Proto Lite Purple</h3>
                <p class="text-red-600 text-[10px] sm:text-xs md:text-sm lg:text-base xl:text-base">IDR 578.000</p>
            </div>
        </a>
        <!-- End Product Card -->

        <!-- Product Card -->
        <a href="product" class="bg-transparent rounded-lg overflow-hidden">
            <img src="dist/img/Cmp1.png" alt="Product" class="w-full h-30 md:h-40 xl:h-48 object-cover object-center">
            <div class="p-4 text-center">
                <h3 class="mb-2  text-xs sm:text-sm md:text-base lg:text-base xl:text-lg">Proto Lite Purple</h3>
                <p class="text-red-600 text-[10px] sm:text-xs md:text-sm lg:text-base xl:text-base">IDR 578.000</p>
            </div>
        </a>
        <!-- End Product Card -->

        <!-- Product Card -->
        <a href="product" class="bg-transparent rounded-lg overflow-hidden">
            <img src="dist/img/Cmp1.png" alt="Product" class="w-full h-30 md:h-40 xl:h-48 object-cover object-center">
            <div class="p-4 text-center">
                <h3 class="mb-2  text-xs sm:text-sm md:text-base lg:text-base xl:text-lg">Proto Lite Purple</h3>
                <p class="text-red-600 text-[10px] sm:text-xs md:text-sm lg:text-base xl:text-base">IDR 578.000</p>
            </div>
        </a>
        <!-- End Product Card -->

        <!-- Product Card -->
        <a href="product" class="bg-transparent rounded-lg overflow-hidden">
            <img src="dist/img/Cmp1.png" alt="Product" class="w-full h-30 md:h-40 xl:h-48 object-cover object-center">
            <div class="p-4 text-center">
                <h3 class="mb-2  text-xs sm:text-sm md:text-base lg:text-base xl:text-lg">Proto Lite Purple</h3>
                <p class="text-red-600 text-[10px] sm:text-xs md:text-sm lg:text-base xl:text-base">IDR 578.000</p>
            </div>
        </a>
        <!-- End Product Card -->

    </div>
</div>

</main>
@endsection
