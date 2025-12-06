<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'SPIL') }}</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('css/app.css') }}" />
    @stack('head')
</head>
<body class="antialiased font-sans bg-gray-50 text-slate-900">
    <header class="bg-white shadow-sm">
        <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">
            <a href="{{ route('landing') }}" class="flex items-center space-x-3">
                <span class="inline-block w-10 h-10 rounded-md bg-gradient-to-r from-indigo-500 to-purple-600 flex items-center justify-center text-white font-bold">S</span>
                <span class="text-lg font-semibold">{{ config('app.name', 'SPIL') }}</span>
            </a>
            <nav class="space-x-4 text-sm">
                <a href="{{ route('landing') }}" class="text-slate-700 hover:text-slate-900">Home</a>
                @guest
                    <a href="{{ route('login') }}" class="text-slate-700 hover:text-slate-900">Login</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="ml-2 px-3 py-1 rounded-md bg-indigo-600 text-white text-sm">Register</a>
                    @endif
                @else
                    <a href="{{ route('dashboard') }}" class="text-slate-700 hover:text-slate-900">Dashboard</a>
                @endguest
            </nav>
        </div>
    </header>

    <main class="min-h-screen">
        @yield('content')
    </main>

    <footer class="bg-white border-t">
        <div class="max-w-7xl mx-auto px-6 py-8 text-sm text-slate-600">
            <div class="flex items-center justify-between">
                <div>
                    © {{ date('Y') }} {{ config('app.name', 'SPIL') }}. All rights reserved.
                </div>
                <div class="space-x-4">
                    <a href="mailto:info@example.com" class="hover:underline">Contact</a>
                    <a href="#" class="hover:underline">Privacy</a>
                </div>
            </div>
        </div>
    </footer>

    @stack('scripts')
</body>
</html>
