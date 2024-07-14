@extends('../layout/sidebar')

@section('head')
<title>products - SKO</title>
@endsection

@section('content')
        <main class="flex-1 overflow-y-auto px-8">
          <!----------------------------- Batas contain ---------------------------------------------------->
          <div class="max-w-7xl mx-auto pt-4">
            <div class="flex justify-between items-center">

                <div class="mb-10 pb-2">
                <h1 class="text-xl font-MadeTomy-Medium">Products</h1>
                </div>
                <button class="bg-[#04238E] text-white px-10 py-3 rounded-md text-sm"><span class="text-2xl">+ </span><span class="inline-block align-baseline">Add Product</span></button>
            </div>
          <div class="bg-[#F8F7F3] px-6 pb-6 pt-2 rounded-xl shadow-xl">
              <div class="overflow-x-auto">
                <div class="min-w-full space-y-3 px-4 pb-7">
                    <div class="grid grid-cols-11 px-4 border-gray-200 text-sm font-bold text-gray-500">
                        <div class="col-span-1 flex items-center justify-center">No</div>
                        <div class="col-span-1 -ml-6 md:-ml-4">Photos</div>
                        <div class="col-span-3 text-left">Name Product</div>
                        <div class="col-span-2 text-center">Price</div>
                        <div class="col-span-2 text-center">Size</div>
                        <div class="col-span-2 text-center">Action</div>
                    </div>
                    @foreach ($products as $index => $product)
                    <div class="grid grid-cols-11 py-4 px-4 border-b border-gray-200 shadow-lg rounded-xl">
                        <div class="col-span-1 flex items-center justify-center">{{ $index + 1 }}.</div>
                        <div class="col-span-1 -ml-6 md:-ml-4">
                            <div class="w-20 h-20 xl:w-24 xl:h-24 flex  items-center shadow-xl rounded-xl">
                            <img src="{{ $product->image }}" alt="Product Image" class="p-2">
                            </div>
                        </div>
                        <div class="col-span-3 flex items-center justify-left">Sepatu {{$product->brand}} - {{$product->series}}</div>
                        <div class="col-span-2 text-red-600 font-semibold flex items-center justify-center">IDR {{ number_format($product->price, 0, ',', '.')}}</div>
                        <div class="col-span-2 text-center flex items-center justify-center">All Size</div>
                        <div class="col-span-2 flex space-x-2 items-center justify-center">
                            <button class="bg-yellow-500 text-white p-2 rounded">
                            <svg class="h-6 w-6" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M34.5167 11.7333C35.1667 11.0833 35.1667 10 34.5167 9.38335L30.6167 5.48335C30 4.83335 28.9167 4.83335 28.2667 5.48335L25.2 8.53335L31.45 14.7833M5 28.75V35H11.25L29.6833 16.55L23.4333 10.3L5 28.75Z" fill="white"/>
                            </svg>

                            </button>
                            <button class="bg-red-600 text-white p-2 rounded">
                            <svg class="h-6 w-6" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M9.99967 31.6667C9.99967 33.5 11.4997 35 13.333 35H26.6663C28.4997 35 29.9997 33.5 29.9997 31.6667V11.6667H9.99967V31.6667ZM31.6663 6.66667H25.833L24.1663 5H15.833L14.1663 6.66667H8.33301V10H31.6663V6.66667Z" fill="white"/>
                            </svg>
                            </button>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
              </div>
          </div>
      </div>
        </main>
    </div>
</div>
@endsection
