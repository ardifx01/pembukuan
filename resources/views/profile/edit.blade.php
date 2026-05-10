<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h2 class="font-semibold text-xl text-black-800 dark:text-black-200 leading-tight">
                    Profil Saya
                </h2>
                <p class="text-sm text-black-500 dark:text-black-400 mt-1">Kelola informasi akun Anda</p>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                
                <!-- Sidebar Info -->
                <div class="lg:col-span-1">
                    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-md border border-gray-100 dark:border-gray-700 overflow-hidden">
                        <div class="p-6 text-center border-b border-gray-100 dark:border-gray-700">
                            <div class="relative inline-block">
                                @if(Auth::user()->avatar && file_exists(public_path(Auth::user()->avatar)))
                                    <img src="{{ asset(Auth::user()->avatar) }}" class="w-28 h-28 rounded-full object-cover mx-auto border-4 border-blue-100 dark:border-blue-900 shadow-md">
                                @else
                                    <div class="w-28 h-28 rounded-full bg-gradient-to-br from-blue-500 to-purple-600 flex items-center justify-center mx-auto shadow-md">
                                        <span class="text-4xl font-bold text-white uppercase">
                                            {{ substr(Auth::user()->name, 0, 1) }}
                                        </span>
                                    </div>
                                @endif
                                <div class="absolute bottom-0 right-0 w-5 h-5 bg-green-500 border-2 border-white dark:border-gray-800 rounded-full"></div>
                            </div>
                            <h3 class="mt-4 text-xl font-semibold text-black-800 dark:text-black-200">{{ Auth::user()->name }}</h3>
                            <p class="text-sm text-black-500 dark:text-black-400 mt-1">{{ Auth::user()->email }}</p>
                            <div class="mt-3 inline-flex items-center gap-1 bg-gray-100 dark:bg-gray-700 px-3 py-1 rounded-full">
                                <svg class="w-3 h-3 text-black-500 dark:text-black-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                                <span class="text-xs text-black-500 dark:text-black-400">
                                    {{ ucfirst(Auth::user()->role) }}
                                </span>
                            </div>
                            <p class="text-xs text-gray-400 dark:text-gray-500 mt-3">
                                Member sejak {{ Auth::user()->created_at->format('d F Y') }}
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Form Edit Profil -->
                <div class="lg:col-span-2 space-y-6">
                    
                    <!-- Form Data Diri -->
                    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-md border border-gray-100 dark:border-gray-700 overflow-hidden">
                        <div class="px-6 py-4 border-b border-gray-100 dark:border-gray-700 bg-gradient-to-r from-gray-50 to-white dark:from-gray-800 dark:to-gray-800">
                            <div class="flex items-center gap-2">
                                <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                                <h3 class="text-base font-semibold text-gray-800 dark:text-gray-200">Informasi Diri</h3>
                            </div>
                        </div>
                        
                        <div class="p-6">
                            @if(session('success'))
                                <div class="mb-4 p-3 bg-green-50 dark:bg-green-900/30 border-l-4 border-green-500 rounded-lg">
                                    <p class="text-green-600 dark:text-green-400 text-sm">{{ session('success') }}</p>
                                </div>
                            @endif

                            <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                                @csrf
                                @method('PATCH')
                                
                                <div class="space-y-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">Nama Lengkap</label>
                                        <input type="text" name="name" value="{{ old('name', Auth::user()->name) }}" 
                                            class="w-full px-4 py-2.5 bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:text-gray-200">
                                        @error('name')
                                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">Email</label>
                                        <input type="email" name="email" value="{{ old('email', Auth::user()->email) }}" 
                                            class="w-full px-4 py-2.5 bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:text-gray-200">
                                        @error('email')
                                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">Foto Profil</label>
                                        <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-200 dark:border-gray-600 border-dashed rounded-xl transition-colors cursor-pointer hover:border-blue-400" id="uploadArea">
                                            <div class="space-y-1 text-center">
                                                <input type="file" name="avatar" id="avatarInput" accept="image/*" class="hidden">
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
                                                    <img id="previewImage" class="mx-auto h-24 w-24 object-cover rounded-lg shadow">
                                                    <p id="imageName" class="mt-2 text-sm text-gray-600 dark:text-gray-400"></p>
                                                    <button type="button" id="removeImageBtn" class="mt-2 text-sm text-red-500 hover:text-red-700">Hapus</button>
                                                </div>
                                            </div>
                                        </div>
                                        @error('avatar')
                                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="mt-6">
                                    <button type="submit" class="w-full sm:w-auto bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2.5 px-6 rounded-xl transition shadow-sm">
                                        Simpan Perubahan
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Form Ganti Password -->
                    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-md border border-gray-100 dark:border-gray-700 overflow-hidden">
                        <div class="px-6 py-4 border-b border-gray-100 dark:border-gray-700 bg-gradient-to-r from-gray-50 to-white dark:from-gray-800 dark:to-gray-800">
                            <div class="flex items-center gap-2">
                                <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                </svg>
                                <h3 class="text-base font-semibold text-gray-800 dark:text-gray-200">Ganti Password</h3>
                            </div>
                        </div>
                        
                        <div class="p-6">
                            <form method="POST" action="{{ route('profile.password') }}">
                                @csrf
                                
                                <div class="space-y-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">Password Saat Ini</label>
                                        <input type="password" name="current_password" 
                                            class="w-full px-4 py-2.5 bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:text-gray-200">
                                        @error('current_password')
                                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">Password Baru</label>
                                        <input type="password" name="password" 
                                            class="w-full px-4 py-2.5 bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:text-gray-200">
                                        @error('password')
                                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">Konfirmasi Password Baru</label>
                                        <input type="password" name="password_confirmation" 
                                            class="w-full px-4 py-2.5 bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:text-gray-200">
                                    </div>
                                </div>
                                
                                <div class="mt-6">
                                    <button type="submit" class="w-full sm:w-auto bg-yellow-600 hover:bg-yellow-700 text-white font-semibold py-2.5 px-6 rounded-xl transition shadow-sm">
                                        Ganti Password
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

   <script>
    // Avatar upload preview
    const uploadArea = document.getElementById('uploadArea');
    const avatarInput = document.getElementById('avatarInput');
    const uploadPlaceholder = document.getElementById('uploadPlaceholder');
    const imagePreviewArea = document.getElementById('imagePreviewArea');
    const previewImage = document.getElementById('previewImage');
    const imageName = document.getElementById('imageName');
    const removeImageBtn = document.getElementById('removeImageBtn');
    
    if (uploadArea) {
        uploadArea.addEventListener('click', () => {
            avatarInput.click();
        });
        
        uploadArea.addEventListener('dragover', (e) => {
            e.preventDefault();
            uploadArea.classList.add('border-blue-500', 'bg-blue-50', 'dark:bg-blue-900/20');
        });
        
        uploadArea.addEventListener('dragleave', (e) => {
            e.preventDefault();
            uploadArea.classList.remove('border-blue-500', 'bg-blue-50', 'dark:bg-blue-900/20');
        });
        
        uploadArea.addEventListener('drop', (e) => {
            e.preventDefault();
            uploadArea.classList.remove('border-blue-500', 'bg-blue-50', 'dark:bg-blue-900/20');
            const file = e.dataTransfer.files[0];
            if (file && file.type.startsWith('image/')) {
                handleFile(file);
            } else {
                showErrorToast('❌ File harus gambar (JPG, PNG)');
            }
        });
        
        avatarInput.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                handleFile(file);
            }
        });
        
        function handleFile(file) {
            // Cek tipe file
            if (!file.type.startsWith('image/')) {
                showErrorToast('❌ File harus gambar (JPG, PNG)');
                avatarInput.value = '';
                return;
            }
            
            // Cek ukuran (max 2MB)
            if (file.size > 2 * 1024 * 1024) {
                showErrorToast('❌ Ukuran file maksimal 2MB');
                avatarInput.value = '';
                return;
            }
            
            const reader = new FileReader();
            reader.onload = function(e) {
                previewImage.src = e.target.result;
                imageName.textContent = file.name;
                uploadPlaceholder.classList.add('hidden');
                imagePreviewArea.classList.remove('hidden');
                showToast('✅ Gambar berhasil dipilih', 'Berhasil!');
            };
            reader.readAsDataURL(file);
        }
        
        if (removeImageBtn) {
            removeImageBtn.addEventListener('click', function() {
                avatarInput.value = '';
                uploadPlaceholder.classList.remove('hidden');
                imagePreviewArea.classList.add('hidden');
                showToast('🗑️ Gambar dihapus', 'Info');
            });
        }
    }
</script>
</x-app-layout>