@extends('layouts.app') {{-- Sesuaikan dengan nama file layout Anda --}}

@section('title', 'Dashboard Admin')

@section('subtitle', 'Ringkasan Statistik dan Aktivitas Terkini')

@section('content')
    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <!-- Notification -->
        <div class="mb-6">
            <div id="sys-info" role="status" aria-live="polite"
                class="rounded-xl bg-gradient-to-r from-green-50 to-emerald-50 p-5 shadow-sm border border-green-100">
                <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                    <div class="flex items-start gap-3">
                        <div class="flex-shrink-0 bg-green-100 rounded-full p-2">
                            <i class="fas fa-check-circle text-green-600 text-lg"></i>
                        </div>
                        <div>
                            <div class="text-sm font-semibold text-gray-900">Sistem Berjalan Normal</div>
                            <div class="text-sm text-gray-600 mt-1">
                                Semua layanan beroperasi dengan baik.
                                <span class="font-medium">{{ $residentsTotal }}</span> penduduk terdaftar dalam sistem.
                            </div>
                        </div>
                    </div>
                    <div class="flex items-center gap-3">
                        <span
                            class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-green-100 text-green-800 text-xs font-medium">
                            <span class="h-1.5 w-1.5 rounded-full bg-green-500 animate-pulse"></span>
                            Aktif
                        </span>
                        <button id="sys-info-close" aria-label="Tutup pemberitahuan"
                            class="inline-flex items-center justify-center h-8 w-8 rounded-lg text-gray-400 hover:text-gray-600 hover:bg-gray-100 transition-colors">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Stats Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4 mb-6">
            @php
                $stats = [
                    [
                        'title' => 'Total Surat',
                        'value' => $lettersCount,
                        'change' => $kpis['surat']['change']['percent'] ?? 0,
                        'trend' => $kpis['surat']['change']['trend'] ?? 'neutral',
                        'delta' => $kpis['surat']['change']['delta'] ?? 0,
                        'icon' => 'fas fa-envelope',
                        'bgColor' => 'bg-blue-50',
                        'iconColor' => 'text-blue-600',
                    ],
                    [
                        'title' => 'Total Laporan',
                        'value' => $reportsCount,
                        'change' => $kpis['laporan']['change']['percent'] ?? 0,
                        'trend' => $kpis['laporan']['change']['trend'] ?? 'neutral',
                        'delta' => $kpis['laporan']['change']['delta'] ?? 0,
                        'icon' => 'fas fa-file-alt',
                        'bgColor' => 'bg-orange-50',
                        'iconColor' => 'text-orange-600',
                    ],
                    [
                        'title' => 'Total Penduduk',
                        'value' => $residentsTotal,
                        'change' => $kpis['penduduk']['change']['percent'] ?? 0,
                        'trend' => $kpis['penduduk']['change']['trend'] ?? 'neutral',
                        'delta' => $kpis['penduduk']['change']['delta'] ?? 0,
                        'icon' => 'fas fa-users',
                        'bgColor' => 'bg-green-50',
                        'iconColor' => 'text-green-600',
                    ],
                    [
                        'title' => 'RT Terdaftar',
                        'value' => $rtTotal,
                        'change' => $kpis['rt']['change']['percent'] ?? 0,
                        'trend' => $kpis['rt']['change']['trend'] ?? 'neutral',
                        'delta' => $kpis['rt']['change']['delta'] ?? 0,
                        'icon' => 'fas fa-home',
                        'bgColor' => 'bg-purple-50',
                        'iconColor' => 'text-purple-600',
                    ],
                    [
                        'title' => 'RW Terdaftar',
                        'value' => $rwTotal,
                        'change' => $kpis['rw']['change']['percent'] ?? 0,
                        'trend' => $kpis['rw']['change']['trend'] ?? 'neutral',
                        'delta' => $kpis['rw']['change']['delta'] ?? 0,
                        'icon' => 'fas fa-building',
                        'bgColor' => 'bg-indigo-50',
                        'iconColor' => 'text-indigo-600',
                    ],
                ];
            @endphp

            @foreach ($stats as $stat)
                <div class="bg-white rounded-xl p-5 shadow-sm border border-gray-100 hover:shadow-md transition-shadow">
                    <div class="flex items-center justify-between">
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-medium text-gray-500 truncate">{{ $stat['title'] }}</p>
                            <p class="text-2xl font-bold text-gray-900 mt-1">{{ number_format($stat['value']) }}</p>
                            <div class="flex items-center mt-2 space-x-1">
                                @if ($stat['trend'] === 'up')
                                    <span class="text-xs text-green-600 font-medium flex items-center">
                                        <i class="fas fa-arrow-up mr-0.5 text-xs"></i>
                                        {{ $stat['change'] }}%
                                    </span>
                                    @if ($stat['delta'] != 0)
                                        <span class="text-xs text-gray-500">
                                            ({{ $stat['delta'] > 0 ? '+' : '' }}{{ $stat['delta'] }} bulan ini)
                                        </span>
                                    @endif
                                @elseif($stat['trend'] === 'down')
                                    <span class="text-xs text-red-600 font-medium flex items-center">
                                        <i class="fas fa-arrow-down mr-0.5 text-xs"></i>
                                        {{ $stat['change'] }}%
                                    </span>
                                    @if ($stat['delta'] != 0)
                                        <span class="text-xs text-gray-500">
                                            ({{ $stat['delta'] }} bulan ini)
                                        </span>
                                    @endif
                                @else
                                    <span class="text-xs text-gray-500">Tidak ada perubahan</span>
                                @endif
                            </div>
                        </div>
                        <div class="{{ $stat['bgColor'] }} p-3 rounded-lg ml-3 flex-shrink-0">
                            <i class="{{ $stat['icon'] }} {{ $stat['iconColor'] }} text-lg"></i>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Main Content Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
            <!-- Monthly Activity Chart -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-2xl shadow-sm p-6 border border-gray-100 h-full">
                    <div class="flex flex-col sm:flex-row sm:items-center justify-between mb-6">
                        <div>
                            <h2 class="text-lg font-semibold text-gray-900">Aktivitas Bulanan</h2>
                            <p class="text-sm text-gray-500 mt-1">Statistik Surat & Laporan 12 bulan terakhir</p>
                        </div>
                        <div class="flex items-center gap-3 mt-3 sm:mt-0">
                            <label class="text-sm text-gray-500">Periode:</label>
                            <select id="presetRange"
                                class="text-sm border border-gray-300 rounded-lg px-3 py-1.5 bg-white text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                <option value="12m" selected>12 Bulan</option>
                                <option value="6m">6 Bulan</option>
                                <option value="3m">3 Bulan</option>
                                <option value="30d">30 Hari</option>
                                <option value="7d">7 Hari</option>
                            </select>
                        </div>
                    </div>

                    <div class="h-80">
                        <canvas id="monthlyChart"></canvas>
                    </div>

                    <div class="flex items-center justify-center gap-6 mt-6">
                        <div class="flex items-center gap-2">
                            <div class="h-3 w-3 rounded-full bg-blue-500"></div>
                            <span class="text-sm text-gray-600">Surat</span>
                            <span class="text-sm font-medium text-gray-900">{{ $lettersCount }}</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <div class="h-3 w-3 rounded-full bg-orange-500"></div>
                            <span class="text-sm text-gray-600">Laporan</span>
                            <span class="text-sm font-medium text-gray-900">{{ $reportsCount }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Distribution Chart -->
            <div>
                <div class="bg-white rounded-2xl shadow-sm p-6 border border-gray-100 h-full">
                    <div class="mb-6">
                        <h2 class="text-lg font-semibold text-gray-900">Distribusi Data</h2>
                        <p class="text-sm text-gray-500 mt-1">Persentase setiap kategori</p>
                    </div>

                    <div class="h-64 flex items-center justify-center mb-6">
                        <canvas id="distributionChart"></canvas>
                    </div>

                    <div class="space-y-3">
                        @php
                            $total = $lettersCount + $reportsCount + $residentsTotal + $rtTotal + $rwTotal;
                            $items = [
                                [
                                    'label' => 'Surat',
                                    'count' => $lettersCount,
                                    'color' => 'bg-blue-500',
                                    'bg' => 'bg-blue-50',
                                    'text' => 'text-blue-700',
                                ],
                                [
                                    'label' => 'Laporan',
                                    'count' => $reportsCount,
                                    'color' => 'bg-orange-500',
                                    'bg' => 'bg-orange-50',
                                    'text' => 'text-orange-700',
                                ],
                                [
                                    'label' => 'Penduduk',
                                    'count' => $residentsTotal,
                                    'color' => 'bg-green-500',
                                    'bg' => 'bg-green-50',
                                    'text' => 'text-green-700',
                                ],
                                [
                                    'label' => 'RT',
                                    'count' => $rtTotal,
                                    'color' => 'bg-purple-500',
                                    'bg' => 'bg-purple-50',
                                    'text' => 'text-purple-700',
                                ],
                                [
                                    'label' => 'RW',
                                    'count' => $rwTotal,
                                    'color' => 'bg-indigo-500',
                                    'bg' => 'bg-indigo-50',
                                    'text' => 'text-indigo-700',
                                ],
                            ];
                        @endphp

                        @foreach ($items as $item)
                            @if ($total > 0)
                                @php
                                    $percentage = round(($item['count'] / $total) * 100, 1);
                                    $width = $percentage > 0 ? $percentage : 0.5;
                                @endphp
                                <div>
                                    <div class="flex items-center justify-between mb-1">
                                        <div class="flex items-center gap-2">
                                            <span class="h-2 w-2 rounded-full {{ $item['color'] }}"></span>
                                            <span class="text-sm text-gray-700">{{ $item['label'] }}</span>
                                        </div>
                                        <div class="flex items-center gap-2">
                                            <span
                                                class="text-sm font-medium text-gray-900">{{ number_format($item['count']) }}</span>
                                            <span class="text-xs text-gray-500">{{ $percentage }}%</span>
                                        </div>
                                    </div>
                                    <div class="h-2 bg-gray-100 rounded-full overflow-hidden">
                                        <div class="h-full {{ $item['color'] }} rounded-full"
                                            style="width: {{ $width }}%"></div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Activity & Quick Actions -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
            <!-- Recent Activity -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-2xl shadow-sm p-6 border border-gray-100 h-full">
                    <div class="flex items-center justify-between mb-6">
                        <div>
                            <h2 class="text-lg font-semibold text-gray-900">Aktivitas Terkini</h2>
                            <p class="text-sm text-gray-500 mt-1">Update terbaru dari sistem</p>
                        </div>
                        <a href="{{ route('admin.submissions.index') }}"
                            class="text-sm text-blue-600 hover:text-blue-800 font-medium">
                            Lihat Semua →
                        </a>
                    </div>

                    <div class="space-y-4">
                        @forelse($recentActivities as $activity)
                            <div class="flex items-start gap-3 p-3 rounded-lg hover:bg-gray-50 transition-colors">
                                <div class="flex-shrink-0">
                                    @switch($activity['type'] ?? '')
                                        @case('surat')
                                            <div class="h-8 w-8 rounded-full bg-blue-100 flex items-center justify-center">
                                                <i class="fas fa-envelope text-blue-600 text-sm"></i>
                                            </div>
                                        @break

                                        @case('laporan')
                                            <div class="h-8 w-8 rounded-full bg-orange-100 flex items-center justify-center">
                                                <i class="fas fa-file-alt text-orange-600 text-sm"></i>
                                            </div>
                                        @break

                                        @case('penduduk')
                                            <div class="h-8 w-8 rounded-full bg-green-100 flex items-center justify-center">
                                                <i class="fas fa-users text-green-600 text-sm"></i>
                                            </div>
                                        @break

                                        @case('import')
                                            <div class="h-8 w-8 rounded-full bg-purple-100 flex items-center justify-center">
                                                <i class="fas fa-file-import text-purple-600 text-sm"></i>
                                            </div>
                                        @break

                                        @default
                                            <div class="h-8 w-8 rounded-full bg-gray-100 flex items-center justify-center">
                                                <i class="fas fa-info-circle text-gray-600 text-sm"></i>
                                            </div>
                                    @endswitch
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-medium text-gray-900">
                                        {{ $activity['message'] ?? 'Aktivitas' }}
                                    </p>
                                    <p class="text-xs text-gray-500 mt-1">
                                        {{ $activity['time']->diffForHumans() }}
                                    </p>
                                </div>
                                @if (isset($activity['link']))
                                    <a href="{{ $activity['link'] }}"
                                        class="flex-shrink-0 text-blue-600 hover:text-blue-800">
                                        <i class="fas fa-chevron-right"></i>
                                    </a>
                                @endif
                            </div>
                        @empty
                            <div class="text-center py-8">
                                <i class="fas fa-envelope mx-auto h-12 w-12 text-gray-400"></i>
                                <p class="mt-2 text-sm text-gray-500">Belum ada aktivitas terbaru</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div>
                <div class="bg-white rounded-2xl shadow-sm p-6 border border-gray-100 h-full">
                    <div class="mb-6">
                        <h2 class="text-lg font-semibold text-gray-900">Aksi Cepat</h2>
                        <p class="text-sm text-gray-500 mt-1">Navigasi cepat ke fitur utama</p>
                    </div>

                    <div class="space-y-4">
                        <a href="{{ route('admin.submissions.index') }}"
                            class="flex items-center gap-3 p-4 rounded-xl border border-gray-100 hover:border-blue-300 hover:shadow-sm transition-all group">
                            <div class="flex-shrink-0 bg-blue-50 group-hover:bg-blue-100 p-3 rounded-lg transition-colors">
                                <i class="fas fa-envelope text-blue-600"></i>
                            </div>
                            <div>
                                <h3 class="font-medium text-gray-900 group-hover:text-blue-600">Kelola Surat</h3>
                                <p class="text-sm text-gray-500 mt-1">Lihat dan proses pengajuan</p>
                            </div>
                        </a>

                        <a href=""
                            class="flex items-center gap-3 p-4 rounded-xl border border-gray-100 hover:border-orange-300 hover:shadow-sm transition-all group">
                            <div class="flex-shrink-0 bg-orange-50 group-hover:bg-orange-100 p-3 rounded-lg transition-colors">
                                <i class="fas fa-file-alt text-orange-600"></i>
                            </div>
                            <div>
                                <h3 class="font-medium text-gray-900 group-hover:text-orange-600">Lihat Laporan</h3>
                                <p class="text-sm text-gray-500 mt-1">Tinjau laporan dari warga</p>
                            </div>
                        </a>

                        <a href="{{ route('admin.residents.index') }}"
                            class="flex items-center gap-3 p-4 rounded-xl border border-gray-100 hover:border-green-300 hover:shadow-sm transition-all group">
                            <div class="flex-shrink-0 bg-green-50 group-hover:bg-green-100 p-3 rounded-lg transition-colors">
                                <i class="fas fa-users text-green-600"></i>
                            </div>
                            <div>
                                <h3 class="font-medium text-gray-900 group-hover:text-green-600">Data Penduduk</h3>
                                <p class="text-sm text-gray-500 mt-1">Kelola data kependudukan</p>
                            </div>
                        </a>

                        <a href="{{ route('admin.rts.index') }}"
                            class="flex items-center gap-3 p-4 rounded-xl border border-gray-100 hover:border-purple-300 hover:shadow-sm transition-all group">
                            <div class="flex-shrink-0 bg-purple-50 group-hover:bg-purple-100 p-3 rounded-lg transition-colors">
                                <i class="fas fa-home text-purple-600"></i>
                            </div>
                            <div>
                                <h3 class="font-medium text-gray-900 group-hover:text-purple-600">Data RT</h3>
                                <p class="text-sm text-gray-500 mt-1">Kelola data RT</p>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('head')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
@endpush

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Notification dismissal
            const infoEl = document.getElementById('sys-info');
            const closeBtn = document.getElementById('sys-info-close');

            try {
                const dismissed = localStorage.getItem('admin.sysInfoDismissed');
                if (dismissed === '1' && infoEl) {
                    infoEl.style.display = 'none';
                }
            } catch (e) {}

            if (closeBtn && infoEl) {
                closeBtn.addEventListener('click', function() {
                    try {
                        localStorage.setItem('admin.sysInfoDismissed', '1');
                    } catch (e) {}
                    infoEl.style.display = 'none';
                });
            }

            // Initialize Monthly Activity Chart
            const monthlyCtx = document.getElementById('monthlyChart');
            if (monthlyCtx) {
                window.monthlyChart = new Chart(monthlyCtx, {
                    type: 'line',
                    data: {
                        labels: @json($labels),
                        datasets: [{
                                label: 'Surat',
                                data: @json($lettersData),
                                borderColor: '#3b82f6',
                                backgroundColor: 'rgba(59, 130, 246, 0.1)',
                                borderWidth: 2,
                                fill: true,
                                tension: 0.4
                            },
                            {
                                label: 'Laporan',
                                data: @json($reportsData),
                                borderColor: '#f97316',
                                backgroundColor: 'rgba(249, 115, 22, 0.1)',
                                borderWidth: 2,
                                fill: true,
                                tension: 0.4
                            }
                        ]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                display: false
                            },
                            tooltip: {
                                mode: 'index',
                                intersect: false
                            }
                        },
                        scales: {
                            y: {
                                beginAtZero: true,
                                grid: {
                                    drawBorder: false
                                },
                                ticks: {
                                    stepSize: 1,
                                    callback: function(value) {
                                        if (Math.floor(value) === value) {
                                            return value;
                                        }
                                    }
                                }
                            },
                            x: {
                                grid: {
                                    display: false
                                }
                            }
                        }
                    }
                });
            }

            // Initialize Distribution Chart (Doughnut)
            const distributionCtx = document.getElementById('distributionChart');
            if (distributionCtx) {
                window.distributionChart = new Chart(distributionCtx, {
                    type: 'doughnut',
                    data: {
                        labels: ['Surat', 'Laporan', 'Penduduk', 'RT', 'RW'],
                        datasets: [{
                            data: [
                                {{ $lettersCount }},
                                {{ $reportsCount }},
                                {{ $residentsTotal }},
                                {{ $rtTotal }},
                                {{ $rwTotal }}
                            ],
                            backgroundColor: [
                                '#3b82f6',
                                '#f97316',
                                '#10b981',
                                '#8b5cf6',
                                '#6366f1'
                            ],
                            borderWidth: 2,
                            borderColor: '#ffffff',
                            hoverOffset: 15
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        cutout: '65%',
                        plugins: {
                            legend: {
                                display: false
                            },
                            tooltip: {
                                callbacks: {
                                    label: function(context) {
                                        const label = context.label || '';
                                        const value = context.parsed;
                                        const total = context.dataset.data.reduce((a, b) => a + b, 0);
                                        const percentage = total ? Math.round((value / total) * 100) :
                                            0;
                                        return `${label}: ${value} (${percentage}%)`;
                                    }
                                }
                            }
                        }
                    }
                });
            }

            // Range selector functionality
            const presetSelect = document.getElementById('presetRange');

            if (presetSelect) {
                presetSelect.addEventListener('change', async function() {
                    const preset = this.value;
                    let from = '',
                        to = '';

                    const today = new Date();
                    const start = new Date();

                    switch (preset) {
                        case '12m':
                            start.setMonth(today.getMonth() - 11);
                            break;
                        case '6m':
                            start.setMonth(today.getMonth() - 5);
                            break;
                        case '3m':
                            start.setMonth(today.getMonth() - 2);
                            break;
                        case '30d':
                            start.setDate(today.getDate() - 29);
                            break;
                        case '7d':
                            start.setDate(today.getDate() - 6);
                            break;
                    }

                    from = start.toISOString().split('T')[0];
                    to = today.toISOString().split('T')[0];

                    try {
                        const response = await fetch(`/admin/dashboard/data?from=${from}&to=${to}`);
                        const data = await response.json();

                        if (window.monthlyChart) {
                            window.monthlyChart.data.labels = data.labels;
                            window.monthlyChart.data.datasets[0].data = data.lettersData;
                            window.monthlyChart.data.datasets[1].data = data.reportsData;
                            window.monthlyChart.update();
                        }

                        // Show loading state
                        presetSelect.disabled = true;
                        setTimeout(() => {
                            presetSelect.disabled = false;
                        }, 500);

                    } catch (error) {
                        console.error('Error fetching data:', error);
                        alert('Gagal memuat data untuk periode yang dipilih');
                        presetSelect.disabled = false;
                    }
                });
            }
        });
    </script>
@endpush