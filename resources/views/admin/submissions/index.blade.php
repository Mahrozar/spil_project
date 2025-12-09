<x-app-layout>
    <div class="p-6">
        <div class="max-w-6xl mx-auto bg-white shadow rounded-lg p-6">
            <h2 class="text-xl font-semibold mb-4">Pengajuan Surat Online</h2>

            <form class="mb-4" method="GET" action="{{ route('admin.submissions.index') }}">
                <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari nomor, nama, NIK atau jenis" class="border rounded px-3 py-2 w-64" />
                <button class="ml-2 px-3 py-2 bg-primary text-white rounded">Cari</button>
            </form>

            <div class="overflow-x-auto">
                <table class="w-full table-auto border-collapse">
                    <thead>
                        <tr class="text-left text-sm text-gray-600 border-b">
                            <th class="py-2">#</th>
                            <th class="py-2">Nomor Pengajuan</th>
                            <th class="py-2">Nama</th>
                            <th class="py-2">Jenis</th>
                            <th class="py-2">NIK</th>
                            <th class="py-2">Telepon</th>
                            <th class="py-2">Status</th>
                            <th class="py-2">Tanggal</th>
                            <th class="py-2">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($submissions as $s)
                            <tr class="border-b text-sm">
                                <td class="py-2">{{ $s->id }}</td>
                                <td class="py-2">{{ $s->submission_number }}</td>
                                <td class="py-2">{{ $s->nama }}</td>
                                <td class="py-2">{{ $s->jenis_surat }}</td>
                                <td class="py-2">{{ $s->nik }}</td>
                                <td class="py-2">{{ $s->telepon }}</td>
                                <td class="py-2">
                                    <span class="{{ $s->badgeClass() }}">{{ $s->statusLabel() }}</span>
                                </td>
                                <td class="py-2">{{ $s->created_at->format('Y-m-d') }}</td>
                                <td class="py-2">
                                    <a href="{{ route('admin.submissions.show', $s) }}" class="text-blue-600">Lihat</a>
                                    <a href="{{ route('admin.submissions.edit', $s) }}" class="ml-2 text-green-600">Ubah</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-4">{{ $submissions->links() }}</div>
        </div>
    </div>
</x-app-layout>
