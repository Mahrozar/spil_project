@extends('layouts.home-app')

@section('content')

<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        
        @include('components.alert')
        
        <!-- Header -->
        <div class="text-center mb-10">
            <h1 class="text-3xl font-bold text-gray-900">Desa Cicangkang Hilir</h1>
        </div>

        <!-- Main Content -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <!-- Form Section -->
            <div class="p-8">
                <div class="mb-8">
                    <h2 class="text-2xl font-bold text-gray-800 mb-2">Ajukan Surat Online</h2>
                    <p class="text-gray-600">Isi formulir berikut untuk mengajukan surat di Desa Cicangkang Hilir.</p>
                </div>

                <form action="{{ route('layanan.submit-surat') }}" method="POST" class="space-y-6">
                    @csrf

                    <!-- Nama Lengkap -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Nama Lengkap <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="nama" value="{{ old('nama') }}" 
                               placeholder="Contoh: Muhammad Ferran H" required
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent transition duration-200" />
                    </div>

                    <!-- NIK -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            NIK <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="nik" value="{{ old('nik') }}" 
                               placeholder="16 digit angka" required
                               pattern="[0-9]{16}"
                               title="NIK harus 16 digit angka"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent transition duration-200" />
                    </div>

                            <!-- Alamat -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">
                                    Alamat Lengkap <span class="text-red-500">*</span>
                                </label>
                                <input type="text" name="alamat" value="{{ old('alamat') }}"
                                       placeholder="Contoh: Jl. Mawar No. 12, RT 01/RW 02"
                                       required
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent transition duration-200" />
                            </div>

                    <!-- Jenis Surat -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Jenis Surat <span class="text-red-500">*</span>
                        </label>
                        <select name="jenis_surat" required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent transition duration-200">
                            <option value="">-- Pilih Jenis Surat --</option>
                            @php
                                $types = [
                                    'Surat Keterangan Domisili',
                                    'Surat Keterangan Tidak Mampu',
                                    'Surat Keterangan Usaha',
                                    'Surat Pengantar SKCK',
                                    'Surat Keterangan Pindah Domisili',
                                    'Surat Keterangan Belum Menikah',
                                    'Surat Keterangan Kelahiran',
                                    'Surat Keterangan Kematian',
                                    'Surat Pernyataan',
                                    'Surat Kuasa'
                                ];
                            @endphp
                            @foreach($types as $type)
                                <option value="{{ $type }}" {{ old('jenis_surat') == $type ? 'selected' : '' }}>
                                    {{ $type }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Keperluan -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Keperluan / Kebutuhan <span class="text-red-500">*</span>
                        </label>
                        <textarea name="keperluan" rows="4" required
                                  placeholder="Jelaskan keperluan surat dengan jelas dan lengkap..."
                                  class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent transition duration-200 resize-none">{{ old('keperluan') }}</textarea>
                    </div>

                    <!-- Nomor Telepon -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Nomor Telepon <span class="text-red-500">*</span>
                        </label>
                        <input type="tel" name="telepon" value="{{ old('telepon') }}" 
                               placeholder="Contoh: 081234567890" required
                               pattern="[0-9]{10,13}"
                               title="Nomor telepon 10-13 digit angka"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent transition duration-200" />
                    </div>

                    <!-- Email -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Email (Opsional)
                        </label>
                        <input type="email" name="email" value="{{ old('email') }}" 
                               placeholder="Contoh: nama@gmail.com"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent transition duration-200" />
                    </div>

                    <!-- Submit Button -->
                    <div class="pt-4">
                        <button type="submit" 
                                class="w-full py-3 px-4 bg-gradient-to-r from-primary to-indigo-600 hover:from-primary hover:to-indigo-700 text-white font-semibold rounded-lg shadow-md hover:shadow-lg transition duration-300 transform hover:-translate-y-0.5">
                            Kirim Pengajuan
                        </button>
                    </div>
                </form>
            </div>

            <!-- Footer Section -->
            <div class="bg-gray-50 border-t border-gray-200 p-8">
                <!-- Catatan Penting -->
                <div class="mb-8">
                    <h3 class="text-lg font-semibold text-gray-800 mb-3">Catatan Penting</h3>
                    <ul class="space-y-2 text-sm text-gray-600">
                        <li class="flex items-start">
                            <svg class="w-5 h-5 text-primary mr-2 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            <span>Pastikan data yang diisi sesuai dengan dokumen resmi (KTP/KK).</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="w-5 h-5 text-primary mr-2 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            <span>Surat akan diproses dalam waktu 1-3 hari kerja.</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="w-5 h-5 text-primary mr-2 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            <span>Untuk pertanyaan lebih lanjut, hubungi admin desa di nomor: (021) 1234-5678</span>
                        </li>
                    </ul>
                </div>

                <!-- Informasi Footer -->
                <div class="grid grid-cols-1 md:grid-cols-4 gap-8 pt-6 border-t border-gray-200">
                    <!-- SIDAKA -->
                    <div>
                        <h4 class="font-bold text-gray-800 mb-3">SIDAKA</h4>
                        <p class="text-sm text-gray-600">
                            Sistem Informasi Desa Digital. Platform digital terintegrasi untuk mengakses administrasi dan pelayanan publik.
                        </p>
                    </div>

                    <!-- Tautan Cepat -->
                    <div>
                        <h4 class="font-bold text-gray-800 mb-3">Tautan Cepat</h4>
                        <ul class="space-y-2 text-sm">
                            <li><a href="#" class="text-gray-600 hover:text-primary transition">Beranda</a></li>
                            <li><a href="#" class="text-gray-600 hover:text-primary transition">Fitur</a></li>
                            <li><a href="#" class="text-gray-600 hover:text-primary transition">Pengumuman</a></li>
                            <li><a href="#" class="text-gray-600 hover:text-primary transition">Kontak</a></li>
                        </ul>
                    </div>

                    <!-- Layanan -->
                    <div>
                        <h4 class="font-bold text-gray-800 mb-3">Layanan</h4>
                        <ul class="space-y-2 text-sm">
                            <li><a href="#" class="text-gray-600 hover:text-primary transition">Administrasi Kependudukan</a></li>
                            <li><a href="#" class="text-gray-600 hover:text-primary transition">Pelayanan Surat Menyurat</a></li>
                            <li><a href="#" class="text-gray-600 hover:text-primary transition">Informasi Desa</a></li>
                            <li><a href="#" class="text-gray-600 hover:text-primary transition">Pengaduan Masyarakat</a></li>
                        </ul>
                    </div>

                    <!-- Newsletter -->
                    <div>
                        <h4 class="font-bold text-gray-800 mb-3">Berlangganan Newsletter</h4>
                        <p class="text-sm text-gray-600 mb-3">
                            Dapatkan informasi terbaru tentang perkembangan SIDAKA.
                        </p>
                        <form class="space-y-2">
                            <input type="email" placeholder="Email Anda" 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm" />
                            <button type="submit" 
                                    class="w-full py-2 bg-primary hover:bg-indigo-700 text-white text-sm font-medium rounded-lg transition">
                                Berlangganan
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('styles')
<style>
    input:focus, textarea:focus, select:focus {
        outline: none;
        ring: 2px;
    }
    
    /* Custom scrollbar for select */
    select {
        scrollbar-width: thin;
        scrollbar-color: #4f46e5 #e5e7eb;
    }
    
    select::-webkit-scrollbar {
        width: 8px;
    }
    
    select::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 4px;
    }
    
    select::-webkit-scrollbar-thumb {
        background: #4f46e5;
        border-radius: 4px;
    }
</style>
@endpush