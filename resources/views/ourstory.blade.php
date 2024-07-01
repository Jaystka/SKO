@extends('../layout/main')

@section('head')
<title>Ourstory - SKO</title>
@endsection



@section('navClass')
{{ 'w-full text-white'}}
@endsection

@section('content')

<section class="bg-cover bg-center -z-50 w-screen h-screen flex justify-center items-center"
  style="background-image: url('dist/img/bg2.jpg');">
  <h1 class="text-[50px] mb-4 text-white fonthin">OUR COMPANY STORY</h1>
</section>

<section class="bg-[#F8F7F3] flex items-center justify-center py-20">
  <div class="p-6 md:p-12 rounded-lg max-w-4xl w-full mx-8">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 items-center">
      <div class="flex flex-col justify-center">
        <h1 class="text-5xl md:text-6xl fonthin ">
          THE HISTORY OF
          <span class="text-5xl md:text-6xl font-bold logosko">SKO</span>
        </h1>
      </div>
      <div>
        <p class="text-lg md:text-xl text-black leading-relaxed fonthin text-justify">
          Established in 2023 in Yogyakarta, Indonesia, SKO was founded by 6 students majoring in informatics who have
          a vision – mission to voice local brands to the international scene, especially shoes.
        </p>
      </div>
    </div>
  </div>
</section>

<footer class="bg-[#3C4043] py-6 h-80">
  <div class="container mx-auto  text-center justify-items-center text-white">
    <div class="text-[125px] font-bold logosko">SKO<sup style="font-family:Poppins ; font-size: 72px;">®</sup></a>
    </div>
    <p class="text-sm text-[#646666]">&copy; SKO 2023. All rights reserved.</p>
  </div>
</footer>
@endsection