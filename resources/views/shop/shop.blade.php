@extends('../layout/main')

@section('head')
<title>Home - SKO</title>
<link rel="stylesheet" href="dist/css/owl.carousel.min.css">
@endsection

@section('content')
<main class="container-sm lg:px-32 py-28 font-MadeTomy-Medium">
    <section class="mb-16 mt-7">
        <div class="flex justify-between px-8">
            <h2 class="text-2xl font-semibold ">Sepatu Compass</h2>
            <a href="{{ route('productcategory') }}"
                class="page-arrow flex items-center justify-center w-7 h-7 bg-transparent border border-black  rounded-full">
                <img src="dist/img/right-arrow.png" alt="Arrow-Compas" class="w-3 h-3">
            </a>
        </div>
        <div class="owl-carousel flex justify-between px-8 pt-10 lg:p-0">
            <div class="text-center">
                <a href="product">
                    <img src="dist/img/Cmp2.png" alt="Proto Lite Purple" class="p-2 lg:p-16">
                    <h3 class="mt-4">Proto Lite Purple</h3>
                    <p class="text-red-600">IDR 578.000</p>
                </a>
            </div>
            <div class="text-center">
                <a href="product">
                    <img src="dist/img/Cmp2.png" alt="Proto Lite Purple" class="p-2 lg:p-16">
                    <h3 class="mt-4">Proto Lite Purple</h3>
                    <p class="text-red-600">IDR 578.000</p>
                </a>
            </div>
            <div class="text-center">
                <a href="product">
                    <img src="dist/img/Cmp2.png" alt="Proto Lite Purple" class="p-2 lg:p-16">
                    <h3 class="mt-4">Proto Lite Purple</h3>
                    <p class="text-red-600">IDR 578.000</p>
                </a>
            </div>
            <div class="text-center">
                <a href="product">
                    <img src="dist/img/Cmp2.png" alt="Proto Lite Purple" class="p-2 lg:p-16">
                    <h3 class="mt-4">Proto Lite Purple</h3>
                    <p class="text-red-600">IDR 578.000</p>
                </a>
            </div>
            <div class="text-center">
                <a href="product">
                    <img src="dist/img/Cmp2.png" alt="Proto Lite Purple" class="p-2 lg:p-16">
                    <h3 class="mt-4">Proto Lite Purple</h3>
                    <p class="text-red-600">IDR 578.000</p>
                </a>
            </div>
            <div class="text-center">
                <a href="product">
                    <img src="dist/img/Cmp2.png" alt="Proto Lite Purple" class="p-2 lg:p-16">
                    <h3 class="mt-4">Proto Lite Purple</h3>
                    <p class="text-red-600">IDR 578.000</p>
                </a>
            </div>
            <div class="text-center">
                <a href="product">
                    <img src="dist/img/Cmp2.png" alt="Proto Lite Purple" class="p-2 lg:p-16">
                    <h3 class="mt-4">Proto Lite Purple</h3>
                    <p class="text-red-600">IDR 578.000</p>
                </a>
            </div>
        </div>
    </section>
    <section>
        <div class="flex justify-between px-8">
            <h2 class="text-2xl font-semibold ">Sepatu Ventela</h2>
            <a href="allproduk"
                class="page-arrow flex items-center justify-center w-7 h-7 bg-transparent border border-black  rounded-full">
                <img src="dist/img/right-arrow.png" alt="Arrow-Compas" class="w-3 h-3">
            </a>
        </div>
        <div class="flex">
            <div class="owl-carousel flex justify-between px-8 pt-10 lg:p-0">
                <div class="text-center">
                    <a href="product">
                        <img src="dist/img/Ven1.png" alt="Proto Lite Purple" class="p-2 lg:p-16">
                        <h3 class="mt-4">Proto Lite Purple</h3>
                        <p class="text-red-600">IDR 578.000</p>
                    </a>
                </div>
                <div class="text-center">
                    <a href="product">
                        <img src="dist/img/Ven2.png" alt="Proto Lite Purple" class="p-2 lg:p-16">
                        <h3 class="mt-4">Proto Lite Purple</h3>
                        <p class="text-red-600">IDR 578.000</p>
                    </a>
                </div>
                <div class="text-center">
                    <a href="product">
                        <img src="dist/img/Ven2.png" alt="Proto Lite Purple" class="p-2 lg:p-16">
                        <h3 class="mt-4">Proto Lite Purple</h3>
                        <p class="text-red-600">IDR 578.000</p>
                    </a>
                </div>
                <div class="text-center">
                    <a href="product">
                        <img src="dist/img/Ven2.png" alt="Proto Lite Purple" class="p-2 lg:p-16">
                        <h3 class="mt-4">Proto Lite Purple</h3>
                        <p class="text-red-600">IDR 578.000</p>
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
    items:2,
    loop:true
    },
    600:{
    items:2,
    loop:true
    },
    1000:{
    items:3,
    loop:true
    },
    },
    autoplay:true,
        autoplayTimeout:1700,
        autoplayHoverPause:true
    })
</script>
@endsection