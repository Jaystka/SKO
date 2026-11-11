@extends('layout.main')

@section('head')
<title>Profile - SKO</title>
@endsection

@section('content')
<section class="flex items-center justify-center py-12 min-h-screen">
  <div class="p-6 md:p-12 rounded-lg max-w-4xl w-full mx-4 pt-24">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
      <div class="flex flex-col items-center justify-around shadow-2xl rounded-3xl p-6">
        <img src="{{ $customer->avatar_url }}" alt="Foto profil" class="w-72 aspect-square rounded-full shadow-md">
      </div>
      <div class="flex flex-col gap-y-10">
        <h2 class="text-2xl mb-4 font-medium bodycopy">Profile</h2>
        <div class="flex border-b-2 border-y-gray-400">
          <p class="text-lg w-1/3 font-bold bodycopy">Username</p>
          <p class="text-lg w-2/3">{{ $customer->username }}</p>
        </div>
        <div class="flex border-b-2 border-y-gray-400">
          <p class="text-lg w-1/3 font-bold bodycopy">Name</p>
          <p class="text-lg w-2/3">{{ $customer->name ?: '-' }}</p>
        </div>
        <div class="flex border-b-2 border-y-gray-400">
          <p class="text-lg w-1/3 font-bold bodycopy">Email</p>
          <p class="text-lg w-2/3">{{ $customer->email }}</p>
        </div>
        <div class="flex border-b-2 border-y-gray-400">
          <p class="text-lg w-1/3 font-bold bodycopy">Phone</p>
          <p class="text-lg w-2/3">{{ $customer->phone ?: '-' }}</p>
        </div>
        <div class="flex border-b-2 border-y-gray-400">
          <p class="text-lg w-1/3 font-bold bodycopy">Address</p>
          <p class="text-lg w-2/3">{{ $customer->address ?: '-' }}</p>
        </div>
        <a class="self-end mt-4 w-fit py-5 px-10 bg-[#FFF3B2] hover:bg-black text-gray-800 hover:text-white rounded-xl shadow-md bodycopy"
          href="{{ route('editprofile.index') }}">Edit</a>
      </div>
    </div>
  </div>
</section>
@endsection
