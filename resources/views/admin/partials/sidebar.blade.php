@php
    $active = fn($name) => request()->routeIs($name) ? 'active' : '';
@endphp
@push('styles')
    @vite(['resources/css/app.css', 'resources/js/admin.js'])
@endpush

{{-- Admin partial (assets only). The layout renders the actual sidebar markup via `resources/views/components/sidebar.blade.php`. --}}
