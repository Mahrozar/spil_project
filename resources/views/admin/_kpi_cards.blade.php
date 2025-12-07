<div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-3 mb-3">
    @php
        $map = [
            'surat' => ['label' => 'Surat', 'color' => 'bg-violet-500', 'svg' => '<svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path d="M12 20v-8" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><path d="M5 12h14" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>'],
            'laporan' => ['label' => 'Laporan', 'color' => 'bg-blue-500', 'svg' => '<svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path d="M12 5v14" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><path d="M5 12h14" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>'],
            'penduduk' => ['label' => 'Penduduk', 'color' => 'bg-yellow-500', 'svg' => '<svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path d="M12 12a4 4 0 1 0 0-8 4 4 0 0 0 0 8z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><path d="M6 20a6 6 0 0 1 12 0" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>'],
            'rt' => ['label' => 'RT', 'color' => 'bg-red-500', 'svg' => '<svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path d="M3 12h18" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><path d="M12 3v18" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>'],
            'rw' => ['label' => 'RW', 'color' => 'bg-purple-500', 'svg' => '<svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path d="M3 7h18" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><path d="M3 17h18" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>'],
        ];
    @endphp

    @foreach($kpis as $key => $k)
    @php
        $percentOfTotal = $k['total'] > 0 ? min(100, round(($k['period'] / max(1, $k['total'])) * 100)) : 0;
    @endphp
    <div class="bg-white rounded-md shadow-sm p-2 flex flex-col items-start justify-center text-left">
        <div class="flex items-center gap-3">
            <div class="h-7 w-7 rounded-md flex items-center justify-center text-white {{ $map[$key]['color'] }}">{!! $map[$key]['svg'] !!}</div>
            <div>
                <div class="text-[11px] text-slate-500 uppercase tracking-wide">{{ $map[$key]['label'] }}</div>
                <div class="text-xl font-semibold text-slate-900">{{ number_format($k['total']) }}</div>
            </div>
        </div>
        <div class="mt-2 flex items-center gap-2">
            @if($k['change'] >= 0)
                <span class="inline-flex items-center gap-1 text-[11px] bg-green-50 text-green-700 px-2 py-0.5 rounded">▲ {{ $k['change'] }}%</span>
            @else
                <span class="inline-flex items-center gap-1 text-[11px] bg-red-50 text-red-700 px-2 py-0.5 rounded">▼ {{ ltrim($k['change'], '-') }}%</span>
            @endif
            <span class="text-[11px] text-slate-400">30d: {{ $k['period'] }}</span>
        </div>
    </div>
    @endforeach
</div>