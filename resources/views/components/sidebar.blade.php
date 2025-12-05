<aside class="sidebar">
    <div class="logo">
        <a href="/" class="flex items-center gap-2 text-white">
            <div class="mark">SP</div>
            <div class="text-lg font-semibold">SPIL</div>
        </a>
    </div>
    <nav class="flex-1">
        <a href="{{ route('dashboard') }}" class="block py-2 px-2 rounded">Dashboard</a>
        <a href="{{ route('admin.letters') }}" class="block py-2 px-2 rounded">Letters</a>
        <a href="{{ route('admin.reports') }}" class="block py-2 px-2 rounded">Reports</a>
        <a href="{{ route('admin.rws.index') }}" class="block py-2 px-2 rounded">RW</a>
        <a href="{{ route('admin.rts.index') }}" class="block py-2 px-2 rounded">RT</a>
        <a href="{{ route('admin.residents.index') }}" class="block py-2 px-2 rounded">Residents</a>
    </nav>
    <div class="mt-6">
        <a href="{{ route('dashboard') }}" class="block py-2 px-2 rounded text-xs text-slate-300">View site</a>
    </div>
</aside>
