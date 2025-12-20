@extends('layouts.home-app')

@section('title', 'Gambaran Umum - Desa Cicangkang Hilir')

@push('styles')
<style>
    .section-card { max-width: 900px; margin: 0 auto; }
    .dl-grid { display: grid; grid-template-columns: 1fr 2fr; gap: 0.5rem 1.5rem; }
    @media (max-width: 768px) {
        .dl-grid { grid-template-columns: 1fr; }
    }
</style>
@endpush

@section('content')
<div class="pt-24 pb-12">
    <div class="container mx-auto px-6">
        <div class="text-center mb-8">
            <h1 class="text-3xl md:text-4xl font-bold text-primary">Gambaran Umum Desa Cicangkang Hilir</h1>
            <p class="text-gray-600 max-w-2xl mx-auto">Ringkasan data wilayah, sumber daya, dan sarana-prasarana desa.</p>
        </div>

        <div class="section-card bg-white rounded-xl shadow p-6 mb-6">
            <h2 class="text-xl font-bold text-primary mb-4">A. Potensi Sumber Daya Alam</h2>

            <h3 class="font-semibold mt-4">1. Letak Geografis</h3>
            <p class="text-gray-700">Desa Cicangkanghilir merupakan salah satu dari 14 desa di wilayah Kecamatan Cipongkor, terletak sekitar 25 km dari pusat kecamatan. Luas wilayah 369 hektar, terdiri dari 4 Dusun, 13 RW dan 35 RT. Batas wilayah administratif:</p>
            <ul class="list-disc list-inside text-gray-700 mt-2">
                <li>Sebelah Utara: Desa Karang Anyar (Kecamatan Cililin)</li>
                <li>Sebelah Selatan: Desa Sindangkerta (Kecamatan Sindangkerta)</li>
                <li>Sebelah Timur: Desa Bongas (Kecamatan Cililin)</li>
                <li>Sebelah Barat: Desa Sukamulya (Kecamatan Cipongkor)</li>
            </ul>

            <div class="mt-4">
                <h4 class="font-semibold">Jarak dari pusat pemerintahan</h4>
                <dl class="dl-grid text-gray-700 mt-2">
                    <dt>Jarak dari kantor kecamatan</dt><dd>19 km</dd>
                    <dt>Jarak dari ibu kota kabupaten</dt><dd>40 km</dd>
                    <dt>Jarak dari ibu kota provinsi</dt><dd>135 km</dd>
                    <dt>Jarak dari ibu kota negara</dt><dd>440 km</dd>
                </dl>
            </div>

            <h3 class="font-semibold mt-6">2. Topografi</h3>
            <p class="text-gray-700">Secara umum merupakan daerah dataran dan kawasan danau seluas 197,93 ha. Ketinggian 700 mdpl dengan suhu rata-rata 18–25°C. Iklim tipe B (Schmidt-Ferguson) dengan musim kemarau dan penghujan.</p>
            <dl class="dl-grid text-gray-700 mt-2">
                <dt>Curah Hujan</dt><dd>144,9 mm/th</dd>
                <dt>Jumlah Bulan Hujan</dt><dd>5 Bulan</dd>
                <dt>Suhu rata-rata</dt><dd>18–25 °C</dd>
                <dt>Tinggi Tempat</dt><dd>700 mdpl</dd>
                <dt>Bentang wilayah</dt><dd>Landai / Datar</dd>
            </dl>

            <h3 class="font-semibold mt-6">3. Luas dan Sebaran Penggunaan Lahan</h3>
            <p class="text-gray-700">Penggunaan lahan umumnya produktif. Rincian (hektar):</p>
            <ul class="list-disc list-inside text-gray-700 mt-2">
                <li>Tanah sawah tadah hujan: 76,67 ha</li>
                <li>Tanah tegal/ladang: 85,79 ha</li>
                <li>Tanah pemukiman: 15,82 ha</li>
                <li>Tanah fasilitas umum/kas desa: 4.381 m²</li>
                <li>Tanah perkantoran pemerintah: 1,65 ha</li>
            </ul>

            <h4 class="font-semibold mt-4">Pertanian (contoh produksi)</h4>
            <div class="overflow-x-auto mt-2">
                <table class="w-full table-fixed text-sm text-gray-700 border-collapse">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="px-3 py-2 text-left">Tanaman</th>
                            <th class="px-3 py-2 text-left">Luas (ha)</th>
                            <th class="px-3 py-2 text-left">Produksi (ton/ha)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr><td class="px-3 py-2">Jagung</td><td class="px-3 py-2">1.5</td><td class="px-3 py-2">0.2</td></tr>
                        <tr><td class="px-3 py-2">Kedelai</td><td class="px-3 py-2">0.5</td><td class="px-3 py-2">0.1</td></tr>
                        <tr><td class="px-3 py-2">Padi sawah</td><td class="px-3 py-2">81.39</td><td class="px-3 py-2">7</td></tr>
                        <tr><td class="px-3 py-2">Mentimun</td><td class="px-3 py-2">0.5</td><td class="px-3 py-2">0.6</td></tr>
                    </tbody>
                </table>
            </div>

            <h4 class="font-semibold mt-6">Kehutanan</h4>
            <p class="text-gray-700">Hutan negara: 35,75 ha • Hutan milik masyarakat: 87 ha • Tumpang sari: 4 ha</p>

            <h4 class="font-semibold mt-6">Peternakan (ringkasan)</h4>
            <p class="text-gray-700">Sapi: 8 ekor (2 pemilik) • Kerbau: 21 ekor • Ayam kampung: 4.000 ekor • Broiler: 12.000 ekor • Kambing: 342 ekor • Domba: 60 ekor</p>

            <h4 class="font-semibold mt-6">Perikanan</h4>
            <p class="text-gray-700">Danau: 0.5 ha (produksi ≈ 0.126 ton/th). Jaring terapung: 21 unit (produksi tercatat).</p>

            <h3 class="font-semibold mt-6">4. Sumber Daya Air</h3>
            <p class="text-gray-700">Sungai: debit kecil; Danau: volume besar; Mata air: debit kecil–sedang.</p>
            <h4 class="font-semibold mt-2">Sumber Air Bersih (ringkasan)</h4>
            <p class="text-gray-700">Sumur gali: 956 unit (1.608 KK) — kondisi: rusak; Sumur pompa: 10 unit; Depot isi ulang: 2 unit (900 KK) — baik.</p>
        </div>

        <div class="section-card bg-white rounded-xl shadow p-6 mb-6">
            <h2 class="text-xl font-bold text-primary mb-4">B. Potensi Sumber Daya Manusia</h2>

            <h4 class="font-semibold">1. Kependudukan</h4>
            <p class="text-gray-700">Jumlah penduduk: 5.682 jiwa (2.794 laki-laki, 2.888 perempuan), 1.777 KK. Kepadatan: 1.539,83 orang/km². Kelahiran: 61; Kematian: 24.</p>

            <h4 class="font-semibold mt-4">2. Pendidikan (ringkasan)</h4>
            <p class="text-gray-700">Tabel pendidikan diringkas untuk tampilan; data lengkap dapat ditampilkan di halaman admin.</p>

            <h4 class="font-semibold mt-4">3. Ketenagakerjaan</h4>
            <p class="text-gray-700">Kondisi hingga 2018 menunjukkan situasi relatif kondusif namun terbatasnya lapangan kerja tetap menjadi tantangan.</p>

            <h4 class="font-semibold mt-4">4. Kesejahteraan Sosial</h4>
            <p class="text-gray-700">Permasalahan sosial berkembang akibat proses globalisasi, industrialisasi, dan dampak ekonomi.</p>

            <h4 class="font-semibold mt-4">5. Pemuda & Olahraga</h4>
            <p class="text-gray-700">Pembinaan pemuda melalui Karang Taruna dan LPMD; cabang populer: voli, tenis meja, bulu tangkis, sepak bola.</p>

            <h4 class="font-semibold mt-4">6. Kebudayaan</h4>
            <p class="text-gray-700">Kelompok kesenian terus dibina meski dana terbatas; warisan budaya dilestarikan.</p>
        </div>

        <div class="section-card bg-white rounded-xl shadow p-6 mb-6">
            <h2 class="text-xl font-bold text-primary mb-4">C. Potensi Sarana & Prasarana</h2>
            <p class="text-gray-700">Ringkasan sarana utama: jalan, air bersih, pemerintahan, peribadatan, olahraga, kesehatan, penerangan, pendidikan.</p>
            <ul class="list-disc list-inside text-gray-700 mt-2">
                <li>Jalan aspal desa / kabupaten / provinsi / negara (data rinci tersedia pada dokumen administrasi)</li>
                <li>Posyandu: 4 unit • Pustu: 1 unit • Mesjid: 15 • Mushola: 35</li>
                <li>Listrik PLN terdaftar: 1.427 unit (916 terpasang, 511 belum)</li>
            </ul>
        </div>
            <p class="text-sm text-gray-500 mt-4">Catatan: Data lengkap dan tabel rinci (administrasi, aset, keuangan, data SDM) tersedia pada dokumen desa dan dapat diintegrasikan ke halaman ini atau ke halaman admin untuk kemudahan pembaruan.</p>
        </div>

        <div class="text-center mb-12">
            <a href="{{ route('profil.sejarah') }}" class="inline-block bg-primary text-white px-5 py-2 rounded-lg">Kembali ke Sejarah</a>
        </div>
    </div>
</div>
@endsection
