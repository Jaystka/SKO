@extends('../layout/main')

@section('head')
<title>Cart - SKO</title>
<link rel="stylesheet" href="dist/css/owl.carousel.min.css">
@endsection

@section('content')
<div class="container mx-auto p-4">
    <div class="" id="div_cart">
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
        initializeItems(); // Re-initialize event listeners
        loadCheck();
        })
        .catch(error => {
        console.error('Error loading content:', error);
        });
    };

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
            text: "Yakin Gak Jadi Beli Sepatunya!",
            icon: 'warning',
            showDenyButton: true,
            confirmButtonColor: '#223e8c',
            denyButtonColor: '#b91c1c',
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

    function initializeItems (){
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
            const delayTimer = debounce(() => {
            $.ajax({
            method: 'PUT',
            url: post_url,
            data: {
            quantity: value,
            total: total
            }
            });
            },
            650); // Delay 600 milidetik (0.6 detik)

            delayTimer();
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
            const delayTimer = debounce(() => {
            $.ajax({
            method: 'PUT',
            url: post_url,
            data: {
            quantity: value,
            total: total
            }
            });
            },
            650); // Delay 600 milidetik (0.6 detik)

            delayTimer();
		});
        @if($carts->count() > 0)
        document.getElementById('submitBtn').addEventListener('click', function(event) {
            event.preventDefault(); // Prevent default action
            
            const url = this.href;
            
            setTimeout(function() {
            window.location.href = url;
            }, 150);
            });
            @endif
	});
    };
</script>
{{-- Update pemilihan barang secara realtime --}}
<script>
    function loadCheck() {
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
            };
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