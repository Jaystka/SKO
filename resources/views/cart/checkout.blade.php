@extends('../layout/main')

@section('head')
<title>Checkout - SKO</title>
<style>
    /* Customize styles as needed */
    .collapse {
        display: none;
    }

    .collapsed {
        display: block;
        transition: max-height 0.3s ease-out;
        max-height: 0;
        overflow: hidden;
    }

    .expanded {
        transition: max-height 0.3s ease-in;
    }
</style>
@endsection

@section('content')

<main class="container mx-auto p-8 md:p-28">
    <div class="md:flex md:space-x-8">
        <div class="md:w-2/3 space-y-4">
            <div class="bg-red-700 text-white p-4 text-center font-semibold">
                Complete the fields below!
            </div>
            <div>
                <h2 class="text-lg font-bold">Billing & Shipping</h2>
                <form class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Name <span
                                class="text-red-500">*</span></label>
                        <input type="text"
                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm"
                            required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Phone <span
                                class="text-red-500">*</span></label>
                        <input type="text"
                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm"
                            required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Address <span
                                class="text-red-500">*</span></label>
                        <textarea
                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm"
                            rows="6" required></textarea>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Additional Information</label>
                        <textarea
                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm"
                            rows="2"></textarea>
                    </div>
                </form>
            </div>
        </div>
        <div class="md:w-2/3 space-y-4 mt-8 md:mt-0">
            <div class="bg-[#F4F2E8] border-[#979797] border-2 p-8 h-full">
                <h2 class="text-lg font-bold text-red-700 mb-4">Your Order</h2>
                <div id="productOrder" class="overflow-y-scroll">
                    @php
                    $i = 1;
                    @endphp
                    @foreach ($carts as $cart)
                    @if ($loop->first)
                    <div id="productItem0" class="expanded">
                        <div class="flex items-center py-4 border-b border-gray-300">
                            <img src="img/Cmp2.png" alt="Product Image" class="w-20 h-20 object-cover">
                            <div class="ml-4 flex-1">
                                <div class="font-semibold">{{$cart->brand}} {{$cart->series}}</div>
                                <div class="text-sm text-gray-600">Size {{$cart->size}}</div>
                            </div>
                            <div class="lg:w-1/3 flex mr-2">
                                <div class="mx-2 font-sm">{{$cart->quantity}}x</div>
                                <div class="ml-auto font-semibold">IDR {{ number_format($cart->cart_price, 0, ',',
                                    '.')}}</div>
                            </div>
                        </div>
                    </div>
                    @endif
                    @if ($loop->iteration-1)
                    <div id="productItem{{ $i }}" class="collapsed">
                        <div class="flex items-center py-4 border-b border-gray-300">
                            <img src="img/Cmp2.png" alt="Product Image" class="w-20 h-20 object-cover">
                            <div class="ml-4 flex-1">
                                <div class="font-semibold">{{$cart->brand}} {{$cart->series}}</div>
                                <div class="text-sm text-gray-600">Size {{$cart->size}}</div>
                            </div>
                            <div class="lg:w-1/3 flex mr-2">
                                <div class="mx-2 font-sm">{{$cart->quantity}}x</div>
                                <div class="ml-auto font-semibold">IDR {{ number_format($cart->cart_price, 0, ',',
                                    '.')}}</div>
                            </div>
                        </div>
                    </div>
                    @php $i++ @endphp
                    @endif
                    @endforeach
                </div>
                <!-- Single Product -->

                <!-- Show All Products Button -->
                @if($carts->count() > 1)
                <div class="text-center">
                    <button id="toggleAllProducts" class="text-gray-500 px-4 rounded focus:outline-none ">
                        <p>Show all products</p>
                        <div class="flex justify-center"><svg width="44" height="16" viewBox="0 1 44 18" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <g clip-path="url(#clip0_1341_12)">
                                    <path
                                        d="M31.9366 2.45199L33.8799 3.51299L23.2887 9.29199C23.119 9.38514 22.9172 9.45907 22.6949 9.50952C22.4726 9.55997 22.2342 9.58594 21.9935 9.58594C21.7527 9.58594 21.5143 9.55997 21.292 9.50952C21.0697 9.45907 20.8679 9.38514 20.6982 9.29199L10.1016 3.51299L12.0449 2.45299L21.9907 7.87699L31.9366 2.45199Z"
                                        fill="#898989" />
                                </g>
                                <g clip-path="url(#clip1_1341_12)">
                                    <path
                                        d="M31.9366 6.45199L33.8799 7.51299L23.2887 13.292C23.119 13.3851 22.9172 13.4591 22.6949 13.5095C22.4726 13.56 22.2342 13.5859 21.9935 13.5859C21.7527 13.5859 21.5143 13.56 21.292 13.5095C21.0697 13.4591 20.8679 13.3851 20.6982 13.292L10.1016 7.51299L12.0449 6.45299L21.9907 11.877L31.9366 6.45199Z"
                                        fill="#898989" />
                                </g>
                            </svg></div>
                    </button>
                </div>
                @endif

                <div class="py-4 border-b border-gray-300">
                    <div class="flex justify-between">
                        <div>Subtotal</div>
                        <div>IDR {{ number_format($carts->sum('cart_price'), 0, ',', '.')}}</div>
                    </div>
                    <div class="flex justify-between">
                        <div>Tax</div>
                        <div>IDR 10.000</div>
                    </div>
                </div>
                <div class="flex justify-between text-xl font-bold">
                    <div>Total</div>
                    <div>IDR 588.000</div>
                </div>
                {{-- <div class="flex space-x-16">
                    <label class="flex items-center">
                        <input type="radio" name="payment" class="form-radio text-red-600" checked>
                        <span class="ml-2">Transfer Bank</span>
                    </label>
                    <label class="flex items-center">
                        <input type="radio" name="payment" class="form-radio text-red-600">
                        <span class="ml-2">Digital Money</span>
                    </label>
                </div> --}}
                <button
                    class="w-full bg-[#FFF3B2] text-gray-800 hover:bg-black hover:text-white font-bold py-3 rounded-md mt-12">Place
                    Order</button>
            </div>
        </div>
    </div>
</main>
<footer class="text-center py-4 text-gray-500 text-sm">
    ©SKO 2023. All rights reserved.
</footer>
@endsection

@section('script')
<!-- Include Alpine.js for collapse functionality -->
<script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2/dist/alpine.min.js" defer></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
                const toggleButtons = document.querySelectorAll('[id^=productItem]');
                const toggleAllButton = document.getElementById('toggleAllProducts');
                const productOrder = document.getElementById('productOrder');
    
                if(toggleButtons.length > 1){
                toggleAllButton.addEventListener('click', () => {
                if(toggleButtons.length > 1){
                    productOrder.classList.toggle('h-60');
                    i=1;
                    while (i < toggleButtons.length) {              
                        const orderItem = document.getElementById(`productItem${i}`);
                        orderItem.classList.toggle('collapsed');
                        orderItem.classList.toggle('expanded');
                        i++;
                }
                }
                });
                }
            });
</script>
@endsection