<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-4 mb-6">
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
    <div class="bg-white rounded-xl shadow-lg p-4 flex flex-col justify-between gap-3">
        <div class="flex items-start justify-between">
            <div class="flex items-center gap-3">
                <div class="h-10 w-10 rounded-lg flex items-center justify-center text-white {{ $map[$key]['color'] }}">{!! $map[$key]['svg'] !!}</div>
                <div>
                    <div class="text-xs text-slate-500">{{ $map[$key]['label'] }}</div>
                    <div class="text-2xl font-bold text-slate-800">{{ number_format($k['total']) }}</div>
                </div>
            </div>
            <div class="text-right">
                @if($k['change'] >= 0)
                    <div class="inline-flex items-center gap-2">
                        <span title="Naik vs 30 hari sebelumnya" class="inline-flex items-center justify-center h-7 px-2 rounded-full bg-green-50 text-green-700 font-semibold text-sm">
                            <svg class="h-3 w-3 mr-1" viewBox="0 0 20 20" fill="currentColor"><path d="M5 10l5-5 5 5H5z"/></svg>
                            {{ $k['change'] }}%
                        </span>
                    </div>
                @else
                    <div class="inline-flex items-center gap-2">
                        <span title="Turun vs 30 hari sebelumnya" class="inline-flex items-center justify-center h-7 px-2 rounded-full bg-red-50 text-red-700 font-semibold text-sm">
                            <svg class="h-3 w-3 mr-1 transform rotate-180" viewBox="0 0 20 20" fill="currentColor"><path d="M5 10l5-5 5 5H5z"/></svg>
                            {{ ltrim($k['change'], '-') }}%
                        </span>
                    </div>
                @endif
            </div>
        </div>

        <div>
            <div class="flex items-center justify-between">
                <div class="text-xs text-slate-500">Periode (30d)</div>
                <div class="text-xs text-slate-600 font-medium">{{ $k['period'] }}</div>
            </div>
            <div class="mt-2 h-2 bg-slate-100 rounded-full overflow-hidden">
                <div class="h-2 rounded-full" style="width: {{ $percentOfTotal }}%; background: linear-gradient(90deg, rgba(99,102,241,1) 0%, rgba(34,197,94,1) 100%);"></div>
            </div>
            @if(isset($k['delta']))
                <div class="mt-2 text-xs text-slate-500">Δ absolut: <span class="font-medium {{ $k['delta'] >= 0 ? 'text-green-700' : 'text-red-700' }}">{{ $k['delta'] >= 0 ? '+'.$k['delta'] : $k['delta'] }}</span></div>
            @endif
        </div>
    </div>
    @endforeach
</div>