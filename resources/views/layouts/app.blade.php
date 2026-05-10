<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <script>
            // Dark mode - dijalankan segera (sebelum CSS apapun)
            (function() {
                if (localStorage.getItem('darkMode') === 'enabled') {
                    document.documentElement.classList.add('dark-mode');
                    document.body.classList.add('dark-mode');
                }
            })();
        </script>
        <style>
            [x-cloak] { display: none !important; }
        </style>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Meubel Semarang') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        
        <!-- Custom CSS (Dark Mode & Styles) -->
        <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
        
        <!-- Alpine.js untuk dropdown -->
        <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

        <!-- TailwindCSS CDN -->
        <script src="https://cdn.tailwindcss.com"></script>
        
        <!-- SweetAlert2 -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white shadow dark:bg-gray-800">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>

        <!-- Custom Confirm Modal -->
        <div id="confirmModal" class="fixed inset-0 bg-black/50 backdrop-blur-sm z-50 hidden items-center justify-center transition-all duration-300">
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-2xl max-w-md w-full mx-4 transform transition-all duration-300 scale-95 opacity-0" id="confirmModalContent">
                <div class="p-6">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="w-10 h-10 rounded-full bg-red-100 dark:bg-red-900/30 flex items-center justify-center">
                            <svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200" id="confirmModalTitle">Konfirmasi Hapus</h3>
                    </div>
                    <p class="text-gray-600 dark:text-gray-400 mb-6" id="confirmModalMessage">Apakah Anda yakin ingin menghapus data ini? Tindakan ini tidak dapat dibatalkan.</p>
                    <div class="flex gap-3">
                        <button id="confirmModalCancel" class="flex-1 px-4 py-2 bg-gray-100 hover:bg-gray-200 dark:bg-gray-700 dark:hover:bg-gray-600 text-gray-700 dark:text-gray-300 rounded-xl font-medium transition">Batal</button>
                        <button id="confirmModalOk" class="flex-1 px-4 py-2 bg-red-500 hover:bg-red-600 text-white rounded-xl font-medium transition">Hapus</button>
                    </div>
                </div>
            </div>
        </div>

        <script>
            // Custom confirm function
            window.customConfirm = function(message, title = 'Konfirmasi Hapus') {
                return new Promise((resolve) => {
                    const modal = document.getElementById('confirmModal');
                    const modalContent = document.getElementById('confirmModalContent');
                    const modalTitle = document.getElementById('confirmModalTitle');
                    const modalMessage = document.getElementById('confirmModalMessage');
                    const cancelBtn = document.getElementById('confirmModalCancel');
                    const okBtn = document.getElementById('confirmModalOk');
                    
                    modalTitle.textContent = title;
                    modalMessage.textContent = message;
                    
                    modal.classList.remove('hidden');
                    modal.classList.add('flex');
                    
                    setTimeout(() => {
                        modalContent.classList.remove('scale-95', 'opacity-0');
                        modalContent.classList.add('scale-100', 'opacity-100');
                    }, 10);
                    
                    const handleCancel = () => {
                        modalContent.classList.add('scale-95', 'opacity-0');
                        setTimeout(() => {
                            modal.classList.add('hidden');
                            modal.classList.remove('flex');
                        }, 200);
                        resolve(false);
                        cleanup();
                    };
                    
                    const handleOk = () => {
                        modalContent.classList.add('scale-95', 'opacity-0');
                        setTimeout(() => {
                            modal.classList.add('hidden');
                            modal.classList.remove('flex');
                        }, 200);
                        resolve(true);
                        cleanup();
                    };
                    
                    const cleanup = () => {
                        cancelBtn.removeEventListener('click', handleCancel);
                        okBtn.removeEventListener('click', handleOk);
                    };
                    
                    cancelBtn.addEventListener('click', handleCancel);
                    okBtn.addEventListener('click', handleOk);
                });
            };

            // SweetAlert untuk notifikasi success/error
            @if(session('success'))
                Swal.fire({
                    title: 'Berhasil!',
                    text: '{{ session('success') }}',
                    icon: 'success',
                    confirmButtonColor: '#2563eb',
                    confirmButtonText: 'OK',
                    timer: 3000,
                    timerProgressBar: true,
                    position: 'center',
                    showConfirmButton: true
                });
            @endif
            
            @if(session('error'))
                Swal.fire({
                    title: 'Gagal!',
                    text: '{{ session('error') }}',
                    icon: 'error',
                    confirmButtonColor: '#2563eb',
                    confirmButtonText: 'OK',
                    position: 'center'
                });
            @endif
        </script>
    </body>
</html>