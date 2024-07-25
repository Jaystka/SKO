@extends('../layout/main')

@section('head')
<title>Home - SKO</title>
<link rel="stylesheet" href="dist/css/owl.carousel.min.css">
@endsection

@section('content')
<main class="bg-gray-100 py-28 font-MadeTomy-Medium">

    <div class="container mx-auto px-4 sm:px-6 lg:px-28">
        <!-- Tombol Kembali -->
        <div class="pl-4 xl:pl-12"><a href="shop"
                class="page-arrow flex items-center justify-center w-7 h-7 bg-transparent border border-black  rounded-full hover:bg-slate-400">
                <img src="dist/img/right-arrow.png" alt="Arrow" class="w-3 h-3 rotate-180">
            </a>
        </div>
        @foreach ($products as $product)
        @endforeach
        <div class="pl-4 xl:pl-12">
            <h1 class="text-2xl font-bold mb-4 pt-7 ">Sepatu {{$product->brand}}</h1>
        </div>

        <div class="flex justify-center py-10">
            @foreach ($products as $product)
            <!-- Product Card -->
            <a href="product/{{$product->slug}}" class="bg-transparent rounded-lg w-1/3 xl:w-1/4">
                <div class="flex justify-center">
                    <img src="{{$product->image}}" alt="Product" class="size-[70%]">
                </div>
                <div class="py-4 text-center">
                    <h3 class="mb-2  text-xs sm:text-sm md:text-base lg:text-base xl:text-lg">{{$product->series}}</h3>
                    <p class="text-red-600 text-[10px] sm:text-xs md:text-sm lg:text-base xl:text-base">IDR
                        {{number_format($product->price, 0, ',', '.')}}</p>
                </div>
            </a>
            <!-- End Product Card -->
            @endforeach
        </div>
    </div>

</main>
@endsection