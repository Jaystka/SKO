@extends('../layout/main')

@section('head')
<title>Checkout - SKO</title>
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
                <div class="flex items-center py-4 border-b border-gray-300">
                    <img src="img/Cmp2.png" alt="Product Image" class="w-20 h-20 object-cover">
                    <div class="ml-4 flex-1">
                        <div class="font-semibold">Compass Gazelle Low Black Gum</div>
                        <div class="text-sm text-gray-600">Size 41</div>
                    </div>
                    <div class="ml-auto font-semibold">IDR 578.000</div>
                </div>
                <div class="py-4 border-b border-gray-300">
                    <div class="flex justify-between">
                        <div>Subtotal</div>
                        <div>IDR 578.000</div>
                    </div>
                    <div class="flex justify-between">
                        <div>Tax</div>
                        <div>IDR 10.000</div>
                    </div>
                </div>
                <div class="flex justify-between py-10 text-xl font-bold">
                    <div>Total</div>
                    <div>IDR 588.000</div>
                </div>
                <div class="flex space-x-16">
                    <label class="flex items-center">
                        <input type="radio" name="payment" class="form-radio text-red-600" checked>
                        <span class="ml-2">Transfer Bank</span>
                    </label>
                    <label class="flex items-center">
                        <input type="radio" name="payment" class="form-radio text-red-600">
                        <span class="ml-2">Digital Money</span>
                    </label>
                </div>
                <button
                    class="w-full bg-[#FFF3B2] text-gray-800 hover:bg-black hover:text-white font-bold py-3 rounded-md mt-16">Place
                    Order</button>
            </div>
        </div>
    </div>
</main>
<footer class="text-center py-4 text-gray-500 text-sm">
    ©SKO 2023. All rights reserved.
</footer>
@endsection