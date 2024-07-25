@extends('../layout/main')

@section('head')
<meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
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

    .textarea {
        resize: none;
    }
</style>
@endsection

@section('content')

<dialog id="modal" class="relative p-6 w-1/4 bg-white rounded-3xl shadow-lg">
    <div>
        <img id="iconImg" src="/img/Payment-Warning.svg" alt="">
    </div>
    <h2 id="modalTitle" class="mb-2 text-lg font-semibold text-center">Belum Bayar</h2>
    <p id="modalText" class="mb-6 text-gray-700 text-center">
        Pembayaran belum selesai, anda dapat melanjutkan pembayaran di halaman Notifikasi
    </p>
    <div id="modalWarning" class="flex justify-end space-x-2">
        <button id="closeModalButton1" class="px-4 py-2 text-white bg-gray-500 rounded-lg">
            Keluar
        </button>
        <button id="secondaryActionButton" class="px-4 py-2 text-black shadow-md bg-[#FFC727] rounded-lg">
            Ke Halaman Notifikasi
        </button>
    </div>
    <div id="modalView" class="flex justify-center space-x-2">
        <button id="closeModalButton2" class="w-1/2 px-4 py-2 text-white rounded-lg hidden">
            Ok
        </button>
    </div>
</dialog>

<main class="container mx-auto p-8 md:pt-28 md:px-28">
    {{-- <button id="openModalButton" class="px-4 py-2 text-white bg-indigo-500 rounded ">
        Open Modal
    </button> --}}
    <div class="md:flex md:space-x-8">
        <div class="md:w-2/3 space-y-4">
            <div class="bg-red-700 text-white p-4 text-center font-semibold">
                Lengkapi kolom di bawah ini!
            </div>
            <div>
                <div class="flex">
                    <h2 class="text-lg font-bold pr-4">Informasi Pengiriman</h2>
                    <button id="btnEdit" class="rounded-md p-1 shadow-md bg-[#FFF3B2]" data-popover-target="popover"
                        type="button"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                            viewBox="0 0 256 256">
                            <path fill="currentColor"
                                d="m227.32 73.37l-44.69-44.68a16 16 0 0 0-22.63 0L36.69 152A15.86 15.86 0 0 0 32 163.31V208a16 16 0 0 0 16 16h168a8 8 0 0 0 0-16H115.32l112-112a16 16 0 0 0 0-22.63M79.32 188l90.34-90.34l16.69 16.68L96 204.69Zm79-101.66L68 176.69L51.31 160l90.35-90.34ZM48 179.31L76.69 208H48Z" />
                        </svg></button>
                </div>

                @foreach ($customer as $item)
                <form id="formInfo" method="POST" action="{{route('payment')}}" class="space-y-4">
                    @csrf
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Nama <span
                                class="text-red-500">*</span></label>
                        <input type="text" value="{{$item->name}}" name="name" class="dataInput mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-red-500
                                focus:border-red-500 sm:text-sm" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">No HP <span
                                class="text-red-500">*</span></label>
                        <input type="text" value="{{$item->phone}}" name="phone"
                            class="dataInput mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm"
                            required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Alamat<span
                                class="text-red-500">*</span></label>
                        <div class="flex space-x-2" id="app">
                            <div class="w-[20%]">
                                <select id="province"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option value="">Provinsi</option>
                                </select>
                            </div>

                            <div>
                                <select id="regency"
                                    class=" hidden bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    disabled>
                                    <option value="">Kabupaten/Kota</option>
                                </select>
                            </div>

                            <div>
                                <select id="district"
                                    class="hidden bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    disabled>
                                    <option value="">Kecamatan</option>
                                </select>
                            </div>

                            <div>
                                <select id="village"
                                    class="hidden bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    disabled>
                                    <option value="">Desa/Kelurahan</option>
                                </select>
                            </div>

                        </div>
                        <textarea name="address"
                            class="textarea dataInput mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm"
                            rows="4" required>{{$item->address}}</textarea>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Informasi Tambahan</label>
                        <textarea
                            class="textarea mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm"
                            rows="3"></textarea>
                    </div>
                    @endforeach
            </div>
        </div>
        <div class="md:w-2/3 space-y-4 mt-8 md:mt-0">
            <div class="bg-[#F4F2E8] border-[#979797] border-2 p-8 h-full">
                <h2 class="text-lg font-bold text-red-700 mb-4">Daftar Pesanan</h2>
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
                        <div>Pajak</div>
                        <div>IDR {{ number_format($carts->sum('tax'), 0, ',', '.')}}</div>
                    </div>
                </div>
                <div class="flex justify-between text-xl font-bold">
                    <div>Total</div>
                    <div>IDR {{ number_format(($carts->sum('cart_price')+$carts->sum('tax')), 0, ',', '.')}}</div>
                </div>

                <div class="w-1/4 pt-4">
                    <select id="expedition" name="expedition"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option selected>Pilih Kurir</option>
                        @foreach ($expeditions as $expedition)
                        <option value="{{$expedition->expedition}}">{{$expedition->expedition}}</option>
                        @endforeach
                    </select>
                </div>
                </form>
                <button form="formInfo" id="pay-button"
                    class="w-full bg-[#FFF3B2] shadow-md text-gray-800 hover:bg-black hover:text-white font-bold py-3 rounded-md mt-12">Buat
                    Pesanan</button>
            </div>
        </div>
    </div>
</main>
<footer class="text-center text-gray-500 text-sm">
    ©SKO 2023. All rights reserved.
</footer>
@endsection

@section('script')

<!-- Include Alpine.js for collapse functionality -->
<script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2/dist/alpine.min.js" defer></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.12/dist/sweetalert2.all.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.12/dist/sweetalert2.min.css">
@if($item->name == null || $item->address == null || $item->phone == null)
<script>
    document.addEventListener('DOMContentLoaded', function() {
        Swal.fire({text: "Anda dapat melengkapi data diri di laman profile!",
        showDenyButton: true,
        confirmButtonColor: "#b91c1c",
        denyButtonColor: '#979797',
        confirmButtonText: 'Lengkapi',
        denyButtonText: 'Batal',
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            window.location = 'profile';
        }});
            });
</script>
@endif
<script>
    const toggleButtons = document.querySelectorAll('[id^=productItem]');
    const toggleAllButton = document.getElementById('toggleAllProducts');
    const productOrder = document.getElementById('productOrder');

    if(toggleButtons.length > 1){
    toggleAllButton.addEventListener('click', () => {
    if(toggleButtons.length > 1){
    productOrder.classList.toggle('h-60');
    i=1;
    while (i < toggleButtons.length) { const orderItem=document.getElementById(`productItem${i}`);
        orderItem.classList.toggle('collapsed'); orderItem.classList.toggle('expanded'); i++; } } }); }
</script>
<!-- TODO: Remove ".sandbox" from script src URL for production environment. Also input your client key in "data-client-key" -->
<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{$midtransClientKey}}"></script>
<script type="text/javascript">
    // Function to show payment modal
    function showPaymentModal(iconSrc, titleText, messageText, buttonClass) {
    console.log('ya ini juga');
    modal.showModal();
    modal.classList.add("showing");
    modalIcon.src = iconSrc;
    modalTitle.innerText = titleText;
    modalText.innerText = messageText;
    closeModalButton2.classList.remove("bg-blueBtn", "bg-redBtn"); // Remove previous classes
    if (buttonClass) {
    closeModalButton2.classList.add(buttonClass);
    }
    }

    $.ajaxSetup({

		headers: {

			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

		}
	});
	$("#formInfo").submit(function(event) {
		event.preventDefault(); //prevent default action
		let form_data = $(this).serialize(); //Encode form elements for submission
		let post_url = $(this).attr("action"); //get form action url
		$.ajax({
			url: post_url,
			method: 'POST',
			data: form_data,
			success: function(data) {
				// SnapToken acquired from previous step
				snap.pay(data.token, {
					// Optional
					onSuccess: function(result) {
                        modalWarning.classList.add("hidden");
                        closeModalButton2.classList.remove("hidden");
                        showPaymentModal("/img/Payment-Success.svg", "Terbayar!", "Yey.. Pembayaran berhasil, pengiriman akan segera diproses",
                        "bg-blueBtn");
						checkPaymentStatus(result.order_id);
						
					},
					// Optional
					onPending: function(result) {
						showPaymentModal("/img/Payment-Warning.svg", "Belum Bayar!", "Pembayaran belum selesai, anda dapat melanjutkan pembayaran di halaman Notifikasi", "");
						checkPaymentStatus(result.order_id);
                    
					},
					// Optional
					onError: function(result) {
                        modalWarning.classList.add("hidden");
                        closeModalButton2.classList.remove("hidden");
						showPaymentModal("/img/Payment-Error.svg", "Gagal!", "Yah.. Pembayaran gagal, kami akan segera menanganinya", "bg-redBtn");
			
					},
					onClose: function() {
						modal.showModal();
                        modal.classList.add("showing");
						console.log('customer closed the popup without finishing the payment');
					}
				});
			}
		});
	});

	function checkPaymentStatus(order_id) {
		$.ajax({
			url: '/check-payment-status',
			// Endpoint to check payment status on your server
			type: 'POST',
			data: {
				order_id: order_id
			},
			success: function(response) {
				if (response.status === 'success') {
					// Update UI for successful payment
				} else if (response.status === 'pending') {
                    // showPaymentModal("/img/Payment-Warning.svg", "Belum Bayar!", "Transaksi tertunda, mohon tunggu beberapa saat hingga pembayaran berhasil", "");
					console.log('ini modal');
				} else if (response.status === 'failed') {
					// Update UI for failed payment
				}
			},
			error: function(xhr) {
				console.error('Error checking payment status:', xhr);
			}
		});
	}

</script>
<script>
    const modal = document.getElementById("modal");
    const modalIcon = document.getElementById("iconImg");
    const modalTitle = document.getElementById("modalTitle");
    const modalText = document.getElementById("modalText");
    const modalWarning = document.getElementById("modalWarning");
    const modalView = document.getElementById("modalView");
    modal.addEventListener('cancel', (event) => {
        event.preventDefault();
        }); 
    const closeModalButton1 = document.getElementById("closeModalButton1");
    const closeModalButton2 = document.getElementById("closeModalButton2");

    const secondaryActionButton = document.getElementById(
      "secondaryActionButton"
    );

    closeModalButton1.addEventListener("click", closeModal);
    closeModalButton2.addEventListener("click", closeModal);
    secondaryActionButton.addEventListener("click", () => {
      console.log("Secondary action executed");
      

    });

    function closeModal() {
      modal.classList.remove("showing");
      modal.classList.add("closing");
      modal.addEventListener(
        "animationend",
        () => {
          modal.close();
          modal.classList.remove("closing");
          window.location.href = "{{route('shop')}}";
        },
        { once: true }
      );
    }
// const dataInput = document.getElementsByClassName('dataInput');
// const btnEdit = document.getElementById('btnEdit');
//     btnEdit.addEventListener("click", () => {
//         Array.from(dataInput).forEach((dataInput) => {
//             dataInput.removeAttribute("disabled");
//             });
//         });
</script>

<script>
    $(document).ready(function() {
            const baseApiUrl = `${window.location.origin}/api/proxy`;
            
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            const $province = $('#province');
            const $regency = $('#regency');
            const $district = $('#district');
            const $village = $('#village');

            function cleanJsonString(data) {
                const jsonStart = data.indexOf('[');
                return data.substring(jsonStart);
            }

            function handleError(entity, error) {
                console.error(`Error fetching ${entity}:`, error);
            }

            function fetchProvinces() {
                $.ajax({
                    url: `${baseApiUrl}/provinces`,
                    method: 'GET',
                    success: function(data) {
                        const cleanedData = cleanJsonString(data);
                        const jsonData = JSON.parse(cleanedData);

                        let options = '<option value="">Provinsi</option>';
                        jsonData.forEach(province => {
                            options += `<option value="${province.id}">${province.name}</option>`;
                        });
                        $province.html(options).prop('disabled', false).removeClass('hidden');
                    },
                    error: function(xhr, status, error) {
                        handleError('provinces', error);
                    }
                });
            }

            function fetchRegencies(provinceId) {
                $.ajax({
                    url: `${baseApiUrl}/regencies/${provinceId}`,
                    method: 'GET',
                    success: function(data) {
                        const cleanedData = cleanJsonString(data);
                        const jsonData = JSON.parse(cleanedData);

                        let options = '<option value="">Kabupaten/Kota</option>';
                        jsonData.forEach(regency => {
                            options += `<option value="${regency.id}">${regency.name}</option>`;
                        });
                        $regency.html(options).prop('disabled', false).removeClass('hidden');
                    },
                    error: function(xhr, status, error) {
                        handleError('regencies', error);
                    }
                });
            }

            function fetchDistricts(regencyId) {
                $.ajax({
                    url: `${baseApiUrl}/districts/${regencyId}`,
                    method: 'GET',
                    success: function(data) {
                        const cleanedData = cleanJsonString(data);
                        const jsonData = JSON.parse(cleanedData);

                        let options = '<option value="">Kecamatan</option>';
                        jsonData.forEach(district => {
                            options += `<option value="${district.id}">${district.name}</option>`;
                        });
                        $district.html(options).prop('disabled', false).removeClass('hidden');
                    },
                    error: function(xhr, status, error) {
                        handleError('districts', error);
                    }
                });
            }

            function fetchVillages(districtId) {
                $.ajax({
                    url: `${baseApiUrl}/villages/${districtId}`,
                    method: 'GET',
                    success: function(data) {
                        const cleanedData = cleanJsonString(data);
                        const jsonData = JSON.parse(cleanedData);

                        let options = '<option value="">Desa/Kelurahan</option>';
                        jsonData.forEach(village => {
                            options += `<option value="${village.id}">${village.name}</option>`;
                        });
                        $village.html(options).prop('disabled', false).removeClass('hidden');
                    },
                    error: function(xhr, status, error) {
                        handleError('villages', error);
                    }
                });
            }

            $province.change(function() {
                const provinceId = $(this).val();
                if (provinceId) {
                    fetchRegencies(provinceId);
                    $regency.html('<option value="">Kabupaten/Kota</option>').prop('disabled', true).addClass('hidden');
                    $district.html('<option value="">Kecamatan</option>').prop('disabled', true).addClass('hidden');
                    $village.html('<option value="">Desa/Kelurahan</option>').prop('disabled', true).addClass('hidden');
                }
            });

            $regency.change(function() {
                const regencyId = $(this).val();
                if (regencyId) {
                    fetchDistricts(regencyId);
                    $district.html('<option value="">Kecamatan</option>').prop('disabled', true).addClass('hidden');
                    $village.html('<option value="">Desa/Kelurahan</option>').prop('disabled', true).addClass('hidden');
                }
            });

            $district.change(function() {
                const districtId = $(this).val();
                if (districtId) {
                    fetchVillages(districtId);
                    $village.html('<option value="">Desa/Kelurahan</option>').prop('disabled', true).addClass('hidden');
                }
            });

            fetchProvinces();
        });
</script>
@endsection