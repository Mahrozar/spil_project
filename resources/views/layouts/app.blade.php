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
