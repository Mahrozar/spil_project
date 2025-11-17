<x-app-layout>
    <div class="container">
        <h1>Laporan Anda</h1>

        <a href="{{ route('user.reports.create') }}" class="btn btn-primary mb-3">Laporan Baru</a>

        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Kategori</th>
                    <th>Lokasi</th>
                    <th>Status</th>
                    <th>Dibuat</th>
                </tr>
            </thead>
            <tbody>
                @foreach($reports as $report)
                <tr>
                    <td>{{ $report->id }}</td>
                    <td>{{ $report->category }}</td>
                    <td>{{ $report->location }}</td>
                    <td>{{ $report->status }}</td>
                    <td>{{ $report->created_at->format('Y-m-d') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        {{ $reports->links() }}
    </div>
</x-app-layout>
