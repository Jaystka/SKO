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
                class="hidden absolute pt-4 bg-white shadow-lg rounded-lg max-w-[150px] w-full top-full lg:block lg:static lg:max-w-fit lg:shadow-none lg:bg-transparent lg:pl-20">
                <ul id="navbar-nav" class="block lg:flex">
                    <li class="group"><a
                            class="mx-8 py-2 lg:py-0 lg:mx-14 after:border-b-[1px] after:{{ $textColor ?? null == 'text-white' ? 'border-white' : 'border-[#3c4043]' }}"
                            href="/">Home</a></li>
                    <li class="group"><a
                            class="mx-8 py-2 lg:py-0 lg:mx-14 after:border-b-[1px] after:{{ $textColor ?? null == 'text-white' ? 'border-white' : 'border-[#3c4043]' }}"
                            href="shop">Shop</a></li>
                    <li class="group"><a
                            class="mx-8 py-2 lg:py-0 lg:mx-14 after:border-b-[1px] after:{{ $textColor ?? null == 'text-white' ? 'border-white' : 'border-[#3c4043]' }}"
                            href="ourstory">Our Story</a></li>
                    <li class="group"><a
                            class="mx-8 py-2 lg:py-0 lg:mx-14 after:border-b-[1px] after:{{ $textColor ?? null == 'text-white' ? 'border-white' : 'border-[#3c4043]' }}"
                            href="blog">Blog</a></li>
                </ul>
            </div>

            <!-- Start Search -->
            <div class="w-5/6 md:w-1/4 xl:w-1/5">
                <form class="flex mx-3" action="">
                    <input class="focus:outline-none w-full mr-5 rounded-lg px-2" type="text" />
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

            <!-- Start Profile Icon -->
            <div class="relative inline-block text-left">
                <button onclick="toggleDropdown('profileDropdown')"
                    class="profile-button flex items-center focus:outline-none">
                    <img class="w-8 h-8 rounded-full" src="img/logo.png" alt="Profile">
                </button>
                <!-- Dropdown menu -->
                <div id="profileDropdown"
                    class="dropdown-content hidden right-0 left-auto absolute mt-5 w-80 max-w-40 rounded-md shadow-lg bg-white">
                    <div class="py-3 px-5 m-2 bg-gray-100 rounded-t-lg">
                        <p class="text-sm text-gray-500">Signed in as</p>
                        <p class="text-sm font-medium text-gray-800">skolocal@sko.com</p>
                    </div>
                    <div class="mt-2 py-3 first:pt-3 last:pb-4">
                        <a class="py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-black hover:text-white focus:outline-none focus:bg-black mb-1"
                            href="profile" style="display: flex;column-gap: 7px">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor"
                                class="bi bi-person" viewBox="0 0 16 16">
                                <path
                                    d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0m4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4m-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10s-3.516.68-4.168 1.332c-.678.678-.83 1.418-.832 1.664z" />
                            </svg>
                            <p class="transition-colors duration-300">Profile</p>
                        </a>
                        <a class="flex items-center gap-32 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-black hover:text-white focus:outline-none focus:bg-black mb-1"
                            href="cart" style="display: flex;column-gap: 7px">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor"
                                class="bi bi-cart" viewBox="0 0 16 16">
                                <path
                                    d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5M3.102 4l1.313 7h8.17l1.313-7zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4m7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4m-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2m7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2" />
                            </svg>
                            <span class="transition-colors duration-300">Cart</span>
                        </a>
                        <a class="flex items-center gap-x-32 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-black hover:text-white focus:outline-none focus:bg-black"
                            href="login" style="display: flex;column-gap: 7px">
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
            <!-- End Profile Icon -->
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
    @yield('script')
</body>
@endsection