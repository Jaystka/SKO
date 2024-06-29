@extends('../layout/base')

@section('body')

<body class="main">
    <!-- Start Navbar -->
    <nav class="navbar absolute z-50 @yield('navClass', 'bg-transparent w-full text-black') py-4 lg:py-2 px-5">
        <div class="px-4 mx-auto items-center flex justify-between relative">
            <!-- Start Menu Button -->
            <div class="lg:hidden flex items-center">
                <button class="outline-none mobile-menu-button">
                    <svg class=" w-6 h-6 text-gray-500 hover:text-gray-400" fill="none" stroke-linecap="round"
                        stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                        <path d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>

            <!-- Start Logo -->
            <div class="px-4">
                <a id="logo" class="py-6 text-xl hidden lg:static lg:block" href="">SKO<sup
                        style="font-family: Poppins; font-size: 14px;">®</sup></a>
            </div>

            <!-- Start Menu Navbar -->
            <div id="nav-menu"
                class="hidden absolute bg-white shadow-lg rounded-lg max-w-[150px] w-full top-full lg:block lg:static lg:max-w-fit lg:shadow-none lg:bg-transparent lg:pl-20">
                <ul id="navbar-nav" class="block lg:flex">
                    <li class="group flex"><a
                            class="mx-8 py-2 lg:py-2 lg:mx-14  after:border-b-[1px]  after:{{ $textColor ?? null == 'text-white' ? 'border-white' : 'border-[#3c4043]' }}"
                            href="{{ route('/') }}">Home</a></li>
                    <li class="group flex"><a
                            class="mx-8 py-2 lg:py-2 lg:mx-14 after:border-b-[1px] after:{{ $textColor ?? null == 'text-white' ? 'border-white' : 'border-[#3c4043]' }}"
                            href="{{ route('shop') }}">Shop</a></li>
                    <li class="group flex"><a
                            class="mx-8 py-2 lg:py-2 lg:mx-14 after:border-b-[1px] after:{{ $textColor ?? null == 'text-white' ? 'border-white' : 'border-[#3c4043]' }}"
                            href="{{ route('ourstory') }}">Our Story</a></li>
                    <li class="group flex"><a
                            class="mx-8 py-2 lg:py-2 lg:mx-14 after:border-b-[1px] after:{{ $textColor ?? null == 'text-white' ? 'border-white' : 'border-[#3c4043]' }}"
                            href="{{ route('blog') }}">Blog</a></li>
                </ul>
            </div>

            <!-- Start Search -->
            <div class="w-5/6 md:w-1/4 xl:w-1/5">
                <form class="flex mx-3" action="">
                    <input class="focus:outline-none w-full mr-5 rounded-lg px-2 text-black" type="text" />
                    <button class="p-[6px] hover:bg-black hover:text-white rounded-full">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </button>
                </form>
            </div>
            <!-- End Search -->

            @auth
            <!-- Start Profile Icon -->
            <div class="flex items-center text-left">
                <!-- Start Cart -->
                <a class="hidden lg:block lg:pr-10" href="cart">
                    <div
                        class="rounded-full p-[6px] text-sm text-gray-800 hover:bg-black hover:text-white focus:outline-none focus:bg-black">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                            <path fill="currentColor"
                                d="M17 18a2 2 0 0 1 2 2a2 2 0 0 1-2 2a2 2 0 0 1-2-2c0-1.11.89-2 2-2M1 2h3.27l.94 2H20a1 1 0 0 1 1 1c0 .17-.05.34-.12.5l-3.58 6.47c-.34.61-1 1.03-1.75 1.03H8.1l-.9 1.63l-.03.12a.25.25 0 0 0 .25.25H19v2H7a2 2 0 0 1-2-2c0-.35.09-.68.24-.96l1.36-2.45L3 4H1zm6 16a2 2 0 0 1 2 2a2 2 0 0 1-2 2a2 2 0 0 1-2-2c0-1.11.89-2 2-2m9-7l2.78-5H6.14l2.36 5z" />
                        </svg>
                    </div>
                </a>
                <div class="relative">
                    <!-- End Cart -->
                    <button onclick="toggleDropdown('profileDropdown')"
                        class="profile-button flex items-center focus:outline-none">
                        <img class="w-8 h-8 rounded-full" src="{{auth()->user()->profile_picture}}" alt="Profile">
                    </button>
                    <!-- Dropdown menu -->
                    <div id="profileDropdown"
                        class="dropdown-content hidden right-0 left-auto absolute mt-5 w-80 max-w-40 rounded-md shadow-lg bg-white">
                        <div class="py-3 px-5 m-2 bg-gray-100 rounded-t-lg">
                            <p class="text-sm text-gray-500">Signed in as</p>
                            <p class="text-sm font-medium text-gray-800 uppercase">{{auth()->user()->name}}</p>
                        </div>
                        <div class="mt-2 py-3 first:pt-3 last:pb-4">
                            <a class="py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-black hover:text-white focus:outline-none focus:bg-black mb-1"
                                href="{{ route('profileView') }}" style="display: flex;column-gap: 7px">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor"
                                    class="bi bi-person" viewBox="0 0 16 16">
                                    <path
                                        d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0m4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4m-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10s-3.516.68-4.168 1.332c-.678.678-.83 1.418-.832 1.664z" />
                                </svg>
                                <p class="transition-colors duration-300">Profile</p>
                            </a>
                            <a class="flex items-center gap-32 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-black hover:text-white focus:outline-none focus:bg-black mb-1"
                                href="{{ route('cart.index') }}" style="display: flex;column-gap: 7px">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor"
                                    class="bi bi-cart" viewBox="0 0 16 16">
                                    <path
                                        d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5M3.102 4l1.313 7h8.17l1.313-7zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4m7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4m-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2m7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2" />
                                </svg>
                                <span class="transition-colors duration-300">Cart</span>
                            </a>
                            <a class="flex items-center gap-x-32 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-black hover:text-white focus:outline-none focus:bg-black"
                                href="{{ route('logout') }}" style="display: flex;column-gap: 7px">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor"
                                    class="bi bi-box-arrow-right" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd"
                                        d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0z" />
                                    <path fill-rule="evenodd"
                                        d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708z" />
                                </svg>
                                <span class="transition-colors duration-300">Logout</span>
                            </a>
                        </div>
                    </div>
                </div>

            </div>
            <!-- End Profile Icon -->
            @endauth

            @guest
            <div class="relative inline-block text-left">
                <a href="{{ route('login') }}">
                    <div class="rounded-full  {{ $textColor ?? null == 'text-white' ? 'border-white' : 'border-[#3c4043]' }}""><svg xmlns="
                        http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 1024 1024">
                        <path fill="currentColor"
                            d="M521.7 82c-152.5-.4-286.7 78.5-363.4 197.7c-3.4 5.3.4 12.3 6.7 12.3h70.3c4.8 0 9.3-2.1 12.3-5.8c7-8.5 14.5-16.7 22.4-24.5c32.6-32.5 70.5-58.1 112.7-75.9c43.6-18.4 90-27.8 137.9-27.8s94.3 9.3 137.9 27.8c42.2 17.8 80.1 43.4 112.7 75.9s58.1 70.4 76 112.5C865.7 417.8 875 464.1 875 512s-9.4 94.2-27.8 137.8c-17.8 42.1-43.4 80-76 112.5s-70.5 58.1-112.7 75.9A352.8 352.8 0 0 1 520.6 866c-47.9 0-94.3-9.4-137.9-27.8A353.8 353.8 0 0 1 270 762.3c-7.9-7.9-15.3-16.1-22.4-24.5c-3-3.7-7.6-5.8-12.3-5.8H165c-6.3 0-10.2 7-6.7 12.3C234.9 863.2 368.5 942 520.6 942c236.2 0 428-190.1 430.4-425.6C953.4 277.1 761.3 82.6 521.7 82M395.02 624v-76h-314c-4.4 0-8-3.6-8-8v-56c0-4.4 3.6-8 8-8h314v-76c0-6.7 7.8-10.5 13-6.3l141.9 112a8 8 0 0 1 0 12.6l-141.9 112c-5.2 4.1-13 .4-13-6.3" />
                        </svg>
                    </div>
                </a>
            </div>
            @endguest
        </div>
    </nav>
    <!-- End Navbar -->

    @yield('content')

    <script>
        function toggleDropdown(dropdownId) {
                                    var dropdown = document.getElementById(dropdownId);
                                    dropdown.classList.toggle('hidden');
                                }
                        
                                // Close the dropdown if the user clicks outside of it
                                window.onclick = function(event) {
                                    if (!event.target.matches('.profile-button') && !event.target.matches('.profile-button *')) {
                                        var dropdowns = document.getElementsByClassName("dropdown-content");
                                        for (var i = 0; i < dropdowns.length; i++) {
                                            var openDropdown = dropdowns[i];
                                            if (!openDropdown.classList.contains('hidden')) {
                                                openDropdown.classList.add('hidden');
                                            }
                                        }
                                    }
                                }
    </script>
    <script>
        // Navbar Fixed
        window.onscroll = function(){
        const header = document.querySelector('nav');
        const fixedNav = header.offsetTop;
        
        if(window.pageYOffset > fixedNav){
        header.classList.add('navbar-fixed');
        }else{
        header.classList.remove('navbar-fixed');
        }
        }
        
        //Menu Button
        const btn = document.querySelector("button.mobile-menu-button");
        const menu = document.getElementById("nav-menu");
        btn.addEventListener("click", () => {
        menu.classList.toggle("hidden");
        });
    </script>
    @yield('script')
</body>
@endsection