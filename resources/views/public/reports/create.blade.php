@extends('layouts.home-app')

@section('title', 'Lapor Fasilitas Rusak - Desa Cicangkang Hilir')

@push('styles')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <style>
        #map {
            height: 400px;
            border-radius: 12px;
            margin-bottom: 1rem;
            border: 2px solid #e5e7eb;
            transition: border-color 0.3s;
        }

        #map:hover {
            border-color: #3b82f6;
        }

        .leaflet-container {
            font-family: inherit;
            z-index: 1;
        }

        .leaflet-popup-content {
            font-size: 14px;
            max-width: 250px;
        }

        .facility-icon {
            width: 40px;
            height: 40px;
            margin: 0 auto 8px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            transition: transform 0.3s;
        }

        .category-btn:hover .facility-icon {
            transform: scale(1.1);
        }

        .photo-preview {
            border: 2px dashed #d1d5db;
            border-radius: 8px;
            padding: 1rem;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s;
            min-height: 200px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .photo-preview:hover {
            border-color: #3b82f6;
            background-color: #f8fafc;
        }

        .photo-preview img {
            max-width: 100%;
            max-height: 180px;
            border-radius: 4px;
            object-fit: cover;
        }

        .step-indicator {
            display: flex;
            justify-content: space-between;
            margin-bottom: 2rem;
            position: relative;
            counter-reset: step;
        }

        .step-indicator:before {
            content: '';
            position: absolute;
            top: 20px;
            left: 0;
            right: 0;
            height: 2px;
            background: #e5e7eb;
            z-index: 0;
        }

        .step {
            position: relative;
            z-index: 1;
            background: white;
            padding: 8px 16px;
            border-radius: 9999px;
            border: 2px solid #e5e7eb;
            font-weight: 500;
            font-size: 14px;
            transition: all 0.3s;
            counter-increment: step;
        }

        .step:before {
            content: counter(step);
            display: inline-block;
            width: 24px;
            height: 24px;
            border-radius: 50%;
            background: #e5e7eb;
            color: #6b7280;
            text-align: center;
            line-height: 24px;
            margin-right: 8px;
            font-size: 12px;
        }

        .step.active {
            border-color: #1e40af;
            background: #1e40af;
            color: white;
        }

        .step.active:before {
            background: white;
            color: #1e40af;
        }

        .step.completed {
            border-color: #10b981;
            background: #10b981;
            color: white;
        }

        .step.completed:before {
            content: '✓';
            background: white;
            color: #10b981;
        }

        .step-content {
            animation: fadeIn 0.5s ease-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .step {
                padding: 6px 10px;
                font-size: 12px;
            }

            .step:before {
                width: 20px;
                height: 20px;
                line-height: 20px;
                font-size: 10px;
            }

            .step-indicator:before {
                top: 16px;
            }

            #map {
                height: 300px;
            }
        }
    </style>
@endpush

@section('content')
    <div class="pt-24 pb-12">
        <div class="container mx-auto px-4">
            <!-- Breadcrumb -->
            <nav class="flex mb-6" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-3">
                    <li class="inline-flex items-center">
                        <a href="{{ route('landing-page') }}"
                            class="inline-flex items-center text-sm text-gray-700 hover:text-primary">
                            <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z">
                                </path>
                            </svg>
                            Beranda
                        </a>
                    </li>
                    <li aria-current="page">
                        <div class="flex items-center">
                            <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            <span class="ml-1 text-sm text-primary font-medium md:ml-2">Lapor Fasilitas Rusak</span>
                        </div>
                    </li>
                </ol>
            </nav>

            <!-- Header -->
            <div class="text-center mb-8">
                <h1 class="text-3xl font-bold text-primary mb-4">Lapor Fasilitas Umum Rusak</h1>
                <p class="text-gray-600 max-w-2xl mx-auto">
                    Laporkan fasilitas umum yang rusak di Desa Cicangkang Hilir. Petugas kami akan segera menindaklanjuti
                    laporan Anda.
                </p>
            </div>

            <!-- Progress Steps -->
            <div class="step-indicator max-w-2xl mx-auto">
                <div class="step active" id="step1">Pilih Lokasi</div>
                <div class="step" id="step2">Jenis Fasilitas</div>
                <div class="step" id="step3">Upload Foto</div>
                <div class="step" id="step4">Informasi</div>
            </div>

            <!-- Form Container -->
            <div class="max-w-4xl mx-auto bg-white rounded-xl shadow-lg p-6">
                <form id="reportForm" method="POST" action="{{ route('reports.store') }}" enctype="multipart/form-data">
                    @csrf

                    <!-- Step 1: Location Selection -->
                    <div id="step1-content" class="step-content">
                        <h2 class="text-xl font-bold text-gray-800 mb-4">Pilih Lokasi Fasilitas</h2>

                        <!-- Map Container -->
                        <div id="map"></div>

                        <!-- Location Information -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Latitude
                                </label>
                                <input type="text" id="latitude" name="latitude" required
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent"
                                    placeholder="Koordinat latitude">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Longitude
                                </label>
                                <input type="text" id="longitude" name="longitude" required
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent"
                                    placeholder="Koordinat longitude">
                            </div>
                        </div>
                        <div class="mt-4">
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Alamat Lengkap
                            </label>
                            <textarea id="address" name="address" rows="2"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent"
                                placeholder="Alamat lengkap fasilitas (akan terisi otomatis dari koordinat)"></textarea>
                            <p class="text-xs text-gray-500 mt-1">
                                Alamat akan terisi otomatis dari koordinat. Anda bisa mengedit jika perlu.
                            </p>
                        </div>

                        <!-- Location Actions -->
                        <div class="mt-4 flex flex-wrap gap-2">
                            <button type="button" onclick="getCurrentLocation()"
                                class="bg-primary text-white px-4 py-2 rounded-lg hover:bg-secondary">
                                <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                Gunakan Lokasi Saya
                            </button>

                            <button type="button" onclick="clearLocation()"
                                class="bg-gray-200 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-300">
                                <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12" />
                                </svg>
                                Reset
                            </button>


                            <div class="ml-auto">
                                <button type="button" onclick="nextStep(2)"
                                    class="bg-primary text-white px-6 py-2 rounded-lg hover:bg-secondary">
                                    Lanjut
                                    <svg class="w-5 h-5 inline ml-2" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 5l7 7-7 7" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Step 2: Facility Type -->
                    <div id="step2-content" class="step-content hidden">
                        <h2 class="text-xl font-bold text-gray-800 mb-4">Pilih Jenis Fasilitas</h2>

                        <!-- Category Selection -->
                        <div class="mb-6">
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Kategori Fasilitas
                            </label>
                            <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
                                @foreach ($facilityCategories as $key => $category)
                                    <button type="button" onclick="selectCategory('{{ $key }}')"
                                        class="category-btn p-3 border rounded-lg text-center hover:border-primary hover:bg-blue-50"
                                        data-category="{{ $key }}">
                                        @switch($key)
                                            @case('jalan_jembatan')
                                                <div class="facility-icon bg-blue-100 text-blue-600 mb-2 mx-auto">
                                                    🛣️
                                                </div>
                                            @break

                                            @case('penerangan_umum')
                                                <div class="facility-icon bg-yellow-100 text-yellow-600 mb-2 mx-auto">
                                                    💡
                                                </div>
                                            @break

                                            @case('fasilitas_air')
                                                <div class="facility-icon bg-blue-100 text-blue-600 mb-2 mx-auto">
                                                    💧
                                                </div>
                                            @break

                                            @case('fasilitas_publik')
                                                <div class="facility-icon bg-green-100 text-green-600 mb-2 mx-auto">
                                                    🏛️
                                                </div>
                                            @break

                                            @case('fasilitas_kesehatan')
                                                <div class="facility-icon bg-red-100 text-red-600 mb-2 mx-auto">
                                                    🏥
                                                </div>
                                            @break

                                            @case('fasilitas_pendidikan')
                                                <div class="facility-icon bg-purple-100 text-purple-600 mb-2 mx-auto">
                                                    🎓
                                                </div>
                                            @break

                                            @default
                                                <div class="facility-icon bg-gray-100 text-gray-600 mb-2 mx-auto">
                                                    📋
                                                </div>
                                        @endswitch
                                        <span class="text-sm font-medium">{{ $category }}</span>
                                    </button>
                                @endforeach
                            </div>
                        </div>

                        <!-- Facility Type Selection -->
                        <div id="facility-types-container" class="hidden">
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Jenis Kerusakan
                            </label>
                            <input type="hidden" id="facility_category" name="facility_category">
                            <div id="facility-types" class="space-y-2"></div>
                        </div>

                        <!-- Description -->
                        <div class="mt-6">
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Deskripsi Kerusakan (Opsional)
                            </label>
                            <textarea name="description" rows="3"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent"
                                placeholder="Jelaskan kondisi kerusakan yang Anda temukan..."></textarea>
                        </div>

                        <!-- Navigation -->
                        <div class="mt-6 flex justify-between">
                            <button type="button" onclick="prevStep(1)"
                                class="bg-gray-200 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-300">
                                <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 19l-7-7 7-7" />
                                </svg>
                                Kembali
                            </button>

                            <button type="button" onclick="nextStep(3)"
                                class="bg-primary text-white px-6 py-2 rounded-lg hover:bg-secondary">
                                Lanjut
                                <svg class="w-5 h-5 inline ml-2" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5l7 7-7 7" />
                                </svg>
                            </button>
                        </div>
                    </div>

                    <!-- Step 3: Photo Upload -->
                    <div id="step3-content" class="step-content hidden">
                        <h2 class="text-xl font-bold text-gray-800 mb-4">Upload Foto (Opsional)</h2>
                        <p class="text-gray-600 mb-4">Upload foto kerusakan untuk membantu petugas memahami kondisi
                            (maksimal 3 foto)</p>

                        <!-- Photo Upload Area -->
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                            @for ($i = 1; $i <= 3; $i++)
                                <div class="photo-container" data-index="{{ $i }}">
                                    <div class="photo-preview" onclick="triggerFileInput({{ $i }})"
                                        id="preview{{ $i }}">
                                        <div class="text-gray-400">
                                            <svg class="w-12 h-12 mx-auto mb-2" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                            <p class="text-sm">Foto {{ $i }}</p>
                                            <p class="text-xs">Klik untuk upload</p>
                                        </div>
                                    </div>
                                    <input type="file" name="photos[]" id="photo{{ $i }}"
                                        class="hidden photo-input" accept="image/*"
                                        onchange="previewImage(event, {{ $i }})">
                                    <div id="error{{ $i }}"
                                        class="error-message text-xs text-red-500 mt-1 hidden"></div>
                                </div>
                            @endfor
                        </div>

                        <!-- Navigation -->
                        <div class="flex justify-between">
                            <button type="button" onclick="prevStep(2)"
                                class="bg-gray-200 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-300">
                                <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 19l-7-7 7-7" />
                                </svg>
                                Kembali
                            </button>

                            <button type="button" onclick="nextStep(4)"
                                class="bg-primary text-white px-6 py-2 rounded-lg hover:bg-secondary">
                                Lanjut
                                <svg class="w-5 h-5 inline ml-2" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5l7 7-7 7" />
                                </svg>
                            </button>
                        </div>
                    </div>

                    <!-- Step 4: Reporter Information -->
                    <div id="step4-content" class="step-content hidden">
                        <h2 class="text-xl font-bold text-gray-800 mb-4">Informasi Pelapor</h2>

                        <!-- Reporter Info -->
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Nama (Opsional)
                                </label>
                                <input type="text" name="reporter_name"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent"
                                    placeholder="Nama Anda">
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                        Nomor WhatsApp (Opsional)
                                    </label>
                                    <input type="text" name="reporter_phone"
                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent"
                                        placeholder="08xx-xxxx-xxxx">
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                        Email (Opsional)
                                    </label>
                                    <input type="email" name="reporter_email"
                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent"
                                        placeholder="email@contoh.com">
                                </div>
                            </div>

                            <div class="flex items-center">
                                <input type="checkbox" id="is_anonymous" name="is_anonymous" value="1"
                                    class="h-4 w-4 text-primary focus:ring-primary border-gray-300 rounded">
                                <label for="is_anonymous" class="ml-2 text-sm text-gray-700">
                                    Laporkan sebagai anonim (data pribadi tidak akan disimpan)
                                </label>
                            </div>
                        </div>

                        <!-- Terms & Conditions -->
                        <div class="mt-6 p-4 bg-gray-50 rounded-lg">
                            <div class="flex items-start">
                                <input type="checkbox" id="agree_terms" required
                                    class="h-4 w-4 mt-1 text-primary focus:ring-primary border-gray-300 rounded">
                                <label for="agree_terms" class="ml-2 text-sm text-gray-700">
                                    Saya menyetujui bahwa laporan ini dibuat dengan data yang valid dan akan digunakan untuk
                                    perbaikan fasilitas desa. Data yang saya berikan akan dilindungi sesuai kebijakan
                                    privasi desa.
                                </label>
                            </div>
                        </div>

                        <!-- Summary -->
                        <div class="mt-6 p-4 border border-gray-200 rounded-lg">
                            <h3 class="font-bold text-gray-800 mb-2">Ringkasan Laporan</h3>
                            <div id="report-summary" class="text-sm text-gray-600 space-y-1">
                                <!-- Summary will be populated by JavaScript -->
                            </div>
                        </div>

                        <!-- Navigation -->
                        <div class="mt-6 flex justify-between">
                            <button type="button" onclick="prevStep(3)"
                                class="bg-gray-200 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-300">
                                <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 19l-7-7 7-7" />
                                </svg>
                                Kembali
                            </button>

                            <button type="submit"
                                class="bg-green-600 text-white px-6 py-2 rounded-lg hover:bg-green-700">
                                <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7" />
                                </svg>
                                Kirim Laporan
                            </button>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Info Box -->
            <div class="max-w-4xl mx-auto mt-6">
                <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                    <div class="flex">
                        <svg class="w-6 h-6 text-blue-600 mr-3 flex-shrink-0" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <div>
                            <h4 class="font-bold text-blue-800">Informasi Penting</h4>
                            <ul class="mt-2 text-sm text-blue-700 space-y-1">
                                <li>• Laporan Anda akan diproses dalam 1-3 hari kerja</li>
                                <li>• Simpan kode laporan untuk mengecek status</li>
                                <li>• Untuk keadaan darurat, hubungi petugas langsung</li>
                                <li>• Data lokasi membantu petugas menemukan lokasi dengan tepat</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        // Global variables
        let map = null;
        let marker = null;
        let selectedCategory = null;
        let selectedFacilityType = null;
        let facilityTypes = @json($facilityTypes);
        let defaultLocation = {
            lat: -6.8885, // Approx Cicangkang Hilir
            lng: 107.5150
        };
        // Photo handling - FIXED VERSION
        let photoFiles = {};

        function triggerFileInput(index) {
            console.log(`Triggering file input ${index}`);
            document.getElementById(`photo${index}`).click();
        }

        function previewImage(event, index) {
            console.log(`Preview image for index ${index}`);

            const file = event.target.files[0];
            if (!file) {
                console.log('No file selected');
                return;
            }

            console.log('File selected:', {
                name: file.name,
                size: file.size,
                type: file.type,
                lastModified: file.lastModified
            });

            // Clear previous error
            const errorDiv = document.getElementById(`error${index}`);
            if (errorDiv) {
                errorDiv.classList.add('hidden');
                errorDiv.textContent = '';
            }

            // Validate file size (max 2MB)
            if (file.size > 2 * 1024 * 1024) {
                const errorMsg = 'Ukuran file terlalu besar. Maksimal 2MB.';
                showPhotoError(index, errorMsg);
                resetFileInput(index);
                return;
            }

            // Validate file type
            const validTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/gif', 'image/webp'];
            if (!validTypes.includes(file.type)) {
                const errorMsg = 'Hanya file gambar (JPEG, PNG, GIF, WebP) yang diizinkan.';
                showPhotoError(index, errorMsg);
                resetFileInput(index);
                return;
            }

            // Store file for later submission
            photoFiles[index] = file;
            console.log(`Stored file for index ${index}:`, file.name);

            const reader = new FileReader();
            reader.onload = function(e) {
                const previewDiv = document.getElementById(`preview${index}`);
                previewDiv.innerHTML = `
            <div class="relative">
                <img src="${e.target.result}" alt="Preview" class="w-full h-48 object-cover rounded mb-2">
                <button type="button" 
                        onclick="removePhoto(${index})" 
                        class="absolute top-2 right-2 bg-red-600 text-white rounded-full p-1 hover:bg-red-700">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <p class="text-xs text-gray-500 truncate">${file.name}</p>
            <p class="text-xs text-gray-400">${(file.size / 1024).toFixed(2)} KB</p>
        `;
            };
            reader.onerror = function() {
                console.error('Error reading file');
                showPhotoError(index, 'Error membaca file');
                resetFileInput(index);
            };
            reader.readAsDataURL(file);
        }

        function showPhotoError(index, message) {
            const errorDiv = document.getElementById(`error${index}`);
            if (errorDiv) {
                errorDiv.textContent = message;
                errorDiv.classList.remove('hidden');
            }
            console.error(`Photo error ${index}:`, message);
        }

        function resetFileInput(index) {
            const input = document.getElementById(`photo${index}`);
            if (input) {
                input.value = '';
            }
            delete photoFiles[index];
        }

        function removePhoto(index) {
            event.stopPropagation();
            console.log(`Removing photo ${index}`);

            resetFileInput(index);

            const previewDiv = document.getElementById(`preview${index}`);
            previewDiv.innerHTML = `
        <div class="text-gray-400">
            <svg class="w-12 h-12 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
            </svg>
            <p class="text-sm">Foto ${index}</p>
            <p class="text-xs">Klik untuk upload</p>
        </div>
    `;

            // Clear error
            const errorDiv = document.getElementById(`error${index}`);
            if (errorDiv) {
                errorDiv.classList.add('hidden');
                errorDiv.textContent = '';
            }
        }

        // Initialize map
        function initMap() {
            // Check if map is already initialized
            if (map) {
                console.log('Map already initialized');
                return;
            }

            // Check if map container exists
            const mapElement = document.getElementById('map');
            if (!mapElement) {
                console.error('Map container not found');
                return;
            }

            try {
                map = L.map('map').setView([defaultLocation.lat, defaultLocation.lng], 15);

                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
                }).addTo(map);

                // Add click event to map
                map.on('click', function(e) {
                    updateLocation(e.latlng.lat, e.latlng.lng);
                });

                // Add initial marker at default location
                updateLocation(defaultLocation.lat, defaultLocation.lng);

                // Try to get user's location after map is loaded
                setTimeout(() => {
                    getCurrentLocation();
                }, 1000);

                console.log('Map initialized successfully');
            } catch (error) {
                console.error('Error initializing map:', error);
            }
        }

        // Get current location with better error handling
        function getCurrentLocation() {
            if (!navigator.geolocation) {
                showLocationError('Browser Anda tidak mendukung geolocation. Silakan klik pada peta untuk memilih lokasi.');
                return;
            }

            // Show loading state
            const locationBtn = document.querySelector('button[onclick="getCurrentLocation()"]');
            if (locationBtn) {
                const originalText = locationBtn.innerHTML;
                locationBtn.innerHTML = `
                <svg class="animate-spin w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                Mendeteksi lokasi...
            `;
                locationBtn.disabled = true;

                setTimeout(() => {
                    locationBtn.innerHTML = originalText;
                    locationBtn.disabled = false;
                }, 3000);
            }

            const options = {
                enableHighAccuracy: true,
                timeout: 10000, // 10 seconds
                maximumAge: 0
            };

            navigator.geolocation.getCurrentPosition(
                function(position) {
                    updateLocation(position.coords.latitude, position.coords.longitude);
                    showLocationSuccess('Lokasi berhasil dideteksi!');

                    // Restore button
                    if (locationBtn) {
                        locationBtn.innerHTML = `
                        <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        Gunakan Lokasi Saya
                    `;
                        locationBtn.disabled = false;
                    }
                },
                function(error) {
                    let errorMessage = 'Tidak dapat mendapatkan lokasi Anda. ';

                    switch (error.code) {
                        case error.PERMISSION_DENIED:
                            errorMessage += 'Akses lokasi ditolak. ';
                            errorMessage +=
                                'Silakan izinkan akses lokasi di pengaturan browser Anda atau klik pada peta untuk memilih lokasi.';
                            break;
                        case error.POSITION_UNAVAILABLE:
                            errorMessage += 'Informasi lokasi tidak tersedia. ';
                            errorMessage += 'Silakan klik pada peta untuk memilih lokasi.';
                            break;
                        case error.TIMEOUT:
                            errorMessage += 'Permintaan lokasi timeout. ';
                            errorMessage += 'Silakan klik pada peta untuk memilih lokasi.';
                            break;
                        default:
                            errorMessage += 'Terjadi kesalahan. ';
                            errorMessage += 'Silakan klik pada peta untuk memilih lokasi.';
                    }

                    showLocationError(errorMessage);

                    // Restore button
                    if (locationBtn) {
                        locationBtn.innerHTML = `
                        <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        Gunakan Lokasi Saya
                    `;
                        locationBtn.disabled = false;
                    }
                },
                options
            );
        }

        // Show location error message
        function showLocationError(message) {
            // Create or update error message div
            let errorDiv = document.getElementById('location-error');
            if (!errorDiv) {
                errorDiv = document.createElement('div');
                errorDiv.id = 'location-error';
                errorDiv.className = 'mt-2';
                document.getElementById('map').parentNode.appendChild(errorDiv);
            }

            errorDiv.innerHTML = `
            <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg flex items-start">
                <svg class="w-5 h-5 mr-3 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <div>
                    <p class="text-sm font-medium">${message}</p>
                    <p class="text-xs mt-1">Tips: Pastikan browser Anda mengizinkan akses lokasi, atau klik langsung pada peta di atas.</p>
                </div>
            </div>
        `;

            // Auto remove after 10 seconds
            setTimeout(() => {
                if (errorDiv) {
                    errorDiv.remove();
                }
            }, 10000);
        }

        // Show location success message
        function showLocationSuccess(message) {
            let successDiv = document.getElementById('location-success');
            if (!successDiv) {
                successDiv = document.createElement('div');
                successDiv.id = 'location-success';
                successDiv.className = 'mt-2';
                document.getElementById('map').parentNode.appendChild(successDiv);
            }

            successDiv.innerHTML = `
            <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg flex items-start">
                <svg class="w-5 h-5 mr-3 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
                <div>
                    <p class="text-sm font-medium">${message}</p>
                </div>
            </div>
        `;

            // Auto remove after 5 seconds
            setTimeout(() => {
                if (successDiv) {
                    successDiv.remove();
                }
            }, 5000);
        }

        // Update location
        function updateLocation(lat, lng) {
            // Format to 6 decimal places
            const formattedLat = parseFloat(lat).toFixed(6);
            const formattedLng = parseFloat(lng).toFixed(6);

            document.getElementById('latitude').value = formattedLat;
            document.getElementById('longitude').value = formattedLng;

            // Remove any existing error/success messages
            const errorDiv = document.getElementById('location-error');
            const successDiv = document.getElementById('location-success');
            if (errorDiv) errorDiv.remove();
            if (successDiv) successDiv.remove();

            // Update marker
            if (marker) {
                marker.setLatLng([lat, lng]);
            } else {
                marker = L.marker([lat, lng], {
                    draggable: true,
                    title: 'Lokasi fasilitas',
                    alt: 'Marker lokasi fasilitas'
                }).addTo(map);

                marker.bindPopup('<b>Lokasi yang dipilih</b><br>Geser marker untuk mengubah lokasi');

                marker.on('dragend', function(e) {
                    const newLatLng = marker.getLatLng();
                    updateLocation(newLatLng.lat, newLatLng.lng);
                });

                // Open popup initially
                marker.openPopup();
            }

            // Center map with animation
            map.flyTo([lat, lng], 16, {
                animate: true,
                duration: 1
            });

            // Get address from coordinates (reverse geocoding)
            getAddressFromCoordinates(lat, lng);
        }

        // Di dalam fungsi getAddressFromCoordinates (di updateLocation atau fungsi terpisah)
        function getAddressFromCoordinates(lat, lng) {
            const url =
                `https://nominatim.openstreetmap.org/reverse?format=json&lat=${lat}&lon=${lng}&zoom=18&addressdetails=1`;

            fetch(url)
                .then(response => response.json())
                .then(data => {
                    if (data && data.display_name) {
                        // Simpan alamat ke input hidden
                        const addressField = document.getElementById('address');
                        if (addressField) {
                            addressField.value = data.display_name;
                        }

                        // Tampilkan alamat di popup
                        if (marker) {
                            marker.setPopupContent(`
                        <b>Lokasi yang dipilih</b><br>
                        ${data.display_name}<br>
                        <small>Geser marker untuk mengubah lokasi</small>
                    `);
                        }
                    }
                })
                .catch(error => {
                    console.log('Tidak dapat mendapatkan alamat:', error);
                    // Set alamat kosong jika gagal
                    const addressField = document.getElementById('address');
                    if (addressField) {
                        addressField.value = '';
                    }
                });
        }

        // Clear location
        function clearLocation() {
            document.getElementById('latitude').value = '';
            document.getElementById('longitude').value = '';

            if (marker) {
                map.removeLayer(marker);
                marker = null;
            }

            // Reset to default view
            map.setView([defaultLocation.lat, defaultLocation.lng], 15);

            // Show message
            showLocationSuccess('Lokasi telah direset. Silakan pilih lokasi baru.');
        }

        // Step navigation
        function showStep(stepNumber) {
            // Hide all steps
            document.querySelectorAll('.step-content').forEach(el => {
                el.classList.add('hidden');
            });

            // Show selected step
            document.getElementById(`step${stepNumber}-content`).classList.remove('hidden');

            // Update step indicators
            document.querySelectorAll('.step').forEach((el, index) => {
                const stepNum = index + 1;
                el.classList.remove('active', 'completed');

                if (stepNum === stepNumber) {
                    el.classList.add('active');
                } else if (stepNum < stepNumber) {
                    el.classList.add('completed');
                }
            });

            // Update summary on step 4
            if (stepNumber === 4) {
                updateSummary();
            }

            // Scroll to top of form
            document.querySelector('.max-w-4xl').scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            });
        }

        function nextStep(next) {
            // Validate current step
            if (next === 2) {
                const lat = document.getElementById('latitude').value;
                const lng = document.getElementById('longitude').value;

                if (!lat || !lng) {
                    showLocationError(
                        'Silakan pilih lokasi terlebih dahulu dengan mengklik pada peta atau menggunakan tombol "Gunakan Lokasi Saya"'
                    );
                    return;
                }
            } else if (next === 3) {
                if (!selectedFacilityType) {
                    alert('Silakan pilih jenis fasilitas terlebih dahulu');
                    return;
                }
            }

            showStep(next);
        }

        function prevStep(prev) {
            showStep(prev);
        }

        // Facility category selection
        function selectCategory(category) {
            selectedCategory = category;
            document.getElementById('facility_category').value = category;

            // Update UI
            document.querySelectorAll('.category-btn').forEach(btn => {
                btn.classList.remove('border-primary', 'bg-blue-50', 'ring-2', 'ring-primary');
            });
            event.target.classList.add('border-primary', 'bg-blue-50', 'ring-2', 'ring-primary');

            // Show facility types
            const typesContainer = document.getElementById('facility-types-container');
            const typesDiv = document.getElementById('facility-types');

            typesContainer.classList.remove('hidden');
            typesDiv.innerHTML = '';

            // Populate facility types
            const types = facilityTypes[category];
            for (const [key, label] of Object.entries(types)) {
                const div = document.createElement('div');
                div.className = 'flex items-center p-3 border rounded-lg hover:bg-gray-50 cursor-pointer transition-colors';
                div.onclick = () => selectFacilityType(key, label);

                div.innerHTML = `
                <input type="radio" name="facility_type" value="${key}" class="h-4 w-4 text-primary focus:ring-primary">
                <span class="ml-3">${label}</span>
            `;

                typesDiv.appendChild(div);
            }

            // Auto select first type
            if (typesDiv.firstChild) {
                typesDiv.firstChild.click();
            }
        }

        // Facility type selection
        function selectFacilityType(type, label) {
            selectedFacilityType = {
                type,
                label
            };

            // Update UI
            document.querySelectorAll('#facility-types > div').forEach(div => {
                div.classList.remove('border-primary', 'bg-blue-50', 'ring-2', 'ring-primary');
            });
            event.target.closest('div').classList.add('border-primary', 'bg-blue-50', 'ring-2', 'ring-primary');
        }

        // Photo handling
        function triggerFileInput(index) {
            document.getElementById(`photo${index}`).click();
        }

        function previewImage(event, index) {
            const file = event.target.files[0];
            if (!file) return;

            // Validate file size (max 2MB)
            if (file.size > 2 * 1024 * 1024) {
                alert('Ukuran file terlalu besar. Maksimal 2MB.');
                event.target.value = '';
                return;
            }

            // Validate file type
            if (!file.type.match('image.*')) {
                alert('Hanya file gambar yang diizinkan.');
                event.target.value = '';
                return;
            }

            const reader = new FileReader();
            reader.onload = function(e) {
                const previewDiv = document.getElementById(`preview${index}`);
                previewDiv.innerHTML = `
                <div class="relative">
                    <img src="${e.target.result}" alt="Preview" class="w-full h-48 object-cover rounded mb-2">
                    <button type="button" 
                            onclick="removePhoto(${index})" 
                            class="absolute top-2 right-2 bg-red-600 text-white rounded-full p-1 hover:bg-red-700">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                <p class="text-xs text-gray-500 truncate">${file.name}</p>
            `;
            };
            reader.readAsDataURL(file);
        }

        function removePhoto(index) {
            event.stopPropagation();

            const input = document.getElementById(`photo${index}`);
            input.value = '';

            const previewDiv = document.getElementById(`preview${index}`);
            previewDiv.innerHTML = `
            <div class="text-gray-400">
                <svg class="w-12 h-12 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
                <p class="text-sm">Foto ${index}</p>
                <p class="text-xs">Klik untuk upload</p>
            </div>
        `;
        }

        // Update summary
        function updateSummary() {
            const summaryDiv = document.getElementById('report-summary');
            let html = '';

            // Location
            const lat = document.getElementById('latitude').value;
            const lng = document.getElementById('longitude').value;
            if (lat && lng) {
                html += `<div class="flex items-start">
                <svg class="w-4 h-4 mr-2 mt-0.5 text-gray-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
                <span>Lokasi: ${lat}, ${lng}</span>
            </div>`;
            }
            const address = document.getElementById('address').value;
            if (address) {
                html += `<div class="flex items-start">
            <svg class="w-4 h-4 mr-2 mt-0.5 text-gray-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
            </svg>
            <span class="text-sm">Alamat: ${address.substring(0, 50)}${address.length > 50 ? '...' : ''}</span>
        </div>`;
            }

            // Facility
            if (selectedFacilityType) {
                const categoryLabel = document.querySelector(`[data-category="${selectedCategory}"] span`).textContent;
                html += `<div class="flex items-start">
                <svg class="w-4 h-4 mr-2 mt-0.5 text-gray-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                </svg>
                <span>Fasilitas: ${categoryLabel} - ${selectedFacilityType.label}</span>
            </div>`;
            }

            // Photos
            const photoInputs = document.querySelectorAll('input[type="file"]');
            const photoCount = Array.from(photoInputs).filter(input => input.files.length > 0).length;
            if (photoCount > 0) {
                html += `<div class="flex items-start">
                <svg class="w-4 h-4 mr-2 mt-0.5 text-gray-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
                <span>Jumlah foto: ${photoCount}</span>
            </div>`;
            }

            // Reporter info
            const isAnonymous = document.getElementById('is_anonymous').checked;
            if (isAnonymous) {
                html += `<div class="flex items-start">
                <svg class="w-4 h-4 mr-2 mt-0.5 text-gray-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                </svg>
                <span>Pelapor: Anonim</span>
            </div>`;
            } else {
                const name = document.querySelector('input[name="reporter_name"]').value;
                if (name) {
                    html += `<div class="flex items-start">
                    <svg class="w-4 h-4 mr-2 mt-0.5 text-gray-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                    <span>Nama: ${name}</span>
                </div>`;
                }
            }

            summaryDiv.innerHTML = html || '<div class="text-gray-400 italic">Belum ada data</div>';
        }

        // Form validation - PERBAIKAN BESAR
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('reportForm');
            if (!form) {
                console.error('Form not found!');
                return;
            }

            form.addEventListener('submit', async function(e) {
                e.preventDefault();

                console.log('Form submission started...');

                // Validasi terms
                const agreeTerms = document.getElementById('agree_terms');
                if (!agreeTerms || !agreeTerms.checked) {
                    alert('Anda harus menyetujui ketentuan sebelum mengirim laporan');
                    return;
                }

                // Validasi lokasi
                const lat = document.getElementById('latitude').value;
                const lng = document.getElementById('longitude').value;
                if (!lat || !lng) {
                    alert('Silakan pilih lokasi terlebih dahulu');
                    showStep(1);
                    return;
                }

                // Validasi facility type
                const facilityType = document.querySelector('input[name="facility_type"]:checked');
                if (!facilityType) {
                    alert('Silakan pilih jenis fasilitas terlebih dahulu');
                    showStep(2);
                    return;
                }

                // Tampilkan loading
                const submitBtn = this.querySelector('button[type="submit"]');
                const originalContent = submitBtn.innerHTML;

                submitBtn.innerHTML = `
            <svg class="animate-spin w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
            Mengirim laporan...
        `;
                submitBtn.disabled = true;

                try {
                    // Get CSRF token
                    const csrfMeta = document.querySelector('meta[name="csrf-token"]');
                    const csrfToken = csrfMeta ? csrfMeta.getAttribute('content') :
                        '{{ csrf_token() }}';

                    if (!csrfToken) {
                        throw new Error('CSRF token tidak ditemukan');
                    }

                    // Buat FormData
                    const formData = new FormData(this);

                    // Debug: Log form data
                    console.log('CSRF Token:', csrfToken);
                    console.log('FormData entries:');
                    for (let [key, value] of formData.entries()) {
                        if (value instanceof File) {
                            console.log(key + ':', value.name, '(', value.size, 'bytes)');
                        } else {
                            console.log(key + ':', value);
                        }
                    }

                    // Kirim request
                    const response = await fetch(this.action, {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': csrfToken
                        },
                        credentials: 'same-origin'
                    });

                    console.log('Response status:', response.status);
                    console.log('Response headers:', Object.fromEntries(response.headers.entries()));

                    // Get response text first
                    const responseText = await response.text();
                    console.log('Response text (first 500 chars):', responseText.substring(0, 500));

                    let data;

                    // Try to parse as JSON
                    try {
                        data = JSON.parse(responseText);
                        console.log('Parsed as JSON:', data);
                    } catch (jsonError) {
                        console.log('Response is not JSON, checking for success...');

                        // Check if it's a success page
                        if (response.ok && responseText.includes('Laporan berhasil dibuat')) {
                            // Extract success message and redirect
                            const tempDiv = document.createElement('div');
                            tempDiv.innerHTML = responseText;

                            // Find report code in the page
                            const reportCodeMatch = responseText.match(/RPT-[A-Z0-9-]+/);
                            const reportCode = reportCodeMatch ? reportCodeMatch[0] : null;

                            if (reportCode) {
                                // Redirect to report show page
                                window.location.href = `/lapor/${reportCode}`;
                                return;
                            }
                        }

                        // If not JSON and not success page, throw error
                        throw new Error('Server mengembalikan respon tidak valid');
                    }

                    // Handle JSON response
                    if (data.success) {
                        // Tampilkan pesan sukses
                        if (typeof Swal !== 'undefined') {
                            await Swal.fire({
                                icon: 'success',
                                title: 'Berhasil!',
                                html: data.message || 'Laporan berhasil dikirim',
                                confirmButtonText: 'Lihat Status'
                            }).then((result) => {
                                if (data.redirect) {
                                    window.location.href = data.redirect;
                                }
                            });
                        } else {
                            alert(data.message || 'Laporan berhasil dikirim!');
                            if (data.redirect) {
                                window.location.href = data.redirect;
                            }
                        }
                    } else {
                        // Tampilkan error validasi
                        let errorMessage = data.message || 'Terjadi kesalahan';

                        if (data.errors) {
                            errorMessage += '\n\n';
                            for (const [field, errors] of Object.entries(data.errors)) {
                                const fieldLabels = {
                                    'facility_category': 'Kategori Fasilitas',
                                    'facility_type': 'Jenis Fasilitas',
                                    'latitude': 'Latitude',
                                    'longitude': 'Longitude',
                                    'reporter_name': 'Nama Pelapor',
                                    'reporter_phone': 'Nomor Telepon',
                                    'reporter_email': 'Email',
                                    'photos.*': 'Foto',
                                    'description': 'Deskripsi'
                                };

                                errorMessage +=
                                    `<strong>${fieldLabels[field] || field}:</strong> ${Array.isArray(errors) ? errors.join(', ') : errors}<br>`;
                            }
                        }

                        if (typeof Swal !== 'undefined') {
                            await Swal.fire({
                                icon: 'error',
                                title: 'Validasi Gagal!',
                                html: errorMessage,
                                confirmButtonText: 'OK'
                            });
                        } else {
                            alert(errorMessage.replace(/<br>/g, '\n').replace(/<strong>|<\/strong>/g,
                                ''));
                        }

                        // Highlight error fields
                        if (data.errors) {
                            Object.keys(data.errors).forEach(field => {
                                const input = document.querySelector(`[name="${field}"]`);
                                if (input) {
                                    input.classList.add('border-red-500');
                                }
                            });
                        }
                    }

                } catch (error) {
                    console.error('Error:', error);

                    // Restore button
                    submitBtn.innerHTML = originalContent;
                    submitBtn.disabled = false;

                    // Tampilkan error
                    const errorMsg = `Terjadi kesalahan: ${error.message}`;

                    if (typeof Swal !== 'undefined') {
                        await Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: errorMsg,
                            confirmButtonText: 'OK'
                        });
                    } else {
                        alert(errorMsg);
                    }
                }
            });
        });

        // Initialize when page loads
        document.addEventListener('DOMContentLoaded', function() {
            console.log('Page loaded, initializing...');

            // Debug info
            console.log('CSRF Token:', document.querySelector('meta[name="csrf-token"]'));
            console.log('Form action:', document.getElementById('reportForm')?.action);

            // Check if all required elements exist
            if (!document.getElementById('map')) {
                console.error('Map element not found!');
            }

            if (!document.getElementById('reportForm')) {
                console.error('Report form not found!');
            }

            // Initialize components
            initMap();
            showStep(1);

            // Add change listeners for summary
            const anonymousCheckbox = document.getElementById('is_anonymous');
            const nameInput = document.querySelector('input[name="reporter_name"]');

            if (anonymousCheckbox) {
                anonymousCheckbox.addEventListener('change', updateSummary);
            }

            if (nameInput) {
                nameInput.addEventListener('input', updateSummary);
            }

            // Add help text for location permission
            const locationHelp = document.createElement('div');
            locationHelp.className = 'mt-2 text-xs text-gray-500';
            locationHelp.innerHTML = `
                <p><strong>Tips:</strong> Jika lokasi tidak terdeteksi:</p>
                <ul class="list-disc pl-4 mt-1">
                    <li>Izinkan akses lokasi di browser Anda</li>
                    <li>Pastikan GPS/Internet aktif</li>
                    <li>Klik langsung pada peta untuk memilih lokasi</li>
                </ul>
            `;
            document.getElementById('map').after(locationHelp);

            console.log('Initialization complete');
        });
    </script>
@endpush
