@props(['title' => '', 'labels' => [], 'letters' => [], 'reports' => []])

<div class="chart-card">
    <div class="flex items-center justify-between mb-4">
        <div>
            <h4 class="font-semibold">{{ $title }}</h4>
            <p class="text-sm text-muted">Aktivitas bulanan</p>
        </div>
    </div>

    <div class="chart-legend mb-3">
        <div class="legend-item"><span class="legend-swatch letters"></span> Surat</div>
        <div class="legend-item"><span class="legend-swatch reports"></span> Laporan</div>
    </div>

    <canvas id="activityChart" data-labels='{{ json_encode($labels) }}' data-letters='{{ json_encode($letters) }}' data-reports='{{ json_encode($reports) }}'></canvas>
</div>
