<!-- Navigation -->
<nav class="bg-white shadow-lg fixed w-full z-50">
    <div class="container mx-auto px-6 py-3">
        <div class="flex justify-between items-center">
            <!-- Logo & Nama Desa -->
            <div class="flex items-center">
                <a href="{{ route('landing-page') }}" class="flex items-center">
                    <!-- Logo Desa (placeholder - ganti dengan logo asli) -->
                    <div class="bg-primary text-white p-2 rounded-lg mr-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-xl font-bold text-primary">Desa Cicangkang Hilir</h1>
                        <p class="text-xs text-gray-600">Kecamatan Cipongkor, Kabupaten Bandung Barat</p>
                    </div>
                </a>
            </div>
            
            <!-- Desktop Menu -->
            <div class="hidden md:flex items-center space-x-1">
                <!-- Beranda -->
                <a href="{{ route('landing-page') }}#home" class="px-4 py-2 text-gray-700 hover:text-primary font-medium {{ Request::route()->getName() == 'landing-page' ? 'text-primary' : '' }}">
                    Beranda
                </a>
                
                <!-- Profil Desa Dropdown -->
                <div class="relative" x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false">
                    <button @click="open = !open" class="flex items-center px-4 py-2 text-gray-700 hover:text-primary focus:outline-none">
                        Profil Desa
                        <svg :class="{'rotate-180': open}" class="w-4 h-4 ml-1 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                    
                    <!-- Dropdown Menu -->
                    <div x-show="open" x-transition:enter="transition ease-out duration-200" 
                         x-transition:enter-start="opacity-0 transform -translate-y-2" 
                         x-transition:enter-end="opacity-100 transform translate-y-0"
                         x-transition:leave="transition ease-in duration-150" 
                         x-transition:leave-start="opacity-100 transform translate-y-0" 
                         x-transition:leave-end="opacity-0 transform -translate-y-2"
                         class="absolute left-0 mt-2 w-56 bg-white rounded-md shadow-lg py-1 z-50 border border-gray-100"
                         @click.away="open = false">
                        <a href="{{ route('profil.visi-misi') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100 hover:text-primary transition-colors duration-150">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 mr-2 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                Visi & Misi Desa
                            </div>
                        </a>
                        <a href="{{ route('profil.sejarah') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100 hover:text-primary transition-colors duration-150">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 mr-2 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                Sejarah Desa
                            </div>
                        </a>
                        <a href="{{ route('profil.struktur') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100 hover:text-primary transition-colors duration-150">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 mr-2 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                                Struktur Pemerintahan
                            </div>
                        </a>
                    </div>
                </div>
                
                <!-- Layanan Dropdown -->
                <div class="relative" x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false">
                    <button @click="open = !open" class="flex items-center px-4 py-2 text-gray-700 hover:text-primary focus:outline-none">
                        Layanan
                        <svg :class="{'rotate-180': open}" class="w-4 h-4 ml-1 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                    
                    <!-- Dropdown Menu -->
                    <div x-show="open" x-transition:enter="transition ease-out duration-200" 
                         x-transition:enter-start="opacity-0 transform -translate-y-2" 
                         x-transition:enter-end="opacity-100 transform translate-y-0"
                         x-transition:leave="transition ease-in duration-150" 
                         x-transition:leave-start="opacity-100 transform translate-y-0" 
                         x-transition:leave-end="opacity-0 transform -translate-y-2"
                         class="absolute left-0 mt-2 w-64 bg-white rounded-md shadow-lg py-1 z-50 border border-gray-100"
                         @click.away="open = false">
                        <a href="{{ route('layanan.prosedur') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100 hover:text-primary transition-colors duration-150">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 mr-2 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                                Prosedur Layanan
                            </div>
                        </a>
                        <a href="{{ route('reports.create') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100 hover:text-primary transition-colors duration-150">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 mr-2 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                                Pengaduan Fasilitas Umum
                            </div>
                        </a>
                        <a href="{{ route('layanan.surat-online') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100 hover:text-primary transition-colors duration-150">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 mr-2 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                                Ajukan Surat Online
                            </div>
                        </a>
                    </div>
                </div>
                
                <!-- Link lain jika ada -->
                <a href="{{ route('landing-page') }}#berita" class="px-4 py-2 text-gray-700 hover:text-primary">
                    Berita Desa
                </a>
                <a href="{{ route('landing-page') }}#galeri" class="px-4 py-2 text-gray-700 hover:text-primary">
                    Galeri
                </a>
                <a href="{{ route('landing-page') }}#kontak" class="px-4 py-2 text-gray-700 hover:text-primary">
                    Kontak
                </a>
            </div>
            
            <!-- Button Masuk untuk Admin -->
            <div class="flex items-center space-x-4">
                @auth
                    <!-- Jika sudah login (admin) -->
                    <div class="relative" x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false">
                        <button @click="open = !open" class="flex items-center space-x-2 text-gray-700 hover:text-primary focus:outline-none">
                            <div class="w-8 h-8 bg-primary text-white rounded-full flex items-center justify-center">
                                {{ substr(Auth::user()->name, 0, 1) }}
                            </div>
                            <span class="hidden md:inline">{{ Auth::user()->name }}</span>
                            <svg :class="{'rotate-180': open}" class="w-4 h-4 hidden md:inline transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                        <div x-show="open" x-transition:enter="transition ease-out duration-200" 
                             x-transition:enter-start="opacity-0 transform -translate-y-2" 
                             x-transition:enter-end="opacity-100 transform translate-y-0"
                             x-transition:leave="transition ease-in duration-150" 
                             x-transition:leave-start="opacity-100 transform translate-y-0" 
                             x-transition:leave-end="opacity-0 transform -translate-y-2"
                             class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-50 border border-gray-100"
                             @click.away="open = false">
                            <a href="{{ route('home') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100 hover:text-primary transition-colors duration-150">Dashboard Admin</a>
                            <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100 hover:text-primary transition-colors duration-150">Profil Admin</a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="block w-full text-left px-4 py-2 text-gray-700 hover:bg-gray-100 hover:text-primary transition-colors duration-150">Keluar</button>
                            </form>
                        </div>
                    </div>
                @else
                    <!-- Jika belum login -->
                    <a href="{{ route('login') }}" class="bg-primary text-white px-6 py-2 rounded-lg hover:bg-secondary transition duration-300 shadow-md font-medium">
                        Masuk (Admin)
                    </a>
                @endguest
                
                <!-- Mobile Menu Toggle -->
                <button id="menu-btn" class="md:hidden">
                    <svg class="w-6 h-6 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>
        </div>
        
        <!-- Mobile Menu -->
        <div id="mobile-menu" class="hidden md:hidden mt-4 space-y-3 pb-4 border-t border-gray-200 pt-4">
            <a href="{{ route('landing-page') }}#home" class="block text-gray-700 hover:text-primary {{ Request::route()->getName() == 'landing-page' ? 'text-primary font-medium' : '' }}">
                Beranda
            </a>
            
            <!-- Profil Desa Mobile -->
            <div x-data="{ open: false }" class="pl-2">
                <button @click="open = !open" class="w-full text-left flex items-center justify-between font-medium text-gray-700 mb-2 focus:outline-none">
                    <span>Profil Desa</span>
                    <svg :class="{'rotate-180': open}" class="w-4 h-4 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </button>
                <div x-show="open" class="space-y-2 pl-4 border-l border-gray-200 mt-2">
                    <a href="{{ route('profil.visi-misi') }}" class="block text-gray-600 hover:text-primary py-1">
                        • Visi & Misi Desa
                    </a>
                    <a href="{{ route('profil.sejarah') }}" class="block text-gray-600 hover:text-primary py-1">
                        • Sejarah Desa
                    </a>
                    <a href="{{ route('profil.struktur') }}" class="block text-gray-600 hover:text-primary py-1">
                        • Struktur Pemerintahan
                    </a>
                </div>
            </div>
            
            <!-- Layanan Mobile -->
            <div x-data="{ open: false }" class="pl-2">
                <button @click="open = !open" class="w-full text-left flex items-center justify-between font-medium text-gray-700 mb-2 focus:outline-none">
                    <span>Layanan</span>
                    <svg :class="{'rotate-180': open}" class="w-4 h-4 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </button>
                <div x-show="open" class="space-y-2 pl-4 border-l border-gray-200 mt-2">
                    <a href="{{ route('layanan.prosedur') }}" class="block text-gray-600 hover:text-primary py-1">
                        • Prosedur Layanan
                    </a>
                    <a href="{{ route('reports.create') }}" class="block text-gray-600 hover:text-primary py-1">
                        • Pengaduan Kerusakan Fasilitas Umum
                    </a>
                    <a href="{{ route('layanan.surat-online') }}" class="block text-gray-600 hover:text-primary py-1">
                        • Ajukan Surat Online
                    </a>
                </div>
            </div>
            
            <!-- Menu lainnya Mobile -->
            <a href="{{ route('landing-page') }}#berita" class="block text-gray-700 hover:text-primary">
                Berita Desa
            </a>
            <a href="{{ route('landing-page') }}#galeri" class="block text-gray-700 hover:text-primary">
                Galeri
            </a>
            <a href="{{ route('landing-page') }}#kontak" class="block text-gray-700 hover:text-primary">
                Kontak
            </a>
            
            <!-- Auth Mobile -->
            @auth
                <div class="border-t border-gray-200 pt-3 mt-3">
                    <div class="font-medium text-gray-700 mb-2">Admin</div>
                    <a href="{{ route('home') }}" class="block text-gray-600 hover:text-primary pl-2">
                        • Dashboard
                    </a>
                    <a href="{{ route('profile.edit') }}" class="block text-gray-600 hover:text-primary pl-2">
                        • Profil
                    </a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="block w-full text-left text-gray-600 hover:text-primary pl-2 mt-2">
                            • Keluar
                        </button>
                    </form>
                </div>
            @else
                <div class="border-t border-gray-200 pt-3 mt-3">
                    <a href="{{ route('login') }}" class="block text-primary font-medium">
                        Masuk sebagai Admin
                    </a>
                </div>
            @endauth
        </div>
    </div>
</nav>

<!-- Tambahkan Alpine.js ke layout utama -->
<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

<script>
    // Mobile menu toggle (untuk toggle button saja)
    document.getElementById('menu-btn').addEventListener('click', function(e) {
        e.stopPropagation();
        const menu = document.getElementById('mobile-menu');
        menu.classList.toggle('hidden');
    });

    // Close mobile menu when clicking on a link (optional)
    document.querySelectorAll('#mobile-menu a').forEach(link => {
        link.addEventListener('click', function() {
            const menu = document.getElementById('mobile-menu');
            if (!menu.classList.contains('hidden')) {
                menu.classList.add('hidden');
            }
        });
    });

    // Smooth scrolling for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            const href = this.getAttribute('href');
            
            // Only handle internal anchor links
            if (href.startsWith('#') && href !== '#') {
                e.preventDefault();
                
                const targetId = href;
                const targetElement = document.querySelector(targetId);
                
                if (targetElement) {
                    // Close mobile menu if open
                    const mobileMenu = document.getElementById('mobile-menu');
                    if (mobileMenu && !mobileMenu.classList.contains('hidden')) {
                        mobileMenu.classList.add('hidden');
                    }
                    
                    window.scrollTo({
                        top: targetElement.offsetTop - 100,
                        behavior: 'smooth'
                    });
                }
            }
        });
    });
</script>