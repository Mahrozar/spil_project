@extends('layouts.home-app')

@section('title', 'Gambaran Umum - Desa Cicangkang Hilir')

@push('styles')
<style>
    .section-card {
        @apply relative overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-xl;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
    }
    
    .section-card::before {
        content: '';
        @apply absolute top-0 left-0 w-1 h-full bg-gradient-to-b from-primary via-secondary to-accent;
    }
    
    .info-header {
        @apply relative z-10 flex items-center px-6 py-5 bg-gradient-to-r from-primary/5 to-white border-b border-gray-100;
    }
    
    .info-header i {
        @apply text-2xl text-primary bg-white p-3 rounded-xl shadow-md;
        box-shadow: 0 4px 12px rgba(30, 64, 175, 0.15);
    }
    
    .info-header span {
        @apply ml-4 text-2xl font-bold text-dark;
        text-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
    }
    
    .card-content {
        @apply px-6 py-6 bg-gradient-to-br from-white to-gray-50/50;
    }
    
    .sub-header {
        @apply relative inline-flex items-center px-4 py-2 mb-4 mt-2 rounded-r-lg bg-gradient-to-r from-primary/10 to-transparent border-l-4 border-primary text-lg font-bold text-dark;
    }
    
    .sub-header i {
        @apply mr-3 text-primary;
    }
    
    .data-grid {
        @apply grid grid-cols-1 md:grid-cols-2 gap-3 my-4;
    }
    
    .data-card {
        @apply relative p-4 bg-white rounded-xl border border-gray-100 shadow-sm hover:shadow-md transition-all duration-300;
        background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
    }
    
    .data-card::before {
        content: '';
        @apply absolute top-0 left-0 w-1 h-full bg-gradient-to-b from-primary to-secondary;
        border-radius: 1px;
    }
    
    .stat-badge {
        @apply inline-flex items-center px-4 py-2 rounded-full text-sm font-medium;
        background: linear-gradient(135deg, #1e40af 0%, #3b82f6 100%);
        color: white;
        box-shadow: 0 2px 8px rgba(30, 64, 175, 0.2);
    }
    
    .highlight-box {
        @apply relative p-5 rounded-xl mb-4 overflow-hidden;
        background: linear-gradient(135deg, #eff6ff 0%, #dbeafe 100%);
        border: 1px solid rgba(59, 130, 246, 0.2);
    }
    
    .highlight-box::after {
        content: '';
        @apply absolute top-0 right-0 w-20 h-20 opacity-10;
        background: radial-gradient(circle, #3b82f6 0%, transparent 70%);
    }
    
    .border-card {
        @apply p-4 rounded-xl border-2 border-dashed border-gray-200 hover:border-primary/30 transition-all duration-300;
        background: linear-gradient(135deg, #ffffff 0%, #fafafa 100%);
    }
    
    .icon-circle {
        @apply w-14 h-14 rounded-2xl flex items-center justify-center shadow-lg;
        background: linear-gradient(135deg, #1e40af 0%, #3b82f6 100%);
    }
    
    .table-custom {
        @apply w-full rounded-xl overflow-hidden border border-gray-200;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
    }
    
    .table-custom thead {
        background: linear-gradient(135deg, #1e40af 0%, #3b82f6 100%);
    }
    
    .table-custom th {
        @apply px-5 py-4 text-left font-semibold text-white text-sm;
        border-bottom: 2px solid rgba(255, 255, 255, 0.1);
    }
    
    .table-custom tbody tr {
        @apply border-b border-gray-100 hover:bg-blue-50/30 transition-colors duration-200;
    }
    
    .table-custom td {
        @apply px-5 py-4 text-gray-700 font-medium;
    }
    
    .table-custom tbody tr:nth-child(even) {
        background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
    }
    
    .progress-bar {
        @apply h-2 bg-gray-200 rounded-full overflow-hidden;
    }
    
    .progress-fill {
        @apply h-full rounded-full;
        background: linear-gradient(90deg, #1e40af 0%, #3b82f6 100%);
    }
    
    .metric-card {
        @apply p-5 rounded-xl border border-gray-100 shadow-sm;
        background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
    }
    
    .metric-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
    }
</style>
@endpush

@section('content')
<div class="pt-24 pb-16 bg-gradient-to-b from-gray-50/50 via-white to-gray-50">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header dengan Background Gradient -->
        <div class="text-center mb-12 animate-fade-in">
            <div class="inline-flex items-center justify-center w-20 h-20 bg-gradient-to-br from-primary via-secondary to-accent text-white rounded-2xl shadow-2xl mb-6">
                <i class="fas fa-landmark text-3xl"></i>
            </div>
            <h1 class="text-4xl md:text-5xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-primary to-secondary mb-4">
                Gambaran Umum Desa
            </h1>
            <p class="text-gray-600 max-w-3xl mx-auto text-lg font-medium">
                Profil lengkap wilayah, potensi sumber daya, dan infrastruktur Desa Cicangkang Hilir
            </p>
            <div class="inline-flex items-center mt-4 px-4 py-2 bg-gradient-to-r from-primary/10 to-secondary/10 rounded-full">
                <i class="fas fa-map-marker-alt text-primary mr-2"></i>
                <span class="text-gray-700 font-medium">Kecamatan Cipongkor, Kabupaten Bandung Barat</span>
            </div>
        </div>

        <!-- Navigation Tabs dengan Glassmorphism -->
        <div class="flex justify-center mb-12">
            <div class="inline-flex rounded-2xl border border-gray-200 bg-white/80 backdrop-blur-sm p-1 shadow-lg">
                <a href="{{ route('profil.visi-misi') }}" 
                   class="px-6 py-3 rounded-xl text-gray-600 hover:text-primary hover:bg-gray-50/50 transition-all duration-300 flex items-center">
                    <i class="fas fa-bullseye mr-3 text-lg"></i>
                    <span class="font-medium">Visi Misi</span>
                </a>
                <a href="{{ route('profil.sejarah') }}" 
                   class="px-6 py-3 rounded-xl text-gray-600 hover:text-primary hover:bg-gray-50/50 transition-all duration-300 flex items-center">
                    <i class="fas fa-history mr-3 text-lg"></i>
                    <span class="font-medium">Sejarah</span>
                </a>
                <a href="{{ route('profil.gambaran') }}" 
                   class="px-6 py-3 rounded-xl bg-gradient-to-r from-primary to-secondary text-white shadow-lg flex items-center">
                    <i class="fas fa-landmark mr-3 text-lg"></i>
                    <span class="font-medium">Gambaran Umum</span>
                </a>
                <a href="{{ route('profil.struktur') }}" 
                   class="px-6 py-3 rounded-xl text-gray-600 hover:text-primary hover:bg-gray-50/50 transition-all duration-300 flex items-center">
                    <i class="fas fa-sitemap mr-3 text-lg"></i>
                    <span class="font-medium">Struktur</span>
                </a>
            </div>
        </div>

        <!-- A. Potensi Sumber Daya Alam - Card dengan Border yang Jelas -->
        <div class="section-card mb-8 animate-slide-up">
            <div class="info-header">
                <i class="fas fa-mountain"></i>
                <span>A. Potensi Sumber Daya Alam</span>
            </div>

            <div class="card-content">
                <!-- 1. Letak Geografis -->
                <div class="sub-header">
                    <i class="fas fa-map-marked-alt"></i>
                    <span>1. Letak Geografis</span>
                </div>
                
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
                    <!-- Deskripsi -->
                    <div class="p-5 rounded-xl border border-gray-200 bg-white">
                        <div class="flex items-start mb-4">
                            <div class="icon-circle mr-4">
                                <i class="fas fa-map text-white text-xl"></i>
                            </div>
                            <div>
                                <h4 class="text-lg font-bold text-dark mb-2">Informasi Geografis</h4>
                                <p class="text-gray-600">
                                    Desa Cicangkanghilir merupakan salah satu dari 14 desa di wilayah Kecamatan Cipongkor, 
                                    terletak sekitar 25 km dari pusat kecamatan.
                                </p>
                            </div>
                        </div>
                        <div class="grid grid-cols-2 gap-3 mt-4">
                            <div class="data-card">
                                <div class="text-sm text-gray-500">Luas Wilayah</div>
                                <div class="text-xl font-bold text-primary">369 ha</div>
                            </div>
                            <div class="data-card">
                                <div class="text-sm text-gray-500">Jumlah Dusun</div>
                                <div class="text-xl font-bold text-primary">4 Dusun</div>
                            </div>
                            <div class="data-card">
                                <div class="text-sm text-gray-500">RW</div>
                                <div class="text-xl font-bold text-primary">13 RW</div>
                            </div>
                            <div class="data-card">
                                <div class="text-sm text-gray-500">RT</div>
                                <div class="text-xl font-bold text-primary">35 RT</div>
                            </div>
                        </div>
                    </div>

                    <!-- Batas Wilayah -->
                    <div class="highlight-box">
                        <div class="flex items-center mb-4">
                            <div class="w-10 h-10 bg-gradient-to-br from-primary to-secondary rounded-xl flex items-center justify-center mr-3">
                                <i class="fas fa-border-all text-white"></i>
                            </div>
                            <h4 class="text-lg font-bold text-primary">Batas Wilayah Administratif</h4>
                        </div>
                        <div class="space-y-3">
                            <div class="flex items-center justify-between p-3 bg-white/50 rounded-lg">
                                <div class="flex items-center">
                                    <div class="w-8 h-8 bg-blue-100 text-blue-600 rounded-lg flex items-center justify-center mr-3">
                                        <i class="fas fa-arrow-up"></i>
                                    </div>
                                    <span class="font-medium">Sebelah Utara</span>
                                </div>
                                <span class="text-gray-700">Desa Karang Anyar (Kec. Cililin)</span>
                            </div>
                            <div class="flex items-center justify-between p-3 bg-white/50 rounded-lg">
                                <div class="flex items-center">
                                    <div class="w-8 h-8 bg-green-100 text-green-600 rounded-lg flex items-center justify-center mr-3">
                                        <i class="fas fa-arrow-down"></i>
                                    </div>
                                    <span class="font-medium">Sebelah Selatan</span>
                                </div>
                                <span class="text-gray-700">Desa Sindangkerta (Kec. Sindangkerta)</span>
                            </div>
                            <div class="flex items-center justify-between p-3 bg-white/50 rounded-lg">
                                <div class="flex items-center">
                                    <div class="w-8 h-8 bg-yellow-100 text-yellow-600 rounded-lg flex items-center justify-center mr-3">
                                        <i class="fas fa-arrow-right"></i>
                                    </div>
                                    <span class="font-medium">Sebelah Timur</span>
                                </div>
                                <span class="text-gray-700">Desa Bongas (Kec. Cililin)</span>
                            </div>
                            <div class="flex items-center justify-between p-3 bg-white/50 rounded-lg">
                                <div class="flex items-center">
                                    <div class="w-8 h-8 bg-red-100 text-red-600 rounded-lg flex items-center justify-center mr-3">
                                        <i class="fas fa-arrow-left"></i>
                                    </div>
                                    <span class="font-medium">Sebelah Barat</span>
                                </div>
                                <span class="text-gray-700">Desa Sukamulya (Kec. Cipongkor)</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Jarak dari Pusat -->
                <div class="border-card mb-6">
                    <div class="flex items-center mb-4">
                        <div class="w-12 h-12 bg-gradient-to-br from-primary to-secondary rounded-xl flex items-center justify-center mr-4">
                            <i class="fas fa-road text-white"></i>
                        </div>
                        <h4 class="text-xl font-bold text-dark">Jarak dari Pusat Pemerintahan</h4>
                    </div>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                        <div class="metric-card text-center">
                            <div class="text-sm text-gray-500 mb-2">Kantor Kecamatan</div>
                            <div class="text-2xl font-bold text-primary mb-1">19 km</div>
                            <div class="progress-bar">
                                <div class="progress-fill" style="width: 25%"></div>
                            </div>
                        </div>
                        <div class="metric-card text-center">
                            <div class="text-sm text-gray-500 mb-2">Ibu Kota Kabupaten</div>
                            <div class="text-2xl font-bold text-primary mb-1">40 km</div>
                            <div class="progress-bar">
                                <div class="progress-fill" style="width: 45%"></div>
                            </div>
                        </div>
                        <div class="metric-card text-center">
                            <div class="text-sm text-gray-500 mb-2">Ibu Kota Provinsi</div>
                            <div class="text-2xl font-bold text-primary mb-1">135 km</div>
                            <div class="progress-bar">
                                <div class="progress-fill" style="width: 75%"></div>
                            </div>
                        </div>
                        <div class="metric-card text-center">
                            <div class="text-sm text-gray-500 mb-2">Ibu Kota Negara</div>
                            <div class="text-2xl font-bold text-primary mb-1">440 km</div>
                            <div class="progress-bar">
                                <div class="progress-fill" style="width: 100%"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- 2. Topografi -->
                <div class="sub-header mt-8">
                    <i class="fas fa-mountain"></i>
                    <span>2. Topografi</span>
                </div>
                
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
                    <div class="p-5 rounded-xl border border-gray-200 bg-gradient-to-br from-white to-blue-50">
                        <div class="text-4xl font-bold text-primary mb-2">700</div>
                        <div class="text-sm text-gray-600">Ketinggian (mdpl)</div>
                        <div class="mt-2 text-xs text-primary font-medium">
                            <i class="fas fa-mountain mr-1"></i> Dataran Tinggi
                        </div>
                    </div>
                    <div class="p-5 rounded-xl border border-gray-200 bg-gradient-to-br from-white to-green-50">
                        <div class="text-4xl font-bold text-primary mb-2">18-25°C</div>
                        <div class="text-sm text-gray-600">Suhu Rata-rata</div>
                        <div class="mt-2 text-xs text-primary font-medium">
                            <i class="fas fa-thermometer-half mr-1"></i> Sejuk
                        </div>
                    </div>
                    <div class="p-5 rounded-xl border border-gray-200 bg-gradient-to-br from-white to-yellow-50">
                        <div class="text-4xl font-bold text-primary mb-2">144.9</div>
                        <div class="text-sm text-gray-600">Curah Hujan (mm/th)</div>
                        <div class="mt-2 text-xs text-primary font-medium">
                            <i class="fas fa-cloud-rain mr-1"></i> Tipe B Schmidt-Ferguson
                        </div>
                    </div>
                </div>

                <!-- 3. Luas dan Sebaran Lahan -->
                <div class="sub-header">
                    <i class="fas fa-seedling"></i>
                    <span>3. Luas dan Sebaran Penggunaan Lahan</span>
                </div>
                
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
                    <!-- Data Lahan -->
                    <div class="p-5 rounded-xl border border-gray-200 bg-white">
                        <h4 class="font-bold text-lg text-dark mb-4">Distribusi Lahan</h4>
                        <div class="space-y-4">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <div class="w-3 h-3 bg-primary rounded-full mr-3"></div>
                                    <span class="text-gray-700">Tanah Sawah Tadah Hujan</span>
                                </div>
                                <span class="font-bold text-primary">76,67 ha</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <div class="w-3 h-3 bg-secondary rounded-full mr-3"></div>
                                    <span class="text-gray-700">Tanah Tegal/Ladang</span>
                                </div>
                                <span class="font-bold text-primary">85,79 ha</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <div class="w-3 h-3 bg-accent rounded-full mr-3"></div>
                                    <span class="text-gray-700">Tanah Pemukiman</span>
                                </div>
                                <span class="font-bold text-primary">15,82 ha</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <div class="w-3 h-3 bg-purple-500 rounded-full mr-3"></div>
                                    <span class="text-gray-700">Tanah Fasilitas Umum</span>
                                </div>
                                <span class="font-bold text-primary">4.381 m²</span>
                            </div>
                        </div>
                    </div>

                    <!-- Tabel Pertanian -->
                    <div class="overflow-hidden rounded-xl border border-gray-200">
                        <div class="bg-gradient-to-r from-primary/10 to-secondary/10 p-4 border-b border-gray-200">
                            <h4 class="font-bold text-lg text-dark flex items-center">
                                <i class="fas fa-tractor mr-2"></i>Produksi Pertanian
                            </h4>
                        </div>
                        <table class="table-custom">
                            <thead>
                                <tr>
                                    <th>Tanaman</th>
                                    <th class="text-center">Luas (ha)</th>
                                    <th class="text-center">Produksi (ton/ha)</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="flex items-center">
                                        <i class="fas fa-corn text-yellow-500 mr-2"></i>
                                        <span>Jagung</span>
                                    </td>
                                    <td class="text-center font-bold">1.5</td>
                                    <td class="text-center">
                                        <span class="inline-flex px-3 py-1 bg-yellow-100 text-yellow-800 rounded-full text-sm">
                                            0.2
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="flex items-center">
                                        <i class="fas fa-seedling text-green-500 mr-2"></i>
                                        <span>Kedelai</span>
                                    </td>
                                    <td class="text-center font-bold">0.5</td>
                                    <td class="text-center">
                                        <span class="inline-flex px-3 py-1 bg-green-100 text-green-800 rounded-full text-sm">
                                            0.1
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="flex items-center">
                                        <i class="fas fa-wheat text-amber-500 mr-2"></i>
                                        <span>Padi Sawah</span>
                                    </td>
                                    <td class="text-center font-bold">81.39</td>
                                    <td class="text-center">
                                        <span class="inline-flex px-3 py-1 bg-amber-100 text-amber-800 rounded-full text-sm">
                                            7.0
                                        </span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- 4. Sumber Daya Air -->
                <div class="sub-header">
                    <i class="fas fa-water"></i>
                    <span>4. Sumber Daya Air</span>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                    <div class="p-5 rounded-xl border-2 border-blue-200 bg-gradient-to-br from-blue-50 to-white">
                        <div class="flex items-center mb-4">
                            <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center mr-3">
                                <i class="fas fa-water text-blue-600 text-xl"></i>
                            </div>
                            <div>
                                <h5 class="font-bold text-dark">Sumur Gali</h5>
                                <div class="text-2xl font-bold text-blue-600">956 Unit</div>
                            </div>
                        </div>
                        <div class="text-sm text-gray-600">Melayani 1.608 KK (kondisi: perlu perbaikan)</div>
                    </div>
                    
                    <div class="p-5 rounded-xl border-2 border-green-200 bg-gradient-to-br from-green-50 to-white">
                        <div class="flex items-center mb-4">
                            <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center mr-3">
                                <i class="fas fa-pump-soap text-green-600 text-xl"></i>
                            </div>
                            <div>
                                <h5 class="font-bold text-dark">Sumur Pompa</h5>
                                <div class="text-2xl font-bold text-green-600">10 Unit</div>
                            </div>
                        </div>
                        <div class="text-sm text-gray-600">Kondisi: baik, layak pakai</div>
                    </div>
                    
                    <div class="p-5 rounded-xl border-2 border-purple-200 bg-gradient-to-br from-purple-50 to-white">
                        <div class="flex items-center mb-4">
                            <div class="w-12 h-12 bg-purple-100 rounded-xl flex items-center justify-center mr-3">
                                <i class="fas fa-store text-purple-600 text-xl"></i>
                            </div>
                            <div>
                                <h5 class="font-bold text-dark">Depot Isi Ulang</h5>
                                <div class="text-2xl font-bold text-purple-600">2 Unit</div>
                            </div>
                        </div>
                        <div class="text-sm text-gray-600">Melayani 900 KK (kondisi: sangat baik)</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- B. Potensi Sumber Daya Manusia -->
        <div class="section-card mb-8 animate-slide-up" style="animation-delay: 0.1s">
            <div class="info-header">
                <i class="fas fa-users"></i>
                <span>B. Potensi Sumber Daya Manusia</span>
            </div>

            <div class="card-content">
                <!-- Data Kependudukan -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
                    <!-- Total Penduduk -->
                    <div class="p-6 rounded-xl border-2 border-primary/20 bg-gradient-to-br from-primary/5 to-white">
                        <div class="flex items-center justify-between mb-4">
                            <div>
                                <h4 class="text-2xl font-bold text-dark">5,682</h4>
                                <div class="text-sm text-gray-600">Total Penduduk</div>
                            </div>
                            <div class="w-16 h-16 bg-gradient-to-br from-primary to-secondary rounded-full flex items-center justify-center">
                                <i class="fas fa-users text-white text-2xl"></i>
                            </div>
                        </div>
                        <div class="grid grid-cols-2 gap-3">
                            <div class="p-3 bg-white rounded-lg">
                                <div class="text-sm text-gray-500">Laki-laki</div>
                                <div class="text-xl font-bold text-primary">2,794</div>
                            </div>
                            <div class="p-3 bg-white rounded-lg">
                                <div class="text-sm text-gray-500">Perempuan</div>
                                <div class="text-xl font-bold text-primary">2,888</div>
                            </div>
                        </div>
                    </div>

                    <!-- Statistik Tambahan -->
                    <div class="grid grid-cols-2 gap-4">
                        <div class="p-5 rounded-xl border border-gray-200 bg-white">
                            <div class="text-3xl font-bold text-primary mb-1">1,777</div>
                            <div class="text-sm text-gray-600">Kartu Keluarga</div>
                            <div class="mt-2 text-xs text-primary">
                                <i class="fas fa-home mr-1"></i> Rata-rata 3.2 orang/KK
                            </div>
                        </div>
                        <div class="p-5 rounded-xl border border-gray-200 bg-white">
                            <div class="text-3xl font-bold text-primary mb-1">1,539.8</div>
                            <div class="text-sm text-gray-600">Kepadatan (/km²)</div>
                            <div class="mt-2 text-xs text-primary">
                                <i class="fas fa-chart-bar mr-1"></i> Kepadatan sedang
                            </div>
                        </div>
                        <div class="p-5 rounded-xl border border-gray-200 bg-white">
                            <div class="text-3xl font-bold text-primary mb-1">61</div>
                            <div class="text-sm text-gray-600">Kelahiran</div>
                            <div class="mt-2 text-xs text-green-600">
                                <i class="fas fa-baby mr-1"></i> +2.5% pertumbuhan
                            </div>
                        </div>
                        <div class="p-5 rounded-xl border border-gray-200 bg-white">
                            <div class="text-3xl font-bold text-primary mb-1">24</div>
                            <div class="text-sm text-gray-600">Kematian</div>
                            <div class="mt-2 text-xs text-red-600">
                                <i class="fas fa-cross mr-1"></i> -1% per tahun
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sektor Ketenagakerjaan -->
                <div class="border-card mb-6">
                    <div class="flex items-center mb-4">
                        <div class="w-12 h-12 bg-gradient-to-br from-yellow-500 to-orange-500 rounded-xl flex items-center justify-center mr-4">
                            <i class="fas fa-briefcase text-white"></i>
                        </div>
                        <div>
                            <h4 class="text-xl font-bold text-dark">Ketenagakerjaan</h4>
                            <p class="text-sm text-gray-600">Analisis kondisi hingga 2018</p>
                        </div>
                    </div>
                    <div class="p-4 bg-gradient-to-r from-yellow-50 to-orange-50 rounded-xl">
                        <div class="flex items-start">
                            <i class="fas fa-info-circle text-yellow-500 mt-1 mr-3"></i>
                            <div>
                                <p class="text-gray-700">
                                    Kondisi relatif kondusif namun <strong>terbatasnya lapangan kerja</strong> 
                                    tetap menjadi tantangan utama. Dibutuhkan pengembangan UMKM dan sektor 
                                    kreatif untuk menyerap tenaga kerja lokal.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- C. Potensi Sarana & Prasarana -->
        <div class="section-card mb-8 animate-slide-up" style="animation-delay: 0.2s">
            <div class="info-header">
                <i class="fas fa-tools"></i>
                <span>C. Potensi Sarana & Prasarana</span>
            </div>

            <div class="card-content">
                <!-- Grid Infrastruktur -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-6">
                    <!-- Infrastruktur Jalan -->
                    <div class="p-5 rounded-xl border-2 border-orange-200 bg-gradient-to-br from-white to-orange-50 hover:border-orange-300 transition-all duration-300">
                        <div class="flex items-center mb-4">
                            <div class="w-12 h-12 bg-orange-100 rounded-xl flex items-center justify-center mr-3">
                                <i class="fas fa-road text-orange-600 text-xl"></i>
                            </div>
                            <div>
                                <h5 class="font-bold text-dark">Infrastruktur Jalan</h5>
                                <div class="text-sm text-gray-600">Kondisi jaringan jalan</div>
                            </div>
                        </div>
                        <div class="space-y-2">
                            <div class="flex items-center justify-between text-sm">
                                <span class="text-gray-600">Jalan Kabupaten</span>
                                <span class="font-bold text-primary">40% Baik</span>
                            </div>
                            <div class="flex items-center justify-between text-sm">
                                <span class="text-gray-600">Jalan Desa</span>
                                <span class="font-bold text-primary">65% Baik</span>
                            </div>
                            <div class="progress-bar mt-2">
                                <div class="progress-fill" style="width: 52%"></div>
                            </div>
                        </div>
                    </div>

                    <!-- Fasilitas Kesehatan -->
                    <div class="p-5 rounded-xl border-2 border-green-200 bg-gradient-to-br from-white to-green-50 hover:border-green-300 transition-all duration-300">
                        <div class="flex items-center mb-4">
                            <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center mr-3">
                                <i class="fas fa-clinic-medical text-green-600 text-xl"></i>
                            </div>
                            <div>
                                <h5 class="font-bold text-dark">Fasilitas Kesehatan</h5>
                                <div class="text-sm text-gray-600">Jumlah fasilitas</div>
                            </div>
                        </div>
                        <div class="flex justify-between">
                            <div class="text-center">
                                <div class="text-2xl font-bold text-green-600">4</div>
                                <div class="text-xs text-gray-600">Posyandu</div>
                            </div>
                            <div class="text-center">
                                <div class="text-2xl font-bold text-green-600">1</div>
                                <div class="text-xs text-gray-600">Pustu</div>
                            </div>
                            <div class="text-center">
                                <div class="text-2xl font-bold text-green-600">8</div>
                                <div class="text-xs text-gray-600">Bidan Desa</div>
                            </div>
                        </div>
                    </div>

                    <!-- Tempat Ibadah -->
                    <div class="p-5 rounded-xl border-2 border-blue-200 bg-gradient-to-br from-white to-blue-50 hover:border-blue-300 transition-all duration-300">
                        <div class="flex items-center mb-4">
                            <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center mr-3">
                                <i class="fas fa-mosque text-blue-600 text-xl"></i>
                            </div>
                            <div>
                                <h5 class="font-bold text-dark">Tempat Ibadah</h5>
                                <div class="text-sm text-gray-600">Sarana peribadatan</div>
                            </div>
                        </div>
                        <div class="flex justify-between">
                            <div class="text-center">
                                <div class="text-2xl font-bold text-blue-600">15</div>
                                <div class="text-xs text-gray-600">Masjid</div>
                            </div>
                            <div class="text-center">
                                <div class="text-2xl font-bold text-blue-600">35</div>
                                <div class="text-xs text-gray-600">Mushola</div>
                            </div>
                        </div>
                    </div>

                    <!-- Listrik PLN -->
                    <div class="p-5 rounded-xl border-2 border-yellow-200 bg-gradient-to-br from-white to-yellow-50 hover:border-yellow-300 transition-all duration-300">
                        <div class="flex items-center mb-4">
                            <div class="w-12 h-12 bg-yellow-100 rounded-xl flex items-center justify-center mr-3">
                                <i class="fas fa-bolt text-yellow-600 text-xl"></i>
                            </div>
                            <div>
                                <h5 class="font-bold text-dark">Listrik PLN</h5>
                                <div class="text-sm text-gray-600">Ketersediaan listrik</div>
                            </div>
                        </div>
                        <div class="space-y-3">
                            <div>
                                <div class="flex justify-between text-sm mb-1">
                                    <span>Terdaftar</span>
                                    <span class="font-bold">1,427 unit</span>
                                </div>
                                <div class="progress-bar">
                                    <div class="progress-fill" style="width: 64%"></div>
                                </div>
                            </div>
                            <div class="grid grid-cols-2 gap-2">
                                <div class="text-center p-2 bg-white rounded-lg">
                                    <div class="text-lg font-bold text-green-600">916</div>
                                    <div class="text-xs text-gray-600">Terpasang</div>
                                </div>
                                <div class="text-center p-2 bg-white rounded-lg">
                                    <div class="text-lg font-bold text-yellow-600">511</div>
                                    <div class="text-xs text-gray-600">Belum</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Catatan Footer -->
                <div class="mt-8 p-5 rounded-xl border-2 border-gray-300 bg-gradient-to-r from-gray-50 to-white">
                    <div class="flex items-start">
                        <div class="w-10 h-10 bg-gradient-to-br from-primary to-secondary rounded-lg flex items-center justify-center mr-3">
                            <i class="fas fa-info text-white"></i>
                        </div>
                        <div>
                            <h5 class="font-bold text-dark mb-2">Catatan Penting</h5>
                            <p class="text-sm text-gray-600">
                                <strong>Data lengkap</strong> dan tabel rinci (administrasi, aset, keuangan, data SDM) 
                                tersedia pada dokumen desa. Sistem dapat diintegrasikan dengan dashboard admin untuk 
                                pembaruan data secara real-time dan penyajian yang lebih interaktif.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Navigation Buttons -->
        <div class="flex flex-col sm:flex-row justify-between items-center gap-4 mt-8">
            <a href="{{ route('profil.sejarah') }}" 
               class="group inline-flex items-center px-6 py-3 bg-white text-gray-700 rounded-xl border-2 border-gray-200 hover:border-primary hover:bg-primary/5 transition-all duration-300 font-medium shadow-sm hover:shadow-md">
                <i class="fas fa-arrow-left mr-3 group-hover:-translate-x-1 transition-transform"></i>
                Kembali ke Sejarah
            </a>
            
            <a href="{{ route('profil.struktur') }}" 
               class="group inline-flex items-center px-6 py-3 bg-gradient-to-r from-primary to-secondary text-white rounded-xl hover:from-primary/90 hover:to-secondary/90 transition-all duration-300 font-medium shadow-lg hover:shadow-xl">
                Lanjut ke Struktur Pemerintahan
                <i class="fas fa-arrow-right ml-3 group-hover:translate-x-1 transition-transform"></i>
            </a>
        </div>
    </div>
</div>
@endsection