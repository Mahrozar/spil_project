<!-- Navigation -->
<nav class="bg-white/95 backdrop-blur-sm shadow-lg fixed w-full z-50 border-b border-gray-100">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <!-- Logo & Nama Desa -->
            <div class="flex items-center">
                <a href="{{ auth()->check() ? route('admin.dashboard') : route('landing-page') }}" class="flex items-center space-x-3">
                    <!-- Logo Desa -->
                    <div class="bg-primary text-white p-2 rounded-lg">
                        <i class="fas fa-home text-xl"></i>
                    </div>
                    <div>
                        <h1 class="text-lg font-bold text-primary leading-tight">Desa Cicangkang Hilir</h1>
                        <p class="text-xs text-gray-600 leading-tight">Kecamatan Cipongkor, Kabupaten Bandung Barat</p>
                    </div>
                </a>
            </div>
            
            <!-- Desktop Menu -->
            <div class="hidden lg:flex items-center space-x-1">
                <!-- Beranda -->
                <a href="{{ auth()->check() ? route('admin.dashboard') : route('landing-page').'#home' }}" 
                   class="px-4 py-2 text-gray-700 hover:text-primary font-medium rounded-lg transition-colors duration-200 
                          {{ Request::route()->getName() == 'landing-page' ? 'text-primary bg-primary/5' : '' }}">
                    <i class="fas fa-home mr-2"></i>Beranda
                </a>
                
                <!-- Profil Desa Dropdown -->
                <div class="relative" x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false">
                    <button @click="open = !open" 
                            class="flex items-center px-4 py-2 text-gray-700 hover:text-primary rounded-lg transition-colors duration-200 focus:outline-none">
                        <i class="fas fa-info-circle mr-2"></i>Profil Desa
                        <i :class="{'rotate-180': open}" class="fas fa-chevron-down ml-1 text-xs transition-transform duration-200"></i>
                    </button>
                    
                    <!-- Dropdown Menu -->
                    <div x-show="open" x-transition:enter="transition ease-out duration-200" 
                         x-transition:enter-start="opacity-0 transform -translate-y-2" 
                         x-transition:enter-end="opacity-100 transform translate-y-0"
                         x-transition:leave="transition ease-in duration-150" 
                         x-transition:leave-start="opacity-100 transform translate-y-0" 
                         x-transition:leave-end="opacity-0 transform -translate-y-2"
                         class="absolute left-0 mt-2 w-56 bg-white rounded-lg shadow-xl py-2 z-50 border border-gray-100 animate-slide-down"
                         @click.away="open = false">
                        <a href="{{ route('profil.visi-misi') }}" 
                           class="flex items-center px-4 py-3 text-gray-700 hover:bg-primary-light hover:text-primary transition-colors duration-150 mx-2 rounded-md">
                            <i class="fas fa-bullseye text-primary mr-3"></i>
                            <span>Visi & Misi Desa</span>
                        </a>
                        <a href="{{ route('profil.sejarah') }}" 
                           class="flex items-center px-4 py-3 text-gray-700 hover:bg-primary-light hover:text-primary transition-colors duration-150 mx-2 rounded-md">
                            <i class="fas fa-history text-primary mr-3"></i>
                            <span>Sejarah Desa</span>
                        </a>
                        <a href="{{ route('profil.gambaran') }}" 
                           class="flex items-center px-4 py-3 text-gray-700 hover:bg-primary-light hover:text-primary transition-colors duration-150 mx-2 rounded-md">
                            <i class="fas fa-map text-primary mr-3"></i>
                            <span>Gambaran Umum Desa</span>
                        </a>
                        <a href="{{ route('profil.struktur') }}" 
                           class="flex items-center px-4 py-3 text-gray-700 hover:bg-primary-light hover:text-primary transition-colors duration-150 mx-2 rounded-md">
                            <i class="fas fa-sitemap text-primary mr-3"></i>
                            <span>Struktur Pemerintahan</span>
                        </a>
                    </div>
                </div>
                
                <!-- Layanan Dropdown -->
                <div class="relative" x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false">
                    <button @click="open = !open" 
                            class="flex items-center px-4 py-2 text-gray-700 hover:text-primary rounded-lg transition-colors duration-200 focus:outline-none">
                        <i class="fas fa-hands-helping mr-2"></i>Layanan
                        <i :class="{'rotate-180': open}" class="fas fa-chevron-down ml-1 text-xs transition-transform duration-200"></i>
                    </button>
                    
                    <!-- Dropdown Menu -->
                    <div x-show="open" x-transition:enter="transition ease-out duration-200" 
                         x-transition:enter-start="opacity-0 transform -translate-y-2" 
                         x-transition:enter-end="opacity-100 transform translate-y-0"
                         x-transition:leave="transition ease-in duration-150" 
                         x-transition:leave-start="opacity-100 transform translate-y-0" 
                         x-transition:leave-end="opacity-0 transform -translate-y-2"
                         class="absolute left-0 mt-2 w-64 bg-white rounded-lg shadow-xl py-2 z-50 border border-gray-100 animate-slide-down"
                         @click.away="open = false">
                        <a href="{{ route('layanan.prosedur') }}" 
                           class="flex items-center px-4 py-3 text-gray-700 hover:bg-primary-light hover:text-primary transition-colors duration-150 mx-2 rounded-md">
                            <i class="fas fa-clipboard-list text-accent mr-3"></i>
                            <span>Prosedur Layanan</span>
                        </a>
                        <a href="{{ route('reports.create') }}" 
                           class="flex items-center px-4 py-3 text-gray-700 hover:bg-primary-light hover:text-primary transition-colors duration-150 mx-2 rounded-md">
                            <i class="fas fa-flag text-accent mr-3"></i>
                            <span>Pengaduan Fasilitas Umum</span>
                        </a>
                        <a href="{{ route('layanan.surat-online') }}" 
                           class="flex items-center px-4 py-3 text-gray-700 hover:bg-primary-light hover:text-primary transition-colors duration-150 mx-2 rounded-md">
                            <i class="fas fa-file-alt text-accent mr-3"></i>
                            <span>Ajukan Surat Online</span>
                        </a>
                    </div>
                </div>
                
                <!-- Link lainnya -->
                <a href="{{ route('landing-page') }}#berita" 
                   class="px-4 py-2 text-gray-700 hover:text-primary rounded-lg transition-colors duration-200">
                    <i class="fas fa-newspaper mr-2"></i>Berita Desa
                </a>
                <a href="{{ route('landing-page') }}#galeri" 
                   class="px-4 py-2 text-gray-700 hover:text-primary rounded-lg transition-colors duration-200">
                    <i class="fas fa-images mr-2"></i>Galeri
                </a>
                <a href="{{ route('landing-page') }}#kontak" 
                   class="px-4 py-2 text-gray-700 hover:text-primary rounded-lg transition-colors duration-200">
                    <i class="fas fa-phone-alt mr-2"></i>Kontak
                </a>
            </div>
            
            <!-- User Menu & Mobile Toggle -->
            <div class="flex items-center space-x-4">
                @auth
                    <!-- Jika sudah login (admin) -->
                    <div class="relative" x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false">
                        <button @click="open = !open" 
                                class="flex items-center space-x-2 text-gray-700 hover:text-primary focus:outline-none">
                            <div class="w-8 h-8 bg-primary text-white rounded-full flex items-center justify-center font-semibold">
                                {{ substr(Auth::user()->name, 0, 1) }}
                            </div>
                            <span class="hidden lg:inline font-medium">{{ Auth::user()->name }}</span>
                            <i :class="{'rotate-180': open}" class="fas fa-chevron-down hidden lg:inline text-xs transition-transform duration-200"></i>
                        </button>
                        <div x-show="open" x-transition:enter="transition ease-out duration-200" 
                             x-transition:enter-start="opacity-0 transform -translate-y-2" 
                             x-transition:enter-end="opacity-100 transform translate-y-0"
                             x-transition:leave="transition ease-in duration-150" 
                             x-transition:leave-start="opacity-100 transform translate-y-0" 
                             x-transition:leave-end="opacity-0 transform -translate-y-2"
                             class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-xl py-2 z-50 border border-gray-100 animate-slide-down"
                             @click.away="open = false">
                            <a href="{{ route('admin.dashboard') }}" 
                               class="flex items-center px-4 py-3 text-gray-700 hover:bg-primary-light hover:text-primary transition-colors duration-150 mx-2 rounded-md">
                                <i class="fas fa-tachometer-alt mr-3"></i>
                                <span>Dashboard Admin</span>
                            </a>
                            <a href="{{ route('profile.edit') }}" 
                               class="flex items-center px-4 py-3 text-gray-700 hover:bg-primary-light hover:text-primary transition-colors duration-150 mx-2 rounded-md">
                                <i class="fas fa-user-cog mr-3"></i>
                                <span>Profil Admin</span>
                            </a>
                            <div class="border-t border-gray-100 my-2"></div>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" 
                                        class="flex items-center w-full text-left px-4 py-3 text-gray-700 hover:bg-red-50 hover:text-red-600 transition-colors duration-150 mx-2 rounded-md">
                                    <i class="fas fa-sign-out-alt mr-3"></i>
                                    <span>Keluar</span>
                                </button>
                            </form>
                        </div>
                    </div>
                @else
                    <!-- Jika belum login -->
                    <a href="{{ route('login') }}" 
                       class="bg-primary text-white px-6 py-2 rounded-lg hover:bg-secondary transition duration-300 shadow-md font-medium hidden lg:inline-flex items-center">
                        <i class="fas fa-sign-in-alt mr-2"></i>Masuk Admin
                    </a>
                @endauth
                
                <!-- Mobile Menu Toggle -->
                <button id="menu-btn" class="lg:hidden text-gray-700 hover:text-primary p-2 rounded-lg transition-colors duration-200">
                    <i class="fas fa-bars text-xl"></i>
                </button>
            </div>
        </div>
        
        <!-- Mobile Menu -->
        <div id="mobile-menu" class="lg:hidden hidden mt-2 space-y-1 pb-4 border-t border-gray-100 pt-4">
            <!-- Beranda Mobile -->
            <a href="{{ auth()->check() ? route('admin.dashboard') : route('landing-page').'#home' }}" 
               class="flex items-center px-4 py-3 text-gray-700 hover:bg-primary-light hover:text-primary rounded-lg transition-colors duration-200 {{ Request::route()->getName() == 'landing-page' ? 'text-primary bg-primary/5' : '' }}">
                <i class="fas fa-home mr-3 text-lg"></i>
                <span class="font-medium">Beranda</span>
            </a>
            
            <!-- Profil Desa Mobile -->
            <div x-data="{ open: false }" class="px-4">
                <button @click="open = !open" 
                        class="w-full flex items-center justify-between text-gray-700 hover:text-primary py-3 focus:outline-none">
                    <div class="flex items-center">
                        <i class="fas fa-info-circle mr-3 text-lg"></i>
                        <span class="font-medium">Profil Desa</span>
                    </div>
                    <i :class="{'rotate-180': open}" class="fas fa-chevron-down text-xs transition-transform duration-200"></i>
                </button>
                <div x-show="open" x-collapse class="space-y-2 pl-8 mt-2 border-l-2 border-gray-100">
                    <a href="{{ route('profil.visi-misi') }}" 
                       class="flex items-center py-2 text-gray-600 hover:text-primary transition-colors duration-150">
                        <i class="fas fa-bullseye mr-3 text-sm"></i>
                        <span>Visi & Misi Desa</span>
                    </a>
                    <a href="{{ route('profil.sejarah') }}" 
                       class="flex items-center py-2 text-gray-600 hover:text-primary transition-colors duration-150">
                        <i class="fas fa-history mr-3 text-sm"></i>
                        <span>Sejarah Desa</span>
                    </a>
                    <a href="{{ route('profil.gambaran') }}" 
                       class="flex items-center py-2 text-gray-600 hover:text-primary transition-colors duration-150">
                        <i class="fas fa-map mr-3 text-sm"></i>
                        <span>Gambaran Umum Desa</span>
                    </a>
                    <a href="{{ route('profil.struktur') }}" 
                       class="flex items-center py-2 text-gray-600 hover:text-primary transition-colors duration-150">
                        <i class="fas fa-sitemap mr-3 text-sm"></i>
                        <span>Struktur Pemerintahan</span>
                    </a>
                </div>
            </div>
            
            <!-- Layanan Mobile -->
            <div x-data="{ open: false }" class="px-4">
                <button @click="open = !open" 
                        class="w-full flex items-center justify-between text-gray-700 hover:text-primary py-3 focus:outline-none">
                    <div class="flex items-center">
                        <i class="fas fa-hands-helping mr-3 text-lg"></i>
                        <span class="font-medium">Layanan</span>
                    </div>
                    <i :class="{'rotate-180': open}" class="fas fa-chevron-down text-xs transition-transform duration-200"></i>
                </button>
                <div x-show="open" x-collapse class="space-y-2 pl-8 mt-2 border-l-2 border-gray-100">
                    <a href="{{ route('layanan.prosedur') }}" 
                       class="flex items-center py-2 text-gray-600 hover:text-primary transition-colors duration-150">
                        <i class="fas fa-clipboard-list mr-3 text-sm"></i>
                        <span>Prosedur Layanan</span>
                    </a>
                    <a href="{{ route('reports.create') }}" 
                       class="flex items-center py-2 text-gray-600 hover:text-primary transition-colors duration-150">
                        <i class="fas fa-flag mr-3 text-sm"></i>
                        <span>Pengaduan Fasilitas</span>
                    </a>
                    <a href="{{ route('layanan.surat-online') }}" 
                       class="flex items-center py-2 text-gray-600 hover:text-primary transition-colors duration-150">
                        <i class="fas fa-file-alt mr-3 text-sm"></i>
                        <span>Ajukan Surat Online</span>
                    </a>
                </div>
            </div>
            
            <!-- Menu lainnya Mobile -->
            <a href="{{ route('landing-page') }}#berita" 
               class="flex items-center px-4 py-3 text-gray-700 hover:bg-primary-light hover:text-primary rounded-lg transition-colors duration-200">
                <i class="fas fa-newspaper mr-3 text-lg"></i>
                <span class="font-medium">Berita Desa</span>
            </a>
            <a href="{{ route('landing-page') }}#galeri" 
               class="flex items-center px-4 py-3 text-gray-700 hover:bg-primary-light hover:text-primary rounded-lg transition-colors duration-200">
                <i class="fas fa-images mr-3 text-lg"></i>
                <span class="font-medium">Galeri</span>
            </a>
            <a href="{{ route('landing-page') }}#kontak" 
               class="flex items-center px-4 py-3 text-gray-700 hover:bg-primary-light hover:text-primary rounded-lg transition-colors duration-200">
                <i class="fas fa-phone-alt mr-3 text-lg"></i>
                <span class="font-medium">Kontak</span>
            </a>
            
            <!-- Auth Mobile -->
            @auth
                <div class="border-t border-gray-100 pt-3 mt-3">
                    <div class="px-4 py-2 text-gray-500 text-sm font-semibold uppercase tracking-wider">Admin</div>
                    <a href="{{ route('admin.dashboard') }}" 
                       class="flex items-center px-4 py-3 text-gray-700 hover:bg-primary-light hover:text-primary rounded-lg transition-colors duration-200">
                        <i class="fas fa-tachometer-alt mr-3"></i>
                        <span>Dashboard</span>
                    </a>
                    <a href="{{ route('profile.edit') }}" 
                       class="flex items-center px-4 py-3 text-gray-700 hover:bg-primary-light hover:text-primary rounded-lg transition-colors duration-200">
                        <i class="fas fa-user-cog mr-3"></i>
                        <span>Profil</span>
                    </a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" 
                                class="flex items-center w-full text-left px-4 py-3 text-gray-700 hover:bg-red-50 hover:text-red-600 rounded-lg transition-colors duration-200">
                            <i class="fas fa-sign-out-alt mr-3"></i>
                            <span>Keluar</span>
                        </button>
                    </form>
                </div>
            @else
                <div class="border-t border-gray-100 pt-3 mt-3">
                    <a href="{{ route('login') }}" 
                       class="flex items-center justify-center bg-primary text-white px-6 py-3 rounded-lg hover:bg-secondary transition duration-300 shadow-md font-medium">
                        <i class="fas fa-sign-in-alt mr-2"></i>Masuk sebagai Admin
                    </a>
                </div>
            @endauth
        </div>
    </div>
</nav>