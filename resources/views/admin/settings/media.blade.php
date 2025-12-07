<x-app-layout>
<div class="max-w-4xl mx-auto p-6">
    <div class="bg-white text-slate-900 rounded-lg shadow p-6">
        <h1 class="text-2xl font-semibold mb-4">Media Manager - Galeri</h1>

        @if(session('success'))
            <div class="mb-4 p-3 rounded bg-green-50 text-green-700">{{ session('success') }}</div>
        @endif

        <p class="text-sm text-slate-600 mb-4">Daftar file yang tersimpan di <code>/storage/home/galeri</code>. Hapus file yang tidak diperlukan.</p>

        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            @foreach($files as $f)
                <div class="border rounded overflow-hidden">
                    <img src="{{ $f['url'] }}" class="w-full h-36 object-cover" alt="img" />
                    <div class="p-3">
                        <div class="text-xs text-slate-500 mb-2 truncate">{{ $f['path'] }}</div>
                        <form method="POST" action="{{ route('admin.settings.media.delete') }}" onsubmit="return confirm('Hapus file ini?');">
                            @csrf
                            @method('DELETE')
                            <input type="hidden" name="path" value="{{ $f['path'] }}" />
                            <button class="w-full bg-red-600 text-white py-2 rounded text-sm">Hapus</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-6">
            <a href="{{ route('admin.settings.home.edit') }}" class="text-sm text-slate-600">Kembali ke pengaturan halaman</a>
        </div>
    </div>
</div>
</x-app-layout>
