@props([
    'title',
    'value',
    'period' => null,
    'change' => null,
    'delta' => null,
    'icon' => null,
    'color' => 'blue',
    'link' => null
])

@php
    $colorClasses = [
        'blue' => 'text-blue-600 bg-blue-50 border-blue-200',
        'green' => 'text-green-600 bg-green-50 border-green-200',
        'red' => 'text-red-600 bg-red-50 border-red-200',
        'yellow' => 'text-yellow-600 bg-yellow-50 border-yellow-200',
        'purple' => 'text-purple-600 bg-purple-50 border-purple-200',
        'orange' => 'text-orange-600 bg-orange-50 border-orange-200',
    ][$color] ?? $colorClasses['blue'];
    
    // Tentukan warna untuk perubahan
    $changeColor = $change >= 0 ? 'text-green-600' : 'text-red-600';
    $changeIcon = $change >= 0 ? '⬆' : '⬇';
@endphp

<div {{ $attributes->merge(['class' => 'stat-card group']) }}>
    @if($link)
        <a href="{{ $link }}" class="block p-5">
    @else
        <div class="p-5">
    @endif
    
        <div class="flex items-start justify-between mb-4">
            <div>
                <div class="text-sm font-medium text-slate-500 uppercase tracking-wide">{{ $title }}</div>
                <div class="text-2xl md:text-3xl font-bold text-slate-900 mt-1">{{ $value }}</div>
            </div>
            
            @if($icon)
                <div class="p-3 rounded-xl {{ $colorClasses }}">
                    @if(str_starts_with($icon, '<svg'))
                        {!! $icon !!}
                    @else
                        <span class="text-xl">{{ $icon }}</span>
                    @endif
                </div>
            @endif
        </div>
        
        @if($period !== null || $change !== null)
            <div class="pt-3 border-t border-slate-100">
                <div class="flex items-center justify-between">
                    @if($period !== null)
                        <div>
                            <div class="text-xs text-slate-500">30 hari terakhir</div>
                            <div class="text-sm font-semibold text-slate-900">{{ $period }}</div>
                        </div>
                    @endif
                    
                    @if($change !== null)
                        <div class="text-right">
                            <div class="text-xs {{ $changeColor }} font-medium">
                                {{ $change >= 0 ? '+' : '' }}{{ $change }}%
                            </div>
                            <div class="text-xs text-slate-500">
                                @if($delta !== null)
                                    {{ $delta >= 0 ? '+' : '' }}{{ $delta }} dari periode sebelumnya
                                @else
                                    vs periode sebelumnya
                                @endif
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        @endif
        
        @if($link)
            <div class="mt-4 pt-4 border-t border-slate-100">
                <span class="text-sm font-medium text-blue-600 group-hover:text-blue-800 transition-colors">
                    Lihat detail →
                </span>
            </div>
        @endif
    
    @if($link)
        </a>
    @else
        </div>
    @endif
</div>