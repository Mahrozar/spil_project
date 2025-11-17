<x-app-layout>
    @include('admin.partials.sidebar')
    <div class="admin-content-area">
    <div class="max-w-5xl mx-auto p-6">
        <div class="flex items-center justify-between mb-4">
            <div>
                <h2 class="text-xl font-semibold">RT (Blocks)</h2>
            </div>
            <div>
                <a href="{{ route('admin.rts.create') }}" class="px-3 py-2 bg-blue-600 text-white rounded">RT Baru</a>
            </div>
        </div>

        <div class="bg-white shadow rounded">
            <div class="p-4 overflow-x-auto">
                <table class="min-w-full divide-y">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-2 text-left">ID</th>
                            <th class="px-4 py-2 text-left">Nama</th>
                            <th class="px-4 py-2 text-left">RW</th>
                            <th class="px-4 py-2 text-left">Ketua</th>
                            <th class="px-4 py-2 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y">
                        @foreach($rts as $rt)
                        <tr>
                            <td class="px-4 py-2">{{ $rt->id }}</td>
                            <td class="px-4 py-2">{{ $rt->name }}</td>
                            <td class="px-4 py-2">{{ $rt->rw->name ?? '-' }}</td>
                            <td class="px-4 py-2">{{ $rt->leader_name ?? '-' }}</td>
                            <td class="px-4 py-2 text-right">
                                <a href="{{ route('admin.rts.show', $rt) }}" class="text-blue-600 mr-2">Lihat</a>
                                <a href="{{ route('admin.rts.edit', $rt) }}" class="text-yellow-600 mr-2">Ubah</a>
                                <form action="{{ route('admin.rts.destroy', $rt) }}" method="POST" class="inline">@csrf @method('DELETE')<button class="text-red-600">Hapus</button></form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="p-4">{{ $rts->links() }}</div>
        </div>
    </div>
    </div>
</x-app-layout>
