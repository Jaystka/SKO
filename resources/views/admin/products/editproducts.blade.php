@extends('../layout/sidebar')

@section('head')
<title>Edit Product - SKO</title>
@endsection

@section('content')
<main class="flex-1 overflow-y-auto px-8 pb-6">
    <div class="mb-4 pt-4">
        <h1 class="text-xl font-MadeTomy-Medium text-[#3C4043]">Edit Product</h1>
    </div>
    <div class="max-w-full mx-auto bg-[#F8F7F3] px-8 py-4 rounded-xl shadow-lg">
        <form id="editProduct" action="{{ route('products.update', $product->slug) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-4 flex items-center">
              <label for="photo" class="block text-[#3C4043] font-MadeTomy-Regular w-32">Photo Product:</label>
                <div class="flex space-x-4 w-3/4">
                    <div class="relative">
                        <img id="preview-1" src="{{ asset($product->image) }}" class="w-20 h-20 object-contain rounded-lg border border-gray-300" style="display: block;">
                        <button type="button" class="text-gray-400 w-20 h-8 border border-gray-300 rounded-lg bg-gray-100 flex items-center justify-center text-sm mt-2" onclick="document.getElementById('photo-input-1').click()">Ganti</button>
                        <input id="photo-input-1" type="file" class="hidden-file-input" name="image" accept="image/*" onchange="showPreview(event, 'preview-1')" style="display: none;">
                    </div>
                </div>
            </div>
            <div class="mb-4 flex items-center">
                <label for="brand_id" class="block text-[#3C4043] font-MadeTomy-Regular w-32">Brand:</label>
                <select id="brand_id" name="brand_id" class="w-3/12 p-3 border border-gray-300 rounded-lg text-[#999999] text-sm bg-[#F8F7F3]" required>
                    @foreach ($brands as $brand)
                        <option value="{{ $brand->brand_id }}" {{ $brand->brand_id == $product->brand_id ? 'selected' : '' }}>{{ $brand->brand }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-4 flex items-center">
                <label for="series" class="block text-[#3C4043] font-MadeTomy-Regular w-32">Series:</label>
                <input type="text" id="series" name="series" class="w-11/12 p-2 border border-gray-300 rounded-lg bg-[#F8F7F3]" value="{{ $product->series }}" required>
            </div>
            <div class="mb-4 flex items-center">
                <label for="price" class="block text-[#3C4043] font-MadeTomy-Regular w-32">Price:</label>
                <input type="text" id="price" name="price" class="w-11/12 p-2 border border-gray-300 rounded-lg bg-[#F8F7F3]" value="{{ $product->price }}" required>
            </div>
            <div class="mb-4 flex items-center">
                <label for="description" class="block text-[#3C4043] font-MadeTomy-Regular w-32">Description:</label>
                <textarea id="description" name="description" class="w-11/12 p-2 border border-gray-300 rounded-lg h-32 bg-[#F8F7F3]" required>{{ $product->description }}</textarea>
            </div>
            <div class="mb-4 flex items-center">
                <label for="materials" class="block text-[#3C4043] font-MadeTomy-Regular w-32">Materials:</label>
                <select id="materials" name="material_id" class="w-3/12 p-3 border border-gray-300 rounded-lg text-[#999999] text-sm bg-[#F8F7F3]" required>
                    @foreach ($materials as $material)
                        <option value="{{ $material->material_id }}" {{ $material->material_id == $product->material_id ? 'selected' : '' }}>{{ $material->material }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-4 flex items-center">
                <label for="category_id" class="block text-[#3C4043] font-MadeTomy-Regular w-32">Category:</label>
                <select id="category_id" name="category_id" class="w-3/12 p-3 border border-gray-300 rounded-lg text-[#999999] text-sm bg-[#F8F7F3]" required>
                    @foreach ($categories as $category)
                        <option value="{{ $category->category_id }}" {{ $category->category_id == $product->category_id ? 'selected' : '' }}>{{ $category->category }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-4 flex">
                <label for="category_id" class="block text-[#3C4043] font-MadeTomy-Regular w-32 pt-8">Select Size:</label>
                <div class="w-64 p-4 bg-[#F8F7F3] rounded shadow-lg">
                    <div class="space-y-2">
                    @foreach ([36, 37, 38, 39, 40] as $size)
                    <div class="flex items-center justify-between border border-gray-300 py-2 px-2 rounded-lg">
                        <span class="block w-12 text-center">{{ $size }}</span>
                        <input type="number" name="sizes[{{ $size }}]" class="block w-4/12 ml-auto px-3 py-2 bg-[#F8F7F3] border border-gray-300 rounded-md shadow-inner focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" value="{{ $stocks->firstWhere('size', $size)->total_stock ?? '' }}">
                    </div>
                    @endforeach
                    </div>
                </div>
            </div>
            <div class="flex justify-end pt-4">
                <button type="submit" class="px-8 py-3 bg-[#04238E] text-white rounded-lg text-sm font-MadeTomy-Regular shadow-md">Save Changes</button>
            </div>
        </form>
    </div>
</main>
@endsection

@section('script')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function showPreview(event, previewId) {
        if (event.target.files.length > 0) {
            var src = URL.createObjectURL(event.target.files[0]);
            var preview = document.getElementById(previewId);
            preview.src = src;
            preview.style.display = "block";
        }
    }
    // Function to show image preview
    function showPreview(event, previewId) {
        if (event.target.files.length > 0) {
            var src = URL.createObjectURL(event.target.files[0]);
            var preview = document.getElementById(previewId);
            preview.src = src;
            preview.style.display = "block";
        }
    }

    // Function to handle form submission with confirmation
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('editProduct').addEventListener('submit', function(e) {
            e.preventDefault(); // Prevent the form from submitting immediately

            Swal.fire({
                title: 'Are you sure?',
                text: "Do you want to save the changes?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, save changes!'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Submit the form if user confirms
                    e.target.submit();
                }
            });
        });
    });

</script>
@endsection

