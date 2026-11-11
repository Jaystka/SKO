@extends('layout.main')

@section('head')
<title>Checkout - SKO</title>
<style>
    .collapsed { display: none; }
    .textarea { resize: none; }
</style>
@endsection

@section('content')
@php
    $selectClass = 'bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5';
    $inputClass = 'dataInput mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm';
    $profileIncomplete = blank($customer->name) || blank($customer->phone) || blank($customer->address);
@endphp

<dialog id="modal" class="relative p-6 w-1/4 bg-white rounded-3xl shadow-lg">
    <div>
        <img id="iconImg" src="{{ asset('img/Payment-Warning.svg') }}" alt="">
    </div>
    <h2 id="modalTitle" class="mb-2 text-lg font-semibold text-center">Belum Bayar</h2>
    <p id="modalText" class="mb-6 text-gray-700 text-center">
        Pembayaran belum selesai. Anda dapat melanjutkan pembayaran melalui instruksi yang dikirim Midtrans.
    </p>
    <div class="flex justify-center space-x-2">
        <button id="closeModalButton" type="button" class="px-4 py-2 text-white bg-gray-500 rounded-lg">
            Ok
        </button>
    </div>
</dialog>

<main class="container mx-auto p-8 md:pt-28 md:px-28">
    <div class="md:flex md:space-x-8">
        <div class="md:w-2/3 space-y-4">
            <div class="bg-red-700 text-white p-4 text-center font-semibold">
                Lengkapi kolom di bawah ini!
            </div>
            <div>
                <div class="flex">
                    <h2 class="text-lg font-bold pr-4">Informasi Pengiriman</h2>
                    <a href="{{ route('editprofile.index') }}" class="rounded-md p-1 shadow-md bg-[#FFF3B2]"
                        title="Ubah data profil" aria-label="Ubah data profil">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 256 256">
                            <path fill="currentColor"
                                d="m227.32 73.37l-44.69-44.68a16 16 0 0 0-22.63 0L36.69 152A15.86 15.86 0 0 0 32 163.31V208a16 16 0 0 0 16 16h168a8 8 0 0 0 0-16H115.32l112-112a16 16 0 0 0 0-22.63M79.32 188l90.34-90.34l16.69 16.68L96 204.69Zm79-101.66L68 176.69L51.31 160l90.35-90.34ZM48 179.31L76.69 208H48Z" />
                        </svg>
                    </a>
                </div>

                <form id="formInfo" method="POST" action="{{ route('payment') }}" class="space-y-4" novalidate>
                    @csrf
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700">Nama <span class="text-red-500">*</span></label>
                        <input id="name" type="text" value="{{ $customer->name ?: $customer->username }}" name="name"
                            class="{{ $inputClass }}" maxlength="255" autocomplete="name" required>
                        <p class="sko-field-error" data-error-for="name"></p>
                    </div>
                    <div>
                        <label for="phone" class="block text-sm font-medium text-gray-700">No HP <span class="text-red-500">*</span></label>
                        <input id="phone" type="tel" value="{{ $customer->phone }}" name="phone" class="{{ $inputClass }}"
                            maxlength="20" inputmode="tel" autocomplete="tel" placeholder="08xxxxxxxxxx" required>
                        <p class="sko-field-error" data-error-for="phone"></p>
                    </div>
                    <div>
                        <label for="addressDetail" class="block text-sm font-medium text-gray-700">Alamat <span class="text-red-500">*</span></label>
                        <div class="flex space-x-2 sko-region">
                            <div class="w-1/4">
                                <select id="province" class="{{ $selectClass }}" aria-label="Provinsi">
                                    <option value="">Provinsi</option>
                                </select>
                            </div>
                            <div class="w-1/4">
                                <select id="regency" class="hidden {{ $selectClass }}" aria-label="Kabupaten/Kota" disabled>
                                    <option value="">Kabupaten/Kota</option>
                                </select>
                            </div>
                            <div class="w-1/4">
                                <select id="district" class="hidden {{ $selectClass }}" aria-label="Kecamatan" disabled>
                                    <option value="">Kecamatan</option>
                                </select>
                            </div>
                            <div class="w-1/4">
                                <select id="village" class="hidden {{ $selectClass }}" aria-label="Desa/Kelurahan" disabled>
                                    <option value="">Desa/Kelurahan</option>
                                </select>
                            </div>
                        </div>
                        <textarea id="addressDetail" class="textarea {{ $inputClass }}" rows="4" maxlength="800"
                            placeholder="Nama jalan, nomor rumah, RT/RW, kode pos" required>{{ $customer->address }}</textarea>
                        <input type="hidden" name="address" id="address">
                        <p class="text-xs text-gray-500 mt-1">Pilihan wilayah (opsional) akan ditambahkan ke alamat.</p>
                        <p class="sko-field-error" data-error-for="address"></p>
                    </div>
                    <div>
                        <label for="note" class="block text-sm font-medium text-gray-700">Informasi Tambahan</label>
                        <textarea id="note" class="textarea {{ $inputClass }}" rows="3" maxlength="150"
                            placeholder="Contoh: patokan rumah, warna pagar"></textarea>
                    </div>
                </form>
            </div>
        </div>
        <div class="md:w-2/3 space-y-4 mt-8 md:mt-0">
            <div class="bg-[#F4F2E8] border-[#979797] border-2 p-8 h-full">
                <h2 class="text-lg font-bold text-red-700 mb-4">Daftar Pesanan</h2>
                <div id="productOrder">
                    @foreach ($carts as $cart)
                    <div class="{{ $loop->first ? '' : 'collapsed order-extra' }}">
                        <div class="flex items-center py-4 border-b border-gray-300">
                            <img src="{{ $cart->product->image_url }}" alt="{{ $cart->product->series }}"
                                class="w-20 h-20 object-cover" loading="lazy">
                            <div class="ml-4 flex-1">
                                <div class="font-semibold">{{ $cart->product->brand?->brand }} {{ $cart->product->series }}</div>
                                <div class="text-sm text-gray-600">Size {{ $cart->size }}</div>
                            </div>
                            <div class="lg:w-1/3 flex mr-2">
                                <div class="mx-2 font-sm">{{ $cart->quantity }}x</div>
                                <div class="ml-auto font-semibold">IDR {{ number_format($cart->product->price * $cart->quantity, 0, ',', '.') }}</div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                @if ($carts->count() > 1)
                <div class="text-center">
                    <button id="toggleAllProducts" type="button" class="text-gray-500 px-4 rounded focus:outline-none" aria-expanded="false">
                        <p id="toggleLabel">Tampilkan semua produk ({{ $carts->count() }})</p>
                    </button>
                </div>
                @endif

                <div class="py-4 border-b border-gray-300">
                    <div class="flex justify-between">
                        <div>Subtotal</div>
                        <div>IDR {{ number_format($summary['subtotal'], 0, ',', '.') }}</div>
                    </div>
                    <div class="flex justify-between">
                        <div>Pajak</div>
                        <div>IDR {{ number_format($summary['tax'], 0, ',', '.') }}</div>
                    </div>
                </div>
                <div class="flex justify-between text-xl font-bold">
                    <div>Total</div>
                    <div>IDR {{ number_format($summary['total'], 0, ',', '.') }}</div>
                </div>

                <div class="w-1/2 pt-4">
                    <label for="expedition" class="block text-sm font-medium text-gray-700 mb-1">Kurir <span class="text-red-500">*</span></label>
                    <select id="expedition" name="expedition" form="formInfo" class="{{ $selectClass }}" required>
                        <option value="" selected disabled>Pilih Kurir</option>
                        @foreach ($expeditions as $expedition)
                        <option value="{{ $expedition->expedition }}">{{ $expedition->expedition }}</option>
                        @endforeach
                    </select>
                    <p class="sko-field-error" data-error-for="expedition"></p>
                </div>

                <button form="formInfo" id="pay-button" type="submit"
                    class="sko-btn w-full bg-[#FFF3B2] shadow-md text-gray-800 hover:bg-black hover:text-white font-bold py-3 rounded-md mt-12">
                    Buat Pesanan
                </button>
            </div>
        </div>
    </div>
</main>
@include('partials.footer')
@endsection

@section('script')
@if ($midtransClientKey)
<script src="{{ $midtransSnapUrl }}" data-client-key="{{ $midtransClientKey }}"></script>
@endif

@if ($profileIncomplete)
<script>
    document.addEventListener('DOMContentLoaded', function () {
        Swal.fire({
            text: 'Anda dapat melengkapi data diri di halaman profil agar checkout berikutnya lebih cepat.',
            showDenyButton: true,
            confirmButtonColor: '#b91c1c',
            denyButtonColor: '#979797',
            confirmButtonText: 'Lengkapi',
            denyButtonText: 'Nanti',
            reverseButtons: true,
        }).then((result) => {
            if (result.isConfirmed) window.location = @json(route('editprofile.index'));
        });
    });
</script>
@endif

<script>
    (function () {
        const urls = {
            status: @json(route('check.payment.status')),
            shop: @json(route('shop')),
            proxy: @json(url('/api/proxy')),
        };
        const assets = {
            success: @json(asset('img/Payment-Success.svg')),
            pending: @json(asset('img/Payment-Warning.svg')),
            error: @json(asset('img/Payment-Error.svg')),
        };

        // ---------- Tampilkan / sembunyikan produk ----------
        const toggleAll = document.getElementById('toggleAllProducts');
        if (toggleAll) {
            toggleAll.addEventListener('click', () => {
                const expanded = toggleAll.getAttribute('aria-expanded') === 'true';
                document.querySelectorAll('.order-extra').forEach((el) => el.classList.toggle('collapsed', expanded));
                toggleAll.setAttribute('aria-expanded', String(!expanded));
                document.getElementById('toggleLabel').textContent = expanded
                    ? 'Tampilkan semua produk ({{ $carts->count() }})'
                    : 'Sembunyikan';
            });
        }

        // ---------- Modal status pembayaran ----------
        const modal = document.getElementById('modal');
        let redirectAfterClose = false;
        modal.addEventListener('cancel', (event) => event.preventDefault());
        document.getElementById('closeModalButton').addEventListener('click', () => {
            modal.close();
            if (redirectAfterClose) window.location.href = urls.shop;
        });

        function showPaymentModal(type, title, text) {
            document.getElementById('iconImg').src = assets[type];
            document.getElementById('modalTitle').innerText = title;
            document.getElementById('modalText').innerText = text;
            redirectAfterClose = type !== 'error';
            if (!modal.open) modal.showModal();
        }

        function checkPaymentStatus(orderId) {
            $.ajax({ url: urls.status, method: 'POST', data: { order_id: orderId } })
                .done((res) => {
                    if (res.paid) {
                        showPaymentModal('success', 'Terbayar!', 'Yey.. Pembayaran berhasil, pengiriman akan segera diproses.');
                    }
                });
        }

        // ---------- Validasi & submit ----------
        const form = document.getElementById('formInfo');
        const payButton = document.getElementById('pay-button');

        function clearErrors() {
            document.querySelectorAll('[data-error-for]').forEach((el) => (el.textContent = ''));
            document.querySelectorAll('.sko-input-error').forEach((el) => el.classList.remove('sko-input-error'));
        }

        function showErrors(errors) {
            Object.entries(errors).forEach(([field, messages]) => {
                const target = document.querySelector(`[data-error-for="${field}"]`);
                if (target) target.textContent = messages[0];
                const input = field === 'address' ? document.getElementById('addressDetail') : document.getElementById(field);
                if (input) input.classList.add('sko-input-error');
            });
        }

        function composeAddress() {
            const parts = [document.getElementById('addressDetail').value.trim()];
            ['village', 'district', 'regency', 'province'].forEach((id) => {
                const select = document.getElementById(id);
                if (select.value) parts.push(select.options[select.selectedIndex].text);
            });
            const note = document.getElementById('note').value.trim();
            let address = parts.filter(Boolean).join(', ');
            if (note) address += ` (Catatan: ${note})`;
            document.getElementById('address').value = address;
        }

        form.addEventListener('submit', function (event) {
            event.preventDefault();
            clearErrors();
            composeAddress();

            const errors = {};
            if (!document.getElementById('name').value.trim()) errors.name = ['Nama wajib diisi.'];
            if (!document.getElementById('phone').value.trim()) errors.phone = ['No HP wajib diisi.'];
            if (!document.getElementById('addressDetail').value.trim()) errors.address = ['Alamat wajib diisi.'];
            if (!document.getElementById('expedition').value) errors.expedition = ['Pilih kurir pengiriman.'];
            if (Object.keys(errors).length) { showErrors(errors); return; }

            if (typeof window.snap === 'undefined') {
                SKO.toast('error', 'Layanan pembayaran belum siap. Muat ulang halaman atau hubungi admin.');
                return;
            }

            payButton.disabled = true;
            payButton.classList.add('is-loading');

            $.ajax({ url: form.action, method: 'POST', data: $(form).serialize() })
                .done((data) => {
                    window.snap.pay(data.token, {
                        onSuccess: (result) => {
                            showPaymentModal('success', 'Terbayar!', 'Yey.. Pembayaran berhasil, pengiriman akan segera diproses.');
                            checkPaymentStatus(result.order_id);
                        },
                        onPending: (result) => {
                            showPaymentModal('pending', 'Belum Bayar', 'Pesanan dibuat. Selesaikan pembayaran sesuai instruksi dari Midtrans.');
                            checkPaymentStatus(result.order_id);
                        },
                        onError: () => {
                            showPaymentModal('error', 'Gagal!', 'Yah.. Pembayaran gagal, silakan coba lagi.');
                        },
                        onClose: () => {
                            showPaymentModal('pending', 'Belum Bayar', 'Pesanan sudah dibuat tetapi belum dibayar. Selesaikan pembayaran sesuai instruksi Midtrans.');
                            checkPaymentStatus(data.order_id);
                        },
                    });
                })
                .fail((xhr) => {
                    if (xhr.status === 422 && xhr.responseJSON && xhr.responseJSON.errors) {
                        showErrors(xhr.responseJSON.errors);
                    }
                    SKO.toast('error', SKO.errorMessage(xhr));
                    payButton.disabled = false;
                    payButton.classList.remove('is-loading');
                });
        });

        // ---------- Data wilayah ----------
        const selects = {
            province: document.getElementById('province'),
            regency: document.getElementById('regency'),
            district: document.getElementById('district'),
            village: document.getElementById('village'),
        };
        const placeholders = { province: 'Provinsi', regency: 'Kabupaten/Kota', district: 'Kecamatan', village: 'Desa/Kelurahan' };
        const endpoints = { province: 'provinces', regency: 'regencies', district: 'districts', village: 'villages' };

        function reset(...keys) {
            keys.forEach((key) => {
                selects[key].innerHTML = '';
                selects[key].add(new Option(placeholders[key], ''));
                selects[key].disabled = true;
                selects[key].classList.add('hidden');
            });
        }

        function load(key, parentId) {
            const url = `${urls.proxy}/${endpoints[key]}` + (parentId ? `/${encodeURIComponent(parentId)}` : '');
            $.ajax({ url, method: 'GET', dataType: 'json' })
                .done((rows) => {
                    reset(key);
                    // Option() meng-escape teks, aman dari injeksi HTML.
                    rows.forEach((row) => selects[key].add(new Option(row.name, row.id)));
                    selects[key].disabled = false;
                    selects[key].classList.remove('hidden');
                })
                .fail(() => {
                    if (key === 'province') selects.province.closest('div').classList.add('hidden');
                });
        }

        selects.province.addEventListener('change', (e) => { reset('regency', 'district', 'village'); if (e.target.value) load('regency', e.target.value); });
        selects.regency.addEventListener('change', (e) => { reset('district', 'village'); if (e.target.value) load('district', e.target.value); });
        selects.district.addEventListener('change', (e) => { reset('village'); if (e.target.value) load('village', e.target.value); });

        load('province');
    })();
</script>
@endsection
