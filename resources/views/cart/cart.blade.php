@extends('../layout/main')

@section('head')
<title>Home - SKO</title>
<link rel="stylesheet" href="dist/css/owl.carousel.min.css">
@endsection

@section('content')
<div class="container mx-auto p-4">
    <div class="">
        <div class="p-20">
            <div class="grid grid-cols-1 md:grid-cols-12 gap-4 border-b py-4">
                <div class="md:col-span-5">
                    <p class="text-gray-500">Description</p>
                </div>
                <div class="md:col-span-2">
                    <p class="text-gray-500">Size</p>
                </div>
                <div class="md:col-span-2">
                    <p class="text-gray-500">Quantity</p>
                </div>
                <div class="md:col-span-1">
                    <p class="text-gray-500">Remove</p>
                </div>
                <div class="md:col-span-2">
                    <p class="text-gray-500">Price</p>
                </div>
            </div>
            <!-- Item 1 -->
            <div class="grid grid-cols-1 md:grid-cols-12 gap-4 border-b py-4 items-center">
                <div class="md:col-span-5 flex items-center">
                    <input type="checkbox" class="mr-2">
                    <img src="img/Cmp2.png" alt="Proto Lite Purple"
                        class="w-16 h-16 md:w-32 md:h-32 mr-4 shadow-xl rounded-xl">
                    <div>
                        <p class="font-semibold">Proto Lite Purple</p>
                        <p class="text-sm text-gray-500">Sepatu Compass</p>
                    </div>
                </div>
                <div class="md:col-span-2">
                    <div class="w-8 text-center">
                        <p class="text-gray-700 shadow-md">41</p>
                    </div>
                </div>
                <div class="md:col-span-2 flex items-center">
                    <button class="bg-[#FFF3B2] text-black px-2 py-1 rounded">+</button>
                    <p class="mx-2 px-4">1</p>
                    <button class="bg-gray-300 text-black px-2 py-1 rounded">-</button>
                </div>
                <div class="md:col-span-1">
                    <button class="text-gray-600 hover:text-gray-800">
                        <div class="flex justify-center items-center class w-10 h-10 shadow-lg rounded-md">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                class="size-6">
                                <path fill-rule="evenodd"
                                    d="M16.5 4.478v.227a48.816 48.816 0 0 1 3.878.512.75.75 0 1 1-.256 1.478l-.209-.035-1.005 13.07a3 3 0 0 1-2.991 2.77H8.084a3 3 0 0 1-2.991-2.77L4.087 6.66l-.209.035a.75.75 0 0 1-.256-1.478A48.567 48.567 0 0 1 7.5 4.705v-.227c0-1.564 1.213-2.9 2.816-2.951a52.662 52.662 0 0 1 3.369 0c1.603.051 2.815 1.387 2.815 2.951Zm-6.136-1.452a51.196 51.196 0 0 1 3.273 0C14.39 3.05 15 3.684 15 4.478v.113a49.488 49.488 0 0 0-6 0v-.113c0-.794.609-1.428 1.364-1.452Zm-.355 5.945a.75.75 0 1 0-1.5.058l.347 9a.75.75 0 1 0 1.499-.058l-.346-9Zm5.48.058a.75.75 0 1 0-1.498-.058l-.347 9a.75.75 0 0 0 1.5.058l.345-9Z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>

                    </button>
                </div>
                <div class="md:col-span-2">
                    <p class="text-[#7C0000]">IDR 578.000</p>
                </div>
            </div>
            <!-- Item 2 -->
            <div class="grid grid-cols-1 md:grid-cols-12 gap-4 border-b py-4 items-center">
                <div class="md:col-span-5 flex items-center">
                    <input type="checkbox" class="mr-2">
                    <img src="img/Cmp3.png" alt="Retrograde Low White Blue"
                        class="w-16 h-16 md:w-32 md:h-32 mr-4 shadow-xl rounded-xl">
                    <div>
                        <p class="font-semibold">Retrograde Low White Blue</p>
                        <p class="text-sm text-gray-500">Sepatu Compass</p>
                    </div>
                </div>
                <div class="md:col-span-2">
                    <div class="w-8 text-center">
                        <p class="text-gray-700 shadow-md">41</p>
                    </div>
                </div>
                <div class="md:col-span-2 flex items-center">
                    <button class="bg-[#FFF3B2] text-black px-2 py-1 rounded">+</button>
                    <p class="mx-2 px-4">1</p>
                    <button class="bg-gray-300 text-black px-2 py-1 rounded">-</button>
                </div>
                <div class="md:col-span-1">
                    <button class="text-gray-600 hover:text-gray-800">
                        <div class="flex justify-center items-center class w-10 h-10 shadow-lg rounded-md">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                class="size-6">
                                <path fill-rule="evenodd"
                                    d="M16.5 4.478v.227a48.816 48.816 0 0 1 3.878.512.75.75 0 1 1-.256 1.478l-.209-.035-1.005 13.07a3 3 0 0 1-2.991 2.77H8.084a3 3 0 0 1-2.991-2.77L4.087 6.66l-.209.035a.75.75 0 0 1-.256-1.478A48.567 48.567 0 0 1 7.5 4.705v-.227c0-1.564 1.213-2.9 2.816-2.951a52.662 52.662 0 0 1 3.369 0c1.603.051 2.815 1.387 2.815 2.951Zm-6.136-1.452a51.196 51.196 0 0 1 3.273 0C14.39 3.05 15 3.684 15 4.478v.113a49.488 49.488 0 0 0-6 0v-.113c0-.794.609-1.428 1.364-1.452Zm-.355 5.945a.75.75 0 1 0-1.5.058l.347 9a.75.75 0 1 0 1.499-.058l-.346-9Zm5.48.058a.75.75 0 1 0-1.498-.058l-.347 9a.75.75 0 0 0 1.5.058l.345-9Z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>

                    </button>
                </div>
                <div class="md:col-span-2">
                    <p class="text-[#7C0000]">IDR 538.000</p>
                </div>
            </div>
            <!-- Item 3 -->
            <div class="grid grid-cols-1 md:grid-cols-12 gap-4 border-b py-4 items-center">
                <div class="md:col-span-5 flex items-center">
                    <input type="checkbox" class="mr-2">
                    <img src="img/Cmp1.png" alt="Gazelle Low Black Gum"
                        class="w-16 h-16 md:w-32 md:h-32 mr-4 shadow-xl rounded-xl">
                    <div>
                        <p class="font-semibold">Gazelle Low Black Gum</p>
                        <p class="text-sm text-gray-500">Sepatu Compass</p>
                    </div>
                </div>
                <div class="md:col-span-2">
                    <div class="w-8 text-center">
                        <p class="text-gray-700 shadow-md">41</p>
                    </div>
                </div>
                <div class="md:col-span-2 flex items-center">
                    <button class="bg-[#FFF3B2] text-black px-2 py-1 rounded">+</button>
                    <p class="mx-2 px-4">1</p>
                    <button class="bg-gray-300 text-black px-2 py-1 rounded">-</button>
                </div>
                <div class="md:col-span-1">
                    <button class="text-gray-600 hover:text-gray-800">
                        <div class="flex justify-center items-center class w-10 h-10 shadow-lg rounded-md">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                class="size-6">
                                <path fill-rule="evenodd"
                                    d="M16.5 4.478v.227a48.816 48.816 0 0 1 3.878.512.75.75 0 1 1-.256 1.478l-.209-.035-1.005 13.07a3 3 0 0 1-2.991 2.77H8.084a3 3 0 0 1-2.991-2.77L4.087 6.66l-.209.035a.75.75 0 0 1-.256-1.478A48.567 48.567 0 0 1 7.5 4.705v-.227c0-1.564 1.213-2.9 2.816-2.951a52.662 52.662 0 0 1 3.369 0c1.603.051 2.815 1.387 2.815 2.951Zm-6.136-1.452a51.196 51.196 0 0 1 3.273 0C14.39 3.05 15 3.684 15 4.478v.113a49.488 49.488 0 0 0-6 0v-.113c0-.794.609-1.428 1.364-1.452Zm-.355 5.945a.75.75 0 1 0-1.5.058l.347 9a.75.75 0 1 0 1.499-.058l-.346-9Zm5.48.058a.75.75 0 1 0-1.498-.058l-.347 9a.75.75 0 0 0 1.5.058l.345-9Z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                    </button>
                </div>
                <div class="md:col-span-2">
                    <p class="text-[#7C0000]">IDR 408.000</p>
                </div>
            </div>
        </div>
        <div class="p-2 flex justify-end">
            <button class="bg-[#FFF3B2] self-end text-black px-4 py-1 rounded w-full md:w-auto">Checkout</button>
        </div>
    </div>
</div>
@endsection