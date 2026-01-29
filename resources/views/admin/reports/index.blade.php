@extends('layouts.app')

@section('title', 'Data Laporan Fasilitas')
@section('subtitle', 'Monitoring dan Manajemen Laporan Fasilitas Publik')

@section('content')
<div class="admin-content-area">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Stats Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            @php
                $statusCounts = [
                    'total' => \App\Models\Report::count(),
                    'submitted' => \App\Models\Report::where('status', 'submitted')->count(),
                    'in_progress' => \App\Models\Report::where('status', 'in_progress')->count(),
                    'completed' => \App\Models\Report::where('status', 'completed')->count(),
                ];
            @endphp

            <!-- Total Laporan Card -->
            <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-200 hover:shadow-md transition-shadow duration-200">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600">Total Laporan</p>
                        <p class="text-3xl font-bold text-gray-900 mt-2">{{ $statusCounts['total'] }}</p>
                        <p class="text-xs text-gray-500 mt-1">Semua laporan yang masuk</p>
                    </div>
                    <div class="bg-blue-50 p-4 rounded-xl">
                        <i class="fas fa-file-alt text-blue-600 text-xl"></i>
                    </div>
                </div>
            </div>

            <!-- Diajukan Card -->
            <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-200 hover:shadow-md transition-shadow duration-200">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600">Diajukan</p>
                        <p class="text-3xl font-bold text-gray-900 mt-2">{{ $statusCounts['submitted'] }}</p>
                        <p class="text-xs text-gray-500 mt-1">Menunggu proses</p>
                    </div>
                    <div class="bg-gray-50 p-4 rounded-xl">
                        <i class="fas fa-clock text-gray-600 text-xl"></i>
                    </div>
                </div>
            </div>

            <!-- Dalam Proses Card -->
            <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-200 hover:shadow-md transition-shadow duration-200">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600">Dalam Proses</p>
                        <p class="text-3xl font-bold text-gray-900 mt-2">{{ $statusCounts['in_progress'] }}</p>
                        <p class="text-xs text-gray-500 mt-1">Sedang ditangani</p>
                    </div>
                    <div class="bg-yellow-50 p-4 rounded-xl">
                        <i class="fas fa-cogs text-yellow-600 text-xl"></i>
                    </div>
                </div>
            </div>

            <!-- Selesai Card -->
            <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-200 hover:shadow-md transition-shadow duration-200">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600">Selesai</p>
                        <p class="text-3xl font-bold text-gray-900 mt-2">{{ $statusCounts['completed'] }}</p>
                        <p class="text-xs text-gray-500 mt-1">Sudah ditangani</p>
                    </div>
                    <div class="bg-green-50 p-4 rounded-xl">
                        <i class="fas fa-check-circle text-green-600 text-xl"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filter Section -->
        <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-200 mb-8">
            <form method="GET" action="{{ route('admin.reports.index') }}" class="grid grid-cols-1 md:grid-cols-4 gap-6">
                <!-- Pencarian -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-search mr-2 text-gray-400"></i>Pencarian
                    </label>
                    <input type="text" name="q" value="{{ request('q') }}"
                        placeholder="Cari kode, pelapor, atau alamat"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                </div>

                <!-- Filter Status -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-filter mr-2 text-gray-400"></i>Status
                    </label>
                    <select name="status"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                        <option value="">Semua Status</option>
                        @foreach (\App\Models\Report::getStatusLabels() as $key => $label)
                            <option value="{{ $key }}" {{ request('status') == $key ? 'selected' : '' }}>
                                {{ $label }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Filter Kategori -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-tag mr-2 text-gray-400"></i>Kategori
                    </label>
                    <select name="facility_category"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                        <option value="">Semua Kategori</option>
                        @foreach (\App\Models\Report::getFacilityCategories() as $key => $label)
                            <option value="{{ $key }}"
                                {{ request('facility_category') == $key ? 'selected' : '' }}>
                                {{ $label }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Action Buttons -->
                <div class="flex items-end gap-3">
                    <button type="submit"
                        class="flex-1 bg-blue-600 hover:bg-blue-700 text-white font-medium py-2.5 px-4 rounded-lg transition-colors duration-200 flex items-center justify-center">
                        <i class="fas fa-sliders-h mr-2"></i>Terapkan Filter
                    </button>
                    <a href="{{ route('admin.reports.index') }}"
                        class="flex-1 border border-gray-300 text-gray-700 font-medium py-2.5 px-4 rounded-lg hover:bg-gray-50 transition-colors duration-200 flex items-center justify-center">
                        <i class="fas fa-redo mr-2"></i>Reset
                    </a>
                </div>
            </form>
        </div>

        <!-- Data Table Section -->
        <div class="bg-white rounded-xl shadow-sm overflow-hidden border border-gray-200 mb-8">
            <!-- Table Header -->
            <div class="px-6 py-4 border-b border-gray-200 bg-gray-50 flex items-center justify-between">
                <div>
                    <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                        <i class="fas fa-list mr-2 text-gray-400"></i>Daftar Laporan
                    </h3>
                    <p class="text-sm text-gray-500 mt-1">
                        Total <span class="font-medium">{{ $reports->total() }}</span> laporan ditemukan
                    </p>
                </div>
                <div class="flex items-center gap-3">
                    <a href="{{ route('admin.reports.export') }}"
                        class="inline-flex items-center gap-2 border border-gray-300 text-gray-700 hover:bg-gray-50 font-medium py-2 px-4 rounded-lg transition-colors duration-200">
                        <i class="fas fa-download"></i>
                        Export
                    </a>
                </div>
            </div>

            <!-- Table Content -->
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                <i class="fas fa-hashtag mr-1"></i>Kode
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                <i class="fas fa-user mr-1"></i>Pelapor
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                <i class="fas fa-tags mr-1"></i>Kategori
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                <i class="fas fa-map-marker-alt mr-1"></i>Lokasi
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                <i class="fas fa-calendar-alt mr-1"></i>Tanggal
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                <i class="fas fa-info-circle mr-1"></i>Status
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                <i class="fas fa-cog mr-1"></i>Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($reports as $report)
                            <tr class="hover:bg-gray-50 transition-colors duration-150">
                                <!-- Kode Laporan -->
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-8 w-8 flex items-center justify-center bg-blue-100 rounded-lg mr-3">
                                            <i class="fas fa-file-alt text-blue-600 text-sm"></i>
                                        </div>
                                        <div>
                                            <div class="text-sm font-medium text-gray-900">{{ $report->report_code }}</div>
                                            <div class="text-xs text-gray-500">{{ $report->title ?? 'Tidak ada judul' }}</div>
                                        </div>
                                    </div>
                                </td>

                                <!-- Informasi Pelapor -->
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">
                                        {{ $report->reporter_name ?? ($report->user->name ?? 'Anonim') }}
                                    </div>
                                    @if ($report->reporter_phone)
                                        <div class="text-xs text-gray-500 flex items-center mt-1">
                                            <i class="fas fa-phone text-gray-400 text-xs mr-1"></i>
                                            {{ $report->reporter_phone }}
                                        </div>
                                    @endif
                                </td>

                                <!-- Kategori dan Jenis -->
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">{{ $report->getCategoryLabel() }}</div>
                                    <div class="text-xs text-gray-500">{{ $report->getTypeLabel() }}</div>
                                </td>

                                <!-- Lokasi -->
                                <td class="px-6 py-4">
                                    <div class="text-sm text-gray-900">{{ Str::limit($report->address, 40) }}</div>
                                    <div class="text-xs text-gray-500 mt-1">
                                        <i class="fas fa-home text-gray-400 mr-1"></i>
                                        RT {{ $report->rt ?? '-' }} / RW {{ $report->rw ?? '-' }}
                                    </div>
                                </td>

                                <!-- Tanggal -->
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">{{ $report->created_at->format('d/m/Y') }}</div>
                                    <div class="text-xs text-gray-500 flex items-center">
                                        <i class="far fa-clock text-gray-400 text-xs mr-1"></i>
                                        {{ $report->created_at->format('H:i') }}
                                    </div>
                                </td>

                                <!-- Status dan Prioritas -->
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="{{ $report->getStatusBadgeClass() }} inline-flex items-center">
                                        <i class="fas fa-circle text-xs mr-1"></i>
                                        {{ $report->getStatusLabel() }}
                                    </span>
                                    @if ($report->priority)
                                        <div class="mt-1">
                                            <span
                                                class="text-xs px-2 py-0.5 rounded-full flex items-center {{ $report->priority == 'urgent'
                                                    ? 'bg-red-100 text-red-800'
                                                    : ($report->priority == 'high'
                                                        ? 'bg-orange-100 text-orange-800'
                                                        : ($report->priority == 'medium'
                                                            ? 'bg-yellow-100 text-yellow-800'
                                                            : 'bg-gray-100 text-gray-800')) }}">
                                                <i class="fas fa-flag text-xs mr-1"></i>
                                                {{ $report->getPriorityLabel() }}
                                            </span>
                                        </div>
                                    @endif
                                </td>

                                <!-- Action Buttons -->
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center gap-2">
                                        <!-- View -->
                                        <a href="{{ route('admin.reports.show', $report) }}"
                                            class="text-blue-600 hover:text-blue-900 p-1.5 rounded-lg hover:bg-blue-50 transition-colors duration-150"
                                            title="Lihat Detail">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        
                                        <!-- Edit -->
                                        <a href="{{ route('admin.reports.edit', $report) }}"
                                            class="text-yellow-600 hover:text-yellow-900 p-1.5 rounded-lg hover:bg-yellow-50 transition-colors duration-150"
                                            title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        
                                        <!-- Delete -->
                                        <form action="{{ route('admin.reports.destroy', $report) }}" method="POST"
                                            class="inline"
                                            onsubmit="return confirm('Apakah Anda yakin ingin menghapus laporan ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="text-red-600 hover:text-red-900 p-1.5 rounded-lg hover:bg-red-50 transition-colors duration-150"
                                                title="Hapus">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-6 py-12 text-center">
                                    <div class="flex flex-col items-center justify-center">
                                        <div class="bg-gray-100 p-4 rounded-full mb-4">
                                            <i class="fas fa-file-alt text-gray-400 text-3xl"></i>
                                        </div>
                                        <h3 class="text-lg font-medium text-gray-900 mb-2">Tidak ada laporan ditemukan</h3>
                                        <p class="text-gray-500">Coba gunakan filter yang berbeda</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if ($reports->hasPages())
                <div class="px-6 py-4 border-t border-gray-200 bg-gray-50">
                    {{ $reports->withQueryString()->links() }}
                </div>
            @endif
        </div>

        <!-- Additional Info Section -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Priority Distribution -->
            <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-200">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-lg font-semibold text-gray-900">Distribusi Prioritas</h3>
                    <i class="fas fa-chart-pie text-gray-400"></i>
                </div>
                <div class="space-y-4">
                    @php
                        $priorities = [
                            'urgent' => [
                                'count' => \App\Models\Report::where('priority', 'urgent')->count(),
                                'color' => 'bg-red-500',
                                'label' => 'Darurat',
                                'icon' => 'fas fa-exclamation-triangle',
                            ],
                            'high' => [
                                'count' => \App\Models\Report::where('priority', 'high')->count(),
                                'color' => 'bg-orange-500',
                                'label' => 'Tinggi',
                                'icon' => 'fas fa-arrow-up',
                            ],
                            'medium' => [
                                'count' => \App\Models\Report::where('priority', 'medium')->count(),
                                'color' => 'bg-yellow-500',
                                'label' => 'Sedang',
                                'icon' => 'fas fa-minus',
                            ],
                            'low' => [
                                'count' => \App\Models\Report::where('priority', 'low')->count(),
                                'color' => 'bg-gray-500',
                                'label' => 'Rendah',
                                'icon' => 'fas fa-arrow-down',
                            ],
                        ];
                        $totalPriority = array_sum(array_column($priorities, 'count'));
                    @endphp

                    @foreach ($priorities as $key => $data)
                        @if ($totalPriority > 0)
                            @php
                                $percentage = round(($data['count'] / $totalPriority) * 100, 1);
                                $width = $percentage > 0 ? $percentage : 0.5;
                            @endphp
                            <div class="space-y-2">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center gap-3">
                                        <div class="{{ $data['color'] }} bg-opacity-10 p-2 rounded-lg">
                                            <i class="{{ $data['icon'] }} {{ str_replace('bg-', 'text-', $data['color']) }} text-sm"></i>
                                        </div>
                                        <span class="text-sm font-medium text-gray-700">{{ $data['label'] }}</span>
                                    </div>
                                    <div class="text-right">
                                        <span class="text-sm font-semibold text-gray-900">{{ $data['count'] }}</span>
                                        <span class="text-xs text-gray-500 ml-2">{{ $percentage }}%</span>
                                    </div>
                                </div>
                                <div class="h-2 bg-gray-100 rounded-full overflow-hidden">
                                    <div class="h-full {{ $data['color'] }} rounded-full transition-all duration-300"
                                        style="width: {{ $width }}%"></div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>

            <!-- Category Distribution -->
            <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-200">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-lg font-semibold text-gray-900">Distribusi Kategori</h3>
                    <i class="fas fa-chart-bar text-gray-400"></i>
                </div>
                <div class="space-y-4">
                    @php
                        $totalCategory = array_sum(array_column($categoryDistribution, 'count'));
                    @endphp

                    @foreach ($categoryDistribution as $data)
                        @if ($totalCategory > 0)
                            @php
                                $percentage = round(($data['count'] / $totalCategory) * 100, 1);
                                $width = $percentage > 0 ? $percentage : 0.5;
                            @endphp
                            <div class="space-y-2">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center gap-3">
                                        <div class="{{ $data['color'] }} bg-opacity-10 p-2 rounded-lg">
                                            <i class="fas fa-folder text-sm {{ str_replace('bg-', 'text-', $data['color']) }}"></i>
                                        </div>
                                        <span class="text-sm font-medium text-gray-700 truncate">{{ $data['label'] }}</span>
                                    </div>
                                    <div class="text-right">
                                        <span class="text-sm font-semibold text-gray-900">{{ $data['count'] }}</span>
                                        <span class="text-xs text-gray-500 ml-2">{{ $percentage }}%</span>
                                    </div>
                                </div>
                                <div class="h-2 bg-gray-100 rounded-full overflow-hidden">
                                    <div class="h-full {{ $data['color'] }} rounded-full transition-all duration-300"
                                        style="width: {{ $width }}%"></div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-200">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-lg font-semibold text-gray-900">Aksi Cepat</h3>
                    <i class="fas fa-bolt text-gray-400"></i>
                </div>
                <div class="space-y-4">
                    <!-- Buat Laporan Manual -->
                    <a href="{{ route('admin.reports.create') }}"
                        class="flex items-center gap-4 p-4 rounded-xl border border-gray-200 hover:border-blue-300 hover:bg-blue-50 transition-all duration-200 group">
                        <div class="flex-shrink-0 bg-blue-100 group-hover:bg-blue-200 p-3 rounded-lg">
                            <i class="fas fa-plus text-blue-600 text-lg"></i>
                        </div>
                        <div class="flex-1">
                            <div class="font-medium text-gray-900 group-hover:text-blue-600">Buat Laporan Manual</div>
                            <div class="text-sm text-gray-500">Tambah laporan baru</div>
                        </div>
                        <i class="fas fa-chevron-right text-gray-400 group-hover:text-blue-500 transition-colors"></i>
                    </a>

                    <!-- Lihat Statistik -->
                    <a href="{{ route('admin.reports.create') }}"
                        class="flex items-center gap-4 p-4 rounded-xl border border-gray-200 hover:border-green-300 hover:bg-green-50 transition-all duration-200 group">
                        <div class="flex-shrink-0 bg-green-100 group-hover:bg-green-200 p-3 rounded-lg">
                            <i class="fas fa-chart-line text-green-600 text-lg"></i>
                        </div>
                        <div class="flex-1">
                            <div class="font-medium text-gray-900 group-hover:text-green-600">Lihat Statistik</div>
                            <div class="text-sm text-gray-500">Analisis data laporan</div>
                        </div>
                        <i class="fas fa-chevron-right text-gray-400 group-hover:text-green-500 transition-colors"></i>
                    </a>

                    <!-- Laporan Tertunda -->
                    <a href="{{ route('admin.reports.index', ['status' => 'in_progress']) }}"
                        class="flex items-center gap-4 p-4 rounded-xl border border-gray-200 hover:border-red-300 hover:bg-red-50 transition-all duration-200 group">
                        <div class="flex-shrink-0 bg-red-100 group-hover:bg-red-200 p-3 rounded-lg">
                            <i class="fas fa-clock text-red-600 text-lg"></i>
                        </div>
                        <div class="flex-1">
                            <div class="font-medium text-gray-900 group-hover:text-red-600">Laporan Tertunda</div>
                            <div class="text-sm text-gray-500">Perlu tindakan segera</div>
                        </div>
                        <i class="fas fa-chevron-right text-gray-400 group-hover:text-red-500 transition-colors"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Auto submit filter form when status or category changes
        const statusSelect = document.querySelector('select[name="status"]');
        const categorySelect = document.querySelector('select[name="facility_category"]');

        if (statusSelect) {
            statusSelect.addEventListener('change', function() {
                if (this.value !== '') {
                    this.closest('form').submit();
                }
            });
        }

        if (categorySelect) {
            categorySelect.addEventListener('change', function() {
                if (this.value !== '') {
                    this.closest('form').submit();
                }
            });
        }
    });
</script>
@endpush