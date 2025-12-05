@extends('layouts.app')

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-4 gap-6">
    <div class="card">
        <div class="text-sm text-gray-500">Users</div>
        <div class="text-2xl font-bold">{{ $counts['users'] }}</div>
    </div>
    <div class="card">
        <div class="text-sm text-gray-500">Letters</div>
        <div class="text-2xl font-bold">{{ $counts['letters'] }}</div>
    </div>
    <div class="card">
        <div class="text-sm text-gray-500">Reports</div>
        <div class="text-2xl font-bold">{{ $counts['reports'] }}</div>
    </div>
    <div class="card">
        <div class="text-sm text-gray-500">Engagement</div>
        <canvas id="mainChart" height="80"></canvas>
    </div>
</div>

<div class="mt-6 card">
    <h3 class="font-semibold mb-3">Recent Letters</h3>
    <table class="min-w-full text-left">
        <thead>
            <tr class="text-sm text-gray-500">
                <th class="py-2">No</th>
                <th class="py-2">Title</th>
                <th class="py-2">User</th>
                <th class="py-2">Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach(\App\Models\Letter::latest()->limit(8)->get() as $letter)
            <tr class="border-t">
                <td class="py-2">{{ $loop->iteration }}</td>
                <td class="py-2">{{ $letter->title ?? '—' }}</td>
                <td class="py-2">{{ $letter->user->name ?? '—' }}</td>
                <td class="py-2">{{ $letter->created_at->format('Y-m-d') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection

@push('head')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function(){
    const ctx = document.getElementById('mainChart');
    if (!ctx) return;
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug'],
            datasets: [{ label: 'Engagement', data: [12,19,3,5,2,3,8,10], backgroundColor: '#06b6d4' }]
        },
        options: { responsive: true }
    });
});
</script>
@endpush
