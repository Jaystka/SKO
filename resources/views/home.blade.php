@extends('../layout/main')

@section('head')
<title>Home - SKO</title>
@endsection

@section('content')
<!-- Start Content Section -->
<section>
    <div class="text-center  pt-[100px] lg:pt-[130px]">
        <p id="jumbotron">SEPATU LOKAL</p>
    </div>

    
    <div class="container max-w-[1200px] mt-[-150px] lg:mt-[-560px]">
        <p id="quote" class="hidden absolute mt-[580px] text-[17px] xl:block ">Berkarya dengan gaya
            <br> SKO selalu
            tersedia.
        </p>
        <div class="absolute hidden mt-[650px] xl:block">
            <div class="flex"><span class=""><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                        viewBox="0 0 24 24">
                        <path fill="currentColor"
                            d="M7.8 2h8.4C19.4 2 22 4.6 22 7.8v8.4a5.8 5.8 0 0 1-5.8 5.8H7.8C4.6 22 2 19.4 2 16.2V7.8A5.8 5.8 0 0 1 7.8 2m-.2 2A3.6 3.6 0 0 0 4 7.6v8.8C4 18.39 5.61 20 7.6 20h8.8a3.6 3.6 0 0 0 3.6-3.6V7.6C20 5.61 18.39 4 16.4 4zm9.65 1.5a1.25 1.25 0 0 1 1.25 1.25A1.25 1.25 0 0 1 17.25 8A1.25 1.25 0 0 1 16 6.75a1.25 1.25 0 0 1 1.25-1.25M12 7a5 5 0 0 1 5 5a5 5 0 0 1-5 5a5 5 0 0 1-5-5a5 5 0 0 1 5-5m0 2a3 3 0 0 0-3 3a3 3 0 0 0 3 3a3 3 0 0 0 3-3a3 3 0 0 0-3-3" />
                    </svg></span>
                <span class="px-4">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                        <path fill="currentColor"
                            d="M16.6 5.82s.51.5 0 0A4.278 4.278 0 0 1 15.54 3h-3.09v12.4a2.592 2.592 0 0 1-2.59 2.5c-1.42 0-2.6-1.16-2.6-2.6c0-1.72 1.66-3.01 3.37-2.48V9.66c-3.45-.46-6.47 2.22-6.47 5.64c0 3.33 2.76 5.7 5.69 5.7c3.14 0 5.69-2.55 5.69-5.7V9.01a7.35 7.35 0 0 0 4.3 1.38V7.3s-1.88.09-3.24-1.48" />
                    </svg>
                </span>
            </div>
        </div>
        <img class="mt-[50px] max-h-[900px]" src="dist/img/sepatu 1.png" alt="">
        <div class="hidden lg:block" id="shadow"></div>
        <img class="hidden absolute h-[350px] mt-[-500px] ml-[950px] xl:block" src="dist/img/sepatu 2.png" alt="">
        <div class=" lg:mt-[-220px]">
            <a href="shop"><button
                    class="rounded-lg text-sm px-24 py-10 mx-auto flex justify-between items-center custom-btn btn-15 font-MadeTomy-Regular">Shop
                    Now</button></a>
        </div>
    </div>
</section>

<footer>
    <div class="container w-full h-5 text-center mt-20">
        <p class="text-gray-500">©SKO 2023. All rights reserved.</p>
    </div>
</footer>

@endsection