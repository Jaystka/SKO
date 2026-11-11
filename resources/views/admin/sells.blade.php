@extends('layout.sidebar')

@section('head')
<title>Penjualan - SKO</title>
@endsection

@section('content')
@php
    $filters = ['' => 'Semua', 'settlement' => 'Lunas', 'pending' => 'Menunggu', 'expire' => 'Kedaluwarsa', 'cancel' => 'Dibatalkan'];
@endphp
<main class="flex-1 overflow-y-auto px-8 pb-8">
  <div class="max-w-7xl mx-auto pt-4">
    <div class="flex justify-between items-center mb-6">
      <h1 class="text-xl font-MadeTomy-Medium">Penjualan</h1>
      <form method="GET" action="{{ route('transactions.admin') }}" class="flex items-center gap-2 text-sm">
        <label for="status">Status</label>
        <select id="status" name="status" class="p-2 border border-gray-300 rounded-lg bg-[#F8F7F3]" onchange="this.form.submit()">
          @foreach ($filters as $value => $label)
          <option value="{{ $value }}" @selected(($status ?? '') === $value)>{{ $label }}</option>
          @endforeach
        </select>
      </form>
    </div>
    <div class="bg-[#F8F7F3] px-6 pb-6 pt-2 rounded-xl shadow-xl overflow-x-auto">
      <table class="sko-admin-table">
        <thead>
          <tr>
            <th>No</th>
            <th>Order ID</th>
            <th>Tanggal</th>
            <th>Customer</th>
            <th>Status</th>
            <th>Pembayaran</th>
            <th>Ekspedisi</th>
            <th>Alamat</th>
            <th>Total</th>
          </tr>
        </thead>
        <tbody>
          @forelse ($transactions as $transaction)
          @php
              $badge = $transaction->isPaid() ? 'sko-badge--paid' : ($transaction->status === 'pending' ? 'sko-badge--pending' : 'sko-badge--failed');
          @endphp
          <tr>
            <td>{{ $transactions->firstItem() + $loop->index }}.</td>
            <td class="text-xs">{{ $transaction->transaction_id }}</td>
            <td class="text-xs">{{ $transaction->created_at?->format('d M Y H:i') ?? '-' }}</td>
            <td>
              {{ $transaction->recipient_name ?: $transaction->customer?->display_name ?? $transaction->customer_id }}
              @if ($transaction->recipient_phone)<div class="text-xs text-gray-500">{{ $transaction->recipient_phone }}</div>@endif
            </td>
            <td><span class="sko-badge {{ $badge }}">{{ $transaction->status_label }}</span></td>
            <td>{{ $transaction->payment_method ? str_replace('_', ' ', $transaction->payment_method) : '-' }}</td>
            <td>{{ $transaction->expedition ?? '-' }}</td>
            <td class="text-xs">{{ \Illuminate\Support\Str::limit($transaction->address ?? '-', 80) }}</td>
            <td class="whitespace-nowrap">IDR {{ number_format($transaction->total_payment, 0, ',', '.') }}</td>
          </tr>
          @empty
          <tr><td colspan="9" class="sko-empty">Belum ada transaksi.</td></tr>
          @endforelse
        </tbody>
      </table>
      {{ $transactions->links() }}
    </div>
  </div>
</main>
@endsection
