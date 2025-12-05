<x-app-layout>
    <div class="admin-content-area">
    <div class="admin-content-area">
    <div class="max-w-7xl mx-auto p-6">
        <div class="flex items-center justify-between mb-4">
            <div>
                <h2 class="text-xl font-semibold">Penduduk</h2>
                <p class="text-sm text-gray-500">Kelola data penduduk (RT/RW).</p>
            </div>
            <div>
                <a href="{{ route('admin.residents.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded">Penduduk Baru</a>
            </div>
        </div>

        <div class="bg-white shadow rounded overflow-hidden">
            <div class="p-4 border-b">
                <form method="GET" class="flex gap-2">
                    <input type="search" name="q" value="{{ request('q') }}" placeholder="Cari nama / NIK" class="border rounded px-3 py-2" />
                    <button class="px-3 py-2 bg-blue-600 text-white rounded">Cari</button>
                </form>
            </div>

            <div class="p-4 overflow-x-auto">
                <table class="min-w-full divide-y">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-2 text-left text-sm">NIK</th>
                            <th class="px-4 py-2 text-left text-sm">Nama</th>
                            <th class="px-4 py-2 text-left text-sm">RT / RW</th>
                            <th class="px-4 py-2 text-left text-sm">Telepon</th>
                            <th class="px-4 py-2 text-right text-sm">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y">
                        @foreach($residents as $r)
                        <tr>
                            <td class="px-4 py-2 text-sm">{{ $r->nik }}</td>
                            <td class="px-4 py-2 text-sm">{{ $r->name }}</td>
                            <td class="px-4 py-2 text-sm">{{ $r->rt->name ?? '-' }} / {{ $r->rw->name ?? '-' }}</td>
                            <td class="px-4 py-2 text-sm">{{ $r->phone }}</td>
                            <td class="px-4 py-2 text-right text-sm">
                                <a href="{{ route('admin.residents.show', $r) }}" class="text-blue-600 mr-2">Lihat</a>
                                <a href="{{ route('admin.residents.edit', $r) }}" class="text-yellow-600 mr-2">Ubah</a>
                                <form action="{{ route('admin.residents.destroy', $r) }}" method="POST" class="inline">@csrf @method('DELETE')<button class="text-red-600">Hapus</button></form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="p-4">{{ $residents->withQueryString()->links() }}</div>
        </div>
    </div>
    </div>
</x-app-layout>
