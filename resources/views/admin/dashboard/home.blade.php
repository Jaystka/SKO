@extends('layout.sidebar')

@section('head')
<title>Dashboard - SKO</title>
@endsection

@section('content')
@php
    $rupiah = fn ($v) => 'Rp '.number_format($v, 0, ',', '.');
    $maxMonthly = max(1, $monthly->max('total'));
@endphp
<main class="flex-1 overflow-y-auto px-8 pb-10">
    <h2 class="py-2 font-MadeTomy-Regular text-xl">Dashboard</h2>
    <div class="flex flex-col lg:flex-row lg:space-x-3">
        <div class="flex-1">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                <div class="bg-[#F8F7F3] border p-4 rounded-2xl drop-shadow-xl">
                    <h3 class="font-MadeTomy-Medium">Pendapatan</h3>
                    <p class="text-xs pb-3">{{ now()->translatedFormat('F Y') }}</p>
                    <p class="text-xl font-MadeTomy-Medium">{{ $rupiah($stats['income_month']) }}</p>
                    <p class="text-xs text-gray-500 pt-2">Total: {{ $rupiah($stats['income_total']) }}</p>
                </div>
                <div class="bg-[#F8F7F3] border p-4 rounded-2xl drop-shadow-xl">
                    <h3 class="font-MadeTomy-Medium">Pesanan</h3>
                    <p class="text-xs pb-3">Lunas / menunggu pembayaran</p>
                    <p class="text-xl font-MadeTomy-Medium">{{ number_format($stats['orders_paid']) }} / {{ number_format($stats['orders_pending']) }}</p>
                    <a href="{{ route('transactions.admin') }}" class="text-xs text-gray-500 pt-2 underline">Lihat penjualan</a>
                </div>
                <div class="bg-[#F8F7F3] border p-4 rounded-2xl drop-shadow-xl">
                    <h3 class="font-MadeTomy-Medium">Toko</h3>
                    <p class="text-xs pb-3">Customer / produk</p>
                    <p class="text-xl font-MadeTomy-Medium">{{ number_format($stats['customers']) }} / {{ number_format($stats['products']) }}</p>
                </div>
            </div>
            <div class="bg-[#F8F7F3] p-4 rounded-xl drop-shadow-xl mb-6">
                <h3 class="text-xl font-semibold mb-4">Pendapatan 6 Bulan Terakhir</h3>
                <div class="flex items-end justify-between gap-2" style="height: 220px">
                    @foreach ($monthly as $m)
                    <div class="flex flex-col items-center justify-end flex-1 h-full" title="{{ $m['label'] }}: {{ $rupiah($m['total']) }}">
                        <span class="text-xs text-gray-500 mb-1">{{ $m['total'] > 0 ? number_format($m['total'] / 1000, 0, ',', '.').'rb' : '' }}</span>
                        <div class="w-full rounded-t-md bg-[#575757]" style="height: {{ max(2, round($m['total'] / $maxMonthly * 170)) }}px"></div>
                        <span class="text-xs pt-2">{{ $m['label'] }}</span>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="flex-shrink-0 w-full lg:w-1/3 bg-[#F8F7F3] p-4 rounded-xl drop-shadow-xl self-start">
            <h3 class="text-xl font-semibold mb-3">Pesanan Terbaru</h3>
            <div class="space-y-2.5">
                @forelse ($recentOrders as $order)
                @php $paid = $order->transaction?->isPaid(); @endphp
                <div class="flex justify-between items-center p-4 bg-[#F8F7F3] rounded-lg border border-gray-200 shadow-md gap-2">
                    <div>
                        <p class="font-semibold text-sm">{{ $order->product?->series ?? $order->product_id }}</p>
                        <p class="text-gray-500 text-xs">Sepatu {{ $order->product?->brand?->brand }} | size {{ $order->size ?? '-' }} | {{ $order->qty }} pcs</p>
                    </div>
                    <div class="text-right">
                        <div class="text-red-500 text-xs">{{ $rupiah($order->total_price) }}</div>
                        <span class="sko-badge {{ $paid ? 'sko-badge--paid' : 'sko-badge--pending' }}">
                            {{ $order->transaction?->status_label ?? $order->status }}
                        </span>
                    </div>
                </div>
                @empty
                <p class="sko-empty">Belum ada pesanan.</p>
                @endforelse
                <div class="pb-2">
                    <a href="{{ route('transactions.admin') }}" class="px-5 py-3 border bg-[#F8F7F3] text-gray-500 w-full flex items-center justify-center rounded-md font-semibold drop-shadow-md">Lihat Semua</a>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
