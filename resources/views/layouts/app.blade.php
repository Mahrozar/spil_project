<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'SPIL') }}</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
    {{-- Fallback for when Vite is not running (useful in production or when dev server not active) --}}
    <link rel="stylesheet" href="{{ asset('css/app.css') }}" />
    @stack('head')
</head>
    {{-- Inline theme overrides to align admin colors with the public site --}}
    <style>
        :root{
            --sidebar: #16346A;
            --topbar-from: #1E3A8A;
            --topbar-to: #1E40AF;
            --primary: var(--topbar-to);
            --secondary: #3b82f6;
            --accent: #06b6d4;
            --dark: #1f2937;
            --light: #f8fafc;
        }

        /* Admin-specific adjustments */
        .main.admin { background: linear-gradient(135deg, var(--light) 0%, #e0f2fe 100%) !important; }
        .main.admin .topbar { background: linear-gradient(90deg, var(--topbar-from), var(--topbar-to)) !important; border-bottom: 1px solid rgba(255,255,255,0.04); }
        .main.admin .sidebar { background: var(--sidebar) !important; }
        .main.admin .sidebar a { color: #ffffff !important; }
        .main.admin .logo .mark { background: var(--secondary) !important; }
        .main.admin .card, .main.admin .chart-card, .main.admin .stat-card { background: #ffffff !important; color: var(--dark) !important; }
        .main.admin .stat-icon svg { color: var(--primary) !important; }
    </style>
    
@php $isAdmin = request()->is('admin/*'); @endphp
</head>
@php $isAdmin = request()->is('admin/*'); @endphp
<body class="font-sans antialiased {{ $isAdmin ? 'bg-slate-900 text-slate-100' : '' }}">
    <div class="flex">
        <x-sidebar />
        <div class="main {{ $isAdmin ? 'admin' : '' }}">
            <x-topbar />
            <main class="p-6">
                {{ $slot ?? '' }}
            </main>
        </div>
    </div>
    @stack('scripts')
</body>
</html>
