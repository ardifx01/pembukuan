<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col items-center justify-center text-center gap-2">
            <div>
                <h2 class="font-bold text-2xl text-gray-900 leading-tight">
                    Laporan Keuangan
                </h2>
                <p class="text-sm text-gray-600 mt-1">Analisis performa bisnis lengkap</p>
            </div>
            <div class="flex gap-3">
                <!-- Tombol Export Excel -->
                <a href="{{ route('reports.financial.export', request()->all()) }}" 
                   class="bg-green-600 hover:bg-green-700 text-white px-5 py-2.5 rounded-xl text-sm font-medium transition shadow-md hover:shadow-lg inline-flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                    </svg>
                    Export Excel
                </a>
                
                <!-- Tombol Export PDF -->
                <a href="{{ route('reports.financial.pdf', request()->all()) }}" 
                   class="bg-red-600 hover:bg-red-700 text-white px-5 py-2.5 rounded-xl text-sm font-medium transition shadow-md hover:shadow-lg inline-flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                    </svg>
                    Export PDF
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Filter Periode -->
            <div class="bg-white rounded-2xl shadow-md border border-gray-200 overflow-hidden mb-6">
                <div class="px-6 py-4 bg-gradient-to-r from-blue-50 to-indigo-50 border-b border-gray-200">
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 rounded-lg bg-blue-500 flex items-center justify-center shadow-sm">
                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"></path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-semibold text-gray-800">⚙️ Pengaturan Laporan</h3>
                            <p class="text-xs text-gray-500">Atur periode laporan untuk analisis laba rugi</p>
                        </div>
                    </div>
                </div>
                
                <div class="p-6">
                    <form method="GET" action="{{ route('reports.financial') }}" class="space-y-6">
                        <!-- Periode -->
                        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 items-end">
                            <div class="md:col-span-1">
                                <label class="block text-sm font-semibold text-gray-700 mb-2">📅 Periode Laporan</label>
                                <select name="period" id="period" 
                                        class="w-full px-4 py-2.5 border border-gray-300 rounded-xl text-sm bg-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                                    <option value="month" {{ request('period', 'month') == 'month' ? 'selected' : '' }}>📆 Bulan Ini</option>
                                    <option value="last_month" {{ request('period') == 'last_month' ? 'selected' : '' }}>📅 Bulan Lalu</option>
                                    <option value="year" {{ request('period') == 'year' ? 'selected' : '' }}>📊 Tahun Ini</option>
                                    <option value="custom" {{ request('period') == 'custom' ? 'selected' : '' }}>⚙️ Kustom</option>
                                </select>
                            </div>
                            
                            <div id="dateRange" class="md:col-span-2 flex gap-3" style="display: {{ request('period') == 'custom' ? 'flex' : 'none' }}">
                                <div class="flex-1">
                                    <label class="block text-xs text-gray-500 mb-1">Dari Tanggal</label>
                                    <input type="date" name="start_date" value="{{ request('start_date', $startDate ?? '') }}" 
                                           class="w-full px-4 py-2.5 border border-gray-300 rounded-xl text-sm bg-white focus:ring-2 focus:ring-blue-500">
                                </div>
                                <div class="flex-1">
                                    <label class="block text-xs text-gray-500 mb-1">Sampai Tanggal</label>
                                    <input type="date" name="end_date" value="{{ request('end_date', $endDate ?? '') }}" 
                                           class="w-full px-4 py-2.5 border border-gray-300 rounded-xl text-sm bg-white focus:ring-2 focus:ring-blue-500">
                                </div>
                            </div>
                            
                            <div>
                                <button type="submit" 
                                        class="w-full md:w-auto px-6 py-2.5 bg-blue-600 hover:bg-blue-700 text-white rounded-xl text-sm font-medium transition shadow-md hover:shadow-lg flex items-center justify-center gap-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                    </svg>
                                    Tampilkan
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            
            <!-- Statistik Utama -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
                <div class="bg-white rounded-2xl shadow-md border border-gray-200 p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-500">Total Penjualan</p>
                            <p class="text-2xl font-bold text-green-600">Rp {{ number_format($totalSales, 0, ',', '.') }}</p>
                        </div>
                        <div class="w-12 h-12 rounded-xl bg-green-100 flex items-center justify-center">
                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                    </div>
                </div>
                
                <div class="bg-white rounded-2xl shadow-md border border-gray-200 p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-500">HPP (Harga Pokok)</p>
                            <p class="text-2xl font-bold text-orange-600">Rp {{ number_format($totalHpp, 0, ',', '.') }}</p><p class="text-xs text-gray-400">{{ number_format($hppPercentage, 1) }}% dari penjualan</p>
                        </div><div class="w-12 h-12 rounded-xl bg-orange-100 flex items-center justify-center">
                            <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                            </svg>
                        </div>
                    </div>
                </div>
                
                <div class="bg-white rounded-2xl shadow-md border border-gray-200 p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-500">Laba Kotor</p>
                            <p class="text-2xl font-bold text-blue-600">Rp {{ number_format($grossProfit, 0, ',', '.') }}</p>
                            <p class="text-xs text-gray-400">{{ number_format($grossMargin, 1) }}% margin kotor</p>
                        </div>
                        <div class="w-12 h-12 rounded-xl bg-blue-100 flex items-center justify-center">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                            </svg>
                        </div>
                    </div>
                </div>
                
                <div class="bg-white rounded-2xl shadow-md border border-gray-200 p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-500">Laba Bersih</p>
                            <p class="text-2xl font-bold text-purple-600">Rp {{ number_format($netProfit, 0, ',', '.') }}</p>
                            <p class="text-xs text-gray-400">{{ number_format($netMargin, 1) }}% margin bersih</p>
                        </div>
                        <div class="w-12 h-12 rounded-xl bg-purple-100 flex items-center justify-center">
                            <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Laba Rugi Detail + Daftar Biaya -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
                <!-- Ringkasan Laba Rugi -->
                <div class="bg-white rounded-2xl shadow-md border border-gray-200 overflow-hidden">
                    <div class="px-6 py-4 bg-gradient-to-r from-gray-50 to-white border-b border-gray-200">
                        <h3 class="font-semibold text-gray-800">📊 Ringkasan Laba Rugi</h3>
                        <p class="text-xs text-gray-500">Periode: {{ Carbon\Carbon::parse($startDate)->format('d M Y') }} - {{ Carbon\Carbon::parse($endDate)->format('d M Y') }}</p>
                    </div>
                    <div class="p-6 space-y-3">
                        <div class="flex justify-between py-2 border-b">
                            <span class="text-gray-600">Total Penjualan</span>
                            <span class="font-semibold text-green-600">Rp {{ number_format($totalSales, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between py-2 border-b">
                            <span class="text-gray-600">Harga Pokok Penjualan (HPP)</span>
                            <span class="font-semibold text-orange-600">(Rp {{ number_format($totalHpp, 0, ',', '.') }})</span>
                        </div>
                        <div class="flex justify-between py-2 border-b bg-blue-50/30">
                            <span class="font-semibold text-gray-800">Laba Kotor</span>
                            <span class="font-semibold text-blue-600">Rp {{ number_format($grossProfit, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between py-2 border-b">
                            <span class="text-gray-600">Biaya Operasional</span>
                            <span class="font-semibold text-red-600">(Rp {{ number_format($totalOperationalCost, 0, ',', '.') }})</span>
                        </div>
                        <div class="flex justify-between py-2 border-b">
                            <span class="text-gray-600">Biaya Lain-lain</span>
                            <span class="font-semibold text-red-600">(Rp {{ number_format($totalOtherCost, 0, ',', '.') }})</span>
                        </div>
                        <div class="flex justify-between py-2 bg-purple-50/30 rounded-lg -mx-2 px-2">
                            <span class="font-bold text-gray-800">Laba Bersih</span>
                            <span class="font-bold text-purple-600">Rp {{ number_format($netProfit, 0, ',', '.') }}</span>
                        </div>
                    </div>
                </div>
                
               <!-- Daftar Biaya Operasional & Lain-lain -->
<div class="bg-white rounded-2xl shadow-md border border-gray-200 overflow-hidden">
    <div class="px-6 py-4 bg-gradient-to-r from-gray-50 to-white border-b border-gray-200">
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="w-8 h-8 rounded-lg bg-purple-100 flex items-center justify-center">
                    <svg class="w-4 h-4 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2z"></path>
                    </svg>
                </div>
                <div>
                    <h3 class="font-semibold text-gray-800">💰 Daftar Biaya</h3>
                    <p class="text-xs text-gray-500">Input biaya manual (listrik, PDAM, gaji, bensin, dll)</p>
                </div>
            </div>
            <div class="text-right">
                <span class="text-2xl font-bold text-purple-600">Rp {{ number_format($totalOperationalCost + $totalOtherCost, 0, ',', '.') }}</span>
                <p class="text-xs text-gray-500">Total Biaya</p>
            </div>
        </div>
    </div>
    
    <div class="p-6">
        <!-- Form Tambah Biaya -->
        <form action="{{ route('reports.financial.cost.store') }}" method="POST" class="mb-8 p-5 bg-gradient-to-r from-gray-50 to-white rounded-xl border border-gray-200">
            @csrf
            <input type="hidden" name="period" value="{{ request('period', 'month') }}">
            <input type="hidden" name="start_date" value="{{ request('start_date', $startDate ?? '') }}">
            <input type="hidden" name="end_date" value="{{ request('end_date', $endDate ?? '') }}">
            
            <div class="flex items-center gap-2 mb-4">
                <div class="w-6 h-6 rounded-full bg-green-100 flex items-center justify-center">
                    <svg class="w-3.5 h-3.5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                </div>
                <h4 class="text-sm font-semibold text-gray-700">Tambah Biaya Baru</h4>
            </div><div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div class="md:col-span-1">
                    <input type="text" name="name" placeholder="Nama biaya" 
                           class="w-full px-4 py-2.5 border border-gray-300 rounded-xl text-sm bg-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                           required>
                </div>
                <div class="md:col-span-1">
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400 text-sm">Rp</span>
                        <input type="number" name="amount" placeholder="0" 
                               class="w-full pl-8 pr-4 py-2.5 border border-gray-300 rounded-xl text-sm bg-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                               required>
                    </div>
                </div>
                <div class="md:col-span-1">
                    <input type="date" name="date" value="{{ date('Y-m-d') }}" 
                           class="w-full px-4 py-2.5 border border-gray-300 rounded-xl text-sm bg-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                           required>
                </div>
                <div class="md:col-span-1">
                    <select name="category" class="w-full px-4 py-2.5 border border-gray-300 rounded-xl text-sm bg-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                        <option value="operational">📋 Biaya Operasional</option>
                        <option value="other">📝 Biaya Lain-lain</option>
                    </select>
                </div>
            </div>
            <div class="mt-4 flex justify-center">
                <button type="submit" class="px-5 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-xl text-sm font-medium transition shadow-sm hover:shadow flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                   Simpan Biaya
                </button>
            </div>
        </form>
        
        <!-- Tabel Daftar Biaya -->
        <div class="overflow-x-auto">
            <table class="min-w-full w-full">
                <thead>
                    <tr class="bg-gray-100 rounded-xl">
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600">Nama Biaya</th>
                        <th class="px-4 py-3 text-right text-xs font-semibold text-gray-600">Nominal</th>
                        <th class="px-4 py-3 text-center text-xs font-semibold text-gray-600">Tanggal</th>
                        <th class="px-4 py-3 text-center text-xs font-semibold text-gray-600">Kategori</th>
                        <th class="px-4 py-3 text-center text-xs font-semibold text-gray-600">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($operationalCosts->merge($otherCosts)->sortByDesc('date') as $cost)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-4 py-3">
                            <div class="flex items-center gap-2">
                                <div class="w-7 h-7 rounded-lg {{ $cost->category == 'operational' ? 'bg-blue-100' : 'bg-purple-100' }} flex items-center justify-center">
                                    <svg class="w-3.5 h-3.5 {{ $cost->category == 'operational' ? 'text-blue-600' : 'text-purple-600' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                </div>
                                <span class="font-medium text-gray-800">{{ $cost->name }}</span>
                            </div>
                        </td>
                        <td class="px-4 py-3 text-right">
                            <span class="font-semibold text-red-600">Rp {{ number_format($cost->amount, 0, ',', '.') }}</span>
                        </td>
                        <td class="px-4 py-3 text-center text-gray-500 text-sm">
                            {{ \Carbon\Carbon::parse($cost->date)->format('d/m/Y') }}
                        </td>
                        <td class="px-4 py-3 text-center">
                            <span class="inline-flex px-2 py-1 rounded-full text-xs font-semibold {{ $cost->category == 'operational' ? 'bg-blue-100 text-blue-700' : 'bg-purple-100 text-purple-700' }}">
                                {{ $cost->category == 'operational' ? 'Operasional' : 'Lain-lain' }}
                            </span>
                        </td>
                        <td class="px-4 py-3 text-center">
                            <form action="{{ route('reports.financial.cost.delete', $cost->id) }}" method="POST" class="inline" onsubmit="return confirm('Hapus biaya {{ $cost->name }}?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-400 hover:text-red-600 transition p-1 hover:bg-red-50 rounded-lg" title="Hapus">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                    </svg>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-4 py-8 text-center text-gray-400">
                            <div class="flex flex-col items-center gap-2">
                                <svg class="w-12 h-12 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                                <p>Belum ada data biaya</p>
                                <p class="text-xs">Silakan tambah biaya di atas</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <!-- Ringkasan Total -->
        <div class="mt-5 pt-4 border-t border-gray-200">
            <div class="flex justify-between items-center p-3 bg-gray-50 rounded-xl">
                <div class="flex items-center gap-2">
                    <div class="w-8 h-8 rounded-full bg-purple-100 flex items-center justify-center">
                        <svg class="w-4 h-4 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    <span class="font-semibold text-gray-700">Total Biaya Operasional & Lain-lain</span>
                </div>
                <div class="text-right">
                    <span class="text-xl font-bold text-red-600">Rp {{ number_format($totalOperationalCost + $totalOtherCost, 0, ',', '.') }}</span>
                </div>
            </div>
        </div>
    </div>
</div>
            
            <!-- Margin & Rasio -->
            <div class="bg-white rounded-2xl shadow-md border border-gray-200 overflow-hidden mb-6">
                <div class="px-6 py-4 bg-gradient-to-r from-gray-50 to-white border-b border-gray-200">
                    <h3 class="font-semibold text-gray-800">📈 Margin & Rasio</h3>
                    <p class="text-xs text-gray-500">Analisis persentase terhadap penjualan</p>
                </div>
                <div class="p-6 space-y-4">
                    <div>
                        <div class="flex justify-between text-sm mb-1">
                            <span class="text-gray-600">Gross Profit Margin</span>
                            <span class="font-semibold text-blue-600">{{ number_format($grossMargin, 1) }}%</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2">
                            <div class="bg-blue-600 h-2 rounded-full" style="width: {{ min($grossMargin, 100) }}%"></div>
                        </div>
                    </div>
                    <div>
                        <div class="flex justify-between text-sm mb-1">
                            <span class="text-gray-600">Net Profit Margin</span>
                            <span class="font-semibold text-purple-600">{{ number_format($netMargin, 1) }}%</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2">
                            <div class="bg-purple-600 h-2 rounded-full" style="width: {{ min($netMargin, 100) }}%"></div>
                        </div>
                    </div>
                    <div>
                        <div class="flex justify-between text-sm mb-1">
                            <span class="text-gray-600">Rasio Biaya Operasional</span>
                            <span class="font-semibold text-red-600">{{ $totalOperationalCost > 0 ? number_format(($totalOperationalCost / max($totalSales, 1)) * 100, 1) : 0 }}%</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2">
                            <div class="bg-red-600 h-2 rounded-full" style="width: {{ min(($totalOperationalCost / max($totalSales, 1)) * 100, 100) }}%"></div>
                        </div>
                    </div>
                    <div>
                        <div class="flex justify-between text-sm mb-1">
                            <span class="text-gray-600">Rasio HPP</span>
                            <span class="font-semibold text-orange-600">{{ number_format($hppPercentage, 1) }}%</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2">
                            <div class="bg-orange-600 h-2 rounded-full" style="width: {{ min($hppPercentage, 100) }}%"></div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Grafik Penjualan Harian -->
            <div class="bg-white rounded-2xl shadow-md border border-gray-200 overflow-hidden mb-6">
                <div class="px-6 py-4 bg-gradient-to-r from-gray-50 to-white border-b border-gray-200">
                    <h3 class="font-semibold text-gray-800">📉 Tren Penjualan Harian</h3>
                </div>
                <div class="p-6">
                    <canvas id="salesChart" class="w-full h-[380px]"></canvas>
                </div>
            </div>
            
            <!-- Grafik 6 Bulan Terakhir -->
            <div class="bg-white rounded-2xl shadow-md border border-gray-200 overflow-hidden">
                <div class="px-6 py-4 bg-gradient-to-r from-gray-50 to-white border-b border-gray-200">
                    <h3 class="font-semibold text-gray-800">📊 Tren Penjualan 6 Bulan Terakhir</h3>
                </div>
                <div class="p-6">
                    <canvas id="monthlyChart" class="w-full h-[380px]"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Chart.js CDN -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <script>
        // Period toggle
        const periodSelect = document.getElementById('period');
        const dateRange = document.getElementById('dateRange');
        
        if (periodSelect) {
            periodSelect.addEventListener('change', function() {
                if (this.value === 'custom') {
                    dateRange.style.display = 'flex';
                } else {
                    dateRange.style.display = 'none';
                    this.form.submit();
                }
            });
        }

    // =====================================================
    // FORMAT RUPIAH
    // =====================================================

    function formatRupiah(value) {
        return 'Rp ' + new Intl.NumberFormat('id-ID').format(value);
    }

    // =====================================================
    // CHART PENJUALAN HARIAN
    // =====================================================

    const salesCtx = document.getElementById('salesChart');

    if (salesCtx) {

        const ctx = salesCtx.getContext('2d');

        // gradient
        const gradient = ctx.createLinearGradient(0, 0, 0, 400);

        gradient.addColorStop(0, 'rgba(59,130,246,0.35)');
        gradient.addColorStop(1, 'rgba(59,130,246,0)');

        new Chart(ctx, {

            type: 'line',

            data: {
                labels: @json($chartLabels ?? []),

                datasets: [{
                    label: 'Penjualan',
                    data: @json($chartSalesData ?? []),

                    borderColor: '#3b82f6',
                    backgroundColor: gradient,

                    fill: true,
                    tension: 0.45,

                    borderWidth: 3,

                    pointRadius: 4,
                    pointHoverRadius: 7,

                    pointBackgroundColor: '#3b82f6',
                    pointBorderColor: '#ffffff',
                    pointBorderWidth: 2,
                }]
            },

            options: {

                responsive: true,
                maintainAspectRatio: false,

                interaction: {
                    intersect: false,
                    mode: 'index',
                },

                plugins: {

                    legend: {
                        display: false
                    },

                    tooltip: {

                        backgroundColor: '#111827',

                        padding: 12,

                        displayColors: false,

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
    }

    // =====================================================
    // CHART BULANAN
    // =====================================================

    const monthlyCtx = document.getElementById('monthlyChart');

    if (monthlyCtx) {

        const ctx2 = monthlyCtx.getContext('2d');

        new Chart(ctx2, {

            type: 'bar',

            data: {
                labels: @json($monthlyLabels ?? []),

                datasets: [{
                    label: 'Penjualan',
                    data: @json($monthlySalesData ?? []),

                    backgroundColor: [
                        '#3b82f6',
                        '#6366f1',
                        '#8b5cf6',
                        '#06b6d4',
                        '#10b981',
                        '#f59e0b'],

                    borderRadius: 12,
                    borderSkipped: false,

                    hoverBorderWidth: 2,
                    hoverBorderColor: '#ffffff',

                    maxBarThickness: 60,
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

                        padding: 12,

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
    }
        
        // SweetAlert notifikasi
        @if(session('success'))
        Swal.fire({
            title: 'Berhasil!',
            text: '{{ session('success') }}',
            icon: 'success',
            confirmButtonColor: '#2563eb',
            confirmButtonText: 'OK',
            timer: 3000
        });
        @endif
        
        @if(session('error'))
        Swal.fire({
            title: 'Gagal!',
            text: '{{ session('error') }}',
            icon: 'error',
            confirmButtonColor: '#2563eb',
            confirmButtonText: 'OK'
        });
        @endif
    </script>
</x-app-layout>