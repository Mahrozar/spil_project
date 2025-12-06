<x-app-layout>
<div class="max-w-7xl mx-auto py-4 px-6">
    <!-- Notification / Informasi sistem -->
    <div class="mb-4">
        <div id="sys-info" role="status" aria-live="polite" class="rounded-lg border-l-4 border-violet-500 bg-white p-4 relative shadow">
            <div class="flex items-start gap-3">
                <div class="text-violet-600 mt-1">
                    <!-- simple info icon -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M12 2a10 10 0 100 20 10 10 0 000-20z"/></svg>
                </div>
                <div class="flex-1">
                    <div class="font-semibold text-slate-900">Informasi Sistem</div>
                    <div class="text-sm text-slate-600">Tidak ada pemberitahuan baru. Semua sistem berjalan normal.</div>
                </div>
                <div class="ml-4">
                    <button id="sys-info-close" aria-label="Tutup pemberitahuan" class="inline-flex items-center justify-center h-8 w-8 rounded-md text-slate-500 hover:bg-slate-50">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Doughnut Chart with left legend (matches requested layout) -->
    <div class="flex justify-center mb-4">
        <div class="w-full lg:w-2/3">
            <div class="bg-white rounded-lg p-3 shadow">
                <div class="flex items-start justify-between mb-2">
                    <h2 class="text-lg font-semibold">Ringkasan Kategori</h2>
                    <div class="text-sm text-slate-500">Distribusi kategori saat ini</div>
                </div>

                <div class="flex flex-col gap-4 min-h-0">
                    <!-- Date range controls -->
                    <div class="flex items-center gap-3 mb-2">
                        <label class="text-sm text-slate-600">Rentang:</label>
                        <select id="presetRange" class="text-sm border rounded px-2 py-1">
                            <option value="12m" selected>12 Bulan</option>
                            <option value="6m">6 Bulan</option>
                            <option value="3m">3 Bulan</option>
                            <option value="30d">30 Hari</option>
                            <option value="7d">7 Hari</option>
                            <option value="custom">Custom</option>
                        </select>
                        <input type="date" id="fromDate" class="text-sm border rounded px-2 py-1 hidden" />
                        <input type="date" id="toDate" class="text-sm border rounded px-2 py-1 hidden" />
                        <button id="applyRange" aria-label="Terapkan" class="ml-2 px-3 py-1 bg-violet-600 text-white rounded text-sm"><span class="text-white">Terapkan</span></button>
                    </div>
                    <!-- Legend on top to save horizontal space -->
                    <div class="w-full">
                        <ul class="flex flex-wrap items-center gap-4 text-sm text-slate-700">
                            <li class="flex items-center gap-2"><span class="h-3 w-3 rounded-full inline-block" style="background:#41d3a2"></span><span>Surat</span><span id="letters-count" class="ml-1 text-slate-500">({{ $lettersCount }})</span></li>
                            <li class="flex items-center gap-2"><span class="h-3 w-3 rounded-full inline-block" style="background:#2f9bff"></span><span>Laporan</span><span id="reports-count" class="ml-1 text-slate-500">({{ $reportsCount }})</span></li>
                            <li class="flex items-center gap-2"><span class="h-3 w-3 rounded-full inline-block" style="background:#f6b042"></span><span>Penduduk</span><span id="residents-count" class="ml-1 text-slate-500">({{ \App\Models\Resident::count() }})</span></li>
                            <li class="flex items-center gap-2"><span class="h-3 w-3 rounded-full inline-block" style="background:#f87171"></span><span>RT</span><span id="rt-count" class="ml-1 text-slate-500">({{ \App\Models\RT::count() }})</span></li>
                            <li class="flex items-center gap-2"><span class="h-3 w-3 rounded-full inline-block" style="background:#8b5cf6"></span><span>RW</span><span id="rw-count" class="ml-1 text-slate-500">({{ \App\Models\RW::count() }})</span></li>
                        </ul>
                    </div>

                    <!-- Chart area (size controlled by canvas max-width) -->
                    <div class="w-full flex justify-center">
                        <div class="flex items-start justify-center py-1">
                            <canvas id="adminChart" class="w-full max-w-[200px] h-auto"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Summary cards underneath the chart -->
    @include('admin._kpi_cards')

    <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-6 mb-4">
        <x-stat-card title="Surat" :value="$lettersCount" :icon="view('components.icon', ['name' => 'eye', 'class' => 'w-6 h-6 text-violet-500'])->render()" />

        <x-stat-card title="Laporan" :value="$reportsCount" :icon="view('components.icon', ['name' => 'pencil', 'class' => 'w-6 h-6 text-violet-500'])->render()" />

        <x-stat-card title="Penduduk" :value="\App\Models\Resident::count()" :icon="view('components.icon', ['name' => 'users', 'class' => 'w-6 h-6 text-violet-500'])->render()" />

        <x-stat-card title="RT" :value="\App\Models\RT::count()" :icon="view('components.icon', ['name' => 'users', 'class' => 'w-6 h-6 text-violet-500'])->render()" />

        <x-stat-card title="RW" :value="\App\Models\RW::count()" :icon="view('components.icon', ['name' => 'users', 'class' => 'w-6 h-6 text-violet-500'])->render()" />
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
            Number(@json(\App\Models\Resident::count() ?? 0)),
            Number(@json(\App\Models\RT::count() ?? 0)),
            Number(@json(\App\Models\RW::count() ?? 0)),
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

