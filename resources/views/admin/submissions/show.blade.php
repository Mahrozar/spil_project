@extends('layouts.app')

@section('title', 'Detail Pengajuan - ' . $submission->submission_number)
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
                <a href="{{ route('admin.submissions.index') }}" class="text-gray-400 hover:text-gray-600">
                    Pengajuan Surat
                </a>
            </li>
            <li class="flex items-center">
                <i class="fas fa-chevron-right text-gray-400 text-xs mx-2"></i>
                <span class="text-gray-600 font-medium">{{ $submission->submission_number }}</span>
            </li>
        </ol>
    </nav>

@endsection
@section('content')
    <div class="admin-content-area">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">


            <!-- Header -->
            <div class="mb-8">
                <h1 class="text-2xl font-bold text-gray-900 mb-2">
                    Detail Pengajuan Surat
                </h1>
                <p class="text-gray-600">
                    Nomor Pengajuan: <span class="font-semibold">{{ $submission->submission_number }}</span>
                </p>
            </div>

            <!-- Main Content -->
            <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                <div class="px-4 py-5 sm:px-6 border-b border-gray-200 bg-gray-50">
                    <div class="flex justify-between items-center">
                        <div>
                            <h3 class="text-lg font-medium text-gray-900">
                                Informasi Pengajuan
                            </h3>
                            <p class="mt-1 text-sm text-gray-500">
                                Detail lengkap pengajuan surat
                            </p>
                        </div>
                        <div>
                            <span
                                class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium {{ $submission->badgeClass() }}">
                                {{ $submission->statusLabel() }}
                            </span>
                        </div>
                    </div>
                </div>

                <div class="px-4 py-5 sm:p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Left Column -->
                        <div class="space-y-6">
                            <!-- Informasi Pribadi -->
                            <div class="bg-gray-50 p-4 rounded-lg">
                                <h4 class="text-sm font-medium text-gray-500 mb-3">INFORMASI PEMOHON</h4>
                                <div class="space-y-4">
                                    <div>
                                        <label class="block text-xs font-medium text-gray-500">Nama Lengkap</label>
                                        <p class="mt-1 text-sm font-medium text-gray-900">{{ $submission->nama }}</p>
                                    </div>

                                    <div class="grid grid-cols-2 gap-4">
                                        <div>
                                            <label class="block text-xs font-medium text-gray-500">NIK</label>
                                            <p class="mt-1 text-sm font-medium text-gray-900">{{ $submission->nik }}</p>
                                        </div>
                                        <div>
                                            <label class="block text-xs font-medium text-gray-500">Telepon</label>
                                            <p class="mt-1 text-sm font-medium text-gray-900">{{ $submission->telepon }}</p>
                                        </div>
                                    </div>

                                    <div>
                                        <label class="block text-xs font-medium text-gray-500">Alamat</label>
                                        <p class="mt-1 text-sm text-gray-900">{{ $submission->alamat }}</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Informasi Surat -->
                            <div class="bg-gray-50 p-4 rounded-lg">
                                <h4 class="text-sm font-medium text-gray-500 mb-3">INFORMASI SURAT</h4>
                                <div class="space-y-4">
                                    <div>
                                        <label class="block text-xs font-medium text-gray-500">Jenis Surat</label>
                                        <p class="mt-1 text-sm font-medium text-gray-900">{{ $submission->jenis_surat }}
                                        </p>
                                    </div>

                                    <div>
                                        <label class="block text-xs font-medium text-gray-500">Keperluan</label>
                                        <p class="mt-1 text-sm text-gray-900">{{ $submission->keperluan }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Right Column -->
                        <div class="space-y-6">
                            <!-- Status dan Timeline -->
                            <div class="bg-gray-50 p-4 rounded-lg">
                                <h4 class="text-sm font-medium text-gray-500 mb-3">STATUS & TIMELINE</h4>
                                <div class="space-y-4">
                                    <div>
                                        <label class="block text-xs font-medium text-gray-500">Status Saat Ini</label>
                                        <div class="mt-2 flex items-center">
                                            @php
                                                $statusColors = [
                                                    'pending' => 'bg-yellow-100 text-yellow-800',
                                                    'approved' => 'bg-green-100 text-green-800',
                                                    'rejected' => 'bg-red-100 text-red-800',
                                                    'in_progress' => 'bg-blue-100 text-blue-800',
                                                ];
                                                $color =
                                                    $statusColors[$submission->status] ?? 'bg-gray-100 text-gray-800';
                                            @endphp
                                            <span
                                                class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium {{ $color }}">
                                                <i class="fas fa-circle mr-2 text-xs"></i>
                                                {{ $submission->statusLabel() }}
                                            </span>
                                        </div>
                                    </div>

                                    <div>
                                        <label class="block text-xs font-medium text-gray-500">Tanggal Pengajuan</label>
                                        <p class="mt-1 text-sm text-gray-900">
                                            <i class="far fa-calendar-alt mr-2"></i>
                                            {{ $submission->created_at->format('d F Y') }}
                                        </p>
                                        <p class="text-xs text-gray-500 mt-1">
                                            {{ $submission->created_at->format('H:i:s') }}
                                        </p>
                                    </div>

                                    <div>
                                        <label class="block text-xs font-medium text-gray-500">Terakhir Diperbarui</label>
                                        <p class="mt-1 text-sm text-gray-900">
                                            <i class="far fa-clock mr-2"></i>
                                            {{ $submission->updated_at->format('d F Y H:i') }}
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <!-- Informasi Tambahan -->
                            <div class="bg-gray-50 p-4 rounded-lg">
                                <h4 class="text-sm font-medium text-gray-500 mb-3">INFORMASI TAMBAHAN</h4>
                                <div class="space-y-3">
                                    <div class="flex items-center">
                                        <div
                                            class="flex-shrink-0 h-10 w-10 flex items-center justify-center bg-blue-100 rounded-lg mr-3">
                                            <i class="fas fa-hashtag text-blue-600"></i>
                                        </div>
                                        <div>
                                            <label class="block text-xs font-medium text-gray-500">ID Pengajuan</label>
                                            <p class="text-sm font-medium text-gray-900">
                                                {{ $submission->submission_number }}</p>
                                        </div>
                                    </div>

                                    <div class="flex items-center">
                                        <div
                                            class="flex-shrink-0 h-10 w-10 flex items-center justify-center bg-purple-100 rounded-lg mr-3">
                                            <i class="fas fa-file-alt text-purple-600"></i>
                                        </div>
                                        <div>
                                            <label class="block text-xs font-medium text-gray-500">Jenis Surat</label>
                                            <p class="text-sm font-medium text-gray-900">{{ $submission->jenis_surat }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="mt-8 pt-6 border-t border-gray-200">
                        <div class="flex flex-wrap items-center justify-between gap-4">
                            <div class="flex items-center space-x-3">
                                <a href="{{ route('admin.submissions.index') }}"
                                    class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                    <i class="fas fa-arrow-left mr-2"></i>
                                    Kembali ke Daftar
                                </a>

                                <a href="{{ route('admin.submissions.edit', $submission) }}"
                                    class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-emerald-600 hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500">
                                    <i class="fas fa-edit mr-2"></i>
                                    Ubah Status
                                </a>
                            </div>

                            <div class="flex items-center space-x-3">
                                <button onclick="window.print()"
                                    class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                                    <i class="fas fa-print mr-2"></i>
                                    Cetak
                                </button>

                                <button onclick="shareSubmission()"
                                    class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                    <i class="fas fa-share-alt mr-2"></i>
                                    Bagikan
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Status Badge Legend -->
            <div class="mt-6 bg-white shadow rounded-lg p-6">
                <h4 class="text-sm font-medium text-gray-900 mb-4">Legenda Status</h4>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3">
                    <div class="flex items-center">
                        <span class="w-3 h-3 rounded-full bg-yellow-400 mr-2"></span>
                        <span class="text-sm text-gray-700">Menunggu</span>
                    </div>
                    <div class="flex items-center">
                        <span class="w-3 h-3 rounded-full bg-blue-400 mr-2"></span>
                        <span class="text-sm text-gray-700">Diproses</span>
                    </div>
                    <div class="flex items-center">
                        <span class="w-3 h-3 rounded-full bg-green-400 mr-2"></span>
                        <span class="text-sm text-gray-700">Disetujui</span>
                    </div>
                    <div class="flex items-center">
                        <span class="w-3 h-3 rounded-full bg-red-400 mr-2"></span>
                        <span class="text-sm text-gray-700">Ditolak</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        function shareSubmission() {
            if (navigator.share) {
                navigator.share({
                        title: 'Pengajuan Surat - {{ $submission->submission_number }}',
                        text: 'Detail pengajuan surat dari {{ $submission->nama }}',
                        url: window.location.href
                    })
                    .then(() => console.log('Berhasil dibagikan'))
                    .catch((error) => console.log('Error sharing:', error));
            } else {
                // Fallback untuk browser yang tidak mendukung Web Share API
                navigator.clipboard.writeText(window.location.href).then(() => {
                    alert('Link berhasil disalin ke clipboard!');
                }).catch(err => {
                    console.error('Gagal menyalin link:', err);
                });
            }
        }
    </script>

    <style>
        @media print {
            .admin-content-area {
                padding: 0 !important;
            }

            nav,
            .bg-gray-50,
            button {
                display: none !important;
            }

            .bg-white {
                box-shadow: none !important;
                border: 1px solid #e5e7eb !important;
            }

            .grid {
                display: block !important;
            }

            .md\\:grid-cols-2>* {
                margin-bottom: 20px;
            }
        }
    </style>
@endpush
