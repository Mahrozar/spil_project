@extends('layouts.home-app')

@section('title', 'Sejarah Desa - Desa Cicangkang Hilir')

@push('styles')
<style>
    .timeline-container {
        position: relative;
        max-width: 800px;
        margin: 0 auto;
    }
    .timeline-container:before {
        content: '';
        position: absolute;
        left: 50%;
        transform: translateX(-50%);
        width: 2px;
        height: 100%;
        background: #1e40af;
    }
    .timeline-item {
        position: relative;
        margin-bottom: 50px;
    }
    .timeline-item:nth-child(odd) .timeline-content {
        margin-left: auto;
        text-align: right;
        padding-right: 70px;
        padding-left: 0;
    }
    .timeline-item:nth-child(even) .timeline-content {
        padding-left: 70px;
        padding-right: 0;
    }
    .timeline-item:before {
        content: '';
        position: absolute;
        left: 50%;
        transform: translateX(-50%);
        width: 20px;
        height: 20px;
        border-radius: 50%;
        background: #1e40af;
        border: 4px solid white;
        z-index: 1;
    }
    .timeline-year {
        position: absolute;
        left: 50%;
        transform: translateX(-50%);
        background: #1e40af;
        color: white;
        padding: 5px 15px;
        border-radius: 20px;
        font-weight: bold;
        margin-top: -10px;
        z-index: 1;
    }
    @media (max-width: 768px) {
        .timeline-container:before {
            left: 30px;
        }
        .timeline-item:before {
            left: 30px;
        }
        .timeline-year {
            left: 30px;
            transform: none;
        }
        .timeline-content {
            margin-left: 70px !important;
            padding-left: 30px !important;
            padding-right: 15px !important;
            text-align: left !important;
        }
    }
    .section-bg {
        background: linear-gradient(rgba(30, 64, 175, 0.05), rgba(30, 64, 175, 0.05));
    }
</style>
@endpush

@section('content')
<div class="pt-24 pb-12">
    <!-- Hero Section -->
    <div class="section-bg">
        <div class="container mx-auto px-6 py-12">
            <div class="text-center">
                <h1 class="text-3xl md:text-4xl font-bold text-primary mb-4">Sejarah Desa Cicangkang Hilir</h1>
                <p class="text-gray-600 max-w-2xl mx-auto">Mengenal perjalanan panjang Desa Cicangkang Hilir dari masa ke masa</p>
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
                        <span class="ml-1 text-sm text-primary font-medium md:ml-2">Sejarah Desa</span>
                    </div>
                </li>
            </ol>
        </nav>
    </div>

    <!-- Sejarah Utama -->
    <div class="container mx-auto px-6 py-8">
        <div class="bg-white rounded-xl shadow-md p-8 mb-12">
            <div class="flex items-center mb-6">
                <div class="bg-primary text-white p-3 rounded-full mr-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <h2 class="text-2xl font-bold text-primary">Asal Usul Nama Cicangkang Hilir</h2>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-center">
                <div>
                    <p class="text-gray-600 mb-4">
                        Desa Cicangkang Hilir memiliki sejarah panjang yang bermula dari masa penjajahan Belanda. 
                        Nama "Cicangkang" berasal dari bahasa Sunda yang terdiri dari dua kata: "Ci" yang berarti air 
                        atau sungai, dan "Cangkang" yang berarti cangkang atau kulit keras.
                    </p>
                    <p class="text-gray-600 mb-4">
                        Konon, pada zaman dahulu di daerah ini terdapat banyak pohon yang memiliki buah berkulit keras 
                        yang disebut "cangkang". Daerah ini juga dialiri oleh sungai kecil yang menjadi sumber kehidupan 
                        masyarakat sekitar.
                    </p>
                    <p class="text-gray-600">
                        Kata "Hilir" menunjukkan posisi geografis desa ini yang berada di bagian hilir dari aliran sungai 
                        utama di wilayah tersebut. Sehingga nama Cicangkang Hilir dapat diartikan sebagai "daerah hilir 
                        sungai yang banyak pohon cangkang".
                    </p>
                </div>
                <div class="bg-gray-100 rounded-lg p-6 text-center">
                    <div class="text-primary mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-20 w-20 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                    <h3 class="font-bold text-lg mb-2">Arti Nama Desa</h3>
                    <p class="text-gray-600 italic">"Cicangkang Hilir: Daerah hilir sungai yang banyak pohon cangkang"</p>
                </div>
            </div>
        </div>

        <!-- Timeline Sejarah -->
        <div class="bg-white rounded-xl shadow-md p-8">
            <div class="flex items-center mb-8">
                <div class="bg-accent text-white p-3 rounded-full mr-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                    </svg>
                </div>
                <h2 class="text-2xl font-bold text-primary">Linimasa Perkembangan Desa</h2>
            </div>

            <div class="timeline-container">
                <!-- Tahun 1800-an -->
                <div class="timeline-item">
                    <div class="timeline-year">Abad 19</div>
                    <div class="timeline-content bg-gray-50 p-6 rounded-lg border border-gray-200">
                        <h3 class="font-bold text-lg mb-2 text-primary">Masa Penjajahan Belanda</h3>
                        <p class="text-gray-600">
                            Desa Cicangkang Hilir mulai dikenal sebagai permukiman masyarakat Sunda yang hidup dari bertani 
                            dan berkebun. Pada masa ini, sistem pemerintahan masih sangat sederhana dengan dipimpin oleh 
                            sesepuh adat.
                        </p>
                    </div>
                </div>

                <!-- Tahun 1945 -->
                <div class="timeline-item">
                    <div class="timeline-year">1945</div>
                    <div class="timeline-content bg-gray-50 p-6 rounded-lg border border-gray-200">
                        <h3 class="font-bold text-lg mb-2 text-primary">Masa Kemerdekaan</h3>
                        <p class="text-gray-600">
                            Setelah kemerdekaan Indonesia, Desa Cicangkang Hilir mulai membentuk struktur pemerintahan 
                            desa yang lebih formal. Masyarakat mulai mengembangkan pertanian dan perkebunan sebagai 
                            mata pencaharian utama.
                        </p>
                    </div>
                </div>

                <!-- Tahun 1970 -->
                <div class="timeline-item">
                    <div class="timeline-year">1970</div>
                    <div class="timeline-content bg-gray-50 p-6 rounded-lg border border-gray-200">
                        <h3 class="font-bold text-lg mb-2 text-primary">Pembentukan Desa Definitif</h3>
                        <p class="text-gray-600">
                            Desa Cicangkang Hilir secara resmi ditetapkan sebagai desa definitif dalam struktur 
                            pemerintahan Kecamatan Cipongkor, Kabupaten Bandung Barat. Pembangunan infrastruktur dasar 
                            seperti jalan dan jembatan mulai dilakukan.
                        </p>
                    </div>
                </div>

                <!-- Tahun 2000 -->
                <div class="timeline-item">
                    <div class="timeline-year">2000</div>
                    <div class="timeline-content bg-gray-50 p-6 rounded-lg border border-gray-200">
                        <h3 class="font-bold text-lg mb-2 text-primary">Era Reformasi</h3>
                        <p class="text-gray-600">
                            Dengan adanya otonomi daerah, Desa Cicangkang Hilir mendapatkan kewenangan yang lebih besar 
                            dalam mengelola pemerintahan dan pembangunan. Program-program pemberdayaan masyarakat mulai 
                            digalakkan.
                        </p>
                    </div>
                </div>

                <!-- Tahun 2020 -->
                <div class="timeline-item">
                    <div class="timeline-year">2020 - Sekarang</div>
                    <div class="timeline-content bg-gray-50 p-6 rounded-lg border border-gray-200">
                        <h3 class="font-bold text-lg mb-2 text-primary">Digitalisasi Desa</h3>
                        <p class="text-gray-600">
                            Desa Cicangkang Hilir mulai mengadopsi teknologi dalam pelayanan publik. Sistem Informasi 
                            Desa (SIDeKa) diluncurkan untuk meningkatkan efisiensi dan transparansi pemerintahan desa. 
                            Pembangunan berkelanjutan menjadi fokus utama.
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Potensi & Budaya -->
        <div class="mt-12 grid grid-cols-1 md:grid-cols-2 gap-8">
            <div class="bg-white rounded-xl shadow-md p-6">
                <h3 class="text-xl font-bold text-primary mb-4">Potensi Desa</h3>
                <div class="space-y-4">
                    <div class="flex items-start">
                        <div class="bg-green-100 text-accent p-2 rounded-lg mr-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div>
                            <h4 class="font-bold text-dark">Pertanian & Perkebunan</h4>
                            <p class="text-gray-600 text-sm">Komoditas utama: padi, palawija, sayuran, dan buah-buahan lokal.</p>
                        </div>
                    </div>
                    
                    <div class="flex items-start">
                        <div class="bg-blue-100 text-primary p-2 rounded-lg mr-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <div>
                            <h4 class="font-bold text-dark">UMKM Lokal</h4>
                            <p class="text-gray-600 text-sm">Kerajinan tangan, makanan tradisional, dan usaha mikro kreatif.</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="bg-white rounded-xl shadow-md p-6">
                <h3 class="text-xl font-bold text-primary mb-4">Budaya & Adat Istiadat</h3>
                <div class="space-y-4">
                    <div class="flex items-start">
                        <div class="bg-yellow-100 text-yellow-600 p-2 rounded-lg mr-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <div>
                            <h4 class="font-bold text-dark">Upacara Adat</h4>
                            <p class="text-gray-600 text-sm">Seren taun, pernikahan adat, dan ritual pertanian masih dilestarikan.</p>
                        </div>
                    </div>
                    
                    <div class="flex items-start">
                        <div class="bg-purple-100 text-purple-600 p-2 rounded-lg mr-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div>
                            <h4 class="font-bold text-dark">Kesenian Tradisional</h4>
                            <p class="text-gray-600 text-sm">Jaipongan, wayang golek, dan seni musik tradisional Sunda.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Navigasi ke halaman lain -->
    <div class="container mx-auto px-6 py-8">
        <div class="bg-gradient-to-r from-primary to-secondary rounded-xl p-6">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <a href="{{ route('profil.visi-misi') }}" class="bg-white bg-opacity-90 p-4 rounded-lg hover:bg-opacity-100 transition duration-300 text-center">
                    <div class="text-primary mb-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                    </div>
                    <h3 class="font-bold text-dark">Visi & Misi</h3>
                    <p class="text-gray-600 text-sm mt-1">Lihat arah pembangunan desa</p>
                </a>
                
                <a href="{{ route('profil.struktur') }}" class="bg-white bg-opacity-90 p-4 rounded-lg hover:bg-opacity-100 transition duration-300 text-center">
                    <div class="text-primary mb-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </div>
                    <h3 class="font-bold text-dark">Struktur Pemerintahan</h3>
                    <p class="text-gray-600 text-sm mt-1">Kenali aparatur desa</p>
                </a>
                
                <a href="{{ route('layanan.prosedur') }}" class="bg-white bg-opacity-90 p-4 rounded-lg hover:bg-opacity-100 transition duration-300 text-center">
                    <div class="text-primary mb-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                    <h3 class="font-bold text-dark">Layanan Desa</h3>
                    <p class="text-gray-600 text-sm mt-1">Akses layanan publik</p>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection