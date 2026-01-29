@extends('layouts.home-app')

@section('title', 'Struktur Pemerintahan - Desa Cicangkang Hilir')

@push('styles')
    <style>
        /* Mermaid chart styling */
        .mermaid {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            width: 100%;
            overflow-x: auto;
            background: white;
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        /* Person card hover effects */
        .person-card {
            transition: all 0.3s ease;
            position: relative;
            z-index: 1;
        }

        .person-card:hover {
            transform: translateY(-5px);
            z-index: 10;
        }

        /* Custom scrollbar for mermaid container */
        .mermaid::-webkit-scrollbar {
            height: 8px;
            width: 8px;
        }

        .mermaid::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 4px;
        }

        .mermaid::-webkit-scrollbar-thumb {
            background: #888;
            border-radius: 4px;
        }

        .mermaid::-webkit-scrollbar-thumb:hover {
            background: #555;
        }

        /* Animation classes */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fade-in {
            animation: fadeIn 0.6s ease-out forwards;
        }

        .hover-lift {
            transition: all 0.3s ease;
        }

        .hover-lift:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
        }
    </style>
@endpush

@section('content')
    <div class="min-h-screen bg-gray-50">
        <!-- Breadcrumb -->
        <div class="bg-white border-b border-gray-100">
            <div class="container mx-auto px-4 py-4">
                <nav class="flex" aria-label="Breadcrumb">
                    <ol class="inline-flex items-center space-x-1 md:space-x-3">
                        <li class="inline-flex items-center">
                            <a href="{{ route('landing-page') }}"
                                class="inline-flex items-center text-sm text-gray-700 hover:text-primary transition-colors">
                                <i class="fas fa-home mr-2"></i>
                                Beranda
                            </a>
                        </li>
                        <li>
                            <div class="flex items-center">
                                <i class="fas fa-chevron-right text-gray-400 mx-2"></i>
                                <a href="{{ route('profil.visi-misi') }}"
                                    class="text-sm text-gray-700 hover:text-primary transition-colors">
                                    Profil Desa
                                </a>
                            </div>
                        </li>
                        <li aria-current="page">
                            <div class="flex items-center">
                                <i class="fas fa-chevron-right text-gray-400 mx-2"></i>
                                <span class="ml-1 text-sm text-primary font-semibold md:ml-2">
                                    Struktur Pemerintahan
                                </span>
                            </div>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>

        <!-- Hero Section -->
        <div class="bg-gradient-to-r from-blue-50 to-indigo-50">
            <div class="container mx-auto px-4 py-12">
                <div class="text-center max-w-3xl mx-auto">
                    <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4 animate-fade-in">
                        Struktur Pemerintahan Desa
                    </h1>
                    <p class="text-gray-600 text-lg leading-relaxed animate-fade-in" style="animation-delay: 0.1s">
                        Struktur organisasi dan perangkat desa yang mengelola pemerintahan Desa Cicangkang Hilir
                    </p>
                    <div class="mt-6 flex items-center justify-center space-x-4 text-sm text-gray-500 animate-fade-in"
                        style="animation-delay: 0.2s">
                        <div class="flex items-center">
                            <i class="fas fa-calendar-alt mr-2"></i>
                            <span>Periode {{ date('Y') }}-{{ date('Y') + 5 }}</span>
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-map-marker-alt mr-2"></i>
                            <span>Desa Cicangkang Hilir</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="container mx-auto px-4 py-8">
            <!-- Organization Chart Header -->
            <div class="bg-white rounded-2xl shadow-lg p-6 mb-8 animate-fade-in">
                <div class="flex flex-col md:flex-row md:items-center justify-between mb-6 gap-4">
                    <div class="flex items-center">
                        <div class="bg-blue-600 text-white p-3 rounded-full mr-4">
                            <i class="fas fa-sitemap text-xl"></i>
                        </div>
                        <div>
                            <h2 class="text-2xl font-bold text-gray-900">
                                Struktur Organisasi Pemerintahan Desa
                            </h2>
                            <p class="text-gray-600 mt-1">
                                Tata kelola pemerintahan Desa Cicangkang Hilir
                            </p>
                        </div>
                    </div>

                    <div class="flex items-center space-x-4">
                        <div class="bg-blue-100 text-blue-700 px-4 py-2 rounded-lg">
                            <div class="text-sm font-semibold">Total Personil</div>
                            <div class="text-xl font-bold">14</div>
                        </div>
                    </div>
                </div>

                <!-- Mermaid Organization Chart -->
                <div class="relative mt-8">
                    <div class="mermaid">
                        flowchart TD
                        %% Define styling classes
                        classDef kepalaDesa fill:#1e40af,color:white,stroke:#1e3a8a,stroke-width:2px
                        classDef sekretaris fill:#3b82f6,color:white,stroke:#2563eb,stroke-width:2px
                        classDef kasi fill:#8b5cf6,color:white,stroke:#7c3aed,stroke-width:2px
                        classDef kaur fill:#7c3aed,color:white,stroke:#6d28d9,stroke-width:2px
                        classDef kadus fill:#10b981,color:white,stroke:#059669,stroke-width:2px
                        classDef bpd fill:#f59e0b,color:white,stroke:#d97706,stroke-width:2px

                        %% BPD Section
                        BPD["Ketua BPD\nASEP SETIAWAN\n\n<i class='fas fa-users'></i>\nBadan Permusyawaratan Desa"]
                        class BPD bpd

                        %% Pemerintah Desa
                        KEPALA["<b>KEPALA DESA</b>\nWAWAN, S.Sos\n\n<i class='fas fa-crown'></i>\nPemimpin Desa"]
                        class KEPALA kepalaDesa

                        %% Sekretariat
                        SEKRETARIS["<b>SEKRETARIS DESA</b>\nAGUS SUPRIATNA\n\n<i class='fas fa-user-tie'></i>\nKoordinator"]
                        class SEKRETARIS sekretaris

                        KAUR_TU["Kaur T.U & Umum\nHOERUDIN\n\n<i class='fas fa-file-alt'></i>\nAdministrasi"]
                        class KAUR_TU kaur

                        KAUR_PERENCANAAN["Kaur Perencanaan\nAGUNG SUPRIYADI\n\n<i
                            class='fas fa-chart-line'></i>\nPerencanaan"]
                        class KAUR_PERENCANAAN kaur

                        KAUR_KEUANGAN["Kaur Keuangan\nAJID JAENUDIN\n\n<i class='fas fa-money-bill-wave'></i>\nKeuangan"]
                        class KAUR_KEUANGAN kaur

                        %% Kasi Section
                        KASI_PEMERINTAHAN["<b>Kasi Pemerintahan</b>\nTAUFIK DARMAWAN\n\n<i
                            class='fas fa-landmark'></i>\nPemerintahan"]
                        class KASI_PEMERINTAHAN kasi

                        KASI_KESRA["<b>Kasi Kesra</b>\nASEP NURJAMAN\n\n<i
                            class='fas fa-hand-holding-heart'></i>\nKesejahteraan"]
                        class KASI_KESRA kasi

                        KASI_PELAYANAN["<b>Kasi Pelayanan</b>\nGUNAWAN SAPUTRA\n\n<i
                            class='fas fa-concierge-bell'></i>\nPelayanan"]
                        class KASI_PELAYANAN kasi

                        %% Kadus Section
                        KADUS1["<b>Kadus I</b>\nSARIPUDIN\nDusun Cicangkang\n\n<i class='fas fa-map-marker-alt'></i>\n5 RT"]
                        class KADUS1 kadus

                        KADUS2["<b>Kadus II</b>\nDEDEN MURDANI\nDusun Pasirhuni\n\n<i class='fas fa-map-marker-alt'></i>\n4
                        RT"]
                        class KADUS2 kadus

                        KADUS3["<b>Kadus III</b>\nADE KOSASIH\nDusun Cibodas\n\n<i class='fas fa-map-marker-alt'></i>\n3
                        RT"]
                        class KADUS3 kadus

                        KADUS4["<b>Kadus IV</b>\nUNANG R\nDusun Sukamulya\n\n<i class='fas fa-map-marker-alt'></i>\n4 RT"]
                        class KADUS4 kadus

                        %% Relationships
                        BPD -- Pengawasan --> KEPALA

                        KEPALA --> SEKRETARIS
                        KEPALA --> KASI_PEMERINTAHAN
                        KEPALA --> KASI_KESRA
                        KEPALA --> KASI_PELAYANAN

                        SEKRETARIS --> KAUR_TU
                        SEKRETARIS --> KAUR_PERENCANAAN
                        SEKRETARIS --> KAUR_KEUANGAN

                        KASI_KESRA --> KADUS1
                        KASI_KESRA --> KADUS2
                        KASI_KESRA --> KADUS3
                        KASI_KESRA --> KADUS4

                        %% Layout improvements
                        subgraph "Badan Permusyawaratan Desa"
                        BPD
                        end

                        subgraph "Pemerintah Desa"
                        subgraph " "
                        KEPALA
                        end

                        subgraph "Sekretariat Desa"
                        SEKRETARIS

                        subgraph "Kepala Urusan"
                        KAUR_TU
                        KAUR_PERENCANAAN
                        KAUR_KEUANGAN
                        end
                        end

                        subgraph "Bidang Pemerintahan"
                        KASI_PEMERINTAHAN

                        subgraph "Kepala Dusun"
                        KADUS1
                        KADUS2
                        KADUS3
                        KADUS4
                        end
                        end

                        subgraph "Bidang Kesejahteraan"
                        KASI_KESRA
                        end

                        subgraph "Bidang Pelayanan"
                        KASI_PELAYANAN
                        end
                        end
                    </div>
                </div>

                <!-- Legend -->
                <div class="mt-12 pt-8 border-t border-gray-200">
                    <h3 class="font-bold text-lg text-gray-800 mb-4 flex items-center">
                        <i class="fas fa-key mr-2 text-blue-600"></i>Keterangan Warna
                    </h3>
                    <div class="grid grid-cols-2 md:grid-cols-5 gap-4">
                        <div class="flex items-center">
                            <div class="w-4 h-4 bg-blue-800 rounded mr-2"></div>
                            <span class="text-sm text-gray-700">Kepala Desa</span>
                        </div>
                        <div class="flex items-center">
                            <div class="w-4 h-4 bg-blue-500 rounded mr-2"></div>
                            <span class="text-sm text-gray-700">Sekretaris</span>
                        </div>
                        <div class="flex items-center">
                            <div class="w-4 h-4 bg-indigo-500 rounded mr-2"></div>
                            <span class="text-sm text-gray-700">Kasi & Kaur</span>
                        </div>
                        <div class="flex items-center">
                            <div class="w-4 h-4 bg-emerald-500 rounded mr-2"></div>
                            <span class="text-sm text-gray-700">Kepala Dusun</span>
                        </div>
                        <div class="flex items-center">
                            <div class="w-4 h-4 bg-amber-500 rounded mr-2"></div>
                            <span class="text-sm text-gray-700">BPD</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Detail Personil -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <!-- Kepala Desa -->
                <div class="person-card bg-white rounded-xl shadow-md p-6 text-center border-2 border-blue-800">
                    <div class="bg-blue-800 text-white text-xs font-bold px-3 py-1 rounded-full inline-block mb-4">
                        KEPALA DESA
                    </div>
                    <div
                        class="w-20 h-20 bg-gradient-to-br from-blue-800 to-blue-600 rounded-full mx-auto mb-4 flex items-center justify-center text-white text-2xl">
                        <i class="fas fa-crown"></i>
                    </div>
                    <h4 class="font-bold text-lg text-gray-900 mb-1">WAWAN, S.Sos</h4>
                    <p class="text-gray-600 text-sm mb-4">Kepala Desa Cicangkang Hilir</p>
                    <div class="text-xs text-gray-500 border-t border-gray-100 pt-3">
                        <div class="flex items-center justify-center mb-1">
                            <i class="fas fa-calendar mr-2"></i>
                            <span>Periode: 2020-2025</span>
                        </div>
                    </div>
                </div>

                <!-- Sekretaris -->
                <div class="person-card bg-white rounded-xl shadow-md p-6 text-center border-2 border-blue-500">
                    <div class="bg-blue-500 text-white text-xs font-bold px-3 py-1 rounded-full inline-block mb-4">
                        SEKRETARIS DESA
                    </div>
                    <div
                        class="w-20 h-20 bg-gradient-to-br from-blue-500 to-blue-400 rounded-full mx-auto mb-4 flex items-center justify-center text-white text-2xl">
                        <i class="fas fa-user-tie"></i>
                    </div>
                    <h4 class="font-bold text-lg text-gray-900 mb-1">AGUS SUPRIATNA</h4>
                    <p class="text-gray-600 text-sm mb-4">Sekretaris Desa</p>
                    <div class="text-xs text-gray-500 border-t border-gray-100 pt-3">
                        <div class="flex items-center justify-center">
                            <i class="fas fa-tasks mr-2"></i>
                            <span>3 Kaur di bawah</span>
                        </div>
                    </div>
                </div>

                <!-- Kasi -->
                <div class="person-card bg-white rounded-xl shadow-md p-6 text-center border-2 border-indigo-500">
                    <div class="bg-indigo-500 text-white text-xs font-bold px-3 py-1 rounded-full inline-block mb-4">
                        KASI PEMERINTAHAN
                    </div>
                    <div
                        class="w-20 h-20 bg-gradient-to-br from-indigo-500 to-purple-400 rounded-full mx-auto mb-4 flex items-center justify-center text-white text-2xl">
                        <i class="fas fa-landmark"></i>
                    </div>
                    <h4 class="font-bold text-lg text-gray-900 mb-1">TAUFIK DARMAWAN</h4>
                    <p class="text-gray-600 text-sm mb-4">Bidang Pemerintahan</p>
                    <div class="text-xs text-gray-500 border-t border-gray-100 pt-3">
                        <div class="flex items-center justify-center">
                            <i class="fas fa-users mr-2"></i>
                            <span>4 Kadus di bawah</span>
                        </div>
                    </div>
                </div>

                <!-- BPD -->
                <div class="person-card bg-white rounded-xl shadow-md p-6 text-center border-2 border-amber-500">
                    <div class="bg-amber-500 text-white text-xs font-bold px-3 py-1 rounded-full inline-block mb-4">
                        KETUA BPD
                    </div>
                    <div
                        class="w-20 h-20 bg-gradient-to-br from-amber-500 to-yellow-400 rounded-full mx-auto mb-4 flex items-center justify-center text-white text-2xl">
                        <i class="fas fa-users"></i>
                    </div>
                    <h4 class="font-bold text-lg text-gray-900 mb-1">ASEP SETIAWAN</h4>
                    <p class="text-gray-600 text-sm mb-4">Badan Permusyawaratan Desa</p>
                    <div class="text-xs text-gray-500 border-t border-gray-100 pt-3">
                        <div class="flex items-center justify-center">
                            <i class="fas fa-shield-alt mr-2"></i>
                            <span>Pengawasan & Aspirasi</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tugas & Fungsi -->
            <div class="bg-white rounded-2xl shadow-lg p-6 md:p-8 mb-8 animate-fade-in" style="animation-delay: 0.1s">
                <div class="flex items-center mb-6">
                    <div class="bg-blue-600 text-white p-3 rounded-full mr-4">
                        <i class="fas fa-tasks text-xl"></i>
                    </div>
                    <h2 class="text-2xl font-bold text-gray-900">Tugas dan Fungsi Perangkat Desa</h2>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <!-- Column 1 -->
                    <div class="space-y-6">
                        <!-- BPD -->
                        <div class="border-l-4 border-amber-500 pl-4">
                            <h3 class="font-bold text-lg text-gray-900 mb-3 flex items-center">
                                <i class="fas fa-users-cog mr-2 text-amber-500"></i>
                                BPD (Badan Permusyawaratan Desa)
                            </h3>
                            <ul class="space-y-2 text-gray-600">
                                <li class="flex items-start">
                                    <span class="w-2 h-2 bg-amber-500 rounded-full mt-2 mr-3 flex-shrink-0"></span>
                                    <span>Menampung dan menyampaikan aspirasi masyarakat</span>
                                </li>
                                <li class="flex items-start">
                                    <span class="w-2 h-2 bg-amber-500 rounded-full mt-2 mr-3 flex-shrink-0"></span>
                                    <span>Mengawasi pelaksanaan kebijakan dan program desa</span>
                                </li>
                                <li class="flex items-start">
                                    <span class="w-2 h-2 bg-amber-500 rounded-full mt-2 mr-3 flex-shrink-0"></span>
                                    <span>Memberi persetujuan terhadap RKPDes dan peraturan desa</span>
                                </li>
                            </ul>
                        </div>

                        <!-- Kepala Desa -->
                        <div class="border-l-4 border-blue-800 pl-4">
                            <h3 class="font-bold text-lg text-gray-900 mb-3 flex items-center">
                                <i class="fas fa-crown mr-2 text-blue-800"></i>
                                Kepala Desa
                            </h3>
                            <ul class="space-y-2 text-gray-600">
                                <li class="flex items-start">
                                    <span class="w-2 h-2 bg-blue-800 rounded-full mt-2 mr-3 flex-shrink-0"></span>
                                    <span>Memimpin penyelenggaraan pemerintahan desa</span>
                                </li>
                                <li class="flex items-start">
                                    <span class="w-2 h-2 bg-blue-800 rounded-full mt-2 mr-3 flex-shrink-0"></span>
                                    <span>Mengkoordinasikan perencanaan dan evaluasi pembangunan</span>
                                </li>
                                <li class="flex items-start">
                                    <span class="w-2 h-2 bg-blue-800 rounded-full mt-2 mr-3 flex-shrink-0"></span>
                                    <span>Membina kerukunan dan ketentraman masyarakat</span>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- Column 2 -->
                    <div class="space-y-6">
                        <!-- Sekretaris & Kaur -->
                        <div class="border-l-4 border-blue-500 pl-4">
                            <h3 class="font-bold text-lg text-gray-900 mb-3 flex items-center">
                                <i class="fas fa-user-tie mr-2 text-blue-500"></i>
                                Sekretaris & Kaur
                            </h3>
                            <div class="space-y-3">
                                <div>
                                    <h4 class="font-semibold text-gray-700 mb-1">Sekretaris Desa</h4>
                                    <p class="text-sm text-gray-600">Mengelola administrasi pemerintahan desa dan
                                        mengkoordinasikan antar seksi</p>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-gray-700 mb-1">Kaur T.U. & Umum</h4>
                                    <p class="text-sm text-gray-600">Menangani tata usaha, pelayanan administrasi, dan
                                        urusan umum</p>
                                </div>
                            </div>
                        </div>

                        <!-- Kasi & Kadus -->
                        <div class="border-l-4 border-emerald-500 pl-4">
                            <h3 class="font-bold text-lg text-gray-900 mb-3 flex items-center">
                                <i class="fas fa-user-friends mr-2 text-emerald-500"></i>
                                Kasi & Kepala Dusun
                            </h3>
                            <div class="space-y-3">
                                <div>
                                    <h4 class="font-semibold text-gray-700 mb-1">Kasi Pemerintahan</h4>
                                    <p class="text-sm text-gray-600">Urusan pemerintahan, penertiban administrasi,
                                        koordinasi RT/RW</p>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-gray-700 mb-1">Kepala Dusun</h4>
                                    <p class="text-sm text-gray-600">Melaksanakan kegiatan pemerintahan di tingkat dusun
                                        dan membina RT/RW</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Informasi Tambahan -->
            <div class="bg-white rounded-2xl shadow-lg p-6 md:p-8 mb-8 animate-fade-in" style="animation-delay: 0.2s">
                <h3 class="text-xl font-bold text-gray-900 mb-6 flex items-center">
                    <i class="fas fa-info-circle mr-2 text-blue-600"></i>
                    Informasi Tambahan
                </h3>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="bg-blue-50 p-6 rounded-xl">
                        <div class="flex items-center mb-4">
                            <div class="bg-blue-600 text-white p-3 rounded-full mr-4">
                                <i class="fas fa-calendar-alt"></i>
                            </div>
                            <h4 class="font-bold text-lg text-blue-800">Masa Jabatan</h4>
                        </div>
                        <p class="text-gray-600">
                            Masa jabatan perangkat desa mengikuti periode kepemimpinan kepala desa, yaitu 6 tahun dan dapat
                            dipilih kembali untuk satu periode berikutnya.
                        </p>
                    </div>

                    <div class="bg-emerald-50 p-6 rounded-xl">
                        <div class="flex items-center mb-4">
                            <div class="bg-emerald-500 text-white p-3 rounded-full mr-4">
                                <i class="fas fa-users"></i>
                            </div>
                            <h4 class="font-bold text-lg text-emerald-800">Struktur Wilayah</h4>
                        </div>
                        <p class="text-gray-600">
                            Desa Cicangkang Hilir terdiri dari 4 dusun, 16 RT, dan 5 RW. Setiap dusun dipimpin oleh seorang
                            Kepala Dusun yang bertanggung jawab langsung kepada Kepala Desa.
                        </p>
                    </div>

                    <div class="bg-purple-50 p-6 rounded-xl">
                        <div class="flex items-center mb-4">
                            <div class="bg-purple-500 text-white p-3 rounded-full mr-4">
                                <i class="fas fa-chart-line"></i>
                            </div>
                            <h4 class="font-bold text-lg text-purple-800">Evaluasi Kinerja</h4>
                        </div>
                        <p class="text-gray-600">
                            Kinerja perangkat desa dievaluasi secara berkala melalui penilaian kinerja individu dan laporan
                            pertanggungjawaban kepada Badan Permusyawaratan Desa.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Navigasi ke Halaman Lain -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <a href="{{ route('profil.visi-misi') }}"
                    class="bg-white border border-gray-200 rounded-xl p-6 hover:border-blue-600 hover:shadow-lg transition-all duration-300 text-center group hover-lift">
                    <div class="text-blue-600 mb-4 group-hover:scale-110 transition-transform duration-300">
                        <i class="fas fa-bullseye text-4xl"></i>
                    </div>
                    <h3 class="font-bold text-gray-900 mb-2 text-lg">Visi & Misi Desa</h3>
                    <p class="text-gray-600 text-sm">Arah dan tujuan pembangunan desa kami</p>
                    <div class="mt-4 text-blue-600 text-sm font-medium flex items-center justify-center">
                        <span>Lihat detail</span>
                        <i class="fas fa-arrow-right ml-2 group-hover:translate-x-1 transition-transform"></i>
                    </div>
                </a>

                <a href="{{ route('profil.sejarah') }}"
                    class="bg-white border border-gray-200 rounded-xl p-6 hover:border-blue-600 hover:shadow-lg transition-all duration-300 text-center group hover-lift">
                    <div class="text-blue-600 mb-4 group-hover:scale-110 transition-transform duration-300">
                        <i class="fas fa-history text-4xl"></i>
                    </div>
                    <h3 class="font-bold text-gray-900 mb-2 text-lg">Sejarah Desa</h3>
                    <p class="text-gray-600 text-sm">Perjalanan panjang desa dari masa ke masa</p>
                    <div class="mt-4 text-blue-600 text-sm font-medium flex items-center justify-center">
                        <span>Pelajari sejarah</span>
                        <i class="fas fa-arrow-right ml-2 group-hover:translate-x-1 transition-transform"></i>
                    </div>
                </a>

                <a href="{{ route('layanan.prosedur') }}"
                    class="bg-white border border-gray-200 rounded-xl p-6 hover:border-blue-600 hover:shadow-lg transition-all duration-300 text-center group hover-lift">
                    <div class="text-blue-600 mb-4 group-hover:scale-110 transition-transform duration-300">
                        <i class="fas fa-hands-helping text-4xl"></i>
                    </div>
                    <h3 class="font-bold text-gray-900 mb-2 text-lg">Layanan Desa</h3>
                    <p class="text-gray-600 text-sm">Akses layanan administrasi dan publik</p>
                    <div class="mt-4 text-blue-600 text-sm font-medium flex items-center justify-center">
                        <span>Cari layanan</span>
                        <i class="fas fa-arrow-right ml-2 group-hover:translate-x-1 transition-transform"></i>
                    </div>
                </a>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <!-- Load Mermaid.js -->
    <script src="https://cdn.jsdelivr.net/npm/mermaid@10.6.1/dist/mermaid.min.js"></script>
    <script>
        // Initialize Mermaid
        mermaid.initialize({
            startOnLoad: true,
            theme: 'base',
            themeVariables: {
                primaryColor: '#f3f4f6',
                primaryTextColor: '#374151',
                primaryBorderColor: '#d1d5db',
                lineColor: '#3b82f6',
                secondaryColor: '#6b7280',
                tertiaryColor: '#ffffff'
            },
            flowchart: {
                useMaxWidth: true,
                htmlLabels: true,
                curve: 'basis'
            }
        });

        document.addEventListener('DOMContentLoaded', function() {
            // Smooth scroll untuk internal anchor links
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function(e) {
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

            // Interaksi dengan kartu person
            const personCards = document.querySelectorAll('.person-card');

            personCards.forEach(card => {
                card.addEventListener('click', function() {
                    const name = this.querySelector('h4')?.textContent || '';
                    const position = this.querySelector('.text-xs.font-bold')?.textContent || '';

                    // Tampilkan toast notification
                    showToast(`Melihat detail: ${position} - ${name}`);
                });
            });

            // Fungsi untuk menampilkan toast
            function showToast(message) {
                // Cek jika sudah ada toast
                const existingToast = document.querySelector('.custom-toast');
                if (existingToast) {
                    existingToast.remove();
                }

                // Buat elemen toast
                const toast = document.createElement('div');
                toast.className =
                    'custom-toast fixed bottom-4 right-4 bg-gray-800 text-white px-6 py-3 rounded-lg shadow-lg z-50 animate-fade-in';
                toast.textContent = message;

                document.body.appendChild(toast);

                // Hapus toast setelah 3 detik
                setTimeout(() => {
                    toast.classList.add('opacity-0', 'transition-opacity', 'duration-300');
                    setTimeout(() => toast.remove(), 300);
                }, 3000);
            }

            // Responsive adjustments untuk mermaid chart
            function adjustMermaidChart() {
                const mermaidContainer = document.querySelector('.mermaid');
                if (!mermaidContainer) return;

                if (window.innerWidth < 768) {
                    mermaidContainer.style.overflowX = 'auto';
                    mermaidContainer.style.padding = '10px';
                } else {
                    mermaidContainer.style.overflowX = 'visible';
                    mermaidContainer.style.padding = '20px';
                }
            }

            // Jalankan saat load dan resize
            adjustMermaidChart();
            window.addEventListener('resize', adjustMermaidChart);

            // Animation on scroll
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

            // Observe elements for animation
            document.querySelectorAll('.person-card, .bg-white').forEach(el => {
                observer.observe(el);
            });
        });
    </script>
@endpush
