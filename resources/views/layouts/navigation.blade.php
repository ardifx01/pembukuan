<style>
    /* Desktop */
    @media (min-width: 768px) {
        .desktop-nav { display: flex !important; }
        .mobile-hamburger { display: none !important; }
        .mobile-menu { display: none !important; }
    }
    
    /* Mobile */
    @media (max-width: 767px) {
        .desktop-nav { display: none !important; }
        .mobile-hamburger { display: flex !important; }
    }
    
    .mobile-menu.show { display: block !important; }
    .mobile-menu { display: none; }
</style>

<nav class="sticky-nav border-b border-gray-100 dark:border-gray-700 shadow-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-14">
            <!-- Logo -->
            <div class="flex items-center">
                <a href="{{ route('dashboard') }}" class="flex items-center gap-2 group">
                    <div class="w-8 h-8 rounded-lg bg-gradient-to-r from-blue-600 to-purple-600 flex items-center justify-center shadow-md">
                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                        </svg>
                    </div>
                    <span class="font-bold text-lg bg-gradient-to-r from-gray-800 to-gray-600 bg-clip-text text-transparent dark:from-blue-400 dark:to-purple-400">
                        Meubel Semarang
                    </span>
                </a>
            </div>

            <!-- Desktop Navigation -->
<div class="desktop-nav items-center space-x-1">
    <a href="{{ route('dashboard') }}" class="px-3 py-2 rounded-lg text-sm font-medium text-gray-600 dark:text-gray-300 hover:text-blue-600 dark:hover:text-white hover:bg-blue-50 dark:hover:bg-blue-600 transition">
        <div class="flex items-center gap-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
            </svg>
            Dashboard
        </div>
    </a>
    <a href="{{ route('furniture.index') }}" class="px-3 py-2 rounded-lg text-sm font-medium text-gray-600 dark:text-gray-300 hover:text-blue-600 dark:hover:text-white hover:bg-blue-50 dark:hover:bg-blue-600 transition">
        <div class="flex items-center gap-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
            </svg>
            Produk
        </div>
    </a>
    <a href="{{ route('categories.index') }}" class="px-3 py-2 rounded-lg text-sm font-medium text-gray-600 dark:text-gray-300 hover:text-blue-600 dark:hover:text-white hover:bg-blue-50 dark:hover:bg-blue-600 transition">
        <div class="flex items-center gap-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l5 5a2 2 0 01.586 1.414V19a2 2 0 01-2 2H7a2 2 0 01-2-2V5a2 2 0 012-2z"></path>
            </svg>
            Kategori
        </div>
    </a>
    <a href="{{ route('supplier.index') }}" class="px-3 py-2 rounded-lg text-sm font-medium text-gray-600 dark:text-gray-300 hover:text-blue-600 dark:hover:text-white hover:bg-blue-50 dark:hover:bg-blue-600 transition">
        <div class="flex items-center gap-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"></path>
            </svg>
            Supplier
        </div>
    </a>
    <a href="{{ route('transactions.index') }}" class="px-3 py-2 rounded-lg text-sm font-medium text-gray-600 dark:text-gray-300 hover:text-blue-600 dark:hover:text-white hover:bg-blue-50 dark:hover:bg-blue-600 transition">
        <div class="flex items-center gap-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
            </svg>
            Transaksi
        </div>
    </a>
    @if(auth()->user()->role == 'admin')
    <a href="{{ route('users.index') }}" class="px-3 py-2 rounded-lg text-sm font-medium text-gray-600 dark:text-gray-300 hover:text-blue-600 dark:hover:text-white hover:bg-blue-50 dark:hover:bg-blue-600 transition">
        <div class="flex items-center gap-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
            </svg>
            User
        </div>
    </a>
    <a href="{{ route('reports.financial') }}" class="px-3 py-2 rounded-lg text-sm font-medium text-gray-600 dark:text-gray-300 hover:text-blue-600 dark:hover:text-white hover:bg-blue-50 dark:hover:bg-blue-600 transition">
    <div class="flex items-center gap-2">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
        </svg>
        Laba/Rugi
    </div>
</a>
    @endif
</div>
            <!-- Desktop User Menu -->
            <div class="desktop-nav flex items-center space-x-2">
                <button id="darkModeToggle" class="p-2 rounded-lg text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-white hover:bg-gray-100 dark:hover:bg-gray-700 transition">
                    <svg id="sunIcon" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path>
                    </svg>
                    <svg id="moonIcon" class="w-5 h-5 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path>
                    </svg>
                </button>

                <div class="relative">
                    <button onclick="toggleDropdown()" class="flex items-center space-x-2 text-gray-700 dark:text-gray-300 hover:text-gray-900 focus:outline-none py-1.5 px-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition">
                        @if(Auth::user()->avatar && file_exists(public_path(Auth::user()->avatar)))
    <img src="{{ asset(Auth::user()->avatar) }}?t={{ time() }}" class="w-8 h-8 rounded-full object-cover border-2 border-white shadow-sm">
@else
    <div class="w-8 h-8 rounded-full bg-gradient-to-r from-blue-500 to-purple-600 flex items-center justify-center shadow-sm">
        <span class="text-xs font-bold text-white uppercase">{{ substr(Auth::user()->name, 0, 1) }}</span>
    </div>
@endif
                        <span class="text-sm font-medium hidden sm:inline-block">{{ Auth::user()->name }}</span>
                        <svg id="dropdownArrow" class="w-4 h-4 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                    
                    <div id="dropdownMenu" class="absolute right-0 mt-2 w-56 bg-white dark:bg-gray-800 rounded-xl shadow-lg border border-gray-100 dark:border-gray-700 z-50 overflow-hidden hidden">
                        <div class="px-4 py-3 border-b border-gray-100 dark:border-gray-700 bg-gray-50 dark:bg-gray-700">
                            <p class="text-sm font-medium text-gray-800 dark:text-gray-200">{{ Auth::user()->name }}</p>
                            <p class="text-xs text-gray-500 dark:text-gray-400">{{ Auth::user()->email }}</p>
                        </div>
                        <a href="{{ route('profile.edit') }}" class="flex items-center px-4 py-2.5 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 transition">Profil Saya</a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="flex items-center w-full text-left px-4 py-2.5 text-sm text-red-600 dark:text-red-400 hover:bg-gray-50 dark:hover:bg-gray-700 transition">Logout</button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Mobile Hamburger Button -->
            <div class="mobile-hamburger items-center space-x-2">
                <button id="darkModeToggleMobile" class="p-2 rounded-lg text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-white hover:bg-gray-100 dark:hover:bg-gray-700 transition">
                    <svg id="sunIconMobile" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path>
                    </svg>
                    <svg id="moonIconMobile" class="w-5 h-5 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path>
                    </svg>
                </button>
                <button onclick="toggleMobileMenu()" class="text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-white focus:outline-none p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>
        </div>
    </div>

<!-- Mobile Menu -->
<div id="mobileMenu" class="mobile-menu bg-white dark:bg-gray-800 border-t border-gray-100 dark:border-gray-700 shadow-lg">
    <div class="pt-2 pb-4 px-4 space-y-1">
        
        <!-- Dashboard -->
        <a href="{{ route('dashboard') }}" class="flex items-center gap-3 px-4 py-3 text-base font-medium text-gray-700 dark:text-gray-300 hover:text-blue-600 dark:hover:text-white hover:bg-gray-50 dark:hover:bg-gray-700 rounded-lg transition">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
            </svg>
            Dashboard
        </a>
        
        <!-- Produk -->
        <a href="{{ route('furniture.index') }}" class="flex items-center gap-3 px-4 py-3 text-base font-medium text-gray-700 dark:text-gray-300 hover:text-blue-600 dark:hover:text-white hover:bg-gray-50 dark:hover:bg-gray-700 rounded-lg transition">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
            </svg>
            Produk
        </a>
        
        <!-- Kategori -->
        <a href="{{ route('categories.index') }}" class="flex items-center gap-3 px-4 py-3 text-base font-medium text-gray-700 dark:text-gray-300 hover:text-blue-600 dark:hover:text-white hover:bg-gray-50 dark:hover:bg-gray-700 rounded-lg transition">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l5 5a2 2 0 01.586 1.414V19a2 2 0 01-2 2H7a2 2 0 01-2-2V5a2 2 0 012-2z"></path>
            </svg>
            Kategori
        </a>
        
        <!-- Supplier -->
        <a href="{{ route('supplier.index') }}" class="flex items-center gap-3 px-4 py-3 text-base font-medium text-gray-700 dark:text-gray-300 hover:text-blue-600 dark:hover:text-white hover:bg-gray-50 dark:hover:bg-gray-700 rounded-lg transition">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"></path>
            </svg>
            Supplier
        </a>
        
        <!-- Transaksi -->
        <a href="{{ route('transactions.index') }}" class="flex items-center gap-3 px-4 py-3 text-base font-medium text-gray-700 dark:text-gray-300 hover:text-blue-600 dark:hover:text-white hover:bg-gray-50 dark:hover:bg-gray-700 rounded-lg transition">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
            </svg>
            Transaksi
        </a>
        
        <!-- Laba/Rugi -->
        <a href="{{ route('reports.financial') }}" class="flex items-center gap-3 px-4 py-3 text-base font-medium text-gray-700 dark:text-gray-300 hover:text-blue-600 dark:hover:text-white hover:bg-gray-50 dark:hover:bg-gray-700 rounded-lg transition">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
            </svg>
            Laba/Rugi
        </a>
            @if(auth()->user()->role == 'admin')
            <a href="{{ route('users.index') }}" class="flex items-center gap-3 px-4 py-3 text-base font-medium text-gray-700 dark:text-gray-300 hover:text-blue-600 dark:hover:text-white hover:bg-gray-50 dark:hover:bg-gray-700 rounded-lg transition">User</a>
            @endif
            <div class="border-t border-gray-100 dark:border-gray-700 my-3"></div>
            <div class="flex items-center px-4 py-3 bg-gray-50 dark:bg-gray-700 rounded-lg">
                @if(Auth::user()->avatar && file_exists(public_path(Auth::user()->avatar)))
                    <img src="{{ asset(Auth::user()->avatar) }}" class="w-10 h-10 rounded-full object-cover">
                @else
                    <div class="w-10 h-10rounded-full bg-gradient-to-r from-blue-500 to-purple-600 flex items-center justify-center">
                        <span class="text-sm font-bold text-white uppercase">{{ substr(Auth::user()->name, 0, 1) }}</span>
                    </div>
                @endif
                <div class="ml-3">
                    <div class="text-sm font-medium text-gray-800 dark:text-gray-200">{{ Auth::user()->name }}</div>
                    <div class="text-xs text-gray-500 dark:text-gray-400">{{ Auth::user()->email }}</div>
                </div>
            </div>
            <a href="{{ route('profile.edit') }}" class="block px-4 py-3 text-base font-medium text-gray-700 dark:text-gray-300 hover:text-blue-600 dark:hover:text-white hover:bg-gray-50 dark:hover:bg-gray-700 rounded-lg transition">Profil Saya</a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="block w-full text-left px-4 py-3 text-base font-medium text-red-600 dark:text-red-400 hover:text-red-700 dark:hover:text-red-300 hover:bg-gray-50 dark:hover:bg-gray-700 rounded-lg transition">Logout</button>
            </form>
        </div>
    </div>
</nav>

<script>
    // Toggle Dropdown
    function toggleDropdown() {
        const menu = document.getElementById('dropdownMenu');
        const arrow = document.getElementById('dropdownArrow');
        if (menu.classList.contains('hidden')) {
            menu.classList.remove('hidden');
            arrow.classList.add('rotate-180');
        } else {
            menu.classList.add('hidden');
            arrow.classList.remove('rotate-180');
        }
    }
    
    // Toggle Mobile Menu
    function toggleMobileMenu() {
        const menu = document.getElementById('mobileMenu');
        menu.classList.toggle('show');
    }
    
    // Close dropdown when clicking outside
    document.addEventListener('click', function(event) {
        const dropdown = document.querySelector('.relative');
        if (dropdown && !dropdown.contains(event.target)) {
            const menu = document.getElementById('dropdownMenu');
            const arrow = document.getElementById('dropdownArrow');
            if (menu && !menu.classList.contains('hidden')) {
                menu.classList.add('hidden');
                arrow.classList.remove('rotate-180');
            }
        }
    });
    
    // Dark Mode Toggle
    function initDarkMode() {
        const sunIcon = document.getElementById('sunIcon');
        const moonIcon = document.getElementById('moonIcon');
        const sunIconMobile = document.getElementById('sunIconMobile');
        const moonIconMobile = document.getElementById('moonIconMobile');
        const darkModeToggle = document.getElementById('darkModeToggle');
        const darkModeToggleMobile = document.getElementById('darkModeToggleMobile');
        
        if (localStorage.getItem('darkMode') === 'enabled') {
            document.body.classList.add('dark-mode');
            if (sunIcon) sunIcon.style.display = 'none';
            if (moonIcon) moonIcon.style.display = 'block';
            if (sunIconMobile) sunIconMobile.style.display = 'none';
            if (moonIconMobile) moonIconMobile.style.display = 'block';
        }
        
        function toggleDarkMode() {document.body.classList.toggle('dark-mode');
            if (document.body.classList.contains('dark-mode')) {
                localStorage.setItem('darkMode', 'enabled');
                if (sunIcon) sunIcon.style.display = 'none';
                if (moonIcon) moonIcon.style.display = 'block';
                if (sunIconMobile) sunIconMobile.style.display = 'none';
                if (moonIconMobile) moonIconMobile.style.display = 'block';
            } else {
                localStorage.setItem('darkMode', 'disabled');
                if (sunIcon) sunIcon.style.display = 'block';
                if (moonIcon) moonIcon.style.display = 'none';
                if (sunIconMobile) sunIconMobile.style.display = 'block';
                if (moonIconMobile) moonIconMobile.style.display = 'none';
            }
        }
        
        if (darkModeToggle) darkModeToggle.addEventListener('click', toggleDarkMode);
        if (darkModeToggleMobile) darkModeToggleMobile.addEventListener('click', toggleDarkMode);
    }
    
    document.addEventListener('DOMContentLoaded', initDarkMode);
</script>