{{-- resources/views/admin/reports/index.blade.php --}}
<x-app-layout>
    <x-slot name="title">Data Laporan Fasilitas</x-slot>
    <x-slot name="subtitle">Monitoring dan Manajemen Laporan Fasilitas Publik</x-slot>

    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <!-- Stats Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
            @php
                $statusCounts = [
                    'total' => \App\Models\Report::count(),
                    'submitted' => \App\Models\Report::where('status', 'submitted')->count(),
                    'in_progress' => \App\Models\Report::where('status', 'in_progress')->count(),
                    'completed' => \App\Models\Report::where('status', 'completed')->count(),
                ];
            @endphp

            <div class="bg-white rounded-xl p-5 shadow-sm border border-gray-100">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-500">Total Laporan</p>
                        <p class="text-2xl font-bold text-gray-900 mt-1">{{ $statusCounts['total'] }}</p>
                    </div>
                    <div class="bg-blue-50 p-3 rounded-lg">
                        <svg class="h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl p-5 shadow-sm border border-gray-100">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-500">Diajukan</p>
                        <p class="text-2xl font-bold text-gray-900 mt-1">{{ $statusCounts['submitted'] }}</p>
                    </div>
                    <div class="bg-gray-50 p-3 rounded-lg">
                        <svg class="h-6 w-6 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl p-5 shadow-sm border border-gray-100">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-500">Dalam Proses</p>
                        <p class="text-2xl font-bold text-gray-900 mt-1">{{ $statusCounts['in_progress'] }}</p>
                    </div>
                    <div class="bg-yellow-50 p-3 rounded-lg">
                        <svg class="h-6 w-6 text-yellow-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl p-5 shadow-sm border border-gray-100">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-500">Selesai</p>
                        <p class="text-2xl font-bold text-gray-900 mt-1">{{ $statusCounts['completed'] }}</p>
                    </div>
                    <div class="bg-green-50 p-3 rounded-lg">
                        <svg class="h-6 w-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filter Section -->
        <div class="bg-white rounded-2xl shadow-sm p-6 border border-gray-100 mb-6">
            <form method="GET" action="{{ route('admin.reports.index') }}"
                class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Pencarian</label>
                    <input type="text" name="q" value="{{ request('q') }}"
                        placeholder="Cari kode, pelapor, atau alamat"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                    <select name="status"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <option value="">Semua Status</option>
                        @foreach (\App\Models\Report::getStatusLabels() as $key => $label)
                            <option value="{{ $key }}" {{ request('status') == $key ? 'selected' : '' }}>
                                {{ $label }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Kategori</label>
                    <select name="facility_category"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <option value="">Semua Kategori</option>
                        @foreach (\App\Models\Report::getFacilityCategories() as $key => $label)
                            <option value="{{ $key }}"
                                {{ request('facility_category') == $key ? 'selected' : '' }}>
                                {{ $label }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="flex items-end gap-3">
                    <button type="submit"
                        class="flex-1 bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-lg transition-colors">
                        Terapkan Filter
                    </button>
                    <a href="{{ route('admin.reports.index') }}"
                        class="flex-1 border border-gray-300 text-gray-700 font-medium py-2 px-4 rounded-lg hover:bg-gray-50 transition-colors text-center">
                        Reset
                    </a>
                </div>
            </form>
        </div>

        <!-- Data Table -->
        <div class="bg-white rounded-2xl shadow-sm overflow-hidden border border-gray-100">
            <div class="px-6 py-4 border-b border-gray-100 bg-gray-50 flex items-center justify-between">
                <div>
                    <h3 class="text-lg font-semibold text-gray-900">Daftar Laporan</h3>
                    <p class="text-sm text-gray-500 mt-1">Total {{ $reports->total() }} laporan ditemukan</p>
                </div>
                <div class="flex items-center gap-3">
                    <a href="{{ route('admin.reports.export') }}"
                        class="inline-flex items-center gap-2 border border-gray-300 text-gray-700 hover:bg-gray-50 font-medium py-2 px-4 rounded-lg transition-colors">
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4-4m0 0L8 8m4-4v12" />
                        </svg>
                        Export
                    </a>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Kode
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Pelapor
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Kategori
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Lokasi
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Tanggal
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Status
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($reports as $report)
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900">{{ $report->report_code }}</div>
                                    <div class="text-xs text-gray-500">{{ $report->title ?? 'Tidak ada judul' }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">
                                        {{ $report->reporter_name ?? ($report->user->name ?? 'Anonim') }}
                                    </div>
                                    @if ($report->reporter_phone)
                                        <div class="text-xs text-gray-500">{{ $report->reporter_phone }}</div>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">{{ $report->getCategoryLabel() }}</div>
                                    <div class="text-xs text-gray-500">{{ $report->getTypeLabel() }}</div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-sm text-gray-900">{{ Str::limit($report->address, 40) }}</div>
                                    <div class="text-xs text-gray-500">
                                        RT {{ $report->rt ?? '-' }} / RW {{ $report->rw ?? '-' }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $report->created_at->format('d/m/Y') }}<br>
                                    <span class="text-xs">{{ $report->created_at->format('H:i') }}</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="{{ $report->getStatusBadgeClass() }}">
                                        {{ $report->getStatusLabel() }}
                                    </span>
                                    @if ($report->priority)
                                        <div class="mt-1">
                                            <span
                                                class="text-xs px-2 py-0.5 rounded {{ $report->priority == 'urgent'
                                                    ? 'bg-red-100 text-red-800'
                                                    : ($report->priority == 'high'
                                                        ? 'bg-orange-100 text-orange-800'
                                                        : ($report->priority == 'medium'
                                                            ? 'bg-yellow-100 text-yellow-800'
                                                            : 'bg-gray-100 text-gray-800')) }}">
                                                {{ $report->getPriorityLabel() }}
                                            </span>
                                        </div>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm">
                                    <div class="flex items-center gap-2">
                                        <a href="{{ route('admin.reports.show', $report) }}"
                                            class="text-blue-600 hover:text-blue-900 p-1 rounded hover:bg-blue-50"
                                            title="Lihat Detail">
                                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                                                stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                            </svg>
                                        </a>
                                        <a href="{{ route('admin.reports.edit', $report) }}"
                                            class="text-yellow-600 hover:text-yellow-900 p-1 rounded hover:bg-yellow-50"
                                            title="Edit">
                                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                                                stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                        </a>
                                        <form action="{{ route('admin.reports.destroy', $report) }}" method="POST"
                                            class="inline"
                                            onsubmit="return confirm('Apakah Anda yakin ingin menghapus laporan ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="text-red-600 hover:text-red-900 p-1 rounded hover:bg-red-50"
                                                title="Hapus">
                                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                                                    stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-6 py-12 text-center">
                                    <div class="text-gray-400">
                                        <svg class="mx-auto h-12 w-12" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                        </svg>
                                        <p class="mt-2 text-sm text-gray-500">Tidak ada laporan ditemukan</p>
                                        <p class="text-xs text-gray-400 mt-1">Coba gunakan filter yang berbeda</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if ($reports->hasPages())
                <div class="px-6 py-4 border-t border-gray-100 bg-gray-50">
                    {{ $reports->withQueryString()->links() }}
                </div>
            @endif
        </div>

        <!-- Additional Info -->
        <div class="mt-6 grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Priority Distribution -->
            <div class="bg-white rounded-2xl shadow-sm p-6 border border-gray-100">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Distribusi Prioritas</h3>
                <div class="space-y-3">
                    @php
                        $priorities = [
                            'urgent' => [
                                'count' => \App\Models\Report::where('priority', 'urgent')->count(),
                                'color' => 'bg-red-500',
                                'label' => 'Darurat',
                            ],
                            'high' => [
                                'count' => \App\Models\Report::where('priority', 'high')->count(),
                                'color' => 'bg-orange-500',
                                'label' => 'Tinggi',
                            ],
                            'medium' => [
                                'count' => \App\Models\Report::where('priority', 'medium')->count(),
                                'color' => 'bg-yellow-500',
                                'label' => 'Sedang',
                            ],
                            'low' => [
                                'count' => \App\Models\Report::where('priority', 'low')->count(),
                                'color' => 'bg-gray-500',
                                'label' => 'Rendah',
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
                            <div>
                                <div class="flex items-center justify-between mb-1">
                                    <div class="flex items-center gap-2">
                                        <span class="h-2 w-2 rounded-full {{ $data['color'] }}"></span>
                                        <span class="text-sm text-gray-700">{{ $data['label'] }}</span>
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <span class="text-sm font-medium text-gray-900">{{ $data['count'] }}</span>
                                        <span class="text-xs text-gray-500">{{ $percentage }}%</span>
                                    </div>
                                </div>
                                <div class="h-2 bg-gray-100 rounded-full overflow-hidden">
                                    <div class="h-full {{ $data['color'] }} rounded-full"
                                        style="width: {{ $width }}%"></div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>

            <!-- Category Distribution -->
            <div class="bg-white rounded-2xl shadow-sm p-6 border border-gray-100">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Distribusi Kategori</h3>
                <div class="space-y-3">
                    @php
                        $totalCategory = array_sum(array_column($categoryDistribution, 'count'));
                    @endphp

                    @foreach ($categoryDistribution as $data)
                        @if ($totalCategory > 0)
                            @php
                                $percentage = round(($data['count'] / $totalCategory) * 100, 1);
                                $width = $percentage > 0 ? $percentage : 0.5;
                            @endphp
                            <div>
                                <div class="flex items-center justify-between mb-1">
                                    <div class="flex items-center gap-2">
                                        <span class="h-2 w-2 rounded-full {{ $data['color'] }}"></span>
                                        <span
                                            class="text-sm text-gray-700">{{ Str::limit($data['label'], 20) }}</span>
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <span class="text-sm font-medium text-gray-900">{{ $data['count'] }}</span>
                                        <span class="text-xs text-gray-500">{{ $percentage }}%</span>
                                    </div>
                                </div>
                                <div class="h-2 bg-gray-100 rounded-full overflow-hidden">
                                    <div class="h-full {{ $data['color'] }} rounded-full"
                                        style="width: {{ $width }}%"></div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
            <!-- Quick Actions -->
            <div class="bg-white rounded-2xl shadow-sm p-6 border border-gray-100">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Aksi Cepat</h3>
                <div class="space-y-3">
                    <a href=""
                        class="flex items-center gap-3 p-3 rounded-lg border border-gray-200 hover:border-blue-300 hover:shadow-sm transition-all group">
                        <div class="flex-shrink-0 bg-blue-50 group-hover:bg-blue-100 p-2 rounded-lg">
                            <svg class="h-5 w-5 text-blue-600" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4v16m8-8H4" />
                            </svg>
                        </div>
                        <div>
                            <div class="font-medium text-gray-900 group-hover:text-blue-600">Buat Laporan Manual</div>
                            <div class="text-sm text-gray-500">Tambah laporan baru</div>
                        </div>
                    </a>

                    <a href="{{ route('admin.reports.statistics') }}"
                        class="flex items-center gap-3 p-3 rounded-lg border border-gray-200 hover:border-green-300 hover:shadow-sm transition-all group">
                        <div class="flex-shrink-0 bg-green-50 group-hover:bg-green-100 p-2 rounded-lg">
                            <svg class="h-5 w-5 text-green-600" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                            </svg>
                        </div>
                        <div>
                            <div class="font-medium text-gray-900 group-hover:text-green-600">Lihat Statistik</div>
                            <div class="text-sm text-gray-500">Analisis data laporan</div>
                        </div>
                    </a>

                    <a href=""
                        class="flex items-center gap-3 p-3 rounded-lg border border-gray-200 hover:border-red-300 hover:shadow-sm transition-all group">
                        <div class="flex-shrink-0 bg-red-50 group-hover:bg-red-100 p-2 rounded-lg">
                            <svg class="h-5 w-5 text-red-600" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div>
                            <div class="font-medium text-gray-900 group-hover:text-red-600">Laporan Tertunda</div>
                            <div class="text-sm text-gray-500">Perlu tindakan segera</div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            // Auto submit filter form when status or category changes
            document.addEventListener('DOMContentLoaded', function() {
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
</x-app-layout>
