<x-app-layout>
    <div class="admin-content-area">
    <div class="p-6">
        <div class="max-w-3xl mx-auto bg-white shadow rounded-lg p-6">
            <h2 class="text-xl font-semibold mb-4">Surat #{{ $letter->id }}</h2>

            <div class="grid grid-cols-1 gap-4">
                <div>
                    <div class="text-sm text-gray-500">Pengguna</div>
                    <div class="font-medium">{{ $letter->user->name ?? '-' }} &lt;{{ $letter->user->email ?? '' }}&gt;</div>
                </div>

                <div>
                    <div class="text-sm text-gray-500">Jenis</div>
                    <div class="font-medium">{{ $letter->type }}</div>
                </div>

                <div>
                    <div class="text-sm text-gray-500">Status</div>
                    <div class="font-medium">{{ ucfirst($letter->status) }}</div>
                </div>

                <div>
                    <div class="text-sm text-gray-500">Deskripsi</div>
                    <div class="mt-2 text-gray-700">{{ $letter->description }}</div>
                </div>

                <div>
                    <div class="text-sm text-gray-500">Dibuat pada</div>
                    <div class="font-medium">{{ $letter->created_at->toDayDateTimeString() }}</div>
                </div>
            </div>

                <div class="mt-6 flex items-center gap-2">
                <a href="{{ route('admin.letters') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 rounded">Kembali</a>
                <a href="{{ route('admin.letters.edit', $letter) }}" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded">Ubah</a>
            </div>
        </div>
    </div>
    </div>
</x-app-layout>
