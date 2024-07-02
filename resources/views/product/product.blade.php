@extends('../layout/main')

@section('head')
<title>Home - SKO</title>
<!-- <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css"> -->
<link rel="stylesheet" href="{{ asset('dist/css/owl.carousel.min.css') }}">
<style>
</style>
@endsection

@section('content')
<main class="container px-4 md:px-24 pt-24 text-[#3C4043]">
  <div class="flex flex-wrap ">
    <!-- Left Column -->
    <div class="w-full lg:w-1/4 items-start">
      <div class="flex flex-col space-y-2">
        <div class="flex items-center space-x-4">
          <div
            class=" rounded-2xl h-16 w-16 p-2 shadow-xl flex justify-center items-center text-center outline outline-1 bg-[#F0EEE5]">
            <p class="font-MadeTomy-Regular">{{$product->material}}</p>
          </div>
          <span>{{$product->material_desc}}</span>
        </div>
        <div class="flex items-center space-x-4 py-8">
          <div
            class="rounded-2xl h-16 w-16 p-2 shadow-xl flex justify-center items-center text-center outline outline-1 bg-[#F0EEE5]">
            <p class="font-MadeTomy-Regular">{{$product->category}}</p>
          </div>
          <span>{{$product->category_desc}}</span>
        </div>
      </div>

      <div class="bg-[#F0EEE5] p-4 rounded-3xl shadow-xl w-3/4 outline outline-1">
        <h3 class="text-center mb-2 out">Size chart</h3>
        <table class="w-full text-center">
          <thead class="border-b-2 border-black">
            <tr>
              <th class="font-medium w-1/2">Size</th>
              <th class="font-medium">CM</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td class="border-r-2 border-black">36</td>
              <td>24CM</td>
            </tr>
            <tr>
              <td class="border-r-2 border-black">37</td>
              <td>24.5CM</td>
            </tr>
            <tr>
              <td class="border-r-2 border-black">38</td>
              <td>25CM</td>
            </tr>
            <tr>
              <td class="border-r-2 border-black">39</td>
              <td>26CM</td>
            </tr>
            <tr>
              <td class="border-r-2 border-black">40</td>
              <td>26.5CM</td>
            </tr>
            <tr>
              <td class="border-r-2 border-black">41</td>
              <td>27CM</td>
            </tr>
            <tr>
              <td class="border-r-2 border-black">42</td>
              <td>27.5CM</td>
            </tr>
            <tr>
              <td class="border-r-2 border-black">43</td>
              <td>28.5CM</td>
            </tr>
            <tr>
              <td class="border-r-2 border-black">44</td>
              <td>29CM</td>
            </tr>
            <tr>
              <td class="border-r-2 border-black">45</td>
              <td>29.5CM</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>

    <!-- Center Column -->
    <div class="w-full lg:w-2/4 items-center justify-center space-y-6">
      <div class="relative pt-40">
        <!-- <div class="swiper-wrapper"> -->
        <div class="owl-carousel owl-theme" id="productImages">
          <!-- <div class="swiper-slide flex justify-center"> -->
          <div class="item flex justify-center" data-hash="image1">
            <img src="{{ asset($product['image']) }}" alt="Proto Lite Purple" class="w-full max-w-xs xl:max-w-sm">
          </div>
          <div class="item flex justify-center" data-hash="image2">
            <img src="{{ asset($product['image']) }}" alt="Proto Lite Purple" class="w-full max-w-xs xl:max-w-sm">
          </div>
        </div>
        <div class="flex justify-center mt-4 space-x-2 ">
          <img src="{{ asset($product['image']) }}" alt="Proto Lite Purple"
            class=" nav-button w-16 h-16 object-contain rounded-lg shadow-md hover:border border-black"
            data-hash="image1">
          <img src="{{ asset($product['image']) }}" alt="Proto Lite Purple"
            class="nav-button w-16 h-16 object-contain rounded-lg shadow-md hover:border border-black"
            data-hash="image2">
        </div>
      </div>
    </div>

    <!-- Right Column -->
    @php
    $isDisabled = function ($product, $size) {
    $stock = $product->stock->firstWhere('size', $size);
    return optional($stock)->total_stock == '0' ? 'disabled' : '';
    };
    @endphp
    <div class="w-full lg:w-1/4 items-center md:items-start">
      <div class="space-y-2 text-center md:text-left">
        <div class="flex items-center justify-center md:justify-start">
          <span class="text-yellow-500">
            @php
            for($x=1;$x<=$product->rating;$x++) { echo "★" ; } @endphp </span>
          <span class="pl-2">372
            Reviews</span>
        </div>
        <div class="py-5">
          <h2 class="text-2xl font-bold">Sepatu {{ $product->product }}</h2>
          <h1 class="text-3xl font-MadeTomy-Bold">{{ $product->brand }}</h1>
        </div>
        <p class="text-red-600 text-xl font-MadeTomy-Medium">IDR {{ number_format($product->price, 0, ',', '.')}}</p>

        <form class="addCart" id="addCart" action="{{ route('cart.store') }}" method="POST">
          @csrf
          <input type="hidden" name="customer_id" value="{{ auth()->user()->id }}">
          <div class="grid grid-cols-5 gap-2 my-4">
            <label class="cursor-pointer">
              <input {{ $isDisabled($product, '36' ) }} id="option1" name="size" class="peer sr-only" type="radio"
                value="36">
              <div
                class="p-2 border rounded text-center text-gray-600 transition-all hover:shadow peer-checked:bg-third peer-checked:text-fourth peer-checked:border-fourth">
                <p>36</p>
              </div>
            </label>
            <label class="cursor-pointer">
              <input {{ $isDisabled($product, '37' ) }} id="option1" name="size" class="peer sr-only" type="radio"
                value="37">
              <div
                class="p-2 border rounded text-center text-gray-600 transition-all hover:shadow peer-checked:bg-third peer-checked:text-fourth peer-checked:border-fourth">
                <p>37</p>
              </div>
            </label>
            <button class="p-2 border rounded">38</button>
            <button class="p-2 border rounded">39</button>
            <button class="p-2 border rounded">40</button>
            <button class="p-2 border rounded">41</button>
            <button class="p-2 border rounded">42</button>
            <button class="p-2 border rounded">43</button>
            <button class="p-2 border rounded">44</button>
            <button class="p-2 border rounded">45</button>
          </div>
        </form>

        <div class="py-5">
          <p class="font-MadeTomy-Medium">About</p>
          <p class="text-sm text-justify">{{$product->description}}</p>
        </div>
        <div class="flex justify-end"><button type="submit" form="addCart"
            class="bg-yellow-300 text-black py-4 px-16 rounded-md shadow-md">Buy</button>
        </div>
      </div>
    </div>
  </div>
</main>

<footer class="px-8 py-4 text-center text-black">
  ©SKO 2023. All rights reserved.
</footer>
@endsection

@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="{{ asset('dist/js/owl.carousel.min.js') }}"></script>
<script>
  $(document).ready(function() {
  var owl = $('#productImages').owlCarousel({
    items: 1,
    loop: true,
    margin: 10,
    nav: true,
    dots: false,
    URLhashListener: true,
    startPosition: 'URLHash',
    navText: [
      '<svg class="w-8 h-8 text-white" fill="none" stroke="grey" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><line x1="15" y1="19" x2="9" y2="12" stroke-width="2" stroke-linecap="round" /><line x1="9" y1="12" x2="15" y2="5" stroke-width="2" stroke-linecap="round" /></svg>',
      '<svg class="w-8 h-8 text-white" fill="none" stroke="grey" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><line x1="9" y1="19" x2="15" y2="12" stroke-width="2" stroke-linecap="round" /><line x1="15" y1="12" x2="9" y2="5" stroke-width="2" stroke-linecap="round" /></svg>'
    ]
  });

   // Mengatur navigasi dengan gambar thumbnail
  $('.nav-button').on('click', function() {
    var hash = $(this).data('hash');
    var index = $('[data-hash="'+ hash +'"]').parent().index();
    owl.trigger('to.owl.carousel', [index, 300]);
    window.location.hash = hash;
    $('.nav-button').removeClass('active');
    $(this).addClass('active');
  });

 // Scroll ke bagian yang diinginkan berdasarkan hash URL pada halaman load
 $(window).on('load', function() {
    if(window.location.hash) {
      var hash = window.location.hash.substring(1);
      var index = $('[data-hash="'+ hash +'"]').parent().index();
      owl.trigger('to.owl.carousel', [index, 300]);
      $('.nav-button[data-hash="'+ hash +'"]').addClass('active');
    }
  });
});
</script>
@endsection