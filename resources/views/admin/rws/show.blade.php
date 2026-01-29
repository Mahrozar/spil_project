@extends('layouts.app')

@section('title', $rw->name . ' - Detail RW')

@section('content')
<div class="admin-content-area">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
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
                    <a href="{{ route('admin.rws.index') }}" class="text-gray-400 hover:text-gray-600">
                        Daftar RW
                    </a>
                </li>
                <li class="flex items-center">
                    <i class="fas fa-chevron-right text-gray-400 text-xs mx-2"></i>
                    <span class="text-gray-600 font-medium">{{ $rw->name }}</span>
                </li>
            </ol>
        </nav>

        <!-- Header -->
        <div class="md:flex md:items-center md:justify-between mb-8">
            <div class="flex-1 min-w-0">
                <div class="flex items-center">
                    <div class="flex-shrink-0 h-14 w-14 flex items-center justify-center bg-blue-100 rounded-xl mr-4">
                        <span class="text-blue-600 font-bold text-xl">{{ substr($rw->name, 3) }}</span>
                    </div>
                    <div>
                        <h1 class="text-3xl font-bold text-gray-900">
                            {{ $rw->name }}
                        </h1>
                        <div class="mt-1 flex flex-wrap items-center gap-2">
                            @if($rw->ketua_rw)
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                                <i class="fas fa-circle text-green-400 text-xs mr-1.5"></i>
                                Ketua: {{ $rw->ketua_rw }}
                            </span>
                            @endif
                            <span class="text-sm text-gray-500">
                                <i class="far fa-calendar-alt mr-1"></i>
                                Dibuat: {{ $rw->created_at->format('d M Y') }}
                            </span>
                            <span class="text-sm text-gray-500">
                                <i class="fas fa-sync-alt mr-1"></i>
                                Diperbarui: {{ $rw->updated_at->format('d M Y') }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-4 flex md:mt-0 space-x-3">
                <a href="{{ route('admin.rws.edit', $rw) }}" 
                   class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    <i class="fas fa-edit text-gray-400 mr-2"></i>
                    Edit RW
                </a>
                <a href="{{ route('admin.rws.index') }}" 
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
                            <i class="fas fa-home text-blue-400 text-xl"></i>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-medium text-gray-500 truncate">
                                    Jumlah RT
                                </dt>
                                <dd class="text-lg font-medium text-gray-900">
                                    {{ $rw->rts_count ?? 0 }}
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
                            <i class="fas fa-users text-green-400 text-xl"></i>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-medium text-gray-500 truncate">
                                    Jumlah Warga
                                </dt>
                                <dd class="text-lg font-medium text-gray-900">
                                    {{ $rw->residents_count ?? 0 }}
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
                                    Ketua RW
                                </dt>
                                <dd class="text-lg font-medium text-gray-900 truncate">
                                    {{ $rw->ketua_rw ?: '-' }}
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
                                    @if($rw->no_hp_ketua_rw)
                                        <a href="tel:{{ $rw->no_hp_ketua_rw }}" class="text-blue-600 hover:text-blue-800">
                                            {{ $rw->no_hp_ketua_rw }}
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
                            Informasi Detail RW
                        </h3>
                        <p class="mt-1 max-w-2xl text-sm text-gray-500">
                            Informasi lengkap tentang Rukun Warga {{ $rw->name }}
                        </p>
                    </div>
                    <div class="border-t border-gray-200">
                        <dl>
                            <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                <dt class="text-sm font-medium text-gray-500">
                                    ID Database
                                </dt>
                                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                    #{{ str_pad($rw->id, 3, '0', STR_PAD_LEFT) }}
                                </dd>
                            </div>
                            <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                <dt class="text-sm font-medium text-gray-500">
                                    Nama RW
                                </dt>
                                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2 font-medium">
                                    {{ $rw->name }}
                                </dd>
                            </div>
                            <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                <dt class="text-sm font-medium text-gray-500">
                                    Ketua RW
                                </dt>
                                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                    @if($rw->ketua_rw)
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                            {{ $rw->ketua_rw }}
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                            Belum Ditentukan
                                        </span>
                                    @endif
                                </dd>
                            </div>
                            <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                <dt class="text-sm font-medium text-gray-500">
                                    No. HP Ketua RW
                                </dt>
                                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                    @if($rw->no_hp_ketua_rw)
                                        <div class="flex items-center">
                                            <i class="fas fa-phone text-gray-400 mr-2"></i>
                                            <a href="tel:{{ $rw->no_hp_ketua_rw }}" class="text-blue-600 hover:text-blue-800 font-medium">
                                                {{ $rw->no_hp_ketua_rw }}
                                            </a>
                                            <button onclick="copyToClipboard('{{ $rw->no_hp_ketua_rw }}')" 
                                                    class="ml-2 text-gray-400 hover:text-gray-600"
                                                    title="Salin nomor">
                                                <i class="far fa-copy"></i>
                                            </button>
                                        </div>
                                    @else
                                        <span class="text-gray-400">-</span>
                                    @endif
                                </dd>
                            </div>
                            <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                <dt class="text-sm font-medium text-gray-500">
                                    Status Data
                                </dt>
                                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                    @if($rw->ketua_rw && $rw->no_hp_ketua_rw)
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                            <i class="fas fa-check-circle text-green-400 mr-1.5 text-xs"></i>
                                            Lengkap
                                        </span>
                                        <span class="ml-2 text-sm text-gray-500">Semua informasi sudah terisi</span>
                                    @else
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                            <i class="fas fa-exclamation-circle text-yellow-400 mr-1.5 text-xs"></i>
                                            Belum Lengkap
                                        </span>
                                        <span class="ml-2 text-sm text-gray-500">Beberapa informasi belum terisi</span>
                                    @endif
                                </dd>
                            </div>
                            <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                <dt class="text-sm font-medium text-gray-500">
                                    Tanggal Dibuat
                                </dt>
                                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                    {{ $rw->created_at->format('d F Y, H:i') }}
                                </dd>
                            </div>
                            <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                <dt class="text-sm font-medium text-gray-500">
                                    Terakhir Diperbarui
                                </dt>
                                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                    {{ $rw->updated_at->format('d F Y, H:i') }}
                                </dd>
                            </div>
                        </dl>
                    </div>
                </div>

                <!-- Daftar RT -->
                <div class="mt-8 bg-white shadow overflow-hidden sm:rounded-lg">
                    <div class="px-4 py-5 sm:px-6 border-b border-gray-200">
                        <div class="flex justify-between items-center">
                            <div>
                                <h3 class="text-lg leading-6 font-medium text-gray-900">
                                    Daftar RT
                                </h3>
                                <p class="mt-1 max-w-2xl text-sm text-gray-500">
                                    Rukun Tetangga di bawah {{ $rw->name }}
                                </p>
                            </div>
                            <div>
                                <a href="{{ route('admin.rts.create') }}?rw_id={{ $rw->id }}" 
                                   class="inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                    <i class="fas fa-plus mr-1 text-xs"></i>
                                    Tambah RT
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="overflow-x-auto">
                        @if($rw->rts->count() > 0)
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        RT
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Ketua RT
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Jumlah Warga
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Status
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Aksi
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($rw->rts as $rt)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-8 w-8 flex items-center justify-center bg-blue-100 rounded-lg">
                                                <span class="text-blue-600 font-bold text-sm">{{ substr($rt->name, 2) }}</span>
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">
                                                    <a href="{{ route('admin.rts.show', $rt) }}" class="hover:text-blue-600">
                                                        {{ $rt->name }}
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">
                                            {{ $rt->leader_name ?? '-' }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">
                                            {{ $rt->residents_count ?? 0 }} warga
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if($rt->leader_name)
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                            <i class="fas fa-check-circle text-green-400 mr-1 text-xs"></i>
                                            Aktif
                                        </span>
                                        @else
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                            <i class="fas fa-exclamation-circle text-yellow-400 mr-1 text-xs"></i>
                                            Tidak Aktif
                                        </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <div class="flex items-center justify-end space-x-2">
                                            <a href="{{ route('admin.rts.show', $rt) }}" 
                                               class="text-blue-600 hover:text-blue-900"
                                               title="Lihat Detail">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('admin.rts.edit', $rt) }}" 
                                               class="text-yellow-600 hover:text-yellow-900"
                                               title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @else
                        <div class="px-6 py-12 text-center">
                            <i class="fas fa-home mx-auto text-4xl text-gray-400 mb-4"></i>
                            <h3 class="mt-2 text-sm font-medium text-gray-900">Belum ada RT</h3>
                            <p class="mt-1 text-sm text-gray-500">
                                Mulai dengan menambahkan RT baru di bawah RW ini.
                            </p>
                            <div class="mt-6">
                                <a href="{{ route('admin.rts.create') }}?rw_id={{ $rw->id }}" 
                                   class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                    <i class="fas fa-plus mr-2"></i>
                                    Tambah RT Pertama
                                </a>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Right Column: Aksi Cepat & QR Code -->
            <div class="lg:col-span-1">
                <!-- Aksi Cepat -->
                <div class="bg-white shadow overflow-hidden sm:rounded-lg mb-8">
                    <div class="px-4 py-5 sm:px-6 border-b border-gray-200">
                        <h3 class="text-lg leading-6 font-medium text-gray-900">
                            Aksi Cepat
                        </h3>
                    </div>
                    <div class="p-4 space-y-4">
                        <a href="{{ route('admin.rws.edit', $rw) }}" 
                           class="w-full flex items-center justify-between px-4 py-3 border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors">
                            <div class="flex items-center">
                                <i class="fas fa-edit text-yellow-500 mr-3"></i>
                                <span class="text-sm font-medium text-gray-700">Edit RW</span>
                            </div>
                            <i class="fas fa-chevron-right text-gray-400"></i>
                        </a>
                        
                        <a href="{{ route('admin.rts.create') }}?rw_id={{ $rw->id }}" 
                           class="w-full flex items-center justify-between px-4 py-3 border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors">
                            <div class="flex items-center">
                                <i class="fas fa-plus text-green-500 mr-3"></i>
                                <span class="text-sm font-medium text-gray-700">Tambah RT Baru</span>
                            </div>
                            <i class="fas fa-chevron-right text-gray-400"></i>
                        </a>
                        
                        <a href="{{ route('admin.residents.create') }}?rw_id={{ $rw->id }}" 
                           class="w-full flex items-center justify-between px-4 py-3 border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors">
                            <div class="flex items-center">
                                <i class="fas fa-user-plus text-blue-500 mr-3"></i>
                                <span class="text-sm font-medium text-gray-700">Tambah Warga</span>
                            </div>
                            <i class="fas fa-chevron-right text-gray-400"></i>
                        </a>
                        
                        <a href="{{ route('admin.rws.index') }}" 
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
                                    <span class="text-sm font-medium text-gray-700">Data RT</span>
                                    <span class="text-sm font-medium {{ $rw->rts_count > 0 ? 'text-green-600' : 'text-yellow-600' }}">
                                        {{ $rw->rts_count > 0 ? 'Ada' : 'Belum Ada' }}
                                    </span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-2">
                                    <div class="bg-green-600 h-2 rounded-full" style="width: {{ min(100, $rw->rts_count * 20) }}%"></div>
                                </div>
                            </div>
                            
                            <div>
                                <div class="flex items-center justify-between mb-1">
                                    <span class="text-sm font-medium text-gray-700">Data Ketua</span>
                                    <span class="text-sm font-medium {{ $rw->ketua_rw ? 'text-green-600' : 'text-yellow-600' }}">
                                        {{ $rw->ketua_rw ? 'Lengkap' : 'Belum' }}
                                    </span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-2">
                                    <div class="{{ $rw->ketua_rw ? 'bg-green-600' : 'bg-yellow-400' }} h-2 rounded-full" style="width: {{ $rw->ketua_rw ? '100%' : '50%' }}"></div>
                                </div>
                            </div>
                            
                            <div>
                                <div class="flex items-center justify-between mb-1">
                                    <span class="text-sm font-medium text-gray-700">Kontak</span>
                                    <span class="text-sm font-medium {{ $rw->no_hp_ketua_rw ? 'text-green-600' : 'text-yellow-600' }}">
                                        {{ $rw->no_hp_ketua_rw ? 'Tersedia' : 'Tidak Ada' }}
                                    </span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-2">
                                    <div class="{{ $rw->no_hp_ketua_rw ? 'bg-green-600' : 'bg-yellow-400' }} h-2 rounded-full" style="width: {{ $rw->no_hp_ketua_rw ? '100%' : '50%' }}"></div>
                                </div>
                            </div>
                            
                            <div class="pt-4 border-t border-gray-200">
                                <div class="flex items-center justify-between">
                                    <span class="text-sm font-medium text-gray-900">Status Keseluruhan</span>
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium 
                                        {{ $rw->ketua_rw && $rw->no_hp_ketua_rw && $rw->rts_count > 0 ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                        <i class="fas fa-{{ $rw->ketua_rw && $rw->no_hp_ketua_rw && $rw->rts_count > 0 ? 'check-circle' : 'exclamation-triangle' }} mr-1 text-xs"></i>
                                        {{ $rw->ketua_rw && $rw->no_hp_ketua_rw && $rw->rts_count > 0 ? 'Optimal' : 'Perlu Perhatian' }}
                                    </span>
                                </div>
                                <p class="mt-2 text-sm text-gray-500">
                                    @if($rw->ketua_rw && $rw->no_hp_ketua_rw && $rw->rts_count > 0)
                                    Semua data RW sudah lengkap dan optimal.
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
            // Show success message
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

    // Print functionality
    function printRW() {
        window.print();
    }

    // Export data
    function exportData() {
        // Implement export functionality here
        alert('Fitur ekspor data akan segera hadir!');
    }
</script>
@endpush