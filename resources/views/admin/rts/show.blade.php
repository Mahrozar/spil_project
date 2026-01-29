@extends('layouts.app')

@section('title', $rt->name . ' - Detail RT')
@section('breadcrumb')
    <!-- Breadcrumb -->
    <nav class="mb-6" aria-label="Breadcrumb">
        <ol class="flex items-center space-x-2 text-sm">
            <li>
                <a href="{{ route('admin.dashboard') }}" class="text-gray-400 hover:text-gray-600">
                    Dashboard
                </a>
            </li>
            <li class="flex items-center">
                <i class="fas fa-chevron-right text-gray-400 text-xs mx-2"></i>
                <a href="{{ route('admin.rts.index') }}" class="text-gray-400 hover:text-gray-600">
                    Daftar RT
                </a>
            </li>
            <li class="flex items-center">
                <i class="fas fa-chevron-right text-gray-400 text-xs mx-2"></i>
                <span class="text-gray-600 font-medium">{{ $rt->name }}</span>
            </li>
        </ol>
    </nav>
@endsection


@section('content')
    <div class="admin-content-area">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">


            <!-- Header -->
            <div class="md:flex md:items-center md:justify-between mb-8">
                <div class="flex-1 min-w-0">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 h-14 w-14 flex items-center justify-center bg-blue-100 rounded-xl mr-4">
                            <span class="text-blue-600 font-bold text-xl">{{ substr($rt->name, 2) }}</span>
                        </div>
                        <div>
                            <h1 class="text-3xl font-bold text-gray-900">
                                {{ $rt->name }}
                            </h1>
                            <div class="mt-1 flex flex-wrap items-center gap-2">
                                @if ($rt->rw)
                                    <a href="{{ route('admin.rws.show', $rt->rw) }}"
                                        class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800 hover:bg-green-200">
                                        <i class="fas fa-circle text-green-400 text-xs mr-1.5"></i>
                                        {{ $rt->rw->name }}
                                    </a>
                                @endif
                                @if ($rt->leader_name)
                                    <span
                                        class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-purple-100 text-purple-800">
                                        <i class="fas fa-circle text-purple-400 text-xs mr-1.5"></i>
                                        Ketua: {{ $rt->leader_name }}
                                    </span>
                                @endif
                                <span class="text-sm text-gray-500">
                                    <i class="far fa-calendar-alt mr-1"></i>
                                    Dibuat: {{ $rt->created_at->format('d M Y') }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-4 flex md:mt-0 space-x-3">
                    <a href="{{ route('admin.rts.edit', $rt) }}"
                        class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        <i class="fas fa-edit text-gray-400 mr-2"></i>
                        Edit RT
                    </a>
                    <a href="{{ route('admin.rts.index') }}"
                        class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        <i class="fas fa-arrow-left text-gray-400 mr-2"></i>
                        Kembali ke Daftar
                    </a>
                </div>
            </div>

            <!-- Stats Cards -->
            <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-4 mb-8">
                <div class="bg-white overflow-hidden shadow rounded-lg">
                    <div class="p-5">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <i class="fas fa-users text-blue-400 text-xl"></i>
                            </div>
                            <div class="ml-5 w-0 flex-1">
                                <dl>
                                    <dt class="text-sm font-medium text-gray-500 truncate">
                                        Jumlah Warga
                                    </dt>
                                    <dd class="text-lg font-medium text-gray-900">
                                        {{ $rt->residents_count ?? 0 }}
                                    </dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow rounded-lg">
                    <div class="p-5">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <i class="fas fa-layer-group text-green-400 text-xl"></i>
                            </div>
                            <div class="ml-5 w-0 flex-1">
                                <dl>
                                    <dt class="text-sm font-medium text-gray-500 truncate">
                                        RW Induk
                                    </dt>
                                    <dd class="text-lg font-medium text-gray-900">
                                        {{ $rt->rw->name ?? '-' }}
                                    </dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow rounded-lg">
                    <div class="p-5">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <i class="fas fa-user-tie text-purple-400 text-xl"></i>
                            </div>
                            <div class="ml-5 w-0 flex-1">
                                <dl>
                                    <dt class="text-sm font-medium text-gray-500 truncate">
                                        Ketua RT
                                    </dt>
                                    <dd class="text-lg font-medium text-gray-900 truncate">
                                        {{ $rt->leader_name ?: '-' }}
                                    </dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow rounded-lg">
                    <div class="p-5">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <i class="fas fa-phone text-yellow-400 text-xl"></i>
                            </div>
                            <div class="ml-5 w-0 flex-1">
                                <dl>
                                    <dt class="text-sm font-medium text-gray-500 truncate">
                                        No. HP Ketua
                                    </dt>
                                    <dd class="text-lg font-medium text-gray-900 truncate">
                                        @if ($rt->phone)
                                            <a href="tel:{{ $rt->phone }}" class="text-blue-600 hover:text-blue-800">
                                                {{ $rt->phone }}
                                            </a>
                                        @else
                                            -
                                        @endif
                                    </dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Content -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Left Column: Informasi Detail -->
                <div class="lg:col-span-2">
                    <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                        <div class="px-4 py-5 sm:px-6 border-b border-gray-200">
                            <h3 class="text-lg leading-6 font-medium text-gray-900">
                                Informasi Detail RT
                            </h3>
                            <p class="mt-1 max-w-2xl text-sm text-gray-500">
                                Informasi lengkap tentang Rukun Tetangga {{ $rt->name }}
                            </p>
                        </div>
                        <div class="border-t border-gray-200">
                            <dl>
                                <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                    <dt class="text-sm font-medium text-gray-500">
                                        ID Database
                                    </dt>
                                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                        #{{ str_pad($rt->id, 3, '0', STR_PAD_LEFT) }}
                                    </dd>
                                </div>
                                <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                    <dt class="text-sm font-medium text-gray-500">
                                        Nama RT
                                    </dt>
                                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2 font-medium">
                                        {{ $rt->name }}
                                    </dd>
                                </div>
                                <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                    <dt class="text-sm font-medium text-gray-500">
                                        RW Induk
                                    </dt>
                                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                        @if ($rt->rw)
                                            <div class="flex items-center">
                                                <div
                                                    class="flex-shrink-0 h-6 w-6 flex items-center justify-center bg-green-100 rounded-lg mr-2">
                                                    <span
                                                        class="text-green-600 font-bold text-xs">{{ substr($rt->rw->name, 3) }}</span>
                                                </div>
                                                <div>
                                                    <a href="{{ route('admin.rws.show', $rt->rw) }}"
                                                        class="text-blue-600 hover:text-blue-800">
                                                        {{ $rt->rw->name }}
                                                    </a>
                                                    @if ($rt->rw->ketua_rw)
                                                        <div class="text-xs text-gray-500">Ketua: {{ $rt->rw->ketua_rw }}
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        @else
                                            <span class="text-gray-400">-</span>
                                        @endif
                                    </dd>
                                </div>
                                <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                    <dt class="text-sm font-medium text-gray-500">
                                        Ketua RT
                                    </dt>
                                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                        @if ($rt->leader_name)
                                            <span
                                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                {{ $rt->leader_name }}
                                            </span>
                                        @else
                                            <span
                                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                                Belum Ditentukan
                                            </span>
                                        @endif
                                    </dd>
                                </div>
                                <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                    <dt class="text-sm font-medium text-gray-500">
                                        No. HP Ketua RT
                                    </dt>
                                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                        @if ($rt->phone)
                                            <div class="flex items-center">
                                                <i class="fas fa-phone text-gray-400 mr-2"></i>
                                                <a href="tel:{{ $rt->phone }}"
                                                    class="text-blue-600 hover:text-blue-800 font-medium">
                                                    {{ $rt->phone }}
                                                </a>
                                                <button onclick="copyToClipboard('{{ $rt->phone }}')"
                                                    class="ml-2 text-gray-400 hover:text-gray-600" title="Salin nomor">
                                                    <i class="far fa-copy"></i>
                                                </button>
                                            </div>
                                        @else
                                            <span class="text-gray-400">-</span>
                                        @endif
                                    </dd>
                                </div>
                                <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                    <dt class="text-sm font-medium text-gray-500">
                                        Status Data
                                    </dt>
                                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                        @if ($rt->leader_name && $rt->phone)
                                            <span
                                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                <i class="fas fa-check-circle text-green-400 mr-1.5 text-xs"></i>
                                                Lengkap
                                            </span>
                                            <span class="ml-2 text-sm text-gray-500">Semua informasi sudah terisi</span>
                                        @else
                                            <span
                                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                                <i class="fas fa-exclamation-circle text-yellow-400 mr-1.5 text-xs"></i>
                                                Belum Lengkap
                                            </span>
                                            <span class="ml-2 text-sm text-gray-500">Beberapa informasi belum terisi</span>
                                        @endif
                                    </dd>
                                </div>
                                <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                    <dt class="text-sm font-medium text-gray-500">
                                        Tanggal Dibuat
                                    </dt>
                                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                        {{ $rt->created_at->format('d F Y, H:i') }}
                                    </dd>
                                </div>
                                <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                    <dt class="text-sm font-medium text-gray-500">
                                        Terakhir Diperbarui
                                    </dt>
                                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                        {{ $rt->updated_at->format('d F Y, H:i') }}
                                    </dd>
                                </div>
                            </dl>
                        </div>
                    </div>

                    <!-- Daftar Warga -->
                    <div class="mt-8 bg-white shadow overflow-hidden sm:rounded-lg">
                        <div class="px-4 py-5 sm:px-6 border-b border-gray-200">
                            <div class="flex justify-between items-center">
                                <div>
                                    <h3 class="text-lg leading-6 font-medium text-gray-900">
                                        Daftar Warga
                                    </h3>
                                    <p class="mt-1 max-w-2xl text-sm text-gray-500">
                                        Warga yang terdaftar di {{ $rt->name }}
                                    </p>
                                </div>
                                <div>
                                    <a href="{{ route('admin.residents.create') }}?rt_id={{ $rt->id }}"
                                        class="inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                        <i class="fas fa-plus mr-1 text-xs"></i>
                                        Tambah Warga
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="overflow-x-auto">
                            @if ($rt->residents->count() > 0)
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th scope="col"
                                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Nama
                                            </th>
                                            <th scope="col"
                                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                NIK
                                            </th>
                                            <th scope="col"
                                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                No. HP
                                            </th>
                                            <th scope="col"
                                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Alamat
                                            </th>
                                            <th scope="col"
                                                class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Aksi
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        @foreach ($rt->residents as $resident)
                                            <tr class="hover:bg-gray-50">
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="text-sm font-medium text-gray-900">
                                                        {{ $resident->name }}
                                                    </div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="text-sm text-gray-900">
                                                        {{ $resident->nik ?? '-' }}
                                                    </div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="text-sm text-gray-900">
                                                        {{ $resident->phone ?? '-' }}
                                                    </div>
                                                </td>
                                                <td class="px-6 py-4">
                                                    <div class="text-sm text-gray-900">
                                                        {{ Str::limit($resident->address ?? '-', 30) }}
                                                    </div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                    <a href="{{ route('admin.residents.show', $resident) }}"
                                                        class="text-blue-600 hover:text-blue-900" title="Lihat Detail">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @else
                                <div class="px-6 py-12 text-center">
                                    <i class="fas fa-users mx-auto text-4xl text-gray-400 mb-4"></i>
                                    <h3 class="mt-2 text-sm font-medium text-gray-900">Belum ada warga</h3>
                                    <p class="mt-1 text-sm text-gray-500">
                                        Mulai dengan menambahkan warga baru di RT ini.
                                    </p>
                                    <div class="mt-6">
                                        <a href="{{ route('admin.residents.create') }}?rt_id={{ $rt->id }}"
                                            class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                            <i class="fas fa-plus mr-2"></i>
                                            Tambah Warga Pertama
                                        </a>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Right Column: Aksi Cepat -->
                <div class="lg:col-span-1">
                    <!-- Aksi Cepat -->
                    <div class="bg-white shadow overflow-hidden sm:rounded-lg mb-8">
                        <div class="px-4 py-5 sm:px-6 border-b border-gray-200">
                            <h3 class="text-lg leading-6 font-medium text-gray-900">
                                Aksi Cepat
                            </h3>
                        </div>
                        <div class="p-4 space-y-4">
                            <a href="{{ route('admin.rts.edit', $rt) }}"
                                class="w-full flex items-center justify-between px-4 py-3 border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors">
                                <div class="flex items-center">
                                    <i class="fas fa-edit text-yellow-500 mr-3"></i>
                                    <span class="text-sm font-medium text-gray-700">Edit RT</span>
                                </div>
                                <i class="fas fa-chevron-right text-gray-400"></i>
                            </a>

                            <a href="{{ route('admin.residents.create') }}?rt_id={{ $rt->id }}"
                                class="w-full flex items-center justify-between px-4 py-3 border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors">
                                <div class="flex items-center">
                                    <i class="fas fa-plus text-blue-500 mr-3"></i>
                                    <span class="text-sm font-medium text-gray-700">Tambah Warga</span>
                                </div>
                                <i class="fas fa-chevron-right text-gray-400"></i>
                            </a>

                            @if ($rt->rw)
                                <a href="{{ route('admin.rws.show', $rt->rw) }}"
                                    class="w-full flex items-center justify-between px-4 py-3 border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors">
                                    <div class="flex items-center">
                                        <i class="fas fa-arrow-left text-green-500 mr-3"></i>
                                        <span class="text-sm font-medium text-gray-700">Lihat RW Induk</span>
                                    </div>
                                    <i class="fas fa-chevron-right text-gray-400"></i>
                                </a>
                            @endif

                            <a href="{{ route('admin.rts.index') }}"
                                class="w-full flex items-center justify-between px-4 py-3 border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors">
                                <div class="flex items-center">
                                    <i class="fas fa-list text-gray-500 mr-3"></i>
                                    <span class="text-sm font-medium text-gray-700">Kembali ke Daftar</span>
                                </div>
                                <i class="fas fa-chevron-right text-gray-400"></i>
                            </a>
                        </div>
                    </div>

                    <!-- Informasi Status -->
                    <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                        <div class="px-4 py-5 sm:px-6 border-b border-gray-200">
                            <h3 class="text-lg leading-6 font-medium text-gray-900">
                                Status Sistem
                            </h3>
                        </div>
                        <div class="p-4">
                            <div class="space-y-4">
                                <div>
                                    <div class="flex items-center justify-between mb-1">
                                        <span class="text-sm font-medium text-gray-700">Ketua RT</span>
                                        <span
                                            class="text-sm font-medium {{ $rt->leader_name ? 'text-green-600' : 'text-yellow-600' }}">
                                            {{ $rt->leader_name ? 'Ada' : 'Belum' }}
                                        </span>
                                    </div>
                                    <div class="w-full bg-gray-200 rounded-full h-2">
                                        <div class="{{ $rt->leader_name ? 'bg-green-600' : 'bg-yellow-400' }} h-2 rounded-full"
                                            style="width: {{ $rt->leader_name ? '100%' : '50%' }}"></div>
                                    </div>
                                </div>

                                <div>
                                    <div class="flex items-center justify-between mb-1">
                                        <span class="text-sm font-medium text-gray-700">Kontak</span>
                                        <span
                                            class="text-sm font-medium {{ $rt->phone ? 'text-green-600' : 'text-yellow-600' }}">
                                            {{ $rt->phone ? 'Tersedia' : 'Tidak Ada' }}
                                        </span>
                                    </div>
                                    <div class="w-full bg-gray-200 rounded-full h-2">
                                        <div class="{{ $rt->phone ? 'bg-green-600' : 'bg-yellow-400' }} h-2 rounded-full"
                                            style="width: {{ $rt->phone ? '100%' : '50%' }}"></div>
                                    </div>
                                </div>

                                <div>
                                    <div class="flex items-center justify-between mb-1">
                                        <span class="text-sm font-medium text-gray-700">Data Warga</span>
                                        <span
                                            class="text-sm font-medium {{ $rt->residents_count > 0 ? 'text-green-600' : 'text-yellow-600' }}">
                                            {{ $rt->residents_count > 0 ? 'Ada' : 'Belum Ada' }}
                                        </span>
                                    </div>
                                    <div class="w-full bg-gray-200 rounded-full h-2">
                                        <div class="{{ $rt->residents_count > 0 ? 'bg-green-600' : 'bg-yellow-400' }} h-2 rounded-full"
                                            style="width: {{ $rt->residents_count > 0 ? '100%' : '50%' }}"></div>
                                    </div>
                                </div>

                                <div class="pt-4 border-t border-gray-200">
                                    <div class="flex items-center justify-between">
                                        <span class="text-sm font-medium text-gray-900">Status Keseluruhan</span>
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium 
                                        {{ $rt->leader_name && $rt->phone && $rt->residents_count > 0 ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                            <i
                                                class="fas fa-{{ $rt->leader_name && $rt->phone && $rt->residents_count > 0 ? 'check-circle' : 'exclamation-triangle' }} mr-1 text-xs"></i>
                                            {{ $rt->leader_name && $rt->phone && $rt->residents_count > 0 ? 'Optimal' : 'Perlu Perhatian' }}
                                        </span>
                                    </div>
                                    <p class="mt-2 text-sm text-gray-500">
                                        @if ($rt->leader_name && $rt->phone && $rt->residents_count > 0)
                                            Semua data RT sudah lengkap dan optimal.
                                        @else
                                            Beberapa data masih perlu dilengkapi untuk optimalisasi.
                                        @endif
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        function copyToClipboard(text) {
            navigator.clipboard.writeText(text).then(function() {
                const toast = document.createElement('div');
                toast.className = 'fixed top-4 right-4 bg-green-500 text-white px-4 py-2 rounded-lg shadow-lg z-50';
                toast.textContent = 'Nomor berhasil disalin!';
                document.body.appendChild(toast);

                setTimeout(() => {
                    toast.remove();
                }, 2000);
            }).catch(function(err) {
                console.error('Gagal menyalin: ', err);
            });
        }
    </script>
@endpush
