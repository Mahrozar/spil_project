@extends('layouts.home-app')

@section('title', 'Visi & Misi - Desa Cicangkang Hilir')

@push('styles')
<style>
    .section-bg {
        background: linear-gradient(rgba(30, 64, 175, 0.05), rgba(30, 64, 175, 0.05));
    }
    .vision-card {
        border-left: 4px solid #1e40af;
        transition: all 0.3s ease;
    }
    .vision-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
    }
    .mission-list li {
        position: relative;
        padding-left: 2rem;
        margin-bottom: 1rem;
    }
    .mission-list li:before {
        content: "✓";
        position: absolute;
        left: 0;
        color: #10b981;
        font-weight: bold;
    }
</style>
@endpush

@section('content')
<div class="pt-24 pb-12">
    <!-- Hero Section -->
    <div class="section-bg">
        <div class="container mx-auto px-6 py-12">
            <div class="text-center">
                <h1 class="text-3xl md:text-4xl font-bold text-primary mb-4">Visi & Misi Desa</h1>
                <p class="text-gray-600 max-w-2xl mx-auto">Arah dan tujuan pembangunan Desa Cicangkang Hilir menuju masyarakat yang sejahtera dan mandiri</p>
            </div>
        </div>
    </div>

    <!-- Breadcrumb -->
    <div class="container mx-auto px-6 py-4">
        <nav class="flex" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                <li class="inline-flex items-center">
                    <a href="{{ route('landing-page') }}" class="inline-flex items-center text-sm text-gray-700 hover:text-primary">
                        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path>
                        </svg>
                        Beranda
                    </a>
                </li>
                <li>
                    <div class="flex items-center">
                        <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        <a href="#" class="ml-1 text-sm text-gray-700 hover:text-primary md:ml-2">Profil Desa</a>
                    </div>
                </li>
                <li aria-current="page">
                    <div class="flex items-center">
                        <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        <span class="ml-1 text-sm text-primary font-medium md:ml-2">Visi & Misi</span>
                    </div>
                </li>
            </ol>
        </nav>
    </div>

    <!-- Visi Section -->
    <div class="container mx-auto px-6 py-8">
        <div class="vision-card bg-white p-8 rounded-xl shadow-md mb-12">
            <div class="flex items-center mb-6">
                <div class="bg-primary text-white p-3 rounded-full mr-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    </svg>
                </div>
                <h2 class="text-2xl font-bold text-primary">Visi Desa Cicangkang Hilir</h2>
            </div>
            
            <div class="bg-blue-50 border border-blue-100 rounded-lg p-6">
                <h3 class="text-xl font-bold text-center text-primary italic mb-4">
                    "Terwujudnya Desa Cicangkang Hilir yang Maju, Mandiri, Sejahtera, dan Berbudaya Berbasis Kearifan Lokal"
                </h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-8">
                    <div class="space-y-4">
                        <h4 class="font-bold text-lg text-dark">Maju</h4>
                        <p class="text-gray-600">Mengembangkan potensi desa secara optimal dengan memanfaatkan teknologi dan inovasi.</p>
                    </div>
                    
                    <div class="space-y-4">
                        <h4 class="font-bold text-lg text-dark">Mandiri</h4>
                        <p class="text-gray-600">Meningkatkan kemampuan masyarakat dalam mengelola sumber daya lokal secara berkelanjutan.</p>
                    </div>
                    
                    <div class="space-y-4">
                        <h4 class="font-bold text-lg text-dark">Sejahtera</h4>
                        <p class="text-gray-600">Meningkatkan kesejahteraan masyarakat melalui pemberdayaan ekonomi dan sosial.</p>
                    </div>
                    
                    <div class="space-y-4">
                        <h4 class="font-bold text-lg text-dark">Berbudaya</h4>
                        <p class="text-gray-600">Melestarikan dan mengembangkan nilai-nilai budaya lokal yang positif.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Misi Section -->
        <div class="vision-card bg-white p-8 rounded-xl shadow-md">
            <div class="flex items-center mb-6">
                <div class="bg-accent text-white p-3 rounded-full mr-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <h2 class="text-2xl font-bold text-primary">Misi Desa Cicangkang Hilir</h2>
            </div>
            
            <div class="space-y-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Misi 1 -->
                    <div class="bg-gray-50 p-6 rounded-lg border border-gray-100">
                        <div class="flex items-start mb-4">
                            <div class="bg-primary text-white rounded-full w-10 h-10 flex items-center justify-center mr-4 flex-shrink-0">
                                <span class="font-bold">1</span>
                            </div>
                            <h3 class="text-lg font-bold text-dark">Meningkatkan Pelayanan Publik</h3>
                        </div>
                        <ul class="mission-list space-y-2">
                            <li class="text-gray-600">Optimalisasi pelayanan administrasi kepada masyarakat</li>
                            <li class="text-gray-600">Transparansi dalam pengelolaan keuangan desa</li>
                            <li class="text-gray-600">Peningkatan sarana dan prasarana pelayanan</li>
                        </ul>
                    </div>
                    
                    <!-- Misi 2 -->
                    <div class="bg-gray-50 p-6 rounded-lg border border-gray-100">
                        <div class="flex items-start mb-4">
                            <div class="bg-primary text-white rounded-full w-10 h-10 flex items-center justify-center mr-4 flex-shrink-0">
                                <span class="font-bold">2</span>
                            </div>
                            <h3 class="text-lg font-bold text-dark">Mengembangkan Ekonomi Masyarakat</h3>
                        </div>
                        <ul class="mission-list space-y-2">
                            <li class="text-gray-600">Pengembangan potensi ekonomi lokal</li>
                            <li class="text-gray-600">Pemberdayaan UMKM dan koperasi desa</li>
                            <li class="text-gray-600">Peningkatan ketrampilan dan pelatihan usaha</li>
                        </ul>
                    </div>
                    
                    <!-- Misi 3 -->
                    <div class="bg-gray-50 p-6 rounded-lg border border-gray-100">
                        <div class="flex items-start mb-4">
                            <div class="bg-primary text-white rounded-full w-10 h-10 flex items-center justify-center mr-4 flex-shrink-0">
                                <span class="font-bold">3</span>
                            </div>
                            <h3 class="text-lg font-bold text-dark">Meningkatkan Kualitas Pendidikan & Kesehatan</h3>
                        </div>
                        <ul class="mission-list space-y-2">
                            <li class="text-gray-600">Pendidikan berkualitas untuk semua usia</li>
                            <li class="text-gray-600">Layanan kesehatan yang mudah diakses</li>
                            <li class="text-gray-600">Program pencegahan stunting dan gizi buruk</li>
                        </ul>
                    </div>
                    
                    <!-- Misi 4 -->
                    <div class="bg-gray-50 p-6 rounded-lg border border-gray-100">
                        <div class="flex items-start mb-4">
                            <div class="bg-primary text-white rounded-full w-10 h-10 flex items-center justify-center mr-4 flex-shrink-0">
                                <span class="font-bold">4</span>
                            </div>
                            <h3 class="text-lg font-bold text-dark">Melestarikan Lingkungan & Budaya</h3>
                        </div>
                        <ul class="mission-list space-y-2">
                            <li class="text-gray-600">Pengelolaan lingkungan berkelanjutan</li>
                            <li class="text-gray-600">Pelestarian adat dan budaya lokal</li>
                            <li class="text-gray-600">Pengembangan wisata berbasis budaya</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- Program Unggulan -->
        <div class="mt-12">
            <h2 class="text-2xl font-bold text-primary mb-6">Program Unggulan Desa</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-white p-6 rounded-xl shadow border border-gray-100">
                    <div class="text-primary mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                        </svg>
                    </div>
                    <h3 class="font-bold text-lg mb-2">CICANGKANG MANDIRI</h3>
                    <p class="text-gray-600">Program pemberdayaan ekonomi masyarakat melalui pelatihan dan pendampingan UMKM.</p>
                </div>
                
                <div class="bg-white p-6 rounded-xl shadow border border-gray-100">
                    <div class="text-primary mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                    </div>
                    <h3 class="font-bold text-lg mb-2">CICANGKANG AMAN</h3>
                    <p class="text-gray-600">Program peningkatan keamanan dan ketertiban masyarakat melalui sistem keamanan lingkungan.</p>
                </div>
                
                <div class="bg-white p-6 rounded-xl shadow border border-gray-100">
                    <div class="text-primary mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                        </svg>
                    </div>
                    <h3 class="font-bold text-lg mb-2">CICANGKANG SEHAT</h3>
                    <p class="text-gray-600">Program kesehatan masyarakat dengan fokus pada pencegahan dan layanan kesehatan dasar.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- CTA Section -->
    <div class="bg-primary mt-12">
        <div class="container mx-auto px-6 py-12">
            <div class="text-center text-white">
                <h2 class="text-2xl font-bold mb-4">Bersama Membangun Desa Cicangkang Hilir</h2>
                <p class="text-blue-100 mb-6 max-w-2xl mx-auto">Visi dan misi ini akan terwujud dengan dukungan dan partisipasi aktif seluruh masyarakat Desa Cicangkang Hilir.</p>
                <a href="{{ route('profil.struktur') }}" class="inline-flex items-center bg-white text-primary font-bold py-3 px-8 rounded-lg hover:bg-gray-100 transition duration-300 shadow-lg">
                    Lihat Struktur Pemerintahan
                    <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                    </svg>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection