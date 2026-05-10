<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Detail Transaksi #{{ $transaction->invoice_number }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="grid grid-cols-2 gap-4 mb-6">
                        <div>
                            <p><strong>No. Invoice:</strong> {{ $transaction->invoice_number }}</p>
                            <p><strong>Tanggal:</strong> {{ $transaction->created_at->format('d/m/Y H:i') }}</p>
                            <p><strong>Kasir:</strong> {{ $transaction->user->name }}</p>
                        </div>
                        <div>
                            <p><strong>Pelanggan:</strong> {{ $transaction->customer_name ?? $transaction->reseller->name ?? 'Umum' }}</p>
                            <p><strong>Tipe:</strong> {{ $transaction->type == 'cash' ? 'Tunai' : 'Kredit' }}</p>
                            <p><strong>Status:</strong> {{ $transaction->status }}</p>
                        </div>
                    </div>

                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left">Produk</th>
                                <th class="px-6 py-3 text-center">Qty</th>
                                <th class="px-6 py-3 text-right">Harga</th>
                                <th class="px-6 py-3 text-right">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($transaction->details as $detail)
                            <tr>
                                <td class="px-6 py-4">{{ $detail->furniture->name }}</td>
                                <td class="px-6 py-4 text-center">{{ $detail->quantity }}</td>
                                <td class="px-6 py-4 text-right">Rp {{ number_format($detail->price, 0, ',', '.') }}</td>
                                <td class="px-6 py-4 text-right">Rp {{ number_format($detail->subtotal, 0, ',', '.') }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                      <tfoot class="bg-gray-100 dark:bg-gray-800">

    {{-- SUBTOTAL --}}
    <tr>
        <td colspan="3"
            class="px-6 py-4 text-right font-semibold text-gray-700 dark:text-gray-300">

            Subtotal:
        </td>

        <td class="px-6 py-4 text-right font-semibold dark:text-white">
            Rp {{ number_format($transaction->subtotal, 0, ',', '.') }}
        </td>
    </tr>

    {{-- DISKON --}}
    @if($transaction->discount > 0)

    <tr>
        <td colspan="3"
            class="px-6 py-4 text-right font-semibold text-red-500">

            Diskon:
        </td>

        <td class="px-6 py-4 text-right font-bold text-red-500">
            - Rp {{ number_format($transaction->discount, 0, ',', '.') }}
        </td>
    </tr>

    @endif

    {{-- TOTAL --}}
    <tr>
        <td colspan="3"
            class="px-6 py-4 text-right font-bold text-lg dark:text-white">

            TOTAL:
        </td>

        <td class="px-6 py-4 text-right font-bold text-lg text-indigo-600">
            Rp {{ number_format($transaction->total, 0, ',', '.') }}
        </td>
    </tr>

    {{-- BAYAR --}}
    <tr>
        <td colspan="3"
            class="px-6 py-4 text-right dark:text-gray-300">

            Bayar:
        </td>

        <td class="px-6 py-4 text-right font-semibold dark:text-white">
            Rp {{ number_format($transaction->paid, 0, ',', '.') }}
        </td>
    </tr>

    {{-- KEMBALI --}}
    <tr>
        <td colspan="3"
            class="px-6 py-4 text-right dark:text-gray-300">

            Kembali:
        </td>

        <td class="px-6 py-4 text-right font-semibold text-green-600">
            Rp {{ number_format($transaction->change, 0, ',', '.') }}
        </td>
    </tr>

</tfoot>
                    </table>

                    <div class="mt-6 flex gap-4">
                        <a href="{{ route('transactions.invoice', $transaction) }}" target="_blank" class="bg-blue-500 text-white px-4 py-2 rounded">Cetak Nota</a>
                        <a href="{{ route('transactions.create') }}" class="bg-green-500 text-white px-4 py-2 rounded">Transaksi Baru</a>
                        <a href="{{ route('transactions.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded">Kembali</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>