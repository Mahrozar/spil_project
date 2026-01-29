<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'SPIL') }} - @yield('title', 'Dashboard')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        :root {
            --sidebar: #16346A;
            --topbar-from: #1E3A8A;
            --topbar-to: #1E40AF;
            --primary: #1E40AF;
            --secondary: #3b82f6;
            --accent: #06b6d4;
            --dark: #1f2937;
            --light: #f8fafc;
        }

        /* Custom scrollbar */
        .sidebar-scrollbar::-webkit-scrollbar {
            width: 4px;
        }

        .sidebar-scrollbar::-webkit-scrollbar-track {
            background: rgba(255, 255, 255, 0.1);
        }

        .sidebar-scrollbar::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.3);
            border-radius: 2px;
        }

        .sidebar-scrollbar::-webkit-scrollbar-thumb:hover {
            background: rgba(255, 255, 255, 0.5);
        }

        /* Smooth transitions */
        .transition-all {
            transition-property: all;
            transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
            transition-duration: 300ms;
        }

        /* Tooltip styles for collapsed sidebar */
        .tooltip-container {
            position: relative;
        }
        
        .tooltip {
            visibility: hidden;
            position: absolute;
            z-index: 9999;
            background-color: #1E40AF;
            color: white;
            text-align: center;
            padding: 8px 12px;
            border-radius: 6px;
            font-size: 14px;
            font-weight: 500;
            white-space: nowrap;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            opacity: 0;
            transition: opacity 0.3s, visibility 0.3s;
            pointer-events: none;
            left: 100%;
            top: 50%;
            transform: translateY(-50%);
            margin-left: 10px;
            min-width: max-content;
        }
        
        .tooltip::after {
            content: "";
            position: absolute;
            top: 50%;
            right: 100%;
            margin-top: -5px;
            border-width: 5px;
            border-style: solid;
            border-color: transparent #1E40AF transparent transparent;
        }
        
        /* Show tooltip only when sidebar is collapsed and on hover */
        aside.lg\:w-20 .tooltip-container:hover .tooltip {
            visibility: visible;
            opacity: 1;
        }
        
        /* Hide tooltip when sidebar is expanded */
        aside.lg\:w-64 .tooltip {
            display: none !important;
        }
        
        /* For section headers */
        .section-tooltip {
            left: 50% !important;
            top: 100% !important;
            transform: translateX(-50%) translateY(10px) !important;
            margin-left: 0;
            margin-top: 5px;
        }
        
        .section-tooltip::after {
            top: -5px !important;
            left: 50% !important;
            right: auto !important;
            transform: translateX(-50%);
            border-color: transparent transparent #1E40AF transparent !important;
        }
        
        aside.lg\:w-20 .section-tooltip-container:hover .section-tooltip {
            transform: translateX(-50%) translateY(0) !important;
        }
        
        /* Ensure proper sidebar height */
        #sidebar {
            height: calc(100vh - 4rem);
        }
        
        /* Main content adjustment */
        #mainContent {
            min-height: calc(100vh - 4rem);
        }
        
        /* Fix for tooltip positioning in collapsed mode */
        aside.lg\:w-20 {
            overflow: visible !important;
        }
        
        .lg\:w-20 .tooltip-container {
            overflow: visible !important;
        }
    </style>

    @stack('head')
</head>

<body class="font-sans antialiased bg-gray-50">
    @php
        $isAdmin = request()->is('admin*') || request()->routeIs('admin.*');
    @endphp

    @if ($isAdmin && auth()->check())
        {{-- Admin Layout Container --}}
        <div class="min-h-screen flex flex-col">
            {{-- Topbar berada di luar main container --}}
            @include('components.topbar')

            <div class="flex flex-1">
                {{-- Include Sidebar Component --}}
                @include('components.sidebar')

                {{-- Main Content Area --}}
                <div id="mainContent"
                    class="flex-1 flex flex-col min-h-[calc(100vh-4rem)] transition-all duration-300 ease-in-out overflow-y-auto">
                    {{-- Page Content --}}
                    <main class="flex-1 p-4 md:p-6 bg-gray-50">
                        <div class="max-w-full mx-auto">
                            {{-- Breadcrumb --}}
                            @if (View::hasSection('breadcrumb'))
                                <div class="mb-6">
                                    @yield('breadcrumb')
                                </div>
                            @endif

                            {{-- Main Content --}}
                            @yield('content')
                        </div>
                    </main>
                </div>
            </div>

            {{-- Mobile Overlay --}}
            <div class="fixed inset-0 bg-black bg-opacity-50 z-30 lg:hidden hidden" id="sidebarOverlay"></div>
        </div>
    @else
        {{-- Public Layout --}}
        @yield('content')
    @endif

    @stack('scripts')
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Sidebar toggle functionality
            const sidebarToggle = document.getElementById('sidebarToggle');
            const sidebar = document.getElementById('sidebar');
            const sidebarOverlay = document.getElementById('sidebarOverlay');
            const mainContent = document.getElementById('mainContent');

            // Toggle sidebar on mobile
            if (sidebarToggle && sidebar) {
                sidebarToggle.addEventListener('click', function() {
                    sidebar.classList.toggle('-translate-x-full');
                    sidebarOverlay.classList.toggle('hidden');
                });
            }

            // Close sidebar on overlay click (mobile)
            if (sidebarOverlay) {
                sidebarOverlay.addEventListener('click', function() {
                    sidebar.classList.add('-translate-x-full');
                    sidebarOverlay.classList.add('hidden');
                });
            }

            // Toggle sidebar collapse on desktop
            const collapseToggle = document.getElementById('collapseToggle');

            if (collapseToggle && sidebar && mainContent) {
                collapseToggle.addEventListener('click', function() {
                    const isCollapsed = sidebar.classList.contains('lg:w-20');

                    if (isCollapsed) {
                        // Expand sidebar
                        sidebar.classList.remove('lg:w-20');
                        sidebar.classList.add('lg:w-64');
                        localStorage.setItem('sidebarCollapsed', 'false');
                    } else {
                        // Collapse sidebar
                        sidebar.classList.add('lg:w-20');
                        sidebar.classList.remove('lg:w-64');
                        localStorage.setItem('sidebarCollapsed', 'true');
                    }
                });
            }

            // User dropdown toggle
            const userAvatar = document.getElementById('userAvatar');
            const userDropdown = document.getElementById('userDropdown');

            if (userAvatar && userDropdown) {
                userAvatar.addEventListener('click', function(e) {
                    e.stopPropagation();
                    userDropdown.classList.toggle('hidden');
                });

                // Close dropdown when clicking outside
                document.addEventListener('click', function(e) {
                    if (!userDropdown.contains(e.target) && !userAvatar.contains(e.target)) {
                        userDropdown.classList.add('hidden');
                    }
                });
            }

            // Logout confirmation
            const logoutBtn = document.getElementById('logout-button');
            if (logoutBtn) {
                logoutBtn.addEventListener('click', function(e) {
                    e.preventDefault();
                    if (confirm('Apakah Anda yakin ingin keluar?')) {
                        document.getElementById('logout-form').submit();
                    }
                });
            }

            // Initialize sidebar state based on screen size
            function initSidebar() {
                if (window.innerWidth >= 1024) {
                    // Desktop mode
                    sidebar.classList.remove('-translate-x-full');
                    sidebar.classList.remove('fixed');
                    sidebar.classList.add('sticky', 'top-16');
                    if (sidebarOverlay) sidebarOverlay.classList.add('hidden');

                    // Check if sidebar was previously collapsed
                    const isCollapsed = localStorage.getItem('sidebarCollapsed') === 'true';

                    if (isCollapsed) {
                        // Set to collapsed
                        sidebar.classList.add('lg:w-20');
                        sidebar.classList.remove('lg:w-64');
                    } else {
                        // Set to expanded
                        sidebar.classList.remove('lg:w-20');
                        sidebar.classList.add('lg:w-64');
                    }
                } else {
                    // Mobile mode
                    sidebar.classList.add('-translate-x-full');
                    sidebar.classList.add('fixed');
                    sidebar.classList.remove('sticky');
                    sidebar.classList.remove('lg:w-20');
                    sidebar.classList.add('lg:w-64');
                }
            }

            // Handle window resize
            window.addEventListener('resize', function() {
                initSidebar();
            });

            // Global search functionality
            const globalSearch = document.getElementById('globalSearch');
            if (globalSearch) {
                globalSearch.addEventListener('keypress', function(e) {
                    if (e.key === 'Enter') {
                        const query = this.value.trim();
                        if (query) {
                            console.log('Search for:', query);
                        }
                    }
                });
            }

            // Run initialization
            initSidebar();
        });
    </script>
</body>

</html>