@extends('../layout/sidebar')

@section('head')
<title>Add-products - SKO</title>
@endsection

@section('content')
<main class="flex-1 overflow-y-auto px-8 pb-6">
    <div class="mb-4 pt-4">
        <h1 class="text-xl font-MadeTomy-Medium text-[#3C4043]">Products</h1>
    </div>
    <div class="max-w-full mx-auto bg-[#F8F7F3] px-8 py-4 rounded-xl shadow-lg">
        <form id="addProduct" action="/products1" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-4 flex items-center">
                <label for="photo" class="block text-[#3C4043] font-MadeTomy-Regular w-32">Photo Product:</label>
                <div class="flex space-x-4 w-3/4">
                    <div class="relative">
                        <button type="button" class="w-16 h-16 border border-gray-300 rounded-lg bg-gray-100 flex items-center justify-center text-2xl" onclick="document.getElementById('photo-input-1').click()">+</button>
                        <input id="photo-input-1" type="file" class="hidden-file-input" name="image" accept="image/*" onchange="showPreview(event, 'preview-1')" required>
                        <img id="preview-1" class="absolute top-0 left-0 w-16 h-16 object-cover rounded-lg" style="display: none;">
                    </div>
                </div>
            </div>
            <div class="mb-4 flex items-center">
                <label for="brand_id" class="block text-[#3C4043] font-MadeTomy-Regular w-32">Brand:</label>
                <select id="brand_id" name="brand_id" class="w-3/12 p-3 border border-gray-300 rounded-lg text-[#999999] text-sm bg-[#F8F7F3]" required>
                    <option value="">Select Brand</option>
                    @foreach ($brands as $brand)
                        <option value="{{ $brand->brand_id }}">{{ $brand->brand }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-4 flex items-center">
                <label for="series" class="block text-[#3C4043] font-MadeTomy-Regular w-32">Series:</label>
                <input type="text" id="series" name="series" class="w-11/12 p-2 border border-gray-300 rounded-lg bg-[#F8F7F3]" required>
            </div>
            <div class="mb-4 flex items-center">
                <label for="price" class="block text-[#3C4043] font-MadeTomy-Regular w-32">Price:</label>
                <input type="text" id="price" name="price" class="w-11/12 p-2 border border-gray-300 rounded-lg bg-[#F8F7F3]" required>
            </div>
            <div class="mb-4 flex items-center">
                <label for="description" class="block text-[#3C4043] font-MadeTomy-Regular w-32">Description:</label>
                <textarea id="description" name="description" class="w-11/12 p-2 border border-gray-300 rounded-lg h-32 bg-[#F8F7F3]" required></textarea>
            </div>
            <div class="mb-4 flex items-center">
                <label for="materials" class="block text-[#3C4043] font-MadeTomy-Regular w-32">Materials:</label>
                <select id="materials" name="material_id" class="w-3/12 p-3 border border-gray-300 rounded-lg text-[#999999] text-sm bg-[#F8F7F3]" required>
                    @foreach ($materials as $material)
                        <option value="{{ $material->material_id }}">{{ $material->material }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-4 flex items-center">
                <label for="category_id" class="block text-[#3C4043] font-MadeTomy-Regular w-32">Category:</label>
                <select id="category_id" name="category_id" class="w-3/12 p-3 border border-gray-300 rounded-lg text-[#999999] text-sm bg-[#F8F7F3]" required>
                    @foreach ($categories as $category)
                        <option value="{{ $category->category_id }}">{{ $category->category }}</option>
                    @endforeach
                </select>
            </div>
            <div class="flex justify-end space-x-4">
                <a type="button" href="{{ route('products') }}" class="bg-[#B90000] text-white py-3 px-6 rounded-lg hover:bg-red-600 text-sm">Cancel</a>
                <button type="submit"  form="addProduct" class="bg-[#187900] text-white py-3 px-7 rounded-lg hover:bg-green-600 text-sm">Save</button>
            </div>
        </form>
    </div>
</main>
@endsection

@section('script')
<script>
    function showPreview(event, previewId) {
        const input = event.target;
        const preview = document.getElementById(previewId);
        const reader = new FileReader();

        reader.onload = function(){
            preview.src = reader.result;
            preview.style.display = 'block';
        };

        reader.readAsDataURL(input.files[0]);
    }
</script>
@endsection
