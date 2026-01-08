<header class="topbar">
    <div class="topbar-container">
        <!-- Left Section -->
        <div class="topbar-left">
            <button id="sidebarToggle" class="sidebar-toggle" aria-label="Toggle sidebar">
                <svg class="toggle-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                          d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </button>
            
            <div class="page-info">
                <h1 class="page-title">
                    @yield('title', 'Dashboard Admin')
                </h1>
                @hasSection('subtitle')
                    <p class="page-subtitle">
                        @yield('subtitle')
                    </p>
                @else
                    <p class="welcome-text">
                        Selamat datang, {{ auth()->user()->name ?? 'Admin' }}
                    </p>
                @endif
            </div>
        </div>

        <!-- Right Section -->
        <div class="topbar-right">
            <!-- Search Bar -->
            <div class="search-container">
                <div class="search-wrapper">
                    <svg class="search-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                              d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                    <input type="search" 
                           placeholder="Cari data..."
                           class="search-input"
                           id="globalSearch">
                </div>
            </div>

            <!-- User Menu -->
            <div class="user-menu">
                <div class="user-info">
                    <div class="user-name">
                        {{ auth()->user()->name ?? 'Administrator' }}
                    </div>
                    <div class="user-role">
                        {{ ucfirst(auth()->user()->role ?? 'admin') }}
                    </div>
                </div>
                
                <div class="user-avatar-container">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name ?? 'Admin') }}&background=3b82f6&color=fff&size=128" 
                         alt="avatar" 
                         class="user-avatar"
                         id="userAvatar">
                    
                    <!-- Dropdown Menu -->
                    <div class="user-dropdown" id="userDropdown">
                        <a href="" class="dropdown-item">
                            <svg class="dropdown-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                      d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                            <span>Profil Saya</span>
                        </a>
                        <a href="" class="dropdown-item">
                            <svg class="dropdown-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                      d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                      d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                            <span>Pengaturan Akun</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <button onclick="document.getElementById('logout-form').submit()" 
                                class="dropdown-item logout-item">
                            <svg class="dropdown-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                      d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                            </svg>
                            <span>Keluar</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

<style>
    /* Topbar Styles */
    .topbar {
        position: sticky;
        top: 0;
        z-index: 40;
        background: linear-gradient(90deg, var(--topbar-from), var(--topbar-to));
        backdrop-filter: blur(8px);
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
    }
    
    .topbar-container {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 0.75rem 1.5rem;
        max-width: 100%;
    }
    
    /* Left Section */
    .topbar-left {
        display: flex;
        align-items: center;
        gap: 1rem;
        flex: 1;
        min-width: 0;
    }
    
    .sidebar-toggle {
        background: transparent;
        border: none;
        color: white;
        cursor: pointer;
        padding: 0.5rem;
        border-radius: 0.375rem;
        transition: background-color 0.2s ease;
        flex-shrink: 0;
    }
    
    .sidebar-toggle:hover {
        background: rgba(255, 255, 255, 0.1);
    }
    
    .toggle-icon {
        width: 1.25rem;
        height: 1.25rem;
    }
    
    .page-info {
        min-width: 0;
    }
    
    .page-title {
        font-size: 1.25rem;
        font-weight: 600;
        color: white;
        margin: 0;
        line-height: 1.2;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    
    .page-subtitle,
    .welcome-text {
        font-size: 0.875rem;
        color: rgba(255, 255, 255, 0.8);
        margin: 0.25rem 0 0;
        line-height: 1.2;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    
    /* Right Section */
    .topbar-right {
        display: flex;
        align-items: center;
        gap: 1.5rem;
        flex-shrink: 0;
    }
    
    /* Search */
    .search-container {
        display: none;
    }
    
    @media (min-width: 768px) {
        .search-container {
            display: block;
        }
    }
    
    .search-wrapper {
        position: relative;
    }
    
    .search-icon {
        position: absolute;
        left: 0.75rem;
        top: 50%;
        transform: translateY(-50%);
        width: 1rem;
        height: 1rem;
        color: rgba(255, 255, 255, 0.7);
        pointer-events: none;
    }
    
    .search-input {
        width: 250px;
        padding: 0.5rem 1rem 0.5rem 2.5rem;
        border-radius: 0.5rem;
        border: 1px solid rgba(255, 255, 255, 0.2);
        background: rgba(255, 255, 255, 0.1);
        color: white;
        font-size: 0.875rem;
        transition: all 0.2s ease;
    }
    
    .search-input:focus {
        outline: none;
        border-color: rgba(255, 255, 255, 0.3);
        background: rgba(255, 255, 255, 0.15);
        width: 300px;
    }
    
    .search-input::placeholder {
        color: rgba(255, 255, 255, 0.7);
    }
    
    /* User Menu */
    .user-menu {
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }
    
    .user-info {
        text-align: right;
        display: none;
    }
    
    @media (min-width: 768px) {
        .user-info {
            display: block;
        }
    }
    
    .user-name {
        font-size: 0.875rem;
        font-weight: 500;
        color: white;
        line-height: 1.2;
    }
    
    .user-role {
        font-size: 0.75rem;
        color: rgba(255, 255, 255, 0.7);
        line-height: 1.2;
    }
    
    .user-avatar-container {
        position: relative;
    }
    
    .user-avatar {
        width: 2.5rem;
        height: 2.5rem;
        border-radius: 50%;
        border: 2px solid rgba(255, 255, 255, 0.3);
        cursor: pointer;
        object-fit: cover;
        transition: all 0.2s ease;
    }
    
    .user-avatar:hover {
        border-color: rgba(255, 255, 255, 0.5);
        transform: scale(1.05);
    }
    
    /* Dropdown Menu */
    .user-dropdown {
        position: absolute;
        right: 0;
        top: 100%;
        margin-top: 0.5rem;
        min-width: 200px;
        background: white;
        border-radius: 0.5rem;
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        border: 1px solid #e5e7eb;
        padding: 0.5rem 0;
        z-index: 50;
        opacity: 0;
        visibility: hidden;
        transform: translateY(-10px);
        transition: all 0.2s ease;
    }
    
    .user-dropdown.show {
        opacity: 1;
        visibility: visible;
        transform: translateY(0);
    }
    
    .dropdown-item {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        padding: 0.75rem 1rem;
        color: #374151;
        text-decoration: none;
        font-size: 0.875rem;
        transition: all 0.2s ease;
        border: none;
        background: none;
        width: 100%;
        text-align: left;
        cursor: pointer;
    }
    
    .dropdown-item:hover {
        background-color: #f3f4f6;
        color: #111827;
    }
    
    .dropdown-icon {
        width: 1rem;
        height: 1rem;
        color: #6b7280;
        flex-shrink: 0;
    }
    
    .dropdown-item:hover .dropdown-icon {
        color: #374151;
    }
    
    .dropdown-divider {
        height: 1px;
        background-color: #e5e7eb;
        margin: 0.5rem 0;
    }
    
    .logout-item {
        color: #dc2626;
    }
    
    .logout-item:hover {
        background-color: #fef2f2;
        color: #b91c1c;
    }
    
    .logout-item .dropdown-icon {
        color: #dc2626;
    }
    
    /* Mobile responsive */
    @media (max-width: 640px) {
        .topbar-container {
            padding: 0.75rem 1rem;
        }
        
        .page-title {
            font-size: 1.125rem;
        }
        
        .search-container {
            display: none;
        }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // User dropdown toggle
        const avatar = document.getElementById('userAvatar');
        const dropdown = document.getElementById('userDropdown');
        
        if (avatar && dropdown) {
            avatar.addEventListener('click', function(e) {
                e.stopPropagation();
                dropdown.classList.toggle('show');
            });
            
            // Close dropdown when clicking outside
            document.addEventListener('click', function(e) {
                if (!dropdown.contains(e.target) && !avatar.contains(e.target)) {
                    dropdown.classList.remove('show');
                }
            });
        }
        
        // Search functionality
        const searchInput = document.getElementById('globalSearch');
        if (searchInput) {
            searchInput.addEventListener('keypress', function(e) {
                if (e.key === 'Enter') {
                    const query = this.value.trim();
                    if (query) {
                        // Redirect to search page or filter current page
                        window.location.href = `/admin/search?q=${encodeURIComponent(query)}`;
                    }
                }
            });
        }
    });
</script>