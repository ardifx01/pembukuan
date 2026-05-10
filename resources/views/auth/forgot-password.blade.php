<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Lupa Password - Meubel Semarang</title>
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
        
        .forgot-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 24px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
            overflow: hidden;
        }
        
        .btn-submit {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            transition: all 0.3s ease;
        }
        
        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px -5px rgba(102, 126, 234, 0.4);
        }
        
        input:focus {
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.2);
        }
    </style>
</head>
<body>
    <div class="w-full max-w-md">
        <div class="forgot-card">
            <div class="px-8 py-8 text-center" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                <div class="text-5xl mb-3">🔐</div>
                <h2 class="text-2xl font-bold text-white">Lupa Password?</h2>
                <p class="text-indigo-200 text-sm mt-2">Tenang, kami akan kirimkan link reset password</p>
            </div>
            
            <div class="p-8">
                @if (session('status'))
                    <div class="mb-4 p-3 bg-green-50 border-l-4 border-green-500 rounded">
                        <div class="text-green-600 text-sm">
                            {{ session('status') }}
                        </div>
                    </div>
                @endif

                @if ($errors->any())
                    <div class="mb-4 p-3 bg-red-50 border-l-4 border-red-500 rounded">
                        <div class="text-red-600 text-sm">
                            {{ $errors->first() }}
                        </div>
                    </div>
                @endif

                <form method="POST" action="{{ route('password.email') }}">
                    @csrf
                    
                    <div class="mb-6">
                        <label class="block text-gray-700 text-sm font-semibold mb-2">Email Address</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"></path>
                                </svg>
                            </div>
                            <input type="email" name="email" value="{{ old('email') }}" required autofocus
                                class="w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                                placeholder="Masukkan email Anda">
                        </div>
                        <p class="text-xs text-gray-500 mt-2">
                            Kami akan mengirimkan link reset password ke email Anda
                        </p>
                    </div>
                    
                    <button type="submit" class="btn-submit w-full text-white py-3 rounded-lg font-semibold text-lg">
                        Kirim Link Reset Password
                    </button>
                </form>
                
                <div class="mt-6 text-center">
                    <a href="{{ route('login') }}" class="text-sm text-purple-600 hover:text-purple-500">
                        ← Kembali ke Login
                    </a>
                </div>
            </div>
        </div>
        
        <!-- Footer -->
<div class="text-center mt-6">
    <p class="text-gray-300 text-sm font-medium tracking-wide">
        © {{ date('Y') }} Meubel Semarang Furniture Cabang Batang
    </p>
    <p class="text-gray-400 text-xs mt-1">All Rights Reserved</p>
</div>
    </div>
    </div>
</body>
</html>