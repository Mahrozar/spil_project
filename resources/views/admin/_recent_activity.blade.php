<div class="bg-white rounded-lg shadow p-3 mb-4">
    <div class="flex items-center justify-between mb-2">
        <h3 class="font-semibold text-sm">Aktivitas Terbaru</h3>
        <a href="{{ route('admin.letters') }}" class="text-xs text-slate-500">Lihat semua</a>
    </div>
    <ul class="divide-y">
        @forelse($recentActivities as $ev)
            <li class="py-2 flex items-center justify-between text-sm">
                <div class="flex items-center gap-3">
                    <span class="flex-shrink-0 inline-flex items-center justify-center h-8 w-8 rounded-md bg-slate-50 text-slate-600">
                        @if($ev['type'] === 'surat')
                            <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path d="M3 7h18v10H3z" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        @elseif($ev['type'] === 'laporan')
                            <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path d="M7 7h10v10H7z" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        @elseif($ev['type'] === 'penduduk')
                            <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path d="M12 12a4 4 0 1 0 0-8 4 4 0 0 0 0 8z" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/><path d="M4 20a8 8 0 0 1 16 0" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        @elseif($ev['type'] === 'import')
                            <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path d="M12 3v12" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/><path d="M7 8l5 5 5-5" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        @else
                            <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor"><circle cx="12" cy="12" r="9" stroke-width="1.5"/></svg>
                        @endif
                    </span>
                    <div>
                        <div class="text-slate-700">{{ $ev['message'] }}</div>
                        <div class="text-xs text-slate-400">{{ $ev['time']->diffForHumans() }}</div>
                    </div>
                </div>
                <div class="flex-shrink-0 ml-4">
                    @if(!empty($ev['link']))
                        <a href="{{ $ev['link'] }}" class="inline-flex items-center px-2 py-1 text-xs bg-violet-50 text-violet-600 rounded">Buka</a>
                    @else
                        <span class="text-xs text-slate-400">—</span>
                    @endif
                </div>
            </li>
        @empty
            <li class="py-2 text-sm text-slate-500">Belum ada aktivitas terbaru.</li>
        @endforelse
    </ul>
</div>