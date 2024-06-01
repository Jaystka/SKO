@extends('../layout/main')

@section('head')
<title>Home - SKO</title>
@endsection

@section('content')

<main class="container px-4 md:px-28 pt-36 text-[#3C4043]">
  <div class="flex flex-wrap ">
    <!-- Left Column -->
    <div class="w-full lg:w-1/4 items-start">
      <div class="flex flex-col space-y-2">
        <div class="flex items-center space-x-4">
          <div
            class=" rounded-2xl h-16 w-16 p-2 shadow-xl flex justify-center items-center text-center outline outline-1 bg-[#F0EEE5]">
            <p class="font-MadeTomy-Regular">12Oz</p>
          </div>
          <span>Using 12oz canvas material</span>
        </div>
        <div class="flex items-center space-x-4 py-8">
          <div
            class="rounded-2xl h-16 w-16 p-2 shadow-xl flex justify-center items-center text-center outline outline-1 bg-[#F0EEE5]">
            <p class="font-MadeTomy-Regular">Low Cut</p>
          </div>
          <span>Low cut shoes</span>
        </div>
      </div>

      <div class="bg-[#F0EEE5] p-4 rounded-3xl shadow-xl w-3/4 outline outline-1">
        <h3 class="text-center mb-2 out">Size chart</h3>
        <table class="w-full text-center">
          <thead class="border-b-2 border-black">
            <tr>
              <th class="font-medium w-1/2">Size</th>
              <th class="font-medium">CM</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td class="border-r-2 border-black">36</td>
              <td>24CM</td>
            </tr>
            <tr>
              <td class="border-r-2 border-black">37</td>
              <td>24.5CM</td>
            </tr>
            <tr>
              <td class="border-r-2 border-black">38</td>
              <td>25CM</td>
            </tr>
            <tr>
              <td class="border-r-2 border-black">39</td>
              <td>26CM</td>
            </tr>
            <tr>
              <td class="border-r-2 border-black">40</td>
              <td>26.5CM</td>
            </tr>
            <tr>
              <td class="border-r-2 border-black">41</td>
              <td>27CM</td>
            </tr>
            <tr>
              <td class="border-r-2 border-black">42</td>
              <td>27.5CM</td>
            </tr>
            <tr>
              <td class="border-r-2 border-black">43</td>
              <td>28.5CM</td>
            </tr>
            <tr>
              <td class="border-r-2 border-black">44</td>
              <td>29CM</td>
            </tr>
            <tr>
              <td class="border-r-2 border-black">45</td>
              <td>29.5CM</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>

    <!-- Center Column -->
    <div class="w-full lg:w-2/4 items-center justify-center space-y-6">
      <div class="relative ">
        <div class="flex justify-center"><img src="dist/img/Cmp2.png" alt="Proto Lite Purple" class=" w-[80%]"></div>
        <div class="flex justify-center mt-4 space-x-2">
          <img src="dist/img/Cmp2.png" alt="Proto Lite Purple" class="w-16 h-16 object-cover rounded-lg shadow-md">
          <img src="dist/img/Cmp2.png" alt="Proto Lite Purple" class="w-16 h-16 object-cover rounded-lg shadow-md">
        </div>
        <button class="absolute left-10 top-1/2 transform -translate-y-1/2" onclick="scrollLeft('productImages')"
          aria-label="Scroll Left">
          <svg class="w-6 h-6 text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24"
            xmlns="http://www.w3.org/2000/svg">
            <line x1="15" y1="19" x2="9" y2="12" stroke-width="2" stroke-linecap="round" />
            <line x1="9" y1="12" x2="15" y2="5" stroke-width="2" stroke-linecap="round" />
          </svg>
        </button>
        <button class="absolute right-10 top-1/2 transform -translate-y-1/2" onclick="scrollRight('productImages')"
          aria-label="Scroll Right">
          <svg class="w-6 h-6 text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24"
            xmlns="http://www.w3.org/2000/svg">
            <line x1="9" y1="19" x2="15" y2="12" stroke-width="2" stroke-linecap="round" />
            <line x1="15" y1="12" x2="9" y2="5" stroke-width="2" stroke-linecap="round" />
          </svg>
        </button>

      </div>
    </div>

    <!-- Right Column -->
    <div class="w-full lg:w-1/4 items-center md:items-start">
      <div class="space-y-2 text-center md:text-left">
        <div class="flex items-center justify-center md:justify-start">
          <span class="text-yellow-500">★★</span>
          <span class="pl-2">372 Reviews</span>
        </div>
        <div class="py-5">
          <h2 class="text-2xl font-bold">Sepatu Compass</h2>
          <h1 class="text-3xl font-MadeTomy-Bold">Proto Lite Purple</h1>
        </div>
        <p class="text-red-600 text-xl font-MadeTomy-Medium">IDR 578.000</p>

        <div class="grid grid-cols-5 gap-2 my-4">
          <label class="cursor-pointer">
            <input id="option1" name="size" class="peer sr-only" type="radio" value="1">
            <div
              class="p-2 border rounded text-center text-gray-600 transition-all hover:shadow peer-checked:bg-third peer-checked:text-fourth peer-checked:border-fourth">
              <p>36</p>
            </div>
          </label>
          <label class="cursor-pointer">
            <input id="option2" name="size" class="peer sr-only" type="radio" value="2">
            <div
              class="p-2 border rounded text-center text-gray-600 transition-all hover:shadow peer-checked:bg-third peer-checked:text-fourth peer-checked:border-fourth">
              <p>37</p>
            </div>
          </label>
          <button class="p-2 border rounded">38</button>
          <button class="p-2 border rounded">39</button>
          <button class="p-2 border rounded">40</button>
          <button class="p-2 border rounded">41</button>
          <button class="p-2 border rounded">42</button>
          <button class="p-2 border rounded">43</button>
          <button class="p-2 border rounded">44</button>
          <button class="p-2 border rounded">45</button>
        </div>

        <div class="py-5">
          <p class="font-MadeTomy-Medium">About</p>
          <p class="text-sm text-justify">Following the footsteps of the PROTO 1 article, Compass® RESEARCH & DESTROY
            presents a
            basic variation of its popular predecessor titled PROTO LITE. Signature R&D elements are simplified for a
            more casual wear, while the four bold colours and metallic detail, add a punchy statement to your every
            look.</p>
        </div>
        <div class="flex justify-end"><button
            class="bg-yellow-300 text-black py-4 px-16 rounded-md shadow-md">Buy</button>
        </div>
      </div>
    </div>
  </div>
</main>

<footer class="px-8 py-4 text-center text-black">
  ©SKO 2023. All rights reserved.
</footer>
@endsection