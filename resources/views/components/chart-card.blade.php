@props(['title' => '', 'canvasId' => 'chart', 'height' => 'h-36 md:h-44'])

<div class="chart-card">
    <div class="flex items-center justify-between">
        <h4 class="text-lg font-medium text-slate-700">{{ $title }}</h4>
        <div class="chart-legend">
            {{ $slot }}
        </div>
    </div>
    <div class="mt-4">
        <canvas id="{{ $canvasId }}" class="w-full {{ $height }}"></canvas>
    </div>
</div>
