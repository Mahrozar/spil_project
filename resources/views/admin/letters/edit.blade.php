<x-app-layout>
    <div class="admin-content-area">
    <div class="p-6">
        <div class="max-w-3xl mx-auto bg-white shadow rounded-lg p-6">
            <h2 class="text-xl font-semibold mb-4">Ubah Surat #{{ $letter->id }}</h2>

            <form method="POST" action="{{ route('admin.submissions.update', $submission ?? $letter) }}">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Status</label>
                        <select name="status" class="mt-1 block w-full border rounded-md px-3 py-2">
                            @foreach(\App\Models\Letter::allowedStatuses() as $st)
                                <option value="{{ $st }}" {{ $letter->status === $st ? 'selected' : '' }}>{{ \App\Models\Letter::labelFor($st) }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                    <label class="block text-sm font-medium text-gray-700">Deskripsi</label>
                    <textarea class="mt-1 block w-full border rounded-md px-3 py-2" rows="4" disabled>{{ $letter->description }}</textarea>
                    </div>
                </div>

                <div class="mt-6 flex items-center gap-2">
                    <a href="{{ route('admin.submissions.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 rounded">Batal</a>
                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded">Simpan</button>
                </div>
            </form>
        </div>
    </div>
    </div>
</x-app-layout>
