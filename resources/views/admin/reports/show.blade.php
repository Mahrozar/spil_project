@extends('layouts.app')

@section('title', 'Detail Laporan #' . $report->report_code)
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
                <a href="{{ route('admin.reports.index') }}" class="text-gray-400 hover:text-gray-600">
                    Laporan Fasilitas
                </a>
            </li>
            <li class="flex items-center">
                <i class="fas fa-chevron-right text-gray-400 text-xs mx-2"></i>
                <span class="text-gray-600 font-medium">#{{ $report->report_code }}</span>
            </li>
        </ol>
    </nav>
@endsection

@section('content')
    <div class="admin-content-area">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <!-- Header -->
            <div class="mb-8">
                <div class="flex justify-between items-start">
                    <div>
                        <h1 class="text-2xl font-bold text-gray-900 mb-2">
                            {{ $report->title ?? 'Laporan Fasilitas' }}
                        </h1>
                        <div class="flex items-center gap-2">
                            <span class="text-gray-600">
                                <i class="fas fa-hashtag mr-1"></i> #{{ $report->report_code }}
                            </span>
                            <span class="{{ $report->getStatusBadgeClass() }} text-sm px-2 py-0.5 rounded-full">
                                {{ $report->getStatusLabel() }}
                            </span>
                            @if ($report->priority)
                                <span
                                    class="text-xs px-2 py-0.5 rounded-full {{ $report->priority == 'urgent'
                                        ? 'bg-red-100 text-red-800 border border-red-200'
                                        : ($report->priority == 'high'
                                            ? 'bg-orange-100 text-orange-800 border border-orange-200'
                                            : ($report->priority == 'medium'
                                                ? 'bg-yellow-100 text-yellow-800 border border-yellow-200'
                                                : 'bg-gray-100 text-gray-800 border border-gray-200')) }}">
                                    <i class="fas fa-flag mr-1 text-xs"></i>
                                    {{ $report->getPriorityLabel() }}
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="flex items-center gap-2">
                        <a href="{{ route('admin.reports.edit', $report) }}"
                            class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            <i class="fas fa-edit mr-2"></i>
                            Edit Laporan
                        </a>
                        <a href="{{ route('admin.reports.index') }}"
                            class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                            <i class="fas fa-arrow-left mr-2"></i>
                            Kembali
                        </a>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Main Content -->
                <div class="lg:col-span-2 space-y-6">
                    <!-- Informasi Laporan -->
                    <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                        <div class="px-4 py-5 sm:px-6 border-b border-gray-200">
                            <h3 class="text-lg font-medium text-gray-900">
                                <i class="fas fa-info-circle mr-2 text-blue-500"></i>
                                Informasi Detail Laporan
                            </h3>
                        </div>
                        <div class="px-4 py-5 sm:p-6">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <!-- Left Column -->
                                <div class="space-y-6">
                                    <!-- Informasi Pelapor -->
                                    <div class="bg-gray-50 p-4 rounded-lg">
                                        <h4 class="text-sm font-medium text-gray-500 mb-3 flex items-center">
                                            <i class="fas fa-user mr-2 text-gray-400"></i>
                                            INFORMASI PELAPOR
                                        </h4>
                                        <div class="space-y-3">
                                            <div class="flex items-center">
                                                <div class="w-8 text-gray-500">
                                                    <i class="fas fa-user-circle"></i>
                                                </div>
                                                <div>
                                                    <div class="text-sm font-medium text-gray-900">
                                                        {{ $report->reporter_name ?? ($report->user->name ?? 'Anonim') }}
                                                    </div>
                                                    @if ($report->is_anonymous)
                                                        <span
                                                            class="text-xs bg-gray-100 text-gray-800 px-2 py-0.5 rounded mt-1 inline-block">
                                                            <i class="fas fa-user-secret mr-1 text-xs"></i>
                                                            Anonim
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>

                                            @if ($report->reporter_phone)
                                                <div class="flex items-center">
                                                    <div class="w-8 text-gray-500">
                                                        <i class="fas fa-phone"></i>
                                                    </div>
                                                    <div class="text-sm text-gray-900">
                                                        <a href="tel:{{ $report->reporter_phone }}"
                                                            class="hover:text-blue-600">
                                                            {{ $report->reporter_phone }}
                                                        </a>
                                                    </div>
                                                </div>
                                            @endif

                                            @if ($report->reporter_email)
                                                <div class="flex items-center">
                                                    <div class="w-8 text-gray-500">
                                                        <i class="fas fa-envelope"></i>
                                                    </div>
                                                    <div class="text-sm text-gray-900">
                                                        <a href="mailto:{{ $report->reporter_email }}"
                                                            class="hover:text-blue-600">
                                                            {{ $report->reporter_email }}
                                                        </a>
                                                    </div>
                                                </div>
                                            @endif

                                            <div class="flex items-center">
                                                <div class="w-8 text-gray-500">
                                                    <i class="far fa-clock"></i>
                                                </div>
                                                <div>
                                                    <div class="text-sm text-gray-900">
                                                        {{ $report->created_at->format('d/m/Y H:i') }}</div>
                                                    <div class="text-xs text-gray-500">
                                                        {{ $report->created_at->diffForHumans() }}</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Informasi Fasilitas -->
                                    <div class="bg-gray-50 p-4 rounded-lg">
                                        <h4 class="text-sm font-medium text-gray-500 mb-3 flex items-center">
                                            <i class="fas fa-building mr-2 text-gray-400"></i>
                                            INFORMASI FASILITAS
                                        </h4>
                                        <div class="space-y-3">
                                            <div class="flex items-center">
                                                <div class="w-8 text-gray-500">
                                                    <i class="fas fa-tag"></i>
                                                </div>
                                                <div class="text-sm font-medium text-gray-900">
                                                    {{ $report->getCategoryLabel() }}
                                                </div>
                                            </div>

                                            <div class="flex items-center">
                                                <div class="w-8 text-gray-500">
                                                    <i class="fas fa-clipboard-list"></i>
                                                </div>
                                                <div class="text-sm font-medium text-gray-900">
                                                    {{ $report->getTypeLabel() }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Right Column -->
                                <div class="space-y-6">
                                    <!-- Lokasi -->
                                    <div class="bg-gray-50 p-4 rounded-lg">
                                        <h4 class="text-sm font-medium text-gray-500 mb-3 flex items-center">
                                            <i class="fas fa-map-marker-alt mr-2 text-gray-400"></i>
                                            LOKASI LAPORAN
                                        </h4>
                                        <div class="space-y-3">
                                            <div class="flex items-start">
                                                <div class="w-8 text-gray-500 mt-1">
                                                    <i class="fas fa-map-pin"></i>
                                                </div>
                                                <div>
                                                    <div class="text-sm text-gray-900 mb-1">{{ $report->address }}</div>
                                                    <div class="text-xs text-gray-500">
                                                        Dusun {{ $report->dusun ?? '-' }},
                                                        RT {{ $report->rt ?? '-' }} / RW {{ $report->rw ?? '-' }}
                                                    </div>
                                                </div>
                                            </div>

                                            @if ($report->latitude && $report->longitude)
                                                <a href="{{ $report->map_url }}" target="_blank"
                                                    class="inline-flex items-center text-blue-600 hover:text-blue-800 text-sm mt-2">
                                                    <i class="fas fa-external-link-alt mr-2 text-xs"></i>
                                                    Lihat di Peta
                                                </a>
                                            @endif
                                        </div>
                                    </div>

                                    <!-- Timelines & Info -->
                                    <div class="bg-gray-50 p-4 rounded-lg">
                                        <h4 class="text-sm font-medium text-gray-500 mb-3 flex items-center">
                                            <i class="fas fa-calendar-alt mr-2 text-gray-400"></i>
                                            TIMELINE & INFO
                                        </h4>
                                        <div class="space-y-3">
                                            @if ($report->due_date)
                                                <div class="flex items-center">
                                                    <div class="w-8 text-gray-500">
                                                        <i class="far fa-calendar-times"></i>
                                                    </div>
                                                    <div>
                                                        <div class="text-sm text-gray-900">
                                                            {{ $report->due_date->format('d/m/Y') }}</div>
                                                        @if ($report->due_date->isPast() && !in_array($report->status, ['completed', 'closed', 'rejected']))
                                                            <span
                                                                class="text-xs bg-red-100 text-red-800 px-2 py-0.5 rounded mt-1 inline-block">
                                                                <i class="fas fa-exclamation-triangle mr-1 text-xs"></i>
                                                                Terlambat
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>
                                            @endif

                                            @if ($report->assigned_to)
                                                <div class="flex items-center">
                                                    <div class="w-8 text-gray-500">
                                                        <i class="fas fa-user-tie"></i>
                                                    </div>
                                                    <div>
                                                        <div class="text-sm font-medium text-gray-900">
                                                            {{ $report->assignedUser->name ?? '-' }}
                                                        </div>
                                                        <div class="text-xs text-gray-500">
                                                            Petugas Penanggung Jawab
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Deskripsi -->
                            <div class="mt-6 pt-6 border-t border-gray-200">
                                <h4 class="text-sm font-medium text-gray-500 mb-3 flex items-center">
                                    <i class="fas fa-align-left mr-2 text-gray-400"></i>
                                    DESKRIPSI LAPORAN
                                </h4>
                                <div class="bg-gray-50 rounded-lg p-4">
                                    <p class="text-gray-700 whitespace-pre-line">
                                        {{ $report->description ?? 'Tidak ada deskripsi' }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Foto Laporan -->
                    @if ($report->photos->count() > 0)
                        <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                            <div class="px-4 py-5 sm:px-6 border-b border-gray-200">
                                <h3 class="text-lg font-medium text-gray-900 flex items-center">
                                    <i class="fas fa-images mr-2 text-blue-500"></i>
                                    Foto Laporan
                                </h3>
                            </div>
                            <div class="px-4 py-5 sm:p-6">
                                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                                    @foreach ($report->photos as $photo)
                                        <div
                                            class="relative group rounded-lg overflow-hidden shadow-sm border border-gray-200">
                                            <img src="{{ Storage::url($photo->photo_path) }}"
                                                alt="Foto laporan {{ $loop->iteration }}"
                                                class="w-full h-48 object-cover hover:scale-105 transition-transform duration-300">

                                            <div class="absolute top-2 left-2">
                                                @if ($photo->is_before)
                                                    <span
                                                        class="bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded flex items-center">
                                                        <i class="fas fa-history mr-1 text-xs"></i>
                                                        Sebelum
                                                    </span>
                                                @else
                                                    <span
                                                        class="bg-green-100 text-green-800 text-xs px-2 py-1 rounded flex items-center">
                                                        <i class="fas fa-check-circle mr-1 text-xs"></i>
                                                        Sesudah
                                                    </span>
                                                @endif
                                            </div>

                                            <a href="{{ Storage::url($photo->photo_path) }}" target="_blank"
                                                class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-40 transition-all duration-300 flex items-center justify-center opacity-0 group-hover:opacity-100">
                                                <div class="bg-white p-3 rounded-full shadow-lg">
                                                    <i class="fas fa-expand-alt text-gray-800 text-lg"></i>
                                                </div>
                                            </a>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- Riwayat Status -->
                    @if ($report->statusHistory->count() > 0)
                        <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                            <div class="px-4 py-5 sm:px-6 border-b border-gray-200">
                                <h3 class="text-lg font-medium text-gray-900 flex items-center">
                                    <i class="fas fa-history mr-2 text-blue-500"></i>
                                    Riwayat Status
                                </h3>
                            </div>
                            <div class="px-4 py-5 sm:p-6">
                                <div class="space-y-4">
                                    @foreach ($report->statusHistory as $history)
                                        <div class="flex items-start">
                                            <div class="flex-shrink-0 mr-3">
                                                <div
                                                    class="h-8 w-8 rounded-full bg-blue-100 flex items-center justify-center">
                                                    <i class="fas fa-exchange-alt text-blue-600 text-sm"></i>
                                                </div>
                                            </div>
                                            <div class="flex-1 min-w-0 pb-4 border-b border-gray-100 last:border-b-0">
                                                <div class="flex items-center justify-between mb-1">
                                                    <span class="text-sm font-medium text-gray-900">
                                                        {{ \App\Models\Report::getStatusLabels()[$history->new_status] ?? $history->new_status }}
                                                    </span>
                                                    <span
                                                        class="text-xs text-gray-500">{{ $history->created_at->diffForHumans() }}</span>
                                                </div>
                                                @if ($history->notes)
                                                    <p class="text-sm text-gray-600 mt-1">{{ $history->notes }}</p>
                                                @endif
                                                @if ($history->changedBy)
                                                    <p class="text-xs text-gray-500 mt-2">
                                                        <i class="fas fa-user-edit mr-1"></i>
                                                        Oleh: {{ $history->changedBy->name ?? 'Sistem' }}
                                                    </p>
                                                @endif
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Sidebar - Update Status -->
                <div>
                    <div class="bg-white shadow overflow-hidden sm:rounded-lg sticky top-6">
                        <div class="px-4 py-5 sm:px-6 border-b border-gray-200 bg-blue-50">
                            <h3 class="text-lg font-medium text-gray-900 flex items-center">
                                <i class="fas fa-sync-alt mr-2 text-blue-500"></i>
                                Update Status
                            </h3>
                        </div>
                        <div class="px-4 py-5 sm:p-6">
                            <form action="{{ route('admin.reports.update', $report) }}" method="POST">
                                @csrf
                                @method('PUT')

                                <div class="space-y-4">
                                    <!-- Status -->
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2 flex items-center">
                                            <i class="fas fa-flag mr-2 text-gray-400"></i>
                                            Status
                                        </label>
                                        <select name="status" required
                                            class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors text-sm">
                                            @foreach (\App\Models\Report::getStatusLabels() as $key => $label)
                                                <option value="{{ $key }}"
                                                    {{ $report->status == $key ? 'selected' : '' }} class="py-2">
                                                    {{ $label }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <!-- Prioritas -->
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2 flex items-center">
                                            <i class="fas fa-exclamation-circle mr-2 text-gray-400"></i>
                                            Prioritas
                                        </label>
                                        <select name="priority"
                                            class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors text-sm">
                                            @foreach (\App\Models\Report::getPriorityLabels() as $key => $label)
                                                <option value="{{ $key }}"
                                                    {{ $report->priority == $key ? 'selected' : '' }} class="py-2">
                                                    {{ $label }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <!-- Petugas -->
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2 flex items-center">
                                            <i class="fas fa-user-tie mr-2 text-gray-400"></i>
                                            Tugaskan Kepada
                                        </label>
                                        <select name="assigned_to"
                                            class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors text-sm">
                                            <option value="">-- Pilih Petugas --</option>
                                            @foreach ($petugas ?? [] as $user)
                                                <option value="{{ $user->id }}"
                                                    {{ $report->assigned_to == $user->id ? 'selected' : '' }}>
                                                    {{ $user->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <!-- Batas Waktu -->
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2 flex items-center">
                                            <i class="far fa-calendar-alt mr-2 text-gray-400"></i>
                                            Batas Waktu
                                        </label>
                                        <input type="date" name="due_date"
                                            value="{{ $report->due_date ? $report->due_date->format('Y-m-d') : '' }}"
                                            class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors text-sm">
                                    </div>

                                    <!-- Catatan -->
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2 flex items-center">
                                            <i class="fas fa-sticky-note mr-2 text-gray-400"></i>
                                            Catatan
                                        </label>
                                        <textarea name="status_notes" rows="3" placeholder="Tambahkan catatan perubahan status (opsional)"
                                            class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors text-sm"></textarea>
                                    </div>

                                    <!-- Submit Button -->
                                    <div class="pt-2">
                                        <button type="submit"
                                            class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-2.5 px-4 rounded-lg transition-colors flex items-center justify-center">
                                            <i class="fas fa-save mr-2"></i>
                                            Simpan Perubahan
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Informasi Teknis -->
                    <div class="mt-6 bg-white shadow overflow-hidden sm:rounded-lg">
                        <div class="px-4 py-5 sm:px-6 border-b border-gray-200">
                            <h3 class="text-sm font-medium text-gray-900 flex items-center">
                                <i class="fas fa-terminal mr-2 text-gray-400"></i>
                                Informasi Teknis
                            </h3>
                        </div>
                        <div class="px-4 py-4 sm:p-6">
                            <div class="space-y-2 text-sm">
                                <div class="flex items-center">
                                    <div class="w-5 text-gray-400">
                                        <i class="fas fa-laptop"></i>
                                    </div>
                                    <div class="text-gray-600 truncate">
                                        {{ Str::limit($report->user_agent, 40) }}
                                    </div>
                                </div>
                                <div class="flex items-center">
                                    <div class="w-5 text-gray-400">
                                        <i class="fas fa-network-wired"></i>
                                    </div>
                                    <div class="text-gray-600">
                                        IP: {{ $report->ip_address ?? '-' }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <style>
        .sticky {
            position: -webkit-sticky;
            position: sticky;
        }
    </style>
@endpush
