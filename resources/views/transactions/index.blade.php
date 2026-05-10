<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col items-center justify-center text-center gap-2">
            <div>
                <h2 class="font-bold text-2xl text-gray-900 leading-tight">
                    Riwayat Penjualan
                </h2>
                <p class="text-sm text-gray-600 mt-1">Daftar semua transaksi penjualan</p>
            </div>
            <a href="{{ route('transactions.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2.5 rounded-xl text-sm font-medium transition shadow-md hover:shadow-lg inline-flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor"viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                Transaksi Baru
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-2xl shadow-md border border-gray-200 overflow-hidden">
                
                <!-- Header Info -->
                <div class="px-6 py-5 bg-gradient-to-r from-gray-50 to-white border-b border-gray-200">
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-xl bg-green-100 flex items-center justify-center">
                                <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                            </div>
                            <div>
                                <span class="text-sm font-medium text-gray-700">Daftar Transaksi</span>
                                <p class="text-xs text-gray-500">Semua transaksi penjualan terdaftar</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-2 px-4 py-2 bg-green-50 rounded-xl">
                            <svg class="w-4 h-4 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            <span class="text-sm font-semibold text-green-700">{{ $transactions->total() }}</span>
                            <span class="text-sm text-green-600">Total Transaksi</span>
                        </div>
                    </div>
                </div>

                <!-- Filter Tanggal -->
                <div class="p-4 border-b border-gray-200 bg-gray-50">
                    <form method="GET" action="{{ route('transactions.index') }}" class="flex flex-wrap items-center gap-3">
                        <span class="text-sm text-gray-700 font-medium">Filter Tanggal:</span>
                        <input type="date" name="start_date" value="{{ request('start_date') }}" 
                               class="px-3 py-1.5 border border-gray-300 rounded-lg text-sm bg-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <span class="text-sm text-gray-500">-</span>
                        <input type="date" name="end_date" value="{{ request('end_date') }}" 
                               class="px-3 py-1.5 border border-gray-300 rounded-lg text-sm bg-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <button type="submit" class="px-4 py-1.5 bg-blue-600 hover:bg-blue-700 text-white rounded-lg text-sm font-medium transition">
                            Filter
                        </button>
                        <a href="{{ route('transactions.index') }}"
   class="px-4 py-1.5 
   bg-gray-300 dark:bg-gray-700
   hover:bg-gray-400 dark:hover:bg-gray-600
   text-gray-800 dark:text-gray-200
   rounded-lg text-sm font-medium transition">Reset
                        </a>
                    </form>
                </div>

                <!-- Tabel Transaksi -->
                @if($transactions->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="min-w-full w-full table-auto">
                            <thead>
    <tr class="bg-gray-100 border-b border-gray-300">

        <th class="px-4 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
            No. Invoice
        </th>

        <th class="px-4 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
            Tanggal
        </th>

        <th class="px-4 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
            Customer
        </th>

        <th class="px-4 py-3 text-right text-xs font-bold text-gray-700 uppercase tracking-wider">
            Diskon
        </th>

        <th class="px-4 py-3 text-right text-xs font-bold text-gray-700 uppercase tracking-wider">
            Total
        </th>

        <th class="px-4 py-3 text-right text-xs font-bold text-gray-700 uppercase tracking-wider">
            Bayar
        </th>

        <th class="px-4 py-3 text-right text-xs font-bold text-gray-700 uppercase tracking-wider">
            Kembalian
        </th>
        
        <th class="px-4 py-3 text-right text-xs font-bold text-gray-700 uppercase tracking-wider">
        Sisa Hutang
        </th>

        <th class="px-4 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
            Metode
        </th>

        <th class="px-4 py-3 text-center text-xs font-bold text-gray-700 uppercase tracking-wider">
            Status
        </th>

        <th class="px-4 py-3 text-center text-xs font-bold text-gray-700 uppercase tracking-wider">
            Aksi
        </th>

    </tr>
</thead>
                           <tbody class="divide-y divide-gray-200">

@foreach($transactions as $transaction)

<tr class="hover:bg-gray-50 dark:hover:bg-gray-800 transition">

    {{-- INVOICE --}}
    <td class="px-4 py-4 whitespace-nowrap">

        <div class="font-semibold text-gray-900 dark:text-black">
            {{ $transaction->invoice_number }}
        </div>

    </td>

    {{-- TANGGAL --}}
    <td class="px-4 py-4 whitespace-nowrap">

        <div class="text-sm text-black dark:text-black">
            {{ $transaction->created_at->timezone('Asia/Jakarta')->format('d/m/Y') }}
        </div>

        <div class="text-xs text-gray-500">
            {{ $transaction->created_at->timezone('Asia/Jakarta')->format('H:i') }} WIB
        </div>

    </td>

    {{-- CUSTOMER --}}
    <td class="px-4 py-4 whitespace-nowrap text-sm text-black dark:text-black">

        {{ $transaction->customer_name ?? 'Umum' }}

    </td>

    {{-- DISKON --}}
    <td class="px-4 py-4 whitespace-nowrap text-right">

        @if($transaction->discount > 0)

            <span class="font-semibold text-red-500">

                - Rp {{ number_format($transaction->discount, 0, ',', '.') }}

            </span>

        @else

            <span class="text-gray-400">
                -
            </span>

        @endif

    </td>

    {{-- TOTAL --}}
    <td class="px-4 py-4 whitespace-nowrap text-right">

        <span class="font-bold text-green-600">

            Rp {{ number_format($transaction->total, 0, ',', '.') }}

        </span>

    </td>

    {{-- BAYAR --}}
    <td class="px-4 py-4 whitespace-nowrap text-right">

        <span class="font-semibold text-blue-600">

            Rp {{ number_format($transaction->paid, 0, ',', '.') }}

        </span>

    </td>

    {{-- KEMBALIAN --}}
    <td class="px-4 py-4 whitespace-nowrap text-right">

        <span class="font-semibold text-orange-500">

            Rp {{ number_format($transaction->change, 0, ',', '.') }}

        </span>

    </td>

    {{-- SISA HUTANG --}}
    <td class="px-4 py-4 whitespace-nowrap text-right">

        @if($transaction->payment_method == 'dp')

            <span class="font-semibold text-red-500">

                Rp {{ number_format($transaction->remaining_debt, 0, ',', '.') }}

            </span>

        @else

            <span class="text-gray-400">
                -
            </span>

        @endif

    </td>

    {{-- METODE --}}
    <td class="px-4 py-4 whitespace-nowrap text-center">

        @switch($transaction->payment_method)

            @case('cash')

                <span class="px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-700">
                    Tunai
                </span>

                @break

            @case('transfer')

                <span class="px-3 py-1 rounded-full text-xs font-semibold bg-blue-100 text-blue-700">
                    Transfer
                </span>

                @break

            @case('qris')

                <span class="px-3 py-1 rounded-full text-xs font-semibold bg-purple-100 text-purple-700">
                    QRIS
                </span>

                @break

            @case('dp')

                <span class="px-3 py-1 rounded-full text-xs font-semibold bg-yellow-100 text-yellow-700">
                    DP
                </span>

                @break

            @case('credit_card')

                <span class="px-3 py-1 rounded-full text-xs font-semibold bg-pink-100 text-pink-700">
                    Credit Card
                </span>

                @break

            @default

                <span class="px-3 py-1 rounded-full text-xs font-semibold bg-gray-100 text-gray-700">
                    Tunai
                </span>

        @endswitch

    </td>

    {{-- STATUS --}}
    <td class="px-4 py-4 whitespace-nowrap text-center">

        @if($transaction->payment_status == 'paid')

            <span class="px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-700">
                Lunas
            </span>

        @else

            <span class="px-3 py-1 rounded-full text-xs font-semibold bg-yellow-100 text-yellow-700">
                DP
            </span>

        @endif

    </td>

    {{-- AKSI --}}
    <td class="px-4 py-4 whitespace-nowrap">

        <div class="flex items-center justify-center gap-2">

            <a href="{{ route('transactions.invoice', $transaction->id) }}"
               class="w-9 h-9 rounded-xl bg-blue-50 hover:bg-blue-100
                      flex items-center justify-center transition"
               title="Invoice">

                <svg class="w-5 h-5 text-blue-600"
                     fill="none"
                     stroke="currentColor"
                     viewBox="0 0 24 24">

                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          stroke-width="2"
                          d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                    </path>

                </svg>

            </a>
            {{-- BAYAR CICILAN --}}
@if($transaction->payment_status != 'paid')

<a href="{{ route('transactions.payment', $transaction->id) }}"
   class="w-9 h-9 rounded-xl bg-yellow-50 hover:bg-yellow-100
          flex items-center justify-center transition"
   title="Bayar Cicilan">

    <svg class="w-5 h-5 text-yellow-600"
         fill="none"
         stroke="currentColor"
         viewBox="0 0 24 24">

        <path stroke-linecap="round"
              stroke-linejoin="round"
              stroke-width="2"
              d="M12 8c-1.657 0-3 1.343-3 3s1.343 3 3 3
                 3 1.343 3 3-1.343 3-3 3m0-12
                 c1.11 0 2.08.402 2.599 1M12 8
                 V7m0 1v8m0 0v1m0-1
                 c-1.11 0-2.08-.402-2.599-1">
        </path>

    </svg>

</a>

@endif
            <button type="button"
                    onclick="confirmDelete({{ $transaction->id }}, '{{ $transaction->invoice_number }}')"
                    class="w-9 h-9 rounded-xl bg-red-50 hover:bg-red-100
                           flex items-center justify-center transition"
                    title="Hapus">

                <svg class="w-5 h-5 text-red-600"
                     fill="none"
                     stroke="currentColor"
                     viewBox="0 0 24 24">

                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          stroke-width="2"
                          d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                    </path>

                </svg>

            </button>

            <form id="delete-form-{{ $transaction->id }}"
                  action="{{ route('transactions.destroy', $transaction->id) }}"
                  method="POST"
                  class="hidden">

                @csrf
                @method('DELETE')

            </form>

        </div>

    </td>

</tr>

@endforeach

</tbody>
                        </table>
                    </div>
                    
                    <!-- Pagination -->
                    <div class="px-6 py-3 border-t border-gray-200">
                        {{ $transactions->links() }}
                    </div>
                @else
                    <div class="text-center py-16">
                        <div class="w-20 h-20 mx-auto bg-gray-100 rounded-2xl flex items-center justify-center mb-4">
                            <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                        </div>
                        <p class="text-gray-500 font-medium">Belum ada transaksi</p>
                        <a href="{{ route('transactions.create') }}" class="mt-4 inline-flex items-center gap-2 text-blue-600 hover:text-blue-700">+ Transaksi baru</a>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- SweetAlert2 dan Script -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function confirmDelete(id, invoice) {
            Swal.fire({
                title: '⚠️ Hapus Transaksi?',
                html: `Invoice: <strong>${invoice}</strong><br><br>Data yang dihapus tidak dapat dikembalikan!`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form-' + id).submit();
                }
            });
        }
    </script>
</x-app-layout>