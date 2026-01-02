@extends('layouts.home-app')

@section('title', 'Status Laporan - Desa Cicangkang Hilir')

@section('content')
<div class="pt-24 pb-12">
    <div class="container mx-auto px-4">
        <div class="max-w-3xl mx-auto">
            <!-- Breadcrumb -->
            <nav class="flex mb-6" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-3">
                    <li class="inline-flex items-center">
                        <a href="{{ route('landing-page') }}" class="inline-flex items-center text-sm text-gray-700 hover:text-primary">
                            <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path>
                            </svg>
                            Beranda
                        </a>
                    </li>
                    <li aria-current="page">
                        <div class="flex items-center">
                            <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="ml-1 text-sm text-primary font-medium md:ml-2">Status Laporan</span>
                        </div>
                    </li>
                </ol>
            </nav>

            <!-- Report Card -->
            <div class="bg-white rounded-xl shadow-lg p-6 mb-6">
                <div class="flex items-center justify-between mb-4">
                    <h1 class="text-2xl font-bold text-gray-800">Status Laporan</h1>
                    <div class="flex items-center space-x-2">
                        <span class="px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                            {{ $report->report_code }}
                        </span>
                        <span class="px-3 py-1 rounded-full text-sm font-medium 
                            @if($report->status == 'completed') bg-green-100 text-green-800
                            @elseif($report->status == 'in_progress') bg-yellow-100 text-yellow-800
                            @elseif($report->status == 'rejected') bg-red-100 text-red-800
                            @else bg-blue-100 text-blue-800 @endif">
                            {{ $report->status_label }}
                        </span>
                    </div>
                </div>

                <!-- Report Details -->
                <div class="space-y-4 mb-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <p class="text-sm text-gray-600 mb-1">Jenis Fasilitas</p>
                            <p class="font-medium">{{ $report->facility_label }} - {{ $report->facility_label }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600 mb-1">Prioritas</p>
                            <p class="font-medium">{{ $report->priority_label }}</p>
                        </div>
                    </div>

                    <div>
                        <p class="text-sm text-gray-600 mb-1">Lokasi</p>
                        <p class="font-medium">{{ $report->latitude }}, {{ $report->longitude }}</p>
                    </div>

                    @if($report->description)
                    <div>
                        <p class="text-sm text-gray-600 mb-1">Deskripsi</p>
                        <p class="font-medium">{{ $report->description }}</p>
                    </div>
                    @endif

                    <div>
                        <p class="text-sm text-gray-600 mb-1">Tanggal Lapor</p>
                        <p class="font-medium">{{ $report->created_at->format('d F Y H:i') }}</p>
                    </div>
                </div>

                <!-- Photos -->
                @if($report->photos->count() > 0)
                <div class="mb-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-3">Foto Laporan</h3>
                    <div class="grid grid-cols-2 md:grid-cols-3 gap-3">
                        @foreach($report->photos as $photo)
                        <div class="relative">
                            <img src="{{ Storage::url($photo->photo_path) }}" 
                                 alt="Foto laporan" 
                                 class="w-full h-32 object-cover rounded-lg cursor-pointer"
                                 onclick="openPhotoModal('{{ Storage::url($photo->photo_path) }}')">
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif

                <!-- Status History -->
                <div class="mb-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-3">Riwayat Status</h3>
                    <div class="space-y-3">
                        @foreach($report->statusHistory as $history)
                        <div class="flex items-start">
                            <div class="flex-shrink-0 w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center mr-3">
                                <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <div class="flex-1">
                                <p class="font-medium text-gray-800">
                                    @if($history->old_status)
                                        Status berubah dari <span class="text-blue-600">{{ \App\Models\Report::getStatusLabels()[$history->old_status] ?? $history->old_status }}</span> 
                                        menjadi <span class="text-green-600">{{ \App\Models\Report::getStatusLabels()[$history->new_status] ?? $history->new_status }}</span>
                                    @else
                                        Laporan dibuat dengan status <span class="text-green-600">{{ \App\Models\Report::getStatusLabels()[$history->new_status] ?? $history->new_status }}</span>
                                    @endif
                                </p>
                                @if($history->notes)
                                <p class="text-sm text-gray-600 mt-1">{{ $history->notes }}</p>
                                @endif
                                <p class="text-xs text-gray-500 mt-1">{{ $history->created_at->format('d F Y H:i') }}</p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

                <!-- Actions -->
                <div class="flex flex-wrap gap-3 pt-6 border-t">
                    <a href="{{ route('reports.create') }}" class="bg-primary text-white px-4 py-2 rounded-lg hover:bg-secondary">
                        Buat Laporan Baru
                    </a>
                    <button onclick="window.print()" class="bg-gray-200 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-300">
                        Cetak Halaman
                    </button>
                    @if(auth()->check() && auth()->user()->canManageReports())
                    <a href="{{ route('admin.reports.edit', $report->id) }}" class="bg-yellow-500 text-white px-4 py-2 rounded-lg hover:bg-yellow-600">
                        Edit Laporan
                    </a>
                    @endif
                </div>
            </div>

            <!-- Info -->
            <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                <div class="flex">
                    <svg class="w-6 h-6 text-blue-600 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <div>
                        <h4 class="font-bold text-blue-800">Informasi</h4>
                        <ul class="mt-2 text-sm text-blue-700 space-y-1">
                            <li>• Simpan kode laporan ini untuk mengecek status kembali</li>
                            <li>• Status akan diperbarui oleh petugas setiap ada perkembangan</li>
                            <li>• Untuk pertanyaan, hubungi admin desa</li>
                            <li>• Kode laporan Anda: <strong>{{ $report->report_code }}</strong></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Photo Modal -->
<div id="photoModal" class="fixed inset-0 bg-black bg-opacity-75 flex items-center justify-center z-50 hidden">
    <div class="bg-white rounded-lg max-w-4xl max-h-[90vh] overflow-hidden">
        <div class="flex justify-between items-center p-4 border-b">
            <h3 class="text-lg font-semibold">Foto Laporan</h3>
            <button onclick="closePhotoModal()" class="text-gray-500 hover:text-gray-700">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
        <div class="p-4">
            <img id="modalPhoto" src="" alt="" class="max-w-full max-h-[70vh] mx-auto">
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
function openPhotoModal(photoUrl) {
    document.getElementById('modalPhoto').src = photoUrl;
    document.getElementById('photoModal').classList.remove('hidden');
}

function closePhotoModal() {
    document.getElementById('photoModal').classList.add('hidden');
}

// Close modal on ESC
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closePhotoModal();
    }
});

// Close modal on background click
document.getElementById('photoModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closePhotoModal();
    }
});
</script>
@endpush