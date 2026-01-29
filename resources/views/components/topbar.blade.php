{{-- =========================================== --}}
{{-- TOPBAR COMPONENT --}}
{{-- =========================================== --}}
<header
    class="sticky top-0 z-30 bg-gradient-to-r from-[#16346A] to-[#16346A] backdrop-blur-sm border-b border-white/10 shadow-lg h-16">
    <div class="flex items-center justify-between h-full px-4">
        <!-- Left Section -->
        <div class="flex items-center space-x-4 flex-1">
            <!-- Mobile Menu Toggle -->
            <button id="sidebarToggle"
                class="lg:hidden text-white p-2 rounded-lg hover:bg-white/10 transition-colors">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
            <button id="collapseToggle"
                class="hidden lg:block text-white/70 hover:text-white rounded hover:bg-white/10 transition-colors p-2" style="margin-left: 2px;">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>

            <!-- Page Info -->
            <div class="min-w-0">
                <h1 class="text-lg md:text-xl font-semibold text-white truncate">
                    @yield('title', 'Dashboard Admin')
                </h1>
                @hasSection('subtitle')
                    <p class="text-sm text-white/80 truncate">
                        @yield('subtitle')
                    </p>
                @else
                    <p class="text-sm text-white/80 truncate">
                        Selamat datang, {{ auth()->user()->name ?? 'Admin' }}
                    </p>
                @endif
            </div>
        </div>

        <!-- Right Section -->
        <div class="flex items-center space-x-4">
            <!-- Search Bar (Desktop Only) -->
            <div class="hidden md:block relative">
                <div class="relative">
                    <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 w-5 h-5 text-white/70"
                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                    <input type="search" placeholder="Cari data..."
                        class="pl-10 pr-4 py-2 w-48 lg:w-64 rounded-lg bg-white/10 border border-white/20 text-white placeholder-white/70 focus:outline-none focus:ring-2 focus:ring-white/30 focus:border-transparent transition-all"
                        id="globalSearch">
                </div>
            </div>

            <!-- User Menu -->
            <div class="relative">
                <div class="flex items-center space-x-3">
                    <!-- User Info (Desktop Only) -->
                    <div class="hidden lg:block text-right">
                        <div class="text-sm font-medium text-white">
                            {{ auth()->user()->name ?? 'Administrator' }}
                        </div>
                        <div class="text-xs text-white/70">
                            {{ ucfirst(auth()->user()->role ?? 'admin') }}
                        </div>
                    </div>

                    <!-- User Avatar -->
                    <button id="userAvatar" class="focus:outline-none">
                        <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name ?? 'Admin') }}&background=3b82f6&color=fff&size=128"
                            alt="avatar"
                            class="w-10 h-10 rounded-full border-2 border-white/30 hover:border-white/50 transition-colors">
                    </button>
                </div>

                <!-- Dropdown Menu -->
                <div id="userDropdown"
                    class="absolute right-0 top-full mt-2 w-48 bg-white rounded-lg shadow-xl border border-gray-200 py-1 hidden z-50">
                    <a href=""
                        class="flex items-center space-x-3 px-4 py-3 text-gray-700 hover:bg-gray-100 transition-colors">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                        <span>Profil Saya</span>
                    </a>
                    <a href=""
                        class="flex items-center space-x-3 px-4 py-3 text-gray-700 hover:bg-gray-100 transition-colors">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        <span>Pengaturan Akun</span>
                    </a>
                    <div class="border-t border-gray-200 my-1"></div>
                    <button onclick="document.getElementById('logout-form').submit()"
                        class="flex items-center space-x-3 w-full px-4 py-3 text-red-600 hover:bg-red-50 transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                        </svg>
                        <span>Keluar</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</header>
{{-- =========================================== --}}
{{-- END TOPBAR --}}
{{-- =========================================== --}}