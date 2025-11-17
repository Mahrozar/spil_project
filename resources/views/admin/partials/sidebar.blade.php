@php
    $active = fn($name) => request()->routeIs($name) ? 'active' : '';
@endphp
@push('styles')
    @vite(['resources/css/admin.css', 'resources/js/admin.js'])
@endpush

{{-- Sidebar markup only — styles moved to resources/css/admin.css --}}
<aside class="admin-sidebar">
    <h4 class="font-semibold mb-3">Admin</h4>
    <nav>
        <a href="{{ route('admin.dashboard') }}" class="{{ $active('admin.dashboard') }}">Dasbor</a>
        <a href="{{ route('admin.letters') }}" class="{{ $active('admin.letters') }}">Surat</a>
        <a href="{{ route('admin.reports') }}" class="{{ $active('admin.reports') }}">Laporan</a>
        <hr style="border-color: rgba(255,255,255,0.06); margin:10px 0">
        <div style="font-weight:700; color:rgba(255,255,255,0.85); margin-bottom:6px">Data Kependudukan</div>
        <a href="{{ route('admin.residents.index') }}" class="{{ $active('admin.residents.*') }}">Penduduk</a>
        <a href="{{ route('admin.rts.index') }}" class="{{ $active('admin.rts.*') }}">RT</a>
        <a href="{{ route('admin.rws.index') }}" class="{{ $active('admin.rws.*') }}">RW</a>
        <hr style="border-color: rgba(255,255,255,0.06); margin:10px 0">
        <a href="#">Pengguna</a>
        <a href="#">Pengaturan</a>
    </nav>
</aside>
