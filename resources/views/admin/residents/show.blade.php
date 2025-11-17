<x-app-layout>
    @include('admin.partials.sidebar')
    <div class="admin-content-area">
    <div class="max-w-3xl mx-auto p-6">
    <h2 class="text-lg font-semibold mb-4">Detail Penduduk</h2>

        <div class="bg-white shadow rounded p-4">
            <div class="grid grid-cols-1 gap-2">
                <div><strong>NIK:</strong> {{ $resident->nik ?? '-' }}</div>
                <div><strong>Nama:</strong> {{ $resident->name }}</div>
                <div><strong>Tanggal Lahir:</strong> {{ $resident->dob?->toDateString() ?? '-' }}</div>
                <div><strong>RT / RW:</strong> {{ $resident->rt->name ?? '-' }} / {{ $resident->rw->name ?? '-' }}</div>
                <div><strong>Telepon:</strong> {{ $resident->phone ?? '-' }}</div>
                <div><strong>Alamat:</strong> {{ $resident->address ?? '-' }}</div>
            </div>
                <div class="mt-4">
                <a href="{{ route('admin.residents.edit', $resident) }}" class="px-3 py-2 bg-yellow-500 text-white rounded">Ubah</a>
                <a href="{{ route('admin.residents.index') }}" class="px-3 py-2 bg-gray-200 rounded">Kembali</a>
            </div>
        </div>
    </div>
    </div>
</x-app-layout>
