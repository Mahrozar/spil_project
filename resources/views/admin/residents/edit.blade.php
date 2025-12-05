<x-app-layout>
    <div class="admin-content-area">
    <div class="max-w-3xl mx-auto p-6">
        <h2 class="text-lg font-semibold mb-4">Ubah Penduduk</h2>

        <form method="POST" action="{{ route('admin.residents.update', $resident) }}">
            @csrf @method('PUT')
            <div class="grid grid-cols-1 gap-4">
                <div>
                    <label class="block text-sm">NIK</label>
                    <input name="nik" class="w-full border rounded px-3 py-2" value="{{ old('nik', $resident->nik) }}" />
                </div>
                <div>
                    <label class="block text-sm">Nama</label>
                    <input name="name" required class="w-full border rounded px-3 py-2" value="{{ old('name', $resident->name) }}" />
                </div>
                <div class="grid grid-cols-2 gap-2">
                    <div>
                        <label class="block text-sm">RT</label>
                        <select name="rt_id" class="w-full border rounded px-2 py-2">
                            <option value="">--</option>
                            @foreach($rts as $rt)
                                <option value="{{ $rt->id }}" @if($rt->id == old('rt_id', $resident->rt_id)) selected @endif>{{ $rt->name }} (RW {{ $rt->rw->name ?? '-' }})</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm">RW</label>
                        <select name="rw_id" class="w-full border rounded px-2 py-2">
                            <option value="">--</option>
                            @foreach($rws as $rw)
                                <option value="{{ $rw->id }}" @if($rw->id == old('rw_id', $resident->rw_id)) selected @endif>{{ $rw->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                    <div>
                        <label class="block text-sm">Telepon</label>
                        <input name="phone" class="w-full border rounded px-3 py-2" value="{{ old('phone', $resident->phone) }}" />
                    </div>
                    <div>
                        <label class="block text-sm">Alamat</label>
                        <textarea name="address" class="w-full border rounded px-3 py-2">{{ old('address', $resident->address) }}</textarea>
                    </div>
                    <div class="flex gap-2">
                        <a href="{{ route('admin.residents.index') }}" class="px-4 py-2 bg-gray-200 rounded">Batal</a>
                        <button class="px-4 py-2 bg-blue-600 text-white rounded">Simpan</button>
                    </div>
            </div>
        </form>
    </div>
    </div>
</x-app-layout>
