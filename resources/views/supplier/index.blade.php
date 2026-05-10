<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col items-center justify-center text-center gap-2">
            <div>
                <h2 class="font-bold text-2xl text-gray-900 leading-tight">
                    Manajemen Supplier
                </h2>
                <p class="text-sm text-gray-600 mt-1">Kelola data supplier mebel</p>
            </div>
            <a href="{{ route('supplier.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2.5 rounded-xl text-sm font-medium transition shadow-md hover:shadow-lg inline-flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                Tambah Supplier
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-2xl shadow-md border border-gray-200 overflow-hidden">
                
                <!-- Success/Error Messages (Opsional - SweetAlert sudah handle) -->
                
                <!-- Header Info -->
                <div class="px-6 py-5 bg-gradient-to-r from-gray-50 to-white border-b border-gray-200">
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-xl bg-blue-100 flex items-center justify-center">
                                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                </svg>
                            </div>
                            <div>
                                <span class="text-sm font-medium text-gray-700">Daftar Supplier</span>
                                <p class="text-xs text-gray-500">Semua supplier mebel terdaftar</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-2 px-4 py-2 bg-blue-50 rounded-xl">
                            <svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                            </svg>
                            <span class="text-sm font-semibold text-blue-700">{{ $suppliers->count() }}</span>
                            <span class="text-sm text-blue-600">Total Supplier</span>
                        </div>
                    </div>
                </div>

                <!-- Tabel Supplier -->
                @if($suppliers->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="min-w-full w-full table-auto">
                            <thead>
                                <tr class="bg-gray-100 border-b border-gray-300">
                                    <th class="px-4 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Kode</th>
                                    <th class="px-4 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Nama Supplier</th>
                                    <th class="px-4 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Contact Person</th>
                                    <th class="px-4 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Telepon</th>
                                    <th class="px-4 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Email</th>
                                    <th class="px-4 py-3 text-center text-xs font-bold text-gray-700 uppercase tracking-wider">Status</th>
                                    <th class="px-4 py-3 text-center text-xs font-bold text-gray-700 uppercase tracking-wider">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @foreach($suppliers as $supplier)
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="px-4 py-3 font-mono text-sm font-semibold text-gray-800">{{ $supplier->code }}</td>
                                    <td class="px-4 py-3 font-semibold text-gray-800">{{ $supplier->name }}</td>
                                    <td class="px-4 py-3 text-gray-700">{{ $supplier->contact_person ?? '-' }}</td>
                                    <td class="px-4 py-3 text-gray-700">{{ $supplier->phone ?? '-' }}</td>
                                    <td class="px-4 py-3 text-gray-700">{{ $supplier->email ?? '-' }}</td>
                                    <td class="px-4 py-3 text-center">
                                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-semibold {{ $supplier->is_active ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                            {{ $supplier->is_active ? 'Aktif' : 'Nonaktif' }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-3 text-center">
                                        <div class="flex items-center justify-center gap-2">
                                            <a href="{{ route('supplier.edit', $supplier->id) }}" class="text-blue-600 hover:text-blue-800 transition p-1 hover:bg-blue-50 rounded-lg" title="Edit">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path>
                                                </svg>
                                            </a>
                                            <!-- Tombol Hapus dengan SweetAlert -->
                                            <button type="button" onclick="confirmDelete({{ $supplier->id }}, '{{ $supplier->name }}')" class="text-red-600 hover:text-red-800 transition p-1 hover:bg-red-50 rounded-lg" title="Hapus">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                </svg>
                                            </button>
                                            <form id="delete-form-{{ $supplier->id }}" action="{{ route('supplier.destroy', $supplier->id) }}" method="POST" class="hidden">
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
                        {{ $suppliers->links() }}
                    </div>
                @else
                    <div class="text-center py-16">
                        <div class="w-20 h-20 mx-auto bg-gray-100 rounded-2xl flex items-center justify-center mb-4">
                            <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                            </svg>
                        </div>
                        <p class="text-gray-500 font-medium">Belum ada data supplier</p>
                        <a href="{{ route('supplier.create') }}" class="mt-4 inline-flex items-center gap-2 text-blue-600 hover:text-blue-700">+ Tambah supplier pertama</a>
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
                title: '⚠️ Hapus Supplier?',
                html: `Supplier: <strong>${name}</strong><br><br>Data yang dihapus tidak dapat dikembalikan!`,
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