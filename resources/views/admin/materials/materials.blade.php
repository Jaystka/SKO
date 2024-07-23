@extends('../layout/sidebar')

@section('head')
<title>Materials - SKO</title>
@endsection

@section('content')
<main class="flex-1 overflow-y-auto px-8">
  <div class="max-w-7xl mx-auto pt-4">
    <div class="flex justify-between items-center">
        <div class="mb-10 pb-2">
        <h1 class="text-xl font-MadeTomy-Medium">Materials</h1>
        </div>
        <a href="{{ route('addmaterials') }}" class="bg-[#04238E] text-white px-10 py-3 rounded-md text-sm">
          <span class="text-2xl">+ </span><span class="inline-block align-baseline">Add Material</span>
        </a>
    </div>
    <div class="bg-[#F8F7F3] px-6 pb-6 pt-2 rounded-xl shadow-xl">
        <div class="overflow-x-auto">
          <div class="min-w-full space-y-3 px-4 pb-7">
              <div class="grid grid-cols-10 px-4 border-gray-200 text-sm font-bold text-gray-500">
                  <div class="col-span-1 flex items-center justify-center">No</div>
                  <div class="col-span-2 text-center">Material</div>
                  <div class="col-span-4 text-center">Description</div>
                  <div class="col-span-3 text-center">Action</div>
              </div>
              @foreach ($materials as $index => $material)
              <div class="grid grid-cols-10 py-4 px-4 border-b border-gray-200 shadow-lg rounded-xl">
                  <div class="col-span-1 flex items-center justify-center">{{ $index + 1 }}.</div>
                  <div class="col-span-2 flex items-center justify-center">{{$material->material}}</div>
                  <div class="col-span-4 flex items-center justify-center">{{$material->material_desc}}</div>
                  <div class="col-span-3 flex space-x-2 items-center justify-center">
                    <a href="{{ route('editmaterials', $material->material_id) }}" class="bg-yellow-500 text-white p-2 rounded">
                        <svg class="h-6 w-6" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M34.5167 11.7333C35.1667 11.0833 35.1667 10 34.5167 9.38335L30.6167 5.48335C30 4.83335 28.9167 4.83335 28.2667 5.48335L25.2 8.53335L31.45 14.7833M5 28.75V35H11.25L29.6833 16.55L23.4333 10.3L5 28.75Z" fill="white"/>
                        </svg>
                    </a>
                <form action="{{ route('deletematerials', ['id' => $material->material_id]) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                        <button type="submit" class="bg-red-600 text-white p-2 rounded">
                        <svg class="h-6 w-6" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M9.99967 31.6667C9.99967 33.5 11.4997 35 13.333 35H26.6663C28.4997 35 29.9997 33.5 29.9997 31.6667V11.6667H9.99967V31.6667ZM31.6663 6.66667H25.833L24.1663 5H15.833L14.1663 6.66667H8.33301V10H31.6663V6.66667Z" fill="white"/>
                        </svg>
                        </button>
                </form>
                  </div>
              </div>    
              @endforeach
              </div>
          </div>
      </div>
    </div>
</div>
</main>
@endsection
