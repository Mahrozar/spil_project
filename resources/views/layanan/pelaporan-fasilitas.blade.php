@extends('layouts.home-app')

@section('title', 'Pelaporan Fasilitas - Desa Cicangkang Hilir')

@section('content')
<section class="py-20 bg-white">
    <div class="container mx-auto px-6">
        <div class="max-w-3xl mx-auto bg-white rounded-xl shadow-lg p-8">
            <h2 class="text-2xl font-bold text-primary mb-2">Pelaporan Fasilitas</h2>
            <p class="text-gray-600 mb-6">Laporkan kerusakan atau keluhan terkait fasilitas umum desa (jalan, lampu, taman, sarana publik) agar dapat ditindaklanjuti oleh pemerintah desa.</p>

            @if(session('success'))
                <div class="mb-4 p-4 bg-green-50 border border-green-100 text-green-700 rounded">{{ session('success') }}</div>
            @endif

            <form action="{{ route('reports.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="grid grid-cols-1 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Nama (opsional)</label>
                        <input type="text" name="reporter_name" class="mt-1 block w-full border border-gray-200 rounded p-2" value="{{ old('reporter_name') }}">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Telepon / WA (opsional)</label>
                        <input type="text" name="reporter_phone" class="mt-1 block w-full border border-gray-200 rounded p-2" value="{{ old('reporter_phone') }}">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Alamat / Lokasi</label>
                        <input type="text" name="address" required class="mt-1 block w-full border border-gray-200 rounded p-2" value="{{ old('address') }}">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Kategori Fasilitas</label>
                        <select name="facility_category" class="mt-1 block w-full border border-gray-200 rounded p-2">
                            <option value="">-- Pilih --</option>
                            @foreach(\App\Models\Report::getFacilityCategories() as $key => $label)
                                <option value="{{ $key }}" {{ old('facility_category') == $key ? 'selected' : '' }}>{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Tipe Fasilitas (opsional)</label>
                        <input type="text" name="facility_type" class="mt-1 block w-full border border-gray-200 rounded p-2" value="{{ old('facility_type') }}">
                    </div>

                    <input type="hidden" name="latitude" id="latitude" value="{{ old('latitude', 0) }}">
                    <input type="hidden" name="longitude" id="longitude" value="{{ old('longitude', 0) }}">

                    <div class="text-sm text-gray-600">Anda bisa mengisi lokasi secara manual atau klik tombol "Isi Koordinat" untuk menggunakan lokasi perangkat.</div>
                    <div class="flex items-center gap-3">
                        <button type="button" id="fill-coords" class="mt-2 bg-gray-100 text-gray-800 py-2 px-3 rounded">Isi Koordinat</button>
                        <div id="coords-display" class="text-sm text-gray-500"></div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Deskripsi</label>
                        <textarea name="description" rows="4" class="mt-1 block w-full border border-gray-200 rounded p-2">{{ old('description') }}</textarea>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Foto (opsional, maksimal 3)</label>
                        <input type="file" name="photos[]" multiple class="mt-1 block w-full" accept="image/*">
                    </div>

                    <div class="flex items-center">
                        <input type="checkbox" name="is_anonymous" id="is_anonymous" value="1" {{ old('is_anonymous') ? 'checked' : '' }} class="mr-2">
                        <label for="is_anonymous" class="text-sm text-gray-700">Laporkan sebagai anonim</label>
                    </div>

                    <div class="pt-2">
                        <button type="submit" class="bg-primary text-white py-2 px-4 rounded">Kirim Laporan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
document.getElementById('fill-coords')?.addEventListener('click', function(){
    if (!navigator.geolocation) {
        alert('Geolocation tidak didukung pada perangkat ini.');
        return;
    }
    navigator.geolocation.getCurrentPosition(function(pos){
        document.getElementById('latitude').value = pos.coords.latitude;
        document.getElementById('longitude').value = pos.coords.longitude;
        document.getElementById('coords-display').innerText = pos.coords.latitude + ', ' + pos.coords.longitude;
    }, function(err){
        alert('Gagal mendapatkan lokasi: ' + err.message);
    }, { enableHighAccuracy:true, timeout:10000 });
});
</script>
@endpush
