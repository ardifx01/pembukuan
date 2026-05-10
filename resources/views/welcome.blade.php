<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aplikasi Pembukuan Mebel</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
        * { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-gray-100">
    <div class="min-h-screen flex items-center justify-center">
        <div class="bg-white rounded-2xl shadow-xl p-8 max-w-md w-full mx-4">
            <div class="text-center mb-8">
                <div class="text-5xl mb-3">🪑</div>
                <h1 class="text-2xl font-bold text-gray-800">Aplikasi Pembukuan Mebel</h1>
                <p class="text-gray-500 mt-2">Kelola bisnis mebel Anda dengan mudah</p>
            </div>
            
            <div class="space-y-4">
                <a href="{{ route('login') }}" class="block w-full bg-blue-600 hover:bg-blue-700 text-white text-center py-3 rounded-lg font-medium transition">
                    Login ke Akun
                </a>
            </div>
            
            <div class="mt-8 pt-6 border-t border-gray-200 text-center text-sm text-gray-400">
                <p>© 2026 - Aplikasi Pembukuan Mebel Internal</p>
            </div>
        </div>
    </div>
</body>
</html>