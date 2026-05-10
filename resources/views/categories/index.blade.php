<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col items-center justify-center text-center gap-2">
            <div>
                <h2 class="font-bold text-2xl text-gray-900 leading-tight">
                    Manajemen Kategori
                </h2>
                <p class="text-sm text-gray-600 mt-1">Kelola kategori produk</p>
            </div>
            <a href="{{ route('categories.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2.5 rounded-xl text-sm font-medium transition shadow-md hover:shadow-lg inline-flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                Tambah Kategori
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-2xl shadow-md border border-gray-200 overflow-hidden">
                
                <!-- Header Info -->
                <div class="px-6 py-5 bg-gradient-to-r from-gray-50 to-white border-b border-gray-200">
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-xl bg-blue-100 flex items-center justify-center">
                                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l5 5a2 2 0 01.586 1.414V19a2 2 0 01-2 2H7a2 2 0 01-2-2V5a2 2 0 012-2z"></path>
                                </svg>
                            </div>
                            <div>
                                <span class="text-sm font-medium text-gray-700">Daftar Kategori</span>
                                <p class="text-xs text-gray-500">Semua kategori produk terdaftar</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-2 px-4 py-2 bg-blue-50 rounded-xl">
                            <svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l5 5a2 2 0 01.586 1.414V19a2 2 0 01-2 2H7a2 2 0 01-2-2V5a2 2 0 012-2z"></path>
                            </svg>
                            <span class="text-sm font-semibold text-blue-700">{{ $categories->count() }}</span>
                            <span class="text-sm text-blue-600">Total Kategori</span>
                        </div>
                    </div>
                </div>
                
                <!-- Tabel Kategori -->
                @if($categories->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="min-w-full w-full table-auto">
                            <thead>
                                <tr class="bg-gray-100 border-b border-gray-300">
                                    <th class="px-3 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider w-16">ID</th>
                                    <th class="px-3 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Nama Kategori</th>
                                    <th class="px-3 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Slug</th>
                                    <th class="px-3 py-3 text-center text-xs font-bold text-gray-700 uppercase tracking-wider w-20">Produk</th>
                                    <th class="px-3 py-3 text-center text-xs font-bold text-gray-700 uppercase tracking-wider w-24">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @foreach($categories as $category)
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="px-3 py-2 font-mono text-sm font-semibold text-gray-800">{{ $category->id }}</td>
                                    <td class="px-3 py-2 font-semibold text-gray-800">{{ $category->name }}</td>
                                    <td class="px-3 py-2 text-gray-700">{{ $category->slug }}</td>
                                    <td class="px-3 py-2 text-center">
                                        @php
                                            $productCount = $category->furniture_count ?? 0;
                                        @endphp
                                        @if($productCount > 0)
                                            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-bold bg-green-100 text-green-700">
                                                {{ $productCount }}
                                            </span>
                                        @else
                                            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-semibold bg-gray-100 text-gray-600">
                                                0
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-3 py-2 text-center">
                                        <div class="flex items-center justify-center gap-1">
                                            <a href="{{ route('categories.edit', $category->id) }}" class="text-blue-600 hover:text-blue-800 transition p-1 hover:bg-blue-50 rounded-lg">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path>
                                                </svg>
                                            </a>
                                            <!-- Tombol Hapus dengan SweetAlert -->
                                            <button type="button" onclick="confirmDelete({{ $category->id }}, '{{ $category->name }}')" class="text-red-600 hover:text-red-800 transition p-1 hover:bg-red-50 rounded-lg" title="Hapus">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                </svg>
                                            </button>
                                            <form id="delete-form-{{ $category->id }}" action="{{ route('categories.destroy', $category->id) }}" method="POST" class="hidden">
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
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l5 5a2 2 0 01.586 1.414V19a2 2 0 01-2 2H7a2 2 0 01-2-2V5a2 2 0 012-2z"></path>
                            </svg>
                        </div>
                        <p class="text-gray-500 font-medium">Belum ada kategori</p>
                        <a href="{{ route('categories.create') }}" class="mt-4 inline-flex items-center gap-2 text-blue-600 hover:text-blue-700">+ Tambah kategori pertama</a>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- SweetAlert2 dan Script -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function confirmDelete(id, name) {
            Swal.fire({
                title: '⚠️ Hapus Kategori?',
                html: `Kategori: <strong>${name}</strong><br><br>Produk dengan kategori ini akan kehilangan kategori!`,
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