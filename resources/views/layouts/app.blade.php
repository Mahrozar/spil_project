<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'SPIL') }} - @yield('title', 'Dashboard')</title>
    
    {{-- Load Tailwind CSS --}}
    @vite(['resources/css/app.css','resources/js/app.js'])
    
    {{-- Theme Variables -- Minimal --}}
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
    </style>
    
    @stack('head')
</head>

<body class="font-sans antialiased bg-slate-50">
    @php 
        $isAdmin = request()->is('admin*') || request()->routeIs('admin.*');
    @endphp
    
    @if($isAdmin && auth()->check())
        {{-- Admin Layout --}}
        <div class="admin-layout">
            {{-- Sidebar --}}
            <x-sidebar />
            
            {{-- Main Content --}}
            <div class="main-content" id="mainContent">
                {{-- Topbar --}}
                <x-topbar />
                
                {{-- Page Content --}}
                <main class="p-4 md:p-6">
                    <div class="max-w-7xl mx-auto">
                        {{-- Breadcrumb (optional) --}}
                        @if(View::hasSection('breadcrumb'))
                            <div class="mb-6">
                                @yield('breadcrumb')
                            </div>
                        @endif
                        
                        {{-- Page Title --}}
                        @if(View::hasSection('title'))
                            <div class="mb-6">
                                <h1 class="text-2xl md:text-3xl font-bold text-gray-800">
                                    @yield('title')
                                </h1>
                                @hasSection('subtitle')
                                    <p class="text-gray-600 mt-2">
                                        @yield('subtitle')
                                    </p>
                                @endif
                            </div>
                        @endif
                        
                        {{-- Main Slot --}}
                        {{ $slot }}
                    </div>
                </main>
            </div>
            
            {{-- Mobile Overlay --}}
            <div class="sidebar-overlay" id="sidebarOverlay"></div>
        </div>
    @else
        {{-- Public Layout --}}
        {{ $slot }}
    @endif
    
    @stack('scripts')
    <script src="https://cdn.tailwindcss.com"></script>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Sidebar toggle functionality
            const sidebarToggle = document.getElementById('sidebarToggle');
            const sidebar = document.querySelector('.sidebar');
            const mainContent = document.getElementById('mainContent');
            const sidebarOverlay = document.getElementById('sidebarOverlay');
            
            if (sidebarToggle) {
                sidebarToggle.addEventListener('click', function() {
                    sidebar.classList.toggle('collapsed');
                    mainContent.classList.toggle('collapsed');
                    
                    // Toggle overlay on mobile
                    if (window.innerWidth <= 768) {
                        sidebar.classList.toggle('active');
                        if (sidebar.classList.contains('active')) {
                            sidebarOverlay.classList.add('active');
                        } else {
                            sidebarOverlay.classList.remove('active');
                        }
                    }
                });
            }
            
            // Close sidebar on overlay click (mobile)
            if (sidebarOverlay) {
                sidebarOverlay.addEventListener('click', function() {
                    sidebar.classList.remove('active');
                    sidebarOverlay.classList.remove('active');
                });
            }
            
            // Auto-collapse on small screens
            function handleResize() {
                if (window.innerWidth <= 1024 && window.innerWidth > 768) {
                    sidebar.classList.add('collapsed');
                    mainContent.classList.add('collapsed');
                } else if (window.innerWidth > 1024) {
                    sidebar.classList.remove('collapsed');
                    mainContent.classList.remove('collapsed');
                }
            }
            
            // Initial check
            handleResize();
            window.addEventListener('resize', handleResize);
            
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
        });
    </script>
</body>
</html>