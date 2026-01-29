@extends('layouts.app')

@section('title', 'Ubah Pengajuan ' . $submission->submission_number)
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
                    Daftar Pengajuan
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
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-2xl font-bold text-gray-900">
                            Ubah Status Pengajuan
                        </h1>
                        <p class="mt-1 text-sm text-gray-500">
                            Mengubah status pengajuan surat {{ $submission->submission_number }}
                        </p>
                    </div>
                    <div class="flex items-center space-x-2">
                        <span
                            class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium 
                        @if ($submission->isApproved()) bg-green-100 text-green-800
                        @elseif($submission->isInProgress()) bg-yellow-100 text-yellow-800
                        @elseif($submission->isRejected()) bg-red-100 text-red-800
                        @else bg-gray-100 text-gray-800 @endif">
                            <i
                                class="fas fa-circle text-xs mr-1.5 
                            @if ($submission->isApproved()) text-green-400
                            @elseif($submission->isInProgress()) text-yellow-400
                            @elseif($submission->isRejected()) text-red-400
                            @else text-gray-400 @endif"></i>
                            {{ $submission->status }}
                        </span>
                    </div>
                </div>
            </div>

            <!-- Main Content -->
            <div class="bg-white shadow-lg rounded-xl overflow-hidden">
                <!-- Form Header -->
                <div class="px-6 py-5 bg-gradient-to-r from-blue-50 to-indigo-50 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-800">
                        <i class="fas fa-file-edit text-blue-600 mr-2"></i>
                        Form Perubahan Status
                    </h3>
                    <p class="mt-1 text-sm text-gray-600">
                        Perbarui status pengajuan surat sesuai dengan kondisi terkini
                    </p>
                </div>

                <!-- Form Content -->
                <div class="p-6">
                    <form method="POST" action="{{ route('admin.submissions.update', $submission) }}" class="space-y-6">
                        @csrf
                        @method('PUT')

                        <!-- Informasi Pengajuan -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                            <div>
                                <div class="flex items-center mb-2">
                                    <i class="fas fa-hashtag text-gray-400 mr-2"></i>
                                    <span class="text-sm font-medium text-gray-700">Nomor Pengajuan</span>
                                </div>
                                <div class="text-lg font-semibold text-blue-600">
                                    {{ $submission->submission_number }}
                                </div>
                            </div>

                            <div>
                                <div class="flex items-center mb-2">
                                    <i class="far fa-calendar text-gray-400 mr-2"></i>
                                    <span class="text-sm font-medium text-gray-700">Tanggal Pengajuan</span>
                                </div>
                                <div class="text-lg font-semibold text-gray-800">
                                    {{ $submission->created_at->format('d M Y') }}
                                </div>
                            </div>
                        </div>

                        <!-- Status Section -->
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">
                                    <i class="fas fa-exchange-alt text-blue-500 mr-1"></i>
                                    Ubah Status Pengajuan
                                </label>

                                <!-- Current Status -->
                                <div class="mb-4 p-4 bg-gray-50 rounded-lg border border-gray-200">
                                    <div class="flex items-center justify-between">
                                        <div>
                                            <span class="text-sm font-medium text-gray-600">Status Saat Ini:</span>
                                            <span
                                                class="ml-2 font-semibold 
                                            @if ($submission->isApproved()) text-green-600
                                            @elseif($submission->isInProgress()) text-yellow-600
                                            @elseif($submission->isRejected()) text-red-600
                                            @else text-gray-600 @endif">
                                                {{ $submission->status }}
                                            </span>
                                        </div>
                                        <div class="flex items-center">
                                            <span class="mr-2 text-sm text-gray-500">Ubah menjadi:</span>
                                            <i class="fas fa-arrow-right text-gray-400"></i>
                                        </div>
                                    </div>
                                </div>

                                <!-- Status Selector -->
                                <div class="relative">
                                    <select name="status"
                                        class="block w-full pl-10 pr-4 py-3 text-base border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 rounded-lg shadow-sm transition duration-150 ease-in-out">
                                        @foreach (\App\Models\LetterSubmission::allowedStatuses() as $st)
                                            <option value="{{ $st }}"
                                                {{ $submission->status === $st ? 'selected' : '' }} class="py-2">
                                                {{ $st }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i class="fas fa-flag text-gray-400"></i>
                                    </div>
                                </div>

                                <!-- Status Explanation -->
                                <div class="mt-3 text-sm text-gray-500">
                                    <i class="fas fa-info-circle text-blue-400 mr-1"></i>
                                    Pilih status baru untuk pengajuan ini. Status akan menentukan langkah selanjutnya.
                                </div>
                            </div>

                            <!-- Keperluan Section -->
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">
                                    <i class="fas fa-clipboard-list text-blue-500 mr-1"></i>
                                    Keperluan Surat
                                </label>
                                <div class="relative">
                                    <div class="absolute top-3 left-3 text-gray-400">
                                        <i class="fas fa-file-alt"></i>
                                    </div>
                                    <textarea class="mt-1 block w-full pl-10 pr-3 py-3 bg-gray-50 border border-gray-200 rounded-lg text-gray-700"
                                        rows="4" readonly>{{ $submission->keperluan }}</textarea>
                                </div>
                                <div class="mt-2 text-sm text-gray-500">
                                    <i class="fas fa-lock text-gray-400 mr-1"></i>
                                    Keperluan surat tidak dapat diubah. Untuk perubahan lainnya, hubungi pemohon.
                                </div>
                            </div>

                            <!-- Pemohon Info -->
                            @if ($submission->user)
                                <div class="bg-blue-50 border border-blue-100 rounded-lg p-4">
                                    <div class="flex items-center mb-3">
                                        <i class="fas fa-user text-blue-500 mr-2"></i>
                                        <h4 class="text-sm font-semibold text-blue-800">Informasi Pemohon</h4>
                                    </div>
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <div>
                                            <span class="text-xs text-blue-600 font-medium">Nama:</span>
                                            <p class="text-sm text-gray-800">{{ $submission->user->name }}</p>
                                        </div>
                                        <div>
                                            <span class="text-xs text-blue-600 font-medium">Email:</span>
                                            <p class="text-sm text-gray-800">{{ $submission->user->email }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>

                        <!-- Action Buttons -->
                        <div class="pt-6 border-t border-gray-200">
                            <div class="flex flex-col sm:flex-row justify-between items-center space-y-4 sm:space-y-0">
                                <a href="{{ route('admin.submissions.index') }}"
                                    class="inline-flex items-center justify-center px-5 py-2.5 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition duration-150 ease-in-out w-full sm:w-auto">
                                    <i class="fas fa-arrow-left mr-2"></i>
                                    Kembali ke Daftar
                                </a>

                                <div class="flex space-x-3 w-full sm:w-auto">
                                    <a href="{{ route('admin.submissions.show', $submission) }}"
                                        class="inline-flex items-center justify-center px-5 py-2.5 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition duration-150 ease-in-out w-full sm:w-auto">
                                        <i class="fas fa-eye mr-2"></i>
                                        Lihat Detail
                                    </a>

                                    <button id="btn-save" type="submit"
                                        class="inline-flex items-center justify-center px-5 py-2.5 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition duration-150 ease-in-out w-full sm:w-auto">
                                        <i class="fas fa-check-circle mr-2"></i>
                                        Simpan Perubahan
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Status Guide -->
            <div class="mt-8 bg-white shadow rounded-lg overflow-hidden">
                <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-800">
                        <i class="fas fa-question-circle text-blue-600 mr-2"></i>
                        Panduan Status Pengajuan
                    </h3>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        @foreach (\App\Models\LetterSubmission::allowedStatuses() as $status)
                            <div
                                class="p-4 border rounded-lg 
                            @if ($status === 'Diajukan') border-yellow-200 bg-yellow-50
                            @elseif($status === 'Diproses') border-blue-200 bg-blue-50
                            @elseif($status === 'Selesai') border-green-200 bg-green-50
                            @elseif($status === 'Ditolak') border-red-200 bg-red-50
                            @else border-gray-200 bg-gray-50 @endif">
                                <div class="flex items-center mb-2">
                                    <span
                                        class="w-3 h-3 rounded-full mr-2 
                                    @if ($status === 'Diajukan') bg-yellow-400
                                    @elseif($status === 'Diproses') bg-blue-400
                                    @elseif($status === 'Selesai') bg-green-400
                                    @elseif($status === 'Ditolak') bg-red-400
                                    @else bg-gray-400 @endif"></span>
                                    <h4
                                        class="font-semibold 
                                    @if ($status === 'Diajukan') text-yellow-700
                                    @elseif($status === 'Diproses') text-blue-700
                                    @elseif($status === 'Selesai') text-green-700
                                    @elseif($status === 'Ditolak') text-red-700
                                    @else text-gray-700 @endif">
                                        {{ $status }}</h4>
                                </div>
                                <p
                                    class="text-sm 
                                @if ($status === 'Diajukan') text-yellow-600
                                @elseif($status === 'Diproses') text-blue-600
                                @elseif($status === 'Selesai') text-green-600
                                @elseif($status === 'Ditolak') text-red-600
                                @else text-gray-600 @endif">
                                    @if ($status === 'Diajukan')
                                        Pengajuan baru, menunggu pemeriksaan
                                    @elseif($status === 'Diproses')
                                        Sedang diproses oleh admin
                                    @elseif($status === 'Selesai')
                                        Sudah selesai dan dapat diambil
                                    @elseif($status === 'Ditolak')
                                        Ditolak dengan alasan tertentu
                                    @else
                                        Status pengajuan
                                    @endif
                                </p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        // Form validation and feedback
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.querySelector('form');
            const statusSelect = document.querySelector('select[name="status"]');

            // Add visual feedback on status change
            statusSelect.addEventListener('change', function() {
                const selectedOption = this.options[this.selectedIndex];
                const status = selectedOption.value;

                // Update the guide highlight (optional visual feedback)
                document.querySelectorAll('.status-guide-item').forEach(item => {
                    item.classList.remove('border-2', 'border-blue-300', 'bg-blue-100');
                    if (item.dataset.status === status) {
                        item.classList.add('border-2', 'border-blue-300', 'bg-blue-100');
                    }
                });
            });

            // Form submission confirmation
            form.addEventListener('submit', function(e) {
                const originalStatus = '{{ $submission->status }}';
                const newStatus = statusSelect.value;

                if (originalStatus !== newStatus) {
                    if (!confirm(
                            `Apakah Anda yakin ingin mengubah status dari "${originalStatus}" menjadi "${newStatus}"?`
                        )) {
                        e.preventDefault();
                        return false;
                    }
                }

                // Show loading state
                const submitBtn = document.getElementById('btn-save');
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i> Menyimpan...';
                submitBtn.disabled = true;

                return true;
            });
        });
    </script>
@endpush
