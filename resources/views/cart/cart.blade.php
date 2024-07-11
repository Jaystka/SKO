@extends('../layout/main')

@section('head')
<title>Cart - SKO</title>
<link rel="stylesheet" href="dist/css/owl.carousel.min.css">
@endsection

@section('content')
<div class="container mx-auto p-4">
    <div class="">
        <div class="px-20 pt-20 pb-7">
            <div class="grid grid-cols-1 md:grid-cols-12 gap-4 border-b py-4">
                <div class="md:col-span-5">
                    <p class="text-gray-600 pl-48">Description</p>
                </div>
                <div class="md:col-span-2">
                    <p class="text-gray-600">Size</p>
                </div>
                <div class="md:col-span-2">
                    <p class="text-gray-600">Quantity</p>
                </div>
                <div class="md:col-span-1">
                    <p class="text-gray-600">Remove</p>
                </div>
                <div class="md:col-span-2">
                    <p class="text-gray-600">Price</p>
                </div>
            </div>
            <!-- Item 1 -->
            @if ($carts->count() > 0)
            <div id="div_cart">
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
                                <input type="checkbox" {{ $isCheck($cart ) }} name="options"
                                    id="checkbox-{{$cart->cart_id}}" data-id="{{$cart->cart_id}}" />
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
                            <p
                                class="text-gray-700 w-10 h-10 flex items-center justify-center shadow-md font-MadeTomy-Regular">
                                {{$cart->size}}</p>
                        </div>
                    </div>
                    <div class="md:col-span-2 flex items-center">
                        <div class="shadow-md">
                            <button type="button" class="bg-gray-300 text-black px-2 py-1 rounded minus-btn"
                                data-type="minus" data-field="quant[2]">-</button>
                            <input class="text-center mx-2 w-10 form-control input-qty quantity bg-transparent" disabled
                                readonly data-quantity="{{$cart->quantity}}" type="text" value="{{$cart['quantity']}}"
                                min="1" max="50">
                            <button type="button" class="bg-[#FFF3B2] text-black px-2 py-1 rounded plus-btn">+</button>
                        </div>
                    </div>
                    <div class="md:col-span-1">
                        <button class="text-gray-600 hover:text-gray-800" onclick="clicked('{{$cart->cart_id}}')"
                            type="button">
                            <div class="flex justify-center items-center class w-10 h-10 shadow-lg rounded-md">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                    class="size-6">
                                    <path fill-rule="evenodd"
                                        d="M16.5 4.478v.227a48.816 48.816 0 0 1 3.878.512.75.75 0 1 1-.256 1.478l-.209-.035-1.005 13.07a3 3 0 0 1-2.991 2.77H8.084a3 3 0 0 1-2.991-2.77L4.087 6.66l-.209.035a.75.75 0 0 1-.256-1.478A48.567 48.567 0 0 1 7.5 4.705v-.227c0-1.564 1.213-2.9 2.816-2.951a52.662 52.662 0 0 1 3.369 0c1.603.051 2.815 1.387 2.815 2.951Zm-6.136-1.452a51.196 51.196 0 0 1 3.273 0C14.39 3.05 15 3.684 15 4.478v.113a49.488 49.488 0 0 0-6 0v-.113c0-.794.609-1.428 1.364-1.452Zm-.355 5.945a.75.75 0 1 0-1.5.058l.347 9a.75.75 0 1 0 1.499-.058l-.346-9Zm5.48.058a.75.75 0 1 0-1.498-.058l-.347 9a.75.75 0 0 0 1.5.058l.345-9Z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </div>
                    <div class="md:col-span-2">
                        <p class="text-[#7C0000] price" id="total-price-{{$cart->cart_id}}"
                            data-price="{{$cart->price}}">
                            IDR
                            {{number_format($cart->cart_price, 0, ',', '.')}}</p>
                    </div>
                </div>
                @endforeach
            </div>
            @else
            <div class="text-center text-gray-500 font-MadeTomy-thin text-2xl pt-32" colspan="5">
                Yahh... Keranjangnya Kosong, Yuk lanjutin belanjanya!!
            </div>
            <div class="flex justify-center pt-2">
                <a href="{{ route('shop') }}"
                    class="bg-[#7C0000] self-end text-white px-6 py-2  rounded w-full md:w-auto font-MadeTomy-Regular">Shop</a>
            </div>
            @endif
        </div>
        @if ($carts->count() > 0)
        <div class="px-20 flex justify-end">
            <a href="{{ route('checkout') }}" id="submitBtn"
                class="bg-[#FFF3B2] shadow-xl shadow-gray-300 self-end text-black px-4 py-3 rounded w-full md:w-auto">Checkout</a>
        </div>
        @endif
    </div>
</div>
@endsection

@section('script')
<script src="https://cdn.jsdelivr.net/npm/jquery@3.7.0/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.12/dist/sweetalert2.all.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.12/dist/sweetalert2.min.css">
<script>
    $.ajaxSetup({

        headers: {

            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

        }

    });
    
    function loadContent() {
        axios.get('cart/items')
        .then(response => {
        document.getElementById('div_cart').innerHTML = response.data;
        initializeDropdown(); // Re-initialize event listeners
        })
        .catch(error => {
        console.error('Error loading content:', error);
        });
        }
        
        document.addEventListener('DOMContentLoaded', function() {
            loadContent();
            });
            
    function clicked(id) {
        event.preventDefault(); //prevent default action
        let post_url = 'cart/'+id; //get form action url
        let request_method = 'DELETE'; //get form GET/POST method
        let form_data = $(this).serialize(); //Encode form elements for submission
        Swal.fire({
            title: 'Hapus?',
            text: "Yakin Gak Jadi Beli Sepatunyanya!",
            icon: 'warning',
            showDenyButton: true,
            confirmButtonColor: '#223e8c',
            denyButtonColor: '#d33',
            confirmButtonText: 'Ya, Hapus',
            denyButtonText: 'Batal',
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: post_url,
                    type: 'DELETE',
                    data: {
                    cart_id: id },
                    success: function (data) {
                        if ($.isEmptyObject(data.error)) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Data Berhasil Dihapus',
                                timer: 1500
                            })

                            loadContent();
                            // $("#div_cart").load(window.location.href + " #div_cart" );
                            //location.reload(true);
                            } else {
                                Swal.fire({
                                    title: 'Gagal Dihapus!',
                                    text: 'Terjadi kesalahan sistem!',
                                    icon: 'warning',
                                    confirmButtonText: 'OK',
                                    confirmButtonColor: 'orange'
                                }
                                );
                        }

                    }
                });
            }
        })
    };
</script>
<script>
    function formatNumber(number) {
		return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
	}

	// Function to save input value to localStorage
	function saveInputValue(productId, value) {
		localStorage.setItem('product_' + productId, value);
	}

	// Function to get input value from localStorage
	function getInputValue(productId) {
		return localStorage.getItem('product_' + productId) || '1'; // Default value is '1'
	}

	// Function untuk memeriksa dan mengatur nilai input dari localStorage
	function setInitialValues() {
		$('.input-qty').each(function() {
			let productId = $(this).closest('.cart-item').data('cart-id');
			let quantity = $(this).closest('.quantity').data('quantity');
			saveInputValue(productId, quantity);
            let storedValue = localStorage.getItem('product_' + productId);

			if (storedValue !== null) {
				$(this).val(storedValue);
			}
		});
	}

    function initializeDropdown (){
	$(document).ready(function() {
		let delayTimer;
        let debounceTimer;

		setInitialValues();

        const debounce = (func, delay) => {
            return function(args) {
            clearTimeout(debounceTimer);
            debounceTimer = setTimeout(() => func.apply(this, args), delay);
            };
            };

		$('.input-qty').on('input',
		function(e) {
			e.preventDefault();
			clearTimeout(delayTimer);

			let $this = $(this);
			let cartId = $this.closest('.cart-item').data('cart-id');
			let $input = $this;
			let price = $this.closest('.cart-item').find('.price').data('price');
			let value = parseInt($input.val());

			if (value >= 1) {
				value = value;
			} else {
				value = 0;
			}

			$input.val(value);

			delayTimer = setTimeout(function() {
				let total = value * price;
				let totalFormatted = formatNumber(total);
				$('#total-price-' + cartId).text('IDR ' + totalFormatted);
			},
			500); // Delay 600 milidetik (0.6 detik)
		});

		$('.minus-btn').on('click',
		function(e) {
			e.preventDefault();

			let $this = $(this);
			let cartId = $this.closest('.cart-item').data('cart-id');
			let $input = $this.closest('.cart-item').find('.input-qty');
			let price = $this.closest('.cart-item').find('.price').data('price');
			let value = parseInt($input.val());
            console.log(cartId);

			if (value > 1) {
				value = value - 1;
			} else {
				value = 1;
			}

			$input.val(value);

			let total = value * price;
			let totalFormatted = formatNumber(total);
			$('#total-price-' + cartId).text('IDR ' + totalFormatted);
            
            let post_url = 'cart/update/'+cartId;
            const delayTimerr = debounce(() => {
            $.ajax({
            method: 'PUT',
            url: post_url,
            data: {
            quantity: value,
            total: total
            }
            });
            },
            700); // Delay 600 milidetik (0.6 detik)

            delayTimerr();
		});

		$('.plus-btn').on('click',
		function(e) {
			e.preventDefault();

			let $this = $(this);
			let cartId = $this.closest('.cart-item').data('cart-id');
			let $input = $this.closest('.cart-item').find('.input-qty');
			let price = $this.closest('.cart-item').find('.price').data('price');
			let value = parseInt($input.val());

			if (value < 100) {
				value = value + 1;
			} else {
				value = 100;
			}
			$input.val(value);
			let total = value * price;
			let totalFormatted = formatNumber(total);
			$('#total-price-' + cartId).text('IDR ' + totalFormatted);

            let post_url = 'cart/update/'+cartId;
            const delayTimerr = debounce(() => {
            $.ajax({
            method: 'PUT',
            url: post_url,
            data: {
            quantity: value,
            total: total
            }
            });
            },
            700); // Delay 600 milidetik (0.6 detik)

            delayTimerr();
		});
	});
    };
</script>
{{-- Update pemilihan barang secara realtime --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {
                const checkboxes = document.querySelectorAll('input[name="options"]');
                const output = document.getElementById('output');
    
                function getCheckedValues() {
                    const values = [];
                    checkboxes.forEach((checkbox) => {
                        values.push({
                            cart_id: checkbox.dataset.id,
                            status: checkbox.checked ? 1 : 0
                        });
                    });
                    return values;
                }
    
                function sendDataToServer(values) {
                $.ajax({
                        url: '/checkout',
                        method: 'POST',
                        data:{
                        options: values
                        },
                    });
                    // .catch(error => {
                    //     console.error(error);
                    //     output.innerHTML = `<p>Error updating data.</p>`;
                    // });
                }
    
                checkboxes.forEach((checkbox) => {
                    checkbox.addEventListener('change', () => {
                        const values = getCheckedValues();
                        sendDataToServer(values);
                    });
                });
            });
</script>

{{-- Update Ketika Dilakukan Checkout // submitBtn ubah menjadi button --}}
{{-- <script>
    let button = document.querySelector('#submitBtn');
    
    button.addEventListener('click', ()=>{
                const checkboxes = document.querySelectorAll('input[name="options"]');
    
                    const values = [];
                    checkboxes.forEach((checkbox) => {
                        values.push({
                            cart_id: checkbox.dataset.id,
                            status: checkbox.checked ? 1 : 0
                        });
                    });


                $.ajax({
                        url: '/checkout',
                        type: 'POST',
                        data:{
                        options: values
                        },
                    })
                    .then(response => {
                    window.location = '/checkout';
                    });            
            });
</script> --}}
@endsection