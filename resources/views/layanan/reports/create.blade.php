@extends('layouts.home-app')

@section('title', 'Lapor Fasilitas Rusak - Desa Cicangkang Hilir')

@push('styles')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <!-- SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
@endpush

@section('content')
    <style>
        /* ============================================
           GLOBAL STYLES - INLINE UNTUK MENGHINDARI CSS CONFLICT
        ============================================ */
        .report-section-card {
            position: relative;
            overflow: hidden;
            border-radius: 1.5rem;
            border: 2px solid #e5e7eb;
            background: white;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.08);
        }

        .report-section-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 8px;
            height: 100%;
            background: linear-gradient(to bottom, #1e40af, #3b82f6, #10b981);
        }

        .report-header {
            position: relative;
            z-index: 10;
            padding: 2rem 2.5rem;
            background: linear-gradient(to right, rgba(30, 64, 175, 0.1), white);
            border-bottom: 2px solid #f3f4f6;
        }

        .report-header i {
            font-size: 2rem;
            color: #1e40af;
            background: linear-gradient(to bottom right, white, rgba(30, 64, 175, 0.1));
            padding: 0.75rem;
            border-radius: 1rem;
            box-shadow: 0 4px 12px rgba(30, 64, 175, 0.15);
        }

        .report-header span {
            margin-left: 1rem;
            font-size: 1.75rem;
            font-weight: 700;
            color: #1f2937;
        }

        .report-content {
            padding: 2.5rem;
            background: linear-gradient(to bottom right, white, rgba(243, 244, 246, 0.3));
        }

        /* ============================================
           STEP INDICATOR
        ============================================ */
        .step-indicator-container {
            position: relative;
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 3rem;
            counter-reset: step;
        }

        .step-indicator-container::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 0;
            width: 100%;
            height: 4px;
            background: linear-gradient(to right, rgba(30, 64, 175, 0.2), rgba(30, 64, 175, 0.3), rgba(30, 64, 175, 0.2));
            transform: translateY(-50%);
            z-index: 0;
        }

        .step-indicator {
            position: relative;
            z-index: 10;
            display: flex;
            flex-direction: column;
            align-items: center;
            width: 100px;
        }

        .step-number {
            width: 3rem;
            height: 3rem;
            border-radius: 9999px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.125rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            background: linear-gradient(135deg, #f1f5f9 0%, #e2e8f0 100%);
            border: 2px solid #e2e8f0;
        }

        .step-indicator.active .step-number {
            background: linear-gradient(135deg, #1e40af 0%, #3b82f6 100%);
            border-color: #1e40af;
            color: white;
            transform: scale(1.1);
            box-shadow: 0 8px 20px rgba(30, 64, 175, 0.3);
        }

        .step-indicator.completed .step-number {
            background: linear-gradient(135deg, #10b981 0%, #34d399 100%);
            border-color: #10b981;
            color: white;
        }

        .step-indicator.completed .step-number::after {
            content: '✓';
            font-weight: 700;
        }

        .step-label {
            font-size: 0.875rem;
            font-weight: 500;
            color: #6b7280;
            margin-top: 0.5rem;
            text-align: center;
        }

        .step-indicator.active .step-label {
            color: #1e40af;
            font-weight: 600;
        }

        /* ============================================
           MAP CONTAINER
        ============================================ */
        .map-container-custom {
            position: relative;
            overflow: hidden;
            border-radius: 1rem;
            border: 2px solid #e5e7eb;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            height: 450px;
            margin-bottom: 2rem;
        }

        .map-container-custom:hover {
            border-color: rgba(30, 64, 175, 0.5);
            transition: border-color 0.3s ease;
        }

        #map {
            width: 100%;
            height: 100%;
        }

        /* ============================================
           FORM ELEMENTS
        ============================================ */
        .form-input-custom {
            width: 100%;
            padding: 0.875rem 1rem;
            border: 2px solid #e5e7eb;
            border-radius: 0.75rem;
            background: linear-gradient(135deg, #ffffff 0%, #fafafa 100%);
            transition: all 0.3s ease;
        }

        .form-input-custom:focus {
            outline: none;
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }

        /* ============================================
           CATEGORY CARDS
        ============================================ */
        .category-card-custom {
            position: relative;
            padding: 1.5rem;
            border: 2px solid #e5e7eb;
            border-radius: 1rem;
            background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .category-card-custom:hover {
            border-color: #3b82f6;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        .category-card-custom.selected {
            border-color: #3b82f6;
            background: linear-gradient(to right, rgba(30, 64, 175, 0.05), rgba(59, 130, 246, 0.05));
            box-shadow: 0 0 0 2px rgba(30, 64, 175, 0.2);
        }

        .facility-icon-custom {
            width: 4rem;
            height: 4rem;
            border-radius: 1rem;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            margin: 0 auto 0.75rem;
            color: white;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        /* ============================================
           PHOTO UPLOAD
        ============================================ */
        .photo-upload-custom {
            position: relative;
            border: 3px dashed #d1d5db;
            border-radius: 1rem;
            padding: 2rem;
            text-align: center;
            cursor: pointer;
            background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
            min-height: 220px;
            transition: all 0.3s ease;
        }

        .photo-upload-custom:hover {
            border-color: #3b82f6;
            border-style: solid;
            background: linear-gradient(135deg, #eff6ff 0%, #dbeafe 100%);
        }

        .photo-upload-custom.has-image {
            border-style: solid;
            border-color: rgba(30, 64, 175, 0.3);
        }

        .photo-preview-custom {
            position: absolute;
            inset: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            border-radius: 0.75rem;
        }

        .photo-preview-custom img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .remove-photo-btn {
            position: absolute;
            top: 0.75rem;
            right: 0.75rem;
            background: #dc2626;
            color: white;
            border-radius: 9999px;
            padding: 0.5rem;
            box-shadow: 0 2px 8px rgba(220, 38, 38, 0.3);
            transition: background-color 0.3s ease;
        }

        .remove-photo-btn:hover {
            background: #b91c1c;
        }

        /* ============================================
           BUTTONS
        ============================================ */
        .btn-primary-custom {
            padding: 0.875rem 1.5rem;
            background: linear-gradient(to right, #1e40af, #3b82f6);
            color: white;
            font-weight: 600;
            border-radius: 0.75rem;
            border: none;
            transition: all 0.3s ease;
        }

        .btn-primary-custom:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
        }

        .btn-secondary-custom {
            padding: 0.875rem 1.5rem;
            background: #f3f4f6;
            color: #374151;
            font-weight: 600;
            border-radius: 0.75rem;
            border: none;
            transition: all 0.3s ease;
        }

        .btn-secondary-custom:hover {
            background: #e5e7eb;
        }

        .btn-success-custom {
            padding: 0.875rem 1.5rem;
            background: linear-gradient(to right, #059669, #10b981);
            color: white;
            font-weight: 600;
            border-radius: 0.75rem;
            border: none;
            transition: all 0.3s ease;
        }

        .btn-success-custom:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(5, 150, 105, 0.15);
        }

        /* ============================================
           SUMMARY CARD
        ============================================ */
        .summary-card-custom {
            padding: 1.5rem;
            border-radius: 1rem;
            border: 2px solid #e5e7eb;
            background: linear-gradient(to bottom right, white, #f9fafb);
        }

        .summary-item-custom {
            display: flex;
            align-items: center;
            padding: 0.75rem 0;
            border-bottom: 1px solid #f3f4f6;
        }

        .summary-item-custom:last-child {
            border-bottom: none;
        }

        .summary-icon-custom {
            width: 2.5rem;
            height: 2.5rem;
            border-radius: 0.75rem;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 1rem;
            color: white;
            background: linear-gradient(135deg, #1e40af 0%, #3b82f6 100%);
        }

        /* ============================================
           INFO BOX
        ============================================ */
        .info-box-custom {
            padding: 1.5rem;
            border-radius: 1rem;
            border-left: 4px solid #3b82f6;
            background: linear-gradient(135deg, #eff6ff 0%, #dbeafe 100%);
        }

        /* ============================================
           ANIMATIONS
        ============================================ */
        .step-content-custom {
            animation: slideUpCustom 0.5s cubic-bezier(0.4, 0, 0.2, 1);
        }

        @keyframes slideUpCustom {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* ============================================
           RESPONSIVE DESIGN
        ============================================ */
        @media (max-width: 768px) {
            .step-indicator {
                width: 70px;
            }

            .step-number {
                width: 2.5rem;
                height: 2.5rem;
                font-size: 1rem;
            }

            .map-container-custom {
                height: 350px;
            }

            .report-content {
                padding: 1.5rem;
            }

            .report-header {
                padding: 1.5rem;
            }

            .report-header span {
                font-size: 1.5rem;
            }
        }

        @media (max-width: 640px) {
            .category-card-custom {
                padding: 1rem;
            }

            .facility-icon-custom {
                width: 3rem;
                height: 3rem;
                font-size: 1.25rem;
            }

            .photo-upload-custom {
                min-height: 180px;
                padding: 1.5rem;
            }

            .btn-primary-custom,
            .btn-secondary-custom,
            .btn-success-custom {
                padding: 0.75rem 1.25rem;
                font-size: 0.875rem;
            }
        }
    </style>

    <div class="pt-24 pb-16 bg-gradient-to-b from-gray-50/50 via-white to-gray-50">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="text-center mb-12">
                <div style="display: inline-flex; align-items: center; justify-content: center; width: 5rem; height: 5rem; background: linear-gradient(to bottom right, #1e40af, #3b82f6, #10b981); color: white; border-radius: 1.5rem; box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15); margin-bottom: 1.5rem;">
                    <i class="fas fa-flag text-3xl"></i>
                </div>
                <h1 class="text-4xl md:text-5xl font-bold mb-4" style="background: linear-gradient(to right, #1e40af, #3b82f6); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">
                    Lapor Fasilitas Rusak
                </h1>
                <p class="text-gray-600 max-w-3xl mx-auto text-lg font-medium">
                    Laporkan fasilitas umum yang rusak di Desa Cicangkang Hilir. 
                    Laporan Anda akan kami tindaklanjuti dengan segera.
                </p>
                
                <!-- Breadcrumb -->
                <nav class="flex justify-center mt-6">
                    <ol class="inline-flex items-center space-x-2">
                        <li class="inline-flex items-center">
                            <a href="{{ route('landing-page') }}" class="inline-flex items-center text-gray-600 hover:text-blue-600 transition-colors">
                                <i class="fas fa-home mr-2"></i>
                                Beranda
                            </a>
                        </li>
                        <li>
                            <i class="fas fa-chevron-right text-gray-400 mx-2"></i>
                        </li>
                        <li class="inline-flex items-center text-blue-600 font-semibold">
                            <i class="fas fa-flag mr-2"></i>
                            Lapor Fasilitas
                        </li>
                    </ol>
                </nav>
            </div>

            <!-- Progress Steps -->
            <div class="step-indicator-container max-w-2xl mx-auto">
                <div class="step-indicator active" data-step="1">
                    <div class="step-number">1</div>
                    <div class="step-label">Pilih Lokasi</div>
                </div>
                <div class="step-indicator" data-step="2">
                    <div class="step-number">2</div>
                    <div class="step-label">Jenis Fasilitas</div>
                </div>
                <div class="step-indicator" data-step="3">
                    <div class="step-number">3</div>
                    <div class="step-label">Upload Foto</div>
                </div>
                <div class="step-indicator" data-step="4">
                    <div class="step-number">4</div>
                    <div class="step-label">Informasi</div>
                </div>
            </div>

            <!-- Form Container -->
            <div class="report-section-card max-w-4xl mx-auto">
                <div class="report-header">
                    <div class="flex items-center">
                        <i class="fas fa-flag"></i>
                        <span>Form Laporan Fasilitas Rusak</span>
                    </div>
                </div>

                <form id="reportForm" method="POST" action="{{ route('reports.store') }}" enctype="multipart/form-data" class="report-content">
                    @csrf

                    <!-- Step 1: Location Selection -->
                    <div id="step1-content" class="step-content-custom">
                        <h2 class="text-2xl font-bold text-gray-800 mb-6 flex items-center">
                            <i class="fas fa-map-marker-alt text-blue-600 mr-3"></i>
                            Pilih Lokasi Fasilitas
                        </h2>

                        <!-- Map Container -->
                        <div class="mb-8">
                            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-4">
                                <h3 class="text-lg font-semibold text-gray-800">Pilih Lokasi di Peta</h3>
                                <div class="flex items-center space-x-2">
                                    <button type="button" onclick="getCurrentLocation()" 
                                            class="flex items-center px-4 py-2 bg-gradient-to-r from-blue-600 to-blue-700 text-white rounded-lg hover:shadow-md transition-all">
                                        <i class="fas fa-location-crosshairs mr-2"></i>
                                        Lokasi Saya
                                    </button>
                                    <button type="button" onclick="clearLocation()" 
                                            class="flex items-center px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-all">
                                        <i class="fas fa-redo mr-2"></i>
                                        Reset
                                    </button>
                                </div>
                            </div>
                            <div class="map-container-custom">
                                <div id="map"></div>
                            </div>
                        </div>

                        <!-- Coordinates Display -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">
                                    <i class="fas fa-globe-asia mr-2 text-blue-600"></i>
                                    Latitude
                                </label>
                                <input type="text" id="latitude" name="latitude" required
                                    class="form-input-custom"
                                    placeholder="Contoh: -6.958944">
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">
                                    <i class="fas fa-globe-asia mr-2 text-blue-600"></i>
                                    Longitude
                                </label>
                                <input type="text" id="longitude" name="longitude" required
                                    class="form-input-custom"
                                    placeholder="Contoh: 107.405839">
                            </div>
                        </div>

                        <!-- Address -->
                        <div class="mb-8">
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-map-signs mr-2 text-blue-600"></i>
                                Alamat Lengkap
                            </label>
                            <textarea id="address" name="address" rows="3"
                                class="form-input-custom"
                                placeholder="Alamat lengkap fasilitas akan terisi otomatis..."></textarea>
                            <p class="text-xs text-gray-500 mt-2 flex items-center">
                                <i class="fas fa-info-circle mr-1"></i>
                                Alamat akan terisi otomatis dari koordinat. Anda bisa mengedit jika perlu.
                            </p>
                        </div>

                        <!-- Navigation -->
                        <div class="flex justify-end">
                            <button type="button" onclick="nextStep(2)" 
                                    class="btn-primary-custom flex items-center">
                                Lanjut ke Jenis Fasilitas
                                <i class="fas fa-arrow-right ml-2"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Step 2: Facility Type -->
                    <div id="step2-content" class="step-content-custom" style="display: none;">
                        <h2 class="text-2xl font-bold text-gray-800 mb-6 flex items-center">
                            <i class="fas fa-tools text-blue-600 mr-3"></i>
                            Pilih Jenis Fasilitas
                        </h2>

                        <!-- Category Selection -->
                        <div class="mb-8">
                            <h3 class="text-lg font-semibold text-gray-800 mb-4">Kategori Fasilitas</h3>
                            <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                                @foreach ($facilityCategories as $key => $category)
                                    <div class="category-card-custom" onclick="selectCategory('{{ $key }}')" 
                                         data-category="{{ $key }}">
                                        @php
                                            $iconClass = '';
                                            $iconColor = '';
                                            switch($key) {
                                                case 'jalan_jembatan':
                                                    $iconClass = 'fa-road';
                                                    $iconColor = 'from-blue-500 to-blue-600';
                                                    break;
                                                case 'penerangan_umum':
                                                    $iconClass = 'fa-lightbulb';
                                                    $iconColor = 'from-yellow-500 to-yellow-600';
                                                    break;
                                                case 'fasilitas_air':
                                                    $iconClass = 'fa-faucet';
                                                    $iconColor = 'from-cyan-500 to-blue-500';
                                                    break;
                                                case 'fasilitas_publik':
                                                    $iconClass = 'fa-landmark';
                                                    $iconColor = 'from-green-500 to-green-600';
                                                    break;
                                                case 'fasilitas_kesehatan':
                                                    $iconClass = 'fa-hospital';
                                                    $iconColor = 'from-red-500 to-red-600';
                                                    break;
                                                case 'fasilitas_pendidikan':
                                                    $iconClass = 'fa-graduation-cap';
                                                    $iconColor = 'from-purple-500 to-purple-600';
                                                    break;
                                                default:
                                                    $iconClass = 'fa-tools';
                                                    $iconColor = 'from-gray-500 to-gray-600';
                                            }
                                        @endphp
                                        <div class="facility-icon-custom" style="background: linear-gradient(to bottom right, var(--tw-gradient-stops)); --tw-gradient-from: #3b82f6; --tw-gradient-to: #1d4ed8;">
                                            <i class="fas {{ $iconClass }}"></i>
                                        </div>
                                        <h4 class="text-center font-semibold text-gray-800">{{ $category }}</h4>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <!-- Facility Type Selection -->
                        <div id="facility-types-container" style="display: none;" class="mb-8">
                            <h3 class="text-lg font-semibold text-gray-800 mb-4">Jenis Kerusakan</h3>
                            <input type="hidden" id="facility_category" name="facility_category">
                            <div id="facility-types" class="space-y-3"></div>
                        </div>

                        <!-- Description -->
                        <div class="mb-8">
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-edit mr-2 text-blue-600"></i>
                                Deskripsi Kerusakan (Opsional)
                            </label>
                            <textarea name="description" rows="4"
                                class="form-input-custom"
                                placeholder="Jelaskan kondisi kerusakan yang Anda temukan..."></textarea>
                        </div>

                        <!-- Navigation -->
                        <div class="flex flex-col sm:flex-row justify-between gap-4">
                            <button type="button" onclick="prevStep(1)" 
                                    class="btn-secondary-custom flex items-center justify-center">
                                <i class="fas fa-arrow-left mr-2"></i>
                                Kembali
                            </button>
                            <button type="button" onclick="nextStep(3)" 
                                    class="btn-primary-custom flex items-center justify-center">
                                Lanjut ke Upload Foto
                                <i class="fas fa-arrow-right ml-2"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Step 3: Photo Upload -->
                    <div id="step3-content" class="step-content-custom" style="display: none;">
                        <h2 class="text-2xl font-bold text-gray-800 mb-6 flex items-center">
                            <i class="fas fa-camera text-blue-600 mr-3"></i>
                            Upload Foto (Opsional)
                        </h2>
                        
                        <p class="text-gray-600 mb-8">Upload foto kerusakan untuk membantu petugas memahami kondisi (maksimal 3 foto, masing-masing maksimal 2MB)</p>

                        <!-- Photo Upload Area -->
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                            @for ($i = 1; $i <= 3; $i++)
                                <div class="photo-upload-custom" onclick="triggerFileInput({{ $i }})" id="preview-container-{{ $i }}">
                                    <div class="photo-preview-custom" id="preview-{{ $i }}"></div>
                                    <div id="upload-placeholder-{{ $i }}" class="text-gray-400">
                                        <i class="fas fa-cloud-upload-alt text-4xl mb-4"></i>
                                        <p class="font-medium">Foto {{ $i }}</p>
                                        <p class="text-sm mt-1">Klik untuk upload</p>
                                        <p class="text-xs text-gray-400 mt-2">JPEG, PNG, GIF, WebP</p>
                                    </div>
                                    <input type="file" name="photos[]" id="photo{{ $i }}" 
                                           style="display: none;" accept="image/*" onchange="previewImage(event, {{ $i }})">
                                </div>
                            @endfor
                        </div>

                        <!-- Navigation -->
                        <div class="flex flex-col sm:flex-row justify-between gap-4">
                            <button type="button" onclick="prevStep(2)" 
                                    class="btn-secondary-custom flex items-center justify-center">
                                <i class="fas fa-arrow-left mr-2"></i>
                                Kembali
                            </button>
                            <button type="button" onclick="nextStep(4)" 
                                    class="btn-primary-custom flex items-center justify-center">
                                Lanjut ke Informasi
                                <i class="fas fa-arrow-right ml-2"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Step 4: Reporter Information -->
                    <div id="step4-content" class="step-content-custom" style="display: none;">
                        <h2 class="text-2xl font-bold text-gray-800 mb-6 flex items-center">
                            <i class="fas fa-user-circle text-blue-600 mr-3"></i>
                            Informasi Pelapor
                        </h2>

                        <!-- Reporter Info -->
                        <div class="space-y-6 mb-8">
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">
                                    <i class="fas fa-user mr-2 text-blue-600"></i>
                                    Nama (Opsional)
                                </label>
                                <input type="text" name="reporter_name"
                                    class="form-input-custom"
                                    placeholder="Nama lengkap Anda">
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                                        <i class="fas fa-phone mr-2 text-blue-600"></i>
                                        Nomor WhatsApp (Opsional)
                                    </label>
                                    <input type="text" name="reporter_phone"
                                        class="form-input-custom"
                                        placeholder="08xx-xxxx-xxxx">
                                </div>

                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                                        <i class="fas fa-envelope mr-2 text-blue-600"></i>
                                        Email (Opsional)
                                    </label>
                                    <input type="email" name="reporter_email"
                                        class="form-input-custom"
                                        placeholder="email@contoh.com">
                                </div>
                            </div>

                            <div class="flex items-center p-4 bg-gray-50 rounded-xl">
                                <input type="checkbox" id="is_anonymous" name="is_anonymous" value="1"
                                    class="h-5 w-5 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                <label for="is_anonymous" class="ml-3 text-gray-700">
                                    <span class="font-medium">Laporkan sebagai anonim</span>
                                    <p class="text-sm text-gray-500 mt-1">Data pribadi Anda tidak akan disimpan</p>
                                </label>
                            </div>
                        </div>

                        <!-- Terms & Conditions -->
                        <div class="mb-8 p-6" style="background: linear-gradient(to right, rgba(30, 64, 175, 0.05), rgba(59, 130, 246, 0.05)); border-radius: 1rem; border: 1px solid rgba(30, 64, 175, 0.2);">
                            <div class="flex items-start">
                                <input type="checkbox" id="agree_terms" required
                                    class="h-5 w-5 mt-1 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                <label for="agree_terms" class="ml-3 text-gray-700">
                                    <span class="font-medium">Saya menyetujui ketentuan laporan</span>
                                    <p class="text-sm mt-1">
                                        Saya menyetujui bahwa laporan ini dibuat dengan data yang valid dan akan digunakan 
                                        untuk perbaikan fasilitas desa. Data yang saya berikan akan dilindungi sesuai 
                                        kebijakan privasi desa.
                                    </p>
                                </label>
                            </div>
                        </div>

                        <!-- Summary -->
                        <div class="summary-card-custom mb-8">
                            <h3 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                                <i class="fas fa-clipboard-check text-blue-600 mr-2"></i>
                                Ringkasan Laporan
                            </h3>
                            <div id="report-summary" class="space-y-2">
                                <!-- Summary will be populated by JavaScript -->
                            </div>
                        </div>

                        <!-- Navigation -->
                        <div class="flex flex-col sm:flex-row justify-between gap-4">
                            <button type="button" onclick="prevStep(3)" 
                                    class="btn-secondary-custom flex items-center justify-center">
                                <i class="fas fa-arrow-left mr-2"></i>
                                Kembali
                            </button>
                            <button type="submit" 
                                    class="btn-success-custom flex items-center justify-center">
                                <i class="fas fa-paper-plane mr-2"></i>
                                Kirim Laporan
                            </button>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Info Box -->
            <div class="max-w-4xl mx-auto mt-8">
                <div class="info-box-custom">
                    <div class="flex flex-col md:flex-row">
                        <div class="mr-4 mb-4 md:mb-0">
                            <i class="fas fa-info-circle text-blue-600 text-2xl"></i>
                        </div>
                        <div class="flex-1">
                            <h4 class="font-bold text-blue-800 text-lg mb-4">Informasi Penting</h4>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div class="flex items-start">
                                    <i class="fas fa-clock text-blue-500 mr-2 mt-1"></i>
                                    <div>
                                        <p class="font-medium text-blue-700">Waktu Proses</p>
                                        <p class="text-sm text-blue-600">Laporan diproses dalam 1-3 hari kerja</p>
                                    </div>
                                </div>
                                <div class="flex items-start">
                                    <i class="fas fa-qrcode text-blue-500 mr-2 mt-1"></i>
                                    <div>
                                        <p class="font-medium text-blue-700">Kode Laporan</p>
                                        <p class="text-sm text-blue-600">Simpan kode untuk cek status laporan</p>
                                    </div>
                                </div>
                                <div class="flex items-start">
                                    <i class="fas fa-exclamation-triangle text-blue-500 mr-2 mt-1"></i>
                                    <div>
                                        <p class="font-medium text-blue-700">Darurat</p>
                                        <p class="text-sm text-blue-600">Hubungi petugas langsung untuk keadaan darurat</p>
                                    </div>
                                </div>
                                <div class="flex items-start">
                                    <i class="fas fa-map-marked-alt text-blue-500 mr-2 mt-1"></i>
                                    <div>
                                        <p class="font-medium text-blue-700">Data Lokasi</p>
                                        <p class="text-sm text-blue-600">Data lokasi membantu petugas menemukan lokasi</p>
                                    </div>
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
            lat: -6.958944159165081,
            lng: 107.4058396872854
        };
        let photoFiles = {};

        // Initialize map
        function initMap() {
            if (map) return;

            try {
                map = L.map('map').setView([defaultLocation.lat, defaultLocation.lng], 15);

                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: '© OpenStreetMap'
                }).addTo(map);

                map.on('click', function(e) {
                    updateLocation(e.latlng.lat, e.latlng.lng);
                });

                updateLocation(defaultLocation.lat, defaultLocation.lng);

            } catch (error) {
                console.error('Map error:', error);
            }
        }

        // Get current location
        function getCurrentLocation() {
            if (!navigator.geolocation) {
                Swal.fire({
                    icon: 'error',
                    title: 'Browser Tidak Support',
                    text: 'Browser Anda tidak mendukung geolocation'
                });
                return;
            }

            const locationBtn = document.querySelector('button[onclick="getCurrentLocation()"]');
            if (locationBtn) {
                locationBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Mendeteksi...';
                locationBtn.disabled = true;
            }

            navigator.geolocation.getCurrentPosition(
                function(position) {
                    updateLocation(position.coords.latitude, position.coords.longitude);
                    showToast('Lokasi berhasil dideteksi!', 'success');
                    
                    if (locationBtn) {
                        locationBtn.innerHTML = '<i class="fas fa-location-crosshairs mr-2"></i>Lokasi Saya';
                        locationBtn.disabled = false;
                    }
                },
                function(error) {
                    let message = 'Tidak dapat mendapatkan lokasi';
                    switch(error.code) {
                        case error.PERMISSION_DENIED:
                            message = 'Akses lokasi ditolak';
                            break;
                        case error.POSITION_UNAVAILABLE:
                            message = 'Informasi lokasi tidak tersedia';
                            break;
                        case error.TIMEOUT:
                            message = 'Timeout mendapatkan lokasi';
                            break;
                    }
                    
                    showToast(message, 'error');
                    
                    if (locationBtn) {
                        locationBtn.innerHTML = '<i class="fas fa-location-crosshairs mr-2"></i>Lokasi Saya';
                        locationBtn.disabled = false;
                    }
                },
                { timeout: 10000 }
            );
        }

        // Update location
        function updateLocation(lat, lng) {
            const formattedLat = parseFloat(lat).toFixed(6);
            const formattedLng = parseFloat(lng).toFixed(6);

            document.getElementById('latitude').value = formattedLat;
            document.getElementById('longitude').value = formattedLng;

            if (marker) {
                marker.setLatLng([lat, lng]);
            } else {
                marker = L.marker([lat, lng], {
                    draggable: true,
                    title: 'Lokasi fasilitas'
                }).addTo(map);

                marker.on('dragend', function(e) {
                    updateLocation(marker.getLatLng().lat, marker.getLatLng().lng);
                });
            }

            map.flyTo([lat, lng], 16, { duration: 1 });
            getAddressFromCoordinates(lat, lng);
        }

        // Clear location
        function clearLocation() {
            document.getElementById('latitude').value = '';
            document.getElementById('longitude').value = '';
            
            if (marker) {
                map.removeLayer(marker);
                marker = null;
            }
            
            map.setView([defaultLocation.lat, defaultLocation.lng], 15);
            showToast('Lokasi telah direset', 'info');
        }

        // Step navigation
        function showStep(stepNumber) {
            // Hide all step contents
            document.getElementById('step1-content').style.display = 'none';
            document.getElementById('step2-content').style.display = 'none';
            document.getElementById('step3-content').style.display = 'none';
            document.getElementById('step4-content').style.display = 'none';
            
            // Show selected step
            document.getElementById(`step${stepNumber}-content`).style.display = 'block';

            // Update step indicators
            document.querySelectorAll('.step-indicator').forEach(step => {
                step.classList.remove('active', 'completed');
                const stepNum = parseInt(step.dataset.step);
                
                if (stepNum === stepNumber) {
                    step.classList.add('active');
                } else if (stepNum < stepNumber) {
                    step.classList.add('completed');
                }
            });

            if (stepNumber === 4) {
                updateSummary();
            }

            document.querySelector('.report-section-card').scrollIntoView({ 
                behavior: 'smooth', 
                block: 'start' 
            });
        }

        function nextStep(next) {
            if (next === 2) {
                const lat = document.getElementById('latitude').value;
                const lng = document.getElementById('longitude').value;
                if (!lat || !lng) {
                    showToast('Silakan pilih lokasi terlebih dahulu', 'warning');
                    return;
                }
            } else if (next === 3) {
                if (!selectedFacilityType) {
                    showToast('Silakan pilih jenis fasilitas terlebih dahulu', 'warning');
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

            // Remove selected class from all cards
            document.querySelectorAll('.category-card-custom').forEach(card => {
                card.classList.remove('selected');
            });
            
            // Add selected class to clicked card
            event.currentTarget.classList.add('selected');

            const typesContainer = document.getElementById('facility-types-container');
            const typesDiv = document.getElementById('facility-types');

            typesContainer.style.display = 'block';
            typesDiv.innerHTML = '';

            const types = facilityTypes[category];
            for (const [key, label] of Object.entries(types)) {
                const div = document.createElement('div');
                div.className = 'flex items-center p-4 border-2 border-gray-200 rounded-xl hover:border-blue-500 cursor-pointer';
                div.onclick = () => selectFacilityType(key, label);

                div.innerHTML = `
                    <div class="w-10 h-10 rounded-lg bg-blue-100 flex items-center justify-center mr-4">
                        <i class="fas fa-check text-blue-600"></i>
                    </div>
                    <span class="font-medium">${label}</span>
                    <input type="radio" name="facility_type" value="${key}" class="ml-auto h-5 w-5 text-blue-600">
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
            selectedFacilityType = { type, label };

            // Remove selected styling from all
            document.querySelectorAll('#facility-types > div').forEach(div => {
                div.classList.remove('border-blue-500', 'bg-blue-50');
            });
            
            // Add selected styling to clicked
            event.currentTarget.classList.add('border-blue-500', 'bg-blue-50');
            event.currentTarget.querySelector('input[type="radio"]').checked = true;
        }

        // Photo handling
        function triggerFileInput(index) {
            document.getElementById(`photo${index}`).click();
        }

        function previewImage(event, index) {
            const file = event.target.files[0];
            if (!file) return;

            if (file.size > 2 * 1024 * 1024) {
                showToast('Ukuran file terlalu besar. Maksimal 2MB.', 'error');
                event.target.value = '';
                return;
            }

            if (!file.type.match('image.*')) {
                showToast('Hanya file gambar yang diizinkan', 'error');
                event.target.value = '';
                return;
            }

            photoFiles[index] = file;
            
            const reader = new FileReader();
            reader.onload = function(e) {
                const preview = document.getElementById(`preview-${index}`);
                const placeholder = document.getElementById(`upload-placeholder-${index}`);
                const container = document.getElementById(`preview-container-${index}`);
                
                placeholder.style.display = 'none';
                preview.innerHTML = `
                    <img src="${e.target.result}" alt="Preview" style="width: 100%; height: 100%; object-fit: cover;">
                    <button type="button" onclick="removePhoto(${index})" 
                            class="remove-photo-btn">
                        <i class="fas fa-times"></i>
                    </button>
                `;
                container.classList.add('has-image');
            };
            reader.readAsDataURL(file);
        }

        function removePhoto(index) {
            event.stopPropagation();
            
            const input = document.getElementById(`photo${index}`);
            const preview = document.getElementById(`preview-${index}`);
            const placeholder = document.getElementById(`upload-placeholder-${index}`);
            const container = document.getElementById(`preview-container-${index}`);
            
            input.value = '';
            preview.innerHTML = '';
            placeholder.style.display = 'block';
            container.classList.remove('has-image');
            delete photoFiles[index];
        }

        // Update summary
        function updateSummary() {
            const summaryDiv = document.getElementById('report-summary');
            let html = '';

            // Location
            const lat = document.getElementById('latitude').value;
            const lng = document.getElementById('longitude').value;
            if (lat && lng) {
                html += `
                    <div class="summary-item-custom">
                        <div class="summary-icon-custom">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                        <div>
                            <div class="font-medium">Lokasi</div>
                            <div class="text-sm text-gray-600">${lat}, ${lng}</div>
                        </div>
                    </div>
                `;
            }

            // Facility
            if (selectedFacilityType) {
                const categoryCard = document.querySelector(`[data-category="${selectedCategory}"] h4`);
                const categoryLabel = categoryCard ? categoryCard.textContent : selectedCategory;
                html += `
                    <div class="summary-item-custom">
                        <div class="summary-icon-custom">
                            <i class="fas fa-tools"></i>
                        </div>
                        <div>
                            <div class="font-medium">Fasilitas</div>
                            <div class="text-sm text-gray-600">${categoryLabel} - ${selectedFacilityType.label}</div>
                        </div>
                    </div>
                `;
            }

            // Photos
            const photoCount = Object.keys(photoFiles).length;
            if (photoCount > 0) {
                html += `
                    <div class="summary-item-custom">
                        <div class="summary-icon-custom">
                            <i class="fas fa-camera"></i>
                        </div>
                        <div>
                            <div class="font-medium">Foto</div>
                            <div class="text-sm text-gray-600">${photoCount} foto terupload</div>
                        </div>
                    </div>
                `;
            }

            // Reporter
            const isAnonymous = document.getElementById('is_anonymous').checked;
            const name = document.querySelector('input[name="reporter_name"]').value;
            
            html += `
                <div class="summary-item-custom">
                    <div class="summary-icon-custom">
                        <i class="fas fa-user"></i>
                    </div>
                    <div>
                        <div class="font-medium">Pelapor</div>
                        <div class="text-sm text-gray-600">${isAnonymous ? 'Anonim' : (name || 'Tidak disebutkan')}</div>
                    </div>
                </div>
            `;

            summaryDiv.innerHTML = html || '<div class="text-gray-400 italic text-center py-4">Belum ada data</div>';
        }

        // Form submission
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('reportForm');
            
            // Initialize components
            setTimeout(() => {
                initMap();
                showStep(1);
            }, 100);
            
            // Add summary update listeners
            const anonymousCheckbox = document.getElementById('is_anonymous');
            const nameInput = document.querySelector('input[name="reporter_name"]');
            
            if (anonymousCheckbox) {
                anonymousCheckbox.addEventListener('change', updateSummary);
            }
            
            if (nameInput) {
                nameInput.addEventListener('input', updateSummary);
            }
            
            // Handle form submission
            form.addEventListener('submit', async function(e) {
                e.preventDefault();
                
                const agreeTerms = document.getElementById('agree_terms');
                if (!agreeTerms || !agreeTerms.checked) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Perhatian',
                        text: 'Anda harus menyetujui ketentuan sebelum mengirim laporan'
                    });
                    return;
                }
                
                const submitBtn = this.querySelector('button[type="submit"]');
                const originalContent = submitBtn.innerHTML;
                
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Mengirim...';
                submitBtn.disabled = true;
                
                try {
                    const formData = new FormData(this);
                    
                    // Append photo files
                    Object.keys(photoFiles).forEach(index => {
                        if (photoFiles[index]) {
                            formData.append(`photos[${index}]`, photoFiles[index]);
                        }
                    });
                    
                    const response = await fetch(this.action, {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        }
                    });
                    
                    const data = await response.json();
                    
                    if (data.success) {
                        await Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            html: data.message || 'Laporan berhasil dikirim',
                            showConfirmButton: false,
                            timer: 2000
                        });
                        
                        if (data.redirect) {
                            setTimeout(() => {
                                window.location.href = data.redirect;
                            }, 1500);
                        }
                    } else {
                        let errorMessage = data.message || 'Terjadi kesalahan';
                        if (data.errors) {
                            errorMessage += '\n\n';
                            Object.entries(data.errors).forEach(([field, errors]) => {
                                errorMessage += `${errors.join(', ')}\n`;
                            });
                        }
                        
                        Swal.fire({
                            icon: 'error',
                            title: 'Validasi Gagal',
                            text: errorMessage
                        });
                    }
                } catch (error) {
                    console.error('Error:', error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Terjadi kesalahan saat mengirim laporan'
                    });
                } finally {
                    submitBtn.innerHTML = originalContent;
                    submitBtn.disabled = false;
                }
            });
        });

        // Helper functions
        function getAddressFromCoordinates(lat, lng) {
            const url = `https://nominatim.openstreetmap.org/reverse?format=json&lat=${lat}&lon=${lng}&zoom=18`;
            
            fetch(url)
                .then(response => response.json())
                .then(data => {
                    if (data.display_name) {
                        document.getElementById('address').value = data.display_name;
                    }
                })
                .catch(error => console.log('Address error:', error));
        }

        function showToast(message, type = 'info') {
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true
            });
            
            Toast.fire({
                icon: type,
                title: message
            });
        }
    </script>
@endpush