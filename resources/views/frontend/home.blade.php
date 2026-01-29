@extends('layouts.home-app')

@section('title', 'Desa Cicangkang Hilir - Sistem Informasi Desa Digital')

@push('styles')
    <style>
        /* Hero Section */
        .hero-gradient {
            background: linear-gradient(135deg, #1e40af 0%, #3b82f6 100%);
        }

        .hero-pattern {
            background-image: url({{ asset('storage/foto/foto1.jpeg') }});
        }

        /* Stats Card Animation */
        .stat-card {
            transition: all 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }

        /* Feature Card Hover */
        .feature-card {
            transition: all 0.3s ease;
        }

        .feature-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }

        /* Image Hover Effect */
        .image-hover {
            transition: transform 0.5s ease;
        }

        .image-hover:hover {
            transform: scale(1.05);
        }

        /* Gallery Image Overlay */
        .gallery-item {
            position: relative;
            overflow: hidden;
        }

        .gallery-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(to top, rgba(0, 0, 0, 0.8) 0%, transparent 100%);
            opacity: 0;
            transition: opacity 0.3s ease;
            display: flex;
            align-items: flex-end;
            padding: 1.5rem;
        }

        .gallery-item:hover .gallery-overlay {
            opacity: 1;
        }

        /* Heatmap Container */
        #heatmap-container {
            height: 500px;
            border-radius: 12px;
            overflow: hidden;
            position: relative;
            background-color: #f8fafc;
        }

        #heatmap-container .leaflet-container {
            height: 100% !important;
            width: 100% !important;
            border-radius: 12px;
        }

        /* Heatmap Legend */
        .heatmap-legend {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(4px);
            border: 1px solid rgba(0, 0, 0, 0.1);
        }

        /* News Card */
        .news-card {
            transition: all 0.3s ease;
        }

        .news-card:hover {
            transform: translateY(-5px);
        }

        /* Line Clamp Utilities */
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

        /* Animation Classes */
        .animate-fade-in {
            animation: fadeIn 0.5s ease-in-out;
        }

        .animate-slide-up {
            animation: slideUp 0.3s ease-out;
        }

        /* Loading Skeleton */
        .skeleton {
            background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
            background-size: 200% 100%;
            animation: loading 1.5s infinite;
        }

        @keyframes loading {
            0% {
                background-position: 200% 0;
            }

            100% {
                background-position: -200% 0;
            }
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            #heatmap-container {
                height: 400px;
            }

            .hero-pattern {
                background-size: 30px 30px;
            }
        }

        @media (max-width: 480px) {
            #heatmap-container {
                height: 350px;
            }
        }

        /* Tambahkan di file CSS terpisah atau di bagian <style> */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fade-in-up {
            animation: fadeInUp 0.6s ease-out;
        }

        /* Hover Effects */
        .hover-lift {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .hover-lift:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }

        /* Gradient Text */
        .text-gradient {
            background: linear-gradient(135deg, #1e40af 0%, #3b82f6 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        /* Custom Scrollbar */
        .custom-scrollbar::-webkit-scrollbar {
            width: 6px;
        }

        .custom-scrollbar::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 3px;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: #c1c1c1;
            border-radius: 3px;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb:hover {
            background: #a1a1a1;
        }
    </style>
@endpush

@section('content')
    <!-- Hero Section -->
    <section id="home" class="relative pt-20 pb-32 md:pt-32 md:pb-48 hero-gradient hero-pattern">
        <div class="absolute inset-0 bg-black/10"></div>
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="flex flex-col lg:flex-row items-center">
                <!-- Hero Content -->
                <div class="lg:w-1/2 text-white mb-12 lg:mb-0 animate-fade-in">
                    <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold mb-4 leading-tight">
                        Selamat Datang di<br>
                        <span class="text-yellow-300">Desa Cicangkang Hilir</span>
                    </h1>
                    <p class="text-xl mb-8 text-white/90 leading-relaxed">
                        Desa yang maju, mandiri, dan sejahtera berbasis teknologi informasi.
                        Kecamatan Cipongkor, Kabupaten Bandung Barat.
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4">
                        <a href="#layanan"
                            class="bg-white text-primary font-bold py-3 px-8 rounded-lg hover:bg-gray-100 text-center transition-all duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-1">
                            <i class="fas fa-hands-helping mr-2"></i>Layanan Desa
                        </a>
                        <a href="#profil"
                            class="bg-transparent border-2 border-white text-white py-3 px-8 rounded-lg hover:bg-white hover:text-primary text-center transition-all duration-300 hover:shadow-lg">
                            <i class="fas fa-info-circle mr-2"></i>Profil Desa
                        </a>
                    </div>
                </div>

                <!-- Hero Stats Card -->
                <div class="lg:w-1/2 lg:pl-12 animate-slide-up">
                    <div class="bg-white/95 backdrop-blur-sm rounded-2xl shadow-2xl p-6 transform lg:translate-y-10">
                        <div class="flex items-center justify-between mb-6">
                            <h3 class="text-xl font-bold text-dark">
                                <i class="fas fa-chart-line text-primary mr-2"></i>Data Desa
                            </h3>
                            <div class="flex space-x-1">
                                <div class="w-3 h-3 bg-red-500 rounded-full"></div>
                                <div class="w-3 h-3 bg-yellow-500 rounded-full"></div>
                                <div class="w-3 h-3 bg-green-500 rounded-full"></div>
                            </div>
                        </div>

                        <div class="bg-primary/5 p-4 rounded-xl mb-6">
                            <h4 class="font-bold text-primary mb-4 text-lg">Statistik Desa Cicangkang Hilir</h4>
                            <div class="grid grid-cols-2 gap-4">
                                <div class="bg-white p-4 rounded-xl shadow">
                                    <div class="flex items-center mb-2">
                                        <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center mr-3">
                                            <i class="fas fa-users text-primary"></i>
                                        </div>
                                        <div>
                                            <div class="text-sm text-gray-600">Penduduk</div>
                                            <div class="text-2xl font-bold text-primary">5.682</div>
                                        </div>
                                    </div>
                                </div>

                                <div class="bg-white p-4 rounded-xl shadow">
                                    <div class="flex items-center mb-2">
                                        <div
                                            class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center mr-3">
                                            <i class="fas fa-home text-accent"></i>
                                        </div>
                                        <div>
                                            <div class="text-sm text-gray-600">Kartu Keluarga</div>
                                            <div class="text-2xl font-bold text-accent">1.777</div>
                                        </div>
                                    </div>
                                </div>

                                <div class="bg-white p-4 rounded-xl shadow">
                                    <div class="flex items-center mb-2">
                                        <div
                                            class="w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center mr-3">
                                            <i class="fas fa-map text-purple-600"></i>
                                        </div>
                                        <div>
                                            <div class="text-sm text-gray-600">Luas Wilayah</div>
                                            <div class="text-2xl font-bold text-purple-600">369 Km²</div>
                                        </div>
                                    </div>
                                </div>

                                <div class="bg-white p-4 rounded-xl shadow">
                                    <div class="flex items-center mb-2">
                                        <div
                                            class="w-10 h-10 bg-yellow-100 rounded-lg flex items-center justify-center mr-3">
                                            <i class="fas fa-th-large text-yellow-600"></i>
                                        </div>
                                        <div>
                                            <div class="text-sm text-gray-600">RT / RW</div>
                                            <div class="text-2xl font-bold text-yellow-600">35 / 13</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="text-center">
                            <p class="text-gray-600 text-sm">
                                <i class="fas fa-sync-alt mr-1"></i>Data terupdate {{ now()->format('d F Y') }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Scroll Indicator -->
        <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2">
            <a href="#profil" class="animate-bounce">
                <i class="fas fa-chevron-down text-white text-2xl"></i>
            </a>
        </div>
    </section>

    <!-- Profil Desa Section -->
    <section id="profil" class="py-20 bg-white">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16 animate-fade-in">
                <h2 class="text-3xl md:text-4xl font-bold text-primary mb-4">Profil Desa Cicangkang Hilir</h2>
                <p class="text-gray-600 max-w-2xl mx-auto text-lg">
                    Mengenal lebih dekat Desa Cicangkang Hilir, kecamatan Cipongkor, Kabupaten Bandung Barat
                </p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <!-- Image -->
                <div class="animate-slide-up">
                    <div class="relative rounded-2xl overflow-hidden shadow-xl image-hover">
                        <img src="{{ asset('storage/foto/foto1.jpeg') }}" alt="Wilayah Desa Cicangkang Hilir"
                            class="w-full h-[400px] object-cover">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent"></div>
                        <div class="absolute bottom-0 left-0 right-0 p-6 text-white">
                            <h3 class="text-xl font-bold mb-2">Pemandangan Desa</h3>
                            <p class="text-white/90">Kawasan pertanian dan permukiman Desa Cicangkang Hilir</p>
                        </div>
                    </div>
                </div>

                <!-- Content -->
                <div class="animate-slide-up" style="animation-delay: 0.1s">
                    <h3 class="text-2xl lg:text-3xl font-bold text-primary mb-6">Desa Cicangkang Hilir</h3>
                    <p class="text-gray-600 mb-8 text-lg leading-relaxed">
                        Desa Cicangkang Hilir merupakan salah satu desa di Kecamatan Cipongkor, Kabupaten Bandung Barat,
                        Provinsi Jawa Barat.
                        Desa ini memiliki potensi alam yang indah dengan masyarakat yang ramah dan gotong royong.
                        Berbagai program pembangunan terus dijalankan untuk meningkatkan kesejahteraan masyarakat.
                    </p>

                    <div class="space-y-6 mb-8">
                        <!-- Feature 1 -->
                        <div class="flex items-start bg-primary-light p-4 rounded-xl">
                            <div class="bg-primary text-white p-3 rounded-lg mr-4">
                                <i class="fas fa-map-marker-alt text-lg"></i>
                            </div>
                            <div>
                                <h4 class="font-bold text-lg text-dark mb-1">Lokasi Geografis</h4>
                                <p class="text-gray-600">Kecamatan Cipongkor, Kabupaten Bandung Barat, Jawa Barat</p>
                            </div>
                        </div>

                        <!-- Feature 2 -->
                        <div class="flex items-start bg-green-50 p-4 rounded-xl">
                            <div class="bg-accent text-white p-3 rounded-lg mr-4">
                                <i class="fas fa-industry text-lg"></i>
                            </div>
                            <div>
                                <h4 class="font-bold text-lg text-dark mb-1">Potensi Unggulan</h4>
                                <p class="text-gray-600">Pertanian, Perkebunan, Peternakan, dan UMKM Lokal</p>
                            </div>
                        </div>

                        <!-- Feature 3 -->
                        <div class="flex items-start bg-purple-50 p-4 rounded-xl">
                            <div class="bg-purple-600 text-white p-3 rounded-lg mr-4">
                                <i class="fas fa-users text-lg"></i>
                            </div>
                            <div>
                                <h4 class="font-bold text-lg text-dark mb-1">Jumlah Penduduk</h4>
                                <p class="text-gray-600">± 5.682 jiwa dengan 1.777 Kartu Keluarga</p>
                            </div>
                        </div>
                    </div>

                    <a href="{{ route('profil.visi-misi') }}"
                        class="inline-flex items-center text-primary hover:text-secondary font-bold text-lg transition">
                        Pelajari lebih lanjut tentang desa kami
                        <i class="fas fa-arrow-right ml-2"></i>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Layanan Section -->
    <section id="layanan" class="py-20 bg-gray-50">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16 animate-fade-in">
                <h2 class="text-3xl md:text-4xl font-bold text-primary mb-4">Layanan Desa</h2>
                <p class="text-gray-600 max-w-2xl mx-auto text-lg">
                    Berbagai layanan administrasi dan publik yang tersedia untuk masyarakat Desa Cicangkang Hilir
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-12">
                <!-- Layanan Cards -->
                @php
                    $layananItems = [
                        [
                            'icon' => 'fa-hands-helping',
                            'color' => 'blue',
                            'title' => 'Pengaduan Fasilitas Umum',
                            'description' =>
                                'Laporkan kerusakan atau keluhan terkait fasilitas umum desa untuk ditindaklanjuti oleh pemerintah desa.',
                            'link' => route('reports.create'),
                            'link_text' => 'Laporkan sekarang',
                        ],
                        [
                            'icon' => 'fa-file-alt',
                            'color' => 'green',
                            'title' => 'Surat Menyurat Online',
                            'description' =>
                                'Pembuatan surat keterangan, pengantar, rekomendasi, dan surat resmi desa lainnya secara online.',
                            'link' => route('layanan.surat-online'),
                            'link_text' => 'Ajukan online',
                        ],
                    ];
                @endphp

                @foreach ($layananItems as $index => $item)
                    <div class="feature-card bg-white p-8 rounded-2xl shadow-lg border border-gray-100 animate-slide-up"
                        style="animation-delay: {{ $index * 0.1 }}s">
                        <div
                            class="bg-{{ $item['color'] }}-100 text-{{ $item['color'] }}-600 w-16 h-16 rounded-xl flex items-center justify-center mb-6">
                            <i class="fas {{ $item['icon'] }} text-2xl"></i>
                        </div>
                        <h3 class="text-xl font-bold text-dark mb-3">{{ $item['title'] }}</h3>
                        <p class="text-gray-600 mb-4">{{ $item['description'] }}</p>
                        @if ($item['link'])
                            <a href="{{ $item['link'] }}"
                                class="inline-flex items-center text-primary hover:text-secondary font-bold transition">
                                {{ $item['link_text'] }}
                                <i class="fas fa-arrow-right ml-2"></i>
                            </a>
                        @endif
                    </div>
                @endforeach
            </div>

            <!-- Statistik Pengajuan -->
            <div class="bg-white rounded-2xl shadow-lg border border-gray-100 mb-8 overflow-hidden animate-slide-up">
                <div class="p-6 md:p-8 border-b border-gray-100">
                    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                        <div class="flex items-center">
                            <div
                                class="bg-indigo-100 text-indigo-600 w-12 h-12 rounded-xl flex items-center justify-center mr-4">
                                <i class="fas fa-file-alt text-xl"></i>
                            </div>
                            <div>
                                <h3 class="text-lg font-bold text-primary">Daftar Pengajuan Surat</h3>
                                <p class="text-gray-600">Ringkasan pengajuan surat Anda</p>
                            </div>
                        </div>

                        <div class="relative w-full md:w-auto">
                            <div class="relative">
                                <i
                                    class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                                <input id="submission-search" type="search"
                                    placeholder="Cari nama, jenis surat, atau status..."
                                    class="w-full pl-10 pr-4 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="p-6 md:p-8">
                    @if (!empty($mySubmissions) && count($mySubmissions) > 0)
                        <div class="overflow-x-auto rounded-lg border border-gray-200">
                            <table class="w-full">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Nama</th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Jenis Surat</th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-40">
                                            Status</th>
                                    </tr>
                                </thead>
                                <tbody id="submission-tbody" class="bg-white divide-y divide-gray-200">
                                    @foreach ($mySubmissions as $s)
                                        <tr class="hover:bg-gray-50 transition">
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                {{ $s->nama ?? '-' }}
                                            </td>
                                            <td class="px-6 py-4 text-sm text-gray-500">
                                                {{ $s->jenis_surat ?? ($s->nama_surat ?? '-') }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span
                                                    class="{{ $s->badgeClass() }} px-3 py-1 rounded-full text-xs font-medium">
                                                    {{ $s->statusLabel() }}
                                                </span>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-12">
                            <div class="mx-auto w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mb-4">
                                <i class="fas fa-file-alt text-blue-600 text-2xl"></i>
                            </div>
                            <h4 class="text-lg font-medium text-gray-900 mb-2">Belum ada pengajuan</h4>
                            <p class="text-gray-600 max-w-md mx-auto mb-6">
                                Anda belum memiliki pengajuan surat. Mulai ajukan surat Anda sekarang.
                            </p>
                            <a href="{{ route('layanan.surat-online') }}"
                                class="inline-flex items-center bg-primary text-white px-6 py-2 rounded-lg hover:bg-secondary transition">
                                <i class="fas fa-plus mr-2"></i>Ajukan Surat
                            </a>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Heatmap Pengaduan -->
            <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden animate-slide-up">
                <div class="p-6 md:p-8 border-b border-gray-100">
                    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                        <div class="flex items-center">
                            <div
                                class="bg-red-100 text-red-600 w-12 h-12 rounded-xl flex items-center justify-center mr-4">
                                <i class="fas fa-map-marked-alt text-xl"></i>
                            </div>
                            <div>
                                <h3 class="text-lg font-bold text-primary">Peta Heatmap Pengaduan</h3>
                                <p class="text-gray-600">Visualisasi lokasi dan intensitas pengaduan fasilitas umum</p>
                            </div>
                        </div>

                        <div class="flex items-center space-x-2">
                            <span class="text-sm text-gray-600">Total Pengaduan:</span>
                            <span class="font-bold text-primary">{{ $myReports->count() }}</span>
                        </div>
                    </div>
                </div>

                <div class="p-2">
                    <!-- Heatmap Container -->
                    <div id="heatmap-container" class="relative">
                        <!-- Heatmap akan dirender di sini -->
                    </div>
                </div>

                <!-- Statistik Pengaduan -->
                <div class="p-6 md:p-8 bg-gray-50 border-t border-gray-200">
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                        <div class="bg-white p-4 rounded-xl shadow text-center">
                            <div class="text-2xl font-bold text-primary mb-1">
                                {{ $myReports->where('status', 'submitted')->count() }}
                            </div>
                            <div class="text-sm text-gray-600">Pengaduan Baru</div>
                        </div>

                        <div class="bg-white p-4 rounded-xl shadow text-center">
                            <div class="text-2xl font-bold text-yellow-600 mb-1">
                                {{ $myReports->where('status', 'in_progress')->count() }}
                            </div>
                            <div class="text-sm text-gray-600">Sedang Diproses</div>
                        </div>

                        <div class="bg-white p-4 rounded-xl shadow text-center">
                            <div class="text-2xl font-bold text-green-600 mb-1">
                                {{ $myReports->where('status', 'completed')->count() }}
                            </div>
                            <div class="text-sm text-gray-600">Selesai</div>
                        </div>

                        <div class="bg-white p-4 rounded-xl shadow text-center">
                            <div class="text-2xl font-bold text-red-600 mb-1">
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
    </section>

    <!-- Berita Desa Section -->
    <section id="berita" class="py-20 bg-white">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16 animate-fade-in">
                <h2 class="text-3xl md:text-4xl font-bold text-primary mb-4">Berita & Informasi Terkini</h2>
                <p class="text-gray-600 max-w-2xl mx-auto text-lg">
                    Update informasi terbaru dari Pemerintah Desa Cicangkang Hilir
                </p>
            </div>

            @if ($berita->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach ($berita as $index => $item)
                        <div class="news-card bg-white rounded-2xl shadow-lg overflow-hidden border border-gray-100 animate-slide-up"
                            style="animation-delay: {{ $index * 0.1 }}s">
                            <!-- Thumbnail -->
                            <div class="h-48 overflow-hidden">
                                <img src="{{ $item->thumbnail ? asset('storage/' . $item->thumbnail) : 'https://via.placeholder.com/400x300/cccccc/ffffff?text=No+Image' }}"
                                    alt="{{ $item->title }}"
                                    class="w-full h-full object-cover transition-transform duration-500 hover:scale-110">
                            </div>

                            <!-- Content -->
                            <div class="p-6">
                                <div class="flex items-center text-sm text-gray-500 mb-3">
                                    <i class="far fa-calendar-alt mr-2"></i>
                                    <span>{{ $item->published_date }}</span>
                                    @if ($item->author)
                                        <span class="mx-2">•</span>
                                        <i class="far fa-user mr-1"></i>
                                        <span>{{ $item->author->name }}</span>
                                    @endif
                                </div>

                                <h3 class="text-xl font-bold text-dark mb-3 line-clamp-2">
                                    {{ $item->title }}
                                </h3>

                                <p class="text-gray-600 mb-4 line-clamp-3">
                                    {{ $item->short_excerpt }}
                                </p>

                                <div class="flex items-center justify-between">
                                    <a href="{{ route('news.show', $item->slug) }}"
                                        class="text-primary hover:text-secondary font-bold inline-flex items-center transition">
                                        Baca selengkapnya
                                        <i class="fas fa-arrow-right ml-2"></i>
                                    </a>

                                    <span class="text-xs px-3 py-1 bg-blue-100 text-blue-600 rounded-full">
                                        {{ $item->category ?? 'Berita' }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <!-- Fallback jika tidak ada berita -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    @for ($i = 0; $i < 3; $i++)
                        <div class="bg-white rounded-2xl shadow-lg overflow-hidden border border-gray-100 animate-pulse">
                            <div class="h-48 bg-gray-200"></div>
                            <div class="p-6">
                                <div class="h-4 bg-gray-200 rounded mb-3"></div>
                                <div class="h-6 bg-gray-200 rounded mb-3"></div>
                                <div class="h-16 bg-gray-200 rounded mb-4"></div>
                                <div class="h-10 bg-gray-200 rounded"></div>
                            </div>
                        </div>
                    @endfor
                </div>
            @endif

            <div class="text-center mt-12">
                @if ($berita->count() > 0)
                    <a href="{{ route('news.index') }}"
                        class="inline-flex items-center bg-primary text-white font-bold py-3 px-8 rounded-lg hover:bg-secondary transition duration-300 shadow-md hover:shadow-lg transform hover:-translate-y-1">
                        Lihat Semua Berita
                        <i class="fas fa-newspaper ml-2"></i>
                    </a>
                @else
                    <div class="text-center py-12">
                        <div class="mx-auto w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mb-4">
                            <i class="fas fa-newspaper text-gray-400 text-2xl"></i>
                        </div>
                        <h4 class="text-lg font-medium text-gray-900 mb-2">Belum ada berita</h4>
                        <p class="text-gray-600">Berita dan informasi akan segera tersedia.</p>
                    </div>
                @endif
            </div>
        </div>
    </section>

    <!-- Galeri Section -->
    <section id="galeri" class="py-20 bg-gray-50">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16 animate-fade-in">
                <h2 class="text-3xl md:text-4xl font-bold text-primary mb-4">Galeri Desa</h2>
                <p class="text-gray-600 max-w-2xl mx-auto text-lg">
                    Dokumentasi kegiatan dan potensi Desa Cicangkang Hilir
                </p>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 mb-8">
                @php
                    $galeriData = is_array($galeri) ? $galeri : $galeri->toArray();
                    $galeriCount = is_array($galeri) ? count($galeri) : $galeri->count();
                @endphp

                @if ($galeriCount > 0)
                    @foreach ($galeri as $index => $item)
                        @php
                            if (is_string($item)) {
                                $imagePath = $item;
                                $title = 'Galeri Desa';
                                $category = '';
                                $id = null;
                            } else {
                                $imagePath = $item->image_path;
                                $title = $item->title ?? 'Galeri Desa';
                                $category = $item->category ?? '';
                                $id = $item->id;
                            }
                        @endphp

                        <div class="gallery-item rounded-xl overflow-hidden shadow-lg animate-slide-up"
                            style="animation-delay: {{ $index * 0.05 }}s">
                            @if ($id)
                                <a href="{{ route('gallery.show', $id) }}" class="block">
                                    <div class="relative h-48">
                                        <img src="{{ asset('storage/' . $imagePath) }}" alt="{{ $title }}"
                                            class="w-full h-full object-cover">
                                        <div class="gallery-overlay">
                                            <div class="text-white">
                                                <h4 class="font-bold text-lg mb-1">{{ $title }}</h4>
                                                @if ($category)
                                                    <p class="text-sm text-white/90">{{ ucfirst($category) }}</p>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            @else
                                <div class="relative h-48">
                                    <img src="{{ $imagePath }}" alt="{{ $title }}"
                                        class="w-full h-full object-cover">
                                    <div class="gallery-overlay">
                                        <div class="text-white">
                                            <h4 class="font-bold text-lg">{{ $title }}</h4>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    @endforeach
                @else
                    <!-- Placeholder jika tidak ada gambar -->
                    @for ($i = 0; $i < 4; $i++)
                        <div
                            class="h-48 rounded-xl overflow-hidden bg-gradient-to-br from-blue-100 to-blue-50 flex items-center justify-center animate-pulse">
                            <i class="fas fa-image text-4xl text-blue-300"></i>
                        </div>
                    @endfor
                @endif
            </div>

            @if ($galeriCount > 0)
                <div class="text-center">
                    <a href="{{ route('gallery.index') }}"
                        class="inline-flex items-center text-primary hover:text-secondary font-bold text-lg transition">
                        Lihat galeri lengkap
                        <i class="fas fa-arrow-right ml-2"></i>
                    </a>
                </div>
            @endif
        </div>
    </section>

    <!-- Statistik Section -->
    <section class="py-20 bg-primary text-white relative overflow-hidden">
        <div class="absolute inset-0 bg-black/10"></div>
        <div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-transparent via-white/20 to-transparent"></div>

        <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center mb-16 animate-fade-in">
                <h2 class="text-3xl md:text-4xl font-bold mb-4">Desa Cicangkang Hilir dalam Angka</h2>
                <p class="text-blue-100 max-w-2xl mx-auto text-lg">
                    Data statistik terkini yang menggambarkan perkembangan desa
                </p>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-5 gap-8">
                @php
                    $stats = [
                        [
                            'value' => '5.682',
                            'label' => 'Jiwa Penduduk',
                            'icon' => 'fa-users',
                            'color' => 'text-blue-200',
                        ],
                        [
                            'value' => '1.777',
                            'label' => 'Kartu Keluarga',
                            'icon' => 'fa-home',
                            'color' => 'text-blue-200',
                        ],
                        [
                            'value' => number_format($rtCount),
                            'label' => 'RT',
                            'icon' => 'fa-th-large',
                            'color' => 'text-blue-200',
                        ],
                        [
                            'value' => number_format($rwCount),
                            'label' => 'RW',
                            'icon' => 'fa-layer-group',
                            'color' => 'text-blue-200',
                        ],
                        [
                            'value' => '369,000',
                            'label' => 'Km² Luas Wilayah',
                            'icon' => 'fa-map',
                            'color' => 'text-blue-200',
                        ],
                    ];
                @endphp

                @foreach ($stats as $index => $stat)
                    <div class="text-center animate-slide-up" style="animation-delay: {{ $index * 0.1 }}s">
                        <div class="mb-4">
                            <div class="w-16 h-16 bg-white/10 rounded-full flex items-center justify-center mx-auto mb-4">
                                <i class="fas {{ $stat['icon'] }} text-2xl text-white"></i>
                            </div>
                            <div class="text-4xl md:text-5xl font-bold mb-2">{{ $stat['value'] }}</div>
                            <div class="{{ $stat['color'] }} text-lg">{{ $stat['label'] }}</div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="absolute bottom-0 left-0 right-0 h-1 bg-gradient-to-r from-transparent via-white/20 to-transparent">
        </div>
    </section>

    <!-- Kontak Section -->
    <section id="kontak" class="py-20 bg-white">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16 animate-fade-in">
                <h2 class="text-3xl md:text-4xl font-bold text-primary mb-4">Kontak & Lokasi</h2>
                <p class="text-gray-600 max-w-2xl mx-auto text-lg">
                    Hubungi kami untuk informasi lebih lanjut
                </p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                <!-- Contact Info -->
                <div class="animate-slide-up">
                    <h3 class="text-2xl lg:text-3xl font-bold text-dark mb-6">Kantor Desa Cicangkang Hilir</h3>

                    <div class="space-y-6 mb-8">
                        <!-- Address -->
                        <div class="flex items-start bg-primary-light p-4 rounded-xl">
                            <div class="bg-primary text-white p-3 rounded-lg mr-4">
                                <i class="fas fa-map-marker-alt text-lg"></i>
                            </div>
                            <div>
                                <h4 class="font-bold text-lg text-dark mb-1">Alamat Kantor</h4>
                                <p class="text-gray-600">Jl. Cijambe No.5a, Cicangkang Hilir, Kec. Cipongkor, Kabupaten
                                    Bandung Barat, Jawa Barat 40564</p>
                            </div>
                        </div>

                        <!-- Phone -->
                        <div class="flex items-start bg-green-50 p-4 rounded-xl">
                            <div class="bg-accent text-white p-3 rounded-lg mr-4">
                                <i class="fas fa-phone-alt text-lg"></i>
                            </div>
                            <div>
                                <h4 class="font-bold text-lg text-dark mb-1">Telepon & WhatsApp</h4>
                                <p class="text-gray-600">(022) 1234-5678</p>
                                <p class="text-gray-600">0812-3456-7890 (WhatsApp)</p>
                            </div>
                        </div>

                        <!-- Email -->
                        <div class="flex items-start bg-purple-50 p-4 rounded-xl">
                            <div class="bg-purple-600 text-white p-3 rounded-lg mr-4">
                                <i class="fas fa-envelope text-lg"></i>
                            </div>
                            <div>
                                <h4 class="font-bold text-lg text-dark mb-1">Email</h4>
                                <p class="text-gray-600">desa.cicangkanghilir@bandungbaratkab.go.id</p>
                                <p class="text-gray-600">info.cicangkanghilir@gmail.com</p>
                            </div>
                        </div>

                        <!-- Hours -->
                        <div class="flex items-start bg-yellow-50 p-4 rounded-xl">
                            <div class="bg-yellow-600 text-white p-3 rounded-lg mr-4">
                                <i class="fas fa-clock text-lg"></i>
                            </div>
                            <div>
                                <h4 class="font-bold text-lg text-dark mb-1">Jam Operasional</h4>
                                <p class="text-gray-600">Senin - Kamis: 08.00 - 15.00 WIB</p>
                                <p class="text-gray-600">Jumat: 08.00 - 11.00 WIB</p>
                                <p class="text-gray-600">Sabtu: 08.00 - 13.00 WIB</p>
                            </div>
                        </div>
                    </div>

                    <!-- Social Media -->
                    <div>
                        <h4 class="font-bold text-lg text-dark mb-4">Ikuti Kami</h4>
                        <div class="flex space-x-4">
                            <a href="#"
                                class="w-10 h-10 bg-blue-600 text-white rounded-full flex items-center justify-center hover:bg-blue-700 transition">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a href="#"
                                class="w-10 h-10 bg-blue-400 text-white rounded-full flex items-center justify-center hover:bg-blue-500 transition">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a href="#"
                                class="w-10 h-10 bg-pink-600 text-white rounded-full flex items-center justify-center hover:bg-pink-700 transition">
                                <i class="fab fa-instagram"></i>
                            </a>
                            <a href="#"
                                class="w-10 h-10 bg-red-600 text-white rounded-full flex items-center justify-center hover:bg-red-700 transition">
                                <i class="fab fa-youtube"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Contact Form -->
                <div class="animate-slide-up" style="animation-delay: 0.1s">
                    <h3 class="text-2xl lg:text-3xl font-bold text-dark mb-6">Kirim Pesan / Pengaduan</h3>

                    <form id="contact-form" class="space-y-6">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-gray-700 mb-2 font-medium">
                                    <i class="fas fa-user text-primary mr-2"></i>Nama Lengkap *
                                </label>
                                <input type="text" name="nama" required
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition"
                                    placeholder="Nama Anda">
                            </div>
                            <div>
                                <label class="block text-gray-700 mb-2 font-medium">
                                    <i class="fas fa-phone text-primary mr-2"></i>No. HP/WhatsApp *
                                </label>
                                <input type="tel" name="telepon" required
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition"
                                    placeholder="08xx-xxxx-xxxx">
                            </div>
                        </div>

                        <div>
                            <label class="block text-gray-700 mb-2 font-medium">
                                <i class="fas fa-envelope text-primary mr-2"></i>Email
                            </label>
                            <input type="email" name="email"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition"
                                placeholder="email@contoh.com">
                        </div>

                        <div>
                            <label class="block text-gray-700 mb-2 font-medium">
                                <i class="fas fa-tag text-primary mr-2"></i>Subjek *
                            </label>
                            <select name="subjek" required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition">
                                <option value="">Pilih Subjek</option>
                                <option value="informasi">Permintaan Informasi</option>
                                <option value="pengaduan">Pengaduan Masyarakat</option>
                                <option value="layanan">Layanan Administrasi</option>
                                <option value="saran">Saran & Kritik</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-gray-700 mb-2 font-medium">
                                <i class="fas fa-comment-alt text-primary mr-2"></i>Pesan *
                            </label>
                            <textarea name="pesan" rows="4" required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition"
                                placeholder="Tulis pesan/pengaduan Anda di sini..."></textarea>
                        </div>

                        <button type="submit"
                            class="w-full bg-primary text-white font-bold py-3 px-8 rounded-lg hover:bg-secondary transition duration-300 shadow-md hover:shadow-lg transform hover:-translate-y-1">
                            <i class="fas fa-paper-plane mr-2"></i>Kirim Pesan
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Table filtering
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

            setupTableFilter('submission-search', 'submission-tbody');

            // Initialize Heatmap
            const heatmapContainer = document.getElementById('heatmap-container');
            if (heatmapContainer) {
                initializeHeatmap();
            }

            // Contact Form Submission
            document.getElementById('contact-form')?.addEventListener('submit', function(e) {
                e.preventDefault();

                // Show success message
                const button = this.querySelector('button[type="submit"]');
                const originalText = button.innerHTML;

                button.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Mengirim...';
                button.disabled = true;

                // Simulate API call
                setTimeout(() => {
                    alert('Terima kasih! Pesan/pengaduan Anda telah berhasil dikirim.');
                    this.reset();
                    button.innerHTML = originalText;
                    button.disabled = false;
                }, 1500);
            });

            // Animate elements on scroll
            const observerOptions = {
                root: null,
                rootMargin: '0px',
                threshold: 0.1
            };

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('animate-fade-in');
                    }
                });
            }, observerOptions);

            // Observe all sections
            document.querySelectorAll('section').forEach(section => {
                observer.observe(section);
            });
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
                    .bindPopup(`
                    <div class="p-2">
                        <h4 class="font-bold text-primary mb-1">Pusat Desa Cicangkang Hilir</h4>
                        <p class="text-sm text-gray-600">Kantor Desa Cicangkang Hilir</p>
                    </div>
                `)
                    .openPopup();

                // Create legend and controls
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

                    // Add markers with clusters
                    const markers = L.markerClusterGroup({
                        spiderfyOnMaxZoom: true,
                        showCoverageOnHover: false,
                        zoomToBoundsOnClick: true,
                        maxClusterRadius: 50,
                        iconCreateFunction: function(cluster) {
                            const count = cluster.getChildCount();
                            let size = 'large';
                            if (count < 10) size = 'small';
                            else if (count < 100) size = 'medium';

                            return L.divIcon({
                                html: `<div class="cluster cluster-${size}">${count}</div>`,
                                className: 'custom-cluster',
                                iconSize: L.point(40, 40)
                            });
                        }
                    });

                    @foreach ($myReports as $report)
                        @if ($report->latitude && $report->longitude)
                            const marker{{ $loop->index }} = L.marker([{{ $report->latitude }},
                                {{ $report->longitude }}]);

                            const popupContent{{ $loop->index }} = `
                            <div class="p-3 min-w-[250px]">
                                <h4 class="font-bold text-primary mb-2">{{ addslashes($report->title ?: 'Laporan Pengaduan') }}</h4>
                                <div class="space-y-2">
                                    <div class="flex items-center">
                                        <i class="fas fa-tag text-gray-400 mr-2"></i>
                                        <span class="text-sm">{{ addslashes($report->getCategoryLabel()) }}</span>
                                    </div>
                                    <div class="flex items-center">
                                        <i class="fas fa-flag text-gray-400 mr-2"></i>
                                        <span class="text-sm">{{ addslashes($report->getTypeLabel()) }}</span>
                                    </div>
                                    <div class="flex items-center">
                                        <i class="fas fa-info-circle text-gray-400 mr-2"></i>
                                        <span class="{{ $report->getStatusBadgeClass() }} px-2 py-1 rounded text-xs">
                                            {{ addslashes($report->getStatusLabel()) }}
                                        </span>
                                    </div>
                                    <div class="flex items-center">
                                        <i class="fas fa-exclamation-circle text-gray-400 mr-2"></i>
                                        <span class="text-sm">{{ addslashes($report->getPriorityLabel()) }}</span>
                                    </div>
                                </div>
                                @if ($report->address)
                                    <div class="mt-3 pt-3 border-t border-gray-200">
                                        <div class="flex items-start">
                                            <i class="fas fa-map-marker-alt text-gray-400 mr-2 mt-1"></i>
                                            <span class="text-xs text-gray-600">{{ addslashes(Str::limit($report->address, 120)) }}</span>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        `;

                            marker{{ $loop->index }}.bindPopup(popupContent{{ $loop->index }});
                            markers.addLayer(marker{{ $loop->index }});
                        @endif
                    @endforeach

                    map.addLayer(markers);

                    // Setup filter functionality
                    setupFilterControls(map, heatmap, markers);
                @else
                    // Show no data message
                    const noDataDiv = document.createElement('div');
                    noDataDiv.className = 'absolute inset-0 flex items-center justify-center bg-gray-50';
                    noDataDiv.innerHTML = `
                    <div class="text-center p-8">
                        <div class="w-20 h-20 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-map-marked-alt text-blue-600 text-3xl"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-700 mb-2">Tidak ada data pengaduan</h3>
                        <p class="text-gray-500 mb-6 max-w-md">
                            Belum ada laporan pengaduan fasilitas yang ditampilkan pada peta heatmap.
                        </p>
                        <a href="{{ route('reports.create') }}" 
                           class="inline-flex items-center bg-primary text-white px-6 py-3 rounded-lg hover:bg-secondary transition">
                            <i class="fas fa-plus mr-2"></i>Buat Laporan Pertama
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
                errorDiv.className = 'absolute inset-0 flex items-center justify-center bg-red-50';
                errorDiv.innerHTML = `
                <div class="text-center p-8">
                    <div class="w-20 h-20 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-exclamation-triangle text-red-600 text-3xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-red-700 mb-2">Gagal memuat peta</h3>
                    <p class="text-gray-600 mb-6">Silakan refresh halaman atau coba lagi nanti.</p>
                    <button onclick="location.reload()" 
                            class="inline-flex items-center bg-red-600 text-white px-6 py-3 rounded-lg hover:bg-red-700 transition">
                        <i class="fas fa-redo mr-2"></i>Refresh Halaman
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
                const div = L.DomUtil.create('div', 'heatmap-legend p-4 rounded-lg');
                div.innerHTML = `
                <h4 class="font-bold text-gray-700 mb-3 flex items-center">
                    <i class="fas fa-layer-group mr-2 text-primary"></i>Legenda Heatmap
                </h4>
                <div class="space-y-2">
                    <div class="flex items-center">
                        <div class="w-6 h-6 rounded mr-3" style="background: rgba(0, 0, 255, 0.6)"></div>
                        <span class="text-sm text-gray-700">Intensitas Rendah</span>
                    </div>
                    <div class="flex items-center">
                        <div class="w-6 h-6 rounded mr-3" style="background: rgba(0, 255, 255, 0.7)"></div>
                        <span class="text-sm text-gray-700">Intensitas Sedang</span>
                    </div>
                    <div class="flex items-center">
                        <div class="w-6 h-6 rounded mr-3" style="background: rgba(255, 255, 0, 0.9)"></div>
                        <span class="text-sm text-gray-700">Intensitas Tinggi</span>
                    </div> 
                    <div class="flex items-center">
                        <div class="w-6 h-6 rounded mr-3" style="background: rgba(255, 0, 0, 1.0)"></div>
                        <span class="text-sm text-gray-700">Intensitas Sangat Tinggi</span>
                    </div>
                </div>
                <div class="mt-4 pt-4 border-t border-gray-200">
                    <p class="text-xs text-gray-600">
                        <i class="fas fa-info-circle mr-1 text-primary"></i>
                        Warna merah menunjukkan area dengan pengaduan terbanyak
                    </p>
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
                const div = L.DomUtil.create('div', 'bg-white/95 backdrop-blur-sm p-4 rounded-lg shadow-lg');
                div.innerHTML = `
                <h4 class="font-bold text-gray-700 mb-3 flex items-center">
                    <i class="fas fa-filter mr-2 text-primary"></i>Filter Kategori
                </h4>
                <div class="space-y-2 max-h-64 overflow-y-auto pr-2">
                    <div class="flex items-center">
                        <input type="checkbox" id="filter-jalan" checked class="mr-3 h-4 w-4 text-primary rounded focus:ring-primary">
                        <label for="filter-jalan" class="text-sm text-gray-700 cursor-pointer">Jalan & Jembatan</label>
                    </div>
                    <div class="flex items-center">
                        <input type="checkbox" id="filter-penerangan" checked class="mr-3 h-4 w-4 text-primary rounded focus:ring-primary">
                        <label for="filter-penerangan" class="text-sm text-gray-700 cursor-pointer">Penerangan Umum</label>
                    </div>
                    <div class="flex items-center">
                        <input type="checkbox" id="filter-air" checked class="mr-3 h-4 w-4 text-primary rounded focus:ring-primary">
                        <label for="filter-air" class="text-sm text-gray-700 cursor-pointer">Fasilitas Air</label>
                    </div>
                    <div class="flex items-center">
                        <input type="checkbox" id="filter-publik" checked class="mr-3 h-4 w-4 text-primary rounded focus:ring-primary">
                        <label for="filter-publik" class="text-sm text-gray-700 cursor-pointer">Fasilitas Publik</label>
                    </div>
                    <div class="flex items-center">
                        <input type="checkbox" id="filter-kesehatan" checked class="mr-3 h-4 w-4 text-primary rounded focus:ring-primary">
                        <label for="filter-kesehatan" class="text-sm text-gray-700 cursor-pointer">Fasilitas Kesehatan</label>
                    </div>
                    <div class="flex items-center">
                        <input type="checkbox" id="filter-pendidikan" checked class="mr-3 h-4 w-4 text-primary rounded focus:ring-primary">
                        <label for="filter-pendidikan" class="text-sm text-gray-700 cursor-pointer">Fasilitas Pendidikan</label>
                    </div>
                </div>
                <button id="refresh-heatmap" 
                        class="mt-4 w-full bg-primary text-white py-2 px-4 rounded-lg text-sm hover:bg-secondary transition flex items-center justify-center">
                    <i class="fas fa-redo mr-2"></i>Refresh Heatmap
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
                                const marker = L.marker([{{ $report->latitude }}, {{ $report->longitude }}]);
                                const popupContent = `
                                <div class="p-3 min-w-[250px]">
                                    <h4 class="font-bold text-primary mb-2">{{ addslashes($report->title ?: 'Laporan Pengaduan') }}</h4>
                                    <div class="space-y-2">
                                        <div class="flex items-center">
                                            <i class="fas fa-tag text-gray-400 mr-2"></i>
                                            <span class="text-sm">{{ addslashes($report->getCategoryLabel()) }}</span>
                                        </div>
                                        <div class="flex items-center">
                                            <i class="fas fa-flag text-gray-400 mr-2"></i>
                                            <span class="text-sm">{{ addslashes($report->getTypeLabel()) }}</span>
                                        </div>
                                        <div class="flex items-center">
                                            <i class="fas fa-info-circle text-gray-400 mr-2"></i>
                                            <span class="{{ $report->getStatusBadgeClass() }} px-2 py-1 rounded text-xs">
                                                {{ addslashes($report->getStatusLabel()) }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            `;
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
    </script>

    <style>
        /* Heatmap Cluster Styles */
        .cluster {
            background: #3b82f6;
            border-radius: 50%;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            border: 3px solid white;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
        }

        .cluster-small {
            width: 36px;
            height: 36px;
            font-size: 12px;
        }

        .cluster-medium {
            width: 44px;
            height: 44px;
            font-size: 14px;
        }

        .cluster-large {
            width: 52px;
            height: 52px;
            font-size: 16px;
            background: #ef4444;
        }

        .custom-cluster {
            background: transparent !important;
            border: none !important;
        }

        /* Leaflet Popup Customization */
        .leaflet-popup-content-wrapper {
            border-radius: 12px;
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
            border: 1px solid #e5e7eb;
        }

        .leaflet-popup-content {
            margin: 0;
            font-family: 'Poppins', sans-serif;
        }

        .leaflet-popup-tip {
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }
    </style>
@endpush
