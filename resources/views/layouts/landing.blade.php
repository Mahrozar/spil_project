<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'SPIL') }}</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('css/app.css') }}" />
    @stack('head')
    <style>
        /* Minor visual polish to help emulate the requested aesthetic */
        .hero-shape { opacity: .15; }
    </style>
</head>
<body class="antialiased font-sans bg-white text-slate-900">
    <div class="shadow-sm">
        <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">
            <a href="{{ route('landing') }}" class="flex items-center space-x-3">
                <span class="inline-block w-11 h-11 rounded-md bg-gradient-to-r from-emerald-500 to-teal-500 flex items-center justify-center text-white font-bold">{{ strtoupper(substr(config('app.name', 'SPIL'),0,1)) }}</span>
                <div>
                    <div class="text-lg font-semibold">{{ config('app.name', 'SPIL') }}</div>
                    <div class="text-xs text-slate-500">Sistem Informasi Desa</div>
                </div>
            </a>
            <nav class="space-x-6 text-sm flex items-center">
                <a href="#features" class="text-slate-700 hover:text-slate-900">Fitur</a>
                <a href="#about" class="text-slate-700 hover:text-slate-900">Tentang</a>
                <a href="#contact" class="text-slate-700 hover:text-slate-900">Kontak</a>
                @guest
                    <a href="{{ route('login') }}" class="px-4 py-2 rounded-md text-slate-700 border">Masuk</a>
                @else
                    <a href="{{ route('dashboard') }}" class="px-4 py-2 rounded-md bg-emerald-600 text-white">Dashboard</a>
                @endguest
            </nav>
        </div>
    </div>

    <main>
        @yield('content')
    </main>

    <footer class="bg-slate-900 text-slate-300 mt-12">
        <div class="max-w-7xl mx-auto px-6 py-12 grid grid-cols-1 md:grid-cols-3 gap-6">
            <div>
                <div class="text-white font-semibold">{{ config('app.name', 'SPIL') }}</div>
                <p class="mt-2 text-sm">Meningkatkan layanan desa melalui sistem digital yang mudah digunakan.</p>
            </div>
            <div>
                <div class="font-semibold">Alamat</div>
                <div class="mt-2 text-sm">Kantor Desa — Jalan Contoh No.1</div>
            </div>
            <div>
                <div class="font-semibold">Kontak</div>
                <div class="mt-2 text-sm">Email: info@example.com<br>Telp: (021) 000-000</div>
            </div>
        </div>
        <div class="border-t border-slate-800 text-center text-xs py-4">© {{ date('Y') }} {{ config('app.name', 'SPIL') }} — Semua hak dilindungi.</div>
    </footer>

    @stack('scripts')
</body>
</html>
