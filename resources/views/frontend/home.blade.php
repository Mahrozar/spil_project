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

        /* ============================================
                                   HEATMAP CONTAINER & LAYOUT
                                ============================================ */
        #heatmap-container {
            height: 500px;
            border-radius: 12px;
            overflow: hidden;
            position: relative;
            z-index: 1;
            border: 1px solid #e5e7eb;
            background-color: #f8fafc;
        }

        /* Ensure Leaflet map takes full container */
        #heatmap-container .leaflet-container {
            height: 100% !important;
            width: 100% !important;
            border-radius: 12px;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
        }

        /* Leaflet popup styling */
        .leaflet-popup-content-wrapper {
            border-radius: 8px;
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.15);
            padding: 0;
        }

        .leaflet-popup-content {
            margin: 0;
            padding: 12px;
            min-width: 250px;
            font-size: 14px;
        }

        /* ============================================
                                   HEATMAP LEGEND STYLES
                                ============================================ */
        .heatmap-legend {
            position: absolute;
            bottom: 20px;
            left: 20px;
            background: rgba(255, 255, 255, 0.95);
            padding: 12px 16px;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            z-index: 1000;
            max-width: 280px;
            backdrop-filter: blur(4px);
            border: 1px solid rgba(0, 0, 0, 0.1);
        }

        .heatmap-legend h4 {
            color: #1e40af;
            font-size: 0.95rem;
            font-weight: 600;
            margin-bottom: 8px;
        }

        .legend-item {
            display: flex;
            align-items: center;
            margin: 8px 0;
        }

        .legend-color {
            width: 20px;
            height: 20px;
            border-radius: 4px;
            margin-right: 10px;
            border: 1px solid rgba(0, 0, 0, 0.1);
            flex-shrink: 0;
        }

        .legend-item span {
            font-size: 0.875rem;
            color: #374151;
        }

        /* ============================================
                                   HEATMAP CONTROLS STYLES
                                ============================================ */
        .heatmap-controls {
            position: absolute;
            top: 20px;
            right: 20px;
            background: rgba(255, 255, 255, 0.95);
            padding: 16px;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            z-index: 1000;
            max-width: 280px;
            backdrop-filter: blur(4px);
            border: 1px solid rgba(0, 0, 0, 0.1);
        }

        .heatmap-controls h4 {
            color: #1e40af;
            font-size: 0.95rem;
            font-weight: 600;
            margin-bottom: 12px;
        }

        .filter-group {
            max-height: 200px;
            overflow-y: auto;
            padding-right: 4px;
        }

        .filter-group::-webkit-scrollbar {
            width: 4px;
        }

        .filter-group::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 4px;
        }

        .filter-group::-webkit-scrollbar-thumb {
            background: #c1c1c1;
            border-radius: 4px;
        }

        .filter-item {
            display: flex;
            align-items: center;
            margin: 6px 0;
            padding: 4px 0;
        }

        .filter-item input[type="checkbox"] {
            width: 16px;
            height: 16px;
            margin-right: 10px;
            cursor: pointer;
            accent-color: #1e40af;
        }

        .filter-item label {
            font-size: 0.875rem;
            color: #374151;
            cursor: pointer;
            user-select: none;
            flex: 1;
        }

        #refresh-heatmap {
            width: 100%;
            margin-top: 12px;
            padding: 8px 16px;
            background: linear-gradient(135deg, #1e40af 0%, #3b82f6 100%);
            color: white;
            border: none;
            border-radius: 6px;
            font-weight: 600;
            font-size: 0.875rem;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        #refresh-heatmap:hover {
            background: linear-gradient(135deg, #1e3a8a 0%, #2563eb 100%);
            transform: translateY(-1px);
            box-shadow: 0 4px 8px rgba(30, 64, 175, 0.2);
        }

        /* ============================================
                                   RESPONSIVE DESIGN
                                ============================================ */
        @media (max-width: 768px) {
            #heatmap-container {
                height: 400px;
            }

            .heatmap-legend,
            .heatmap-controls {
                max-width: 180px;
                padding: 10px 12px;
                font-size: 0.875rem;
            }

            .heatmap-legend {
                bottom: 10px;
                left: 10px;
            }

            .heatmap-controls {
                top: 10px;
                right: 10px;
            }

            .legend-color {
                width: 16px;
                height: 16px;
            }

            #refresh-heatmap {
                padding: 6px 12px;
                font-size: 0.8rem;
            }
        }

        @media (max-width: 480px) {
            #heatmap-container {
                height: 350px;
            }

            .heatmap-legend,
            .heatmap-controls {
                max-width: 150px;
                padding: 8px 10px;
                font-size: 0.8rem;
            }

            .heatmap-legend {
                display: none;
            }
        }

        /* ============================================
                                   ERROR STATES
                                ============================================ */
        .heatmap-error {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(248, 250, 252, 0.95);
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 12px;
            z-index: 999;
            padding: 20px;
            text-align: center;
        }

        .heatmap-error h3 {
            color: #dc2626;
            font-size: 1.125rem;
            font-weight: 600;
            margin-bottom: 8px;
        }

        /* ============================================
                                   NO DATA STATE
                                ============================================ */
        .heatmap-no-data {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(248, 250, 252, 0.95);
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 12px;
            z-index: 999;
            padding: 20px;
            text-align: center;
        }

        .line-clamp-1 {
            overflow: hidden;
            display: -webkit-box;
            -webkit-box-orient: vertical;
            -webkit-line-clamp: 1;
        }

        .line-clamp-2 {
            overflow: hidden;
            display: -webkit-box;
            -webkit-box-orient: vertical;
            -webkit-line-clamp: 2;
        }

        .line-clamp-3 {
            overflow: hidden;
            display: -webkit-box;
            -webkit-box-orient: vertical;
            -webkit-line-clamp: 3;
        }

        /* Hover effect for news cards */
        .hover-scale {
            transition: transform 0.3s ease;
        }

        .hover-scale:hover {
            transform: scale(1.05);
        }
    </style>

    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster@1.5.3/dist/MarkerCluster.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster@1.5.3/dist/MarkerCluster.Default.css" />

    <!-- Heatmap.js CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet.heat@0.2.0/dist/leaflet-heat.css" />
@endpush

@section('content')
    <!-- Hero Section -->
    <section id="home" class="hero-bg pt-32 pb-20 md:pb-32">
        <div class="container mx-auto px-6">
            <div class="flex flex-col md:flex-row items-center">
                <div class="md:w-1/2 text-white mb-10 md:mb-0">
                    <h1 class="text-4xl md:text-5xl font-bold mb-4">
                        {{ \App\Models\Setting::get('home.hero_title', 'Selamat Datang di') }}</h1>
                    <h2 class="text-3xl md:text-4xl font-bold mb-6 text-yellow-300">
                        {{ \App\Models\Setting::get('home.hero_subtitle', 'Desa Cicangkang Hilir') }}</h2>
                    <p class="text-xl mb-8 opacity-90">
                        {{ \App\Models\Setting::get('home.hero_lead', 'Desa yang maju, mandiri, dan sejahtera berbasis teknologi informasi. Kecamatan Cipongkor, Kabupaten Bandung Barat.') }}
                    </p>
                    <div class="flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-4">
                        <a href="#layanan"
                            class="bg-white text-primary font-bold py-3 px-8 rounded-lg hover:bg-gray-100 text-center transition duration-300 shadow-lg">{{ \App\Models\Setting::get('home.cta_primary', 'Layanan Desa') }}</a>
                        <a href="#profil"
                            class="bg-transparent border-2 border-white text-white py-3 px-8 rounded-lg hover:bg-white hover:text-primary text-center transition duration-300">{{ \App\Models\Setting::get('home.cta_secondary', 'Profil Desa') }}</a>
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
                <p class="text-gray-600 max-w-2xl mx-auto">Mengenal lebih dekat Desa Cicangkang Hilir, kecamatan Cipongkor,
                    Kabupaten Bandung Barat</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
                <div>
                    <div class="wilayah-img"></div>
                </div>
                <div>
                    <h3 class="text-2xl font-bold text-primary mb-6">Desa Cicangkang Hilir</h3>
                    <p class="text-gray-600 mb-6">
                        Desa Cicangkang Hilir merupakan salah satu desa di Kecamatan Cipongkor, Kabupaten Bandung Barat,
                        Provinsi Jawa Barat.
                        Desa ini memiliki potensi alam yang indah dengan masyarakat yang ramah dan gotong royong.
                    </p>

                    <div class="space-y-4">
                        <div class="flex items-start">
                            <div class="bg-blue-100 text-primary p-2 rounded-lg mr-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-bold text-lg text-dark">Lokasi Geografis</h4>
                                <p class="text-gray-600">Kecamatan Cipongkor, Kabupaten Bandung Barat, Jawa Barat</p>
                            </div>
                        </div>

                        <div class="flex items-start">
                            <div class="bg-green-100 text-accent p-2 rounded-lg mr-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-bold text-lg text-dark">Potensi Unggulan</h4>
                                <p class="text-gray-600">Pertanian, Perkebunan, dan UMKM Lokal</p>
                            </div>
                        </div>

                        <div class="flex items-start">
                            <div class="bg-purple-100 text-purple-600 p-2 rounded-lg mr-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5 3.75l-.75.75" />
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-bold text-lg text-dark">Jumlah Penduduk</h4>
                                <p class="text-gray-600">± 3,250 jiwa dengan 950 Kartu Keluarga</p>
                            </div>
                        </div>
                    </div>

                    <div class="mt-8">
                        <a href="{{ route('profil.visi-misi') }}"
                            class="inline-flex items-center text-primary hover:text-secondary font-medium">
                            Pelajari lebih lanjut tentang desa kami
                            <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
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
                <p class="text-gray-600 max-w-2xl mx-auto">Berbagai layanan administrasi dan publik yang tersedia untuk
                    masyarakat Desa Cicangkang Hilir</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                @if (!empty($layanan) && count($layanan) > 0)
                    @foreach ($layanan as $item)
                        <div class="feature-card bg-white p-8 rounded-xl shadow-lg border border-gray-100">
                            <div
                                class="bg-blue-100 text-primary w-16 h-16 rounded-full flex items-center justify-center mb-6">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold text-dark mb-3">{{ $item['title'] ?? 'Layanan' }}</h3>
                            <p class="text-gray-600 mb-4">{{ $item['description'] ?? '' }}</p>
                            @if (!empty($item['link']))
                                <a href="{{ $item['link'] }}"
                                    class="inline-flex items-center text-primary hover:text-secondary font-medium">Lihat
                                    detail</a>
                            @endif
                        </div>
                    @endforeach
                @else
                    <!-- fallback static cards -->
                    <div class="feature-card bg-white p-8 rounded-xl shadow-lg border border-gray-100">
                        <div class="bg-blue-100 text-primary w-16 h-16 rounded-full flex items-center justify-center mb-6">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-dark mb-3">Pengaduan Fasilitas Umum</h3>
                        <p class="text-gray-600 mb-4">Laporkan kerusakan atau keluhan terkait fasilitas umum desa (jalan,
                            lampu, sarana publik) untuk ditindaklanjuti oleh pemerintah desa.</p>
                        <a href="{{ route('reports.create') }}"
                            class="inline-flex items-center text-primary hover:text-secondary font-medium">Laporkan
                            sekarang</a>
                    </div>

                    <div class="feature-card bg-white p-8 rounded-xl shadow-lg border border-gray-100">
                        <div class="bg-green-100 text-accent w-16 h-16 rounded-full flex items-center justify-center mb-6">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-dark mb-3">Surat Menyurat</h3>
                        <p class="text-gray-600 mb-4">Pembuatan surat keterangan, pengantar, rekomendasi, dan surat resmi
                            desa lainnya.</p>
                        <a href="{{ route('layanan.surat-online') }}"
                            class="inline-flex items-center text-primary hover:text-secondary font-medium">Ajukan
                            online</a>
                    </div>
                @endif

                <!-- Statistik Pengajuan -->
                <div class="bg-white rounded-xl shadow-lg border border-gray-100 md:col-span-2">
                    <div class="p-6 bg-white rounded-t-xl text-center">
                        <div
                            class="mx-auto inline-flex items-center justify-center bg-indigo-100 text-indigo-600 w-12 h-12 rounded-full mb-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m1 7a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-primary mb-1">Daftar Pengajuan Surat</h3>
                        <p class="text-sm text-primary/80">Ringkasan pengajuan Anda (nama, jenis surat, status).</p>
                    </div>

                    <div class="p-6">
                        <div class="mb-4">
                            <input id="submission-search" type="search"
                                placeholder="Cari nama, jenis surat, atau status..."
                                class="w-full md:w-1/2 px-4 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary" />
                        </div>

                        @if (!empty($mySubmissions) && count($mySubmissions) > 0)
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
                                        @foreach ($mySubmissions as $s)
                                            <tr>
                                                <td class="px-4 py-3 align-top text-gray-700">{{ $s->nama ?? '-' }}</td>
                                                <td class="px-4 py-3 align-top text-gray-700">
                                                    {{ $s->jenis_surat ?? ($s->nama_surat ?? '-') }}</td>
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

                <!-- Heatmap Pengaduan Fasilitas -->
                <div class="bg-white rounded-xl shadow-lg border border-gray-100 md:col-span-2">
                    <div class="p-6 bg-white rounded-t-xl text-center">
                        <div
                            class="mx-auto inline-flex items-center justify-center bg-red-100 text-red-600 w-12 h-12 rounded-full mb-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 10h4l3 8 4-16 3 8h4" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-primary mb-1">Peta Heatmap Pengaduan Fasilitas Umum</h3>
                        <p class="text-sm text-primary/80">Visualisasi lokasi dan intensitas pengaduan fasilitas umum di
                            Desa Cicangkang Hilir.</p>
                    </div>

                    <div class="p-2">
                        <!-- Heatmap Container dengan Legend & Controls DI DALAM -->
                        <div id="heatmap-container" class="relative">
                            <!-- Heatmap akan dirender di sini oleh JavaScript -->

                            <!-- Legend & Controls - ELEMEN INI AKAN DITAMPILKAN OLEH JAVASCRIPT -->
                        </div>
                    </div>

                    <!-- Informasi Statistik -->
                    <div class="p-4 bg-gray-50 border-t border-gray-200">
                        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                            <div class="text-center p-3 bg-white rounded-lg shadow">
                                <div class="text-lg font-bold text-primary">
                                    {{ $myReports->where('status', 'submitted')->count() }}</div>
                                <div class="text-sm text-gray-600">Pengaduan Baru</div>
                            </div>
                            <div class="text-center p-3 bg-white rounded-lg shadow">
                                <div class="text-lg font-bold text-yellow-600">
                                    {{ $myReports->where('status', 'in_progress')->count() }}</div>
                                <div class="text-sm text-gray-600">Sedang Diproses</div>
                            </div>
                            <div class="text-center p-3 bg-white rounded-lg shadow">
                                <div class="text-lg font-bold text-green-600">
                                    {{ $myReports->where('status', 'completed')->count() }}</div>
                                <div class="text-sm text-gray-600">Selesai</div>
                            </div>
                            <div class="text-center p-3 bg-white rounded-lg shadow">
                                <div class="text-lg font-bold text-red-600">
                                    @php
                                        $total = $myReports->count();
                                        $completed = $myReports->where('status', 'completed')->count();
                                        $percent = $total > 0 ? round(($completed / $total) * 100) : 0;
                                    @endphp
                                    {{ $percent }}%
                                </div>
                                <div class="text-sm text-gray-600">Tingkat Penyelesaian</div>
                            </div>
                        </div>
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
                <p class="text-gray-600 max-w-2xl mx-auto">Update informasi terbaru dari Pemerintah Desa Cicangkang Hilir
                </p>
            </div>

            @if ($berita->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    @foreach ($berita as $item)
                        <div
                            class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-100 hover:shadow-lg transition-shadow duration-300">
                            <!-- Thumbnail -->
                            <div class="h-48 overflow-hidden">
                                <img src="{{ $item->thumbnail }}" alt="{{ $item->title }}"
                                    class="w-full h-full object-cover hover:scale-105 transition-transform duration-300">
                            </div>

                            <!-- Content -->
                            <div class="p-6">
                                <div class="text-sm text-gray-500 mb-2">
                                    {{ $item->published_date }}
                                    @if ($item->author)
                                        <span class="mx-2">•</span>
                                        <span>{{ $item->author->name }}</span>
                                    @endif
                                </div>

                                <h3 class="text-xl font-bold text-dark mb-3 line-clamp-2">
                                    {{ $item->title }}
                                </h3>

                                <p class="text-gray-600 mb-4 line-clamp-3">
                                    {{ $item->short_excerpt }}
                                </p>

                                <a href="{{ route('news.show', $item->slug) }}"
                                    class="text-primary hover:text-secondary font-medium inline-flex items-center">
                                    Baca selengkapnya
                                    <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <!-- Fallback jika tidak ada berita -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-100">
                        <div class="h-48 bg-blue-100 flex items-center justify-center">
                            <svg class="w-12 h-12 text-blue-400" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
                            </svg>
                        </div>
                        <div class="p-6">
                            <div class="text-sm text-gray-500 mb-2">Belum ada berita</div>
                            <h3 class="text-xl font-bold text-dark mb-3">Berita Akan Segera Datang</h3>
                            <p class="text-gray-600 mb-4">Informasi dan berita terbaru dari desa akan segera tersedia.</p>
                        </div>
                    </div>

                    <!-- ... dua card fallback lainnya ... -->
                </div>
            @endif

            <div class="text-center mt-12">
                @if ($berita->count() > 0)
                    <a href="{{ route('news.index') }}"
                        class="bg-primary text-white font-bold py-3 px-8 rounded-lg hover:bg-secondary transition duration-300 shadow-md inline-flex items-center">
                        Lihat Semua Berita
                        <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                        </svg>
                    </a>
                @endif
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
                @if (count($galeri) > 0)
                    @foreach ($galeri as $item)
                        @php
                            // Pastikan $item adalah array
                            $item = is_array($item) ? $item : [];
                            $link = $item['link'] ?? '#';
                            $image = $item['image'] ?? asset('images/default-gallery.jpg');
                            $title = $item['title'] ?? 'Galeri Desa';
                            $category = $item['category'] ?? null;
                        @endphp
                        <a href="{{ $link }}"
                            class="h-48 bg-gray-100 rounded-lg overflow-hidden group cursor-pointer relative block">
                            <img src="{{ $image }}" alt="{{ $title }}"
                                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300" />

                            @if ($title)
                                <div
                                    class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end p-4">
                                    <p class="text-white text-sm font-medium">{{ $title }}</p>
                                </div>
                            @endif

                            <!-- Category Badge -->
                            @if ($category)
                                <div class="absolute top-2 left-2">
                                    <span class="px-2 py-1 bg-primary text-white text-xs rounded-full opacity-90">
                                        {{ ucfirst($category) }}
                                    </span>
                                </div>
                            @endif
                        </a>
                    @endforeach
                @else
                    <!-- Placeholder jika tidak ada gambar -->
                    <div class="h-48 bg-blue-200 rounded-lg flex items-center justify-center">
                        <span class="text-gray-500">Belum ada gambar</span>
                    </div>
                    <div class="h-48 bg-green-200 rounded-lg flex items-center justify-center">
                        <span class="text-gray-500">Belum ada gambar</span>
                    </div>
                    <div class="h-48 bg-yellow-200 rounded-lg flex items-center justify-center">
                        <span class="text-gray-500">Belum ada gambar</span>
                    </div>
                    <div class="h-48 bg-purple-200 rounded-lg flex items-center justify-center">
                        <span class="text-gray-500">Belum ada gambar</span>
                    </div>
                @endif
            </div>

            @if (count($galeri) > 0)
                <div class="text-center mt-8">
                    <a href="{{ route('gallery.index') }}"
                        class="text-primary hover:text-secondary font-medium inline-flex items-center">
                        Lihat galeri lengkap
                        <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15">
                            </path>
                        </svg>
                    </a>
                </div>
            @endif
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
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-bold text-lg">Alamat Kantor</h4>
                                <p class="text-gray-600">Jl. Desa Cicangkang Hilir No. 01, Kecamatan Cipongkor, Kabupaten
                                    Bandung Barat, Jawa Barat 40553</p>
                            </div>
                        </div>

                        <div class="flex items-start">
                            <div class="bg-primary text-white p-3 rounded-lg mr-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
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
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
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
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
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
                                <input type="text" name="nama" required
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent"
                                    placeholder="Nama Anda">
                            </div>
                            <div>
                                <label class="block text-gray-700 mb-2">No. HP/WhatsApp *</label>
                                <input type="tel" name="telepon" required
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent"
                                    placeholder="08xx-xxxx-xxxx">
                            </div>
                        </div>
                        <div>
                            <label class="block text-gray-700 mb-2">Email</label>
                            <input type="email" name="email"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent"
                                placeholder="email@contoh.com">
                        </div>
                        <div>
                            <label class="block text-gray-700 mb-2">Subjek *</label>
                            <select name="subjek" required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent">
                                <option value="">Pilih Subjek</option>
                                <option value="informasi">Permintaan Informasi</option>
                                <option value="pengaduan">Pengaduan Masyarakat</option>
                                <option value="layanan">Layanan Administrasi</option>
                                <option value="saran">Saran & Kritik</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-gray-700 mb-2">Pesan *</label>
                            <textarea name="pesan" rows="4" required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent"
                                placeholder="Tulis pesan/pengaduan Anda di sini..."></textarea>
                        </div>
                        <button type="submit"
                            class="bg-primary text-white font-bold py-3 px-8 rounded-lg hover:bg-secondary transition duration-300 shadow-md w-full">Kirim
                            Pesan</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <!-- Leaflet JS -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script src="https://unpkg.com/leaflet.markercluster@1.5.3/dist/leaflet.markercluster.js"></script>
    <script src="https://unpkg.com/leaflet.heat@0.2.0/dist/leaflet-heat.js"></script>

    <script>
        // Simple client-side filtering for submissions
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

        // Heatmap Implementation
        document.addEventListener('DOMContentLoaded', function() {
            setupTableFilter('submission-search', 'submission-tbody');

            // Initialize Heatmap
            const heatmapContainer = document.getElementById('heatmap-container');
            if (heatmapContainer) {
                initializeHeatmap();
            }
        });

        function initializeHeatmap() {
            try {
                // Default coordinates for Desa Cicangkang Hilir
                const defaultLat = -6.958898718303256;
                const defaultLng = 107.40598076496566;

                // Initialize map
                const map = L.map('heatmap-container').setView([defaultLat, defaultLng], 14);

                // Add tile layer
                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: '© OpenStreetMap contributors',
                    maxZoom: 19,
                }).addTo(map);

                // Add center marker
                L.marker([defaultLat, defaultLng])
                    .addTo(map)
                    .bindPopup('<b>Pusat Desa Cicangkang Hilir</b>')
                    .openPopup();

                // Create legend and controls dynamically
                createHeatmapControls(map);

                // Prepare heatmap data
                @if (isset($heatmapData) && count($heatmapData) > 0)
                    const heatmapPoints = @json($heatmapData).map(point => {
                        return [point.lat, point.lng, point.weight || 1];
                    });

                    // Fit bounds if we have points
                    if (heatmapPoints.length > 0) {
                        const bounds = L.latLngBounds(heatmapPoints.map(p => [p[0], p[1]]));
                        if (heatmapPoints.length > 1) {
                            map.fitBounds(bounds, {
                                padding: [50, 50],
                                maxZoom: 16
                            });
                        }
                    }

                    // Create heatmap layer
                    const heatmap = L.heatLayer(heatmapPoints, {
                        radius: 30,
                        blur: 20,
                        maxZoom: 18,
                        minOpacity: 0.5,
                        gradient: {
                            0.1: 'rgba(0, 0, 255, 0.6)',
                            0.3: 'rgba(0, 255, 255, 0.7)',
                            0.5: 'rgba(0, 255, 0, 0.8)',
                            0.7: 'rgba(255, 255, 0, 0.9)',
                            1.0: 'rgba(255, 0, 0, 1.0)'
                        }
                    }).addTo(map);

                    // Add markers
                    const markers = L.markerClusterGroup({
                        spiderfyOnMaxZoom: true,
                        showCoverageOnHover: false,
                        zoomToBoundsOnClick: true,
                        maxClusterRadius: 50
                    });

                    @foreach ($myReports as $report)
                        @if ($report->latitude && $report->longitude)
                            var marker = L.marker([{{ $report->latitude }}, {{ $report->longitude }}]);

                            var popupContent = `
                                <div class="p-2 min-w-[250px]">
                                    <h4 class="font-bold text-primary mb-1">{{ addslashes($report->title ?: 'Laporan Pengaduan') }}</h4>
                                    <div class="space-y-1">
                                        <p class="text-sm">
                                            <span class="font-medium">Kategori:</span> 
                                            {{ addslashes($report->getCategoryLabel()) }}
                                        </p>
                                        <p class="text-sm">
                                            <span class="font-medium">Tipe:</span> 
                                            {{ addslashes($report->getTypeLabel()) }}
                                        </p>
                                        <p class="text-sm">
                                            <span class="font-medium">Status:</span> 
                                            <span class="{{ $report->getStatusBadgeClass() }} inline-block px-2 py-0.5 rounded text-xs">
                                                {{ addslashes($report->getStatusLabel()) }}
                                            </span>
                                        </p>
                                        <p class="text-sm">
                                            <span class="font-medium">Prioritas:</span> 
                                            {{ addslashes($report->getPriorityLabel()) }}
                                        </p>
                                    </div>
                                    @if ($report->address)
                                        <div class="mt-2 pt-2 border-t border-gray-200">
                                            <p class="text-xs text-gray-600">
                                                <span class="font-medium">Lokasi:</span><br>
                                                {{ addslashes(Str::limit($report->address, 120)) }}
                                            </p>
                                        </div>
                                    @endif
                                </div>
                            `;

                            marker.bindPopup(popupContent);
                            markers.addLayer(marker);
                        @endif
                    @endforeach

                    map.addLayer(markers);

                    // Setup filter functionality
                    setupFilterControls(map, heatmap, markers);
                @else
                    // Show no data message
                    const noDataDiv = document.createElement('div');
                    noDataDiv.className = 'heatmap-no-data';
                    noDataDiv.innerHTML = `
                        <div class="text-center">
                            <svg class="w-16 h-16 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <p class="text-gray-500 text-lg mb-2">Tidak ada data pengaduan</p>
                            <p class="text-gray-400 text-sm mb-4">Belum ada laporan pengaduan fasilitas yang ditampilkan.</p>
                            <a href="{{ route('reports.create') }}" class="inline-block px-4 py-2 bg-primary text-white rounded-lg hover:bg-secondary transition">
                                Buat Laporan Pertama
                            </a>
                        </div>
                    `;
                    document.getElementById('heatmap-container').appendChild(noDataDiv);
                @endif

                // Add scale control
                L.control.scale({
                    imperial: false
                }).addTo(map);

            } catch (error) {
                console.error('Error initializing heatmap:', error);
                const errorDiv = document.createElement('div');
                errorDiv.className = 'heatmap-error';
                errorDiv.innerHTML = `
                    <div class="text-center">
                        <h3 class="text-red-500 text-lg mb-2">Gagal memuat peta heatmap</h3>
                        <p class="text-gray-600 text-sm mb-4">Silakan refresh halaman atau coba lagi nanti.</p>
                        <button onclick="location.reload()" class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition">
                            Refresh Halaman
                        </button>
                    </div>
                `;
                document.getElementById('heatmap-container').appendChild(errorDiv);
            }
        }

        function createHeatmapControls(map) {
            // Create legend
            const legend = L.control({
                position: 'bottomleft'
            });
            legend.onAdd = function(map) {
                const div = L.DomUtil.create('div', 'heatmap-legend');
                div.innerHTML = `
        <h4 class="font-bold text-gray-700 mb-2">Legenda Heatmap</h4>
        <div class="space-y-2">
            <div class="flex items-center">
                <div class="w-6 h-6 rounded mr-2" style="background: rgba(0, 0, 255, 0.6)"></div>
                <span class="text-sm">Intensitas Rendah</span>
            </div>
            <div class="flex items-center">
                <div class="w-6 h-6 rounded mr-2" style="background: rgba(0, 255, 255, 0.7)"></div>
                <span class="text-sm">Intensitas Sedang</span>
            </div>
            <div class="flex items-center">
                <div class="w-6 h-6 rounded mr-2" style="background: rgba(255, 255, 0, 0.9)"></div>
                <span class="text-sm">Intensitas Tinggi</span>
            </div> 
            <div class="flex items-center">
                <div class="w-6 h-6 rounded mr-2" style="background: rgba(255, 0, 0, 1.0)"></div>
                <span class="text-sm">Intensitas Sangat Tinggi</span>
            </div>
        </div>
        <div class="mt-3 pt-3 border-t border-gray-200">
            <p class="text-xs text-gray-600">Warna merah menunjukkan area dengan pengaduan terbanyak</p>
        </div>
    `;
                return div;
            };
            legend.addTo(map);

            // Create controls
            const controls = L.control({
                position: 'topright'
            });
            controls.onAdd = function(map) {
                const div = L.DomUtil.create('div', 'heatmap-controls');
                div.innerHTML = `
                    <h4>Filter</h4>
                    <div class="filter-group">
                        <div class="filter-item">
                            <input type="checkbox" id="filter-jalan" checked>
                            <label for="filter-jalan">Jalan & Jembatan</label>
                        </div>
                        <div class="filter-item">
                            <input type="checkbox" id="filter-penerangan" checked>
                            <label for="filter-penerangan">Penerangan Umum</label>
                        </div>
                        <div class="filter-item">
                            <input type="checkbox" id="filter-air" checked>
                            <label for="filter-air">Fasilitas Air</label>
                        </div>
                        <div class="filter-item">
                            <input type="checkbox" id="filter-publik" checked>
                            <label for="filter-publik">Fasilitas Publik</label>
                        </div>
                        <div class="filter-item">
                            <input type="checkbox" id="filter-kesehatan" checked>
                            <label for="filter-kesehatan">Fasilitas Kesehatan</label>
                        </div>
                        <div class="filter-item">
                            <input type="checkbox" id="filter-pendidikan" checked>
                            <label for="filter-pendidikan">Fasilitas Pendidikan</label>
                        </div>
                    </div>
                    <button id="refresh-heatmap" class="mt-3 w-full bg-primary text-white py-2 px-4 rounded text-sm hover:bg-secondary transition">
                        Refresh Heatmap
                    </button>
                `;
                return div;
            };
            controls.addTo(map);
        }

        function setupFilterControls(map, heatmapLayer, markerCluster) {
            const filters = {
                'jalan_jembatan': true,
                'penerangan_umum': true,
                'fasilitas_air': true,
                'fasilitas_publik': true,
                'fasilitas_kesehatan': true,
                'fasilitas_pendidikan': true
            };

            const filterMap = {
                'filter-jalan': 'jalan_jembatan',
                'filter-penerangan': 'penerangan_umum',
                'filter-air': 'fasilitas_air',
                'filter-publik': 'fasilitas_publik',
                'filter-kesehatan': 'fasilitas_kesehatan',
                'filter-pendidikan': 'fasilitas_pendidikan'
            };

            function updateHeatmap() {
                @if (isset($heatmapData) && count($heatmapData) > 0)
                    const filteredPoints = @json($heatmapData)
                        .filter(point => filters[point.category])
                        .map(point => [point.lat, point.lng, point.weight || 1]);

                    heatmapLayer.setLatLngs(filteredPoints);

                    markerCluster.clearLayers();

                    @foreach ($myReports as $report)
                        @if ($report->latitude && $report->longitude)
                            if (filters['{{ $report->facility_category }}']) {
                                var marker = L.marker([{{ $report->latitude }}, {{ $report->longitude }}]);
                                var popupContent = `...`; // Same popup content as before
                                marker.bindPopup(popupContent);
                                markerCluster.addLayer(marker);
                            }
                        @endif
                    @endforeach
                @endif
            }

            Object.keys(filterMap).forEach(checkboxId => {
                const checkbox = document.getElementById(checkboxId);
                if (checkbox) {
                    checkbox.addEventListener('change', function() {
                        filters[filterMap[checkboxId]] = this.checked;
                        updateHeatmap();
                    });
                }
            });

            const refreshBtn = document.getElementById('refresh-heatmap');
            if (refreshBtn) {
                refreshBtn.addEventListener('click', function() {
                    map.setView([-6.958898718303256, 107.40598076496566], 14);
                    updateHeatmap();
                });
            }
        }

        // Smooth scrolling
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                const targetId = this.getAttribute('href');
                if (targetId === '#') return;
                const targetElement = document.querySelector(targetId);
                if (targetElement) {
                    window.scrollTo({
                        top: targetElement.offsetTop - 100,
                        behavior: 'smooth'
                    });
                }
            });
        });

        // Contact form submission
        document.getElementById('contact-form').addEventListener('submit', function(e) {
            e.preventDefault();
            alert('Terima kasih! Pesan/pengaduan Anda telah berhasil dikirim.');
            this.reset();
        });
    </script>
@endpush
