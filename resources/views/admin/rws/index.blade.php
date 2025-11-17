<x-app-layout>
    @include('admin.partials.sidebar')
    <div class="admin-content-area">
    <div class="max-w-4xl mx-auto p-6">
        <div class="flex items-center justify-between mb-4">
            <div>
                <h2 class="text-xl font-semibold">RW (Rukun Warga)</h2>
            </div>
            <div>
                <a href="{{ route('admin.rws.create') }}" class="px-3 py-2 bg-blue-600 text-white rounded">RW Baru</a>
            </div>
        </div>

        <div class="bg-white shadow rounded">
            <div class="p-4 overflow-x-auto">
                <table class="min-w-full divide-y">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-2 text-left">ID</th>
                            <th class="px-4 py-2 text-left">Nama</th>
                            <th class="px-4 py-2 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y">
                        @foreach($rws as $rw)
                        <tr>
                            <td class="px-4 py-2">{{ $rw->id }}</td>
                            <td class="px-4 py-2">{{ $rw->name }}</td>
                            <td class="px-4 py-2 text-right">
                                <a href="{{ route('admin.rws.show', $rw) }}" class="text-blue-600 mr-2">Lihat</a>
                                <a href="{{ route('admin.rws.edit', $rw) }}" class="text-yellow-600 mr-2">Ubah</a>
                                <form action="{{ route('admin.rws.destroy', $rw) }}" method="POST" class="inline">@csrf @method('DELETE')<button class="text-red-600">Hapus</button></form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="p-4">{{ $rws->links() }}</div>
        </div>
    </div>
    </div>
</x-app-layout>
