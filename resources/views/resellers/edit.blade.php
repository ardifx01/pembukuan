<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Edit Reseller
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-md border border-gray-100 dark:border-gray-700 overflow-hidden">
                
                <!-- Header -->
                <div class="px-6 py-5 bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700">
                    <div class="flex items-center gap-3">
                        <div class="p-2 bg-blue-100 dark:bg-blue-900/30 rounded-xl">
                            <svg class="w-5 h-5 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200">Edit Reseller</h3>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Perbarui data mitra reseller</p>
                        </div>
                    </div>
                </div>
                
                <form action="{{ route('resellers.update', $reseller->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="p-6 space-y-5">
                        
                        <!-- Nama Reseller -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">Nama Reseller <span class="text-red-500">*</span></label>
                            <input type="text" name="name" value="{{ old('name', $reseller->name) }}" 
                                class="w-full px-4 py-2.5 bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:text-gray-200" required>
                        </div>
                        
                        <!-- Email + Telepon -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">Email <span class="text-red-500">*</span></label>
                                <input type="email" name="email" value="{{ old('email', $reseller->email) }}" 
                                    class="w-full px-4 py-2.5 bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:text-gray-200" required>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">Telepon <span class="text-red-500">*</span></label>
                                <input type="text" name="phone" value="{{ old('phone', $reseller->phone) }}" 
                                    class="w-full px-4 py-2.5 bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:text-gray-200" required>
                            </div>
                        </div>
                        
                        <!-- Alamat -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">Alamat <span class="text-red-500">*</span></label>
                            <textarea name="address" rows="3" 
                                class="w-full px-4 py-2.5 bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:text-gray-200 resize-none"
                                required>{{ old('address', $reseller->address) }}</textarea>
                        </div>
                        
                        <!-- Komisi -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">Rate Komisi (%)</label>
                            <input type="number" name="commission_rate" step="0.01" value="{{ old('commission_rate', $reseller->commission_rate) }}" 
                                class="w-full px-4 py-2.5 bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:text-gray-200">
                            <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Persentase komisi dari setiap transaksi reseller</p>
                        </div>
                        
                        <!-- Tombol -->
                        <div class="flex gap-3 pt-4">
                            <button type="submit" class="flex-1 bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2.5 rounded-xl transition shadow-sm">
                                Update Reseller
                            </button>
                            <a href="{{ route('resellers.index') }}" class="flex-1 bg-gray-100 dark:bg-gray-700 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-600 text-gray-700 font-semibold py-2.5 rounded-xl transition text-center">
                                Batal
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>