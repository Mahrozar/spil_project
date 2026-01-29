@extends('layouts.app')

@section('title', 'Tambah Item Galeri')

@section('content')
    <div class="admin-content-area">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <!-- Breadcrumb -->
            <nav class="mb-6" aria-label="Breadcrumb">
                <ol class="flex items-center space-x-2 text-sm">
                    <li>
                        <a href="{{ route('admin.dashboard') }}" class="text-gray-400 hover:text-gray-600">
                            Dashboard
                        </a>
                    </li>
                    <li class="flex items-center">
                        <i class="fas fa-chevron-right text-gray-400 text-xs mx-2"></i>
                        <a href="{{ route('admin.galleries.index') }}" class="text-gray-400 hover:text-gray-600">
                            Galeri
                        </a>
                    </li>
                    <li class="flex items-center">
                        <i class="fas fa-chevron-right text-gray-400 text-xs mx-2"></i>
                        <span class="text-gray-600 font-medium">Tambah Item</span>
                    </li>
                </ol>
            </nav>

            <!-- Header -->
            <div class="mb-8">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                    <div>
                        <h1 class="text-2xl font-bold text-gray-900">Tambah Item Galeri</h1>
                        <p class="text-gray-600 mt-1">Tambah foto atau video baru ke galeri.</p>
                    </div>

                    <div class="flex gap-3">
                        <a href="{{ route('admin.galleries.index') }}"
                            class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                            <i class="fas fa-arrow-left mr-2"></i>
                            Kembali
                        </a>
                    </div>
                </div>
            </div>

            <!-- Form Container -->
            <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                <form id="galleryForm" method="POST" action="{{ route('admin.galleries.store') }}"
                    enctype="multipart/form-data">
                    @csrf

                    <div class="px-4 py-5 sm:p-6 space-y-8">
                        <!-- Type Selection -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-3">
                                Tipe Konten <span class="text-red-500">*</span>
                            </label>
                            <div class="grid grid-cols-2 gap-4">
                                <label class="relative cursor-pointer">
                                    <input type="radio" name="type" value="photo" class="sr-only peer"
                                        {{ old('type', 'photo') === 'photo' ? 'checked' : '' }}>
                                    <div
                                        class="border-2 border-blue-200 rounded-lg p-4 flex flex-col items-center justify-center hover:border-blue-300 peer-checked:border-blue-500 peer-checked:bg-blue-50 transition-all duration-200">
                                        <i class="fas fa-camera text-3xl mb-2 text-blue-500 peer-checked:text-blue-600"></i>
                                        <span class="font-medium text-gray-700 peer-checked:text-gray-900">Foto</span>
                                        <p class="text-xs text-gray-500 peer-checked:text-gray-600 mt-1">Upload gambar</p>
                                    </div>
                                </label>

                                <label class="relative cursor-pointer">
                                    <input type="radio" name="type" value="video" class="sr-only peer"
                                        {{ old('type') === 'video' ? 'checked' : '' }}>
                                    <div
                                        class="border-2 border-red-200 rounded-lg p-4 flex flex-col items-center justify-center hover:border-red-300 peer-checked:border-red-500 peer-checked:bg-red-50 transition-all duration-200">
                                        <i class="fas fa-video text-3xl mb-2 text-red-500 peer-checked:text-red-600"></i>
                                        <span class="font-medium text-gray-700 peer-checked:text-gray-900">Video</span>
                                        <p class="text-xs text-gray-500 peer-checked:text-gray-600 mt-1">Link video</p>
                                    </div>
                                </label>
                            </div>
                            @error('type')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Title -->
                        <div>
                            <label for="title" class="block text-sm font-medium text-gray-700 mb-2">
                                Judul <span class="text-red-500">*</span>
                            </label>
                            <input type="text" id="title" name="title" value="{{ old('title') }}" required
                                class="w-full border border-gray-300 rounded-md px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                                placeholder="Contoh: Kegiatan Gotong Royong 2024">
                            @error('title')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Description -->
                        <div>
                            <label for="description" class="block text-sm font-medium text-gray-700 mb-2">
                                Deskripsi
                            </label>
                            <textarea id="description" name="description" rows="4"
                                class="w-full border border-gray-300 rounded-md px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                                placeholder="Deskripsi singkat tentang foto/video ini">{{ old('description') }}</textarea>
                            <p class="mt-1 text-xs text-gray-500">Maksimal 1000 karakter.</p>
                            @error('description')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Category & Order -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="category" class="block text-sm font-medium text-gray-700 mb-2">
                                    Kategori
                                </label>
                                <div class="relative">
                                    <input type="text" id="category" name="category" value="{{ old('category') }}"
                                        list="categorySuggestions"
                                        class="w-full border border-gray-300 rounded-md px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                                        placeholder="Contoh: Kegiatan, Acara, Prestasi">
                                    <datalist id="categorySuggestions">
                                        @isset($categories)
                                            @foreach ($categories as $category)
                                                <option value="{{ $category }}">
                                            @endforeach
                                        @endisset
                                    </datalist>
                                </div>
                                <p class="mt-1 text-xs text-gray-500">Buat kategori baru atau pilih yang sudah ada</p>
                                @error('category')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="order" class="block text-sm font-medium text-gray-700 mb-2">
                                    Urutan Tampilan
                                </label>
                                <input type="number" id="order" name="order" value="{{ old('order') }}"
                                    min="0"
                                    class="w-full border border-gray-300 rounded-md px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                                    placeholder="0 (kosongkan untuk otomatis)">
                                <p class="mt-1 text-xs text-gray-500">Angka lebih kecil muncul lebih dulu</p>
                                @error('order')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Photo Upload Section -->
                        <div id="photoSection" class="{{ old('type', 'photo') === 'photo' ? 'block' : 'hidden' }}">
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Upload Foto <span class="text-red-500">*</span>
                            </label>

                            <div class="space-y-6">
                                <!-- Upload Area -->
                                <div
                                    class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:border-blue-400 transition-colors">
                                    <div class="space-y-4">
                                        <i class="fas fa-cloud-upload-alt text-4xl text-gray-400"></i>
                                        <div>
                                            <p class="text-sm font-medium text-gray-700">Upload foto</p>
                                            <p class="text-xs text-gray-500 mt-1">Drag & drop atau klik untuk memilih file
                                            </p>
                                        </div>
                                        <input type="file" id="image" name="image" accept="image/*"
                                            class="hidden">
                                        <label for="image"
                                            class="cursor-pointer inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-md text-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
                                            <i class="fas fa-image mr-2"></i>
                                            Pilih Gambar
                                        </label>
                                        <p class="text-xs text-gray-500">Ukuran maksimal 5MB. Format: JPG, PNG, GIF, WebP.
                                        </p>
                                    </div>
                                </div>

                                <!-- Preview -->
                                <div id="photoPreviewContainer"
                                    class="{{ old('type', 'photo') === 'photo' ? 'block' : 'hidden' }}">
                                    <p class="text-sm font-medium text-gray-700 mb-3">Preview Foto</p>
                                    <div class="border border-gray-300 rounded-lg p-4 bg-gray-50">
                                        <div id="imagePreview" class="relative">
                                            <div id="photoPlaceholder"
                                                class="aspect-video bg-gray-200 rounded-lg flex items-center justify-center">
                                                <div class="text-center">
                                                    <i class="fas fa-image text-3xl text-gray-400 mb-2"></i>
                                                    <p class="text-sm text-gray-500">Belum ada foto dipilih</p>
                                                </div>
                                            </div>
                                            <img id="previewImage" src="" alt="Preview"
                                                class="hidden w-full h-auto rounded-lg object-cover">
                                        </div>
                                        <p class="text-xs text-gray-500 mt-3">Foto akan ditampilkan di galeri dengan rasio
                                            4:3.</p>
                                    </div>
                                </div>
                            </div>
                            @error('image')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Video URL Section -->
                        <div id="videoSection" class="{{ old('type') === 'video' ? 'block' : 'hidden' }}">
                            <div class="space-y-6">
                                <!-- Video URL -->
                                <div>
                                    <label for="video_url" class="block text-sm font-medium text-gray-700 mb-2">
                                        URL Video <span class="text-red-500">*</span>
                                    </label>
                                    <input type="url" id="video_url" name="video_url"
                                        value="{{ old('video_url') }}"
                                        class="w-full border border-gray-300 rounded-md px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                                        placeholder="https://www.youtube.com/watch?v=... atau https://vimeo.com/...">
                                    <p class="mt-1 text-xs text-gray-500">Support YouTube, Vimeo, dan video URL lainnya</p>
                                    @error('video_url')
                                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Optional Thumbnail for Video -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                        Thumbnail Video (Opsional)
                                    </label>
                                    <div
                                        class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:border-blue-400 transition-colors">
                                        <div class="space-y-4">
                                            <i class="fas fa-cloud-upload-alt text-3xl text-gray-400"></i>
                                            <div>
                                                <p class="text-sm font-medium text-gray-700">Upload thumbnail custom</p>
                                                <p class="text-xs text-gray-500 mt-1">Ganti thumbnail default dari video
                                                </p>
                                            </div>
                                            <input type="file" id="video_thumbnail" name="video_thumbnail"
                                                accept="image/*" class="hidden">
                                            <label for="video_thumbnail"
                                                class="cursor-pointer inline-flex items-center px-4 py-2 bg-gray-600 text-white rounded-md text-sm hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition-colors">
                                                <i class="fas fa-image mr-2"></i>
                                                Upload Thumbnail
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Active Status -->
                        <div class="bg-gray-50 border border-gray-200 rounded-lg p-6">
                            <div class="flex items-center space-x-4">
                                <div class="flex items-center h-6">
                                    <input type="checkbox" name="is_active" value="1" id="is_active"
                                        {{ old('is_active', true) ? 'checked' : '' }}
                                        class="h-5 w-5 text-blue-600 border-gray-300 rounded focus:ring-blue-500 transition-colors">
                                </div>
                                <div>
                                    <label for="is_active" class="text-sm font-medium text-gray-900 cursor-pointer">
                                        Aktifkan item
                                    </label>
                                    <p class="text-xs text-gray-600 mt-1">Item akan langsung ditampilkan di galeri publik
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Form Actions -->
                    <div class="px-4 py-5 sm:px-6 bg-gray-50 border-t border-gray-200">
                        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                            <div class="text-sm text-gray-500">
                                <span class="text-red-500">*</span> Menandakan field wajib diisi
                            </div>
                            <div class="flex gap-3">
                                <button type="button" onclick="window.history.back()"
                                    class="inline-flex items-center px-4 py-2.5 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition-colors">
                                    Batal
                                </button>
                                <button type="submit"
                                    class="inline-flex items-center px-4 py-2.5 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
                                    <i class="fas fa-save mr-2"></i>
                                    Simpan Item
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Tips Section -->
            <div class="mt-6 bg-blue-50 border border-blue-200 rounded-lg p-6">
                <div class="flex items-start">
                    <i class="fas fa-lightbulb text-blue-500 text-xl mr-3 mt-1"></i>
                    <div>
                        <h3 class="text-lg font-medium text-gray-900 mb-2">Tips Upload Galeri</h3>
                        <ul class="space-y-2 text-gray-600">
                            <li class="flex items-start">
                                <i class="fas fa-check text-green-500 mr-2 mt-1 text-xs"></i>
                                <span>Gunakan gambar dengan resolusi tinggi untuk kualitas terbaik</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check text-green-500 mr-2 mt-1 text-xs"></i>
                                <span>Kompres gambar besar sebelum upload untuk loading lebih cepat</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check text-green-500 mr-2 mt-1 text-xs"></i>
                                <span>Untuk video, gunakan URL publik dari YouTube atau Vimeo</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check text-green-500 mr-2 mt-1 text-xs"></i>
                                <span>Gunakan kategori untuk mengelompokkan item serupa</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Elements
            const typeRadios = document.querySelectorAll('input[name="type"]');
            const photoSection = document.getElementById('photoSection');
            const videoSection = document.getElementById('videoSection');
            const imageInput = document.getElementById('image');
            const previewImage = document.getElementById('previewImage');
            const photoPlaceholder = document.getElementById('photoPlaceholder');
            const videoThumbnailInput = document.getElementById('video_thumbnail');
            const videoUrlInput = document.getElementById('video_url');

            // Type selector toggle
            typeRadios.forEach(radio => {
                radio.addEventListener('change', function() {
                    if (this.value === 'photo') {
                        photoSection.classList.remove('hidden');
                        videoSection.classList.add('hidden');
                    } else {
                        photoSection.classList.add('hidden');
                        videoSection.classList.remove('hidden');
                    }
                });
            });

            // Image preview function
            function previewImageHandler(event) {
                const file = event.target.files[0];

                if (!file) {
                    return;
                }

                // Validate file type
                const validImageTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif', 'image/webp'];
                if (!validImageTypes.includes(file.type)) {
                    alert('Format file tidak didukung. Harap pilih file gambar (JPG, PNG, GIF, WebP).');
                    event.target.value = '';
                    return;
                }

                // Validate file size (max 5MB)
                const maxSize = 5 * 1024 * 1024;
                if (file.size > maxSize) {
                    alert('Ukuran file terlalu besar. Maksimal 5MB.');
                    event.target.value = '';
                    return;
                }

                const reader = new FileReader();
                reader.onload = function(e) {
                    previewImage.src = e.target.result;
                    previewImage.classList.remove('hidden');
                    if (photoPlaceholder) {
                        photoPlaceholder.classList.add('hidden');
                    }
                };
                reader.readAsDataURL(file);
            }

            // Video thumbnail preview
            function previewVideoThumbnailHandler(event) {
                const file = event.target.files[0];
                if (file) {
                    const validImageTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif', 'image/webp'];
                    if (!validImageTypes.includes(file.type)) {
                        alert('Format file tidak didukung. Harap pilih file gambar (JPG, PNG, GIF, WebP).');
                        event.target.value = '';
                        return;
                    }

                    const maxSize = 5 * 1024 * 1024;
                    if (file.size > maxSize) {
                        alert('Ukuran file terlalu besar. Maksimal 5MB.');
                        event.target.value = '';
                        return;
                    }

                    // Show success message
                    const container = event.target.parentElement;
                    const existingMessage = container.querySelector('.thumbnail-success');
                    if (existingMessage) {
                        existingMessage.remove();
                    }

                    const successDiv = document.createElement('div');
                    successDiv.className = 'mt-2 text-sm text-green-600 thumbnail-success';
                    successDiv.innerHTML = '<i class="fas fa-check-circle mr-1"></i> Thumbnail berhasil diupload';
                    container.appendChild(successDiv);

                    setTimeout(() => successDiv.remove(), 3000);
                }
            }

            // Event listeners
            if (imageInput) {
                imageInput.addEventListener('change', previewImageHandler);
            }

            if (videoThumbnailInput) {
                videoThumbnailInput.addEventListener('change', previewVideoThumbnailHandler);
            }

            // Form validation
            const galleryForm = document.getElementById('galleryForm');
            if (galleryForm) {
                galleryForm.addEventListener('submit', function(e) {
                    // Validate based on type
                    const selectedType = document.querySelector('input[name="type"]:checked');
                    if (!selectedType) {
                        e.preventDefault();
                        alert('Silakan pilih tipe konten (Foto atau Video)!');
                        return;
                    }

                    if (selectedType.value === 'photo') {
                        if (!imageInput || !imageInput.files.length) {
                            e.preventDefault();
                            alert('Silakan pilih foto untuk diupload!');
                            imageInput?.focus();
                            return;
                        }
                    } else if (selectedType.value === 'video') {
                        const videoUrl = videoUrlInput ? videoUrlInput.value.trim() : '';
                        if (!videoUrl) {
                            e.preventDefault();
                            alert('URL video harus diisi!');
                            videoUrlInput?.focus();
                            return;
                        }

                        // Validate URL format
                        try {
                            new URL(videoUrl);
                        } catch (_) {
                            e.preventDefault();
                            alert('URL video tidak valid!');
                            videoUrlInput?.focus();
                            return;
                        }
                    }

                    // Validate title
                    const title = document.getElementById('title');
                    if (title && !title.value.trim()) {
                        e.preventDefault();
                        alert('Judul harus diisi!');
                        title.focus();
                        return;
                    }

                    // Show loading state
                    const submitBtn = this.querySelector('button[type="submit"]');
                    if (submitBtn) {
                        const originalText = submitBtn.innerHTML;
                        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Menyimpan...';
                        submitBtn.disabled = true;

                        // Restore button if validation fails
                        setTimeout(() => {
                            if (submitBtn.disabled) {
                                submitBtn.innerHTML = originalText;
                                submitBtn.disabled = false;
                            }
                        }, 5000);
                    }
                });
            }

            // Check if there's already a file selected (on page refresh)
            if (imageInput && imageInput.files.length > 0) {
                const event = new Event('change');
                imageInput.dispatchEvent(event);
            }
        });
    </script>
@endpush
