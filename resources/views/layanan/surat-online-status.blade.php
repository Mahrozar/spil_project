@extends('layouts.app')

@section('title', 'Cek Status Pengajuan - Desa Cicangkang Hilir')

@push('styles')
<style>
    .status-card {
        transition: all 0.3s ease;
        border-left: 4px solid transparent;
    }
    
    .status-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
    }
    
    .status-pending {
        border-left-color: #f59e0b;
    }
    
    .status-process {
        border-left-color: #3b82f6;
    }
    
    .status-approved {
        border-left-color: #10b981;
    }
    
    .status-rejected {
        border-left-color: #ef4444;
    }
    
    .status-completed {
        border-left-color: #8b5cf6;
    }
    
    .status-badge {
        padding: 0.25rem 0.75rem;
        border-radius: 9999px;
        font-size: 0.75rem;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
    }
    
    .badge-pending {
        background-color: #fef3c7;
        color: #92400e;
    }
    
    .badge-process {
        background-color: #dbeafe;
        color: #1e40af;
    }
    
    .badge-approved {
        background-color: #d1fae5;
        color: #065f46;
    }
    
    .badge-rejected {
        background-color: #fee2e2;
        color: #991b1b;
    }
    
    .badge-completed {
        background-color: #ede9fe;
        color: #5b21b6;
    }
    
    .timeline {
        position: relative;
        padding-left: 2rem;
    }
    
    .timeline:before {
        content: '';
        position: absolute;
        left: 0.75rem;
        top: 0;
        bottom: 0;
        width: 2px;
        background: #e5e7eb;
    }
    
    .timeline-item {
        position: relative;
        margin-bottom: 1.5rem;
    }
    
    .timeline-item:last-child {
        margin-bottom: 0;
    }
    
    .timeline-item:before {
        content: '';
        position: absolute;
        left: -1.95rem;
        top: 0.25rem;
        width: 1rem;
        height: 1rem;
        border-radius: 50%;
        background: #9ca3af;
        border: 3px solid white;
    }
    
    .timeline-item.active:before {
        background: #1e40af;
        box-shadow: 0 0 0 3px rgba(30, 64, 175, 0.2);
    }
    
    .timeline-item.completed:before {
        background: #10b981;
    }
</style>
@endpush

@section('content')
<div class="pt-24 pb-12">
    <!-- Hero Section -->
    <div class="bg-gradient-to-r from-primary to-secondary">
        <div class="container mx-auto px-6 py-12">
            <div class="text-center text-white">
                <h1 class="text-3xl md:text-4xl font-bold mb-4">Cek Status Pengajuan Surat</h1>
                <p class="text-xl opacity-90 max-w-3xl mx-auto">
                    Pantau perkembangan pengajuan surat Anda secara real-time
                </p>
            </div>
        </div>
    </div>

    <!-- Breadcrumb -->
    <div class="container mx-auto px-6 py-4">
        <nav class="flex" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                <li class="inline-flex items-center">
                    <a href="{{ route('landing-page') }}" class="inline-flex items-center text-sm text-gray-700 hover:text-primary">
                        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path>
                        </svg>
                        Beranda
                    </a>
                </li>
                <li>
                    <div class="flex items-center">
                        <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        <a href="#" class="ml-1 text-sm text-gray-700 hover:text-primary md:ml-2">Layanan</a>
                    </div>
                </li>
                <li aria-current="page">
                    <div class="flex items-center">
                        <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        <span class="ml-1 text-sm text-primary font-medium md:ml-2">Cek Status Pengajuan</span>
                    </div>
                </li>
            </ol>
        </nav>
    </div>

    <!-- Main Content -->
    <div class="container mx-auto px-6 py-8">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Left Column - Form Cek Status -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-xl shadow-lg p-6 md:p-8 mb-8">
                    <!-- Header -->
                    <div class="text-center mb-8">
                        <div class="inline-flex items-center justify-center w-16 h-16 bg-primary/10 text-primary rounded-full mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                            </svg>
                        </div>
                        <h2 class="text-2xl font-bold text-gray-800 mb-2">Cek Status Pengajuan</h2>
                        <p class="text-gray-600">Masukkan nomor pengajuan dan NIK Anda</p>
                    </div>

                    <!-- Form Cek Status -->
                    <form action="{{ route('layanan.surat-online-status') }}" method="POST" class="space-y-6">
                        @csrf
                        
                        <!-- Nomor Pengajuan -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Nomor Pengajuan <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                </div>
                                <input type="text" 
                                       name="submission_number" 
                                       value="{{ old('submission_number', session('submission_number')) }}"
                                       placeholder="Contoh: SUB-20231215-0001" 
                                       required
                                       class="pl-10 w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent">
                            </div>
                            <p class="mt-1 text-xs text-gray-500">
                                Nomor pengajuan dikirim via WhatsApp/Email saat mendaftar
                            </p>
                        </div>

                        <!-- NIK -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                NIK (Nomor Induk Kependudukan) <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                </div>
                                <input type="text" 
                                       name="nik" 
                                       value="{{ old('nik', session('nik')) }}"
                                       placeholder="16 digit NIK" 
                                       required
                                       maxlength="16"
                                       class="pl-10 w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent">
                            </div>
                            <p class="mt-1 text-xs text-gray-500">
                                NIK yang digunakan saat mengajukan surat
                            </p>
                        </div>

                        <!-- Submit Button -->
                        <div class="pt-4">
                            <button type="submit" 
                                    class="w-full bg-gradient-to-r from-primary to-secondary text-white font-bold py-4 px-6 rounded-lg hover:opacity-90 focus:ring-4 focus:ring-primary/20 transition duration-300 shadow-lg">
                                <div class="flex items-center justify-center">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                    </svg>
                                    Cek Status
                                </div>
                            </button>
                        </div>
                    </form>

                    <!-- Error Message -->
                    @if(session('error'))
                        <div class="mt-6 p-4 bg-red-50 text-red-700 rounded-lg border border-red-200">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.998-.833-2.732 0L4.732 16.5c-.77.833.192 2.5 1.732 2.5z" />
                                </svg>
                                {{ session('error') }}
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Hasil Pencarian -->
                @if(isset($submission))
                <div class="bg-white rounded-xl shadow-lg p-6 md:p-8">
                    <h3 class="text-xl font-bold text-gray-800 mb-6">Detail Pengajuan</h3>
                    
                    <!-- Status Card -->
                    <div class="status-card bg-white border border-gray-200 rounded-lg p-6 mb-8 status-{{ $submission->status }}">
                        <div class="flex flex-col md:flex-row md:items-center justify-between mb-4">
                            <div>
                                <h4 class="text-lg font-bold text-gray-800">{{ $submission->nama }}</h4>
                                <p class="text-gray-600">Nomor: <span class="font-medium">{{ $submission->submission_number }}</span></p>
                            </div>
                            <div class="mt-2 md:mt-0">
                                @php
                                    $statusColors = [
                                        'pending' => 'badge-pending',
                                        'process' => 'badge-process',
                                        'approved' => 'badge-approved',
                                        'rejected' => 'badge-rejected',
                                        'completed' => 'badge-completed',
                                    ];
                                    
                                    $statusLabels = [
                                        'pending' => 'Menunggu',
                                        'process' => 'Diproses',
                                        'approved' => 'Disetujui',
                                        'rejected' => 'Ditolak',
                                        'completed' => 'Selesai',
                                    ];
                                @endphp
                                <span class="status-badge {{ $statusColors[$submission->status] ?? 'badge-pending' }}">
                                    {{ $statusLabels[$submission->status] ?? 'Menunggu' }}
                                </span>
                            </div>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <p class="text-sm text-gray-500">Jenis Surat</p>
                                <p class="font-medium">{{ $submission->jenis_surat }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Tanggal Pengajuan</p>
                                <p class="font-medium">{{ \Carbon\Carbon::parse($submission->submitted_at)->format('d F Y H:i') }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">NIK</p>
                                <p class="font-medium">{{ $submission->nik }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Kontak</p>
                                <p class="font-medium">{{ $submission->telepon }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Timeline Progress -->
                    <div class="mb-8">
                        <h4 class="text-lg font-bold text-gray-800 mb-4">Status Proses</h4>
                        <div class="timeline">
                            <!-- Step 1: Submitted -->
                            <div class="timeline-item {{ $submission->status != 'pending' ? 'completed' : 'active' }}">
                                <div class="flex flex-col">
                                    <span class="font-medium text-gray-800">Pengajuan Diterima</span>
                                    <span class="text-sm text-gray-500">
                                        {{ \Carbon\Carbon::parse($submission->submitted_at)->format('d F Y, H:i') }}
                                    </span>
                                    @if($submission->status != 'pending')
                                    <span class="text-xs text-green-600 mt-1">
                                        ✓ Selesai
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <!-- Step 2: Verification -->
                            <div class="timeline-item {{ in_array($submission->status, ['process', 'approved', 'rejected', 'completed']) ? 'completed' : ($submission->status == 'pending' ? 'active' : '') }}">
                                <div class="flex flex-col">
                                    <span class="font-medium text-gray-800">Verifikasi Data</span>
                                    <span class="text-sm text-gray-500">
                                        @if($submission->processed_at)
                                            {{ \Carbon\Carbon::parse($submission->processed_at)->format('d F Y, H:i') }}
                                        @else
                                            Menunggu verifikasi
                                        @endif
                                    </span>
                                    @if(in_array($submission->status, ['process', 'approved', 'rejected', 'completed']))
                                    <span class="text-xs text-green-600 mt-1">
                                        ✓ Data diverifikasi
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <!-- Step 3: Processing -->
                            <div class="timeline-item {{ in_array($submission->status, ['approved', 'rejected', 'completed']) ? 'completed' : ($submission->status == 'process' ? 'active' : '') }}">
                                <div class="flex flex-col">
                                    <span class="font-medium text-gray-800">Proses Administrasi</span>
                                    <span class="text-sm text-gray-500">
                                        @if($submission->status == 'process')
                                            Sedang diproses
                                        @elseif(in_array($submission->status, ['approved', 'rejected', 'completed']))
                                            Selesai diproses
                                        @else
                                            Menunggu verifikasi
                                        @endif
                                    </span>
                                </div>
                            </div>

                            <!-- Step 4: Completion -->
                            <div class="timeline-item {{ $submission->status == 'completed' ? 'completed active' : ($submission->status == 'rejected' ? 'active' : '') }}">
                                <div class="flex flex-col">
                                    @if($submission->status == 'completed')
                                        <span class="font-medium text-gray-800">Surat Selesai</span>
                                        <span class="text-sm text-gray-500">
                                            @if($submission->completed_at)
                                                {{ \Carbon\Carbon::parse($submission->completed_at)->format('d F Y, H:i') }}
                                            @else
                                                Selesai
                                            @endif
                                        </span>
                                        <span class="text-xs text-green-600 mt-1">
                                            ✓ Surat siap diambil
                                        </span>
                                    @elseif($submission->status == 'rejected')
                                        <span class="font-medium text-gray-800">Pengajuan Ditolak</span>
                                        <span class="text-sm text-gray-500">
                                            {{ \Carbon\Carbon::parse($submission->processed_at)->format('d F Y, H:i') }}
                                        </span>
                                        <span class="text-xs text-red-600 mt-1">
                                            ✗ Pengajuan ditolak
                                        </span>
                                    @else
                                        <span class="font-medium text-gray-800">Penandatanganan</span>
                                        <span class="text-sm text-gray-500">
                                            Menunggu proses sebelumnya
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Detail Pengajuan -->
                    <div class="bg-gray-50 rounded-lg p-6">
                        <h4 class="text-lg font-bold text-gray-800 mb-4">Keterangan Pengajuan</h4>
                        <div class="space-y-4">
                            <div>
                                <p class="text-sm text-gray-500 mb-1">Alasan / Keperluan</p>
                                <p class="text-gray-800">{{ $submission->keperluan }}</p>
                            </div>
                            
                            @if($submission->email)
                            <div>
                                <p class="text-sm text-gray-500 mb-1">Email</p>
                                <p class="text-gray-800">{{ $submission->email }}</p>
                            </div>
                            @endif
                            
                            @if($submission->admin_notes)
                            <div>
                                <p class="text-sm text-gray-500 mb-1">Catatan Admin</p>
                                <div class="bg-yellow-50 border border-yellow-100 rounded-lg p-4">
                                    <p class="text-yellow-800">{{ $submission->admin_notes }}</p>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="mt-8 flex flex-col sm:flex-row gap-4">
                        <a href="{{ route('layanan.surat-online') }}" 
                           class="flex-1 inline-flex justify-center items-center px-6 py-3 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition duration-300">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                            </svg>
                            Ajukan Surat Baru
                        </a>
                        
                        <button onclick="window.print()" 
                                class="flex-1 inline-flex justify-center items-center px-6 py-3 bg-white border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition duration-300">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
                            </svg>
                            Cetak Halaman
                        </button>
                    </div>
                </div>
                @endif
            </div>

            <!-- Right Column - Informasi -->
            <div class="space-y-6">
                <!-- Info Card 1 -->
                <div class="bg-white rounded-xl shadow p-6">
                    <div class="flex items-center mb-4">
                        <div class="bg-blue-100 text-blue-600 p-3 rounded-lg mr-4">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <h3 class="font-bold text-lg">Informasi Status</h3>
                    </div>
                    <div class="space-y-3">
                        <div class="flex items-center">
                            <span class="status-badge badge-pending mr-3">Menunggu</span>
                            <span class="text-sm text-gray-600">Pengajuan diterima</span>
                        </div>
                        <div class="flex items-center">
                            <span class="status-badge badge-process mr-3">Diproses</span>
                            <span class="text-sm text-gray-600">Sedang diverifikasi</span>
                        </div>
                        <div class="flex items-center">
                            <span class="status-badge badge-approved mr-3">Disetujui</span>
                            <span class="text-sm text-gray-600">Siap diproses</span>
                        </div>
                        <div class="flex items-center">
                            <span class="status-badge badge-completed mr-3">Selesai</span>
                            <span class="text-sm text-gray-600">Siap diambil</span>
                        </div>
                    </div>
                </div>

                <!-- Info Card 2 -->
                <div class="bg-white rounded-xl shadow p-6">
                    <div class="flex items-center mb-4">
                        <div class="bg-green-100 text-green-600 p-3 rounded-lg mr-4">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                            </svg>
                        </div>
                        <h3 class="font-bold text-lg">Keamanan Data</h3>
                    </div>
                    <p class="text-gray-600 text-sm">
                        Data pengajuan hanya dapat diakses dengan nomor pengajuan dan NIK yang valid.
                    </p>
                </div>

                <!-- Info Card 3 -->
                <div class="bg-white rounded-xl shadow p-6">
                    <div class="flex items-center mb-4">
                        <div class="bg-purple-100 text-purple-600 p-3 rounded-lg mr-4">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                        </div>
                        <h3 class="font-bold text-lg">Kontak Bantuan</h3>
                    </div>
                    <div class="space-y-2">
                        <p class="text-sm text-gray-600">
                            Untuk pertanyaan tentang status pengajuan:
                        </p>
                        <div class="flex items-center text-sm">
                            <svg class="w-4 h-4 text-gray-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                            </svg>
                            <span>0812-3456-7890</span>
                        </div>
                        <div class="flex items-center text-sm">
                            <svg class="w-4 h-4 text-gray-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                            <span>Kantor Desa Cicangkang Hilir</span>
                        </div>
                    </div>
                </div>

                <!-- Ajukan Surat Button -->
                <a href="{{ route('layanan.surat-online') }}" 
                   class="block bg-gradient-to-r from-primary to-secondary text-white font-bold py-4 px-6 rounded-xl hover:opacity-90 transition duration-300 shadow-lg text-center">
                    <div class="flex items-center justify-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                        </svg>
                        Ajukan Surat Baru
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Auto-format NIK input (only numbers)
        const nikInput = document.querySelector('input[name="nik"]');
        if (nikInput) {
            nikInput.addEventListener('input', function(e) {
                this.value = this.value.replace(/[^0-9]/g, '');
            });
        }

        // Auto-focus on submission number input if empty
        const submissionNumberInput = document.querySelector('input[name="submission_number"]');
        if (submissionNumberInput && !submissionNumberInput.value) {
            setTimeout(() => submissionNumberInput.focus(), 300);
        }

        // Form submission loading state
        const form = document.querySelector('form');
        if (form) {
            form.addEventListener('submit', function() {
                const submitBtn = this.querySelector('button[type="submit"]');
                if (submitBtn) {
                    submitBtn.innerHTML = `
                        <div class="flex items-center justify-center">
                            <svg class="animate-spin w-5 h-5 mr-2 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                            Mencari...
                        </div>
                    `;
                    submitBtn.disabled = true;
                }
            });
        }

        // Print page functionality
        const printBtn = document.querySelector('button[onclick="window.print()"]');
        if (printBtn) {
            printBtn.addEventListener('click', function() {
                // Show print dialog
                window.print();
            });
        }
    });
</script>
@endpush