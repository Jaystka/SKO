@extends('../layout/main')

@section('head')
<title>Shop - SKO</title>
<link rel="stylesheet" href="dist/css/owl.carousel.min.css">
@endsection

@section('content')
<main class="container-sm lg:px-32 py-28 font-MadeTomy-Medium">
    <section class="mb-16 mt-7">
        <div class="flex justify-between px-8">
            <h2 class="text-2xl font-semibold ">Sepatu Compass</h2>
            <a href="/categories?search=compas"
                class="page-arrow flex items-center justify-center w-7 h-7 bg-transparent border border-black  rounded-full">
                <img src="dist/img/right-arrow.png" alt="Arrow-Compas" class="w-3 h-3">
            </a>
        </div>
        <div class="owl-carousel flex justify-between px-8 pt-10 lg:p-0">
            @foreach ($categories1 as $category)
            <div class="text-center">
                <a href="product/{{$category->slug}}">
                    <img src="{{$category->image}}" alt="Proto Lite Purple" class="p-2 lg:p-16">
                    <h3 class="mt-4">{{$category->series}}</h3>
                    <p class="text-red-600">IDR {{number_format($category->price, 0, ',', '.')}}</p>
                </a>
            </div>
            @endforeach
        </div>
    </section>
    <section>
        <div class="flex justify-between px-8">
            <h2 class="text-2xl font-semibold ">Sepatu Ventela</h2>
            <a href="/categories?search=ventela"
                class="page-arrow flex items-center justify-center w-7 h-7 bg-transparent border border-black  rounded-full">
                <img src="dist/img/right-arrow.png" alt="Arrow-Compas" class="w-3 h-3">
            </a>
        </div>
        <div class="owl-carousel flex justify-between px-8 pt-10 lg:p-0">
            @foreach ($categories2 as $category)
            <div class="text-center">
                <a href="product/{{$category->slug}}">
                    <img src="{{$category->image}}" alt="Proto Lite Purple" class="p-2 lg:p-16">
                    <h3 class="mt-4">{{$category->series}}</h3>
                    <p class="text-red-600">IDR {{number_format($category->price, 0, ',', '.')}}</p>
                </a>
            </div>
            @endforeach
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
<script>
    (function (global) {
                if (typeof (global) === "undefined") {
                    throw new Error("window is undefined");
                }
    
                var _hash = "!";
                var noBackPlease = function () {
                    global.location.href += "#";
    
                    // Making sure we have only single hash in the URL.
                    global.setTimeout(function () {
                        global.location.href += "!";
                    }, 50);
                };
    
                global.onhashchange = function () {
                    if (global.location.hash !== _hash) {
                        global.location.hash = _hash;
                    }
                };
    
                global.onload = function () {
                    noBackPlease();
    
                    // Disables backspace on page except on input fields and textarea..
                    document.body.onkeydown = function (e) {
                        var elm = e.target.nodeName.toLowerCase();
                        if (e.which === 8 && (elm !== 'input' && elm !== 'textarea')) {
                            e.preventDefault();
                        }
                        // Stopping event bubbling up the DOM tree..
                        e.stopPropagation();
                    };
                };
            })(window);
</script>
@endsection