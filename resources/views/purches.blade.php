@extends('../layout/main')

@section('head')
<title>Home - SKO</title>
@endsection

@section('content')
<body class="bg-gray-50">
@section('navClass')
    {{ 'bg-[#F8F7F3] w-full text-black ' }}
    @endsection
    <div class="container mx-auto pt-10">
        <div class="grid md:grid-cols-2 pt-20">
            <!-- Left Section -->
            <div class="xl:mr-20">
                <div class="bg-red-600 text-white p-2 mb-4 mx-4">
                    <h2>Complete the fields below!</h2>
                </div>
                <div class="p-4">
                    <h3 class="font-bold text-lg mb-2">Billing & Shipping</h3>
                    <hr class="mb-4">
                    <form>
                        <div class="mb-4">
                            <label class="block text-gray-700">Name<span class="text-red-600">*</span></label>
                            <input type="text" class="w-full border border-gray-300 p-2">
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700">Phone<span class="text-red-600">*</span></label>
                            <input type="text" class="w-full border border-gray-300 p-2">
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700">Address<span class="text-red-600">*</span></label>
                            <textarea class="w-full border border-gray-300 p-2"></textarea>
                        </div>
                        <h3 class="font-bold text-lg mb-2">Additional Information</h3>
                        <hr class="mb-4">
                        <div class="mb-4">
                            <label class="block text-gray-700">Notes (optional)</label>
                            <textarea class="w-full border border-gray-300 p-2"></textarea>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Right Section -->
            <div class="p-4 bg-white shadow-md xl:border xl:border-black xl:mb-12">
                <div class="flex mb-4 pt-10">
                    <img src="dist/img/Cmp2.png" alt="Shoe Image" class="w-60 h-60 object-cover">
                    <div class="px-4">
                        <h3 class="font-bold text-lg mb-2">Your Order</h3>
                        <table class="w-full text-sm">
                            <tbody>
                                <tr>
                                    <td class="border-b border-gray-200 py-4 pr-10">Product</td>
                                    <td class="border-b border-gray-200 py-4">Subtotal</td>
                                </tr>
                                <tr>
                                    <td class="border-b border-gray-200 py-4">Compass Gazelle Low Black Gum</td>
                                    <td class="border-b border-gray-200 py-4">IDR 578.000</td>
                                </tr>
                                <tr>
                                    <td class="border-b border-gray-200 py-4">Subtotal</td>
                                    <td class="border-b border-gray-200 py-4">IDR 578.000</td>
                                </tr>
                                <tr>
                                    <td class="border-b border-gray-200 py-4">Tax</td>
                                    <td class="border-b border-gray-200 py-4">IDR 10.000</td>
                                </tr>
                                <tr>
                                    <td class="border-b border-gray-200 py-4">Total</td>
                                    <td class="border-b border-gray-200 py-4">IDR 588.000</td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="mt-4">
                            <label class="inline-flex items-center">
                                <input type="radio" class="form-radio" name="payment" value="bank_transfer" checked>
                                <span class="ml-2">Transfer Bank</span>
                            </label>
                            <label class="inline-flex items-center ml-6">
                                <input type="radio" class="form-radio" name="payment" value="digital_money">
                                <span class="ml-2">Digital Money</span>
                            </label>
                        </div>
                        <button class="mt-4 bg-yellow-300 hover:bg-yellow-400 xl:border xl:border-black text-black font-bold py-2 xl:px-24 rounded">
                            Place Order
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

@endsection