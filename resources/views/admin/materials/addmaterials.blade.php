@extends('../layout/sidebar')

@section('head')
<title>Add Materials - SKO</title>
@endsection

@section('content')
<main class="flex-1 overflow-y-auto px-8 pb-6">
    <div class="mb-4 pt-4">
        <h1 class="text-xl font-MadeTomy-Medium text-[#3C4043]">Add Material</h1>
    </div>
    <div class="max-w-full mx-auto bg-[#F8F7F3] px-8 py-4 rounded-xl shadow-lg">
        <form id="addmaterials" action="{{ route('storematerials') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-4 flex items-center">
                <label for="material" class="block text-[#3C4043] font-MadeTomy-Regular w-32">Material:</label>
                <input type="text" id="material" name="material" class="w-11/12 p-2 border border-gray-300 rounded-lg bg-[#F8F7F3]" required>
            </div>
            <div class="mb-4 flex items-center">
                <label for="material_desc" class="block text-[#3C4043] font-MadeTomy-Regular w-32">Description:</label>
                <input type="text" id="material_desc" name="material_desc" class="w-11/12 p-2 border border-gray-300 rounded-lg bg-[#F8F7F3]" required>
            </div>
            <div class="flex justify-end space-x-4">
                <a type="button" href="{{ route('materials') }}" class="bg-[#B90000] text-white py-3 px-6 rounded-lg hover:bg-red-600 text-sm">Cancel</a>
                <button type="submit" class="bg-[#187900] text-white py-3 px-7 rounded-lg hover:bg-green-600 text-sm">Save</button>
            </div>
        </form>
    </div>
</main>
@endsection
