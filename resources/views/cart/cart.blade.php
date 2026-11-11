@extends('layout.main')

@section('head')
<title>Cart - SKO</title>
@endsection

@section('content')
<div class="container mx-auto p-4">
    <div id="div_cart" aria-live="polite">
        <p class="text-center text-gray-500 pt-32">Memuat keranjang...</p>
    </div>
</div>
@endsection

@section('script')
<script>
    (function () {
        const container = document.getElementById('div_cart');
        const urls = {
            items: @json(route('cart.items')),
            update: (id) => @json(url('/cart/update')) + '/' + encodeURIComponent(id),
            destroy: (id) => @json(url('/cart')) + '/' + encodeURIComponent(id),
            select: @json(route('checkout.select')),
            checkout: @json(route('checkout')),
        };

        function loadContent() {
            $.ajax({ url: urls.items, method: 'GET', dataType: 'html', headers: { Accept: 'text/html' } })
                .done((html) => { container.innerHTML = html; refreshSummary(); })
                .fail((xhr) => {
                    container.innerHTML = '<p class="text-center text-red-600 pt-32">Gagal memuat keranjang. <a href="" class="underline">Muat ulang</a></p>';
                    if (xhr.status === 401) location.href = @json(route('login'));
                });
        }

        function rows() {
            return Array.from(container.querySelectorAll('.cart-item'));
        }

        function refreshSummary() {
            let total = 0, count = 0;
            rows().forEach((row) => {
                const checked = row.querySelector('input[name="options"]').checked;
                if (checked) {
                    total += Number(row.dataset.price) * Number(row.querySelector('.input-qty').value);
                    count++;
                }
            });
            const totalEl = document.getElementById('selectedTotal');
            const btn = document.getElementById('submitBtn');
            if (totalEl) totalEl.textContent = SKO.formatRupiah(total);
            if (btn) btn.classList.toggle('is-loading', count === 0);
        }

        function selection() {
            return rows().map((row) => ({
                cart_id: row.dataset.cartId,
                status: row.querySelector('input[name="options"]').checked ? 1 : 0,
            }));
        }

        let qtyTimers = {};
        function changeQty(row, delta) {
            const input = row.querySelector('.input-qty');
            const previous = Number(input.dataset.saved || input.value);
            const max = Number(row.dataset.stock) || 100;
            const next = Math.min(Math.max(Number(input.value) + delta, 1), Math.min(max, 100));
            if (next === Number(input.value)) {
                if (delta > 0) SKO.toast('info', `Stok tersisa ${max}`);
                return;
            }

            input.value = next;
            row.querySelector('.price').textContent = SKO.formatRupiah(next * Number(row.dataset.price));
            refreshSummary();

            const id = row.dataset.cartId;
            clearTimeout(qtyTimers[id]);
            qtyTimers[id] = setTimeout(() => {
                $.ajax({ url: urls.update(id), method: 'PUT', data: { quantity: input.value } })
                    .done((res) => {
                        input.dataset.saved = res.quantity;
                        row.querySelector('.price').textContent = SKO.formatRupiah(res.cart_price);
                    })
                    .fail((xhr) => {
                        input.value = previous;
                        row.querySelector('.price').textContent = SKO.formatRupiah(previous * Number(row.dataset.price));
                        refreshSummary();
                        SKO.toast('error', SKO.errorMessage(xhr));
                    });
            }, 500);
        }

        function removeItem(row) {
            Swal.fire({
                title: 'Hapus?',
                text: 'Yakin nggak jadi beli sepatunya?',
                icon: 'warning',
                showDenyButton: true,
                confirmButtonColor: '#223e8c',
                denyButtonColor: '#b91c1c',
                confirmButtonText: 'Ya, Hapus',
                denyButtonText: 'Batal',
            }).then((result) => {
                if (!result.isConfirmed) return;
                $.ajax({ url: urls.destroy(row.dataset.cartId), method: 'DELETE' })
                    .done(() => { SKO.toast('success', 'Item dihapus'); loadContent(); })
                    .fail((xhr) => SKO.toast('error', SKO.errorMessage(xhr, 'Gagal menghapus item')));
            });
        }

        // Delegasi event karena konten keranjang dimuat ulang via AJAX.
        container.addEventListener('click', (e) => {
            const row = e.target.closest('.cart-item');
            if (e.target.closest('.minus-btn')) { e.preventDefault(); changeQty(row, -1); }
            else if (e.target.closest('.plus-btn')) { e.preventDefault(); changeQty(row, 1); }
            else if (e.target.closest('.remove-btn')) { e.preventDefault(); removeItem(row); }
            else if (e.target.closest('#submitBtn')) {
                e.preventDefault();
                const btn = e.target.closest('#submitBtn');
                if (!selection().some((s) => s.status === 1)) {
                    SKO.toast('warning', 'Pilih minimal satu produk');
                    return;
                }
                btn.classList.add('is-loading');
                $.ajax({ url: urls.select, method: 'POST', data: { options: selection() } })
                    .done(() => { location.href = urls.checkout; })
                    .fail((xhr) => { btn.classList.remove('is-loading'); SKO.toast('error', SKO.errorMessage(xhr)); });
            }
        });

        let selectTimer;
        container.addEventListener('change', (e) => {
            if (e.target.name !== 'options') return;
            refreshSummary();
            clearTimeout(selectTimer);
            selectTimer = setTimeout(() => {
                $.ajax({ url: urls.select, method: 'POST', data: { options: selection() } })
                    .fail((xhr) => SKO.toast('error', SKO.errorMessage(xhr)));
            }, 300);
        });

        document.addEventListener('DOMContentLoaded', loadContent);
    })();
</script>
@endsection
