<x-app-layout>
     <x-slot name="header">
    <div class="flex flex-col items-center justify-center text-center gap-2">
    <div>
        <h2 class="font-bold text-2xl text-gray-900 leading-tight">
            Manajemen Produk Mebel
        </h2>
        <p class="text-sm text-gray-600 mt-1">Kelola data produk mebel</p>
    </div>
    <div class="flex gap-3 flex-wrap justify-center">
        <a href="{{ route('furniture.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2.5 rounded-xl text-sm font-medium transition shadow-md hover:shadow-lg inline-flex items-center gap-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            Tambah Produk
        </a>
        <a href="{{ route('furniture.export.excel') }}" class="bg-green-600 hover:bg-green-700 text-white px-6 py-2.5 rounded-xl text-sm font-medium transition shadow-md hover:shadow-lg inline-flex items-center gap-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
            </svg>
            Export Excel
        </a>
        <a href="{{ route('furniture.export.pdf') }}" class="bg-red-600 hover:bg-red-700 text-white px-6 py-2.5 rounded-xl text-sm font-medium transition shadow-md hover:shadow-lg inline-flex items-center gap-2">
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
            <div class="bg-white rounded-2xl shadow-md border border-gray-200 overflow-hidden">
                
               <!-- Header Info -->
<div class="px-6 py-5 bg-gradient-to-r from-gray-50 to-white border-b border-gray-200">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-xl bg-blue-100 flex items-center justify-center">
                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                </svg>
            </div>
            <div>
                <span class="text-sm font-medium text-gray-700">Daftar Produk</span>
                <p class="text-xs text-gray-500">Semua produk mebel</p>
            </div>
        </div>
        <div class="flex flex-wrap gap-3">
            <div class="flex items-center gap-2 px-4 py-2 bg-blue-50 rounded-xl">
                <svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                </svg>
                <span class="text-sm font-semibold text-blue-700">{{ $furniture->count() }}</span>
                <span class="text-sm text-blue-600">Total Produk</span>
            </div>
            
            <!-- ✅ TAMBAHKAN CARD TOTAL ASET -->
            <div class="flex items-center gap-2 px-4 py-2 bg-green-50 rounded-xl">
                <svg class="w-4 h-4 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <span class="text-sm font-semibold text-green-700">Rp {{ number_format($totalAset, 0, ',', '.') }}</span>
                <span class="text-sm text-green-600">Total Aset</span>
            </div>
        </div>
    </div>
</div>
                
                <!-- Filter Kategori -->
                <div class="p-4 border-b border-gray-200 bg-gray-50">
                    <form method="GET" action="{{ route('furniture.index') }}" class="flex flex-wrap items-center gap-3">
                        <span class="text-sm text-gray-700 font-medium">Filter Kategori:</span>
                        <select name="category" class="px-3 py-1.5 border border-gray-300 rounded-lg text-sm bg-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500" onchange="this.form.submit()">
                            <option value="">Semua Kategori</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </form>
                </div>
                
                <!-- Tabel Produk -->
                @if($furniture->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="min-w-full w-full table-auto">
                            <thead>
                                <tr class="bg-gray-100 border-b border-gray-300">
                                    <th class="px-3 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider w-12">Gambar</th>
                                    <th class="px-3 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider w-20">Kode</th>
                                    <th class="px-3 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Nama Produk</th>
                                    <th class="px-3 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider w-20">Kategori</th>
                                    <th class="px-3 py-3 text-right text-xs font-bold text-gray-700 uppercase tracking-wider w-28">Harga Beli</th>
                                    <th class="px-3 py-3 text-right text-xs font-bold text-gray-700 uppercase tracking-wider w-28">Harga Jual</th>
                                    <th class="px-3 py-3 text-right text-xs font-bold text-gray-700 uppercase tracking-wider w-28">Profit</th>
                                    <th class="px-3 py-3 text-center text-xs font-bold text-gray-700 uppercase tracking-wider w-16">Stok</th>
                                    <th class="px-3 py-3 text-center text-xs font-bold text-gray-700 uppercase tracking-wider w-20">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @foreach($furniture as $item)
                                <tr class="hover:bg-gray-50 transition">
                                    <!-- Gambar -->
                                    <td class="px-3 py-2">
                                        @if($item->image)
                                            <img src="{{ asset($item->image) }}" class="w-8 h-8 rounded-lg object-cover">
                                        @else
                                            <div class="w-8 h-8 bg-gray-100 rounded-lg flex items-center justify-center">
                                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                                </svg>
                                            </div>
                                        @endif
                                    </td>
                                    <!-- Kode -->
                                    <td class="px-3 py-2 font-mono text-sm font-semibold text-gray-800">{{ $item->code }}</td>
                                    <!-- Nama Produk --><td class="px-3 py-2 font-semibold text-gray-800">{{ $item->name }}</td>
                                    <!-- Kategori -->
                                    <td class="px-3 py-2 text-gray-700">{{ $item->category->name ?? '-' }}</td>
                                    <!-- Harga Beli (Orange) -->
                                    <td class="px-3 py-2 text-right font-medium text-orange-600 text-sm">
                                        {{ number_format($item->purchase_price, 0, ',', '.') }}
                                    </td>
                                    <!-- Harga Jual (Hijau) -->
                                    <td class="px-3 py-2 text-right font-bold text-green-600 text-sm">
                                        {{ number_format($item->selling_price, 0, ',', '.') }}
                                    </td>
                                    <!-- Profit (Biru) -->
                                    <td class="px-3 py-2 text-right font-semibold text-blue-600 text-sm">
                                        {{ number_format($item->selling_price - $item->purchase_price, 0, ',', '.') }}
                                    </td>
                                    <!-- Stok -->
                                    <td class="px-3 py-2 text-center">
                                        <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-bold {{ $item->stock <= $item->min_stock ? 'bg-red-100 text-red-700' : 'bg-green-100 text-green-700' }}">
                                            {{ $item->stock }}
                                        </span>
                                    </td>
                                    <!-- Aksi -->
                                    <td class="px-3 py-2 text-center">
                                        <div class="flex items-center justify-center gap-1">
                                            <a href="{{ route('furniture.edit', $item->id) }}" class="text-blue-600 hover:text-blue-800 transition p-1 hover:bg-blue-50 rounded-lg">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path>
                                                </svg>
                                            </a>
                                            <button type="button" onclick="confirmDelete({{ $item->id }}, '{{ $item->name }}')" class="text-red-600 hover:text-red-800 transition p-1 hover:bg-red-50 rounded-lg" title="Hapus">
    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
    </svg>
</button>
<form id="delete-form-{{ $item->id }}" action="{{ route('furniture.destroy', $item->id) }}" method="POST" class="hidden">
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
                @else
                    <div class="text-center py-16">
                        <div class="w-20 h-20 mx-auto bg-gray-100 rounded-2xl flex items-center justify-center mb-4">
                            <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                            </svg>
                        </div>
                        <p class="text-gray-500 font-medium">Belum ada produk</p>
                        <a href="{{ route('furniture.create') }}" class="mt-4 inline-flex items-center gap-2 text-blue-600 hover:text-blue-700">+ Tambah produk pertama</a>
                    </div>
                @endif
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function confirmDelete(id, name) {
        Swal.fire({
            title: '⚠️ Hapus Produk?',
            html: `Produk: <strong>${name}</strong><br><br>Data yang dihapus tidak dapat dikembalikan!`,
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