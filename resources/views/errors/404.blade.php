<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - Halaman Tidak Ditemukan | Meubel Semarang</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * { font-family: 'Inter', sans-serif; }
        
        body {
            background: linear-gradient(270deg, #3e5de6, #8e2fec, #7b0289, #07559a, #016065, #2145e9);
            background-size: 400% 400%;
            animation: gradientBG 15s ease infinite;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1rem;
        }
        
        @keyframes gradientBG {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }
        
        .error-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 24px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
            overflow: hidden;
            max-width: 500px;
            width: 100%;
            text-align: center;
        }
        
        .btn-home {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            transition: all 0.3s ease;
        }
        
        .btn-home:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px -5px rgba(102, 126, 234, 0.4);
        }
        
        .animate-float {
            animation: float 3s ease-in-out infinite;
        }
        
        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
            100% { transform: translateY(0px); }
        }
    </style>
</head>
<body>
    <div class="w-full max-w-md">
        <!-- Error Card -->
        <div class="error-card">
            <div class="px-8 py-10" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                <div class="text-8xl mb-4 animate-float"></div>
                <div class="text-8xl font-bold text-white mb-2">404</div>
                <p class="text-indigo-200 text-lg">Oops! Halaman tidak ditemukan</p>
            </div>
            
            <div class="p-8">
                <div class="mb-6">
                    <p class="text-gray-600 mb-2">Maaf, halaman yang Anda cari tidak tersedia atau sedang dalam pengembangan.</p>
                    <p class="text-gray-400 text-sm">Mungkin Anda salah URL atau halaman sudah dipindahkan.</p>
                </div>
                
                <div class="space-y-3">
                    <a href="{{ url('/dashboard') }}" class="btn-home block text-white py-3 rounded-lg font-semibold">
                        ← Kembali ke Dashboard
                    </a>
                    
                    <a href="{{ url('/') }}" class="block text-purple-600 hover:text-purple-500 text-sm">
                        Kembali ke Halaman Utama
                    </a>
                </div>
                
                <div class="mt-6 pt-4 border-t border-gray-200">
                    <div class="flex justify-center gap-4 text-xs text-gray-400">
                        <span>Error 404</span>
                        <span>•</span>
                        <span>Page Not Found</span>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Footer di luar card (seperti halaman login) -->
        <div class="text-center mt-6">
            <p class="text-gray-400 text-sm">© {{ date('Y') }} Meubel Semarang Furniture Cabang Batang</p>
             <p class="text-gray-400 text-xs mt-1">All Rights Reserved</p>
        </div>
    </div>
</body>
</html>