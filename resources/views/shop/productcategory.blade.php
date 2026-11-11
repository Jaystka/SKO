@extends('layout.main')

@section('head')
<title>{{ $title }} - SKO</title>
@endsection

@section('content')
<main class="bg-gray-100 py-28 font-MadeTomy-Medium">
    <div class="container mx-auto px-4 sm:px-6 lg:px-28">
        <div class="pl-4 xl:pl-12">
            <a href="{{ route('shop') }}" aria-label="Kembali ke shop"
                class="page-arrow flex items-center justify-center w-7 h-7 bg-transparent border border-black rounded-full hover:bg-slate-400">
                <img src="{{ asset('dist/img/right-arrow.png') }}" alt="" class="w-3 h-3 rotate-180">
            </a>
        </div>
        <div class="pl-4 xl:pl-12">
            <h1 class="text-2xl font-bold mb-4 pt-7">{{ $title }}</h1>
            @if ($products->total() > 0)
            <p class="text-sm text-gray-500">{{ $products->total() }} produk ditemukan</p>
            @endif
        </div>

        @if ($products->count() > 0)
        <div class="flex flex-wrap justify-center py-10">
            @foreach ($products as $product)
            <a href="{{ route('product.show', $product->slug) }}" class="bg-transparent rounded-lg w-1/2 md:w-1/3 xl:w-1/4">
                <div class="flex justify-center">
                    <img src="{{ $product->image_url }}" alt="{{ $product->series }}" class="size-[70%]" loading="lazy">
                </div>
                <div class="py-4 text-center">
                    <p class="text-xs text-gray-500">{{ $product->brand?->brand }}</p>
                    <h3 class="mb-2 text-xs sm:text-sm md:text-base lg:text-base xl:text-lg">{{ $product->series }}</h3>
                    <p class="text-red-600 text-[10px] sm:text-xs md:text-sm lg:text-base xl:text-base">IDR
                        {{ number_format($product->price, 0, ',', '.') }}</p>
                </div>
            </a>
            @endforeach
        </div>
        <div class="px-4 xl:px-12">
            {{ $products->links() }}
        </div>
        @else
        <div class="text-center text-gray-500 font-MadeTomy-Thin text-2xl pt-32">
            Yahh... Produk yang kamu cari tidak tersedia!!
        </div>
        <div class="flex justify-center pt-6">
            <a href="{{ route('shop') }}" class="bg-[#7C0000] text-white px-6 py-2 rounded font-MadeTomy-Regular">Lihat Shop</a>
        </div>
        @endif
    </div>
</main>
@endsection
