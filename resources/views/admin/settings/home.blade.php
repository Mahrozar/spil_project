<x-app-layout>
<div class="max-w-3xl mx-auto p-6">
    <div class="bg-white text-slate-900 rounded-lg shadow p-6">
        <h1 class="text-2xl font-semibold mb-4">Edit Konten Halaman Utama</h1>

        @if(session('success'))
            <div class="mb-4 p-3 rounded bg-green-50 text-green-700">{{ session('success') }}</div>
        @endif

        <form method="POST" action="{{ route('admin.settings.home.update') }}" enctype="multipart/form-data">
            @csrf

            <label class="block text-sm font-medium text-slate-700">Judul Hero</label>
            <input name="hero_title" value="{{ old('hero_title', $hero_title) }}" class="w-full mt-1 p-2 border rounded text-slate-900" />

            <label class="block text-sm font-medium text-slate-700 mt-4">Subjudul Hero</label>
            <input name="hero_subtitle" value="{{ old('hero_subtitle', $hero_subtitle) }}" class="w-full mt-1 p-2 border rounded text-slate-900" />

            <label class="block text-sm font-medium text-slate-700 mt-4">Teks Ringkasan / Lead</label>
            <textarea name="hero_lead" class="w-full mt-1 p-2 border rounded text-slate-900" rows="4">{{ old('hero_lead', $hero_lead) }}</textarea>

            <div class="grid grid-cols-2 gap-4 mt-4">
                <div>
                    <label class="text-sm text-slate-700">Teks Tombol Utama</label>
                    <input name="cta_primary" value="{{ old('cta_primary', $cta_primary) }}" class="w-full mt-1 p-2 border rounded text-slate-900" />
                </div>
                <div>
                    <label class="text-sm text-slate-700">Teks Tombol Sekunder</label>
                    <input name="cta_secondary" value="{{ old('cta_secondary', $cta_secondary) }}" class="w-full mt-1 p-2 border rounded text-slate-900" />
                </div>
            </div>

            <h2 class="text-lg font-medium mt-6">Statistik cepat</h2>
            <div class="grid grid-cols-2 gap-4 mt-2">
                <div>
                    <label class="text-sm text-slate-700">Jumlah Penduduk</label>
                    <input name="stat_population" value="{{ old('stat_population', $stat_population) }}" class="w-full mt-1 p-2 border rounded text-slate-900" />
                </div>
                <div>
                    <label class="text-sm text-slate-700">Jumlah KK</label>
                    <input name="stat_kk" value="{{ old('stat_kk', $stat_kk) }}" class="w-full mt-1 p-2 border rounded text-slate-900" />
                </div>
                <div>
                    <label class="text-sm text-slate-700">Luas Wilayah</label>
                    <input name="stat_area" value="{{ old('stat_area', $stat_area) }}" class="w-full mt-1 p-2 border rounded text-slate-900" />
                </div>
                <div>
                    <label class="text-sm text-slate-700">Jumlah Dusun</label>
                    <input name="stat_dusun" value="{{ old('stat_dusun', $stat_dusun) }}" class="w-full mt-1 p-2 border rounded text-slate-900" />
                </div>
            </div>

            <h2 class="text-lg font-medium mt-8">Profil Desa</h2>
            <div class="mt-2">
                <label class="block text-sm text-slate-700">Judul Profil</label>
                <input name="profil_title" value="{{ old('profil_title', $profil_title) }}" class="w-full mt-1 p-2 border rounded text-slate-900" />
                <label class="block text-sm text-slate-700 mt-3">Isi Profil (ringkasan)</label>
                <textarea name="profil_text" class="w-full mt-1 p-2 border rounded text-slate-900" rows="5">{{ old('profil_text', $profil_text) }}</textarea>
            </div>

            <h2 class="text-lg font-medium mt-8">Layanan (fitur / kartu)</h2>
            <p class="text-sm text-slate-600">Masukkan hingga 3 layanan. Kosongkan untuk menonaktifkan kartu.</p>
            <div class="grid grid-cols-1 gap-4 mt-3">
                @for($i = 0; $i < 3; $i++)
                    <div class="p-4 border rounded">
                        <label class="text-sm text-slate-700">Judul</label>
                        <input name="layanan[{{ $i }}][title]" value="{{ old("layanan.$i.title", $layanan[$i]['title'] ?? '') }}" class="w-full mt-1 p-2 border rounded text-slate-900" />
                        <label class="text-sm text-slate-700 mt-2">Deskripsi</label>
                        <input name="layanan[{{ $i }}][description]" value="{{ old("layanan.$i.description", $layanan[$i]['description'] ?? '') }}" class="w-full mt-1 p-2 border rounded text-slate-900" />
                        <label class="text-sm text-slate-700 mt-2">Link (opsional, lengkapkan dengan https://)</label>
                        <input name="layanan[{{ $i }}][link]" value="{{ old("layanan.$i.link", $layanan[$i]['link'] ?? '') }}" class="w-full mt-1 p-2 border rounded text-slate-900" />
                        <div class="mt-3 flex items-start space-x-3">
                            <div class="w-24 h-16 bg-gray-100 rounded overflow-hidden flex items-center justify-center border">
                                @if(!empty($layanan[$i]['image'] ?? null))
                                    <img src="{{ $layanan[$i]['image'] }}" alt="preview" class="w-full h-full object-cover" />
                                @else
                                    <span class="text-xs text-slate-400">kosong</span>
                                @endif
                            </div>
                            <div class="flex-1">
                                <label class="text-sm text-slate-700">Image URL (opsional)</label>
                                <input name="layanan[{{ $i }}][image]" value="{{ old("layanan.$i.image", $layanan[$i]['image'] ?? '') }}" placeholder="https://.../image.jpg" class="w-full mt-1 p-2 border rounded text-slate-900" />
                                <label class="text-sm text-slate-700 mt-2">Upload gambar (opsional)</label>
                                <input type="file" name="layanan_files[{{ $i }}]" accept="image/*" class="mt-1 text-sm text-slate-600" />
                            </div>
                        </div>
                    </div>
                @endfor
            </div>

            <h2 class="text-lg font-medium mt-8">Berita Unggulan</h2>
            <p class="text-sm text-slate-600">Masukkan hingga 3 berita untuk ditampilkan di halaman depan.</p>
            <div class="grid grid-cols-1 gap-4 mt-3">
                @for($i = 0; $i < 3; $i++)
                    <div class="p-4 border rounded">
                        <label class="text-sm text-slate-700">Tanggal</label>
                        <input type="date" name="berita[{{ $i }}][date]" value="{{ old("berita.$i.date", $berita[$i]['date'] ?? '') }}" class="w-full mt-1 p-2 border rounded text-slate-900" />
                        <label class="text-sm text-slate-700 mt-2">Judul</label>
                        <input name="berita[{{ $i }}][title]" value="{{ old("berita.$i.title", $berita[$i]['title'] ?? '') }}" class="w-full mt-1 p-2 border rounded text-slate-900" />
                        <label class="text-sm text-slate-700 mt-2">Ringkasan / excerpt</label>
                        <input name="berita[{{ $i }}][excerpt]" value="{{ old("berita.$i.excerpt", $berita[$i]['excerpt'] ?? '') }}" class="w-full mt-1 p-2 border rounded text-slate-900" />
                        <label class="text-sm text-slate-700 mt-2">Link (opsional)</label>
                        <input name="berita[{{ $i }}][link]" value="{{ old("berita.$i.link", $berita[$i]['link'] ?? '') }}" class="w-full mt-1 p-2 border rounded text-slate-900" />
                        <div class="mt-3 flex items-start space-x-3">
                            <div class="w-24 h-16 bg-gray-100 rounded overflow-hidden flex items-center justify-center border">
                                @if(!empty($berita[$i]['image'] ?? null))
                                    <img src="{{ $berita[$i]['image'] }}" alt="preview" class="w-full h-full object-cover" />
                                @else
                                    <span class="text-xs text-slate-400">kosong</span>
                                @endif
                            </div>
                            <div class="flex-1">
                                <label class="text-sm text-slate-700">Image URL (opsional)</label>
                                <input name="berita[{{ $i }}][image]" value="{{ old("berita.$i.image", $berita[$i]['image'] ?? '') }}" placeholder="https://.../image.jpg" class="w-full mt-1 p-2 border rounded text-slate-900" />
                                <label class="text-sm text-slate-700 mt-2">Upload gambar (opsional)</label>
                                <input type="file" name="berita_files[{{ $i }}]" accept="image/*" class="mt-1 text-sm text-slate-600" />
                            </div>
                        </div>
                    </div>
                @endfor
            </div>

            <h2 class="text-lg font-medium mt-8">Galeri (URL gambar)</h2>
            <p class="text-sm text-slate-600">Masukkan URL gambar (mis. yang diupload ke storage atau CDN). Maks 8 gambar.</p>
            <div class="grid grid-cols-1 gap-3 mt-3">
                <p class="text-sm text-slate-500 mb-2">Anda dapat mengunggah gambar atau memasukkan URL gambar. Upload akan disimpan ke storage publik.</p>
                @for($i = 0; $i < 8; $i++)
                    <div class="flex items-center space-x-3">
                        <div class="w-24 h-16 bg-gray-100 rounded overflow-hidden flex items-center justify-center border">
                            @if(!empty($galeri[$i]))
                                <img src="{{ $galeri[$i] }}" alt="preview" class="w-full h-full object-cover" />
                            @else
                                <span class="text-xs text-slate-400">kosong</span>
                            @endif
                        </div>
                        <div class="flex-1">
                            <input name="galeri[{{ $i }}]" value="{{ old("galeri.$i", $galeri[$i] ?? '') }}" placeholder="https://.../image.jpg" class="w-full mt-1 p-2 border rounded text-slate-900" />
                            <input type="file" name="galeri_files[{{ $i }}]" accept="image/*" class="mt-2 text-sm text-slate-600" />
                        </div>
                    </div>
                @endfor
            </div>

            <div class="mt-6">
                <button class="bg-blue-600 text-white px-4 py-2 rounded">Simpan</button>
                <a href="{{ route('admin.dashboard') }}" class="ml-2 text-sm text-slate-600">Batal</a>
            </div>
        </form>
    </div>
</div>
</x-app-layout>

