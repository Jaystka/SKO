@php
$isCheck = function ($cart) {
$status = $cart->firstWhere('status', $cart->status);
return optional($status)->status == '1' ? 'checked' : '';
};
@endphp
@foreach ($carts as $cart)
<div data-cart-id="{{$cart->cart_id}}"
    class="grid grid-cols-1 md:grid-cols-12 gap-4 border-b py-4 items-center cart-item">
    <div class="md:col-span-5 flex items-center">
        <div class="checkbox-wrapper-18 pr-6">
            <div class="round">
                <input type="checkbox" {{ $isCheck($cart ) }} name="options" id="checkbox-{{$cart->cart_id}}"
                    data-id="{{$cart->cart_id}}" />
                <label for="checkbox-{{$cart->cart_id}}" value="{{$cart->cart_id}}"></label>
            </div>
        </div>
        <div class="w-16 h-16 md:w-32 md:h-32 flex items-center shadow-xl  rounded-xl mr-4"><img
                src="{{$cart['image']}}" alt="Proto Lite Purple" class=" p-2"></div>
        <div>
            <p class="font-semibold">{{$cart->series}}</p>
            <p class="text-sm text-gray-500">Sepatu {{$cart->brand}}</p>
        </div>
    </div>
    <div class="md:col-span-2">
        <div>
            <p class="text-gray-700 w-10 h-10 flex items-center justify-center shadow-md font-MadeTomy-Regular">
                {{$cart->size}}</p>
        </div>
    </div>
    <div class="md:col-span-2 flex items-center">
        <div class="shadow-md">
            <button type="button" class="bg-gray-300 text-black px-2 py-1 rounded minus-btn" data-type="minus"
                data-field="quant[2]">-</button>
            <input class="text-center mx-2 w-10 form-control input-qty quantity bg-transparent" disabled readonly
                data-quantity="{{$cart->quantity}}" type="text" value="{{$cart['quantity']}}" min="1" max="50">
            <button type="button" class="bg-[#FFF3B2] text-black px-2 py-1 rounded plus-btn">+</button>
        </div>
    </div>
    <div class="md:col-span-1">
        <button class="text-gray-600 hover:text-gray-800" onclick="clicked('{{$cart->cart_id}}')" type="button">
            <div class="flex justify-center items-center class w-10 h-10 shadow-lg rounded-md">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                    <path fill-rule="evenodd"
                        d="M16.5 4.478v.227a48.816 48.816 0 0 1 3.878.512.75.75 0 1 1-.256 1.478l-.209-.035-1.005 13.07a3 3 0 0 1-2.991 2.77H8.084a3 3 0 0 1-2.991-2.77L4.087 6.66l-.209.035a.75.75 0 0 1-.256-1.478A48.567 48.567 0 0 1 7.5 4.705v-.227c0-1.564 1.213-2.9 2.816-2.951a52.662 52.662 0 0 1 3.369 0c1.603.051 2.815 1.387 2.815 2.951Zm-6.136-1.452a51.196 51.196 0 0 1 3.273 0C14.39 3.05 15 3.684 15 4.478v.113a49.488 49.488 0 0 0-6 0v-.113c0-.794.609-1.428 1.364-1.452Zm-.355 5.945a.75.75 0 1 0-1.5.058l.347 9a.75.75 0 1 0 1.499-.058l-.346-9Zm5.48.058a.75.75 0 1 0-1.498-.058l-.347 9a.75.75 0 0 0 1.5.058l.345-9Z"
                        clip-rule="evenodd" />
                </svg>
            </div>
        </button>
    </div>
    <div class="md:col-span-2">
        <p class="text-[#7C0000] price" id="total-price-{{$cart->cart_id}}" data-price="{{$cart->price}}">
            IDR
            {{number_format($cart->cart_price, 0, ',', '.')}}</p>
    </div>
</div>
@endforeach