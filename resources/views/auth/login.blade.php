<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login - Aplikasi Pembukuan Mebel</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        * { font-family: 'Inter', sans-serif; }
        
        /* Animated Gradient Background */
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
        
        /* Card dengan efek glassmorphism */
        .login-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 24px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
            overflow: hidden;
        }
        
        /* Input group animation */
        .input-group {
            transition: all 0.3s ease;
        }
        .input-group:focus-within {
            transform: translateX(5px);
        }
        
        input:focus {
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.2);
        }
        
        /* Button with gradient */
        .btn-login {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }
        
        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px -5px rgba(102, 126, 234, 0.4);
        }
        
        .btn-login::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
            transition: left 0.5s ease;
        }
        
        .btn-login:hover::before {
            left: 100%;
        }
    </style>
</head>
<body>
    <div class="w-full max-w-md">
        <!-- Card Login -->
        <div class="login-card">
            <!-- Header -->
            <div class="px-8 py-8 text-center" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                <div class="text-5xl mb-3 animate-bounce"></div>
                <h2 class="text-2xl font-bold text-white">Aplikasi Pembukuan Meubel</h2>
                <p class="text-indigo-200 text-sm mt-2">Login untuk melanjutkan</p>
            </div>
            
            <!-- Form -->
            <div class="p-8">
                @if ($errors->any())
                    <div class="mb-4 p-3 bg-red-50 border-l-4 border-red-500 rounded">
                        <div class="text-red-600 text-sm">
                            {{ $errors->first() }}
                        </div>
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    
                    <div class="mb-5">
                        <label class="block text-gray-700 text-sm font-semibold mb-2">Email Address</label>
                        <div class="input-group">
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"></path>
                                    </svg>
                                </div>
                                <input type="email" name="email" value="{{ old('email') }}" required autofocus
                                    class="w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition"
                                    placeholder="Silahkan masukkan email">
                            </div>
                        </div>
                    </div>
                    
                    <div class="mb-5">
                        <label class="block text-gray-700 text-sm font-semibold mb-2">Password</label>
                        <div class="input-group">
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                    </svg>
                                </div>
                                <input type="password" name="password" required
                                    class="w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition"
                                    placeholder="Silahkan masukkan password">
                            </div>
                        </div>
                    </div>
                    
                    <div class="flex items-center justify-between mb-6">
                        <label class="flex items-center">
                            <input type="checkbox" name="remember" class="h-4 w-4 text-purple-600 focus:ring-purple-500 border-gray-300 rounded">
                            <span class="ml-2 text-sm text-gray-600">Remember me</span>
                        </label>
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="text-sm text-purple-600 hover:text-purple-500">
                                Forgot password?
                            </a>
                        @endif
                    </div>
                    
                    <button type="submit" class="btn-login w-full text-white py-3 rounded-lg font-semibold text-lg">
                        Login
                    </button>
                </form>
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
</body>
</html>