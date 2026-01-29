{{-- =========================================== --}}
{{-- SIDEBAR COMPONENT --}}
{{-- =========================================== --}}
<aside id="sidebar"
    class="flex flex-col bg-[#16346A] text-white transition-all duration-300 ease-in-out transform -translate-x-full lg:translate-x-0 lg:w-64 w-64 shadow-xl z-40 sticky top-16 h-[calc(100vh-4rem)] overflow-visible">

    {{-- Navigation Container with Scroll --}}
    <div class="flex-1 sidebar-scrollbar p-4 space-y-1 overflow-visible">
        <!-- Dashboard -->
        <div class="mb-4 tooltip-container">
            <a href="{{ route('admin.dashboard') }}"
                class="flex items-center space-x-3 px-3 py-2.5 rounded-lg hover:bg-white/10 transition-colors {{ request()->routeIs('admin.dashboard') ? 'bg-white/15 border-l-4 border-[#06b6d4]' : '' }}">
                <i class="fas fa-tachometer-alt w-5 h-5 flex-shrink-0 text-center"></i>
                <span
                    class="whitespace-nowrap overflow-hidden transition-all duration-300 lg:opacity-100 lg:w-auto lg:block hidden opacity-0 w-0">
                    Dashboard
                </span>
            </a>
            <!-- Tooltip untuk Dashboard -->
            <div class="tooltip">
                Dashboard
            </div>
        </div>

        <!-- Data Kependudukan Section -->
        <div class="mb-4">
            <div class="section-tooltip-container">
                <h3
                    class="px-3 mb-2 text-xs font-semibold text-white/60 uppercase tracking-wider lg:opacity-100 lg:block hidden opacity-0 h-0 overflow-hidden transition-all duration-300">
                    Data Kependudukan
                </h3>
                <!-- Tooltip untuk Section Header -->
                <div class="tooltip section-tooltip">
                    Data Kependudukan
                </div>
            </div>

            <div class="tooltip-container">
                <a href="{{ route('admin.residents.index') }}"
                    class="flex items-center space-x-3 px-3 py-2.5 rounded-lg hover:bg-white/10 transition-colors {{ request()->routeIs('admin.residents.*') ? 'bg-white/15 border-l-4 border-[#06b6d4]' : '' }}">
                    <i class="fas fa-users w-5 h-5 flex-shrink-0 text-center"></i>
                    <span
                        class="whitespace-nowrap overflow-hidden transition-all duration-300 lg:opacity-100 lg:w-auto lg:block hidden opacity-0 w-0">
                        Penduduk
                    </span>
                </a>
                <!-- Tooltip untuk Penduduk -->
                <div class="tooltip">
                    Penduduk
                </div>
            </div>

            <div class="tooltip-container">
                <a href="{{ route('admin.rts.index') }}"
                    class="flex items-center space-x-3 px-3 py-2.5 rounded-lg hover:bg-white/10 transition-colors {{ request()->routeIs('admin.rts.*') ? 'bg-white/15 border-l-4 border-[#06b6d4]' : '' }}">
                    <i class="fas fa-home w-5 h-5 flex-shrink-0 text-center"></i>
                    <span
                        class="whitespace-nowrap overflow-hidden transition-all duration-300 lg:opacity-100 lg:w-auto lg:block hidden opacity-0 w-0">
                        RT
                    </span>
                </a>
                <!-- Tooltip untuk RT -->
                <div class="tooltip">
                    RT
                </div>
            </div>

            <div class="tooltip-container">
                <a href="{{ route('admin.rws.index') }}"
                    class="flex items-center space-x-3 px-3 py-2.5 rounded-lg hover:bg-white/10 transition-colors {{ request()->routeIs('admin.rws.*') ? 'bg-white/15 border-l-4 border-[#06b6d4]' : '' }}">
                    <i class="fas fa-building w-5 h-5 flex-shrink-0 text-center"></i>
                    <span
                        class="whitespace-nowrap overflow-hidden transition-all duration-300 lg:opacity-100 lg:w-auto lg:block hidden opacity-0 w-0">
                        RW
                    </span>
                </a>
                <!-- Tooltip untuk RW -->
                <div class="tooltip">
                    RW
                </div>
            </div>

            <div class="tooltip-container">
                <a href=""
                    class="flex items-center space-x-3 px-3 py-2.5 rounded-lg hover:bg-white/10 transition-colors {{ request()->routeIs('admin.families.*') ? 'bg-white/15 border-l-4 border-[#06b6d4]' : '' }}">
                    <i class="fas fa-address-card w-5 h-5 flex-shrink-0 text-center"></i>
                    <span
                        class="whitespace-nowrap overflow-hidden transition-all duration-300 lg:opacity-100 lg:w-auto lg:block hidden opacity-0 w-0">
                        Kartu Keluarga
                    </span>
                </a>
                <!-- Tooltip untuk Kartu Keluarga -->
                <div class="tooltip">
                    Kartu Keluarga
                </div>
            </div>
        </div>

        <!-- Data Administrasi Section -->
        <div class="mb-4">
            <div class="section-tooltip-container">
                <h3
                    class="px-3 mb-2 text-xs font-semibold text-white/60 uppercase tracking-wider lg:opacity-100 lg:block hidden opacity-0 h-0 overflow-hidden transition-all duration-300">
                    Data Administrasi
                </h3>
                <!-- Tooltip untuk Section Header -->
                <div class="tooltip section-tooltip">
                    Data Administrasi
                </div>
            </div>

            <div class="tooltip-container">
                <a href="{{ route('admin.submissions.index') }}"
                    class="flex items-center space-x-3 px-3 py-2.5 rounded-lg hover:bg-white/10 transition-colors {{ request()->routeIs('admin.submissions.*') ? 'bg-white/15 border-l-4 border-[#06b6d4]' : '' }}">
                    <i class="fas fa-envelope w-5 h-5 flex-shrink-0 text-center"></i>
                    <span
                        class="whitespace-nowrap overflow-hidden transition-all duration-300 lg:opacity-100 lg:w-auto lg:block hidden opacity-0 w-0">
                        Surat
                    </span>
                </a>
                <!-- Tooltip untuk Surat -->
                <div class="tooltip">
                    Surat
                </div>
            </div>

            <div class="tooltip-container">
                <a href="{{ route('admin.reports.index') }}"
                    class="flex items-center space-x-3 px-3 py-2.5 rounded-lg hover:bg-white/10 transition-colors {{ request()->routeIs('admin.reports*') ? 'bg-white/15 border-l-4 border-[#06b6d4]' : '' }}">
                    <i class="fas fa-chart-bar w-5 h-5 flex-shrink-0 text-center"></i>
                    <span
                        class="whitespace-nowrap overflow-hidden transition-all duration-300 lg:opacity-100 lg:w-auto lg:block hidden opacity-0 w-0">
                        Laporan
                    </span>
                </a>
                <!-- Tooltip untuk Laporan -->
                <div class="tooltip">
                    Laporan
                </div>
            </div>

            <div class="tooltip-container">
                <a href="{{ route('admin.imports.index') }}"
                    class="flex items-center space-x-3 px-3 py-2.5 rounded-lg hover:bg-white/10 transition-colors {{ request()->routeIs('admin.imports.*') ? 'bg-white/15 border-l-4 border-[#06b6d4]' : '' }}">
                    <i class="fas fa-file-import w-5 h-5 flex-shrink-0 text-center"></i>
                    <span
                        class="whitespace-nowrap overflow-hidden transition-all duration-300 lg:opacity-100 lg:w-auto lg:block hidden opacity-0 w-0">
                        Riwayat Import
                    </span>
                </a>
                <!-- Tooltip untuk Riwayat Import -->
                <div class="tooltip">
                    Riwayat Import
                </div>
            </div>
        </div>

        <!-- Lain-lain Section -->
        <div class="mb-4">
            <div class="section-tooltip-container">
                <h3
                    class="px-3 mb-2 text-xs font-semibold text-white/60 uppercase tracking-wider lg:opacity-100 lg:block hidden opacity-0 h-0 overflow-hidden transition-all duration-300">
                    Lain - Lain
                </h3>
                <!-- Tooltip untuk Section Header -->
                <div class="tooltip section-tooltip">
                    Lain - Lain
                </div>
            </div>

            <div class="tooltip-container">
                <a href="{{ route('admin.news.index') }}"
                    class="flex items-center space-x-3 px-3 py-2.5 rounded-lg hover:bg-white/10 transition-colors {{ request()->routeIs('admin.news.*') ? 'bg-white/15 border-l-4 border-[#06b6d4]' : '' }}">
                    <i class="fas fa-newspaper w-5 h-5 flex-shrink-0 text-center"></i>
                    <span
                        class="whitespace-nowrap overflow-hidden transition-all duration-300 lg:opacity-100 lg:w-auto lg:block hidden opacity-0 w-0">
                        Berita
                    </span>
                </a>
                <!-- Tooltip untuk Berita -->
                <div class="tooltip">
                    Berita
                </div>
            </div>

            <div class="tooltip-container">
                <a href="{{ route('admin.galleries.index') }}"
                    class="flex items-center space-x-3 px-3 py-2.5 rounded-lg hover:bg-white/10 transition-colors {{ request()->routeIs('admin.galeri.*') ? 'bg-white/15 border-l-4 border-[#06b6d4]' : '' }}">
                    <i class="fas fa-images w-5 h-5 flex-shrink-0 text-center"></i>
                    <span
                        class="whitespace-nowrap overflow-hidden transition-all duration-300 lg:opacity-100 lg:w-auto lg:block hidden opacity-0 w-0">
                        Galeri
                    </span>
                </a>
                <!-- Tooltip untuk Galeri -->
                <div class="tooltip">
                    Galeri
                </div>
            </div>
        </div>

        <!-- Pengaturan Section -->
        @if (auth()->check() && (auth()->user()->role ?? null) === 'admin')
            <div class="mb-4">
                <div class="section-tooltip-container">
                    <h3
                        class="px-3 mb-2 text-xs font-semibold text-white/60 uppercase tracking-wider lg:opacity-100 lg:block hidden opacity-0 h-0 overflow-hidden transition-all duration-300">
                        Pengaturan
                    </h3>
                    <!-- Tooltip untuk Section Header -->
                    <div class="tooltip section-tooltip">
                        Pengaturan
                    </div>
                </div>

                <div class="tooltip-container">
                    <a href=""
                        class="flex items-center space-x-3 px-3 py-2.5 rounded-lg hover:bg-white/10 transition-colors {{ request()->routeIs('admin.settings.*') ? 'bg-white/15 border-l-4 border-[#06b6d4]' : '' }}">
                        <i class="fas fa-cog w-5 h-5 flex-shrink-0 text-center"></i>
                        <span
                            class="whitespace-nowrap overflow-hidden transition-all duration-300 lg:opacity-100 lg:w-auto lg:block hidden opacity-0 w-0">
                            Pengaturan Sistem
                        </span>
                    </a>
                    <!-- Tooltip untuk Pengaturan Sistem -->
                    <div class="tooltip">
                        Pengaturan Sistem
                    </div>
                </div>
            </div>
        @endif
    </div>

    {{-- Footer Section --}}
    <div class="p-4 border-t border-white/10 bg-[#16346A] overflow-visible">
        <div class="space-y-2 overflow-visible">
            <div class="tooltip-container">
                <a href="{{ route('landing-page') }}"
                    class="flex items-center space-x-3 p-2 rounded-lg hover:bg-white/10 transition-colors group lg:justify-start justify-center">
                    <i class="fas fa-external-link-alt w-5 h-5 flex-shrink-0 text-center"></i>
                    <span
                        class="whitespace-nowrap overflow-hidden transition-all duration-300 lg:opacity-100 lg:w-auto lg:block hidden opacity-0 w-0">
                        Lihat Situs
                    </span>
                </a>
                <!-- Tooltip untuk Lihat Situs -->
                <div class="tooltip">
                    Lihat Situs
                </div>
            </div>

            <form id="logout-form" method="POST" action="{{ route('logout') }}" class="hidden">
                @csrf
            </form>

            <div class="tooltip-container">
                <button id="logout-button" type="button"
                    class="flex items-center space-x-3 p-2 rounded-lg hover:bg-red-500/10 text-red-300 hover:text-red-200 transition-colors w-full lg:justify-start justify-center">
                    <i class="fas fa-sign-out-alt w-5 h-5 flex-shrink-0 text-center"></i>
                    <span
                        class="whitespace-nowrap overflow-hidden transition-all duration-300 lg:opacity-100 lg:w-auto lg:block hidden opacity-0 w-0">
                        Keluar
                    </span>
                </button>
                <!-- Tooltip untuk Keluar -->
                <div class="tooltip">
                    Keluar
                </div>
            </div>
        </div>
    </div>
</aside>
{{-- =========================================== --}}
{{-- END SIDEBAR --}}
{{-- =========================================== --}}