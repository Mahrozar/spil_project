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
    {{-- Inline theme overrides (temporary) to ensure violet branding appears immediately without rebuilding public CSS --}}
    <style>
        :root{ --brand: #8b5cf6; --brand-dark: #6d28d9; }
        .main.admin { background: linear-gradient(180deg,#f3e8ff 0%,#eef2ff 100%) !important; }
        .main.admin .topbar { background: linear-gradient(90deg,var(--brand-dark),var(--brand)) !important; }
        .main.admin .sidebar { background: #2b0b4a !important; }
        .main.admin .card, .main.admin .chart-card, .main.admin .stat-card { background: #ffffff !important; color: #0b1220 !important; }
        .main.admin .stat-icon svg { color: var(--brand) !important; }
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
