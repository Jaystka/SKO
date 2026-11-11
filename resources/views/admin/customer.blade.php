@extends('layout.sidebar')

@section('head')
<title>Customers - SKO</title>
@endsection

@section('content')
<main class="flex-1 overflow-y-auto px-8 pb-8">
  <div class="max-w-7xl mx-auto pt-4">
    <h1 class="text-xl font-MadeTomy-Medium mb-6">Customers</h1>
    <div class="bg-[#F8F7F3] px-6 pb-6 pt-2 rounded-xl shadow-xl overflow-x-auto">
      <table class="sko-admin-table">
        <thead>
          <tr>
            <th>No</th>
            <th>ID</th>
            <th>Nama</th>
            <th>Email</th>
            <th>No HP</th>
            <th>Alamat</th>
            <th>Terdaftar</th>
          </tr>
        </thead>
        <tbody>
          @forelse ($customers as $customer)
          <tr>
            <td>{{ $customers->firstItem() + $loop->index }}.</td>
            <td>{{ $customer->customer_id }}</td>
            <td>
              <div class="flex items-center gap-2">
                <img src="{{ $customer->avatar_url }}" alt="" class="w-8 h-8 rounded-full">
                {{ $customer->display_name }}
              </div>
            </td>
            <td>{{ $customer->email }}</td>
            <td>{{ $customer->phone ?? '-' }}</td>
            <td class="text-xs">{{ \Illuminate\Support\Str::limit($customer->address ?? '-', 80) }}</td>
            <td class="text-xs">{{ $customer->created_at?->format('d M Y') ?? '-' }}</td>
          </tr>
          @empty
          <tr><td colspan="7" class="sko-empty">Belum ada customer.</td></tr>
          @endforelse
        </tbody>
      </table>
      {{ $customers->links() }}
    </div>
  </div>
</main>
@endsection
