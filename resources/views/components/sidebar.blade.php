<aside class="sidebar {{ request()->is('admin*') ? 'admin' : '' }}" id="sidebar">


    {{-- Navigation --}}
    <nav class="nav-container">
        <!-- Dashboard -->
        <div class="nav-section">
            <a href="{{ route('admin.dashboard') }}"
                class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <svg class="nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                </svg>
                <span class="nav-text">Dashboard</span>
            </a>
        </div>

        <!-- Data Kependudukan Section -->
        <div class="nav-section">
            <div class="section-title">
                <span>Data Kependudukan</span>
            </div>

            <a href="{{ route('admin.residents.index') }}"
                class="nav-item {{ request()->routeIs('admin.residents.*') ? 'active' : '' }}">
                <svg class="nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                </svg>
                <span class="nav-text">Penduduk</span>
            </a>

            <a href="{{ route('admin.rts.index') }}"
                class="nav-item {{ request()->routeIs('admin.rts.*') ? 'active' : '' }}">
                <svg class="nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                </svg>
                <span class="nav-text">RT</span>
            </a>

            <a href="{{ route('admin.rws.index') }}"
                class="nav-item {{ request()->routeIs('admin.rws.*') ? 'active' : '' }}">
                <svg class="nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                </svg>
                <span class="nav-text">RW</span>
            </a>

            <a href="" class="nav-item {{ request()->routeIs('admin.families.*') ? 'active' : '' }}">
                <svg class="nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                </svg>
                <span class="nav-text">Kartu Keluarga</span>
            </a>
        </div>

        <!-- Data Administrasi Section -->
        <div class="nav-section">
            <div class="section-title">
                <span>Data Administrasi</span>
            </div>

            <a href="{{ route('admin.submissions.index') }}"
                class="nav-item {{ request()->routeIs('admin.submissions.*') ? 'active' : '' }}">
                <svg class="nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
                <span class="nav-text">Surat</span>
            </a>

            <a href="{{ route('admin.reports.index') }}"
                class="nav-item {{ request()->routeIs('admin.reports*') ? 'active' : '' }}">
                <svg class="nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
                <span class="nav-text">Laporan</span>
            </a>

            <a href="{{ route('admin.imports.index') }}"
                class="nav-item {{ request()->routeIs('admin.imports.*') ? 'active' : '' }}">
                <svg class="nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
                </svg>
                <span class="nav-text">Riwayat Import</span>
            </a>
        </div>

        <!-- Pengaturan Section -->
        @if (auth()->check() && (auth()->user()->role ?? null) === 'admin')
            <div class="nav-section">
                <div class="section-title">
                    <span>Pengaturan</span>
                </div>

                <a href="" class="nav-item {{ request()->routeIs('admin.settings.*') ? 'active' : '' }}">
                    <svg class="nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    <span class="nav-text">Pengaturan Sistem</span>
                </a>
            </div>
        @endif
    </nav>

    {{-- Footer Section --}}
    <div class="sidebar-footer">
        <div class="footer-links">
            <a href="{{ route('landing-page') }}" class="footer-link group">
                <div class="footer-icon">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                    </svg>
                </div>
                <span class="footer-text">Lihat Situs</span>
            </a>

            <form id="logout-form" method="POST" action="{{ route('logout') }}" class="hidden">
                @csrf
            </form>

            <button id="logout-button" type="button" class="footer-link logout-btn group">
                <div class="footer-icon">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                    </svg>
                </div>
                <span class="footer-text">Keluar</span>
            </button>
        </div>
    </div>
</aside>

<style>
    /* Sidebar Styles */
    .sidebar {
        position: fixed;
        left: 0;
        top: 0;
        height: 100vh;
        width: 250px;
        background: var(--sidebar);
        color: white;
        display: flex;
        flex-direction: column;
        z-index: 50;
        box-shadow: 4px 0 12px rgba(0, 0, 0, 0.1);
        transition: width 0.3s ease;
        overflow-y: auto;
    }

    .sidebar.collapsed {
        width: 70px;
    }

    /* Logo Section */
    .logo-section {
        flex-shrink: 0;
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    }

    .logo-mark {
        width: 40px;
        height: 40px;
        border-radius: 10px;
        background: linear-gradient(135deg, var(--secondary), var(--primary));
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        font-size: 18px;
        color: white;
        flex-shrink: 0;
    }

    .logo-text {
        font-size: 18px;
        font-weight: 600;
        color: white;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        transition: opacity 0.3s ease;
    }

    .sidebar.collapsed .logo-text {
        opacity: 0;
        width: 0;
    }

    /* Navigation Container */
    .nav-container {
        flex: 1;
        padding: 1rem 0.75rem;
        overflow-y: auto;
    }

    .nav-section {
        margin-bottom: 1.5rem;
    }

    .section-title {
        padding: 0.5rem 0.75rem;
        font-size: 0.75rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        color: rgba(255, 255, 255, 0.6);
        margin-bottom: 0.5rem;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        transition: opacity 0.3s ease;
    }

    .sidebar.collapsed .section-title {
        opacity: 0;
        height: 0;
        margin: 0;
        padding: 0;
    }

    /* Navigation Items */
    .nav-item {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        padding: 0.75rem;
        border-radius: 8px;
        color: rgba(255, 255, 255, 0.85);
        text-decoration: none;
        transition: all 0.2s ease;
        margin-bottom: 0.25rem;
        position: relative;
    }

    .nav-item:hover {
        background: rgba(255, 255, 255, 0.1);
        color: white;
    }

    .nav-item.active {
        background: rgba(255, 255, 255, 0.15);
        color: white;
        border-left: 4px solid var(--accent);
    }

    .nav-icon {
        width: 20px;
        height: 20px;
        color: currentColor;
        flex-shrink: 0;
    }

    .nav-text {
        font-size: 14px;
        font-weight: 500;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        transition: opacity 0.3s ease;
    }

    .sidebar.collapsed .nav-text {
        opacity: 0;
        width: 0;
    }

    /* Footer Styles - Update bagian ini di sidebar.blade.php */
    .sidebar-footer {
        margin-top: auto;
        padding: 1rem;
        border-top: 1px solid rgba(255, 255, 255, 0.1);
        background: rgba(0, 0, 0, 0.05);
    }
    
    .footer-links {
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
    }
    
    .footer-link {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        padding: 0.75rem;
        border-radius: 0.5rem;
        color: rgba(255, 255, 255, 0.8);
        text-decoration: none;
        background: transparent;
        border: none;
        cursor: pointer;
        font-size: 0.875rem;
        font-weight: 500;
        transition: all 0.2s ease;
        width: 100%;
        text-align: left;
    }
    
    .footer-link:hover {
        background: rgba(255, 255, 255, 0.1);
        color: white;
        transform: translateX(2px);
    }
    
    .footer-link.logout-btn:hover {
        background: rgba(239, 68, 68, 0.15);
        color: #f87171;
    }
    
    .footer-icon {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 20px;
        height: 20px;
        flex-shrink: 0;
    }
    
    .footer-text {
        font-size: 0.875rem;
        font-weight: 500;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        transition: all 0.3s ease;
    }
    
    /* Ketika sidebar collapsed */
    .sidebar.collapsed .footer-text {
        opacity: 0;
        width: 0;
        margin-left: -0.75rem;
    }
    
    .sidebar.collapsed .footer-link {
        justify-content: center;
        padding: 0.75rem;
    }
    
    .sidebar.collapsed .footer-link:hover .footer-text {
        opacity: 1;
        width: auto;
        margin-left: 0.75rem;
        position: absolute;
        left: 100%;
        background: var(--sidebar);
        padding: 0.5rem 0.75rem;
        border-radius: 0.375rem;
        margin-left: 0.5rem;
        white-space: nowrap;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.1);
        z-index: 10;
    }
    
    .sidebar.collapsed .footer-link.logout-btn:hover .footer-text {
        background: rgba(239, 68, 68, 0.1);
        backdrop-filter: blur(4px);
    }
    
    /* Tooltip untuk collapsed state */
    .sidebar.collapsed .footer-link {
        position: relative;
    }
    
    .sidebar.collapsed .footer-link::after {
        content: attr(title);
        position: absolute;
        left: 100%;
        top: 50%;
        transform: translateY(-50%);
        background: var(--sidebar);
        color: white;
        padding: 0.5rem 0.75rem;
        border-radius: 0.375rem;
        font-size: 0.75rem;
        white-space: nowrap;
        opacity: 0;
        visibility: hidden;
        transition: all 0.2s ease;
        z-index: 50;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.1);
        pointer-events: none;
    }
    
    .sidebar.collapsed .footer-link:hover::after {
        opacity: 1;
        visibility: visible;
        transform: translateY(-50%) translateX(0.5rem);
    }

    /* Mobile Responsive */
    @media (max-width: 768px) {
        .sidebar {
            transform: translateX(-100%);
            width: 280px;
        }

        .sidebar.active {
            transform: translateX(0);
        }

        .sidebar.collapsed {
            width: 280px;
        }
    }
</style>
<script>
    // Tambahkan title untuk tooltip di collapsed state
    document.addEventListener('DOMContentLoaded', function() {
        const footerLinks = document.querySelectorAll('.footer-link');
        footerLinks.forEach(link => {
            const text = link.querySelector('.footer-text')?.textContent || '';
            link.setAttribute('title', text);
        });
        
        // Logout functionality
        const logoutBtn = document.getElementById('logout-button');
        if (logoutBtn) {
            logoutBtn.addEventListener('click', function(e) {
                e.preventDefault();
                if (confirm('Apakah Anda yakin ingin keluar?')) {
                    document.getElementById('logout-form').submit();
                }
            });
        }
    });
</script>
