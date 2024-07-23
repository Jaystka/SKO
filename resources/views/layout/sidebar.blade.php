@extends('../layout/base')

@section('body')

<body class="login">
<div class="flex h-screen bg-[#F8F7F3]">
    <div class="w-60 flex flex-col bg-[#F8F7F3] shadow-2xl">
        <div class="p-12 text-center">
            <h1 class="font-[Azonix] text-5xl">SKO</h1>
        </div>
        <nav class="flex-1 text-left">
            <ul>
                <li class="py-4 px-6 {{ request()->is('dashboard') ? 'bg-[#575757] text-white' : 'hover:bg-[#575757] text-gray-700' }}">
                    <a href="dashboard" class="icon px-5 flex items-center {{ request()->is('dashboard') ? 'text-white' : 'text-gray-700 hover:text-white' }}">
                        <span class="icon_span"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M10.9949 4.68V8.56C10.9949 8.88127 10.9315 9.19938 10.8082 9.49606C10.685 9.79275 10.5044 10.0622 10.2767 10.2889C10.0491 10.5156 9.77892 10.6951 9.48173 10.8171C9.18454 10.9392 8.86618 11.0013 8.54491 11H4.68491C4.36451 11.0019 4.04702 10.9392 3.75147 10.8155C3.45591 10.6917 3.18838 10.5096 2.96491 10.28C2.73848 10.0547 2.5591 9.78657 2.43721 9.49129C2.31533 9.19601 2.25336 8.87944 2.25491 8.56V4.69C2.25491 4.0446 2.5106 3.42549 2.96603 2.96819C3.42146 2.51088 4.03952 2.25265 4.68491 2.25H8.55491C8.87498 2.25031 9.1918 2.3141 9.48704 2.43769C9.78228 2.56128 10.0501 2.74221 10.2749 2.97C10.5029 3.19264 10.684 3.45862 10.8076 3.75228C10.9313 4.04594 10.9949 4.36137 10.9949 4.68ZM21.7449 4.69V8.56C21.7397 9.2038 21.4824 9.81991 21.028 10.2761C20.5737 10.7323 19.9587 10.9922 19.3149 11H15.4349C14.7881 10.996 14.168 10.7416 13.7049 10.29C13.4786 10.0625 13.2994 9.79258 13.1776 9.49572C13.0558 9.19886 12.9937 8.88088 12.9949 8.56V4.69C12.9935 4.36969 13.0566 4.05236 13.1803 3.75689C13.3039 3.46141 13.4858 3.19382 13.7149 2.97C13.9397 2.74221 14.2075 2.56128 14.5028 2.43769C14.798 2.3141 15.1148 2.25031 15.4349 2.25H19.3049C19.9504 2.25523 20.568 2.51398 21.0245 2.97044C21.4809 3.4269 21.7397 4.04449 21.7449 4.69ZM21.7449 15.44V19.31C21.7397 19.9538 21.4824 20.5699 21.028 21.0261C20.5737 21.4823 19.9587 21.7422 19.3149 21.75H15.4349C14.784 21.7566 14.1562 21.5091 13.6849 21.06C13.4577 20.8331 13.278 20.5634 13.1561 20.2664C13.0342 19.9693 12.9726 19.651 12.9749 19.33V15.46C12.9736 15.1397 13.0367 14.8224 13.1603 14.5269C13.284 14.2315 13.4658 13.9639 13.6949 13.74C13.9198 13.5123 14.1876 13.3314 14.4828 13.2078C14.778 13.0842 15.0949 13.0204 15.4149 13.02H19.2849C19.9304 13.0252 20.548 13.284 21.0045 13.7404C21.4609 14.1969 21.7197 14.8145 21.7249 15.46L21.7449 15.44ZM10.9949 15.45V19.32C10.987 19.9655 10.7258 20.582 10.2674 21.0366C9.8091 21.4912 9.19045 21.7474 8.54491 21.75H4.68491C4.36543 21.7513 4.04885 21.6894 3.75343 21.5677C3.45801 21.4461 3.1896 21.2671 2.96369 21.0412C2.73778 20.8153 2.55884 20.5469 2.43719 20.2515C2.31554 19.9561 2.25359 19.6395 2.25491 19.32V15.45C2.25749 14.8045 2.5137 14.1858 2.96829 13.7275C3.42289 13.2691 4.03942 13.0079 4.68491 13H8.55491C9.20333 13.0056 9.82399 13.2639 10.2849 13.72C10.741 14.1801 10.9963 14.8021 10.9949 15.45Z" class="{{ request()->is('dashboard') ? 'fill-white' : 'fill-[#575757] hover:fill-white' }}"/>
                            </svg>
                            </span>
                        <span class="ml-2">Dashboard</span>
                    </a>
                </li>
                <li class="py-4 px-6 {{ request()->is('products') ? 'bg-[#575757] text-white' : 'hover:bg-[#575757] text-gray-700' }}">
                    <a href="products" class="icon px-5 flex items-center {{ request()->is('products') ? 'text-white' : 'text-gray-700 hover:text-white' }} ">
                        <span class="icon_span"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M11.25 1.40625L21 6.28125V18.4688L11.25 23.332L1.5 18.4688V6.28125L11.25 1.40625ZM18.5742 6.75L11.25 3.09375L8.42578 4.5L15.7031 8.17969L18.5742 6.75ZM11.25 10.4062L14.0391 9.02344L6.75 5.34375L3.92578 6.75L11.25 10.4062ZM3 7.96875V17.5312L10.5 21.2812V11.7188L3 7.96875ZM12 21.2812L19.5 17.5312V7.96875L12 11.7188V21.2812Z" class="{{ request()->is('products') ? 'fill-white' : 'fill-[#575757] hover:fill-white' }}"/>
                            </svg>
                            </span>
                        <span class="ml-2">Products</span>
                    </a>
                </li>
                <li class="py-4 px-6 {{ request()->is('category') ? 'bg-[#575757] text-white' : 'hover:bg-[#575757] text-gray-700' }}">
                    <a href="category" class="icon px-5 flex items-center {{ request()->is('category') ? 'text-white' : 'text-gray-700 hover:text-white' }}">
                        <span class="icon_span"><svg width="24" height="24" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path d="M7.425 9.475L11.15 3.4C11.25 3.23333 11.375 3.11233 11.525 3.037C11.675 2.96166 11.8333 2.92433 12 2.925C12.1667 2.92566 12.325 2.96333 12.475 3.038C12.625 3.11266 12.75 3.23333 12.85 3.4L16.575 9.475C16.675 9.64166 16.725 9.81666 16.725 10C16.725 10.1833 16.6833 10.35 16.6 10.5C16.5167 10.65 16.4 10.771 16.25 10.863C16.1 10.955 15.925 11.0007 15.725 11H8.275C8.075 11 7.9 10.9543 7.75 10.863C7.6 10.7717 7.48333 10.6507 7.4 10.5C7.31667 10.3493 7.275 10.1827 7.275 10C7.275 9.81733 7.325 9.64233 7.425 9.475ZM17.5 22C16.25 22 15.1877 21.5627 14.313 20.688C13.4383 19.8133 13.0007 18.7507 13 17.5C12.9993 16.2493 13.437 15.187 14.313 14.313C15.189 13.439 16.2513 13.0013 17.5 13C18.7487 12.9987 19.8113 13.4363 20.688 14.313C21.5647 15.1897 22.002 16.252 22 17.5C21.998 18.748 21.5607 19.8107 20.688 20.688C19.8153 21.5653 18.7527 22.0027 17.5 22ZM3 20.5V14.5C3 14.2167 3.096 13.9793 3.288 13.788C3.48 13.5967 3.71733 13.5007 4 13.5H10C10.2833 13.5 10.521 13.596 10.713 13.788C10.905 13.98 11.0007 14.2173 11 14.5V20.5C11 20.7833 10.904 21.021 10.712 21.213C10.52 21.405 10.2827 21.5007 10 21.5H4C3.71667 21.5 3.47933 21.404 3.288 21.212C3.09667 21.02 3.00067 20.7827 3 20.5Z" class="{{ request()->is('category') ? 'fill-white' : 'fill-[#575757] hover:fill-white' }}"/>
                            </svg>
                            </span>
                        <span class="ml-2">Category</span>
                    </a>
                </li>
                <li class="py-4 px-6 {{ request()->is('customers') ? 'bg-[#575757] text-white' : 'hover:bg-[#575757] text-gray-700' }}">
                    <a href="#" class="icon px-5 flex items-center {{ request()->is('customers') ? 'text-white' : 'text-gray-700 hover:text-white' }}">
                        <span class="icon_span"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12 2C12.9889 2 13.9556 2.29324 14.7779 2.84265C15.6001 3.39206 16.241 4.17295 16.6194 5.08658C16.9978 6.00021 17.0969 7.00555 16.9039 7.97545C16.711 8.94536 16.2348 9.83627 15.5355 10.5355C14.8363 11.2348 13.9454 11.711 12.9755 11.9039C12.0055 12.0969 11.0002 11.9978 10.0866 11.6194C9.17295 11.241 8.39206 10.6001 7.84265 9.77785C7.29324 8.95561 7 7.98891 7 7L7.005 6.783C7.06092 5.49575 7.61161 4.27978 8.54222 3.38866C9.47284 2.49754 10.7115 2.00007 12 2ZM14 14C15.3261 14 16.5979 14.5268 17.5355 15.4645C18.4732 16.4021 19 17.6739 19 19V20C19 20.5304 18.7893 21.0391 18.4142 21.4142C18.0391 21.7893 17.5304 22 17 22H7C6.46957 22 5.96086 21.7893 5.58579 21.4142C5.21071 21.0391 5 20.5304 5 20V19C5 17.6739 5.52678 16.4021 6.46447 15.4645C7.40215 14.5268 8.67392 14 10 14H14Z" class="{{ request()->is('customer') ? 'fill-white' : 'fill-[#575757] hover:fill-white' }}"/>
                            </svg>
                            </span>
                        <span class="ml-2">Customers</span>
                    </a>
                </li>
                <li class="py-4 px-6 {{ request()->is('sell') ? 'bg-[#575757] text-white' : 'hover:bg-[#575757] text-gray-700' }}">
                    <a href="#" class="icon px-5 flex items-center {{ request()->is('sell') ? 'text-white' : 'text-gray-700 hover:text-white' }}">
                        <span class="icon_span"><svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M20 10C20 15.523 15.523 20 10 20C4.477 20 0 15.523 0 10C0 4.477 4.477 0 10 0C15.523 0 20 4.477 20 10ZM10 3.25C10.1989 3.25 10.3897 3.32902 10.5303 3.46967C10.671 3.61032 10.75 3.80109 10.75 4V4.317C12.38 4.609 13.75 5.834 13.75 7.5C13.75 7.69891 13.671 7.88968 13.5303 8.03033C13.3897 8.17098 13.1989 8.25 13 8.25C12.8011 8.25 12.6103 8.17098 12.4697 8.03033C12.329 7.88968 12.25 7.69891 12.25 7.5C12.25 6.822 11.686 6.103 10.75 5.847V9.317C12.38 9.609 13.75 10.834 13.75 12.5C13.75 14.166 12.38 15.391 10.75 15.683V16C10.75 16.1989 10.671 16.3897 10.5303 16.5303C10.3897 16.671 10.1989 16.75 10 16.75C9.80109 16.75 9.61032 16.671 9.46967 16.5303C9.32902 16.3897 9.25 16.1989 9.25 16V15.683C7.62 15.391 6.25 14.166 6.25 12.5C6.25 12.3011 6.32902 12.1103 6.46967 11.9697C6.61032 11.829 6.80109 11.75 7 11.75C7.19891 11.75 7.38968 11.829 7.53033 11.9697C7.67098 12.1103 7.75 12.3011 7.75 12.5C7.75 13.178 8.314 13.897 9.25 14.152V10.683C7.62 10.391 6.25 9.166 6.25 7.5C6.25 5.834 7.62 4.609 9.25 4.317V4C9.25 3.80109 9.32902 3.61032 9.46967 3.46967C9.61032 3.32902 9.80109 3.25 10 3.25Z" class="{{ request()->is('sell') ? 'fill-white' : 'fill-[#575757] hover:fill-white' }}"/>
                            </svg>
                            </span>
                        <span class="ml-2">Sells</span>
                    </a>
                </li>
                <li class="py-4 px-6 {{ request()->is('material') ? 'bg-[#575757] text-white' : 'hover:bg-[#575757] text-gray-700' }}">
                    <a href="#" class="icon px-5 flex items-center {{ request()->is('material') ? 'text-white' : 'text-gray-700 hover:text-white' }}">
                        <span class="icon_span"><svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M1 5L8 1L19 5M1 5V10L12 14L19 10V5M1 5L12 9L19 5" stroke="#575757" stroke-width="2" stroke-linejoin="round"/>
                            <path d="M1 10V15L12 19L19 15V10" stroke="#575757" stroke-width="2" stroke-linejoin="round" class="{{ request()->is('material') ? 'fill-white' : 'fill-[#575757] hover:fill-white' }}"/>
                            </svg>
                            </span>
                        <span class="ml-2">Materials</span>
                    </a>
                </li>
            </ul>
        </nav>
        <div class="p-4">
        <button class="px-5 py-3 bg-[#B90000] text-white w-full flex items-center justify-center rounded-md font-semibold">Log out</button>
        </div>
    </div>

    <!-- Content -->
    <div class="flex-1 flex flex-col overflow-hidden">
    <header class="flex justify-end items-center p-4 py-5 pb-10 shadow-[#575757] shadow-sm z-10">
        <div class="flex items-start">
            <div class="relative text-gray-600 pr-20">
                <input type="search" name="search" class="bg-[#F8F7F3] h-10 px-5 w-80 rounded-xl text-sm focus:outline-none drop-shadow-xl mr-16">
                <button type="submit" class="absolute right-20 top-0 mt-3 mr-20">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                </button>
            </div
        </div>
        <div class="flex items-center px-8">
            <img src="path_to_logo.png" alt="Logo" class="h-10 w-10">
        </div>
    </header>
    @yield('content')

    @yield('script')
</body>
@endsection