<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-black-800 dark:text-black-200 leading-tight">
            Edit Produk
        </h2>
           <p class="text-sm text-gray-500 mt-1">Perbarui data produk</p>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
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
                            <h3 class="text-lg font-semibold text-black-800 dark:text-black-200">Edit Informasi Produk</h3>
                            <p class="text-sm text-black-500 dark:text-black-400">Perbarui data produk di bawah ini</p>
                        </div>
                    </div>
                </div>
                
                <form action="{{ route('furniture.update', $furniture->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="p-6 space-y-5">
                        
                        <!-- Grid 2 kolom -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">Kode Produk <span class="text-red-500">*</span></label>
                                <input type="text" name="code" value="{{ old('code', $furniture->code) }}" 
                                    class="w-full px-4 py-2.5 bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:text-gray-200" required>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">Nama Produk <span class="text-red-500">*</span></label>
                                <input type="text" name="name" value="{{ old('name', $furniture->name) }}" 
                                    class="w-full px-4 py-2.5 bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:text-gray-200" required>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">Kategori <span class="text-red-500">*</span></label>
                                <select name="category_id" 
                                    class="w-full px-4 py-2.5 bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:text-gray-200">
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ $furniture->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">Supplier</label>
                                <select name="supplier_id" 
                                    class="w-full px-4 py-2.5 bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:text-gray-200">
                                    <option value="">Pilih supplier</option>
                                    @foreach($suppliers as $supplier)
                                        <option value="{{ $supplier->id }}" {{ $furniture->supplier_id == $supplier->id ? 'selected' : '' }}>{{ $supplier->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                          <!-- Harga Pokok -->
<div>
    <label class="block text-sm font-medium text-gray-700 mb-1.5">
        Harga Pokok <span class="text-red-500">*</span>
    </label>
    <div class="relative">
        <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">Rp</span>
        <input type="text" name="purchase_price" id="purchase_price"
            class="w-full pl-8 pr-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl focus:bg-white focus:border-blue-400 focus:ring-2 focus:ring-blue-100 transition-all"
            placeholder="0" 
            value="{{ old('purchase_price', number_format((int) str_replace('.', '', $furniture->purchase_price), 0, ',', '.')) }}"
            required>
    </div>
</div>

<!-- Harga Jual -->
<div>
    <label class="block text-sm font-medium text-gray-700 mb-1.5">
        Harga Jual <span class="text-red-500">*</span>
    </label>
    <div class="relative">
        <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">Rp</span>
        <input type="text" name="selling_price" id="selling_price"
            class="w-full pl-8 pr-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl focus:bg-white focus:border-blue-400 focus:ring-2 focus:ring-blue-100 transition-all"
            placeholder="0" 
            value="{{ old('selling_price', number_format((int) str_replace('.', '', $furniture->selling_price), 0, ',', '.')) }}"
            required>
    </div>
</div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">Stok <span class="text-red-500">*</span></label>
                                <input type="number" name="stock" value="{{ old('stock', $furniture->stock) }}" 
                                    class="w-full px-4 py-2.5 bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:text-gray-200" required>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">Minimal Stok <span class="text-red-500">*</span></label>
                                <input type="number" name="min_stock" value="{{ old('min_stock', $furniture->min_stock) }}" 
                                    class="w-full px-4 py-2.5 bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:text-gray-200" required>
                            </div>
                        </div>
                        
                        <!-- Foto Upload -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">Foto Produk</label>
                            <div id="uploadArea" class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-200 dark:border-gray-600 border-dashed rounded-xl hover:border-blue-400 transition-colors cursor-pointer bg-gray-50 dark:bg-gray-700">
                                <div class="space-y-1 text-center">
                                    <input type="file" name="image" id="imageInput" accept="image/*" class="hidden">
                                    <div id="uploadPlaceholder">
                                        <svg class="mx-auto h-12 w-12 text-gray-400 dark:text-gray-500" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                        <div class="flex text-sm text-gray-600 dark:text-gray-400">
                                            <p class="text-blue-600 dark:text-blue-400">Klik untuk upload</p>
                                            <p class="ml-1">atau drag & drop</p>
                                        </div>
                                        <p class="text-xs text-gray-500 dark:text-gray-400">PNG, JPG up to 2MB</p>
                                    </div>
                                    <div id="imagePreviewArea" class="hidden">
                                        <img id="previewImage" class="mx-auto h-32 w-32 object-cover rounded-lg shadow">
                                        <p id="imageName" class="mt-2 text-sm text-gray-600 dark:text-gray-400"></p>
                                        <button type="button" id="removeImageBtn" class="mt-2 text-sm text-red-500 hover:text-red-700">Hapus</button>
                                    </div>
                                </div>
                            </div>
                            @if($furniture->image)
                            <div class="mt-3 text-center">
                                <p class="text-xs text-gray-500 dark:text-gray-400 mb-1">Gambar saat ini:</p>
                                <img src="{{ asset($furniture->image) }}" class="h-20 w-20 object-cover rounded-lg mx-auto border dark:border-gray-600">
                            </div>
                            @endif
                        </div>
                        
                        <!-- Tombol -->
                        <div class="flex gap-3 pt-4">
                            <button type="submit" class="flex-1 bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2.5 rounded-xl transition shadow-sm">
                                Update Produk
                            </button>
                            <a href="{{ route('furniture.index') }}" class="flex-1 bg-gray-100 dark:bg-gray-700 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-600 text-gray-700 font-semibold py-2.5 rounded-xl transition text-center">
                                Batal
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Image preview
        const uploadArea = document.getElementById('uploadArea');
        const imageInput = document.getElementById('imageInput');
        const uploadPlaceholder = document.getElementById('uploadPlaceholder');
        const imagePreviewArea = document.getElementById('imagePreviewArea');
        const previewImage = document.getElementById('previewImage');
        const imageName = document.getElementById('imageName');
        const removeImageBtn = document.getElementById('removeImageBtn');
        
        if (uploadArea) {
            uploadArea.addEventListener('click', () => imageInput.click());
            
            imageInput.addEventListener('change', function(e) {
                const file = e.target.files[0];
                if (file && file.type.startsWith('image/')) {
                    const reader = new FileReader();
                    reader.onload = (e) => {
                        previewImage.src = e.target.result;
                        imageName.textContent = file.name;
                        uploadPlaceholder.classList.add('hidden');
                        imagePreviewArea.classList.remove('hidden');
                    };
                    reader.readAsDataURL(file);
                }
            });
            
            if (removeImageBtn) {
                removeImageBtn.addEventListener('click', () => {
                    imageInput.value = '';
                    uploadPlaceholder.classList.remove('hidden');
                    imagePreviewArea.classList.add('hidden');
                });
            }
        }
    </script>
    <script>
// Format Rupiah
function formatRupiah(angka) {
    if (!angka) return '';
    let number = angka.toString().replace(/\./g, '');
    number = number.replace(/[^0-9]/g, '');
    if (number === '') return '';
    return new Intl.NumberFormat('id-ID').format(number);
}

document.addEventListener('DOMContentLoaded', function() {
    const hargaBeli = document.getElementById('purchase_price');
    const hargaJual = document.getElementById('selling_price');
    
    // ✅ Format nilai awal saat halaman dimuat
    if (hargaBeli && hargaBeli.value) {
        hargaBeli.value = formatRupiah(hargaBeli.value);
    }
    
    if (hargaJual && hargaJual.value) {
        hargaJual.value = formatRupiah(hargaJual.value);
    }
    
    // Event listener untuk input
    if (hargaBeli) {
        hargaBeli.addEventListener('input', function(e) {
            let value = this.value.replace(/\./g, '');
            value = value.replace(/[^0-9]/g, '');
            if (value !== '') {
                this.value = formatRupiah(value);
            }
        });
    }
    
    if (hargaJual) {
        hargaJual.addEventListener('input', function(e) {
            let value = this.value.replace(/\./g, '');
            value = value.replace(/[^0-9]/g, '');
            if (value !== '') {
                this.value = formatRupiah(value);
            }
        });
    }
});
</script>
</x-app-layout>