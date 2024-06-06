@extends('../layout/main')

@section('head')
<title>Home - SKO</title>
<link rel="stylesheet" href="dist/css/owl.carousel.min.css">
@endsection

@section('content')
<main class="container px-10 py-24 font-MadeTomy-Medium">
    <section class="mb-16">
        <h2 class="text-2xl font-semibold">Sepatu Compass</h2>
        <div class="flex">
        <div class="owl-carousel flex flex-col md:flex-row justify-between gap-2">
            <div class="text-center">
                <a href="product">
                    <img src="dist/img/Cmp2.png" alt="Proto Lite Purple" class="mx-auto">
                    <h3 class="mt-4">Proto Lite Purple</h3>
                    <p class="text-red-600">IDR 578.000</p>
                </a>
            </div>
            <div class="text-center">
                <a href="product">
                    <img src="dist/img/Cmp2.png" alt="Proto Lite Purple" class="mx-auto">
                    <h3 class="mt-4">Proto Lite Purple</h3>
                    <p class="text-red-600">IDR 578.000</p>
                </a>
            </div>
            <div class="text-center">
                <a href="product">
                    <img src="dist/img/Cmp2.png" alt="Proto Lite Purple" class="mx-auto">
                    <h3 class="mt-4">Proto Lite Purple</h3>
                    <p class="text-red-600">IDR 578.000</p>
                </a>
            </div>
            <div class="text-center">
                <a href="product">
                    <img src="dist/img/Cmp2.png" alt="Proto Lite Purple" class="mx-auto">
                    <h3 class="mt-4">Proto Lite Purple</h3>
                    <p class="text-red-600">IDR 578.000</p>
                </a>
            </div>
            <div class="text-center">
                <a href="product">
                    <img src="dist/img/Cmp2.png" alt="Proto Lite Purple" class="mx-auto">
                    <h3 class="mt-4">Proto Lite Purple</h3>
                    <p class="text-red-600">IDR 578.000</p>
                </a>
            </div>
            <div class="text-center">
                <a href="product">
                    <img src="dist/img/Cmp2.png" alt="Proto Lite Purple" class="mx-auto">
                    <h3 class="mt-4">Proto Lite Purple</h3>
                    <p class="text-red-600">IDR 578.000</p>
                </a>
            </div>
            <div class="text-center">
                <a href="product">
                    <img src="dist/img/Cmp2.png" alt="Proto Lite Purple" class="mx-auto">
                    <h3 class="mt-4">Proto Lite Purple</h3>
                    <p class="text-red-600">IDR 578.000</p>
                </a>
            </div>
        </div>
        <div class="flex justify-end">
                <a href="allproduk" class="page-arrow flex items-center justify-center w-7 h-7 bg-transparent border border-black  rounded-full">
                    <img src="dist/img/right-arrow.png" alt="Arrow-Compas" class="w-3 h-3">
                </a>
            </div>
        </div>
    </section>
    <section>
        <h2 class="text-2xl font-semibold mt-20">Sepatu Ventela</h2>
        <div class="flex">
        <div class="owl-carousel flex flex-col md:flex-row justify-between gap-2">
        <div class="text-center">
                <a href="product">
                    <img src="dist/img/Ven1.png" alt="Proto Lite Purple" class="mx-auto">
                    <h3 class="mt-4">Proto Lite Purple</h3>
                    <p class="text-red-600">IDR 578.000</p>
                </a>
            </div>
            <div class="text-center">
                <a href="product">
                    <img src="dist/img/Ven2.png" alt="Proto Lite Purple" class="mx-auto">
                    <h3 class="mt-4">Proto Lite Purple</h3>
                    <p class="text-red-600">IDR 578.000</p>
                </a>
            </div>
            <div class="text-center">
                <a href="product">
                    <img src="dist/img/Ven2.png" alt="Proto Lite Purple" class="mx-auto">
                    <h3 class="mt-4">Proto Lite Purple</h3>
                    <p class="text-red-600">IDR 578.000</p>
                </a>
            </div>
            <div class="text-center">
                <a href="product">
                    <img src="dist/img/Ven2.png" alt="Proto Lite Purple" class="mx-auto">
                    <h3 class="mt-4">Proto Lite Purple</h3>
                    <p class="text-red-600">IDR 578.000</p>
                </a>
            </div>
            <div class="text-center">
                <a href="product">
                    <img src="dist/img/Ven2.png" alt="Proto Lite Purple" class="mx-auto">
                    <h3 class="mt-4">Proto Lite Purple</h3>
                    <p class="text-red-600">IDR 578.000</p>
                </a>
            </div>
            <div class="text-center">
                <a href="product">
                    <img src="dist/img/Ven2.png" alt="Proto Lite Purple" class="mx-auto">
                    <h3 class="mt-4">Proto Lite Purple</h3>
                    <p class="text-red-600">IDR 578.000</p>
                </a>
            </div>
            <div class="text-center">
                <a href="product">
                    <img src="dist/img/Ven2.png" alt="Proto Lite Purple" class="mx-auto">
                    <h3 class="mt-4">Proto Lite Purple</h3>
                    <p class="text-red-600">IDR 578.000</p>
                </a>
            </div>
        </div>
        <div class="flex justify-end">
                <a href="allproduk" class="page-arrow flex items-center justify-center w-7 h-7 bg-transparent border border-black  rounded-full hover:bg-slate-400">
                    <img src="dist/img/right-arrow.png" alt="Arrow-Compas" class="w-3 h-3">
                </a>
            </div>
        </div>
    </section>
</main>
<footer class="px-8 py-4 text-center text-black">
    ©SKO 2023. All rights reserved.
</footer>
@endsection

@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="dist/js/owl.carousel.min.js"></script>
<script>
    $('.owl-carousel').owlCarousel({
    loop:true,
    margin:10,
    nav:false,
    responsiveClass:true,
    responsive:{
    0:{
    items:1,
    loop:false
    },
    600:{
    items:2,
    loop:false
    },
    1000:{
    items:3,
    loop:false
    }
    }
    })
</script>
@endsection