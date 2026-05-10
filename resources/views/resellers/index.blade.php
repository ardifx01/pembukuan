<x-app-layout>
    <x-slot name="header">
    <div class="flex flex-col items-center gap-3">
        <div class="text-center">
            <h2 class="font-semibold text-xl text-black-900 dark:text-black-200 leading-tight">
                Manajemen Reseller
            </h2>
            <p class="text-sm text-black-500 dark:text-black-400 mt-1">Kelola data mitra reseller Anda</p>
        </div>
        <div class="flex justify-center">
            <a href="{{ route('resellers.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2.5 rounded-xl text-sm font-medium transition shadow-md hover:shadow-lg inline-flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                Tambah Reseller
            </a>
        </div>
    </div>
</x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
                
                <!-- Header Info dengan Gradient -->
                <div class="px-6 py-5 bg-gradient-to-r from-gray-50 to-white border-b border-gray-100">
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-xl bg-blue-100 flex items-center justify-center">
                                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                            </div>
                            <div>
                                <span class="text-sm font-medium text-gray-700">Daftar Reseller</span>
                                <p class="text-xs text-gray-400">Semua mitra reseller terdaftar</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-2 px-4 py-2 bg-blue-50 rounded-xl">
                            <svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            <span class="text-sm font-semibold text-blue-700">{{ $resellers->count() }}</span>
                            <span class="text-sm text-blue-600">Total Reseller</span>
                        </div>
                    </div>
                </div>
                
                <!-- Tabel Reseller -->
@if($resellers->count() > 0)
    <div class="overflow-x-auto">
        <table class="min-w-[800px] w-full">
            <thead>
                <tr class="bg-gray-50 border-b border-gray-200">
                    <th class="px-4 py-3 text-center text-xs font-semibold text-gray-500 uppercase tracking-wider border-r border-gray-200 w-12">No</th>
                    <th class="px-4 py-3 text-center text-xs font-semibold text-gray-500 uppercase tracking-wider border-r border-gray-200 w-36">Nama Reseller</th>
                    <th class="px-4 py-3 text-center text-xs font-semibold text-gray-500 uppercase tracking-wider border-r border-gray-200 w-44">Email</th>
                    <th class="px-4 py-3 text-center text-xs font-semibold text-gray-500 uppercase tracking-wider border-r border-gray-200 w-32">Telepon</th>
                    <th class="px-4 py-3 text-center text-xs font-semibold text-gray-500 uppercase tracking-wider border-r border-gray-200 w-44">Alamat</th>
                    <th class="px-4 py-3 text-center text-xs font-semibold text-gray-500 uppercase tracking-wider border-r border-gray-200 w-20">Komisi</th>
                    <th class="px-4 py-3 text-center text-xs font-semibold text-gray-500 uppercase tracking-wider w-24">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @foreach($resellers as $index => $reseller)
                <tr class="hover:bg-gray-50 transition group">
                    <td class="px-4 py-3 text-gray-400 text-center border-r border-gray-100">{{ $loop->iteration }}</td>
                    <td class="px-4 py-3 text-center border-r border-gray-100">
                        <div class="flex items-center justify-center gap-2">
                            <div class="w-8 h-8 rounded-xl bg-gradient-to-br from-blue-500 to-blue-600 flex items-center justify-center shadow-sm flex-shrink-0">
                                <span class="text-xs font-bold text-white">{{ substr($reseller->name, 0, 1) }}</span>
                            </div>
                            <span class="font-semibold text-gray-800 text-sm whitespace-nowrap">{{ $reseller->name }}</span>
                        </div>
                    </td>
                    <td class="px-4 py-3 text-center border-r border-gray-100">
                        <div class="flex items-center justify-center gap-1">
                            <svg class="w-3.5 h-3.5 text-gray-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                            <span class="text-gray-600 text-sm truncate max-w-[120px]">{{ $reseller->email }}</span>
                        </div>
                    </td>
                    <td class="px-4 py-3 text-center border-r border-gray-100">
                        <div class="flex items-center justify-center gap-1">
                            <svg class="w-3.5 h-3.5 text-gray-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                            </svg>
                            <span class="text-gray-600 text-sm whitespace-nowrap">{{ $reseller->phone }}</span>
                        </div>
                    </td>
                    <td class="px-4 py-3 text-center border-r border-gray-100">
                        <div class="flex items-center justify-center gap-1">
                            <svg class="w-3.5 h-3.5 text-gray-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            <span class="text-gray-500 text-sm truncate max-w-[140px]">{{ Str::limit($reseller->address, 25) }}</span>
                        </div>
                    </td>
                    <td class="px-4 py-3 text-center border-r border-gray-100"><span class="inline-flex items-center justify-center px-2 py-0.5 rounded-full text-xs font-semibold bg-yellow-100 text-yellow-700">
                            {{ $reseller->commission_rate }}%
                        </span>
                    </td>
                    <td class="px-4 py-3 text-center">
                        <div class="flex items-center justify-center gap-2">
                            <a href="{{ route('resellers.edit', $reseller->id) }}" class="text-blue-500 hover:text-blue-700 transition">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                </svg>
                            </a>
                            <form action="{{ route('resellers.destroy', $reseller->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="button" 
                                    onclick="customConfirm('Yakin hapus reseller {{ $reseller->name }}?').then(res => { if(res) { this.closest('form').submit(); } })" 
                                    class="text-red-500 hover:text-red-700 transition">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                    </svg>
                                </button>
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
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                        </div>
                        <p class="text-gray-500 font-medium">Belum ada reseller</p>
                        <p class="text-sm text-gray-400 mt-1">Silakan tambah reseller pertama Anda</p>
                        <a href="{{ route('resellers.create') }}" class="mt-4 inline-flex items-center gap-2 text-blue-600 hover:text-blue-700">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                            </svg>
                            Tambah Reseller
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>