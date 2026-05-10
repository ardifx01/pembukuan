<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-4">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Tambah Kategori
                </h2>
                <p class="text-sm text-gray-500 mt-1">Buat kategori produk baru</p>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
                
                <!-- Header Form -->
                <div class="px-6 py-5 bg-gradient-to-r from-gray-50 to-white border-b border-gray-100">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-blue-100 flex items-center justify-center">
                            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l5 5a2 2 0 01.586 1.414V19a2 2 0 01-2 2H7a2 2 0 01-2-2V5a2 2 0 012-2z"></path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-800">Form Kategori Baru</h3>
                            <p class="text-sm text-gray-500">Isi data kategori di bawah ini</p>
                        </div>
                    </div>
                </div>
                
                <!-- Form Body -->
                <form action="{{ route('categories.store') }}" method="POST">
                    @csrf
                    <div class="p-6 space-y-5">
                        
                        <!-- Nama Kategori -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1.5">
                                Nama Kategori <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="name" 
                                class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl focus:bg-white focus:border-blue-400 focus:ring-2 focus:ring-blue-100 transition-all"
                                placeholder="Contoh: Kursi, Meja, Lemari" required>
                            <p class="text-xs text-gray-400 mt-1">Nama kategori akan otomatis dibuatkan slug</p>
                        </div>
                        
                        <!-- Deskripsi -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1.5">
                                Deskripsi
                            </label>
                            <textarea name="description" rows="4" 
                                class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl focus:bg-white focus:border-blue-400 focus:ring-2 focus:ring-blue-100 transition-all resize-none"
                                placeholder="Deskripsi kategori (opsional)"></textarea>
                        </div>
                        
                        <!-- Tombol -->
                        <div class="flex gap-3 pt-4">
                            <button type="submit" 
                                class="flex-1 bg-blue-600 hover:bg-blue-700 text-white font-medium py-2.5 rounded-xl transition shadow-sm">
                                Simpan Kategori
                            </button>
                            <a href="{{ route('categories.index') }}" 
                                class="flex-1 bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium py-2.5 rounded-xl transition text-center">
                                Batal
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>