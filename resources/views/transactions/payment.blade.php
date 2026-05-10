<x-app-layout>

    <x-slot name="header">

        <div class="flex items-center justify-between">

            <div>

                <h2 class="font-bold text-2xl text-gray-900 dark:text-white">
                    Pembayaran Cicilan
                </h2>

                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                    Pelunasan transaksi customer
                </p>

            </div>

            <a href="{{ route('transactions.index') }}"
               class="inline-flex items-center gap-2 px-4 py-2.5
                      rounded-xl bg-gray-100 hover:bg-gray-200
                      dark:bg-gray-800 dark:hover:bg-gray-700
                      text-gray-700 dark:text-gray-200
                      font-medium transition">

                ← Kembali

            </a>

        </div>

    </x-slot>

    <div class="py-8">

        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white dark:bg-gray-900
                        shadow-xl rounded-3xl overflow-hidden
                        border border-gray-100 dark:border-gray-800">

                {{-- HEADER --}}
               {{-- HEADER --}}
<div class="relative overflow-hidden">

    <div class="absolute inset-0
                bg-gradient-to-r
                from-indigo-500
                via-purple-500
                to-indigo-600">
    </div>

    <div class="relative px-5 md:px-8 py-6 md:py-8 text-white">

        <div class="flex flex-col md:flex-row
                    md:items-center
                    md:justify-between
                    gap-4">

            {{-- LEFT --}}
            <div class="min-w-0">

                <div class="text-sm opacity-90 mb-1">
                    Invoice
                </div>

                <h1 class="text-3xl md:text-5xl
                           font-extrabold
                           tracking-wide
                           break-all">

                    {{ $transaction->invoice_number }}

                </h1>

            </div>

            {{-- RIGHT --}}
            <div class="flex md:justify-end">

                <div class="inline-flex items-center
                            px-4 py-2 rounded-full
                            bg-yellow-400/20
                            backdrop-blur
                            text-yellow-100
                            font-bold text-xs md:text-sm
                            whitespace-nowrap">

                    DP / CICILAN

                </div>

            </div>

        </div>

    </div>

</div>

                {{-- CONTENT --}}
                <div class="p-8">

                    {{-- SUMMARY --}}
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-5 mb-8">

                        {{-- TOTAL --}}
                        <div class="rounded-2xl p-5
                                    bg-gradient-to-br
                                    from-green-50 to-green-100
                                    border border-green-200">

                            <div class="text-sm text-green-700 font-medium">
                                Total Transaksi
                            </div>

                            <div class="mt-3 text-3xl font-extrabold text-green-600">

                                Rp {{ number_format($transaction->total, 0, ',', '.') }}

                            </div>

                        </div>

                        {{-- SUDAH BAYAR --}}
                        <div class="rounded-2xl p-5
                                    bg-gradient-to-br
                                    from-blue-50 to-blue-100
                                    border border-blue-200">

                            <div class="text-sm text-blue-700 font-medium">
                                Sudah Dibayar
                            </div>

                            <div class="mt-3 text-3xl font-extrabold text-blue-600">

                                Rp {{ number_format($transaction->paid, 0, ',', '.') }}

                            </div>

                        </div>

                        {{-- SISA --}}
                        <div class="rounded-2xl p-5
                                    bg-gradient-to-br
                                    from-red-50 to-red-100
                                    border border-red-200">

                            <div class="text-sm text-red-700 font-medium">
                                Sisa Hutang
                            </div>

                            <div class="mt-3 text-3xl font-extrabold text-red-600">

                                Rp {{ number_format($transaction->remaining_debt, 0, ',', '.') }}

                            </div>

                        </div>

                    </div>

                    {{-- FORM --}}
                    <form method="POST"
                          action="{{ route('transactions.processPayment', $transaction->id) }}">

                        @csrf

                        <div class="bg-gray-50 dark:bg-gray-800/50
                                    rounded-3xl p-6 border
                                    border-gray-200 dark:border-gray-700">

                            <div class="mb-6">

                                <label class="block text-sm font-semibold
                                             text-gray-700 dark:text-gray-300
                                             mb-3">

                                    Jumlah Pembayaran Cicilan

                                </label>

                                <div class="relative">

                                    <span class="absolute left-5 top-1/2
                                                 -translate-y-1/2
                                                 text-gray-500 font-semibold">

                                        Rp

                                    </span>

                                    <input
                                        type="text"
                                        name="amount"
                                        id="amount"
                                        required
                                        autocomplete="off"
                                        placeholder="0"
                                        class="w-full pl-14 pr-5 py-4
                                               rounded-2xl
                                               border border-gray-300
                                               dark:border-gray-600
                                               bg-white dark:bg-gray-900
                                               text-gray-900 dark:text-white
                                               text-2xl font-bold
                                               focus:ring-4
                                               focus:ring-indigo-200
                                               focus:border-indigo-500
                                               transition">

                                </div>

                                <p class="mt-3 text-sm text-gray-500">

                                    Masukkan nominal pembayaran customer

                                </p>

                            </div>

                            {{-- PREVIEW --}}
                            <div class="bg-indigo-50 border border-indigo-200
                                        rounded-2xl p-5 mb-6">

                                <div class="flex items-center justify-between">

                                    <span class="text-indigo-700 font-medium">
                                        Sisa Setelah Pembayaran
                                    </span>

                                    <span id="remainingPreview"
                                          class="text-2xl font-extrabold text-indigo-600">

                                        Rp {{ number_format($transaction->remaining_debt, 0, ',', '.') }}

                                    </span>

                                </div>

                            </div>

                            {{-- BUTTON --}}
                            <div class="flex flex-col sm:flex-row
                                        items-stretch sm:items-center
                                        justify-end gap-3">

                                <a href="{{ route('transactions.index') }}"
                                   class="px-6 py-3 rounded-2xl
                                          bg-gray-100 hover:bg-gray-200
                                          dark:bg-gray-700 dark:hover:bg-gray-600
                                          text-gray-700 dark:text-white
                                          font-semibold text-center
                                          transition">

                                    Kembali

                                </a>

                                <button type="submit"
                                        class="px-6 py-3 rounded-2xl
                                               bg-gradient-to-r
                                               from-yellow-400
                                               to-amber-500
                                               hover:from-yellow-500
                                               hover:to-amber-600
                                               text-white font-bold
                                               shadow-lg shadow-yellow-200
                                               transition">

                                    Bayar Cicilan

                                </button>

                            </div>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

<script>

function formatRupiah(angka) {

    return angka.replace(/\B(?=(\d{3})+(?!\d))/g, ".");
}

function parseRupiah(rupiah) {

    return parseInt(rupiah.replace(/\./g, '')) || 0;
}

const amountInput =
    document.getElementById('amount');

const preview =
    document.getElementById('remainingPreview');

const currentDebt =
    {{ $transaction->remaining_debt }};

amountInput.addEventListener('input', function(e) {

    let number =
        parseRupiah(e.target.value);

    e.target.value =
        formatRupiah(number.toString());

    let remaining =
        currentDebt - number;

    if (remaining < 0) {
        remaining = 0;
    }

    preview.innerText =
        'Rp ' + formatRupiah(remaining.toString());
});

</script>

</x-app-layout>