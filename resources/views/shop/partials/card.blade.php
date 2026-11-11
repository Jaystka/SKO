<div class="text-center">
    <a href="{{ route('product.show', $product->slug) }}">
        <img src="{{ $product->image_url }}" alt="{{ $product->series }}" class="p-2 lg:p-16" loading="lazy">
        <h3 class="mt-4">{{ $product->series }}</h3>
        <p class="text-red-600">IDR {{ number_format($product->price, 0, ',', '.') }}</p>
    </a>
</div>
