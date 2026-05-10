<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Tambah Produk
            </h2>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <!-- Card Form -->
            <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
                
                <!-- Header Card -->
                <div class="px-6 py-5 border-b border-gray-100 bg-gradient-to-r from-gray-50 to-white">
                    <div class="flex items-center gap-3">
                        <div class="p-2 bg-blue-50 rounded-xl">
                            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-800">Informasi Produk</h3>
                            <p class="text-sm text-gray-500">Lengkapi data produk di bawah ini</p>
                        </div>
                    </div>
                </div>
                
                <!-- Form Body -->
                <form action="{{ route('furniture.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="p-6 space-y-5">
                        
                        <!-- Baris 1: Kode + Nama -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1.5">
                                    Kode Produk <span class="text-red-500">*</span>
                                </label>
                                <input type="text" name="code" 
                                    class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl focus:bg-white focus:border-blue-400 focus:ring-2 focus:ring-blue-100 transition-all"
                                    placeholder="MEB-001" required>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1.5">
                                    Nama Produk <span class="text-red-500">*</span>
                                </label>
                                <input type="text" name="name" 
                                    class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl focus:bg-white focus:border-blue-400 focus:ring-2 focus:ring-blue-100 transition-all"
                                    placeholder="Kursi Kayu Jati" required>
                            </div>
                        </div>
                        
                        <!-- Baris 2: Kategori + Supplier -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1.5">
                                    Kategori <span class="text-red-500">*</span>
                                </label>
                                <select name="category_id" 
                                    class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl focus:bg-white focus:border-blue-400 focus:ring-2 focus:ring-blue-100 transition-all">
                                    <option value="">Pilih kategori</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1.5">Supplier</label>
                                <select name="supplier_id" 
                                    class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl focus:bg-white focus:border-blue-400 focus:ring-2 focus:ring-blue-100 transition-all">
                                    <option value="">Pilih supplier</option>
                                    @foreach($suppliers as $supplier)
                                        <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        
                        <!-- Baris 3: Harga Pokok + Harga Jual -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1.5">
                                    Harga Pokok <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">Rp</span>
                                    <input type="text" name="purchase_price" id="purchase_price"
                                        class="w-full pl-8 pr-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl focus:bg-white focus:border-blue-400 focus:ring-2 focus:ring-blue-100 transition-all"
                                        placeholder="0" required>
                                </div>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1.5">
                                    Harga Jual <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">Rp</span>
                                    <input type="text" name="selling_price" id="selling_price"
                                        class="w-full pl-8 pr-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl focus:bg-white focus:border-blue-400 focus:ring-2 focus:ring-blue-100 transition-all"
                                        placeholder="0" required>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Baris 4: Stok + Min Stok -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1.5">
                                    Stok Awal <span class="text-red-500">*</span>
                                </label>
                                <input type="number" name="stock" 
                                    class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl focus:bg-white focus:border-blue-400 focus:ring-2 focus:ring-blue-100 transition-all"
                                    placeholder="0" required>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1.5">
                                    Minimal Stok <span class="text-red-500">*</span>
                                </label>
                                <input type="number" name="min_stock" 
                                    class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl focus:bg-white focus:border-blue-400 focus:ring-2 focus:ring-blue-100 transition-all"
                                    value="5" required>
                            </div>
                        </div>
                        
                        <!-- Foto Upload -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1.5">Foto Produk</label>
                            <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-200 border-dashed rounded-xl hover:border-blue-400 transition-colors cursor-pointer" id="uploadArea">
                                <div class="space-y-1 text-center">
                                    <input type="file" name="image" id="imageInput" accept="image/*" class="hidden">
                                    <div id="uploadPlaceholder">
                                        <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                        <div class="flex text-sm text-gray-600">
                                            <p class="text-blue-600">Klik untuk upload</p>
                                            <p class="ml-1">atau drag & drop</p>
                                        </div>
                                        <p class="text-xs text-gray-500">PNG, JPG up to 2MB</p>
                                    </div>
                                    <div id="imagePreviewArea" class="hidden">
                                        <img id="previewImage" class="mx-auto h-32 w-32 object-cover rounded-lg shadow">
                                        <p id="imageName" class="mt-2 text-sm text-gray-600"></p>
                                        <button type="button" id="removeImageBtn" 
                                            class="mt-3 inline-flex items-center gap-2 px-4 py-2 bg-red-50 hover:bg-red-100 text-red-600 hover:text-red-700 rounded-xl text-sm font-medium transition-all duration-200 border border-red-200 hover:border-red-300">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                            </svg>
                                            Hapus Gambar
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Tombol -->
                        <div class="flex gap-3 pt-4">
                            <button type="submit" 
                                class="flex-1 bg-blue-600 hover:bg-blue-700 text-white font-medium py-2.5 rounded-xl transition shadow-sm">
                                Simpan Produk
                            </button>
                            <a href="{{ route('furniture.index') }}" 
                                class="flex-1 bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium py-2.5 rounded-xl transition text-center">
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
        
        removeImageBtn.addEventListener('click', () => {
            imageInput.value = '';
            uploadPlaceholder.classList.remove('hidden');
            imagePreviewArea.classList.add('hidden');
        });
        
        // Drag and drop
        uploadArea.addEventListener('dragover', (e) => {
            e.preventDefault();
            uploadArea.classList.add('border-blue-400', 'bg-blue-50');
        });
        
        uploadArea.addEventListener('dragleave', (e) => {
            e.preventDefault();
            uploadArea.classList.remove('border-blue-400', 'bg-blue-50');
        });
        
        uploadArea.addEventListener('drop', (e) => {
            e.preventDefault();
            uploadArea.classList.remove('border-blue-400', 'bg-blue-50');
            const file = e.dataTransfer.files[0];
            if (file && file.type.startsWith('image/')) {
                imageInput.files = e.dataTransfer.files;
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
        
        // Format Rupiah untuk input harga
        function formatRupiah(angka) {
            let number = angka.replace(/[^,\d]/g, '').toString();
            let split = number.split(',');
            let sisa = split[0].length % 3;
            let rupiah = split[0].substr(0, sisa);
            let ribuan = split[0].substr(sisa).match(/\d{3}/gi);
            
            if (ribuan) {
                let separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }
            
            rupiah = split[1] !== undefined ? rupiah + ',' + split[1] : rupiah;
            return rupiah;
        }
        
        document.addEventListener('DOMContentLoaded', function() {
            const hargaBeli = document.getElementById('purchase_price');
            const hargaJual = document.getElementById('selling_price');
            const form = document.querySelector('form');
            
            if (hargaBeli) {
                hargaBeli.addEventListener('input', function(e) {
                    let value = this.value.replace(/\./g, '');
                    if (!isNaN(value) && value !== '') {
                        this.value = formatRupiah(value);
                    }
                });
            }
            
            if (hargaJual) {
                hargaJual.addEventListener('input', function(e) {
                    let value = this.value.replace(/\./g, '');
                    if (!isNaN(value) && value !== '') {
                        this.value = formatRupiah(value);
                    }
                });
            }
            
            // Saat form disubmit, ubah kembali ke angka tanpa titik
            if (form) {
                form.addEventListener('submit', function() {
                    if (hargaBeli) hargaBeli.value = hargaBeli.value.replace(/\./g, '');
                    if (hargaJual) hargaJual.value = hargaJual.value.replace(/\./g, '');
                });
            }
        });
    </script>
</x-app-layout>