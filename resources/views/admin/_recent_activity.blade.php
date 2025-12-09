<div class="mb-4">
    <div class="flex items-center justify-between mb-2 px-1">
        <h3 class="font-semibold text-sm text-slate-900">Aktivitas Terbaru</h3>
        <a href="{{ route('admin.submissions.index') }}" class="text-xs text-slate-500">Lihat semua</a>
    </div>

    @php
        if (is_array($recentActivities)) {
            $recent = array_slice($recentActivities, 0, 5);
        } elseif ($recentActivities instanceof \Illuminate\Support\Collection) {
            $recent = $recentActivities->take(5);
        } elseif (is_iterable($recentActivities)) {
            $recent = array_slice(iterator_to_array($recentActivities), 0, 5);
        } else {
            $recent = [];
        }
    @endphp

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-3">
        @forelse($recent as $ev)
            <div class="bg-white rounded-md shadow-sm p-2 text-sm h-20 flex items-center gap-3">
                <div class="flex-shrink-0 inline-flex items-center justify-center h-9 w-9 rounded-md bg-slate-100 text-slate-600">
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
                </div>

                <div class="flex-1 min-w-0">
                    <div class="flex items-center justify-between">
                        <div class="text-sm text-slate-700 truncate">{{ $ev['message'] }}</div>
                        <div class="text-xs text-slate-400 ml-2">{{ $ev['time']->diffForHumans() }}</div>
                    </div>
                    <div class="mt-1">
                        @if(!empty($ev['link']))
                            <a href="{{ $ev['link'] }}" class="inline-block px-2 py-0.5 text-xs bg-violet-50 text-violet-600 rounded">Buka</a>
                        @else
                            <span class="text-xs text-slate-400">—</span>
                        @endif
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-4 text-sm text-slate-500">Belum ada aktivitas terbaru.</div>
        @endforelse
    </div>
</div>