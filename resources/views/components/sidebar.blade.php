<aside class="sidebar {{ request()->is('admin/*') ? 'admin admin-sidebar' : '' }}">
    <div class="logo mb-6">
        <a href="/" class="flex items-center gap-3">
            @php
                $appName = config('app.name', 'Admin');
                $parts = preg_split('/\s+/', trim($appName));
                $initials = '';
                foreach ($parts as $p) { $initials .= strtoupper(substr($p,0,1)); }
            @endphp
            <div class="mark w-10 h-10 rounded-md flex items-center justify-center font-bold text-white admin-logo-mark">{{ $initials }}</div>
            <div class="text-lg font-semibold text-white">{{ $appName }}</div>
        </a>
    </div>
    <nav class="flex-1 space-y-1">
        <a href="{{ request()->is('admin/*') ? route('admin.dashboard') : route('dashboard') }}" class="block py-2 px-3 rounded text-white hover:bg-white/10 {{ request()->routeIs('dashboard') || request()->routeIs('admin.dashboard') ? 'bg-white/10' : '' }}">Dashboard</a>

        <div class="mt-4 mb-1 px-3 py-1 text-xs bg-white text-black rounded tracking-wide uppercase">Data Kependudukan</div>
        <a href="{{ route('admin.residents.index') }}" class="block py-2 px-3 rounded text-white hover:bg-white/10 {{ request()->routeIs('admin.residents*') ? 'bg-white/10' : '' }}">Penduduk</a>
        <a href="{{ route('admin.rts.index') }}" class="block py-2 px-3 rounded text-white hover:bg-white/10 {{ request()->routeIs('admin.rts*') ? 'bg-white/10' : '' }}">RT</a>
        <a href="{{ route('admin.rws.index') }}" class="block py-2 px-3 rounded text-white hover:bg-white/10 {{ request()->routeIs('admin.rws*') ? 'bg-white/10' : '' }}">RW</a>
        <a href="{{ route('admin.residents.index', ['filter' => 'kk']) }}" class="block py-2 px-3 rounded text-white hover:bg-white/10 {{ request()->is('admin/residents') && request()->query('filter') === 'kk' ? 'bg-white/10' : '' }}">Kartu Keluarga</a>

        <div class="mt-4 mb-1 px-3 py-1 text-xs bg-white text-black rounded tracking-wide uppercase">Data Administrasi</div>
        <a href="{{ route('admin.submissions.index') }}" class="block py-2 px-3 rounded text-white hover:bg-white/10 {{ request()->routeIs('admin.submissions*') ? 'bg-white/10' : '' }}">Surat</a>
        <a href="{{ route('admin.reports') }}" class="block py-2 px-3 rounded text-white hover:bg-white/10 {{ request()->routeIs('admin.reports*') ? 'bg-white/10' : '' }}">Laporan</a>

        <a href="{{ route('admin.imports.index') }}" class="block py-2 px-3 rounded text-white hover:bg-white/10 {{ request()->routeIs('admin.imports*') ? 'bg-white/10' : '' }}">Riwayat Import</a>
        @if(auth()->check() && (auth()->user()->role ?? null) === 'admin')
            <a href="{{ route('admin.settings.home.edit') }}" class="block py-2 px-3 rounded text-white hover:bg-white/10 {{ request()->routeIs('admin.settings.*') ? 'bg-white/10' : '' }}">Pengaturan Halaman</a>
        @endif
    </nav>
    <div class="mt-6">
        <a href="{{ route('landing-page') }}" class="block py-2 px-3 rounded text-xs text-white hover:bg-white/10">Lihat Situs</a>
    </div>
    <div class="mt-6">
        <form id="logout-form" method="POST" action="{{ route('logout') }}">@csrf</form>
        <button id="logout-button" type="button" class="w-full text-left block py-2 px-3 rounded text-sm text-white hover:bg-white/10">Keluar</button>
    </div>

    <script>
        (function(){
            const btn = document.getElementById('logout-button');
            const form = document.getElementById('logout-form');
            if (!btn || !form) return;
            btn.addEventListener('click', function(){ if (confirm('Yakin ingin keluar?')) form.submit(); });
        })();
    </script>
</aside>
