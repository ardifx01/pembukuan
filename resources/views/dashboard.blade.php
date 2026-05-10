<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div>
                <h2 class="font-bold text-2xl text-black dark:text-black">
                    Dashboard
                </h2>
                <p class="text-sm text-black dark:text-black">
                    Ringkasan performa bisnis meubel
                </p>
            </div>

            <div class="text-sm text-black-700 dark:text-black-300 font-medium">
                {{ now()->timezone('Asia/Jakarta')->format('d F Y') }}
            </div>
        </div>
    </x-slot>

    <div class="py-8 bg-gray-50 dark:bg-gray-900 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <!-- ===================================================== -->
            <!-- TOP STATS -->
            <!-- ===================================================== -->

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5 mb-6">

                <!-- Total Produk -->
                <div class="bg-white dark:bg-gray-800 rounded-2xl border border-gray-200 dark:border-gray-700 p-4 shadow-sm">
                    <div class="flex justify-between items-center">
                        <div>
                            <p class="text-sm text-black dark:text-black">
                                Total Produk
                            </p>

                            <h3 class="text-2xl font-bold text-black dark:text-black mt-1">
                                {{ $totalProducts }}
                            </h3>
                        </div>

                        <div class="w-11 h-11 rounded-xl bg-blue-100 dark:bg-blue-900/30 flex items-center justify-center">
                            <svg class="w-5 h-5 text-blue-600 dark:text-blue-400"
                                 fill="none"
                                 stroke="currentColor"
                                 viewBox="0 0 24 24">
                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      stroke-width="2"
                                      d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Stok Menipis -->
                <div class="bg-white dark:bg-gray-800 rounded-2xl border border-gray-200 dark:border-gray-700 p-4 shadow-sm">
                    <div class="flex justify-between items-center">
                        <div>
                            <p class="text-sm text-black dark:text-black">
                                Stok Menipis
                            </p>

                            <h3 class="text-2xl font-bold mt-1 {{ $lowStockItems > 0 ? 'text-red-500' : 'text-black dark:text-black' }}">
                                {{ $lowStockItems }}
                            </h3>
                        </div>

                        <div class="w-11 h-11 rounded-xl bg-red-100 dark:bg-red-900/30 flex items-center justify-center">
                            <svg class="w-5 h-5 text-red-600 dark:text-red-400"
                                 fill="none"
                                 stroke="currentColor"
                                 viewBox="0 0 24 24">
                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      stroke-width="2"
                                      d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Supplier -->
                <div class="bg-white dark:bg-gray-800 rounded-2xl border border-gray-200 dark:border-gray-700 p-4 shadow-sm">
                    <div class="flex justify-between items-center">
                        <div>
                            <p class="text-sm text-black dark:text-black">
                                Supplier
                            </p>

                            <h3 class="text-2xl font-bold text-black dark:text-black mt-1">
                                {{ $totalSuppliers }}
                            </h3>
                        </div>

                        <div class="w-11 h-11 rounded-xl bg-purple-100 dark:bg-purple-900/30 flex items-center justify-center">
                            <svg class="w-5 h-5 text-purple-600 dark:text-purple-400"
                                 fill="none"
                                 stroke="currentColor"
                                 viewBox="0 0 24 24">
                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      stroke-width="2"
                                      d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Total Aset -->
                <div class="bg-white dark:bg-gray-800 rounded-2xl border border-gray-200 dark:border-gray-700 p-4 shadow-sm">
                    <div class="flex justify-between items-center">
                        <div>
                            <p class="text-sm text-black dark:text-black">
                                Total Aset
                            </p>

                            <h3 class="text-xl font-bold text-indigo-600 dark:text-indigo-400 mt-1">
                                Rp {{ number_format($totalAset ?? 0, 0, ',', '.') }}
                            </h3>

                            <p class="text-xs text-black-500 dark:text-black mt-1">
                                Harga modal × stok
                            </p>
                        </div>

                        <div class="w-11 h-11 rounded-xl bg-indigo-100 dark:bg-indigo-900/30 flex items-center justify-center">
                            <svg class="w-5 h-5 text-indigo-600 dark:text-indigo-400"
                                 fill="none"
                                 stroke="currentColor"
                                 viewBox="0 0 24 24">
                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      stroke-width="2"
                                      d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                    </div>
                </div>

            </div>

            <!-- ===================================================== -->
            <!-- SALES + TOP PRODUCT -->
            <!-- ===================================================== -->

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">

                <!-- SALES -->
                <div class="lg:col-span-2 bg-white dark:bg-gray-800 rounded-2xl border border-gray-200 dark:border-gray-700 shadow-sm overflow-hidden">

                    <div class="p-5 border-b border-gray-200 dark:border-gray-700">
                        <div class="flex justify-between items-center">

                            <div>
                                <h3 class="text-lg font-bold text-black dark:text-black">
                                    Penjualan Bulan Ini
                                </h3>

                                <p class="text-sm text-black dark:text-black">
                                    {{ now()->format('F Y') }}
                                </p></div>

                            <div class="text-right">
                                <p class="text-sm text-black-500 dark:text-black">
                                    Total Penjualan
                                </p>

                                <h3 class="text-2xl font-bold text-green-600">
                                    Rp {{ number_format($totalSalesThisMonth ?? 0, 0, ',', '.') }}
                                </h3>
                            </div>

                        </div>
                    </div>

                    <div class="p-5">

                        <div class="grid grid-cols-2 gap-4 mb-5">

                            <div class="bg-green-50 dark:bg-green-900/20 rounded-xl p-4 text-center">
                                <p class="text-sm text-black dark:text-black">
                                    Produk Terjual
                                </p>

                                <h3 class="text-2xl font-bold text-green-600 mt-1">
                                    {{ number_format($totalProductsSoldThisMonth ?? 0) }} pcs
                                </h3>
                            </div>

                            <div class="bg-blue-50 dark:bg-blue-900/20 rounded-xl p-4 text-center">
                                <p class="text-sm text-black dark:text-black">
                                    Total Transaksi
                                </p>

                                <h3 class="text-2xl font-bold text-blue-600 mt-1">
                                    {{ number_format($totalTransactions ?? 0) }}
                                </h3>
                            </div>

                        </div>

                        @if(isset($salesTrend))
                            <div class="text-center">

                                @if($salesTrend > 0)

                                    <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-green-100 text-green-700 text-sm font-medium">
                                        📈 Naik {{ number_format($salesTrend, 1) }}%
                                    </span>

                                @else

                                    <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-red-100 text-red-700 text-sm font-medium">
                                        📉 Turun {{ number_format(abs($salesTrend), 1) }}%
                                    </span>

                                @endif

                            </div>
                        @endif

                    </div>
                </div>

                <!-- TOP PRODUCT -->
                <div class="bg-white dark:bg-gray-800 rounded-2xl border border-gray-200 dark:border-gray-700 shadow-sm overflow-hidden">

                    <div class="p-5 border-b border-gray-200 dark:border-gray-700">
                        <h3 class="text-lg font-bold text-black dark:text-black">
                            Produk Terlaris
                        </h3>

                        <p class="text-sm text-black dark:text-black">
                            Bulan ini
                        </p>
                    </div>

                    <div class="p-5 space-y-3">

                        @forelse($topProductsThisMonth->take(3) as $product)

                            <div class="flex justify-between items-center p-3 rounded-xl bg-gray-50 dark:bg-gray-700/50">

                                <div>
                                    <h4 class="font-semibold text-black dark:text-black text-sm">
                                        {{ $product->name }}
                                    </h4>

                                    <p class="text-xs text-black-500 dark:text-black">
                                        {{ $product->code }}
                                    </p>
                                </div>

                                <div class="text-right">
                                    <p class="font-bold text-green-600">
                                        {{ number_format($product->total_quantity) }} pcs
                                    </p>

                                    <p class="text-xs text-black-500 dark:text-black">
                                        Rp {{ number_format($product->total_sales, 0, ',', '.') }}
                                    </p>
                                </div>

                            </div>

                        @empty

                            <div class="text-center py-10 text-black-500 dark:text-black">
                                Belum ada penjualan
                            </div>

                        @endforelse

                    </div>
                </div>

            </div>

            <!-- ===================================================== -->
            <!-- CHART -->
            <!-- ===================================================== -->

            <div class="bg-white dark:bg-gray-800 rounded-2xl border border-gray-200 dark:border-gray-700 shadow-sm overflow-hidden">

                <!-- HEADER -->
                <div class="p-5 border-b border-gray-200 dark:border-gray-700">

                    <div class="flex flex-wrap justify-between gap-4 items-center">

                        <div>
                            <h3 class="text-xl font-bold text-black dark:text-black">
                                Grafik Penjualan
                            </h3>

                            <p class="text-sm text-black dark:text-black">
                                Analisis penjualan berdasarkan periode
                            </p>
                        </div>

                        <!-- FILTER -->
                        <div class="flex flex-wrap gap-2">

                            <!-- FILTER BUTTON -->
    <form method="GET"
          action="{{ route('dashboard') }}"
          class="flex gap-2">

        <button name="filter"
                value="week"
                class="px-4 py-2 rounded-xl text-sm font-medium transition
                {{ $filter == 'week'
                    ? 'bg-blue-600 text-white'
                    : 'bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300' }}">
            7 Hari
        </button>

        <button name="filter"
                value="month"
                class="px-4 py-2 rounded-xl text-sm font-medium transition
                {{ $filter == 'month'
                    ? 'bg-blue-600 text-white'
                    : 'bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300' }}">
            Bulan Ini
        </button>

        <button name="filter"
                value="year"
                class="px-4 py-2 rounded-xl text-sm font-medium transition
                {{ $filter == 'year'
                    ? 'bg-blue-600 text-white'
                    : 'bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300' }}">
            Tahun Ini
        </button>

    </form>

    <!-- EXPORT -->
    <a href="{{ route('dashboard.export', ['filter' => $filter]) }}"
       class="px-4 py-2 rounded-xl text-sm font-medium
       bg-green-600 hover:bg-green-700
       text-white transition shadow-sm">

        Export Excel
    </a>

</div>
                            </form>

                        </div>

                    </div>

                </div>

                <!-- TOTAL -->
                <div class="grid grid-cols-2 border-b border-gray-200 dark:border-gray-700">

                    <div class="text-center p-5 border-r border-gray-200 dark:border-gray-700">
                        <p class="text-sm text-black dark:text-black">
                            Total Penjualan
                        </p>

                        <h3 class="text-2xl font-bold text-green-600 mt-1">
                            Rp {{ number_format($totalSales, 0, ',', '.') }}
                        </h3>
                    </div>

                    <div class="text-center p-5">
                        <p class="text-sm text-black dark:text-black">
                            Rata-rata Penjualan</p>

                        <h3 class="text-2xl font-bold text-blue-600 mt-1">
                            Rp {{ number_format($avgSales, 0, ',', '.') }}
                        </h3>
                    </div>

                </div>

                <!-- CHART -->
                <div class="p-6">
                    <canvas id="salesChart" class="w-full h-[420px]"></canvas>
                </div>

            </div>

        </div>
    </div>

    <!-- ===================================================== -->
    <!-- CHART JS -->
    <!-- ===================================================== -->

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>

        const ctx = document.getElementById('salesChart').getContext('2d');

        const labels = @json($labels);
        const data = @json($chartData);

        function formatRupiah(value) {
            return new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR',
                minimumFractionDigits: 0
            }).format(value);
        }

        const gradient = ctx.createLinearGradient(0, 0, 0, 400);

        gradient.addColorStop(0, 'rgba(59,130,246,0.3)');
        gradient.addColorStop(1, 'rgba(59,130,246,0)');

        new Chart(ctx, {

            type: 'line',

            data: {
                labels: labels,

                datasets: [{
                    label: 'Penjualan',
                    data: data,

                    borderColor: '#3b82f6',
                    backgroundColor: gradient,

                    fill: true,
                    tension: 0.4,
                    borderWidth: 3,

                    pointRadius: 4,
                    pointHoverRadius: 6,

                    pointBackgroundColor: '#3b82f6',
                    pointBorderColor: '#fff',
                    pointBorderWidth: 2,
                }]
            },

            options: {

                responsive: true,
                maintainAspectRatio: false,

                plugins: {

                    legend: {
                        display: false
                    },

                    tooltip: {
                        backgroundColor: '#111827',

                        callbacks: {
                            label: function(context) {
                                return formatRupiah(context.raw);
                            }
                        }
                    }
                },

                scales: {

                    y: {
                        beginAtZero: true,

                        grid: {
                            color: '#e5e7eb'
                        },

                        ticks: {
                            callback: function(value) {
                                return formatRupiah(value);
                            }
                        }
                    },

                    x: {
                        grid: {
                            display: false
                        }
                    }
                }
            }
        });

    </script>
</x-app-layout>