<x-app-layout>
<div class="grid grid-cols-1 lg:grid-cols-4 gap-6">
    <x-stat-card title="Letters" :value="$lettersCount" :icon="view('components.icon', ['name' => 'eye', 'class' => 'w-6 h-6'])->render()" />

    <x-stat-card title="Reports" :value="$reportsCount" :icon="view('components.icon', ['name' => 'pencil', 'class' => 'w-6 h-6'])->render()" />

    <x-stat-card title="Residents" :value="\App\Models\Resident::count()" :icon="view('components.icon', ['name' => 'users', 'class' => 'w-6 h-6'])->render()" />

    <x-chart-card title="Activity (12 months)" canvasId="adminChart">
        <div class="legend-item"><span class="legend-swatch letters"></span> Letters</div>
        <div class="legend-item"><span class="legend-swatch reports"></span> Reports</div>
    </x-chart-card>
</div>

<div class="mt-6 card">
    <h3 class="font-semibold mb-3">Monthly Activity</h3>
    <p class="text-sm text-slate-500">Letters & Reports over the last 12 months</p>
</div>

@push('head')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function(){
    const ctx = document.getElementById('adminChart');
    if (!ctx) return;
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: @json($labels),
            datasets: [
                { label: 'Letters', data: @json($lettersData), borderColor: '#06b6d4', tension: 0.3, fill: false },
                { label: 'Reports', data: @json($reportsData), borderColor: '#10b981', tension: 0.3, fill: false },
            ]
        },
        options: { responsive: true }
    });
});
</script>
@endpush

</x-app-layout>

