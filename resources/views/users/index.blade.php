<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col items-center justify-center text-center gap-2">
            <div>
                <h2 class="font-bold text-2xl text-gray-900 leading-tight">
                    Manajemen User
                </h2>
                <p class="text-sm text-gray-600 mt-1">Kelola akun pengguna sistem</p>
            </div>
            <a href="{{ route('users.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2.5 rounded-xl text-sm font-medium transition shadow-md hover:shadow-lg inline-flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                Tambah User
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-2xl shadow-md border border-gray-100 overflow-hidden">
                
                <!-- Header Info -->
                <div class="px-6 py-5 bg-gradient-to-r from-gray-50 to-white border-b border-gray-100">
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-xl bg-blue-100 flex items-center justify-center">
                                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                                </svg>
                            </div>
                            <div>
                                <span class="text-sm font-medium text-gray-700">Daftar User</span>
                                <p class="text-xs text-gray-400">Semua akun pengguna sistem</p>
                            </div>
                        </div>  
                        <div class="flex items-center gap-2 px-4 py-2 bg-blue-50 rounded-xl">
                            <svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                            </svg>
                            <span class="text-sm font-semibold text-blue-700">{{ $users->count() }}</span>
                            <span class="text-sm text-blue-600">Total User</span>
                        </div>
                    </div>
                </div>
                
                <!-- Tabel User -->
                <div class="overflow-x-auto">
                    <table class="min-w-[800px] w-full">
                        <thead>
                            <tr class="bg-gray-50 border-b border-gray-200">
                                <th class="px-5 py-4 text-center text-xs font-semibold text-gray-500 uppercase tracking-wider border-r border-gray-200 w-16">ID</th>
                                <th class="px-5 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider border-r border-gray-200">Nama User</th>
                                <th class="px-5 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider border-r border-gray-200">Email</th>
                                <th class="px-5 py-4 text-center text-xs font-semibold text-gray-500 uppercase tracking-wider border-r border-gray-200 w-24">Role</th>
                                <th class="px-5 py-4 text-center text-xs font-semibold text-gray-500 uppercase tracking-wider border-r border-gray-200 w-24">Status</th>
                                <th class="px-5 py-4 text-center text-xs font-semibold text-gray-500 uppercase tracking-wider w-32">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @foreach($users as $user)
                            <tr class="hover:bg-gray-50 transition group">
                                <td class="px-5 py-4 text-gray-400 text-center border-r border-gray-100 font-mono text-sm">{{ $user->id }}</td>
                                <td class="px-5 py-4 border-r border-gray-100">
                                    <div class="flex items-center gap-3">
                                        <div class="w-9 h-9 rounded-xl bg-gradient-to-br from-blue-500 to-blue-600 flex items-center justify-center shadow-sm flex-shrink-0">
                                            <span class="text-sm font-bold text-white">{{ substr($user->name, 0, 1) }}</span>
                                        </div>
                                        <span class="font-semibold text-gray-800">{{ $user->name }}</span>
                                    </div>
                                </td>
                                <td class="px-5 py-4 text-gray-600 border-r border-gray-100">
                                    <div class="flex items-center gap-1.5">
                                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                        </svg>
                                        <span class="text-gray-600">{{ $user->email }}</span>
                                    </div>
                                </td>
                                <td class="px-5 py-4 text-center border-r border-gray-100">
                                    <span class="inline-flex px-2.5 py-1 rounded-full text-xs font-semibold
                                        @if($user->role == 'admin') bg-red-100 text-red-700
                                        @elseif($user->role == 'kasir') bg-green-100 text-green-700
                                        @else bg-blue-100 text-blue-700
                                        @endif">
                                        {{ ucfirst($user->role) }}
                                    </span>
                                </td>
                                <td class="px-5 py-4 text-center border-r border-gray-100">
                                    <span class="inline-flex px-2.5 py-1 rounded-full text-xs font-semibold {{ $user->is_active ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-700' }}">
                                        {{ $user->is_active ? 'Aktif' : 'Nonaktif' }}
                                    </span>
                                </td>
                                <td class="px-5 py-4 text-center">
                                    <div class="flex items-center justify-center gap-2">
                                        <a href="{{ route('users.edit', $user->id) }}" class="p-1.5 text-blue-500 hover:text-blue-700 hover:bg-blue-50 rounded-lg transition" title="Edit">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                            </svg>
                                        </a>
                                        <a href="{{ route('users.toggle', $user->id) }}" class="p-1.5 text-yellow-500 hover:text-yellow-700 hover:bg-yellow-50 rounded-lg transition" title="{{ $user->is_active ? 'Nonaktifkan' : 'Aktifkan' }}">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636"></path>
                                            </svg>
                                        </a>
                                        @if($user->id != auth()->id())
                                            <button type="button" onclick="confirmDelete({{ $user->id }}, '{{ $user->name }}')" class="p-1.5 text-red-500 hover:text-red-700 hover:bg-red-50 rounded-lg transition" title="Hapus">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                </svg>
                                            </button>
                                            <form id="delete-form-{{ $user->id }}" action="{{ route('users.destroy', $user->id) }}" method="POST" class="hidden">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- SweetAlert2 dan Script -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function confirmDelete(id, name) {
            Swal.fire({
                title: '⚠️ Hapus User?',
                html: `User: <strong>${name}</strong><br><br>Data yang dihapus tidak dapat dikembalikan!`,
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