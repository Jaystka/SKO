@extends('layout.sidebar')

@section('head')
<title>Products - SKO</title>
@endsection

@section('content')
<main class="flex-1 overflow-y-auto px-8 pb-8">
  <div class="max-w-7xl mx-auto pt-4">
    <div class="flex justify-between items-center mb-6">
      <h1 class="text-xl font-MadeTomy-Medium">Products</h1>
      <a href="{{ route('addproducts') }}" class="bg-[#04238E] text-white px-10 py-3 rounded-md text-sm">
        <span class="text-2xl">+ </span><span class="inline-block align-baseline">Add Product</span>
      </a>
    </div>
    <div class="bg-[#F8F7F3] px-6 pb-6 pt-2 rounded-xl shadow-xl overflow-x-auto">
      <table class="sko-admin-table">
        <thead>
          <tr>
            <th>No</th>
            <th>Foto</th>
            <th>Nama Produk</th>
            <th>Harga</th>
            <th>Stok per Size</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          @forelse ($products as $product)
          <tr>
            <td>{{ $products->firstItem() + $loop->index }}.</td>
            <td>
              <div class="w-20 h-20 flex items-center shadow-xl rounded-xl">
                <img src="{{ $product->image_url }}" alt="{{ $product->series }}" class="p-2" loading="lazy">
              </div>
            </td>
            <td>
              <a href="{{ route('product.show', $product->slug) }}" target="_blank" rel="noopener" class="hover:underline">
                Sepatu {{ $product->brand?->brand }} - {{ $product->series }}
              </a>
            </td>
            <td class="text-red-600 font-semibold">IDR {{ number_format($product->price, 0, ',', '.') }}</td>
            <td class="text-xs">
              @forelse ($product->stocks as $stock)
              <span class="{{ $stock->total_stock > 0 ? '' : 'text-red-600' }}">{{ $stock->size }}:{{ $stock->total_stock }}</span>@if (! $loop->last), @endif
              @empty
              <span class="text-gray-500">-</span>
              @endforelse
            </td>
            <td>
              <div class="flex space-x-2 items-center">
                <a href="{{ route('products.edit', $product->slug) }}" class="bg-yellow-500 text-white p-2 rounded" aria-label="Edit">
                  <svg class="h-6 w-6" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M34.5167 11.7333C35.1667 11.0833 35.1667 10 34.5167 9.38335L30.6167 5.48335C30 4.83335 28.9167 4.83335 28.2667 5.48335L25.2 8.53335L31.45 14.7833M5 28.75V35H11.25L29.6833 16.55L23.4333 10.3L5 28.75Z" fill="white"/>
                  </svg>
                </a>
                <form action="{{ route('products.delete', $product->product_id) }}" method="POST"
                  data-confirm="Hapus {{ $product->series }}? Stok dan item keranjang terkait juga akan dihapus.">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="bg-red-600 text-white p-2 rounded" aria-label="Hapus">
                    <svg class="h-6 w-6" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path d="M9.99967 31.6667C9.99967 33.5 11.4997 35 13.333 35H26.6663C28.4997 35 29.9997 33.5 29.9997 31.6667V11.6667H9.99967V31.6667ZM31.6663 6.66667H25.833L24.1663 5H15.833L14.1663 6.66667H8.33301V10H31.6663V6.66667Z" fill="white"/>
                    </svg>
                  </button>
                </form>
              </div>
            </td>
          </tr>
          @empty
          <tr><td colspan="6" class="sko-empty">Belum ada produk.</td></tr>
          @endforelse
        </tbody>
      </table>
      {{ $products->links() }}
    </div>
  </div>
</main>
@endsection
