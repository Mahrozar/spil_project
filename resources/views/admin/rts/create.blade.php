<x-app-layout>
    @include('admin.partials.sidebar')
    <div class="admin-content-area">
    <div class="max-w-3xl mx-auto p-6">
        <h2 class="text-lg font-semibold mb-4">Buat RT</h2>

        <form method="POST" action="{{ route('admin.rts.store') }}">
            @csrf
            <div class="grid gap-4">
                <div>
                    <label class="block text-sm">RW</label>
                    <select name="rw_id" class="w-full border rounded px-2 py-2">
                        <option value="">-- Pilih RW --</option>
                        @foreach($rws as $rw)
                            <option value="{{ $rw->id }}">{{ $rw->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-sm">Nama</label>
                    <input name="name" required class="w-full border rounded px-3 py-2" value="{{ old('name') }}" />
                </div>
                <div>
                    <label class="block text-sm">Telepon</label>
                    <input name="phone" class="w-full border rounded px-3 py-2" value="{{ old('phone') }}" />
                </div>
                <div class="flex gap-2">
                    <a href="{{ route('admin.rts.index') }}" class="px-3 py-2 bg-gray-200 rounded">Batal</a>
                    <button class="px-3 py-2 bg-blue-600 text-white rounded">Buat</button>
                </div>
            </div>
        </form>
    </div>
    </div>
</x-app-layout>
