@extends('layouts.app')

@section('title', 'Ubah Status Surat #' . $letter->id)

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
                    <a href="{{ route('admin.submissions.index') }}" class="text-gray-400 hover:text-gray-600">
                        Pengajuan Surat
                    </a>
                </li>
                <li class="flex items-center">
                    <i class="fas fa-chevron-right text-gray-400 text-xs mx-2"></i>
                    <span class="text-gray-600 font-medium">Ubah Status #{{ $letter->id }}</span>
                </li>
            </ol>
        </nav>

        <!-- Header -->
        <div class="md:flex md:items-center md:justify-between mb-8">
            <div class="flex-1 min-w-0">
                <h1 class="text-2xl font-bold text-gray-900">
                    <i class="fas fa-file-alt text-blue-500 mr-2"></i>
                    Ubah Status Surat
                </h1>
                <p class="mt-1 text-sm text-gray-500">
                    Ubah status pengajuan surat #{{ $letter->id }}
                </p>
            </div>
            <div class="mt-4 flex md:mt-0">
                <a href="{{ route('admin.submissions.index') }}" 
                   class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    <i class="fas fa-arrow-left text-gray-400 mr-2"></i>
                    Kembali ke Daftar
                </a>
            </div>
        </div>

        <!-- Main Content -->
        <div class="max-w-3xl mx-auto">
            <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                <div class="px-4 py-5 sm:px-6 border-b border-gray-200">
                    <h3 class="text-lg leading-6 font-medium text-gray-900">
                        <i class="fas fa-edit text-yellow-500 mr-2"></i>
                        Form Ubah Status Surat
                    </h3>
                    <p class="mt-1 max-w-2xl text-sm text-gray-500">
                        Ubah status surat pengajuan #{{ $letter->id }}
                    </p>
                </div>
                
                <form method="POST" action="{{ route('admin.submissions.update', $submission ?? $letter) }}">
                    @csrf
                    @method('PUT')
                    
                    <div class="border-t border-gray-200">
                        <dl>
                            <!-- Informasi Surat -->
                            <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                <dt class="text-sm font-medium text-gray-500">
                                    <i class="fas fa-hashtag mr-1"></i>
                                    ID Surat
                                </dt>
                                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2 font-medium">
                                    #{{ str_pad($letter->id, 3, '0', STR_PAD_LEFT) }}
                                </dd>
                            </div>
                            
                            <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                <dt class="text-sm font-medium text-gray-500">
                                    <i class="fas fa-user mr-1"></i>
                                    Pemohon
                                </dt>
                                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                    {{ $letter->user->name ?? 'Tidak Diketahui' }}
                                    @if($letter->user->email ?? false)
                                        <div class="text-xs text-gray-500 mt-1">
                                            <i class="fas fa-envelope mr-1"></i>
                                            {{ $letter->user->email }}
                                        </div>
                                    @endif
                                </dd>
                            </div>
                            
                            <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                <dt class="text-sm font-medium text-gray-500">
                                    <i class="fas fa-calendar mr-1"></i>
                                    Tanggal Pengajuan
                                </dt>
                                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                    {{ $letter->created_at->format('d F Y, H:i') }}
                                </dd>
                            </div>
                            
                            <!-- Status Saat Ini -->
                            <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                <dt class="text-sm font-medium text-gray-500">
                                    <i class="fas fa-info-circle mr-1"></i>
                                    Status Saat Ini
                                </dt>
                                <dd class="mt-1 sm:mt-0 sm:col-span-2">
                                    @php
                                        $statusColors = [
                                            'pending' => 'bg-yellow-100 text-yellow-800',
                                            'approved' => 'bg-green-100 text-green-800',
                                            'rejected' => 'bg-red-100 text-red-800',
                                            'processed' => 'bg-blue-100 text-blue-800',
                                            'completed' => 'bg-green-100 text-green-800'
                                        ];
                                        $statusIcons = [
                                            'pending' => 'fa-clock',
                                            'approved' => 'fa-check-circle',
                                            'rejected' => 'fa-times-circle',
                                            'processed' => 'fa-cog',
                                            'completed' => 'fa-check'
                                        ];
                                        $color = $statusColors[$letter->status] ?? 'bg-gray-100 text-gray-800';
                                        $icon = $statusIcons[$letter->status] ?? 'fa-question-circle';
                                    @endphp
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $color }}">
                                        <i class="fas {{ $icon }} mr-1"></i>
                                        {{ \App\Models\Letter::labelFor($letter->status) }}
                                    </span>
                                </dd>
                            </div>
                            
                            <!-- Form Ubah Status -->
                            <div class="bg-gray-50 px-4 py-5 sm:px-6">
                                <div class="space-y-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">
                                            <i class="fas fa-exchange-alt mr-1"></i>
                                            Ubah Status
                                        </label>
                                        <select name="status" 
                                                class="mt-1 block w-full pl-10 pr-3 py-2 text-base border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-md">
                                            @foreach(\App\Models\Letter::allowedStatuses() as $status)
                                                @php
                                                    $statusColors = [
                                                        'pending' => 'text-yellow-500',
                                                        'approved' => 'text-green-500',
                                                        'rejected' => 'text-red-500',
                                                        'processed' => 'text-blue-500',
                                                        'completed' => 'text-green-600'
                                                    ];
                                                    $statusIcons = [
                                                        'pending' => 'fa-clock',
                                                        'approved' => 'fa-check-circle',
                                                        'rejected' => 'fa-times-circle',
                                                        'processed' => 'fa-cog',
                                                        'completed' => 'fa-check'
                                                    ];
                                                    $color = $statusColors[$status] ?? 'text-gray-500';
                                                    $icon = $statusIcons[$status] ?? 'fa-question-circle';
                                                @endphp
                                                <option value="{{ $status }}" 
                                                        data-color="{{ $color }}"
                                                        {{ $letter->status === $status ? 'selected' : '' }}>
                                                    <i class="fas {{ $icon }} {{ $color }} mr-2"></i>
                                                    {{ \App\Models\Letter::labelFor($status) }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">
                                            <i class="fas fa-align-left mr-1"></i>
                                            Deskripsi Pengajuan
                                        </label>
                                        <div class="mt-1 p-3 bg-gray-50 border border-gray-300 rounded-md">
                                            <div class="text-sm text-gray-700">
                                                {{ $letter->description ?? 'Tidak ada deskripsi' }}
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">
                                            <i class="fas fa-sticky-note mr-1"></i>
                                            Catatan (Opsional)
                                        </label>
                                        <textarea name="notes" 
                                                  rows="3" 
                                                  class="shadow-sm focus:ring-blue-500 focus:border-blue-500 mt-1 block w-full sm:text-sm border border-gray-300 rounded-md"
                                                  placeholder="Tambahkan catatan untuk perubahan status ini...">{{ old('notes', $letter->admin_notes ?? '') }}</textarea>
                                        <p class="mt-2 text-sm text-gray-500">
                                            Catatan ini akan disimpan untuk riwayat pengajuan.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </dl>
                    </div>
                    
                    <!-- Action Buttons -->
                    <div class="px-4 py-3 bg-gray-50 text-right sm:px-6 border-t border-gray-200">
                        <div class="flex justify-end space-x-3">
                            <a href="{{ route('admin.submissions.index') }}" 
                               class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                <i class="fas fa-times mr-2"></i>
                                Batal
                            </a>
                            <button type="submit" 
                                    class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                <i class="fas fa-save mr-2"></i>
                                Simpan Perubahan
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            
            <!-- Additional Info -->
            <div class="mt-6 bg-white shadow overflow-hidden sm:rounded-lg">
                <div class="px-4 py-5 sm:px-6 border-b border-gray-200">
                    <h3 class="text-lg leading-6 font-medium text-gray-900">
                        <i class="fas fa-history mr-2"></i>
                        Informasi Riwayat
                    </h3>
                </div>
                <div class="border-t border-gray-200">
                    <div class="px-4 py-5 sm:p-6">
                        <div class="text-sm text-gray-600">
                            <p class="mb-2">
                                <i class="fas fa-info-circle text-blue-500 mr-2"></i>
                                Pastikan perubahan status sesuai dengan proses yang berlaku.
                            </p>
                            <ul class="list-disc pl-5 space-y-1">
                                <li>Status "Disetujui" berarti surat siap diproses</li>
                                <li>Status "Diproses" berarti surat sedang dibuat</li>
                                <li>Status "Selesai" berarti surat telah selesai</li>
                                <li>Status "Ditolak" berarti pengajuan tidak disetujui</li>
                            </ul>
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
    // Update select option display with icons
    document.addEventListener('DOMContentLoaded', function() {
        const statusSelect = document.querySelector('select[name="status"]');
        
        // Update icon when selection changes
        statusSelect.addEventListener('change', function() {
            const selectedOption = this.options[this.selectedIndex];
            const status = selectedOption.value;
            
            // Get icon and color for the selected status
            const statusIcons = {
                'pending': 'fa-clock text-yellow-500',
                'approved': 'fa-check-circle text-green-500',
                'rejected': 'fa-times-circle text-red-500',
                'processed': 'fa-cog text-blue-500',
                'completed': 'fa-check text-green-600'
            };
            
            // Update label preview if needed
            const statusPreview = document.querySelector('.status-preview');
            if (statusPreview) {
                const iconClass = statusIcons[status] || 'fa-question-circle text-gray-500';
                statusPreview.innerHTML = `<i class="fas ${iconClass} mr-2"></i>${selectedOption.text}`;
            }
        });
    });
</script>
@endpush