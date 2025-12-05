<x-app-layout>
    <div class="admin-content-area">
    <div class="max-w-3xl mx-auto p-6">
        <h2 class="text-lg font-semibold mb-4">Detail RW</h2>

        <div class="bg-white shadow rounded p-4">
            <div><strong>ID:</strong> {{ $rw->id }}</div>
            <div><strong>Name:</strong> {{ $rw->name }}</div>
            <div class="mt-4">
                <h4 class="font-semibold">RT</h4>
                <ul>
                    @foreach($rw->rts as $rt)
                        <li>{{ $rt->name }} (Ketua: {{ $rt->leader_name ?? '-' }})</li>
                    @endforeach
                </ul>
            </div>
            <div class="mt-4">
                <a href="{{ route('admin.rws.edit', $rw) }}" class="px-3 py-2 bg-yellow-500 text-white rounded">Ubah</a>
                <a href="{{ route('admin.rws.index') }}" class="px-3 py-2 bg-gray-200 rounded">Kembali</a>
            </div>
        </div>
    </div>
    </div>
</x-app-layout>
