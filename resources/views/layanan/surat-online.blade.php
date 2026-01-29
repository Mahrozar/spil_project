@extends('layouts.home-app')

@section('title', 'Ajukan Surat Online - Desa Cicangkang Hilir')

@section('content')
    <div class="min-h-screen bg-gradient-to-b from-gray-50 to-white py-8">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

            @include('components.alert')

            <!-- Header Section -->
            <div class="text-center mb-10">
                <div
                    class="inline-flex items-center justify-center w-20 h-20 bg-gradient-to-br from-blue-600 to-blue-800 text-white rounded-2xl shadow-xl mb-6">
                    <i class="fas fa-file-alt text-3xl"></i>
                </div>
                <h1 class="text-4xl font-bold bg-gradient-to-r from-blue-600 to-blue-800 bg-clip-text text-transparent mb-4">
                    Ajukan Surat Online
                </h1>
                <p class="text-gray-600 text-lg max-w-2xl mx-auto">
                    Layanan pengajuan surat administrasi Desa Cicangkang Hilir secara digital
                </p>
            </div>

            

            <!-- Main Form Card -->
            <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden mb-8">
                <!-- Form Header -->
                <div class="relative bg-gradient-to-r from-blue-50 to-blue-100 p-8 border-b border-gray-200">
                    <div class="absolute left-0 top-0 w-1 h-full bg-gradient-to-b from-blue-600 via-blue-700 to-blue-800">
                    </div>
                    <div class="flex items-center mb-4">
                        <div class="w-12 h-12 bg-white rounded-xl shadow-md flex items-center justify-center mr-4">
                            <i class="fas fa-file-contract text-2xl text-blue-600"></i>
                        </div>
                        <div>
                            <h2 class="text-2xl font-bold text-gray-800">Formulir Pengajuan Surat</h2>
                            <p class="text-gray-600">Isi data dengan lengkap dan benar</p>
                        </div>
                    </div>

                    <!-- Info Card -->
                    <div class="p-4 bg-blue-50 border-l-4 border-blue-500 rounded-r-lg mb-6">
                        <div class="flex items-start">
                            <i class="fas fa-info-circle text-blue-500 mt-1 mr-3 text-lg"></i>
                            <div>
                                <p class="text-sm text-gray-700">
                                    <strong class="font-semibold">Perhatian:</strong> Pastikan semua data yang diisi sesuai
                                    dengan dokumen resmi.
                                    Pengajuan akan diproses dalam 1-3 hari kerja.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Form Content -->
                <div class="pb-8 px-8">
                    <form action="{{ route('layanan.submit-surat') }}" method="POST" class="space-y-8">
                        @csrf

                        <!-- Nama Lengkap -->
                        <div class="relative">
                            <label class="block text-sm font-semibold text-gray-700 mb-3 flex items-center">
                                <span
                                    class="flex items-center justify-center w-8 h-8 rounded-full bg-gradient-to-r from-blue-600 to-blue-800 text-white text-sm font-bold mr-3 shadow-md">
                                    1
                                </span>
                                Nama Lengkap <span class="text-red-500 ml-1">*</span>
                            </label>
                            <div class="relative">
                                <div class="absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400">
                                    <i class="fas fa-user"></i>
                                </div>
                                <input type="text" name="nama" value="{{ old('nama') }}"
                                    placeholder="Contoh: Muhammad Ferran H" required
                                    class="w-full pl-12 pr-4 py-4 bg-white border-2 border-gray-200 rounded-xl focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all duration-300 placeholder-gray-400" />
                            </div>
                            @error('nama')
                                <p class="mt-2 text-sm text-red-600 flex items-center">
                                    <i class="fas fa-exclamation-circle mr-2"></i>{{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- NIK -->
                        <div class="relative">
                            <label class="block text-sm font-semibold text-gray-700 mb-3 flex items-center">
                                <span
                                    class="flex items-center justify-center w-8 h-8 rounded-full bg-gradient-to-r from-blue-600 to-blue-800 text-white text-sm font-bold mr-3 shadow-md">
                                    2
                                </span>
                                Nomor Induk Kependudukan (NIK) <span class="text-red-500 ml-1">*</span>
                            </label>
                            <div class="relative">
                                <div class="absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400">
                                    <i class="fas fa-id-card"></i>
                                </div>
                                <input type="text" name="nik" value="{{ old('nik') }}"
                                    placeholder="Masukkan 16 digit NIK Anda" required pattern="[0-9]{16}"
                                    title="NIK harus 16 digit angka" maxlength="16"
                                    class="w-full pl-12 pr-4 py-4 bg-white border-2 border-gray-200 rounded-xl focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all duration-300 placeholder-gray-400" />
                            </div>
                            <p class="mt-2 text-xs text-gray-500 flex items-center">
                                <i class="fas fa-info-circle mr-2 text-blue-500"></i>
                                NIK adalah 16 digit angka pada KTP Anda
                            </p>
                            @error('nik')
                                <p class="mt-2 text-sm text-red-600 flex items-center">
                                    <i class="fas fa-exclamation-circle mr-2"></i>{{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- Alamat -->
                        <div class="relative">
                            <label class="block text-sm font-semibold text-gray-700 mb-3 flex items-center">
                                <span
                                    class="flex items-center justify-center w-8 h-8 rounded-full bg-gradient-to-r from-blue-600 to-blue-800 text-white text-sm font-bold mr-3 shadow-md">
                                    3
                                </span>
                                Alamat Lengkap <span class="text-red-500 ml-1">*</span>
                            </label>
                            <div class="relative">
                                <div class="absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400">
                                    <i class="fas fa-map-marker-alt"></i>
                                </div>
                                <input type="text" name="alamat" value="{{ old('alamat') }}"
                                    placeholder="Contoh: Jl. Mawar No. 12, RT 01/RW 02, Dusun Sukamaju" required
                                    class="w-full pl-12 pr-4 py-4 bg-white border-2 border-gray-200 rounded-xl focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all duration-300 placeholder-gray-400" />
                            </div>
                            @error('alamat')
                                <p class="mt-2 text-sm text-red-600 flex items-center">
                                    <i class="fas fa-exclamation-circle mr-2"></i>{{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- Jenis Surat -->
                        <div class="relative">
                            <label class="block text-sm font-semibold text-gray-700 mb-3 flex items-center">
                                <span
                                    class="flex items-center justify-center w-8 h-8 rounded-full bg-gradient-to-r from-blue-600 to-blue-800 text-white text-sm font-bold mr-3 shadow-md">
                                    4
                                </span>
                                Jenis Surat <span class="text-red-500 ml-1">*</span>
                            </label>
                            <div class="relative">
                                <div class="absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400">
                                    <i class="fas fa-file-signature"></i>
                                </div>
                                <select name="jenis_surat" required
                                    class="w-full pl-12 pr-10 py-4 bg-white border-2 border-gray-200 rounded-xl focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all duration-300 appearance-none"
                                    style="background-image: url('data:image/svg+xml;charset=UTF-8,<svg xmlns=\"http://www.w3.org/2000/svg\" viewBox=\"0 0 24 24\" fill=\"%236b7280\"><path d=\"M7 10l5 5 5-5z\"/></svg>'); background-repeat: no-repeat; background-position: right 1rem center; background-size: 1.5em;">
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
                                            'Surat Kuasa',
                                        ];
                                    @endphp
                                    @foreach ($types as $type)
                                        <option value="{{ $type }}"
                                            {{ old('jenis_surat') == $type ? 'selected' : '' }}>
                                            {{ $type }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            @error('jenis_surat')
                                <p class="mt-2 text-sm text-red-600 flex items-center">
                                    <i class="fas fa-exclamation-circle mr-2"></i>{{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- Keperluan -->
                        <div class="relative">
                            <label class="block text-sm font-semibold text-gray-700 mb-3 flex items-center">
                                <span
                                    class="flex items-center justify-center w-8 h-8 rounded-full bg-gradient-to-r from-blue-600 to-blue-800 text-white text-sm font-bold mr-3 shadow-md">
                                    5
                                </span>
                                Keperluan / Tujuan Surat <span class="text-red-500 ml-1">*</span>
                            </label>
                            <div class="relative">
                                <div class="absolute left-4 top-4 text-gray-400">
                                    <i class="fas fa-clipboard-list"></i>
                                </div>
                                <textarea name="keperluan" rows="4" required
                                    placeholder="Jelaskan keperluan surat dengan jelas dan lengkap. Contoh: Untuk mengurus beasiswa pendidikan..."
                                    class="w-full pl-12 pr-4 py-4 bg-white border-2 border-gray-200 rounded-xl focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all duration-300 placeholder-gray-400 resize-none">{{ old('keperluan') }}</textarea>
                            </div>
                            <p class="mt-2 text-xs text-gray-500 flex items-center">
                                <i class="fas fa-lightbulb mr-2 text-blue-500"></i>
                                Jelaskan secara detail agar surat dapat diproses dengan tepat
                            </p>
                            @error('keperluan')
                                <p class="mt-2 text-sm text-red-600 flex items-center">
                                    <i class="fas fa-exclamation-circle mr-2"></i>{{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- Nomor Telepon -->
                        <div class="relative">
                            <label class="block text-sm font-semibold text-gray-700 mb-3 flex items-center">
                                <span
                                    class="flex items-center justify-center w-8 h-8 rounded-full bg-gradient-to-r from-blue-600 to-blue-800 text-white text-sm font-bold mr-3 shadow-md">
                                    6
                                </span>
                                Nomor Telepon/WhatsApp <span class="text-red-500 ml-1">*</span>
                            </label>
                            <div class="relative">
                                <div class="absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400">
                                    <i class="fas fa-phone-alt"></i>
                                </div>
                                <input type="tel" name="telepon" value="{{ old('telepon') }}"
                                    placeholder="Contoh: 081234567890" required pattern="[0-9]{10,13}"
                                    title="Nomor telepon 10-13 digit angka"
                                    class="w-full pl-12 pr-4 py-4 bg-white border-2 border-gray-200 rounded-xl focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all duration-300 placeholder-gray-400" />
                            </div>
                            @error('telepon')
                                <p class="mt-2 text-sm text-red-600 flex items-center">
                                    <i class="fas fa-exclamation-circle mr-2"></i>{{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div class="relative">
                            <label class="block text-sm font-semibold text-gray-700 mb-3 flex items-center">
                                <span
                                    class="flex items-center justify-center w-8 h-8 rounded-full bg-gradient-to-r from-blue-600 to-blue-800 text-white text-sm font-bold mr-3 shadow-md">
                                    7
                                </span>
                                Email (Opsional)
                            </label>
                            <div class="relative">
                                <div class="absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400">
                                    <i class="fas fa-envelope"></i>
                                </div>
                                <input type="email" name="email" value="{{ old('email') }}"
                                    placeholder="Contoh: nama@gmail.com"
                                    class="w-full pl-12 pr-4 py-4 bg-white border-2 border-gray-200 rounded-xl focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all duration-300 placeholder-gray-400" />
                            </div>
                            <p class="mt-2 text-xs text-gray-500 flex items-center">
                                <i class="fas fa-info-circle mr-2 text-blue-500"></i>
                                Email akan digunakan untuk notifikasi status pengajuan
                            </p>
                        </div>

                        <!-- Terms & Conditions -->
                        <div class="relative">
                            <div class="flex items-start">
                                <input type="checkbox" name="terms" id="terms" required
                                    class="mt-1 h-5 w-5 text-blue-600 rounded focus:ring-blue-500 border-gray-300">
                                <label for="terms" class="ml-3 text-sm text-gray-700">
                                    Saya menyatakan bahwa data yang diisi adalah benar dan siap bertanggung jawab
                                    secara hukum atas kebenaran data tersebut.
                                    <a href="#" class="text-blue-600 hover:underline font-semibold">Syarat &
                                        Ketentuan</a>
                                </label>
                            </div>
                            @error('terms')
                                <p class="mt-2 text-sm text-red-600 flex items-center">
                                    <i class="fas fa-exclamation-circle mr-2"></i>{{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- Submit Button -->
                        <div class="pt-8">
                            <button type="submit"
                                class="w-full py-4 px-6 bg-gradient-to-r from-blue-600 to-blue-800 hover:from-blue-700 hover:to-blue-900 text-white font-bold rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-0.5">
                                <span class="flex items-center justify-center">
                                    <i class="fas fa-paper-plane mr-3"></i>
                                    Kirim Pengajuan Surat
                                </span>
                            </button>
                            <p class="text-center text-xs text-gray-500 mt-3">
                                <i class="fas fa-clock mr-1"></i> Proses pengajuan biasanya memakan waktu 1-3 hari kerja
                            </p>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Additional Info Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <!-- Info Card 1 -->
                <div
                    class="bg-white rounded-xl p-6 border border-gray-200 shadow-sm hover:shadow-md transition-shadow duration-300">
                    <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center mb-4">
                        <i class="fas fa-clock text-green-600 text-xl"></i>
                    </div>
                    <h4 class="font-bold text-gray-800 mb-2">Waktu Proses</h4>
                    <p class="text-sm text-gray-600">
                        Surat akan diproses dalam 1-3 hari kerja setelah pengajuan diterima.
                    </p>
                </div>

                <!-- Info Card 2 -->
                <div
                    class="bg-white rounded-xl p-6 border border-gray-200 shadow-sm hover:shadow-md transition-shadow duration-300">
                    <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center mb-4">
                        <i class="fas fa-file-download text-blue-600 text-xl"></i>
                    </div>
                    <h4 class="font-bold text-gray-800 mb-2">Download Surat</h4>
                    <p class="text-sm text-gray-600">
                        Surat yang sudah selesai dapat diunduh melalui dashboard atau email notifikasi.
                    </p>
                </div>

                <!-- Info Card 3 -->
                <div
                    class="bg-white rounded-xl p-6 border border-gray-200 shadow-sm hover:shadow-md transition-shadow duration-300">
                    <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center mb-4">
                        <i class="fas fa-headset text-purple-600 text-xl"></i>
                    </div>
                    <h4 class="font-bold text-gray-800 mb-2">Bantuan</h4>
                    <p class="text-sm text-gray-600">
                        Butuh bantuan? Hubungi kami di (022) 1234-5678 atau email ke info@cicangkanghilir.desa.id
                    </p>
                </div>
            </div>

            <!-- Back to Services Link -->
            <div class="text-center">
                <a href="{{ route('landing-page') }}#layanan"
                    class="inline-flex items-center text-blue-600 hover:text-blue-800 font-medium transition-colors duration-300">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Kembali ke Halaman Layanan
                </a>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Form validation enhancement
                const form = document.querySelector('form');
                if (form) {
                    form.addEventListener('submit', function(e) {
                        const requiredFields = form.querySelectorAll('[required]');
                        let isValid = true;

                        requiredFields.forEach(field => {
                            if (!field.value.trim()) {
                                isValid = false;
                                field.classList.add('border-red-500');

                                // Create error message if not exists
                                if (!field.nextElementSibling?.classList.contains('text-red-600')) {
                                    const errorDiv = document.createElement('p');
                                    errorDiv.className = 'mt-2 text-sm text-red-600 flex items-center';
                                    errorDiv.innerHTML = `
                                <i class="fas fa-exclamation-circle mr-2"></i>
                                Field ini wajib diisi
                            `;
                                    field.parentNode.parentNode.appendChild(errorDiv);
                                }
                            } else {
                                field.classList.remove('border-red-500');
                                // Remove error message if exists
                                const errorMsg = field.parentNode.parentNode.querySelector(
                                    '.text-red-600');
                                if (errorMsg) {
                                    errorMsg.remove();
                                }
                            }
                        });

                        if (!isValid) {
                            e.preventDefault();
                            // Scroll to first error
                            const firstError = form.querySelector('.border-red-500');
                            if (firstError) {
                                firstError.scrollIntoView({
                                    behavior: 'smooth',
                                    block: 'center'
                                });
                            }
                        }
                    });
                }

                // Real-time input formatting
                const nikInput = document.querySelector('input[name="nik"]');
                if (nikInput) {
                    nikInput.addEventListener('input', function(e) {
                        let value = e.target.value.replace(/\D/g, '');
                        if (value.length > 16) value = value.slice(0, 16);
                        e.target.value = value;
                    });
                }

                const phoneInput = document.querySelector('input[name="telepon"]');
                if (phoneInput) {
                    phoneInput.addEventListener('input', function(e) {
                        let value = e.target.value.replace(/\D/g, '');
                        if (value.length > 13) value = value.slice(0, 13);
                        e.target.value = value;
                    });
                }

                // Auto-capitalize name
                const nameInput = document.querySelector('input[name="nama"]');
                if (nameInput) {
                    nameInput.addEventListener('input', function(e) {
                        e.target.value = e.target.value.replace(/\b\w/g, char => char.toUpperCase());
                    });
                }

                // Character counter for textarea
                const textarea = document.querySelector('textarea[name="keperluan"]');
                if (textarea) {
                    const counterDiv = document.createElement('div');
                    counterDiv.className = 'text-right text-xs text-gray-500 mt-1';
                    counterDiv.innerHTML = '<span id="char-count">0</span>/500 karakter';
                    textarea.parentNode.appendChild(counterDiv);

                    textarea.addEventListener('input', function() {
                        const charCount = this.value.length;
                        document.getElementById('char-count').textContent = charCount;

                        if (charCount > 500) {
                            counterDiv.classList.add('text-red-500');
                            counterDiv.classList.remove('text-gray-500');
                        } else {
                            counterDiv.classList.remove('text-red-500');
                            counterDiv.classList.add('text-gray-500');
                        }
                    });

                    // Initialize count
                    const charCount = textarea.value.length;
                    document.getElementById('char-count').textContent = charCount;
                }

                // Add focus styles to inputs
                const inputs = document.querySelectorAll('input, textarea, select');
                inputs.forEach(input => {
                    input.addEventListener('focus', function() {
                        this.parentElement.classList.add('ring-2', 'ring-blue-200');
                    });

                    input.addEventListener('blur', function() {
                        this.parentElement.classList.remove('ring-2', 'ring-blue-200');
                    });
                });
            });
        </script>

        <style>
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
                background: linear-gradient(to bottom, #2563eb, #1d4ed8);
                border-radius: 4px;
            }

            /* Custom focus styles */
            input:focus,
            textarea:focus,
            select:focus {
                outline: none;
            }

            /* Smooth transitions */
            input,
            textarea,
            select,
            button {
                transition: all 0.3s ease;
            }

            /* Hover effects */
            button:hover {
                transform: translateY(-2px);
                box-shadow: 0 10px 25px -5px rgba(37, 99, 235, 0.3);
            }

            /* Custom checkbox styling */
            input[type="checkbox"]:checked {
                background-color: #2563eb;
                border-color: #2563eb;
            }

            /* Animation for alert */
            .alert {
                animation: slideDown 0.5s ease-out;
            }

            @keyframes slideDown {
                from {
                    opacity: 0;
                    transform: translateY(-20px);
                }

                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }

            /* Gradient border effect */
            .gradient-border {
                position: relative;
            }

            .gradient-border::before {
                content: '';
                position: absolute;
                top: -2px;
                left: -2px;
                right: -2px;
                bottom: -2px;
                background: linear-gradient(45deg, #3b82f6, #8b5cf6, #ec4899);
                border-radius: inherit;
                z-index: -1;
            }
        </style>
    @endpush
@endsection
