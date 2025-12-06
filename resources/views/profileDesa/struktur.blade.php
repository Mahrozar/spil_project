@extends('layouts.home-app')

@section('title', 'Struktur Pemerintahan - Desa Cicangkang Hilir')

@push('styles')
<style>
    .org-chart {
        display: flex;
        flex-direction: column;
        align-items: center;
        position: relative;
    }
    .level-1 {
        margin-bottom: 50px;
    }
    .level-2 {
        display: flex;
        justify-content: center;
        gap: 100px;
        margin-bottom: 50px;
        position: relative;
    }
    .level-2:before {
        content: '';
        position: absolute;
        top: -30px;
        left: 50%;
        transform: translateX(-50%);
        width: 2px;
        height: 30px;
        background: #1e40af;
    }
    .level-3 {
        display: flex;
        justify-content: center;
        gap: 60px;
        flex-wrap: wrap;
        position: relative;
    }
    .level-3-group {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 30px;
    }
    .level-3:before {
        content: '';
        position: absolute;
        top: -30px;
        left: 50%;
        transform: translateX(-50%);
        width: 2px;
        height: 30px;
        background: #1e40af;
    }
    .connector {
        position: absolute;
        background: #1e40af;
    }
    .connector-horizontal {
        height: 2px;
        width: 100%;
        top: -30px;
    }
    .connector-vertical {
        width: 2px;
        height: 30px;
        top: -30px;
        left: 50%;
        transform: translateX(-50%);
    }
    .person-card {
        width: 200px;
        background: white;
        border-radius: 12px;
        padding: 20px;
        text-align: center;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
        border: 2px solid #e5e7eb;
        position: relative;
        z-index: 1;
    }
    .person-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
        border-color: #1e40af;
    }
    .person-card.kepala-desa {
        border-color: #1e40af;
        border-width: 3px;
    }
    .person-card.sekretaris, .person-card.kasi {
        border-color: #3b82f6;
    }
    .person-card.kadus, .person-card.staff {
        border-color: #10b981;
    }
    .photo-placeholder {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        margin: 0 auto 15px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: bold;
        font-size: 24px;
    }
    .position-badge {
        display: inline-block;
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: bold;
        margin-bottom: 10px;
    }
    .badge-kepala {
        background: #1e40af;
        color: white;
    }
    .badge-sekretaris {
        background: #3b82f6;
        color: white;
    }
    .badge-kasi {
        background: #8b5cf6;
        color: white;
    }
    .badge-kadus {
        background: #10b981;
        color: white;
    }
    .badge-staff {
        background: #6b7280;
        color: white;
    }
    @media (max-width: 768px) {
        .level-2 {
            flex-direction: column;
            gap: 40px;
            align-items: center;
        }
        .level-3 {
            flex-direction: column;
            gap: 30px;
            align-items: center;
        }
        .level-3-group {
            width: 100%;
        }
        .person-card {
            width: 100%;
            max-width: 300px;
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
                <h1 class="text-3xl md:text-4xl font-bold text-primary mb-4">Struktur Pemerintahan Desa</h1>
                <p class="text-gray-600 max-w-2xl mx-auto">Struktur organisasi dan perangkat desa yang mengelola pemerintahan Desa Cicangkang Hilir</p>
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
                        <span class="ml-1 text-sm text-primary font-medium md:ml-2">Struktur Pemerintahan</span>
                    </div>
                </li>
            </ol>
        </nav>
    </div>

    <!-- Gambar Struktur (Versi Gambar) -->
    <div class="container mx-auto px-6 py-8">
        <div class="bg-white rounded-xl shadow-md p-8 mb-8">
            <div class="flex items-center justify-between mb-6">
                <div class="flex items-center">
                    <div class="bg-primary text-white p-3 rounded-full mr-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </div>
                    <h2 class="text-2xl font-bold text-primary">Struktur Organisasi Pemerintahan Desa Cicangkang Hilir</h2>
                </div>
                
                <div class="text-sm text-gray-500">
                    Periode {{ date('Y') }}-{{ date('Y') + 5 }}
                </div>
            </div>
            
            <!-- Area untuk Upload/Menampilkan Gambar Struktur -->
            <div class="mb-8">
                <div class="border-2 border-dashed border-gray-300 rounded-xl p-8 text-center bg-gray-50">
                    <div class="text-gray-400 mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-gray-700 mb-2">Gambar Struktur Organisasi Desa</h3>
                    <p class="text-gray-600 mb-4">Tempat untuk menampilkan gambar/foto struktur organisasi pemerintahan Desa Cicangkang Hilir</p>
                    
                    <!-- Tombol Upload (untuk admin) -->
                    @auth
                    <button class="bg-primary text-white px-6 py-2 rounded-lg hover:bg-secondary transition duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
                        </svg>
                        Upload Gambar Baru
                    </button>
                    @endauth
                </div>
                
                <!-- Instruksi untuk mengupload gambar -->
                <div class="mt-4 text-sm text-gray-500 bg-blue-50 p-4 rounded-lg">
                    <p><strong>Instruksi:</strong> Upload gambar struktur organisasi dalam format JPG/PNG dengan resolusi minimal 1200x800 piksel.</p>
                    <p class="mt-1">Pastikan gambar jelas terbaca dan mencantumkan seluruh perangkat desa.</p>
                </div>
            </div>

            <!-- Alternatif: Struktur dalam bentuk teks/diagram -->
            <div class="mb-8">
                <h3 class="text-xl font-bold text-primary mb-4">Diagram Struktur Organisasi</h3>
                
                <div class="org-chart">
                    <!-- Level 1: Kepala Desa -->
                    <div class="level-1">
                        <div class="person-card kepala-desa">
                            <div class="position-badge badge-kepala">KEPALA DESA</div>
                            <div class="photo-placeholder">KD</div>
                            <h4 class="font-bold text-lg">H. DADAN DARMADI, S.IP.</h4>
                            <p class="text-gray-600 text-sm">Kepala Desa Cicangkang Hilir</p>
                            <div class="mt-3 text-xs text-gray-500">
                                <p>Periode: 2020-2025</p>
                            </div>
                        </div>
                    </div>

                    <!-- Level 2: Sekretaris Desa & Kasi -->
                    <div class="level-2">
                        <!-- Sekretaris Desa -->
                        <div class="person-card sekretaris">
                            <div class="position-badge badge-sekretaris">SEKRETARIS DESA</div>
                            <div class="photo-placeholder">SD</div>
                            <h4 class="font-bold text-lg">Drs. ASEP SURYANA</h4>
                            <p class="text-gray-600 text-sm">Sekretaris Desa</p>
                        </div>

                        <!-- Kasi Pemerintahan -->
                        <div class="person-card kasi">
                            <div class="position-badge badge-kasi">KASI PEMERINTAHAN</div>
                            <div class="photo-placeholder">KP</div>
                            <h4 class="font-bold text-lg">ANDRI SETIAWAN, S.Sos.</h4>
                            <p class="text-gray-600 text-sm">Kepala Seksi Pemerintahan</p>
                        </div>

                        <!-- Kasi Kesejahteraan -->
                        <div class="person-card kasi">
                            <div class="position-badge badge-kasi">KASI KESEJAHTERAAN</div>
                            <div class="photo-placeholder">KK</div>
                            <h4 class="font-bold text-lg">NENENG MARYANI, S.Pd.</h4>
                            <p class="text-gray-600 text-sm">Kepala Seksi Kesejahteraan</p>
                        </div>
                    </div>

                    <!-- Level 3: Kepala Dusun & Staff -->
                    <div class="level-3">
                        <!-- Dusun 1 -->
                        <div class="level-3-group">
                            <div class="person-card kadus">
                                <div class="position-badge badge-kadus">KADUS I</div>
                                <div class="photo-placeholder">K1</div>
                                <h4 class="font-bold text-lg">DEDE KOSASIH</h4>
                                <p class="text-gray-600 text-sm">Kepala Dusun Cicangkang</p>
                            </div>
                            
                            <div class="person-card staff">
                                <div class="position-badge badge-staff">STAFF</div>
                                <div class="photo-placeholder">S1</div>
                                <h4 class="font-bold text-lg">SITI AMINAH</h4>
                                <p class="text-gray-600 text-sm">Staff Administrasi</p>
                            </div>
                        </div>

                        <!-- Dusun 2 -->
                        <div class="level-3-group">
                            <div class="person-card kadus">
                                <div class="position-badge badge-kadus">KADUS II</div>
                                <div class="photo-placeholder">K2</div>
                                <h4 class="font-bold text-lg">AJAT SUDRAJAT</h4>
                                <p class="text-gray-600 text-sm">Kepala Dusun Pasirhuni</p>
                            </div>
                            
                            <div class="person-card staff">
                                <div class="position-badge badge-staff">STAFF</div>
                                <div class="photo-placeholder">S2</div>
                                <h4 class="font-bold text-lg">BUDI SANTOSO</h4>
                                <p class="text-gray-600 text-sm">Staff Keuangan</p>
                            </div>
                        </div>

                        <!-- Dusun 3 -->
                        <div class="level-3-group">
                            <div class="person-card kadus">
                                <div class="position-badge badge-kadus">KADUS III</div>
                                <div class="photo-placeholder">K3</div>
                                <h4 class="font-bold text-lg">UJANG HERMAWAN</h4>
                                <p class="text-gray-600 text-sm">Kepala Dusun Cibodas</p>
                            </div>
                            
                            <div class="person-card staff">
                                <div class="position-badge badge-staff">STAFF</div>
                                <div class="photo-placeholder">S3</div>
                                <h4 class="font-bold text-lg">RINI WULANDARI</h4>
                                <p class="text-gray-600 text-sm">Staff Kesejahteraan</p>
                            </div>
                        </div>

                        <!-- Dusun 4 -->
                        <div class="level-3-group">
                            <div class="person-card kadus">
                                <div class="position-badge badge-kadus">KADUS IV</div>
                                <div class="photo-placeholder">K4</div>
                                <h4 class="font-bold text-lg">ADE MULYANA</h4>
                                <p class="text-gray-600 text-sm">Kepala Dusun Sukamulya</p>
                            </div>
                            
                            <div class="person-card staff">
                                <div class="position-badge badge-staff">STAFF</div>
                                <div class="photo-placeholder">S4</div>
                                <h4 class="font-bold text-lg">AGUS SALIM</h4>
                                <p class="text-gray-600 text-sm">Staff Pembangunan</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tugas & Fungsi -->
        <div class="bg-white rounded-xl shadow-md p-8 mb-8">
            <h2 class="text-2xl font-bold text-primary mb-6">Tugas dan Fungsi Perangkat Desa</h2>
            
            <div class="space-y-6">
                <div class="border-l-4 border-primary pl-6 py-2">
                    <h3 class="font-bold text-lg mb-2">Kepala Desa</h3>
                    <ul class="list-disc pl-5 space-y-1 text-gray-600">
                        <li>Memimpin penyelenggaraan pemerintahan desa</li>
                        <li>Mengkoordinasikan pembangunan desa</li>
                        <li>Mewakili desa di dalam dan di luar pengadilan</li>
                        <li>Melaksanakan wewenang yang diberikan oleh Bupati</li>
                    </ul>
                </div>
                
                <div class="border-l-4 border-secondary pl-6 py-2">
                    <h3 class="font-bold text-lg mb-2">Sekretaris Desa</h3>
                    <ul class="list-disc pl-5 space-y-1 text-gray-600">
                        <li>Membantu kepala desa dalam bidang administrasi</li>
                        <li>Mengelola administrasi kependudukan</li>
                        <li>Menyusun program kerja dan laporan</li>
                        <li>Mengelola keuangan dan aset desa</li>
                    </ul>
                </div>
                
                <div class="border-l-4 border-accent pl-6 py-2">
                    <h3 class="font-bold text-lg mb-2">Kepala Seksi</h3>
                    <ul class="list-disc pl-5 space-y-1 text-gray-600">
                        <li>Melaksanakan kegiatan bidang pemerintahan dan kesejahteraan</li>
                        <li>Membina dan mengkoordinasikan LPMD dan karang taruna</li>
                        <li>Melaksanakan urusan pelayanan umum</li>
                        <li>Melaksanakan tugas lain yang diberikan kepala desa</li>
                    </ul>
                </div>
                
                <div class="border-l-4 border-green-500 pl-6 py-2">
                    <h3 class="font-bold text-lg mb-2">Kepala Dusun</h3>
                    <ul class="list-disc pl-5 space-y-1 text-gray-600">
                        <li>Melaksanakan kegiatan pemerintahan di tingkat dusun</li>
                        <li>Membina RT/RW di wilayahnya</li>
                        <li>Mengkoordinasikan pembangunan di dusun</li>
                        <li>Menyampaikan laporan kepada kepala desa</li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Informasi Kontak -->
        <div class="bg-gradient-to-r from-primary to-secondary rounded-xl p-8 text-white">
            <h2 class="text-2xl font-bold mb-6">Kontak Perangkat Desa</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <h3 class="font-bold text-lg mb-4">Kantor Desa Cicangkang Hilir</h3>
                    <div class="space-y-3">
                        <div class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            <span>Jl. Desa Cicangkang Hilir No. 01, Kec. Cipongkor, Kab. Bandung Barat</span>
                        </div>
                        <div class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                            </svg>
                            <span>(022) 1234-5678</span>
                        </div>
                        <div class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                            <span>desa.cicangkanghilir@bandungbaratkab.go.id</span>
                        </div>
                    </div>
                </div>
                
                <div>
                    <h3 class="font-bold text-lg mb-4">Jam Pelayanan</h3>
                    <div class="space-y-2">
                        <div class="flex justify-between">
                            <span>Senin - Kamis</span>
                            <span>08.00 - 15.00 WIB</span>
                        </div>
                        <div class="flex justify-between">
                            <span>Jumat</span>
                            <span>08.00 - 11.00 WIB</span>
                        </div>
                        <div class="flex justify-between">
                            <span>Sabtu</span>
                            <span>08.00 - 13.00 WIB</span>
                        </div>
                        <div class="flex justify-between">
                            <span>Minggu & Hari Libur</span>
                            <span>Tutup</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Navigasi ke halaman lain -->
    <div class="container mx-auto px-6 py-8">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <a href="{{ route('profil.visi-misi') }}" class="bg-white border border-gray-200 rounded-xl p-6 hover:border-primary hover:shadow-lg transition duration-300 text-center">
                <div class="text-primary mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    </svg>
                </div>
                <h3 class="font-bold text-dark mb-2">Visi & Misi Desa</h3>
                <p class="text-gray-600 text-sm">Arah dan tujuan pembangunan desa</p>
            </a>
            
            <a href="{{ route('profil.sejarah') }}" class="bg-white border border-gray-200 rounded-xl p-6 hover:border-primary hover:shadow-lg transition duration-300 text-center">
                <div class="text-primary mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <h3 class="font-bold text-dark mb-2">Sejarah Desa</h3>
                <p class="text-gray-600 text-sm">Perjalanan panjang desa dari masa ke masa</p>
            </a>
            
            <a href="{{ route('layanan.prosedur') }}" class="bg-white border border-gray-200 rounded-xl p-6 hover:border-primary hover:shadow-lg transition duration-300 text-center">
                <div class="text-primary mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                </div>
                <h3 class="font-bold text-dark mb-2">Layanan Desa</h3>
                <p class="text-gray-600 text-sm">Akses layanan administrasi dan publik</p>
            </a>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Untuk halaman struktur, bisa menambahkan fungsi untuk interaksi
    document.addEventListener('DOMContentLoaded', function() {
        // Menambahkan event click pada kartu person
        const personCards = document.querySelectorAll('.person-card');
        
        personCards.forEach(card => {
            card.addEventListener('click', function() {
                // Hilangkan highlight dari semua kartu
                personCards.forEach(c => {
                    c.style.boxShadow = '';
                    c.style.borderColor = '';
                });
                
                // Highlight kartu yang diklik
                this.style.boxShadow = '0 0 0 3px rgba(59, 130, 246, 0.5)';
                
                // Dapatkan nama dan posisi dari kartu yang diklik
                const name = this.querySelector('h4').textContent;
                const position = this.querySelector('.position-badge').textContent;
                
                // Tampilkan informasi (bisa dikembangkan untuk modal atau detail)
                console.log(`Klik pada: ${position} - ${name}`);
            });
        });
    });
</script>
@endpush