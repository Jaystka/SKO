@extends('layout.main')

@section('head')
<title>Shop - SKO</title>
<link rel="stylesheet" href="{{ asset('dist/css/owl.carousel.min.css') }}">
@endsection

@section('content')
<main class="container-sm lg:px-32 py-28 font-MadeTomy-Medium">
    @forelse ($sections as $section)
    <section class="mb-16 mt-7">
        <div class="flex justify-between px-8">
            <h2 class="text-2xl font-semibold">Sepatu {{ $section['brand'] }}</h2>
            <a href="{{ route('categories', ['search' => $section['brand']]) }}"
                class="page-arrow flex items-center justify-center w-7 h-7 bg-transparent border border-black rounded-full"
                aria-label="Lihat semua sepatu {{ $section['brand'] }}">
                <img src="{{ asset('dist/img/right-arrow.png') }}" alt="" class="w-3 h-3">
            </a>
        </div>
        @if ($section['products']->isEmpty())
        <p class="px-8 pt-6 text-gray-500">Belum ada produk.</p>
        @else
        <div class="owl-carousel flex justify-between px-8 pt-10 lg:p-0">
            @foreach ($section['products'] as $product)
            @include('shop.partials.card', ['product' => $product])
            @endforeach
        </div>
        @endif
    </section>
    @empty
    <section class="mb-16 mt-7">
        <div class="flex justify-between px-8">
            <h2 class="text-2xl font-semibold">Produk Terbaru</h2>
            <a href="{{ route('categories') }}"
                class="page-arrow flex items-center justify-center w-7 h-7 bg-transparent border border-black rounded-full"
                aria-label="Lihat semua produk">
                <img src="{{ asset('dist/img/right-arrow.png') }}" alt="" class="w-3 h-3">
            </a>
        </div>
        @if ($latest->isEmpty())
        <p class="px-8 pt-6 text-gray-500">Belum ada produk.</p>
        @else
        <div class="owl-carousel flex justify-between px-8 pt-10 lg:p-0">
            @foreach ($latest as $product)
            @include('shop.partials.card', ['product' => $product])
            @endforeach
        </div>
        @endif
    </section>
    @endforelse
</main>
@include('partials.footer')
@endsection

@section('script')
<script src="{{ asset('dist/js/owl.carousel.min.js') }}"></script>
<script>
    $('.owl-carousel').owlCarousel({
        loop: false,
        rewind: true,
        margin: 10,
        nav: false,
        responsiveClass: true,
        responsive: { 0: { items: 2 }, 600: { items: 2 }, 1000: { items: 3 } },
        autoplay: true,
        autoplayTimeout: 2500,
        autoplayHoverPause: true,
    });
</script>
@endsection
