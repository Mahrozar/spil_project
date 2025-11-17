<x-app-layout>
    {{-- dashboard styles moved to resources/css/admin.css --}}

    <div class="dashboard-frame">
        <div class="dashboard-grid">
            {{-- include shared admin sidebar --}}
            @include('admin.partials.sidebar')
            <!-- Main content area (to the right of fixed sidebar) -->
            <div class="admin-content-area">
                <div class="content-grid">
                    <section>
                    <div class="dashboard-header">
                            <div>
                                <div class="dashboard-title">Surat</div>
                                <div class="dashboard-sub">Kelola pengajuan, persetujuan, dan laporan</div>
                            </div>
                            <div class="header-topbar">
                                <form method="GET" action="{{ route('admin.letters') }}">
                                    <input class="search-box" name="q" placeholder="Cari surat, pengguna, atau jenis" value="{{ request('q') }}" />
                                </form>
                                <a href="{{ route('user.letters.create') }}" class="btn-green rounded-pill">Buat Surat</a>
                                <a href="{{ route('user.reports.create') }}" class="btn-green rounded-pill" style="background:var(--green-700)">Buat Laporan</a>
                                <div class="avatar">A</div>
                            </div>
                        </div>

                    <div class="stats-row">
                        <div class="stat-card large">
                                <div class="stat-left">
                                    <div class="stat-icon">
                                        <!-- letters icon -->
                                        <svg class="icon" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M3 5a2 2 0 012-2h8a2 2 0 012 2v10a1 1 0 01-1 1H4a1 1 0 01-1-1V5z" stroke="currentColor" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                    </div>
                                    <div>
                                        <div class="stat-label">Surat</div>
                                        <div class="stat-value">{{ $lettersCount }}</div>
                                    </div>
                                </div>
                            </div>
                        <div class="stat-card large">
                            <div class="stat-left">
                                <div class="stat-icon">
                                    <!-- reports icon -->
                                    <svg class="icon" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M4 4h12v12H4z" stroke="currentColor" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                </div>
                                <div>
                                    <div class="stat-label">Laporan</div>
                                    <div class="stat-value">{{ $reportsCount }}</div>
                                </div>
                            </div>
                        </div>
                        <div class="stat-card large">
                            <div class="stat-left">
                                <div class="stat-icon">
                                    <!-- tasks icon -->
                                    <svg class="icon" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M6 10l2 2 6-6" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                </div>
                                <div>
                                        <div class="stat-label">Tugas Terbuka</div>
                                        <div class="stat-value">0</div>
                                </div>
                            </div>
                        </div>
                    </div>

                <div class="chart-card">
                    <div class="flex items-center justify-between">
                        <h4 class="text-lg font-medium text-gray-700">Aktivitas bulanan (12 bulan terakhir)</h4>
                        <div class="chart-legend">
                            <div class="legend-item"><span class="legend-swatch letters"></span> Surat</div>
                            <div class="legend-item"><span class="legend-swatch reports"></span> Laporan</div>
                        </div>
                    </div>
                    <div class="mt-4">
                        <canvas id="activityChart" class="w-full" height="320"
                            data-labels='{!! json_encode($labels) !!}'
                            data-letters='{!! json_encode($lettersData) !!}'
                            data-reports='{!! json_encode($reportsData) !!}'
                        ></canvas>
                    </div>
                </div>

                <div class="mt-4 grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="widget">
                        <h5 class="font-semibold mb-2">Surat Terbaru</h5>
                        <p class="text-sm text-gray-500">Tidak ada surat terbaru.</p>
                    </div>
                    <div class="widget">
                        <h5 class="font-semibold mb-2">Laporan Terbaru</h5>
                        <p class="text-sm text-gray-500">Tidak ada laporan terbaru.</p>
                    </div>
                </div>
                    </section>

                    <!-- Right widgets -->
                    <aside>
                        <div class="widget mt-4">
                            <h5 class="font-semibold mb-2">Statistik</h5>
                            <div class="text-sm text-gray-600">Surat tahun ini: {{ $lettersCount }}</div>
                            <div class="text-sm text-gray-600">Laporan tahun ini: {{ $reportsCount }}</div>
                        </div>
                    </aside>
                </div>
            </div>
        </div>
    </div>

    {{-- External admin assets (CSS/JS). Use CDN for Chart.js as a fallback if node deps aren't installed --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
    @vite(['resources/css/admin.css', 'resources/js/admin.js'])
</x-app-layout>
