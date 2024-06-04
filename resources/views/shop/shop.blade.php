@extends('../layout/main')

@section('head')
<title>Home - SKO</title>
<link rel="stylesheet" href="dist/css/owl.carousel.min.css">
@endsection

@section('content')
<main class="container-sm px-10 py-24 font-MadeTomy-Medium">
    <section class="mb-16">
        <h2 class="text-2xl font-semibold">Sepatu Compass</h2>
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
    </section>
    <section>
        <h2 class="text-2xl font-semibold mt-20">Sepatu Ventela</h2>
        <div class="flex flex-col md:flex-row justify-between gap-2">
            <div class="text-center">
                <img src="img/Ven1.png" alt="Public Low Black Natural" class="mx-auto">
                <h3 class="mt-4">Public Low Black Natural</h3>
                <p class="text-red-600">IDR 229.000</p>
            </div>
            <div class="text-center">
                <img src="img/Ven2.png" alt="Public Low Grey" class="mx-auto">
                <h3 class="mt-4">Public Low Grey</h3>
                <p class="text-red-600">IDR 239.000</p>
            </div>
            <div class="text-center">
                <img src="img/Ven3.png" alt="Public Low Yellow" class="mx-auto">
                <h3 class="mt-4">Public Low Yellow</h3>
                <p class="text-red-600">IDR 239.000</p>
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
    nav:true,
    responsive:{
    0:{
    items:1
    },
    600:{
    items:2
    },
    1000:{
    items:3
    }
    }
    })
</script>
@endsection