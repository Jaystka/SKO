@php
    $product = $product ?? null;
    $stockMap = isset($stocks) ? $stocks->pluck('total_stock', 'size') : collect();
    $fieldClass = 'w-11/12 p-2 border border-gray-300 rounded-lg bg-[#F8F7F3]';
    $selectClass = 'w-3/12 p-3 border border-gray-300 rounded-lg text-sm bg-[#F8F7F3]';
@endphp

<div class="mb-4 flex items-center">
    <label for="photo-input-1" class="block text-[#3C4043] font-MadeTomy-Regular w-32">Photo Product:</label>
    <div class="flex space-x-4 w-3/4 items-center">
        <div class="relative">
            <button type="button" class="w-16 h-16 border border-gray-300 rounded-lg bg-gray-100 flex items-center justify-center text-2xl"
                onclick="document.getElementById('photo-input-1').click()" aria-label="Pilih gambar">+</button>
            <input id="photo-input-1" type="file" class="hidden-file-input" name="image" accept="image/png,image/jpeg,image/webp"
                onchange="showPreview(event, 'preview-1')">
            <img id="preview-1" src="{{ $product?->image_url }}" alt=""
                class="absolute top-0 left-0 w-16 h-16 object-cover rounded-lg" style="{{ $product ? '' : 'display: none;' }}">
        </div>
        <span class="text-xs text-gray-500">JPG/PNG/WebP, maks. 2 MB{{ $product ? ' — kosongkan bila tidak diganti' : '' }}</span>
    </div>
</div>
@error('image')<p class="sko-field-error mb-4 pl-32">{{ $message }}</p>@enderror

<div class="mb-4 flex items-center">
    <label for="brand_id" class="block text-[#3C4043] font-MadeTomy-Regular w-32">Brand:</label>
    <select id="brand_id" name="brand_id" class="{{ $selectClass }}" required>
        <option value="">Select Brand</option>
        @foreach ($brands as $brand)
        <option value="{{ $brand->brand_id }}" @selected(old('brand_id', $product?->brand_id) == $brand->brand_id)>{{ $brand->brand }}</option>
        @endforeach
    </select>
</div>
@error('brand_id')<p class="sko-field-error mb-4 pl-32">{{ $message }}</p>@enderror

<div class="mb-4 flex items-center">
    <label for="series" class="block text-[#3C4043] font-MadeTomy-Regular w-32">Series:</label>
    <input type="text" id="series" name="series" class="{{ $fieldClass }}" maxlength="150"
        value="{{ old('series', $product?->series) }}" required>
</div>
@error('series')<p class="sko-field-error mb-4 pl-32">{{ $message }}</p>@enderror

<div class="mb-4 flex items-center">
    <label for="price" class="block text-[#3C4043] font-MadeTomy-Regular w-32">Price (IDR):</label>
    <input type="text" id="price" name="price" class="{{ $fieldClass }}" inputmode="numeric" placeholder="250000"
        value="{{ old('price', $product?->price) }}" required>
</div>
@error('price')<p class="sko-field-error mb-4 pl-32">{{ $message }}</p>@enderror

<div class="mb-4 flex items-center">
    <label for="description" class="block text-[#3C4043] font-MadeTomy-Regular w-32">Description:</label>
    <textarea id="description" name="description" class="{{ $fieldClass }} h-32" maxlength="5000" required>{{ old('description', $product?->description) }}</textarea>
</div>
@error('description')<p class="sko-field-error mb-4 pl-32">{{ $message }}</p>@enderror

<div class="mb-4 flex items-center">
    <label for="material_id" class="block text-[#3C4043] font-MadeTomy-Regular w-32">Materials:</label>
    <select id="material_id" name="material_id" class="{{ $selectClass }}" required>
        <option value="">Select Material</option>
        @foreach ($materials as $material)
        <option value="{{ $material->material_id }}" @selected(old('material_id', $product?->material_id) == $material->material_id)>{{ $material->material }}</option>
        @endforeach
    </select>
</div>
@error('material_id')<p class="sko-field-error mb-4 pl-32">{{ $message }}</p>@enderror

<div class="mb-4 flex items-center">
    <label for="category_id" class="block text-[#3C4043] font-MadeTomy-Regular w-32">Category:</label>
    <select id="category_id" name="category_id" class="{{ $selectClass }}" required>
        <option value="">Select category</option>
        @foreach ($categories as $category)
        <option value="{{ $category->category_id }}" @selected(old('category_id', $product?->category_id) == $category->category_id)>{{ $category->category }}</option>
        @endforeach
    </select>
</div>
@error('category_id')<p class="sko-field-error mb-4 pl-32">{{ $message }}</p>@enderror

<div class="mb-4 flex">
    <span class="block text-[#3C4043] font-MadeTomy-Regular w-32 pt-8">Stok per Size:</span>
    <div class="w-64 p-4 bg-[#F8F7F3] rounded shadow-lg">
        <div class="space-y-2">
            @foreach ($sizes as $size)
            <div class="flex items-center justify-between border border-gray-300 py-2 px-2 rounded-lg">
                <label for="size-{{ $size }}" class="block w-12 text-center">{{ $size }}</label>
                <input type="number" min="0" step="1" id="size-{{ $size }}" name="sizes[{{ $size }}]"
                    value="{{ old('sizes.'.$size, $stockMap[$size] ?? '') }}"
                    class="block w-4/12 ml-auto px-3 py-2 bg-[#F8F7F3] border border-gray-300 rounded-md shadow-inner focus:outline-none sm:text-sm">
            </div>
            @endforeach
        </div>
        <p class="text-xs text-gray-500 pt-2">Kosongkan untuk ukuran yang tidak dijual. Isi 0 bila habis.</p>
    </div>
</div>
@error('sizes.*')<p class="sko-field-error mb-4 pl-32">{{ $message }}</p>@enderror

<div class="flex justify-end space-x-4">
    <a href="{{ route('products') }}" class="bg-[#B90000] text-white py-3 px-6 rounded-lg hover:bg-red-600 text-sm">Cancel</a>
    <button type="submit" class="bg-[#187900] text-white py-3 px-7 rounded-lg hover:bg-green-600 text-sm">Save</button>
</div>

