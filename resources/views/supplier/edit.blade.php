<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h2 class="font-bold text-2xl text-gray-900 leading-tight">
                    Edit Supplier
                </h2>
                <p class="text-sm text-gray-600 mt-1">Perbarui data supplier di bawah ini</p>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-2xl shadow-md border border-gray-200 overflow-hidden">
                
                <form method="POST" action="{{ route('supplier.update', $supplier->id) }}" class="p-8">
                    @csrf
                    @method('PUT')

                    <!-- Header Form -->
                    <div class="mb-6 pb-4 border-b border-gray-200">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-xl bg-blue-100 flex items-center justify-center">
                                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-lg font-semibold text-gray-800">Form Edit Supplier</h3>
                                <p class="text-sm text-gray-500">Perbarui data supplier yang sudah ada</p>
                            </div>
                        </div>
                    </div>

                    <div class="space-y-5">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            <!-- Kode Supplier -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1.5">
                                    Kode Supplier <span class="text-red-500">*</span>
                                </label>
                                <input type="text" name="code" value="{{ old('code', $supplier->code) }}" 
                                    class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl focus:bg-white focus:border-blue-400 focus:ring-2 focus:ring-blue-100 transition-all"
                                    placeholder="SPL-001" required>
                                @error('code') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>

                            <!-- Nama Supplier -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1.5">
                                    Nama Supplier <span class="text-red-500">*</span>
                                </label>
                                <input type="text" name="name" value="{{ old('name', $supplier->name) }}" 
                                    class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl focus:bg-white focus:border-blue-400 focus:ring-2 focus:ring-blue-100 transition-all"
                                    placeholder="PT. Furnindo Utama" required>
                                @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            <!-- Contact Person -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1.5">
                                    Contact Person
                                </label>
                                <input type="text" name="contact_person" value="{{ old('contact_person', $supplier->contact_person) }}" 
                                    class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl focus:bg-white focus:border-blue-400 focus:ring-2 focus:ring-blue-100 transition-all"
                                    placeholder="Budi Santoso">
                            </div>

                            <!-- Telepon -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1.5">
                                    Telepon
                                </label>
                                <input type="text" name="phone" value="{{ old('phone', $supplier->phone) }}" 
                                    class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl focus:bg-white focus:border-blue-400 focus:ring-2 focus:ring-blue-100 transition-all"
                                    placeholder="081234567890">
                            </div>
                        </div>

                        <!-- Email -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1.5">
                                Email
                            </label>
                            <input type="email" name="email" value="{{ old('email', $supplier->email) }}" 
                                class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl focus:bg-white focus:border-blue-400 focus:ring-2 focus:ring-blue-100 transition-all"
                                placeholder="supplier@email.com">
                            @error('email') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>

                        <!-- Alamat -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1.5">
                                Alamat
                            </label>
                            <textarea name="address" rows="3" 
                                      class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl focus:bg-white focus:border-blue-400 focus:ring-2 focus:ring-blue-100 transition-all resize-none"
                                      placeholder="Jl. Raya ...">{{ old('address', $supplier->address) }}</textarea>
                        </div>

                        <!-- Status Aktif -->
                        <div>
                            <label class="flex items-center gap-2 cursor-pointer">
                                <input type="checkbox" name="is_active" value="1" {{ old('is_active', $supplier->is_active) ? 'checked' : '' }}
                                       class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500">
                                <span class="text-sm font-medium text-gray-700">Supplier Aktif</span>
                            </label>
                            <p class="text-xs text-gray-500 mt-1">Nonaktifkan jika supplier sudah tidak bekerja sama</p>
                        </div>
                    </div>

                    <!-- Tombol Submit -->
                    <div class="flex gap-3 mt-8 pt-4 border-t border-gray-200">
                        <button type="submit" class="flex-1 bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2.5 rounded-xl transition shadow-sm">
                            Update Supplier
                        </button>
                        <a href="{{ route('supplier.index') }}" class="flex-1 bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold py-2.5 rounded-xl transition text-center">
                            Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>