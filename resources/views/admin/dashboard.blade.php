<x-app-layout>
<div class="max-w-6xl mx-auto py-6 px-4">
    <!-- Notification: subtle and minimal -->
    <div class="mb-6">
        <div id="sys-info" role="status" aria-live="polite" class="rounded-lg bg-white p-4 shadow-sm border-l-4 border-green-500">
            <div class="flex items-start gap-4">
                <div class="flex-shrink-0 bg-green-50 rounded-full p-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4"/></svg>
                </div>
                <div class="flex-1">
                    <div class="flex items-center justify-between">
                        <div>
                            <div class="text-sm font-semibold text-slate-900">Informasi Sistem</div>
                            <div class="text-sm text-slate-600">Semua sistem berjalan normal.</div>
                        </div>
                        <div class="ml-4">
                            <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-green-50 text-green-700 text-xs font-medium">● Aktif</span>
                        </div>
                    </div>
                    <div class="mt-2 text-sm text-slate-500">Tidak ada pemberitahuan baru. Jika ada gangguan, akan muncul di sini beserta petunjuk tindakan.</div>
                </div>
                <div class="ml-3">
                    <button id="sys-info-close" aria-label="Tutup pemberitahuan" class="inline-flex items-center justify-center h-8 w-8 rounded-md text-slate-500 hover:bg-slate-50">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Chart card: centered, minimal legend -->
    <div class="mb-6">
        <div class="bg-white rounded-2xl shadow-sm p-5">
            <div class="flex items-center justify-between mb-4">
                <div>
                    <h2 class="text-lg font-semibold text-slate-900">Ringkasan Kategori</h2>
                    <div class="text-xs text-slate-500">Distribusi kategori saat ini</div>
                </div>
                <div class="flex items-center gap-3">
                    <label class="text-sm text-slate-500">Rentang</label>
                    <select id="presetRange" class="text-sm border rounded px-2 py-1 bg-transparent text-slate-700">
                        <option value="12m" selected>12 Bulan</option>
                        <option value="6m">6 Bulan</option>
                        <option value="3m">3 Bulan</option>
                        <option value="30d">30 Hari</option>
                        <option value="7d">7 Hari</option>
                        <option value="custom">Custom</option>
                    </select>
                </div>
            </div>

            <div class="flex flex-col lg:flex-row items-center lg:items-start gap-6">
                <div class="flex-1 flex justify-center">
                    <canvas id="adminChart" class="w-full max-w-[320px] h-auto"></canvas>
                </div>
                <div class="w-full lg:w-1/3">
                    <ul class="space-y-3">
                        <li class="flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <span class="inline-block h-3 w-3 rounded-full" style="background:#41d3a2"></span>
                                <span class="text-sm text-slate-700">Surat</span>
                            </div>
                            <span id="letters-count" class="text-sm text-slate-500">({{ $lettersCount }})</span>
                        </li>
                        <li class="flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <span class="inline-block h-3 w-3 rounded-full" style="background:#2f9bff"></span>
                                <span class="text-sm text-slate-700">Laporan</span>
                            </div>
                            <span id="reports-count" class="text-sm text-slate-500">({{ $reportsCount }})</span>
                        </li>
                        <li class="flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <span class="inline-block h-3 w-3 rounded-full" style="background:#f6b042"></span>
                                <span class="text-sm text-slate-700">Penduduk</span>
                            </div>
                            <span id="residents-count" class="text-sm text-slate-500">({{ $residentsTotal }})</span>
                        </li>
                        <li class="flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <span class="inline-block h-3 w-3 rounded-full" style="background:#f87171"></span>
                                <span class="text-sm text-slate-700">RT</span>
                            </div>
                            <span id="rt-count" class="text-sm text-slate-500">({{ $rtTotal }})</span>
                        </li>
                        <li class="flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <span class="inline-block h-3 w-3 rounded-full" style="background:#8b5cf6"></span>
                                <span class="text-sm text-slate-700">RW</span>
                            </div>
                            <span id="rw-count" class="text-sm text-slate-500">({{ $rwTotal }})</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Summary cards underneath the chart -->
    @include('admin._kpi_cards')

    <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-6 mb-4">
        <x-stat-card title="Surat" :value="$lettersCount" :icon="view('components.icon', ['name' => 'eye', 'class' => 'w-6 h-6 text-violet-500'])->render()" />

        <x-stat-card title="Laporan" :value="$reportsCount" :icon="view('components.icon', ['name' => 'pencil', 'class' => 'w-6 h-6 text-violet-500'])->render()" />

        <x-stat-card title="Penduduk" :value="$residentsTotal" :icon="view('components.icon', ['name' => 'users', 'class' => 'w-6 h-6 text-violet-500'])->render()" />

        <x-stat-card title="RT" :value="$rtTotal" :icon="view('components.icon', ['name' => 'users', 'class' => 'w-6 h-6 text-violet-500'])->render()" />

        <x-stat-card title="RW" :value="$rwTotal" :icon="view('components.icon', ['name' => 'users', 'class' => 'w-6 h-6 text-violet-500'])->render()" />
    </div>

    @include('admin._recent_activity')

    <div class="card">
        <h3 class="font-semibold mb-3">Aktivitas Bulanan</h3>
        <p class="text-sm text-slate-500">Grafik menunjukkan jumlah Surat & Laporan selama 12 bulan terakhir.</p>
    </div>

    @push('head')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    @endpush

    @push('scripts')
    <script>
    document.addEventListener('DOMContentLoaded', function(){
        // Notification dismissal persistence
        const infoEl = document.getElementById('sys-info');
        const closeBtn = document.getElementById('sys-info-close');
        try {
            const dismissed = localStorage.getItem('admin.sysInfoDismissed');
            if (dismissed === '1' && infoEl) {
                infoEl.classList.add('hidden');
            }
        } catch(e) { /* ignore storage errors */ }

        if (closeBtn && infoEl) {
            closeBtn.addEventListener('click', function(){
                try { localStorage.setItem('admin.sysInfoDismissed', '1'); } catch(e) {}
                infoEl.classList.add('hidden');
            });
        }

        // Chart init — doughnut with left-side legend
        const ctx = document.getElementById('adminChart');
        if (!ctx) return;

        const doughnutLabels = ['Surat','Laporan','Penduduk','RT','RW'];
        const doughnutData = [
            Number(@json($lettersCount ?? 0)),
            Number(@json($reportsCount ?? 0)),
            Number(@json($residentsTotal ?? 0)),
            Number(@json($rtTotal ?? 0)),
            Number(@json($rwTotal ?? 0)),
        ];

        const colors = ['#41d3a2','#2f9bff','#f6b042','#f87171','#8b5cf6'];

        // compute total dynamically from current dataset when needed

        // create chart and keep reference for updates
        window.adminChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: doughnutLabels,
                datasets: [{
                    data: doughnutData,
                    backgroundColor: colors,
                    borderColor: '#ffffff',
                    borderWidth: 2,
                    hoverOffset: 10
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: true,
                aspectRatio: 1,
                cutout: '60%',
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        callbacks: {
                            label: function(ctx) {
                                const val = ctx.parsed;
                                const ds = ctx.chart.data.datasets[ctx.datasetIndex].data;
                                const totalNow = ds.reduce((a,b) => a + b, 0);
                                const pct = totalNow ? Math.round((val / totalNow) * 100) : 0;
                                return ctx.label + ': ' + val + ' (' + pct + '%)';
                            }
                        }
                    }
                }
            }
        });

        // helper to update legend counts shown in HTML
        function updateCounts(lettersCount, reportsCount, residentsCount, rtCount, rwCount) {
            const lettersEl = document.getElementById('letters-count');
            const reportsEl = document.getElementById('reports-count');
            const residentsEl = document.getElementById('residents-count');
            const rtEl = document.getElementById('rt-count');
            const rwEl = document.getElementById('rw-count');
            if (lettersEl) lettersEl.textContent = '(' + lettersCount + ')';
            if (reportsEl) reportsEl.textContent = '(' + reportsCount + ')';
            if (residentsEl) residentsEl.textContent = '(' + residentsCount + ')';
            if (rtEl) rtEl.textContent = '(' + rtCount + ')';
            if (rwEl) rwEl.textContent = '(' + rwCount + ')';
        }

        // fetch data for a given range and update chart
        async function fetchAndUpdate(from, to) {
            const q = new URLSearchParams();
            if (from) q.set('from', from);
            if (to) q.set('to', to);
            const url = '/admin/dashboard/data?' + q.toString();
            try {
                const res = await fetch(url, { headers: { 'X-Requested-With': 'XMLHttpRequest' } });
                if (!res.ok) throw new Error('Network error');
                const body = await res.json();
                // update chart (donut uses category counts, not monthly labels)
                if (window.adminChart) {
                    const a = Number(body.lettersCount || 0);
                    const b = Number(body.reportsCount || 0);
                    const c = Number(body.residentsCount || 0);
                    const d = Number(body.rtCount || 0);
                    const e = Number(body.rwCount || 0);
                    window.adminChart.data.datasets[0].data = [a, b, c, d, e];
                    window.adminChart.update();
                    updateCounts(a, b, c, d, e);
                }
            } catch (e) {
                console.error('Failed to fetch dashboard data', e);
            }
        }

        // preset/date control behavior
        const preset = document.getElementById('presetRange');
        const fromInput = document.getElementById('fromDate');
        const toInput = document.getElementById('toDate');
        const applyBtn = document.getElementById('applyRange');

        function showHideCustom(show) {
            fromInput.classList.toggle('hidden', !show);
            toInput.classList.toggle('hidden', !show);
        }

        preset.addEventListener('change', function(){
            if (this.value === 'custom') {
                showHideCustom(true);
            } else {
                showHideCustom(false);
            }
        });

        applyBtn.addEventListener('click', function(){
            const val = preset.value;
            let from, to;
            const today = new Date();
            if (val === 'custom') {
                from = fromInput.value;
                to = toInput.value;
                if (!from || !to) { alert('Pilih tanggal dari dan sampai'); return; }
            } else if (val.endsWith('m')) {
                const months = parseInt(val.replace('m',''));
                const end = new Date(today.getFullYear(), today.getMonth(), 1);
                const start = new Date(end.getFullYear(), end.getMonth() - (months - 1), 1);
                from = start.toISOString().slice(0,10);
                // set to end of current month
                const lastDay = new Date(today.getFullYear(), today.getMonth()+1, 0);
                to = lastDay.toISOString().slice(0,10);
            } else if (val.endsWith('d')) {
                const days = parseInt(val.replace('d',''));
                const start = new Date(today.getFullYear(), today.getMonth(), today.getDate() - (days - 1));
                from = start.toISOString().slice(0,10);
                to = today.toISOString().slice(0,10);
            }
            fetchAndUpdate(from, to);
        });

    });
    </script>
    @endpush

</div>
</x-app-layout>

