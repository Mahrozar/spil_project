<x-app-layout>
    <x-slot name="title">Detail Laporan #{{ $report->report_code }}</x-slot>
    <x-slot name="subtitle">{{ $report->title ?? 'Laporan Fasilitas' }}</x-slot>

    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <!-- Breadcrumb -->
        <div class="mb-6">
            <nav class="flex" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-3">
                    <li>
                        <a href="{{ route('admin.reports.index') }}" class="text-gray-500 hover:text-gray-700">
                            Laporan Fasilitas
                        </a>
                    </li>
                    <li aria-current="page">
                        <div class="flex items-center">
                            <svg class="w-3 h-3 text-gray-400 mx-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                            <span class="text-gray-900 font-medium">Detail Laporan</span>
                        </div>
                    </li>
                </ol>
            </nav>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Main Content -->
            <div class="lg:col-span-2">
                <!-- Report Details Card -->
                <div class="bg-white rounded-2xl shadow-sm p-6 border border-gray-100 mb-6">
                    <div class="flex items-start justify-between mb-6">
                        <div>
                            <div class="flex items-center gap-3 mb-2">
                                <h2 class="text-xl font-bold text-gray-900">#{{ $report->report_code }}</h2>
                                <span class="{{ $report->getStatusBadgeClass() }} text-sm">
                                    {{ $report->getStatusLabel() }}
                                </span>
                                @if($report->priority)
                                    <span class="text-xs px-2 py-0.5 rounded {{ 
                                        $report->priority == 'urgent' ? 'bg-red-100 text-red-800' :
                                        ($report->priority == 'high' ? 'bg-orange-100 text-orange-800' :
                                        ($report->priority == 'medium' ? 'bg-yellow-100 text-yellow-800' :
                                        'bg-gray-100 text-gray-800'))
                                    }}">
                                        {{ $report->getPriorityLabel() }}
                                    </span>
                                @endif
                            </div>
                            <p class="text-gray-600">{{ $report->title ?? 'Laporan fasilitas umum' }}</p>
                        </div>
                        <div class="flex items-center gap-2">
                            <a href="{{ route('admin.reports.edit', $report) }}" 
                               class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm">
                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                          d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                </svg>
                                Edit
                            </a>
                            <a href="{{ route('admin.reports.index') }}" 
                               class="inline-flex items-center gap-2 border border-gray-300 text-gray-700 hover:bg-gray-50 px-4 py-2 rounded-lg text-sm">
                                Kembali
                            </a>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Left Column -->
                        <div>
                            <div class="mb-4">
                                <h3 class="text-sm font-medium text-gray-500 mb-2">Informasi Pelapor</h3>
                                <div class="space-y-2">
                                    <div class="flex items-center gap-2">
                                        <svg class="h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                  d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                        </svg>
                                        <span class="text-gray-900">{{ $report->reporter_name ?? ($report->user->name ?? 'Anonim') }}</span>
                                        @if($report->is_anonymous)
                                            <span class="text-xs bg-gray-100 text-gray-800 px-2 py-0.5 rounded">Anonim</span>
                                        @endif
                                    </div>
                                    @if($report->reporter_phone)
                                        <div class="flex items-center gap-2">
                                            <svg class="h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                      d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                            </svg>
                                            <span class="text-gray-900">{{ $report->reporter_phone }}</span>
                                        </div>
                                    @endif
                                    @if($report->reporter_email)
                                        <div class="flex items-center gap-2">
                                            <svg class="h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                      d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                            </svg>
                                            <span class="text-gray-900">{{ $report->reporter_email }}</span>
                                        </div>
                                    @endif
                                    <div class="flex items-center gap-2">
                                        <svg class="h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                  d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                        <span class="text-gray-900">{{ $report->created_at->format('d/m/Y H:i') }}</span>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-4">
                                <h3 class="text-sm font-medium text-gray-500 mb-2">Kategori Fasilitas</h3>
                                <div class="space-y-2">
                                    <div class="flex items-center gap-2">
                                        <svg class="h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                  d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                        </svg>
                                        <span class="text-gray-900">{{ $report->getCategoryLabel() }}</span>
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <svg class="h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                  d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
                                        </svg>
                                        <span class="text-gray-900">{{ $report->getTypeLabel() }}</span>
                                    </div>
                                </div>
                            </div>

                            @if($report->assigned_to)
                                <div class="mb-4">
                                    <h3 class="text-sm font-medium text-gray-500 mb-2">Petugas Penanggung Jawab</h3>
                                    <div class="flex items-center gap-3">
                                        <div class="h-10 w-10 rounded-full bg-blue-100 flex items-center justify-center">
                                            <span class="text-blue-600 font-medium">
                                                {{ strtoupper(substr($report->assignedUser->name ?? 'P', 0, 1)) }}
                                            </span>
                                        </div>
                                        <div>
                                            <div class="text-gray-900">{{ $report->assignedUser->name ?? '-' }}</div>
                                            <div class="text-sm text-gray-500">{{ $report->assignedUser->email ?? '' }}</div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>

                        <!-- Right Column -->
                        <div>
                            <div class="mb-4">
                                <h3 class="text-sm font-medium text-gray-500 mb-2">Lokasi</h3>
                                <div class="space-y-2">
                                    <div class="flex items-start gap-2">
                                        <svg class="h-4 w-4 text-gray-400 mt-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                  d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                  d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        </svg>
                                        <div>
                                            <div class="text-gray-900">{{ $report->address }}</div>
                                            <div class="text-sm text-gray-500">
                                                Dusun {{ $report->dusun ?? '-' }}, 
                                                RT {{ $report->rt ?? '-' }} / RW {{ $report->rw ?? '-' }}
                                            </div>
                                        </div>
                                    </div>
                                    @if($report->latitude && $report->longitude)
                                        <a href="{{ $report->map_url }}" 
                                           target="_blank"
                                           class="inline-flex items-center gap-2 text-blue-600 hover:text-blue-800 text-sm">
                                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                      d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"/>
                                            </svg>
                                            Lihat di Peta
                                        </a>
                                    @endif
                                </div>
                            </div>

                            @if($report->due_date)
                                <div class="mb-4">
                                    <h3 class="text-sm font-medium text-gray-500 mb-2">Batas Waktu</h3>
                                    <div class="flex items-center gap-2">
                                        <svg class="h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                  d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                        <span class="text-gray-900">{{ $report->due_date->format('d/m/Y') }}</span>
                                        @if($report->due_date->isPast() && !in_array($report->status, ['completed', 'closed', 'rejected']))
                                            <span class="text-xs bg-red-100 text-red-800 px-2 py-0.5 rounded">Terlambat</span>
                                        @endif
                                    </div>
                                </div>
                            @endif

                            <div class="mb-4">
                                <h3 class="text-sm font-medium text-gray-500 mb-2">Informasi Tambahan</h3>
                                <div class="text-sm text-gray-700">
                                    <div class="flex items-center gap-2 mb-1">
                                        <svg class="h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                  d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                        IP Address: {{ $report->ip_address ?? '-' }}
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <svg class="h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                  d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"/>
                                        </svg>
                                        Device: {{ Str::limit($report->user_agent, 50) }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Description -->
                    <div class="mt-6">
                        <h3 class="text-sm font-medium text-gray-500 mb-2">Deskripsi Laporan</h3>
                        <div class="bg-gray-50 rounded-lg p-4">
                            <p class="text-gray-700 whitespace-pre-line">{{ $report->description ?? 'Tidak ada deskripsi' }}</p>
                        </div>
                    </div>
                </div>

                <!-- Photos Section -->
                @if($report->photos->count() > 0)
                    <div class="bg-white rounded-2xl shadow-sm p-6 border border-gray-100 mb-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Foto Laporan</h3>
                        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
                            @foreach($report->photos as $photo)
                                <div class="relative group">
                                    <img src="{{ Storage::url($photo->photo_path) }}" 
                                         alt="Foto laporan {{ $loop->iteration }}"
                                         class="w-full h-48 object-cover rounded-lg shadow-sm">
                                    @if($photo->is_before)
                                        <span class="absolute top-2 left-2 bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded">
                                            Sebelum
                                        </span>
                                    @else
                                        <span class="absolute top-2 left-2 bg-green-100 text-green-800 text-xs px-2 py-1 rounded">
                                            Sesudah
                                        </span>
                                    @endif
                                    <a href="{{ Storage::url($photo->photo_path) }}" 
                                       target="_blank"
                                       class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-20 transition-opacity rounded-lg flex items-center justify-center opacity-0 group-hover:opacity-100">
                                        <svg class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                  d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"/>
                                        </svg>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- Status History -->
                @if($report->statusHistory->count() > 0)
                    <div class="bg-white rounded-2xl shadow-sm p-6 border border-gray-100 mb-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Riwayat Status</h3>
                        <div class="space-y-4">
                            @foreach($report->statusHistory as $history)
                                <div class="flex items-start gap-3">
                                    <div class="flex-shrink-0">
                                        <div class="h-8 w-8 rounded-full bg-gray-100 flex items-center justify-center">
                                            <svg class="h-4 w-4 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                      d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                            </svg>
                                        </div>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <div class="flex items-center gap-2 mb-1">
                                            <span class="text-sm font-medium text-gray-900">
                                                {{ \App\Models\Report::getStatusLabels()[$history->new_status] ?? $history->new_status }}
                                            </span>
                                            <span class="text-xs text-gray-500">{{ $history->created_at->diffForHumans() }}</span>
                                        </div>
                                        @if($history->notes)
                                            <p class="text-sm text-gray-600">{{ $history->notes }}</p>
                                        @endif
                                        @if($history->changedBy)
                                            <p class="text-xs text-gray-500 mt-1">
                                                Oleh: {{ $history->changedBy->name ?? 'Sistem' }}
                                            </p>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>

            <!-- Sidebar - Hanya Status Update Form -->
            <div>
                <!-- Status Update Form -->
                <div class="bg-white rounded-2xl shadow-sm p-6 border border-gray-100">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Ubah Status</h3>
                    <form action="{{ route('admin.reports.update', $report) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Status Baru</label>
                                <select name="status" required
                                        class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                    @foreach(\App\Models\Report::getStatusLabels() as $key => $label)
                                        <option value="{{ $key }}" {{ $report->status == $key ? 'selected' : '' }}>
                                            {{ $label }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Prioritas</label>
                                <select name="priority" 
                                        class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                    @foreach(\App\Models\Report::getPriorityLabels() as $key => $label)
                                        <option value="{{ $key }}" {{ $report->priority == $key ? 'selected' : '' }}>
                                            {{ $label }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Catatan</label>
                                <textarea name="status_notes" 
                                          rows="3"
                                          placeholder="Tambahkan catatan perubahan status (opsional)"
                                          class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"></textarea>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Tugaskan Kepada</label>
                                <select name="assigned_to"
                                        class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                    <option value="">-- Pilih Petugas --</option>
                                    @foreach($petugas ?? [] as $user)
                                        <option value="{{ $user->id }}" {{ $report->assigned_to == $user->id ? 'selected' : '' }}>
                                            {{ $user->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Batas Waktu</label>
                                <input type="date" 
                                       name="due_date"
                                       value="{{ $report->due_date ? $report->due_date->format('Y-m-d') : '' }}"
                                       class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            </div>

                            <div>
                                <button type="submit" 
                                        class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-lg transition-colors">
                                    Simpan Perubahan
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>