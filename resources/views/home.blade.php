<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no" />
    @vite('resources/css/app.css')
    <title>SKO - Home</title>

</head>

<body>

    <!-- Start Navbar -->
    <nav class="navbar absolute bg-transparent w-full text-black py-4 lg:py-2 px-5">
        <div class="px-4 mx-auto items-center flex justify-between relative">

            <!-- Start Menu Button -->
            <div class="lg:hidden flex items-center">
                <button class="outline-none mobile-menu-button">
                    <svg class=" w-6 h-6 text-gray-500 hover:text-gray-400 " x-show="!showMenu" fill="none"
                        stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24"
                        stroke="currentColor">
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
                class="hidden absolute pt-4  bg-white shadow-lg rounded-lg max-w-[150px] w-full top-full lg:block lg:static lg:max-w-fit lg:shadow-none lg:bg-transparent  lg:pl-20">
                <ul id="navbar-nav" class="block lg:flex">
                    <li class="group"><a class="mx-8 py-2  lg:py-0 lg:mx-14" href="/">Home</a></li>
                    <li class="group"><a class="mx-8 py-2  lg:py-0 lg:mx-14" href="shop">Shop</a></li>
                    <li class="group"><a class="mx-8 py-2  lg:py-0 lg:mx-14" href="ourstory">Our Story</a></li>
                    <li class="group"><a class="mx-8 py-2  lg:py-0 lg:mx-14" href="blog">Blog</a></li>
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

        </div>
    </nav>
    <!-- End Navbar -->

    <!-- Start Content Section -->
    <section>
        <div class="text-center  pt-[100px] lg:pt-[130px]">
            <p id="jumbotron">SEPATU LOAK</p>
        </div>

        <div class="container max-w-[1200px] mt-[-150px] lg:mt-[-560px]">
            <p id="quote" class="hidden absolute mt-[580px] text-[17px] xl:block">Berkarya dengan gaya <br> SKO selalu
                tersedia.</p>
            <img class="mt-[50px] max-h-[900px]" src="img/sepatu 1.png" alt="">
            <div class="hidden lg:block" id="shadow"></div>
            <img class="hidden absolute h-[350px] mt-[-500px] ml-[950px] xl:block" src="img/sepatu 2.png" alt="">
            <div class=" lg:mt-[-220px]">
                <a href="shop"><button
                        class="rounded-lg text-sm px-24 py-10 mx-auto flex justify-between items-center custom-btn btn-15 ">Shop
                        Now</button></a>
            </div>
        </div>
    </section>

    <footer>
        <div class="container w-full h-5 text-center mt-20">
            <p class="text-gray-500">©SKO 2023. All rights reserved.</p>
        </div>
    </footer>

    <script src="/js/script.js"></script>
</body>

</html>