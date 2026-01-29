@extends('layouts.home-app')

@section('title', 'Visi & Misi - Desa Cicangkang Hilir')

@push('styles')
<style>
    .section-bg {
        background: linear-gradient(135deg, rgba(30, 64, 175, 0.05) 0%, rgba(30, 64, 175, 0.02) 100%);
    }
    
    .mission-list li {
        position: relative;
        padding-left: 1.75rem;
        margin-bottom: 0.75rem;
    }
    
    .mission-list li:before {
        content: "✓";
        position: absolute;
        left: 0;
        color: #10b981;
        font-weight: bold;
        font-size: 1.125rem;
    }
    
    .vision-quote {
        position: relative;
        padding-left: 2rem;
    }
    
    .vision-quote:before {
        content: '"';
        position: absolute;
        left: 0;
        top: -1rem;
        font-size: 4rem;
        color: #1e40af;
        opacity: 0.2;
        font-family: Georgia, serif;
    }
    
    .animate-fade-in-up {
        animation: fadeInUp 0.6s ease-out;
    }
    
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
    
    .hover-lift {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    
    .hover-lift:hover {
        transform: translateY(-5px);
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
    }
</style>
@endpush

@section('content')
<div class="pt-6">
    <!-- Breadcrumb -->
    <div class="bg-white border-b border-gray-100">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-4">
            <nav class="flex" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-3">
                    <li class="inline-flex items-center">
                        <a href="{{ route('landing-page') }}" 
                           class="inline-flex items-center text-sm text-gray-700 hover:text-primary transition-colors duration-200">
                            <i class="fas fa-home mr-2"></i>
                            Beranda
                        </a>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <i class="fas fa-chevron-right text-gray-400 text-xs mx-2"></i>
                            <a href="#" 
                               class="text-sm text-gray-700 hover:text-primary transition-colors duration-200">
                                Profil Desa
                            </a>
                        </div>
                    </li>
                    <li aria-current="page">
                        <div class="flex items-center">
                            <i class="fas fa-chevron-right text-gray-400 text-xs mx-2"></i>
                            <span class="text-sm text-primary font-medium">Visi & Misi</span>
                        </div>
                    </li>
                </ol>
            </nav>
        </div>
    </div>

    <!-- Hero Section -->
    <div class="section-bg py-12 md:py-16">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto animate-fade-in-up">
                <div class="inline-flex items-center justify-center w-16 h-16 bg-primary text-white rounded-full mb-6">
                    <i class="fas fa-bullseye text-2xl"></i>
                </div>
                <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold text-primary mb-4">
                    Visi & Misi Desa
                </h1>
                <p class="text-lg text-gray-600">
                    Arah dan tujuan pembangunan Desa Cicangkang Hilir menuju masyarakat yang sejahtera, mandiri, dan berbudaya
                </p>
                <div class="mt-6 flex justify-center">
                    <div class="w-24 h-1 bg-primary rounded-full"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Visi Section -->
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-12 md:py-16">
        <div class="max-w-6xl mx-auto">
            <!-- Visi Card -->
            <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-8 md:p-10 mb-12 md:mb-16 animate-fade-in-up hover-lift">
                <div class="flex flex-col md:flex-row md:items-center mb-8">
                    <div class="bg-primary text-white p-3 rounded-xl mr-4 mb-4 md:mb-0">
                        <i class="fas fa-eye text-2xl"></i>
                    </div>
                    <div>
                        <h2 class="text-2xl md:text-3xl font-bold text-primary mb-2">Visi Desa Cicangkang Hilir</h2>
                        <p class="text-gray-600">Pandangan jangka panjang desa dalam mewujudkan cita-cita bersama</p>
                    </div>
                </div>
                
                <div class="bg-gradient-to-r from-primary/5 to-primary/10 border border-primary/20 rounded-xl p-6 md:p-8">
                    <div class="vision-quote mb-8">
                        <h3 class="text-xl md:text-2xl font-bold text-primary italic leading-relaxed">
                            "Terwujudnya Desa Cicangkang Hilir yang Maju, Mandiri, Sejahtera, dan Berbudaya Berbasis Kearifan Lokal"
                        </h3>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                        <!-- Maju -->
                        <div class="bg-white/80 backdrop-blur-sm rounded-xl p-6 border border-gray-200">
                            <div class="flex items-center mb-4">
                                <div class="bg-blue-100 text-primary p-2 rounded-lg mr-3">
                                    <i class="fas fa-chart-line text-lg"></i>
                                </div>
                                <h4 class="font-bold text-lg text-dark">Maju</h4>
                            </div>
                            <p class="text-gray-600">
                                Mengembangkan potensi desa secara optimal dengan memanfaatkan teknologi dan inovasi terkini.
                            </p>
                        </div>
                        
                        <!-- Mandiri -->
                        <div class="bg-white/80 backdrop-blur-sm rounded-xl p-6 border border-gray-200">
                            <div class="flex items-center mb-4">
                                <div class="bg-green-100 text-accent p-2 rounded-lg mr-3">
                                    <i class="fas fa-hands text-lg"></i>
                                </div>
                                <h4 class="font-bold text-lg text-dark">Mandiri</h4>
                            </div>
                            <p class="text-gray-600">
                                Meningkatkan kemampuan masyarakat dalam mengelola sumber daya lokal secara berkelanjutan.
                            </p>
                        </div>
                        
                        <!-- Sejahtera -->
                        <div class="bg-white/80 backdrop-blur-sm rounded-xl p-6 border border-gray-200">
                            <div class="flex items-center mb-4">
                                <div class="bg-yellow-100 text-yellow-600 p-2 rounded-lg mr-3">
                                    <i class="fas fa-hand-holding-heart text-lg"></i>
                                </div>
                                <h4 class="font-bold text-lg text-dark">Sejahtera</h4>
                            </div>
                            <p class="text-gray-600">
                                Meningkatkan kesejahteraan masyarakat melalui pemberdayaan ekonomi dan sosial yang merata.
                            </p>
                        </div>
                        
                        <!-- Berbudaya -->
                        <div class="bg-white/80 backdrop-blur-sm rounded-xl p-6 border border-gray-200">
                            <div class="flex items-center mb-4">
                                <div class="bg-purple-100 text-purple-600 p-2 rounded-lg mr-3">
                                    <i class="fas fa-landmark text-lg"></i>
                                </div>
                                <h4 class="font-bold text-lg text-dark">Berbudaya</h4>
                            </div>
                            <p class="text-gray-600">
                                Melestarikan dan mengembangkan nilai-nilai budaya lokal yang positif dan membangun karakter.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Misi Section -->
            <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-8 md:p-10 animate-fade-in-up hover-lift" 
                 style="animation-delay: 0.1s">
                <div class="flex flex-col md:flex-row md:items-center mb-8">
                    <div class="bg-accent text-white p-3 rounded-xl mr-4 mb-4 md:mb-0">
                        <i class="fas fa-bullseye-arrow text-2xl"></i>
                    </div>
                    <div>
                        <h2 class="text-2xl md:text-3xl font-bold text-primary mb-2">Misi Desa Cicangkang Hilir</h2>
                        <p class="text-gray-600">Langkah-langkah strategis untuk mewujudkan visi desa</p>
                    </div>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 md:gap-8">
                    <!-- Misi 1 -->
                    <div class="bg-primary-light rounded-xl p-6 border border-primary/10 hover-lift">
                        <div class="flex items-start mb-4">
                            <div class="bg-primary text-white rounded-full w-10 h-10 flex items-center justify-center mr-4 flex-shrink-0">
                                <span class="font-bold text-lg">1</span>
                            </div>
                            <h3 class="text-lg font-bold text-dark">Meningkatkan Pelayanan Publik</h3>
                        </div>
                        <ul class="mission-list">
                            <li class="text-gray-600">Optimalisasi pelayanan administrasi kepada masyarakat</li>
                            <li class="text-gray-600">Transparansi dalam pengelolaan keuangan desa</li>
                            <li class="text-gray-600">Peningkatan sarana dan prasarana pelayanan publik</li>
                            <li class="text-gray-600">Digitalisasi sistem pelayanan desa</li>
                        </ul>
                    </div>
                    
                    <!-- Misi 2 -->
                    <div class="bg-accent-light rounded-xl p-6 border border-accent/10 hover-lift">
                        <div class="flex items-start mb-4">
                            <div class="bg-accent text-white rounded-full w-10 h-10 flex items-center justify-center mr-4 flex-shrink-0">
                                <span class="font-bold text-lg">2</span>
                            </div>
                            <h3 class="text-lg font-bold text-dark">Mengembangkan Ekonomi Masyarakat</h3>
                        </div>
                        <ul class="mission-list">
                            <li class="text-gray-600">Pengembangan potensi ekonomi lokal berkelanjutan</li>
                            <li class="text-gray-600">Pemberdayaan UMKM dan koperasi desa</li>
                            <li class="text-gray-600">Peningkatan ketrampilan dan pelatihan usaha mandiri</li>
                            <li class="text-gray-600">Pengembangan pasar digital produk lokal</li>
                        </ul>
                    </div>
                    
                    <!-- Misi 3 -->
                    <div class="bg-blue-50 rounded-xl p-6 border border-blue-100 hover-lift">
                        <div class="flex items-start mb-4">
                            <div class="bg-blue-600 text-white rounded-full w-10 h-10 flex items-center justify-center mr-4 flex-shrink-0">
                                <span class="font-bold text-lg">3</span>
                            </div>
                            <h3 class="text-lg font-bold text-dark">Meningkatkan Kualitas Pendidikan & Kesehatan</h3>
                        </div>
                        <ul class="mission-list">
                            <li class="text-gray-600">Pendidikan berkualitas untuk semua usia</li>
                            <li class="text-gray-600">Layanan kesehatan yang mudah diakses dan terjangkau</li>
                            <li class="text-gray-600">Program pencegahan stunting dan gizi buruk</li>
                            <li class="text-gray-600">Peningkatan fasilitas pendidikan dan kesehatan</li>
                        </ul>
                    </div>
                    
                    <!-- Misi 4 -->
                    <div class="bg-green-50 rounded-xl p-6 border border-green-100 hover-lift">
                        <div class="flex items-start mb-4">
                            <div class="bg-green-600 text-white rounded-full w-10 h-10 flex items-center justify-center mr-4 flex-shrink-0">
                                <span class="font-bold text-lg">4</span>
                            </div>
                            <h3 class="text-lg font-bold text-dark">Melestarikan Lingkungan & Budaya</h3>
                        </div>
                        <ul class="mission-list">
                            <li class="text-gray-600">Pengelolaan lingkungan berkelanjutan</li>
                            <li class="text-gray-600">Pelestarian adat, tradisi, dan budaya lokal</li>
                            <li class="text-gray-600">Pengembangan wisata berbasis budaya dan alam</li>
                            <li class="text-gray-600">Kampanye lingkungan hidup dan kebersihan</li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Program Unggulan -->
            <div class="mt-12 md:mt-16 animate-fade-in-up" style="animation-delay: 0.2s">
                <div class="text-center mb-10">
                    <h2 class="text-2xl md:text-3xl font-bold text-primary mb-3">Program Unggulan Desa</h2>
                    <p class="text-gray-600 max-w-2xl mx-auto">
                        Implementasi konkret dari visi dan misi dalam program kerja yang bermanfaat bagi masyarakat
                    </p>
                    <div class="mt-4 flex justify-center">
                        <div class="w-16 h-1 bg-accent rounded-full"></div>
                    </div>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 md:gap-8">
                    <!-- Program 1 -->
                    <div class="bg-white rounded-xl shadow-md border border-gray-100 p-6 hover-lift transition-all duration-300">
                        <div class="mb-4">
                            <div class="inline-flex items-center justify-center w-14 h-14 bg-primary/10 text-primary rounded-xl mb-4">
                                <i class="fas fa-hands-helping text-2xl"></i>
                            </div>
                            <h3 class="font-bold text-xl text-dark mb-2">CICANGKANG MANDIRI</h3>
                            <p class="text-gray-600">
                                Program pemberdayaan ekonomi masyarakat melalui pelatihan, pendampingan, dan pengembangan UMKM berbasis potensi lokal.
                            </p>
                        </div>
                        <div class="flex items-center text-sm text-primary font-medium">
                            <span>Pelajari lebih lanjut</span>
                            <i class="fas fa-arrow-right ml-2"></i>
                        </div>
                    </div>
                    
                    <!-- Program 2 -->
                    <div class="bg-white rounded-xl shadow-md border border-gray-100 p-6 hover-lift transition-all duration-300">
                        <div class="mb-4">
                            <div class="inline-flex items-center justify-center w-14 h-14 bg-blue-100 text-blue-600 rounded-xl mb-4">
                                <i class="fas fa-shield-alt text-2xl"></i>
                            </div>
                            <h3 class="font-bold text-xl text-dark mb-2">CICANGKANG AMAN</h3>
                            <p class="text-gray-600">
                                Program peningkatan keamanan dan ketertiban masyarakat melalui sistem keamanan lingkungan terpadu dan patroli rutin.
                            </p>
                        </div>
                        <div class="flex items-center text-sm text-primary font-medium">
                            <span>Pelajari lebih lanjut</span>
                            <i class="fas fa-arrow-right ml-2"></i>
                        </div>
                    </div>
                    
                    <!-- Program 3 -->
                    <div class="bg-white rounded-xl shadow-md border border-gray-100 p-6 hover-lift transition-all duration-300">
                        <div class="mb-4">
                            <div class="inline-flex items-center justify-center w-14 h-14 bg-green-100 text-accent rounded-xl mb-4">
                                <i class="fas fa-heartbeat text-2xl"></i>
                            </div>
                            <h3 class="font-bold text-xl text-dark mb-2">CICANGKANG SEHAT</h3>
                            <p class="text-gray-600">
                                Program kesehatan masyarakat dengan fokus pada pencegahan, layanan kesehatan dasar, dan pola hidup sehat.
                            </p>
                        </div>
                        <div class="flex items-center text-sm text-primary font-medium">
                            <span>Pelajari lebih lanjut</span>
                            <i class="fas fa-arrow-right ml-2"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Additional Programs -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 md:gap-8 mt-8">
                <!-- Program 4 -->
                <div class="bg-gradient-to-r from-primary/5 to-transparent rounded-xl border border-primary/20 p-6">
                    <div class="flex items-center mb-4">
                        <div class="bg-primary text-white p-3 rounded-lg mr-4">
                            <i class="fas fa-leaf text-lg"></i>
                        </div>
                        <h3 class="font-bold text-lg text-dark">CICANGKANG HIJAU</h3>
                    </div>
                    <p class="text-gray-600">
                        Program penghijauan dan pelestarian lingkungan melalui penanaman pohon, pengelolaan sampah, dan konservasi sumber daya alam.
                    </p>
                </div>
                
                <!-- Program 5 -->
                <div class="bg-gradient-to-r from-accent/5 to-transparent rounded-xl border border-accent/20 p-6">
                    <div class="flex items-center mb-4">
                        <div class="bg-accent text-white p-3 rounded-lg mr-4">
                            <i class="fas fa-graduation-cap text-lg"></i>
                        </div>
                        <h3 class="font-bold text-lg text-dark">CICANGKANG CERDAS</h3>
                    </div>
                    <p class="text-gray-600">
                        Program peningkatan kualitas pendidikan melalui beasiswa, taman baca masyarakat, dan pelatihan keterampilan.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- CTA Section -->
    <div class="bg-gradient-to-r from-primary to-secondary mt-12 md:mt-16">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-12 md:py-16">
            <div class="max-w-4xl mx-auto text-center">
                <div class="inline-flex items-center justify-center w-16 h-16 bg-white/20 text-white rounded-full mb-6">
                    <i class="fas fa-hands text-2xl"></i>
                </div>
                <h2 class="text-2xl md:text-3xl font-bold text-white mb-4">
                    Bersama Membangun Desa Cicangkang Hilir
                </h2>
                <p class="text-blue-100 text-lg mb-8 max-w-2xl mx-auto">
                    Visi dan misi ini akan terwujud dengan dukungan dan partisipasi aktif seluruh masyarakat Desa Cicangkang Hilir.
                    Mari bersama-sama mewujudkan desa yang lebih baik untuk generasi mendatang.
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="{{ route('profil.struktur') }}" 
                       class="inline-flex items-center justify-center bg-white text-primary font-bold py-3 px-8 rounded-lg hover:bg-gray-50 transition duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-1">
                        <i class="fas fa-sitemap mr-2"></i>
                        Lihat Struktur Pemerintahan
                    </a>
                    <a href="{{ route('landing-page') }}#kontak" 
                       class="inline-flex items-center justify-center bg-transparent border-2 border-white text-white font-bold py-3 px-8 rounded-lg hover:bg-white/10 transition duration-300">
                        <i class="fas fa-comment-dots mr-2"></i>
                        Hubungi Kami
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Info Section -->
    <div class="bg-gray-50 py-12">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-4xl mx-auto">
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 md:p-8">
                    <div class="flex flex-col md:flex-row items-center">
                        <div class="md:w-1/3 mb-6 md:mb-0">
                            <div class="bg-primary/10 rounded-xl p-6">
                                <i class="fas fa-info-circle text-4xl text-primary"></i>
                            </div>
                        </div>
                        <div class="md:w-2/3 md:pl-8">
                            <h3 class="text-xl font-bold text-dark mb-3">Informasi Penting</h3>
                            <p class="text-gray-600 mb-4">
                                Visi dan misi Desa Cicangkang Hilir ditetapkan melalui musyawarah desa dengan melibatkan seluruh komponen masyarakat. 
                                Implementasinya dipantau secara berkala melalui forum musyawarah desa.
                            </p>
                            <div class="flex items-center text-sm text-gray-500">
                                <i class="fas fa-calendar-alt mr-2"></i>
                                <span>Diperbarui: {{ date('d F Y', strtotime('-1 month')) }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Smooth scroll untuk anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                const href = this.getAttribute('href');
                
                if (href.startsWith('#') && href !== '#') {
                    e.preventDefault();
                    const targetId = href;
                    const targetElement = document.querySelector(targetId);
                    
                    if (targetElement) {
                        window.scrollTo({
                            top: targetElement.offsetTop - 100,
                            behavior: 'smooth'
                        });
                    }
                }
            });
        });
        
        // Animasi saat scroll
        const observerOptions = {
            root: null,
            rootMargin: '0px',
            threshold: 0.1
        };
        
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('animate-fade-in-up');
                }
            });
        }, observerOptions);
        
        // Observe semua card
        document.querySelectorAll('.vision-card, .program-card').forEach(card => {
            observer.observe(card);
        });
    });
</script>
@endpush