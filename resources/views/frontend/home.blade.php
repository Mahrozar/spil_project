@extends('layouts.home-app')

@section('title', 'Desa Cicangkang Hilir - Sistem Informasi Desa Digital')

@push('styles')
<style>
    .hero-bg {
        background: linear-gradient(rgba(30, 64, 175, 0.85), rgba(30, 64, 175, 0.9)), url('https://images.unsplash.com/photo-1545569341-9eb8b30979d9?ixlib=rb-4.0.3&auto=format&fit=crop&w=1950&q=80');
        background-size: cover;
        background-position: center;
    }
    .feature-card:hover {
        transform: translateY(-10px);
        transition: transform 0.3s ease;
    }
    .stat-card {
        background: linear-gradient(135deg, #1e40af 0%, #3b82f6 100%);
    }
    .wilayah-img {
        background-image: url('https://images.unsplash.com/photo-1545569341-9eb8b30979d9?ixlib=rb-4.0.3&auto=format&fit=crop&w=1950&q=80');
        background-size: cover;
        background-position: center;
        min-height: 400px;
        border-radius: 12px;
    }
</style>
@endpush

@section('content')
    <!-- Hero Section -->
    <section id="home" class="hero-bg pt-32 pb-20 md:pb-32">
        <div class="container mx-auto px-6">
            <div class="flex flex-col md:flex-row items-center">
                <div class="md:w-1/2 text-white mb-10 md:mb-0">
                    <h1 class="text-4xl md:text-5xl font-bold mb-4">{{ \App\Models\Setting::get('home.hero_title', 'Selamat Datang di') }}</h1>
                    <h2 class="text-3xl md:text-4xl font-bold mb-6 text-yellow-300">{{ \App\Models\Setting::get('home.hero_subtitle', 'Desa Cicangkang Hilir') }}</h2>
                    <p class="text-xl mb-8 opacity-90">{{ \App\Models\Setting::get('home.hero_lead', 'Desa yang maju, mandiri, dan sejahtera berbasis teknologi informasi. Kecamatan Cipongkor, Kabupaten Bandung Barat.') }}</p>
                    <div class="flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-4">
                        <a href="#layanan" class="bg-white text-primary font-bold py-3 px-8 rounded-lg hover:bg-gray-100 text-center transition duration-300 shadow-lg">{{ \App\Models\Setting::get('home.cta_primary', 'Layanan Desa') }}</a>
                        <a href="#profil" class="bg-transparent border-2 border-white text-white py-3 px-8 rounded-lg hover:bg-white hover:text-primary text-center transition duration-300">{{ \App\Models\Setting::get('home.cta_secondary', 'Profil Desa') }}</a>
                    </div>
                </div>
                <div class="md:w-1/2">
                    <div class="bg-white rounded-xl shadow-2xl p-6 transform md:translate-y-10">
                        <div class="flex space-x-2 mb-4">
                            <div class="w-3 h-3 bg-red-500 rounded-full"></div>
                            <div class="w-3 h-3 bg-yellow-500 rounded-full"></div>
                            <div class="w-3 h-3 bg-green-500 rounded-full"></div>
                        </div>
                        <div class="bg-gray-100 p-4 rounded-lg mb-4">
                            <h3 class="font-bold text-primary mb-2">Data Desa Cicangkang Hilir</h3>
                            <div class="grid grid-cols-2 gap-4">
                                <div class="bg-white p-3 rounded shadow">
                                    <div class="text-sm text-gray-600">Jumlah Penduduk</div>
                                                        <div class="text-xl font-bold text-primary">{{ number_format($population) }}</div>
                                </div>
                                <div class="bg-white p-3 rounded shadow">
                                    <div class="text-sm text-gray-600">Kartu Keluarga</div>
                                                <div class="text-xl font-bold text-accent">{{ number_format($kk) }}</div>
                                </div>
                                <div class="bg-white p-3 rounded shadow">
                                    <div class="text-sm text-gray-600">Luas Wilayah</div>
                                                <div class="text-xl font-bold text-secondary">{{ $stat_area }}</div>
                                </div>
                                <div class="bg-white p-3 rounded shadow">
                                    <div class="text-sm text-gray-600">RT</div>
                                                <div class="text-xl font-bold text-yellow-600">{{ number_format($rtCount) }}</div>
                                </div>
                            </div>
                        </div>
                        <p class="text-gray-600 text-sm text-center">Data terupdate {{ now()->format('d F Y') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Profil Desa Section -->
    <section id="profil" class="py-20 bg-white">
        <div class="container mx-auto px-6">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-primary mb-4">Profil Desa Cicangkang Hilir</h2>
                <p class="text-gray-600 max-w-2xl mx-auto">Mengenal lebih dekat Desa Cicangkang Hilir, kecamatan Cipongkor, Kabupaten Bandung Barat</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
                <div>
                    <div class="wilayah-img"></div>
                </div>
                <div>
                    <h3 class="text-2xl font-bold text-primary mb-6">Desa Cicangkang Hilir</h3>
                    <p class="text-gray-600 mb-6">
                        Desa Cicangkang Hilir merupakan salah satu desa di Kecamatan Cipongkor, Kabupaten Bandung Barat, Provinsi Jawa Barat. 
                        Desa ini memiliki potensi alam yang indah dengan masyarakat yang ramah dan gotong royong.
                    </p>
                    
                    <div class="space-y-4">
                        <div class="flex items-start">
                            <div class="bg-blue-100 text-primary p-2 rounded-lg mr-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-bold text-lg text-dark">Lokasi Geografis</h4>
                                <p class="text-gray-600">Kecamatan Cipongkor, Kabupaten Bandung Barat, Jawa Barat</p>
                            </div>
                        </div>
                        
                        <div class="flex items-start">
                            <div class="bg-green-100 text-accent p-2 rounded-lg mr-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-bold text-lg text-dark">Potensi Unggulan</h4>
                                <p class="text-gray-600">Pertanian, Perkebunan, dan UMKM Lokal</p>
                            </div>
                        </div>
                        
                        <div class="flex items-start">
                            <div class="bg-purple-100 text-purple-600 p-2 rounded-lg mr-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5 3.75l-.75.75" />
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-bold text-lg text-dark">Jumlah Penduduk</h4>
                                <p class="text-gray-600">± 3,250 jiwa dengan 950 Kartu Keluarga</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mt-8">
                        <a href="{{ route('profil.visi-misi') }}" class="inline-flex items-center text-primary hover:text-secondary font-medium">
                            Pelajari lebih lanjut tentang desa kami
                            <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Layanan Section -->
    <section id="layanan" class="py-20 bg-gray-50">
        <div class="container mx-auto px-6">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-primary mb-4">Layanan Desa</h2>
                <p class="text-gray-600 max-w-2xl mx-auto">Berbagai layanan administrasi dan publik yang tersedia untuk masyarakat Desa Cicangkang Hilir</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                @if(!empty($layanan) && count($layanan) > 0)
                    @foreach($layanan as $item)
                        <div class="feature-card bg-white p-8 rounded-xl shadow-lg border border-gray-100">
                            <div class="bg-blue-100 text-primary w-16 h-16 rounded-full flex items-center justify-center mb-6">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold text-dark mb-3">{{ $item['title'] ?? 'Layanan' }}</h3>
                            <p class="text-gray-600 mb-4">{{ $item['description'] ?? '' }}</p>
                            @if(!empty($item['link']))
                                <a href="{{ $item['link'] }}" class="inline-flex items-center text-primary hover:text-secondary font-medium">Lihat detail</a>
                            @endif
                        </div>
                    @endforeach
                @else
                    <!-- fallback static cards -->
                    <div class="feature-card bg-white p-8 rounded-xl shadow-lg border border-gray-100">
                        <div class="bg-blue-100 text-primary w-16 h-16 rounded-full flex items-center justify-center mb-6">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-dark mb-3">Pengaduan Fasilitas Umum</h3>
                            <p class="text-gray-600 mb-4">Laporkan kerusakan atau keluhan terkait fasilitas umum desa (jalan, lampu, sarana publik) untuk ditindaklanjuti oleh pemerintah desa.</p>
                            <a href="/pelaporan-fasilitas" class="inline-flex items-center text-primary hover:text-secondary font-medium">Laporkan sekarang</a>
                    </div>

                    <div class="feature-card bg-white p-8 rounded-xl shadow-lg border border-gray-100">
                        <div class="bg-green-100 text-accent w-16 h-16 rounded-full flex items-center justify-center mb-6">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-dark mb-3">Surat Menyurat</h3>
                        <p class="text-gray-600 mb-4">Pembuatan surat keterangan, pengantar, rekomendasi, dan surat resmi desa lainnya.</p>
                        <a href="{{ route('layanan.surat-online') }}" class="inline-flex items-center text-primary hover:text-secondary font-medium">Ajukan online</a>
                    </div>

                    <!-- UMKM card removed as requested -->
                @endif

                 <!-- Statistik Pengajuan (tampil di area Layanan, ringkas: nama, nama surat, status) -->
                 <div class="bg-white rounded-xl shadow-lg border border-gray-100 md:col-span-2">
                    <div class="p-6 bg-white rounded-t-xl text-center">
                        <div class="mx-auto inline-flex items-center justify-center bg-indigo-100 text-indigo-600 w-12 h-12 rounded-full mb-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m1 7a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-primary mb-1">Daftar Pengajuan Surat</h3>
                        <p class="text-sm text-primary/80">Ringkasan pengajuan Anda (nama, jenis surat, status).</p>
                    </div>

                    <div class="p-6">
                        <div class="mb-4">
                            <input id="submission-search" type="search" placeholder="Cari nama, jenis surat, atau status..." class="w-full md:w-1/2 px-4 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary" />
                        </div>

                        @if(!empty($mySubmissions) && count($mySubmissions) > 0)
                            <div class="max-h-64 overflow-y-auto rounded shadow-sm">
                                <table class="w-full table-auto text-sm">
                                    <thead>
                                        <tr class="text-left text-gray-600 bg-gray-50 sticky top-0">
                                            <th class="px-4 py-3">Nama</th>
                                            <th class="px-4 py-3">Nama Surat</th>
                                            <th class="w-40 px-4 py-3">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody id="submission-tbody" class="divide-y divide-gray-100 bg-white">
                                        @foreach($mySubmissions as $s)
                                            <tr>
                                                <td class="px-4 py-3 align-top text-gray-700">{{ $s->nama ?? '-' }}</td>
                                                <td class="px-4 py-3 align-top text-gray-700">{{ $s->jenis_surat ?? $s->nama_surat ?? '-' }}</td>
                                                <td class="px-4 py-3 align-top">
                                                    <span class="{{ $s->badgeClass() }}">{{ $s->statusLabel() }}</span>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="text-center py-6 text-gray-600">
                                Belum ada pengajuan yang tersedia.
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Daftar Pelaporan Fasilitas (public reports) -->
                <div class="bg-white rounded-xl shadow-lg border border-gray-100 md:col-span-2">
                    <div class="p-6 bg-white rounded-t-xl text-center">
                        <div class="mx-auto inline-flex items-center justify-center bg-green-100 text-green-600 w-12 h-12 rounded-full mb-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h4l3 8 4-16 3 8h4" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-primary mb-1">Daftar Pengaduan Fasilitas Umum</h3>
                        <p class="text-sm text-primary/80">Ringkasan pengaduan fasilitas umum (pelapor, kategori, lokasi, status).</p>
                    </div>

                    <div class="p-6">
                        <div class="mb-4">
                            <input id="report-search" type="search" placeholder="Cari pelapor, kategori, lokasi, atau status..." class="w-full md:w-1/2 px-4 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary" />
                        </div>

                        @if(!empty($myReports) && count($myReports) > 0)
                            <div class="max-h-64 overflow-y-auto rounded shadow-sm">
                                <table class="w-full table-auto text-sm">
                                    <thead>
                                        <tr class="text-left text-gray-600 bg-gray-50 sticky top-0">
                                            <th class="px-4 py-3">Pelapor</th>
                                            <th class="px-4 py-3">Kategori / Tipe</th>
                                            <th class="px-4 py-3">Lokasi</th>
                                            <th class="w-36 px-4 py-3">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody id="report-tbody" class="divide-y divide-gray-100 bg-white">
                                        @foreach($myReports as $r)
                                            <tr>
                                                <td class="px-4 py-3 align-top text-gray-700">{{ $r->user->name ?? $r->reporter_name ?? 'Anonim' }}</td>
                                                <td class="px-4 py-3 align-top text-gray-700">{{ $r->facility_label ?? ($r->facility_category . ' / ' . $r->facility_type) }}</td>
                                                <td class="px-4 py-3 align-top text-gray-700">{{ Str::limit($r->address, 60) }}</td>
                                                <td class="px-4 py-3 align-top">
                                                    <span class="{{ $r->status_color ?? 'bg-gray-100 text-gray-800' }} inline-flex items-center px-2 py-1 rounded text-xs">{{ $r->status_label }}</span>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="text-center py-6 text-gray-600">
                                Belum ada laporan fasilitas yang tersedia.
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Berita Desa Section -->
    <section id="berita" class="py-20 bg-white">
        <div class="container mx-auto px-6">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-primary mb-4">Berita & Informasi Terkini</h2>
                <p class="text-gray-600 max-w-2xl mx-auto">Update informasi terbaru dari Pemerintah Desa Cicangkang Hilir</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @if(!empty($berita) && count($berita) > 0)
                    @foreach($berita as $b)
                        <div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-100">
                            <div class="h-48 bg-gray-100"></div>
                            <div class="p-6">
                                <div class="text-sm text-gray-500 mb-2">{{ !empty($b['date']) ? \Carbon\Carbon::parse($b['date'])->format('d F Y') : '' }}</div>
                                <h3 class="text-xl font-bold text-dark mb-3">{{ $b['title'] ?? '' }}</h3>
                                <p class="text-gray-600 mb-4">{{ $b['excerpt'] ?? '' }}</p>
                                @if(!empty($b['link']))
                                    <a href="{{ $b['link'] }}" class="text-primary hover:text-secondary font-medium">Baca selengkapnya →</a>
                                @endif
                            </div>
                        </div>
                    @endforeach
                @else
                    <!-- fallback static berita -->
                    <div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-100">
                        <div class="h-48 bg-blue-100"></div>
                        <div class="p-6">
                            <div class="text-sm text-gray-500 mb-2">15 Maret 2024</div>
                            <h3 class="text-xl font-bold text-dark mb-3">Program Bantuan Sosial Tahap II</h3>
                            <p class="text-gray-600 mb-4">Pendistribusian bantuan sosial untuk masyarakat terdampak akan dilaksanakan mulai minggu depan.</p>
                            <a href="#" class="text-primary hover:text-secondary font-medium">Baca selengkapnya →</a>
                        </div>
                    </div>

                    <div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-100">
                        <div class="h-48 bg-green-100"></div>
                        <div class="p-6">
                            <div class="text-sm text-gray-500 mb-2">10 Maret 2024</div>
                            <h3 class="text-xl font-bold text-dark mb-3">Gotong Royong Perbaikan Jalan Dusun</h3>
                            <p class="text-gray-600 mb-4">Ayo ramaikan kegiatan gotong royong perbaikan jalan dusun pada hari Sabtu, 18 Maret 2024.</p>
                            <a href="#" class="text-primary hover:text-secondary font-medium">Baca selengkapnya →</a>
                        </div>
                    </div>

                    <div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-100">
                        <div class="h-48 bg-yellow-100"></div>
                        <div class="p-6">
                            <div class="text-sm text-gray-500 mb-2">5 Maret 2024</div>
                            <h3 class="text-xl font-bold text-dark mb-3">Pelatihan Digital Marketing UMKM</h3>
                            <p class="text-gray-600 mb-4">Pelatihan gratis untuk pelaku UMKM desa dalam memanfaatkan digital untuk pemasaran produk.</p>
                            <a href="#" class="text-primary hover:text-secondary font-medium">Baca selengkapnya →</a>
                        </div>
                    </div>
                @endif
            </div>
            
            <div class="text-center mt-12">
                <a href="#" class="bg-primary text-white font-bold py-3 px-8 rounded-lg hover:bg-secondary transition duration-300 shadow-md inline-flex items-center">
                    Lihat Semua Berita
                    <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                    </svg>
                </a>
            </div>
        </div>
    </section>

    <!-- Galeri Section -->
    <section id="galeri" class="py-20 bg-gray-50">
        <div class="container mx-auto px-6">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-primary mb-4">Galeri Desa</h2>
                <p class="text-gray-600 max-w-2xl mx-auto">Dokumentasi kegiatan dan potensi Desa Cicangkang Hilir</p>
            </div>
            
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                @if(!empty($galeri) && count($galeri) > 0)
                    @foreach($galeri as $g)
                        <div class="h-48 bg-gray-100 rounded-lg overflow-hidden">
                            <img src="{{ $g }}" alt="Galeri" class="w-full h-full object-cover" />
                        </div>
                    @endforeach
                @else
                    <div class="h-48 bg-blue-200 rounded-lg"></div>
                    <div class="h-48 bg-green-200 rounded-lg"></div>
                    <div class="h-48 bg-yellow-200 rounded-lg"></div>
                    <div class="h-48 bg-purple-200 rounded-lg"></div>
                @endif
            </div>
            
            <div class="text-center mt-8">
                <a href="#" class="text-primary hover:text-secondary font-medium inline-flex items-center">
                    Lihat galeri lengkap
                    <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                    </svg>
                </a>
            </div>
        </div>
    </section>

    <!-- Statistik Section -->
    <section class="py-20 bg-primary text-white">
        <div class="container mx-auto px-6">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold mb-4">Desa Cicangkang Hilir dalam Angka</h2>
                <p class="text-blue-100 max-w-2xl mx-auto">Data statistik terkini yang menggambarkan perkembangan desa</p>
            </div>
            
            <div class="grid grid-cols-2 md:grid-cols-5 gap-8">
                <div class="text-center">
                    <div class="text-4xl md:text-5xl font-bold mb-2">{{ number_format($population) }}</div>
                    <div class="text-blue-200">Jiwa Penduduk</div>
                </div>
                <div class="text-center">
                    <div class="text-4xl md:text-5xl font-bold mb-2">{{ number_format($kk) }}</div>
                    <div class="text-blue-200">Kartu Keluarga</div>
                </div>
                <div class="text-center">
                    <div class="text-4xl md:text-5xl font-bold mb-2">{{ number_format($rtCount) }}</div>
                    <div class="text-blue-200">RT</div>
                </div>
                <div class="text-center">
                    <div class="text-4xl md:text-5xl font-bold mb-2">{{ number_format($rwCount) }}</div>
                    <div class="text-blue-200">RW</div>
                </div>
                <div class="text-center">
                    <div class="text-4xl md:text-5xl font-bold mb-2">{{ $stat_area }}</div>
                    <div class="text-blue-200">Hektar Luas Wilayah</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Kontak Section -->
    <section id="kontak" class="py-20 bg-white">
        <div class="container mx-auto px-6">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-primary mb-4">Kontak & Lokasi</h2>
                <p class="text-gray-600 max-w-2xl mx-auto">Hubungi kami untuk informasi lebih lanjut</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
                <div>
                    <h3 class="text-2xl font-bold text-dark mb-6">Kantor Desa Cicangkang Hilir</h3>
                    
                    <div class="space-y-6">
                        <div class="flex items-start">
                            <div class="bg-primary text-white p-3 rounded-lg mr-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-bold text-lg">Alamat Kantor</h4>
                                <p class="text-gray-600">Jl. Desa Cicangkang Hilir No. 01, Kecamatan Cipongkor, Kabupaten Bandung Barat, Jawa Barat 40553</p>
                            </div>
                        </div>
                        
                        <div class="flex items-start">
                            <div class="bg-primary text-white p-3 rounded-lg mr-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-bold text-lg">Telepon & WhatsApp</h4>
                                <p class="text-gray-600">(022) 1234-5678</p>
                                <p class="text-gray-600">0812-3456-7890 (WhatsApp)</p>
                            </div>
                        </div>
                        
                        <div class="flex items-start">
                            <div class="bg-primary text-white p-3 rounded-lg mr-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-bold text-lg">Email</h4>
                                <p class="text-gray-600">desa.cicangkanghilir@bandungbaratkab.go.id</p>
                                <p class="text-gray-600">info.cicangkanghilir@gmail.com</p>
                            </div>
                        </div>
                        
                        <div class="flex items-start">
                            <div class="bg-primary text-white p-3 rounded-lg mr-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-bold text-lg">Jam Operasional</h4>
                                <p class="text-gray-600">Senin - Kamis: 08.00 - 15.00 WIB</p>
                                <p class="text-gray-600">Jumat: 08.00 - 11.00 WIB</p>
                                <p class="text-gray-600">Sabtu: 08.00 - 13.00 WIB</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div>
                    <h3 class="text-2xl font-bold text-dark mb-6">Kirim Pesan / Pengaduan</h3>
                    <form id="contact-form" class="space-y-6">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-gray-700 mb-2">Nama Lengkap *</label>
                                <input type="text" name="nama" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent" placeholder="Nama Anda">
                            </div>
                            <div>
                                <label class="block text-gray-700 mb-2">No. HP/WhatsApp *</label>
                                <input type="tel" name="telepon" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent" placeholder="08xx-xxxx-xxxx">
                            </div>
                        </div>
                        <div>
                            <label class="block text-gray-700 mb-2">Email</label>
                            <input type="email" name="email" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent" placeholder="email@contoh.com">
                        </div>
                        <div>
                            <label class="block text-gray-700 mb-2">Subjek *</label>
                            <select name="subjek" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent">
                                <option value="">Pilih Subjek</option>
                                <option value="informasi">Permintaan Informasi</option>
                                <option value="pengaduan">Pengaduan Masyarakat</option>
                                <option value="layanan">Layanan Administrasi</option>
                                <option value="saran">Saran & Kritik</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-gray-700 mb-2">Pesan *</label>
                            <textarea name="pesan" rows="4" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent" placeholder="Tulis pesan/pengaduan Anda di sini..."></textarea>
                        </div>
                        <button type="submit" class="bg-primary text-white font-bold py-3 px-8 rounded-lg hover:bg-secondary transition duration-300 shadow-md w-full">Kirim Pesan</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
<script>
// Simple client-side filtering for submissions and reports tables
function setupTableFilter(inputId, tbodyId) {
    const input = document.getElementById(inputId);
    const tbody = document.getElementById(tbodyId);
    if (!input || !tbody) return;

    input.addEventListener('input', function() {
        const q = input.value.toLowerCase().trim();
        const rows = Array.from(tbody.querySelectorAll('tr'));
        rows.forEach(r => {
            const text = r.textContent.toLowerCase();
            r.style.display = text.includes(q) ? '' : 'none';
        });
    });
}

document.addEventListener('DOMContentLoaded', function(){
    setupTableFilter('submission-search', 'submission-tbody');
    setupTableFilter('report-search', 'report-tbody');
});
</script>
@endpush

@push('scripts')
<script>
    // Smooth scrolling for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            
            const targetId = this.getAttribute('href');
            if (targetId === '#') return;
            
            const targetElement = document.querySelector(targetId);
            if (targetElement) {
                window.scrollTo({
                    top: targetElement.offsetTop - 100,
                    behavior: 'smooth'
                });
                
                // Close mobile menu if open
                const mobileMenu = document.getElementById('mobile-menu');
                if (mobileMenu && !mobileMenu.classList.contains('hidden')) {
                    mobileMenu.classList.add('hidden');
                }
            }
        });
    });

    // Contact form submission
    document.getElementById('contact-form').addEventListener('submit', function(e) {
        e.preventDefault();
        
        // Get form data
        const formData = new FormData(this);
        
        // Simulate form submission
        alert('Terima kasih! Pesan/pengaduan Anda telah berhasil dikirim. Kami akan menghubungi Anda segera.');
        this.reset();
    });
</script>
@endpush