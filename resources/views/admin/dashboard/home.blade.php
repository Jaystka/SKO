@extends('../layout/sidebar')

@section('head')
<title>Dashboard - SKO</title>
@endsection

@section('content')
        <main class="flex-1 overflow-y-auto px-8">
            <h2 class="py-2 font-MadeTomy-Regular text-xl">Dashboard</h2>
            <div class="flex flex-col lg:flex-row lg:space-x-3">
                <div class="flex-1 grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                    <div class="bg-[#F8F7F3] border p-4 rounded-2xl drop-shadow-xl">
                        <div class="text-start">
                            <svg width="80" height="80" viewBox="0 0 92 92" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <g filter="url(#filter0_d_1184_120)">
                            <rect x="9" y="8" width="72" height="72" rx="5" fill="#F8F7F3"/>
                            </g>
                            <g clip-path="url(#clip0_1184_120)">
                            <path d="M46.625 23.1562V24.0996C47.1917 24.2074 47.7406 24.3422 48.2365 24.477C49.3698 24.7824 50.0427 25.9684 49.7417 27.1184C49.4406 28.2684 48.2719 28.9512 47.1385 28.6457C46.1734 28.3852 45.2703 28.2055 44.4646 28.1965C43.8182 28.1875 43.163 28.3492 42.7469 28.5918C42.5609 28.7086 42.4724 28.8074 42.437 28.8613C42.4104 28.9062 42.375 28.9691 42.375 29.1129V29.1668C42.3927 29.1848 42.4547 29.2746 42.6672 29.4004C43.1807 29.7148 43.9422 29.9574 45.0932 30.3078L45.1729 30.3348C46.1557 30.6313 47.4661 31.0355 48.5286 31.7094C49.7417 32.482 50.8396 33.7668 50.8661 35.7434C50.8927 37.7648 49.8568 39.2383 48.5021 40.1008C47.9089 40.4691 47.2714 40.7297 46.6161 40.8914V41.8438C46.6161 43.0387 45.6688 44 44.4911 44C43.3135 44 42.3661 43.0387 42.3661 41.8438V40.8195C41.525 40.6129 40.7547 40.3434 40.0995 40.1187C39.9135 40.0559 39.7365 39.993 39.5682 39.9391C38.4526 39.5617 37.8505 38.3398 38.2224 37.2078C38.5943 36.0758 39.7984 35.4648 40.9141 35.8422C41.1443 35.923 41.3568 35.9949 41.5604 36.0668C42.7646 36.4801 43.6323 36.7766 44.562 36.8125C45.2703 36.8395 45.899 36.6687 46.262 36.4441C46.4302 36.3363 46.5099 36.2465 46.5453 36.1836C46.5807 36.1297 46.625 36.0219 46.6161 35.8152V35.7973C46.6161 35.7074 46.6161 35.6086 46.262 35.384C45.7573 35.0605 44.9958 34.809 43.8625 34.4586L43.6943 34.4047C42.738 34.1172 41.4807 33.7309 40.4714 33.1109C39.276 32.3832 38.125 31.1344 38.1161 29.1488C38.1073 27.0914 39.2583 25.6809 40.5688 24.8902C41.1354 24.5488 41.7464 24.3152 42.3573 24.1535V23.1562C42.3573 21.9613 43.3047 21 44.4823 21C45.6599 21 46.6073 21.9613 46.6073 23.1562H46.625ZM69.3094 51.2145C70.4693 52.8137 70.1328 55.0598 68.5568 56.2367L57.3474 64.6191C55.2755 66.1645 52.7786 67 50.2021 67H21.8333C20.2661 67 19 65.7152 19 64.125V58.375C19 56.7848 20.2661 55.5 21.8333 55.5H25.0917L29.0672 52.2656C31.0771 50.6305 33.574 49.75 36.1505 49.75H50.1667C51.7339 49.75 53 51.0348 53 52.625C53 54.2152 51.7339 55.5 50.1667 55.5H43.0833C42.3042 55.5 41.6667 56.1469 41.6667 56.9375C41.6667 57.7281 42.3042 58.375 43.0833 58.375H53.7615L64.3599 50.4508C65.9359 49.2738 68.1495 49.6152 69.3094 51.2145Z" fill="#3C4043"/>
                            </g>
                            <defs>
                            <filter id="filter0_d_1184_120" x="0" y="0" width="92" height="92" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
                            <feFlood flood-opacity="0" result="BackgroundImageFix"/>
                            <feColorMatrix in="SourceAlpha" type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" result="hardAlpha"/>
                            <feOffset dx="1" dy="2"/>
                            <feGaussianBlur stdDeviation="5"/>
                            <feComposite in2="hardAlpha" operator="out"/>
                            <feColorMatrix type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.2 0"/>
                            <feBlend mode="normal" in2="BackgroundImageFix" result="effect1_dropShadow_1184_120"/>
                            <feBlend mode="normal" in="SourceGraphic" in2="effect1_dropShadow_1184_120" result="shape"/>
                            </filter>
                            <clipPath id="clip0_1184_120">
                            <rect width="51" height="46" fill="white" transform="translate(19 21)"/>
                            </clipPath>
                            </defs>
                            </svg>
                            <h3 class="font-MadeTomy-Medium">Income</h3>
                            <p class="text-xs pb-3">Juni 2024</p>
                            <p class="text-xl font-MadeTomy-Medium">Rp. 7.987.562</p>
                        </div>
                    </div>
                    <div class="bg-[#F8F7F3] border p-4 rounded-2xl drop-shadow-xl">
                        <div class="text-start">
                            <svg width="80" height="80" viewBox="0 0 92 92" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <g filter="url(#filter0_d_1382_2)">
                            <rect x="9" y="8" width="72" height="72" rx="5" fill="#F8F7F3"/>
                            </g>
                            <path d="M52 54H64M64 54L59 59M64 54L59 49" stroke="#3C4043" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M64 46V30C64 29.2044 63.6839 28.4413 63.1213 27.8787C62.5587 27.3161 61.7956 27 61 27H29C28.2044 27 27.4413 27.3161 26.8787 27.8787C26.3161 28.4413 26 29.2044 26 30V58C26 58.7956 26.3161 59.5587 26.8787 60.1213C27.4413 60.6839 28.2044 61 29 61H49.47" stroke="#3C4043" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M36 35L41 41M41 41L46 35M41 41V53M35 47H47M35 41H47" stroke="#3C4043" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"/>
                            <defs>
                            <filter id="filter0_d_1382_2" x="0" y="0" width="92" height="92" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
                            <feFlood flood-opacity="0" result="BackgroundImageFix"/>
                            <feColorMatrix in="SourceAlpha" type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" result="hardAlpha"/>
                            <feOffset dx="1" dy="2"/>
                            <feGaussianBlur stdDeviation="5"/>
                            <feComposite in2="hardAlpha" operator="out"/>
                            <feColorMatrix type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.2 0"/>
                            <feBlend mode="normal" in2="BackgroundImageFix" result="effect1_dropShadow_1382_2"/>
                            <feBlend mode="normal" in="SourceGraphic" in2="effect1_dropShadow_1382_2" result="shape"/>
                            </filter>
                            </defs>
                            </svg>
                            <h3 class="font-MadeTomy-Medium">Income</h3>
                            <p class="text-xs pb-3">Juni 2024</p>
                            <p class="text-xl font-MadeTomy-Medium">Rp. 7.987.562</p>
                        </div>
                    </div>
                    <div class="bg-[#F8F7F3] border p-4 rounded-2xl drop-shadow-xl">
                        <div class="text-start">
                            <svg width="80" height="80" viewBox="0 0 92 92" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <g filter="url(#filter0_d_1382_3)">
                            <rect x="9" y="8" width="72" height="72" rx="5" fill="#F8F7F3"/>
                            </g>
                            <path d="M40.5833 52.3333V36.6667C40.5833 35.6279 40.996 34.6317 41.7305 33.8972C42.465 33.1626 43.4612 32.75 44.5 32.75H62.125V30.7917C62.125 28.6375 60.3625 26.875 58.2083 26.875H30.7917C29.7529 26.875 28.7567 27.2876 28.0222 28.0222C27.2876 28.7567 26.875 29.7529 26.875 30.7917V58.2083C26.875 59.2471 27.2876 60.2433 28.0222 60.9778C28.7567 61.7124 29.7529 62.125 30.7917 62.125H58.2083C60.3625 62.125 62.125 60.3625 62.125 58.2083V56.25H44.5C43.4612 56.25 42.465 55.8374 41.7305 55.1028C40.996 54.3683 40.5833 53.3721 40.5833 52.3333ZM46.4583 36.6667C45.3813 36.6667 44.5 37.5479 44.5 38.625V50.375C44.5 51.4521 45.3813 52.3333 46.4583 52.3333H64.0833V36.6667H46.4583ZM52.3333 47.4375C50.7079 47.4375 49.3958 46.1254 49.3958 44.5C49.3958 42.8746 50.7079 41.5625 52.3333 41.5625C53.9588 41.5625 55.2708 42.8746 55.2708 44.5C55.2708 46.1254 53.9588 47.4375 52.3333 47.4375Z" fill="#3C4043"/>
                            <defs>
                            <filter id="filter0_d_1382_3" x="0" y="0" width="92" height="92" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
                            <feFlood flood-opacity="0" result="BackgroundImageFix"/>
                            <feColorMatrix in="SourceAlpha" type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" result="hardAlpha"/>
                            <feOffset dx="1" dy="2"/>
                            <feGaussianBlur stdDeviation="5"/>
                            <feComposite in2="hardAlpha" operator="out"/>
                            <feColorMatrix type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.2 0"/>
                            <feBlend mode="normal" in2="BackgroundImageFix" result="effect1_dropShadow_1382_3"/>
                            <feBlend mode="normal" in="SourceGraphic" in2="effect1_dropShadow_1382_3" result="shape"/>
                            </filter>
                            </defs>
                            </svg>
                            <h3 class="font-MadeTomy-Medium">Income</h3>
                            <p class="text-xs pb-3">Juni 2024</p>
                            <p class="text-xl font-MadeTomy-Medium">Rp. 7.987.562</p>
                        </div>
                    </div>
                    <div class="col-span-1 md:col-span-3 bg-[#F8F7F3] p-4 rounded-xl drop-shadow-xl">
                        <div class="p-5">
                        <h3 class="text-xl font-semibold mb-4 text-center">Chart Title</h3>
                        <div id="curve_chart" class="w-full"></div>
                        </div>
                    </div>
                </div>
                <div class="flex-shrink-0 w-full h-full lg:w-1/3 bg-[#F8F7F3] p-4 rounded-xl drop-shadow-xl ">
                    <h3 class="text-xl font-semibold">Recent Order</h3>
                    <div class="overflow-auto">
                        <div class="flex justify-between items-center py-2 px-5">
                            <p class="text-left font-semibold text-sm text-gray-500 font-MadeTomy-Thin">Product</p>
                            <p class="text-center font-semibold md:pl-14 text-sm text-gray-500 font-MadeTomy-Thin">Price</p>
                            <p class="font-semibold md:pr-4 text-sm text-gray-500 font-MadeTomy-Thin">Action</p>
                        </div>
                    <div class="space-y-2.5">
                        <div class="flex justify-between items-center p-6 bg-[#F8F7F3] rounded-lg border border-gray-200 shadow-md">
                            <div>
                                <p class="font-semibold text-sm">Proto Lite Purple</p>
                                <p class="text-gray-500 text-xs">Sepatu Compass | 1 pcs</p>
                            </div>
                            <div class="text-red-500 text-xs">Rp. 408.000</div>
                            <button class="bg-[#1D8F00] text-white py-2 px-3 rounded text-xs">Accept</button>
                        </div>
                        <div class="flex justify-between items-center p-6 bg-[#F8F7F3] rounded-lg border border-gray-200 shadow-md">
                            <div>
                                <p class="font-semibold text-sm">Gazelle Black Gum</p>
                                <p class="text-xs text-gray-500">Sepatu Compass | 1 pcs</p>
                            </div>
                            <div class="text-red-500 text-xs">Rp. 538.000</div>
                            <button class="bg-[#1D8F00] text-white py-2 px-3 rounded text-xs">Accept</button>
                        </div>
                        <div class="flex justify-between items-center p-6 bg-[#F8F7F3] rounded-lg border border-gray-200 shadow-md">
                            <div>
                                <p class="font-semibold text-sm">Retrograde White Blue</p>
                                <p class="text-xs text-gray-500">Sepatu Compass | 1 pcs</p>
                            </div>
                            <div class="text-red-500 text-xs">Rp. 538.000</div>
                            <button class="bg-[#1D8F00] text-white py-2 px-3 rounded text-xs">Accept</button>
                        </div>
                        <div class="flex justify-between items-center p-6 bg-[#F8F7F3] rounded-lg border border-gray-200 shadow-md">
                            <div>
                                <p class="font-semibold text-sm">Retrograde White Blue</p>
                                <p class="text-xs text-gray-500">Sepatu Compass | 1 pcs</p>
                            </div>
                            <div class="text-red-500 text-xs">Rp. 538.000</div>
                            <button class="bg-[#1D8F00] text-white py-2 px-3 rounded text-xs">Accept</button>
                        </div>
                        <div class="pb-2">
                        <button class="px-5 py-3 border bg-[#F8F7F3] text-gray-500 w-full flex items-center justify-center rounded-md font-semibold drop-shadow-md">See More</button>
                        </div>
                        
                    </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>
@endsection

@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

<script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Year', 'Sales', 'Expenses'],
          ['2004',  1000,      400],
          ['2005',  1170,      460],
          ['2006',  660,       1120],
          ['2007',  1030,      540]
        ]);

        var options = {
          title: 'Company Performance',
          curveType: 'function',
          legend: { position: 'bottom' }
        };

        var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

        chart.draw(data, options);
      }
</script>
@endsection
