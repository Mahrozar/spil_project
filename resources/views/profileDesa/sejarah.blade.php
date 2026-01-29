@extends('layouts.home-app')

@section('title', 'Sejarah Desa - Desa Cicangkang Hilir')

@push('styles')
<style>
    /* Timeline Custom Styles */
    .timeline-container {
        position: relative;
        max-width: 800px;
        margin: 0 auto;
    }
    
    .timeline-container::before {
        content: '';
        position: absolute;
        left: 50%;
        transform: translateX(-50%);
        width: 2px;
        height: 100%;
        background: linear-gradient(to bottom, transparent, #1e40af, transparent);
        background: #1e40af;
    }
    
    .timeline-item {
        position: relative;
        margin-bottom: 50px;
        transition: all 0.3s ease;
    }
    
    .timeline-item:hover {
        transform: translateY(-5px);
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
    
    .timeline-item::before {
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
        box-shadow: 0 0 0 4px rgba(30, 64, 175, 0.2);
        transition: all 0.3s ease;
    }
    
    .timeline-item:hover::before {
        transform: translateX(-50%) scale(1.2);
        box-shadow: 0 0 0 6px rgba(30, 64, 175, 0.3);
    }
    
    .timeline-year {
        position: absolute;
        left: 50%;
        transform: translateX(-50%);
        background: linear-gradient(135deg, #1e40af 0%, #3b82f6 100%);
        color: white;
        padding: 5px 15px;
        border-radius: 20px;
        font-weight: bold;
        margin-top: -10px;
        z-index: 1;
        box-shadow: 0 4px 6px rgba(30, 64, 175, 0.2);
        transition: all 0.3s ease;
    }
    
    .timeline-item:hover .timeline-year {
        transform: translateX(-50%) scale(1.05);
        box-shadow: 0 6px 12px rgba(30, 64, 175, 0.3);
    }
    
    .timeline-content {
        background: white;
        padding: 24px;
        border-radius: 12px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        border: 1px solid #e5e7eb;
        transition: all 0.3s ease;
    }
    
    .timeline-item:hover .timeline-content {
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        border-color: #d1d5db;
    }
    
    /* Responsive Timeline */
    @media (max-width: 768px) {
        .timeline-container::before {
            left: 30px;
        }
        
        .timeline-item::before {
            left: 30px;
        }
        
        .timeline-year {
            left: 30px;
            transform: none;
        }
        
        .timeline-content {
            margin-left: 60px !important;
            padding-left: 24px !important;
            padding-right: 16px !important;
            text-align: left !important;
            width: calc(100% - 60px);
        }
        
        .timeline-item:hover .timeline-year {
            transform: scale(1.05);
        }
    }
    
    /* Section Background */
    .section-bg {
        background: linear-gradient(135deg, rgba(30, 64, 175, 0.05) 0%, rgba(30, 64, 175, 0.02) 100%);
        position: relative;
        overflow: hidden;
    }
    
    .section-bg::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, #1e40af 0%, #3b82f6 100%);
    }
    
    /* Table Styling */
    .history-table {
        border-collapse: separate;
        border-spacing: 0;
        width: 100%;
    }
    
    .history-table thead tr {
        background: linear-gradient(135deg, #1e40af 0%, #3b82f6 100%);
    }
    
    .history-table th {
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        font-size: 0.875rem;
    }
    
    .history-table tbody tr {
        transition: all 0.2s ease;
    }
    
    .history-table tbody tr:hover {
        background-color: #eff6ff;
        transform: translateY(-1px);
    }
    
    /* Animation for page elements */
    .animate-on-scroll {
        opacity: 0;
        transform: translateY(20px);
        transition: opacity 0.6s ease, transform 0.6s ease;
    }
    
    .animate-on-scroll.visible {
        opacity: 1;
        transform: translateY(0);
    }
    
    /* Breadcrumb styling */
    .breadcrumb-item {
        position: relative;
    }
    
    .breadcrumb-item:not(:last-child)::after {
        content: '/';
        position: absolute;
        right: -12px;
        color: #9ca3af;
    }
</style>
@endpush

@section('content')
<div class="min-h-screen bg-gray-50 pt-6">
    <!-- Breadcrumb -->
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-4">
        <nav class="flex" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-2">
                <li class="inline-flex items-center breadcrumb-item">
                    <a href="{{ route('landing-page') }}" 
                       class="inline-flex items-center text-sm text-gray-600 hover:text-primary transition-colors duration-200">
                        <i class="fas fa-home mr-2"></i>
                        Beranda
                    </a>
                </li>
                <li class="inline-flex items-center breadcrumb-item">
                    <a href="{{ route('profil.visi-misi') }}" 
                       class="inline-flex items-center text-sm text-gray-600 hover:text-primary transition-colors duration-200">
                        <i class="fas fa-info-circle mr-2"></i>
                        Profil Desa
                    </a>
                </li>
                <li class="inline-flex items-center">
                    <span class="inline-flex items-center text-sm text-primary font-semibold">
                        <i class="fas fa-history mr-2"></i>
                        Sejarah Desa
                    </span>
                </li>
            </ol>
        </nav>
    </div>

    <!-- Hero Section -->
    <div class="section-bg animate-on-scroll">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-12 md:py-16">
            <div class="text-center max-w-3xl mx-auto">
                <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold text-primary mb-4">
                    Sejarah Desa Cicangkang Hilir
                </h1>
                <div class="w-20 h-1 bg-gradient-to-r from-primary to-secondary mx-auto mb-6 rounded-full"></div>
                <p class="text-lg text-gray-600 mb-6 leading-relaxed">
                    Mengenal perjalanan panjang dan makna filosofis Desa Cicangkang Hilir 
                    dari masa ke masa
                </p>
                <div class="inline-flex items-center text-sm text-gray-500 bg-white px-4 py-2 rounded-full shadow-sm">
                    <i class="fas fa-calendar-alt mr-2 text-primary"></i>
                    <span>Dibentuk pada 02 Agustus 1932</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Sejarah Utama -->
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8 md:py-12">
        <div class="bg-white rounded-2xl shadow-lg p-6 md:p-8 mb-12 animate-on-scroll">
            <div class="flex items-center mb-8">
                <div class="bg-primary text-white p-3 rounded-full mr-4 shadow-lg">
                    <i class="fas fa-book-open text-xl"></i>
                </div>
                <div>
                    <h2 class="text-2xl md:text-3xl font-bold text-primary">Asal Usul Nama Cicangkang Hilir</h2>
                    <p class="text-gray-500 mt-1">Sejarah dan makna filosofis nama desa</p>
                </div>
            </div>
            
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 md:gap-12 items-center">
                <div>
                    <div class="prose prose-lg max-w-none text-gray-600">
                        <p class="mb-4 leading-relaxed">
                            Desa Cicangkanghilir secara resmi berdiri pada tanggal 
                            <strong class="text-primary">02 Agustus 1932</strong>. 
                            Penamaan desa ini dilatarbelakangi oleh adanya kesamaan nama 
                            dengan Desa Cicangkanggirang, sehingga sering menimbulkan 
                            kekeliruan di masyarakat.
                        </p>
                        
                        <p class="mb-4 leading-relaxed">
                            Untuk menghindari kekeliruan tersebut, para tokoh masyarakat 
                            Desa Cicangkang mengadakan musyawarah pada tanggal 02-08-1932 
                            dan menghasilkan kesepakatan penamaan 
                            <strong class="text-primary">Desa Cicangkanghilir</strong>.
                        </p>
                        
                        <div class="bg-primary-light p-4 rounded-xl border-l-4 border-primary my-6">
                            <h3 class="font-bold text-primary mb-2">Makna Filosofis Nama Desa</h3>
                            <ul class="space-y-2">
                                <li class="flex items-start">
                                    <i class="fas fa-droplet text-primary mr-2 mt-1"></i>
                                    <span><strong>"Ci"</strong> berasal dari kata <em>Cai</em> yang berarti air</span>
                                </li>
                                <li class="flex items-start">
                                    <i class="fas fa-leaf text-primary mr-2 mt-1"></i>
                                    <span><strong>"Cangkang"</strong> bermakna banyaknya kulit buah yang hanyut terbawa arus sungai</span>
                                </li>
                                <li class="flex items-start">
                                    <i class="fas fa-water text-primary mr-2 mt-1"></i>
                                    <span><strong>"Hilir"</strong> menunjukkan letak desa di bagian hilir aliran sungai besar</span>
                                </li>
                            </ul>
                        </div>
                        
                        <p class="leading-relaxed">
                            Desa Cicangkang Hilir terletak di wilayah hilir dari aliran sungai 
                            besar (wahangan/kali) yang bermuara di wilayah ini, sehingga 
                            cangkang-cangkang buah dari hulu sering terbawa arus dan terdampar 
                            di wilayah ini.
                        </p>
                    </div>
                </div>
                
                <div class="bg-gradient-to-br from-primary-light to-accent-light rounded-2xl p-6 md:p-8 shadow-lg">
                    <div class="text-center mb-6">
                        <div class="inline-flex items-center justify-center w-20 h-20 bg-white text-primary rounded-full mb-4 shadow-lg">
                            <i class="fas fa-landmark text-3xl"></i>
                        </div>
                        <h3 class="text-xl font-bold text-primary mb-2">Makna Simbolik</h3>
                        <div class="w-12 h-1 bg-primary mx-auto mb-4 rounded-full"></div>
                    </div>
                    
                    <div class="space-y-4">
                        <div class="bg-white p-4 rounded-xl shadow-sm">
                            <div class="flex items-center mb-2">
                                <div class="bg-primary text-white p-2 rounded-lg mr-3">
                                    <i class="fas fa-water"></i>
                                </div>
                                <h4 class="font-bold text-dark">Kesuburan</h4>
                            </div>
                            <p class="text-gray-600 text-sm">
                                Air melambangkan sumber kehidupan dan kesuburan tanah
                            </p>
                        </div>
                        
                        <div class="bg-white p-4 rounded-xl shadow-sm">
                            <div class="flex items-center mb-2">
                                <div class="bg-accent text-white p-2 rounded-lg mr-3">
                                    <i class="fas fa-recycle"></i>
                                </div>
                                <h4 class="font-bold text-dark">Kesinambungan</h4>
                            </div>
                            <p class="text-gray-600 text-sm">
                                Cangkang buah melambangkan siklus alam dan kesinambungan kehidupan
                            </p>
                        </div>
                        
                        <div class="bg-white p-4 rounded-xl shadow-sm">
                            <div class="flex items-center mb-2">
                                <div class="bg-secondary text-white p-2 rounded-lg mr-3">
                                    <i class="fas fa-users"></i>
                                </div>
                                <h4 class="font-bold text-dark">Gotong Royong</h4>
                            </div>
                            <p class="text-gray-600 text-sm">
                                Hilir menunjukkan kebersamaan masyarakat dalam menghadapi kehidupan
                            </p>
                        </div>
                    </div>
                    
                    <div class="mt-6 pt-6 border-t border-gray-200">
                        <p class="text-center text-gray-600 italic">
                            <i class="fas fa-quote-left text-primary mr-2"></i>
                            "Cicangkanghilir: Wilayah hilir yang diberkahi kesuburan dan kehidupan berkelanjutan"
                            <i class="fas fa-quote-right text-primary ml-2"></i>
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Timeline Sejarah -->
        <div class="bg-white rounded-2xl shadow-lg p-6 md:p-8 mb-12 animate-on-scroll">
            <div class="text-center mb-10">
                <h2 class="text-2xl md:text-3xl font-bold text-primary mb-3">Jejak Sejarah Desa</h2>
                <p class="text-gray-600 max-w-2xl mx-auto">
                    Perjalanan transformasi Desa Cicangkang Hilir dari masa ke masa
                </p>
                <div class="w-16 h-1 bg-gradient-to-r from-primary to-secondary mx-auto mt-4 rounded-full"></div>
            </div>
            
            <div class="timeline-container">
                <div class="timeline-item">
                    <div class="timeline-year">1932</div>
                    <div class="timeline-content">
                        <div class="flex items-center mb-3">
                            <div class="bg-primary text-white p-2 rounded-full mr-3">
                                <i class="fas fa-flag"></i>
                            </div>
                            <h3 class="font-bold text-lg text-primary">Berdirinya Desa</h3>
                        </div>
                        <p class="text-gray-600">
                            Desa Cicangkang Hilir resmi berdiri pada tanggal 02 Agustus 1932.
                            Pada awal berdirinya, wilayah desa ini mencakup dua wilayah yang
                            kini menjadi Desa Cicangkang Hilir dan Desa Sukamulya.
                        </p>
                    </div>
                </div>

                <div class="timeline-item">
                    <div class="timeline-year">1965</div>
                    <div class="timeline-content">
                        <div class="flex items-center mb-3">
                            <div class="bg-primary text-white p-2 rounded-full mr-3">
                                <i class="fas fa-user-tie"></i>
                            </div>
                            <h3 class="font-bold text-lg text-primary">Awal Pemerintahan</h3>
                        </div>
                        <p class="text-gray-600">
                            Sejarah kepemimpinan Desa Cicangkang Hilir mulai tercatat sejak tahun 1965,
                            dengan dipimpin oleh pejabat kepala desa dan selanjutnya kepala desa definitif
                            sesuai dengan struktur pemerintahan desa.
                        </p>
                    </div>
                </div>

                <div class="timeline-item">
                    <div class="timeline-year">1983</div>
                    <div class="timeline-content">
                        <div class="flex items-center mb-3">
                            <div class="bg-primary text-white p-2 rounded-full mr-3">
                                <i class="fas fa-expand-arrows-alt"></i>
                            </div>
                            <h3 class="font-bold text-lg text-primary">Pemekaran Desa</h3>
                        </div>
                        <p class="text-gray-600">
                            Karena luas wilayah yang cukup besar, pada tahun 1983 dilakukan pemekaran desa
                            menjadi dua wilayah administratif, yaitu Desa Cicangkang Hilir dan Desa Sukamulya.
                            Penetapan batas desa dilakukan berdasarkan kondisi alam dan letak geografis.
                        </p>
                    </div>
                </div>

                <div class="timeline-item">
                    <div class="timeline-year">2000</div>
                    <div class="timeline-content">
                        <div class="flex items-center mb-3">
                            <div class="bg-primary text-white p-2 rounded-full mr-3">
                                <i class="fas fa-building"></i>
                            </div>
                            <h3 class="font-bold text-lg text-primary">Penguatan Pemerintahan</h3>
                        </div>
                        <p class="text-gray-600">
                            Desa Cicangkang Hilir mulai mengalami perkembangan dalam tata kelola pemerintahan,
                            pembangunan infrastruktur desa, serta peningkatan pelayanan publik dan partisipasi masyarakat.
                        </p>
                    </div>
                </div>

                <div class="timeline-item">
                    <div class="timeline-year">2020</div>
                    <div class="timeline-content">
                        <div class="flex items-center mb-3">
                            <div class="bg-primary text-white p-2 rounded-full mr-3">
                                <i class="fas fa-laptop-code"></i>
                            </div>
                            <h3 class="font-bold text-lg text-primary">Transformasi Digital</h3>
                        </div>
                        <p class="text-gray-600">
                            Pemerintahan Desa Cicangkang Hilir mengusung visi pembangunan berkelanjutan,
                            transparan, dan berbasis digital melalui penguatan sistem informasi desa
                            serta peningkatan kualitas pelayanan masyarakat.
                        </p>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Navigasi ke Halaman Lain -->
        <div class="text-center mb-12 animate-on-scroll">
            <a href="{{ route('profil.gambaran') }}" 
               class="inline-flex items-center bg-primary text-white px-6 py-3 rounded-lg hover:bg-secondary 
                      transition duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-1">
                <i class="fas fa-map mr-2"></i>
                Lihat Gambaran Umum Desa
            </a>
        </div>

        <!-- Potensi & Budaya -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 md:gap-8 mb-12">
            <!-- Potensi Desa -->
            <div class="bg-white rounded-2xl shadow-lg p-6 animate-on-scroll">
                <div class="flex items-center mb-6">
                    <div class="bg-green-100 text-accent p-3 rounded-full mr-4">
                        <i class="fas fa-seedling text-xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-dark">Potensi Desa</h3>
                </div>
                
                <div class="space-y-4">
                    <div class="flex items-start bg-green-50 p-4 rounded-xl hover:bg-green-100 transition-colors duration-200">
                        <div class="bg-accent text-white p-3 rounded-lg mr-4">
                            <i class="fas fa-tractor"></i>
                        </div>
                        <div>
                            <h4 class="font-bold text-dark mb-1">Pertanian & Perkebunan</h4>
                            <p class="text-gray-600 text-sm">
                                Komoditas utama: padi, palawija, sayuran, dan buah-buahan lokal.
                                Didukung oleh irigasi yang memadai dan tanah yang subur.
                            </p>
                        </div>
                    </div>
                    
                    <div class="flex items-start bg-blue-50 p-4 rounded-xl hover:bg-blue-100 transition-colors duration-200">
                        <div class="bg-primary text-white p-3 rounded-lg mr-4">
                            <i class="fas fa-store"></i>
                        </div>
                        <div>
                            <h4 class="font-bold text-dark mb-1">UMKM Lokal</h4>
                            <p class="text-gray-600 text-sm">
                                Kerajinan tangan, makanan tradisional, dan usaha mikro kreatif.
                                Berkembang pesat dengan dukungan pelatihan dan pemasaran digital.
                            </p>
                        </div>
                    </div>
                    
                    <div class="flex items-start bg-yellow-50 p-4 rounded-xl hover:bg-yellow-100 transition-colors duration-200">
                        <div class="bg-yellow-600 text-white p-3 rounded-lg mr-4">
                            <i class="fas fa-tree"></i>
                        </div>
                        <div>
                            <h4 class="font-bold text-dark mb-1">Potensi Wisata</h4>
                            <p class="text-gray-600 text-sm">
                                Wisata alam, agrowisata, dan wisata budaya.
                                Menyuguhkan panorama alam yang indah dan budaya Sunda yang khas.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Budaya & Adat -->
            <div class="bg-white rounded-2xl shadow-lg p-6 animate-on-scroll" style="animation-delay: 0.1s">
                <div class="flex items-center mb-6">
                    <div class="bg-purple-100 text-purple-600 p-3 rounded-full mr-4">
                        <i class="fas fa-mask text-xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-dark">Budaya & Adat Istiadat</h3>
                </div>
                
                <div class="space-y-4">
                    <div class="flex items-start bg-purple-50 p-4 rounded-xl hover:bg-purple-100 transition-colors duration-200">
                        <div class="bg-purple-600 text-white p-3 rounded-lg mr-4">
                            <i class="fas fa-calendar-day"></i>
                        </div>
                        <div>
                            <h4 class="font-bold text-dark mb-1">Upacara Adat</h4>
                            <p class="text-gray-600 text-sm">
                                Seren taun, pernikahan adat, dan ritual pertanian masih dilestarikan.
                                Menjadi bagian integral dari kehidupan masyarakat.
                            </p>
                        </div>
                    </div>
                    
                    <div class="flex items-start bg-red-50 p-4 rounded-xl hover:bg-red-100 transition-colors duration-200">
                        <div class="bg-red-600 text-white p-3 rounded-lg mr-4">
                            <i class="fas fa-music"></i>
                        </div>
                        <div>
                            <h4 class="font-bold text-dark mb-1">Kesenian Tradisional</h4>
                            <p class="text-gray-600 text-sm">
                                Jaipongan, wayang golek, dan seni musik tradisional Sunda.
                                Dilestarikan melalui sanggar seni dan kegiatan budaya.
                            </p>
                        </div>
                    </div>
                    
                    <div class="flex items-start bg-indigo-50 p-4 rounded-xl hover:bg-indigo-100 transition-colors duration-200">
                        <div class="bg-indigo-600 text-white p-3 rounded-lg mr-4">
                            <i class="fas fa-hands-helping"></i>
                        </div>
                        <div>
                            <h4 class="font-bold text-dark mb-1">Gotong Royong</h4>
                            <p class="text-gray-600 text-sm">
                                Tradisi mapag sri, ngabuburit bersama, dan kerja bakti rutin.
                                Menjadi fondasi kekuatan sosial masyarakat.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Silsilah Kepala Desa -->
    <div class="bg-gradient-to-r from-primary-light to-blue-50 py-12">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white rounded-2xl shadow-xl p-6 md:p-8 animate-on-scroll">
                <div class="flex items-center mb-8">
                    <div class="bg-primary text-white p-3 rounded-full mr-4 shadow-lg">
                        <i class="fas fa-users-crown text-xl"></i>
                    </div>
                    <div>
                        <h2 class="text-2xl md:text-3xl font-bold text-primary">
                            Silsilah Kepala Desa Cicangkang Hilir
                        </h2>
                        <p class="text-gray-500 mt-1">Kepemimpinan dari masa ke masa (1965 - Sekarang)</p>
                    </div>
                </div>

                <div class="overflow-x-auto rounded-xl border border-gray-200 shadow-sm">
                    <table class="history-table min-w-full">
                        <thead>
                            <tr>
                                <th class="px-6 py-4 text-left text-white font-semibold text-sm">
                                    <div class="flex items-center">
                                        <i class="fas fa-hashtag mr-2"></i>
                                        No
                                    </div>
                                </th>
                                <th class="px-6 py-4 text-left text-white font-semibold text-sm">
                                    <div class="flex items-center">
                                        <i class="fas fa-user-tie mr-2"></i>
                                        Nama Kepala Desa
                                    </div>
                                </th>
                                <th class="px-6 py-4 text-left text-white font-semibold text-sm">
                                    <div class="flex items-center">
                                        <i class="fas fa-badge-check mr-2"></i>
                                        Status
                                    </div>
                                </th>
                                <th class="px-6 py-4 text-left text-white font-semibold text-sm">
                                    <div class="flex items-center">
                                        <i class="fas fa-calendar-alt mr-2"></i>
                                        Masa Jabatan
                                    </div>
                                </th>
                                <th class="px-6 py-4 text-left text-white font-semibold text-sm">
                                    <div class="flex items-center">
                                        <i class="fas fa-comment-alt mr-2"></i>
                                        Keterangan / Motto
                                    </div>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white">
                            @php
                                $kepalaDesa = [
                                    ['no' => 1, 'nama' => 'Asturi', 'status' => 'Penjabat', 'masa_jabatan' => '1965', 'keterangan' => 'Awal pemerintahan desa'],
                                    ['no' => 2, 'nama' => 'Atang Suryana', 'status' => 'Penjabat', 'masa_jabatan' => '1966 – 1968', 'keterangan' => '—'],
                                    ['no' => 3, 'nama' => 'E. Kartawiria', 'status' => 'Definitif', 'masa_jabatan' => '1969 – 1980', 'keterangan' => '—'],
                                    ['no' => 4, 'nama' => 'Kasan', 'status' => 'Penjabat', 'masa_jabatan' => '1981 – 1983', 'keterangan' => 'Masa pemekaran desa'],
                                    ['no' => 5, 'nama' => 'H. T. Apipudin', 'status' => 'Definitif', 'masa_jabatan' => '1984 – 1992', 'keterangan' => '—'],
                                    ['no' => 6, 'nama' => 'A. Nurdin', 'status' => 'Penjabat', 'masa_jabatan' => '1992 – 1993', 'keterangan' => '—'],
                                    ['no' => 7, 'nama' => 'H. T. Apipudin', 'status' => 'Definitif', 'masa_jabatan' => '1993 – 2001', 'keterangan' => '—'],
                                    ['no' => 8, 'nama' => 'Ai Hadiyati', 'status' => 'Definitif', 'masa_jabatan' => '2002 – 2004', 'keterangan' => '—'],
                                    ['no' => 9, 'nama' => 'Anda Ansori', 'status' => 'Penjabat', 'masa_jabatan' => '2005 – 2006', 'keterangan' => '—'],
                                    ['no' => 10, 'nama' => 'Ajat', 'status' => 'Definitif', 'masa_jabatan' => '2006 – 2012', 'keterangan' => 'Cicangkanghilir "BERWACANA"'],
                                    ['no' => 11, 'nama' => 'Taufik Darmawan', 'status' => 'Penjabat', 'masa_jabatan' => '2012 – 2013', 'keterangan' => '—'],
                                    ['no' => 12, 'nama' => 'Suherman', 'status' => 'Definitif', 'masa_jabatan' => '2013 – 2019', 'keterangan' => 'Cicangkanghilir "JADI"'],
                                    ['no' => 13, 'nama' => 'Agus Hermawan', 'status' => 'Penjabat', 'masa_jabatan' => '2019', 'keterangan' => '—'],
                                    ['no' => 14, 'nama' => 'Suherman', 'status' => 'Definitif', 'masa_jabatan' => '2020 – 2026', 'keterangan' => '"Cicangkanghilir Jadi Hebat – NGACIR"'],
                                    ['no' => 15, 'nama' => 'Wawan, S.Sos', 'status' => 'Penjabat', 'masa_jabatan' => '2023 – 2024', 'keterangan' => 'Kepala Desa Penjabat'],
                                ];
                            @endphp
                            
                            @foreach ($kepalaDesa as $item)
                                <tr class="{{ $item['no'] % 2 == 0 ? 'bg-gray-50' : 'bg-white' }}">
                                    <td class="px-6 py-4 text-center font-medium text-gray-700">
                                        {{ $item['no'] }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center">
                                            <div class="w-8 h-8 rounded-full bg-primary-light flex items-center justify-center mr-3">
                                                <i class="fas fa-user text-primary text-sm"></i>
                                            </div>
                                            <span class="font-medium text-dark">{{ $item['nama'] }}</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="px-3 py-1 rounded-full text-xs font-medium 
                                            {{ $item['status'] == 'Definitif' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                            {{ $item['status'] }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 font-medium text-gray-700">
                                        {{ $item['masa_jabatan'] }}
                                    </td>
                                    <td class="px-6 py-4 text-gray-600">
                                        {{ $item['keterangan'] }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                
                <div class="mt-8 pt-6 border-t border-gray-200">
                    <div class="flex items-center text-sm text-gray-500">
                        <i class="fas fa-info-circle text-primary mr-2"></i>
                        <span>Data ini diperbarui terakhir pada {{ date('d F Y') }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Navigasi ke halaman lain -->
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="bg-gradient-to-r from-primary to-secondary rounded-2xl p-6 md:p-8 shadow-xl animate-on-scroll">
            <div class="text-center mb-8">
                <h2 class="text-2xl md:text-3xl font-bold text-white mb-3">
                    Jelajahi Lebih Lanjut
                </h2>
                <p class="text-white/90 max-w-2xl mx-auto">
                    Temukan informasi lainnya tentang Desa Cicangkang Hilir
                </p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <a href="{{ route('profil.visi-misi') }}" 
                   class="bg-white bg-opacity-95 p-6 rounded-xl hover:bg-opacity-100 transition-all duration-300 
                          text-center hover:transform hover:-translate-y-2 shadow-lg hover:shadow-2xl group">
                    <div class="bg-primary/10 text-primary p-3 rounded-full inline-flex mb-4 group-hover:bg-primary group-hover:text-white transition-colors duration-300">
                        <i class="fas fa-bullseye text-2xl"></i>
                    </div>
                    <h3 class="font-bold text-dark text-lg mb-2">Visi & Misi</h3>
                    <p class="text-gray-600 text-sm mb-3">Lihat arah pembangunan desa</p>
                    <div class="inline-flex items-center text-primary text-sm font-medium group-hover:text-secondary transition-colors duration-300">
                        Jelajahi
                        <i class="fas fa-arrow-right ml-2 group-hover:translate-x-1 transition-transform duration-300"></i>
                    </div>
                </a>
                
                <a href="{{ route('profil.struktur') }}" 
                   class="bg-white bg-opacity-95 p-6 rounded-xl hover:bg-opacity-100 transition-all duration-300 
                          text-center hover:transform hover:-translate-y-2 shadow-lg hover:shadow-2xl group">
                    <div class="bg-primary/10 text-primary p-3 rounded-full inline-flex mb-4 group-hover:bg-primary group-hover:text-white transition-colors duration-300">
                        <i class="fas fa-sitemap text-2xl"></i>
                    </div>
                    <h3 class="font-bold text-dark text-lg mb-2">Struktur Pemerintahan</h3>
                    <p class="text-gray-600 text-sm mb-3">Kenali aparatur desa</p>
                    <div class="inline-flex items-center text-primary text-sm font-medium group-hover:text-secondary transition-colors duration-300">
                        Jelajahi
                        <i class="fas fa-arrow-right ml-2 group-hover:translate-x-1 transition-transform duration-300"></i>
                    </div>
                </a>
                
                <a href="{{ route('layanan.prosedur') }}" 
                   class="bg-white bg-opacity-95 p-6 rounded-xl hover:bg-opacity-100 transition-all duration-300 
                          text-center hover:transform hover:-translate-y-2 shadow-lg hover:shadow-2xl group">
                    <div class="bg-primary/10 text-primary p-3 rounded-full inline-flex mb-4 group-hover:bg-primary group-hover:text-white transition-colors duration-300">
                        <i class="fas fa-clipboard-list text-2xl"></i>
                    </div>
                    <h3 class="font-bold text-dark text-lg mb-2">Layanan Desa</h3>
                    <p class="text-gray-600 text-sm mb-3">Akses layanan publik</p>
                    <div class="inline-flex items-center text-primary text-sm font-medium group-hover:text-secondary transition-colors duration-300">
                        Jelajahi
                        <i class="fas fa-arrow-right ml-2 group-hover:translate-x-1 transition-transform duration-300"></i>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Animation on scroll
    document.addEventListener('DOMContentLoaded', function() {
        const animateElements = document.querySelectorAll('.animate-on-scroll');
        
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                }
            });
        }, {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        });
        
        animateElements.forEach(element => {
            observer.observe(element);
        });
        
        // Smooth scroll to timeline items
        document.querySelectorAll('.timeline-item').forEach((item, index) => {
            item.addEventListener('click', function() {
                const content = this.querySelector('.timeline-content');
                content.classList.toggle('bg-primary-light');
                
                // Reset other items
                document.querySelectorAll('.timeline-item').forEach((otherItem, otherIndex) => {
                    if (otherIndex !== index) {
                        otherItem.querySelector('.timeline-content').classList.remove('bg-primary-light');
                    }
                });
            });
        });
        
        // Add hover effect to table rows
        const tableRows = document.querySelectorAll('.history-table tbody tr');
        tableRows.forEach(row => {
            row.addEventListener('mouseenter', function() {
                this.style.boxShadow = '0 4px 6px rgba(0, 0, 0, 0.1)';
            });
            
            row.addEventListener('mouseleave', function() {
                this.style.boxShadow = 'none';
            });
        });
    });
</script>
@endpush