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
        <form>
            <div class="mb-4 flex items-center">
                <label for="photo" class="block text-[#3C4043] font-MadeTomy-Regular w-32">Photo Product:</label>
                <div class="flex space-x-4 w-3/4">
                <div class="relative">
                        <button type="button" class="w-16 h-16 border border-gray-300 rounded-lg bg-gray-100 flex items-center justify-center text-2xl" onclick="document.getElementById('photo-input-1').click()">+</button>
                        <input id="photo-input-1" type="file" class="hidden-file-input" accept="image/*" onchange="showPreview(event, 'preview-1')">
                        <img id="preview-1" class="absolute top-0 left-0 w-16 h-16 object-cover rounded-lg" style="display: none;">
                    </div>
                    <div class="relative">
                        <button type="button" class="w-16 h-16 border border-gray-300 rounded-lg bg-gray-100 flex items-center justify-center text-2xl" onclick="document.getElementById('photo-input-2').click()">+</button>
                        <input id="photo-input-2" type="file" class="hidden-file-input" accept="image/*" onchange="showPreview(event, 'preview-2')">
                        <img id="preview-2" class="absolute top-0 left-0 w-16 h-16 object-cover rounded-lg" style="display: none;">
                    </div>
                    <div class="relative">
                        <button type="button" class="w-16 h-16 border border-gray-300 rounded-lg bg-gray-100 flex items-center justify-center text-2xl" onclick="document.getElementById('photo-input-3').click()">+</button>
                        <input id="photo-input-3" type="file" class="hidden-file-input" accept="image/*" onchange="showPreview(event, 'preview-3')">
                        <img id="preview-3" class="absolute top-0 left-0 w-16 h-16 object-cover rounded-lg" style="display: none;">
                    </div>
                </div>
            </div>
            <div class="mb-4 flex items-center">
                <label for="" class="block text-[#3C4043] font-MadeTomy-Regular w-32">Name Product:</label>
                <input type="text" id="" name="" class="w-11/12 p-2 border border-gray-300 rounded-lg bg-[#F8F7F3]">
            </div>
            <div class="mb-4 flex items-center">
                <label for="price" class="block text-[#3C4043] font-MadeTomy-Regular w-32">Price:</label>
                <input type="text" id="price" name="price" class="w-11/12 p-2 border border-gray-300 rounded-lg bg-[#F8F7F3]">
            </div>
            <div class="mb-4 flex items-center">
                <label for="description" class="block text-[#3C4043] font-MadeTomy-Regular w-32">Description:</label>
                <textarea id="description" name="description" class="w-11/12 p-2 border border-gray-300 rounded-lg h-32 bg-[#F8F7F3]"></textarea>
            </div>
            <div class="mb-4 flex items-center">
                <label for="materials" class="block text-[#3C4043] font-MadeTomy-Regular w-32">Materials:</label>
                <div class="flex items-center space-x-4 w-5/12">
                    <select id="materials" name="materials" class="p-3 border border-gray-300 rounded-lg flex-1 text-[#999999] text-sm bg-[#F8F7F3]">
                        <option value="">Select Materials</option>
                        <!-- Add material options here -->
                    </select>
                    <label class="flex items-center text-[#999999]">
                        <input type="radio" name="cut" value="low" class="mr-2"> Low Cut
                    </label>
                    <label class="flex items-center text-[#999999]">
                        <input type="radio" name="cut" value="high" class="mr-2"> High Cut
                    </label>
                </div>
            </div>
            <div class="mb-4 flex items-center">
                <label for="size" class="block text-[#3C4043] font-MadeTomy-Regular w-32">Select Size:</label>
                <select id="size" name="size" class="w-3/12 p-3 border border-gray-300 rounded-lg text-[#999999] text-sm bg-[#F8F7F3]">
                    <option value="">Select Size</option>
                    <!-- Add size options here -->
                </select>
            </div>
            <div class="flex justify-end space-x-4">
                <a type="button" href="products" class="bg-[#B90000] text-white py-3 px-6 rounded-lg hover:bg-red-600 text-sm">Cancel</a>
                <a type="submit" class="bg-[#187900] text-white py-3 px-7 rounded-lg hover:bg-green-600 text-sm">Save</a>
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