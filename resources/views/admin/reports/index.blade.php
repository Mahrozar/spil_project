@extends('admin.layout')

@section('title', 'Monitoring Pelaporan Fasilitas')

@section('content')
<div class="container mx-auto px-4">
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-semibold">Monitoring Pelaporan Fasilitas</h1>
        <div>
            <a href="{{ route('admin.reports') }}" class="btn btn-sm">Refresh</a>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
        @php $statuses = \App\Models\Report::getStatusLabels(); @endphp
        @foreach($statuses as $key => $label)
            <div class="bg-white p-4 rounded shadow">
                <div class="text-sm text-gray-500">{{ $label }}</div>
                <div class="text-2xl font-bold mt-2">{{ \App\Models\Report::where('status', $key)->count() }}</div>
            </div>
        @endforeach
    </div>

    <div class="bg-white rounded shadow p-4 mb-6">
        <form method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-3">
            <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari kode, nama pelapor, atau alamat" class="border p-2 rounded">
            <select name="status" class="border p-2 rounded">
                <option value="">-- Semua Status --</option>
                @foreach($statuses as $k => $l)
                    <option value="{{ $k }}" {{ request('status') == $k ? 'selected' : '' }}>{{ $l }}</option>
                @endforeach
            </select>
            <select name="facility_category" class="border p-2 rounded">
                <option value="">-- Semua Kategori --</option>
                @foreach(\App\Models\Report::getFacilityCategories() as $k => $l)
                    <option value="{{ $k }}" {{ request('facility_category') == $k ? 'selected' : '' }}>{{ $l }}</option>
                @endforeach
            </select>
            <div class="flex gap-2">
                <button type="submit" class="btn btn-sm bg-primary text-white px-4 py-2 rounded">Filter</button>
                <a href="{{ route('admin.reports') }}" class="btn btn-sm border px-4 py-2 rounded">Reset</a>
            </div>
        </form>
    </div>

    <div class="bg-white rounded shadow overflow-hidden">
        <table class="min-w-full table-auto">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">#</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Kode</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Pelapor</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Kategori / Tipe</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Lokasi</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tanggal</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                    <th class="px-4 py-3"></th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-100">
                @foreach($reports as $r)
                <tr>
                    <td class="px-4 py-3 text-sm">{{ $reports->firstItem() + $loop->index }}</td>
                    <td class="px-4 py-3 text-sm">{{ $r->report_code }}</td>
                    <td class="px-4 py-3 text-sm">{{ $r->user->name ?? $r->reporter_name ?? 'Anonim' }}</td>
                    <td class="px-4 py-3 text-sm">{{ $r->facility_label ?? ($r->facility_category . ' / ' . $r->facility_type) }}</td>
                    <td class="px-4 py-3 text-sm">{{ Str::limit($r->address, 60) }}</td>
                    <td class="px-4 py-3 text-sm">{{ $r->created_at->format('d M Y H:i') }}</td>
                    <td class="px-4 py-3 text-sm">
                        <span class="inline-flex items-center px-2 py-1 rounded {{ $r->status_color ?? 'bg-gray-100 text-gray-800' }} text-xs">{{ $r->status_label }}</span>
                    </td>
                    <td class="px-4 py-3 text-right text-sm">
                        <a href="{{ route('admin.reports.show', $r->id) }}" class="text-indigo-600 hover:text-indigo-900 mr-2">Lihat</a>
                        <a href="{{ route('admin.reports.edit', $r->id) }}" class="text-yellow-600 hover:text-yellow-900">Ubah</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $reports->links() }}
    </div>
</div>
@endsection

@push('styles')
<style>
    .bg-primary { background-color: #1e40af; }
</style>
@endpush
