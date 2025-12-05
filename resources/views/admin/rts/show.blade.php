<x-app-layout>
    <div class="admin-content-area">
    <div class="max-w-3xl mx-auto p-6">
        <h2 class="text-lg font-semibold mb-4">Detail RT</h2>

        <div class="bg-white shadow rounded p-4">
            <div><strong>ID:</strong> {{ $rt->id }}</div>
            <div><strong>Name:</strong> {{ $rt->name }}</div>
            <div><strong>RW:</strong> {{ $rt->rw->name ?? '-' }}</div>
            <div><strong>Leader:</strong> {{ $rt->leader_name ?? '-' }}</div>
            <div class="mt-4">
                <h4 class="font-semibold">Penduduk</h4>
                <ul>
                    @foreach($rt->residents as $res)
                        <li>{{ $res->name }} ({{ $res->nik ?? '-' }})</li>
                    @endforeach
                </ul>
            </div>
            <div class="mt-4">
                <a href="{{ route('admin.rts.edit', $rt) }}" class="px-3 py-2 bg-yellow-500 text-white rounded">Ubah</a>
                <a href="{{ route('admin.rts.index') }}" class="px-3 py-2 bg-gray-200 rounded">Kembali</a>
            </div>
        </div>
    </div>
    </div>
</x-app-layout>
