@extends('layout.sidebar')

@section('head')
<title>Edit Product - SKO</title>
@endsection

@section('content')
<main class="flex-1 overflow-y-auto px-8 pb-6">
    <div class="mb-4 pt-4">
        <h1 class="text-xl font-MadeTomy-Medium text-[#3C4043]">Edit Produk</h1>
    </div>
    <div class="max-w-full mx-auto bg-[#F8F7F3] px-8 py-4 rounded-xl shadow-lg">
        <form id="productForm" action="{{ route('products.update', $product->slug) }}" method="POST" enctype="multipart/form-data"
            data-confirm="Simpan data produk ini?">
            @csrf
            @method('PUT')
            @include('admin.products._form')
        </form>
    </div>
</main>
@endsection

@section('script')
<script>
    function showPreview(event, previewId) {
        const file = event.target.files[0];
        if (!file) return;
        if (file.size > 2 * 1024 * 1024) {
            SKO.toast('error', 'Ukuran gambar maksimal 2 MB');
            event.target.value = '';
            return;
        }
        const preview = document.getElementById(previewId);
        preview.src = URL.createObjectURL(file);
        preview.style.display = 'block';
    }
</script>
@endsection
