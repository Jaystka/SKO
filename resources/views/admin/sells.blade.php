@extends('../layout/sidebar')

@section('head')
<title>Customers - SKO</title>
@endsection

@section('content')
<main class="flex-1 overflow-y-auto px-8">
  <!----------------------------- Batas contain ---------------------------------------------------->
  <div class="max-w-7xl mx-auto pt-4">
    <div class="flex justify-between items-center">
        <div class="mb-10 pb-2">
        <h1 class="text-xl font-MadeTomy-Medium">Customers</h1>
        </div>
    </div>
    <div class="bg-[#F8F7F3] px-6 pb-6 pt-2 rounded-xl shadow-xl">
        <div class="overflow-x-auto">
          <div class="min-w-full space-y-3 px-4 pb-7">
              <div class="grid grid-cols-11 px-4 border-gray-200 text-sm font-bold text-gray-500">
                  <div class="col-span-1 flex items-center justify-center">No</div>
                  <div class="col-span-2 text-center">Nama</div>
                  <div class="col-span-2 text-center">Status</div>
                  <div class="col-span-2 text-center">Payment</div>
                  <div class="col-span-2 text-center">Ekspedisi</div>
                  <div class="col-span-2 text-center">Total Pembayaran</div>
              </div>
              @foreach($transactions as $index => $transaction)
              <div class="grid grid-cols-11 py-4 px-4 border-b border-gray-200 shadow-lg rounded-xl">
                  <div class="col-span-1 flex items-center justify-center">{{ $index + 1 }}</div>
                  <div class="col-span-2 flex items-center justify-center">{{ $transaction->customer_name }}</div>
                  <div class="col-span-2 flex items-center justify-center">{{ $transaction->status }}</div>
                  <div class="col-span-2 flex items-center justify-center">{{ $transaction->payment_method }}</div>
                  <div class="col-span-2 flex items-center justify-center text-sm">{{ $transaction->expedition }}</div>
                  <div class="col-span-2 flex items-center justify-center text-sm">{{ $transaction->price_total }}</div>
              </div>    
              @endforeach
          </div>
        </div>
      </div>
    </div>
</main>
@endsection
