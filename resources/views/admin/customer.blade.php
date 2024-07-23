@extends('../layout/sidebar')

@section('head')
<title>Customers - SKO</title>
@endsection

@section('content')
<main class="flex-1 overflow-y-auto px-8">
  <!----------------------------- Batas contain ---------------------------------------------------->
  <div class="max-w-7xl mx-auto pt-4">
    <div class="flex justify-between items-center">
        <div class="mb-10 pb-2">
        <h1 class="text-xl font-MadeTomy-Medium">Customers</h1>
        </div>
    </div>
    <div class="bg-[#F8F7F3] px-6 pb-6 pt-2 rounded-xl shadow-xl">
        <div class="overflow-x-auto">
          <div class="min-w-full space-y-3 px-4 pb-7">
              <div class="grid grid-cols-12 px-4 border-gray-200 text-sm font-bold text-gray-500">
                  <div class="col-span-1 flex items-center justify-center">No</div>
                  <div class="col-span-2 -ml-6 md:-ml-4">Name</div>
                  <div class="col-span-2 text-center">Email</div>
                  <div class="col-span-2 text-center">Phone</div>
                  <div class="col-span-3 text-center">Address</div>
                  <div class="col-span-2 text-center">Profile Picture</div>
              </div>
              @foreach($customers as $index => $customer)
              <div class="grid grid-cols-12 py-4 px-4 border-b border-gray-200 shadow-lg rounded-xl">
                  <div class="col-span-1 flex items-center justify-center">{{ $index + 1 }}</div>
                  <div class="col-span-2 flex items-center -ml-6 md:-ml-4">{{ $customer->name }}</div>
                  <div class="col-span-2 flex items-center justify-center">{{ $customer->email }}</div>
                  <div class="col-span-2 flex items-center justify-center">{{ $customer->phone ?? 'N/A' }}</div>
                  <div class="col-span-3 flex items-center justify-center text-sm">{{ $customer->address ?? 'N/A' }}</div>
                  <div class="col-span-2 flex items-center justify-center">
                      @if($customer->profile_picture)
                          <img src="{{ asset($customer->profile_picture) }}" class="w-20 h-20 object-contain rounded-full border border-gray-300" style="display: block;">
                      @else
                          <img src="../dist/img/default-avatar.png" class="w-20 h-20 object-contain rounded-full border border-gray-300" style="display: block;">
                      @endif
                  </div>
              </div>    
              @endforeach
          </div>
        </div>
      </div>
    </div>
</main>
@endsection
