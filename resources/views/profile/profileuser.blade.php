@extends('../layout/main')

@section('head')
<title>Profile - SKO</title>
@endsection

@section('content')
<section class="flex items-center justify-center py-12 w-screen h-screen">
  <div class="p-6 md:p-12 rounded-lg max-w-4xl w-full mx-4">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
      <!-- Profile Image and Button -->
      <div class="flex flex-col items-center justify-around shadow-2xl rounded-3xl">
        <img src="{{auth()->user()->profile_picture}}" alt="Profile Image"
          class="w-72 aspect-square rounded-full shadow-md">
        <button
          class="mt-4 bg-[#FFF3B2] hover:bg-black text-gray-800 hover:text-white py-4 px-8 rounded-full shadow-md bodycopy">Change</button>

      </div>
      <!-- Profile Details -->
      <div class="flex flex-col gap-y-10">
        <h2 class="text-2xl mb-4 font-medium bodycopy">Profile</h2>
        <div class="flex border-b-2 border-y-gray-400">
          <p class="text-lg w-1/3 font-bold bodycopy">Username</p>
          <p class="text-lg w-2/3">{{auth()->user()->name}}</p>
        </div>
        <div class="flex border-b-2 border-y-gray-400">
          <p class="text-lg w-1/3"><span class="font-bold bodycopy">Email</span></p>
          <p class="text-lg w-2/3"> {{auth()->user()->email}}</p>
        </div>
        <div class="flex border-b-2 border-y-gray-400">
          <p class="text-lg w-1/3"><span class="font-bold bodycopy">Phone</span></p>
          <p class="text-lg w-2/3">{{ auth()->user()->phone == null ? '-' :
            auth()->user()->phone }}</p>
        </div>
        <div class="flex border-b-2 border-y-gray-400">
          <p class="text-lg w-1/3"><span class="font-bold bodycopy">Address</span></p>
          <p class="text-lg w-2/3">{{auth()->user()->address}}</p>
        </div>
        <a class="self-end mt-4 w-fit py-5 px-10 bg-[#FFF3B2] hover:bg-black text-gray-800 hover:text-white rounded-xl shadow-md bodycopy"
          href="editprofile">Edit</a>
      </div>
    </div>
  </div>
</section>
@endsection