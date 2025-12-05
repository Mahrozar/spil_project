<div class="chart-card">
    <div class="flex items-center justify-between">
        <h4 class="text-lg font-medium text-slate-700">{{ $title }}</h4>
        <div class="chart-legend">
            {{ $slot }}
        </div>
    </div>
    <div class="mt-4">
        <canvas id="{{ $canvasId }}" height="220"></canvas>
    </div>
</div>
