<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Galeri - Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .fade-in {
            animation: fadeIn 0.3s ease-in-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .preview-image {
            transition: all 0.3s ease;
        }

        .preview-image:hover {
            transform: scale(1.05);
        }

        .type-selector .type-option {
            transition: all 0.3s ease;
        }

        .type-selector .type-option.active {
            background-color: #3b82f6;
            color: white;
        }

        .type-selector .type-option.active i {
            color: white;
        }
    </style>
</head>

<body class="bg-gray-50 min-h-screen">
    <!-- Header -->
    <header class="bg-white shadow-sm border-b">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <h1 class="text-xl font-bold text-gray-800">Admin Dashboard</h1>
                    </div>
                    <nav class="ml-6 flex space-x-4">
                        <a href="/admin/dashboard"
                            class="text-gray-600 hover:text-gray-900 px-3 py-2 text-sm font-medium">Dashboard</a>
                        <a href="/admin/letters"
                            class="text-gray-600 hover:text-gray-900 px-3 py-2 text-sm font-medium">Surat</a>
                        <a href="/admin/news"
                            class="text-gray-600 hover:text-gray-900 px-3 py-2 text-sm font-medium">Berita</a>
                        <a href="/admin/galleries"
                            class="bg-blue-100 text-blue-700 px-3 py-2 text-sm font-medium rounded-md">Galeri</a>
                    </nav>
                </div>
                <div class="flex items-center space-x-4">
                    <div class="relative">
                        <button class="flex items-center text-gray-700 hover:text-gray-900">
                            <div
                                class="h-8 w-8 rounded-full bg-blue-100 flex items-center justify-center text-blue-700 font-semibold">
                                A
                            </div>
                            <span class="ml-2 text-sm font-medium">Admin</span>
                            <i class="fas fa-chevron-down ml-1 text-xs"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Page Header -->
        <div class="mb-8">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div>
                    <h2 class="text-2xl font-bold text-gray-900">Tambah Item Galeri</h2>
                    <p class="text-gray-600 mt-1">Tambah foto atau video baru ke galeri.</p>
                </div>

                <div class="flex gap-3">
                    <a href="{{ route('admin.galleries.index') }}"
                        class="bg-gray-200 text-gray-700 rounded-md px-4 py-2 text-sm hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-500 flex items-center">
                        <i class="fas fa-arrow-left mr-2"></i>
                        Kembali
                    </a>
                </div>
            </div>
        </div>

        <!-- Form Container -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden fade-in">
            <form id="galleryForm" method="POST" action="{{ route('admin.galleries.store') }}"
                enctype="multipart/form-data">
                @csrf

                <div class="p-6 space-y-8">
                    <!-- Type Selection -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-3">
                            Tipe Konten <span class="text-red-500">*</span>
                        </label>
                        <div class="type-selector grid grid-cols-2 gap-4">
                            <label
                                class="type-option cursor-pointer border-2 border-blue-200 rounded-lg p-4 flex flex-col items-center justify-center hover:border-blue-300 {{ old('type', 'photo') === 'photo' ? 'active border-blue-500' : '' }}">
                                <input type="radio" name="type" value="photo" class="hidden"
                                    {{ old('type', 'photo') === 'photo' ? 'checked' : '' }}>
                                <i
                                    class="fas fa-camera text-3xl mb-2 {{ old('type', 'photo') === 'photo' ? 'text-white' : 'text-blue-500' }}"></i>
                                <span
                                    class="font-medium {{ old('type', 'photo') === 'photo' ? 'text-white' : 'text-gray-700' }}">Foto</span>
                                <p
                                    class="text-xs {{ old('type', 'photo') === 'photo' ? 'text-blue-100' : 'text-gray-500' }} mt-1">
                                    Upload gambar</p>
                            </label>

                            <label
                                class="type-option cursor-pointer border-2 border-red-200 rounded-lg p-4 flex flex-col items-center justify-center hover:border-red-300 {{ old('type') === 'video' ? 'active border-red-500' : '' }}">
                                <input type="radio" name="type" value="video" class="hidden"
                                    {{ old('type') === 'video' ? 'checked' : '' }}>
                                <i
                                    class="fas fa-video text-3xl mb-2 {{ old('type') === 'video' ? 'text-white' : 'text-red-500' }}"></i>
                                <span
                                    class="font-medium {{ old('type') === 'video' ? 'text-white' : 'text-gray-700' }}">Video</span>
                                <p
                                    class="text-xs {{ old('type') === 'video' ? 'text-red-100' : 'text-gray-500' }} mt-1">
                                    Link video</p>
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
                            class="w-full border border-gray-300 rounded-md px-4 py-3 text-base focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
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
                            class="w-full border border-gray-300 rounded-md px-4 py-3 text-base focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
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
                                    class="w-full border border-gray-300 rounded-md px-4 py-3 text-base focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                                    placeholder="Contoh: Kegiatan, Acara, Prestasi">
                                <datalist id="categorySuggestions">
                                    @foreach ($categories as $category)
                                        <option value="{{ $category }}">
                                    @endforeach
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
                                class="w-full border border-gray-300 rounded-md px-4 py-3 text-base focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
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
                                class="border-2 border-dashed border-gray-300 rounded-lg p-8 text-center hover:border-blue-400 transition-colors">
                                <div class="space-y-4">
                                    <i class="fas fa-cloud-upload-alt text-4xl text-gray-400"></i>
                                    <div>
                                        <p class="text-sm font-medium text-gray-700">Upload foto</p>
                                        <p class="text-xs text-gray-500 mt-1">Drag & drop atau klik untuk memilih file
                                        </p>
                                    </div>
                                    <input type="file" id="image" name="image" accept="image/*"
                                        class="hidden" onchange="previewImage(event)">
                                    <label for="image"
                                        class="cursor-pointer inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-md text-sm hover:bg-blue-700">
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
                                            class="hidden w-full h-auto rounded-lg preview-image">
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
                                    class="w-full border border-gray-300 rounded-md px-4 py-3 text-base focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
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
                                            accept="image/*" class="hidden" onchange="previewVideoThumbnail(event)">
                                        <label for="video_thumbnail"
                                            class="cursor-pointer inline-flex items-center px-4 py-2 bg-gray-600 text-white rounded-md text-sm hover:bg-gray-700">
                                            <i class="fas fa-image mr-2"></i>
                                            Upload Thumbnail
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <!-- Video Preview -->
                            <div id="videoPreviewContainer"
                                class="{{ old('type') === 'video' && old('video_url') ? 'block' : 'hidden' }}">
                                <p class="text-sm font-medium text-gray-700 mb-3">Preview Video</p>
                                <div class="border border-gray-300 rounded-lg p-4 bg-gray-50">
                                    <div id="videoPreview"
                                        class="aspect-video bg-gray-900 rounded-lg flex items-center justify-center">
                                        <div class="text-center">
                                            <i class="fas fa-video text-3xl text-gray-400 mb-2"></i>
                                            <p class="text-sm text-gray-300">Video preview akan muncul setelah URL
                                                dimasukkan</p>
                                        </div>
                                    </div>
                                    <p class="text-xs text-gray-500 mt-3">Video akan di-embed secara otomatis di
                                        galeri.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Active Status -->
                    <div class="bg-gray-50 border border-gray-200 rounded-lg p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <label class="flex items-center space-x-3 cursor-pointer">
                                    <div class="relative">
                                        <input type="checkbox" name="is_active" value="1" id="is_active"
                                            {{ old('is_active', true) ? 'checked' : '' }} class="sr-only">
                                        <div class="w-10 h-6 bg-gray-300 rounded-full toggle-bg"></div>
                                        <div
                                            class="absolute left-1 top-1 bg-white w-4 h-4 rounded-full transition toggle-dot">
                                        </div>
                                    </div>
                                    <div>
                                        <span class="text-sm font-medium text-gray-900">Aktifkan item</span>
                                        <p class="text-xs text-gray-600 mt-1">Item akan langsung ditampilkan di galeri
                                            publik</p>
                                    </div>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Form Actions -->
                <div class="px-6 py-4 bg-gray-50 border-t border-gray-200">
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                        <div class="text-sm text-gray-500">
                            <span class="text-red-500">*</span> Menandakan field wajib diisi
                        </div>
                        <div class="flex gap-3">
                            <button type="button" onclick="window.history.back()"
                                class="px-6 py-3 border border-gray-300 rounded-md text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-gray-500 transition-colors">
                                Batal
                            </button>
                            <button type="submit"
                                class="px-6 py-3 bg-blue-600 text-white rounded-md text-sm font-medium hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-colors">
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

        <!-- Footer -->
        <footer class="mt-8 pt-8 border-t border-gray-200">
            <div class="text-center text-sm text-gray-500">
                <p>&copy; {{ date('Y') }} Admin Dashboard. All rights reserved.</p>
            </div>
        </footer>
    </div>

    <script>
        // Type selector
        const typeOptions = document.querySelectorAll('input[name="type"]');
        const photoSection = document.getElementById('photoSection');
        const videoSection = document.getElementById('videoSection');
        const videoUrlInput = document.getElementById('video_url');

        typeOptions.forEach(option => {
            option.addEventListener('change', function() {
                if (this.value === 'photo') {
                    photoSection.classList.remove('hidden');
                    videoSection.classList.add('hidden');
                    // Update active class
                    document.querySelectorAll('.type-option').forEach(opt => {
                        opt.classList.remove('active', 'border-blue-500', 'border-red-500');
                    });
                    this.closest('.type-option').classList.add('active', 'border-blue-500');
                } else {
                    photoSection.classList.add('hidden');
                    videoSection.classList.remove('hidden');
                    // Update active class
                    document.querySelectorAll('.type-option').forEach(opt => {
                        opt.classList.remove('active', 'border-blue-500', 'border-red-500');
                    });
                    this.closest('.type-option').classList.add('active', 'border-red-500');
                }
            });
        });

        // Image preview for photo - FIXED VERSION
        function previewImage(event) {
            console.log('previewImage function called'); // Debug log
            const file = event.target.files[0];
            console.log('File selected:', file); // Debug log

            if (!file) {
                console.log('No file selected');
                return;
            }

            // Validate file type
            const validImageTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif', 'image/webp'];
            if (!validImageTypes.includes(file.type)) {
                alert('Format file tidak didukung. Harap pilih file gambar (JPG, PNG, GIF, WebP).');
                event.target.value = ''; // Clear the input
                return;
            }

            // Validate file size (max 5MB)
            const maxSize = 5 * 1024 * 1024; // 5MB in bytes
            if (file.size > maxSize) {
                alert('Ukuran file terlalu besar. Maksimal 5MB.');
                event.target.value = ''; // Clear the input
                return;
            }

            const previewImage = document.getElementById('previewImage');
            const photoPlaceholder = document.getElementById('photoPlaceholder');

            console.log('Elements found:', {
                previewImage,
                photoPlaceholder
            }); // Debug log

            const reader = new FileReader();

            reader.onloadstart = function() {
                console.log('Starting to read file...');
            };

            reader.onload = function(e) {
                console.log('File read successfully');
                previewImage.src = e.target.result;
                previewImage.classList.remove('hidden');
                photoPlaceholder.classList.add('hidden');
                console.log('Preview updated');
            };

            reader.onerror = function(error) {
                console.error('Error reading file:', error);
                alert('Gagal membaca file. Silakan coba lagi.');
            };

            reader.onabort = function() {
                console.log('File reading aborted');
            };

            reader.readAsDataURL(file);
        }

        // Alternative: Add event listener directly to file input
        document.addEventListener('DOMContentLoaded', function() {
            const imageInput = document.getElementById('image');
            if (imageInput) {
                console.log('Image input found, adding event listener');
                imageInput.addEventListener('change', previewImage);
            }
        });

        // Video thumbnail preview
        function previewVideoThumbnail(event) {
            console.log('previewVideoThumbnail function called');
            const file = event.target.files[0];
            if (file) {
                // Validate file type
                const validImageTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif', 'image/webp'];
                if (!validImageTypes.includes(file.type)) {
                    alert('Format file tidak didukung. Harap pilih file gambar (JPG, PNG, GIF, WebP).');
                    event.target.value = ''; // Clear the input
                    return;
                }

                // Validate file size (max 5MB)
                const maxSize = 5 * 1024 * 1024; // 5MB in bytes
                if (file.size > maxSize) {
                    alert('Ukuran file terlalu besar. Maksimal 5MB.');
                    event.target.value = ''; // Clear the input
                    return;
                }

                const reader = new FileReader();
                reader.onload = function(e) {
                    console.log('Video thumbnail loaded:', e.target.result);
                    // Show success message
                    const successDiv = document.createElement('div');
                    successDiv.className = 'mt-2 text-sm text-green-600';
                    successDiv.innerHTML = '<i class="fas fa-check-circle mr-1"></i> Thumbnail berhasil diupload';

                    const container = event.target.parentElement;
                    const existingMessage = container.querySelector('.thumbnail-success');
                    if (existingMessage) {
                        existingMessage.remove();
                    }
                    successDiv.classList.add('thumbnail-success');
                    container.appendChild(successDiv);

                    // Remove message after 3 seconds
                    setTimeout(() => {
                        successDiv.remove();
                    }, 3000);
                };
                reader.readAsDataURL(file);
            }
        }

        // Video URL preview (simplified)
        videoUrlInput.addEventListener('blur', function() {
            if (this.value.trim()) {
                document.getElementById('videoPreviewContainer').classList.remove('hidden');
                // Validate URL
                try {
                    new URL(this.value);
                    // Show success message
                    this.classList.remove('border-red-300');
                    this.classList.add('border-green-300');
                } catch (_) {
                    this.classList.remove('border-green-300');
                    this.classList.add('border-red-300');
                }
            } else {
                document.getElementById('videoPreviewContainer').classList.add('hidden');
            }
        });

        // Toggle active status
        const activeCheckbox = document.getElementById('is_active');
        const toggleBg = document.querySelector('.toggle-bg');
        const toggleDot = document.querySelector('.toggle-dot');

        function updateActiveToggle() {
            if (activeCheckbox.checked) {
                toggleBg.classList.remove('bg-gray-300');
                toggleBg.classList.add('bg-green-600');
                toggleDot.style.transform = 'translateX(1rem)';
            } else {
                toggleBg.classList.remove('bg-green-600');
                toggleBg.classList.add('bg-gray-300');
                toggleDot.style.transform = 'translateX(0)';
            }
        }

        if (activeCheckbox && toggleBg && toggleDot) {
            activeCheckbox.addEventListener('change', updateActiveToggle);
            updateActiveToggle();

            // Custom checkbox click
            toggleBg.addEventListener('click', function() {
                activeCheckbox.checked = !activeCheckbox.checked;
                activeCheckbox.dispatchEvent(new Event('change'));
            });
        }

        // Form validation
        document.getElementById('galleryForm').addEventListener('submit', function(e) {
            console.log('Form submitted');

            // Validate based on type
            const selectedType = document.querySelector('input[name="type"]:checked');
            if (!selectedType) {
                e.preventDefault();
                alert('Silakan pilih tipe konten (Foto atau Video)!');
                return;
            }

            if (selectedType.value === 'photo') {
                const imageInput = document.getElementById('image');
                if (!imageInput.files.length) {
                    e.preventDefault();
                    alert('Silakan pilih foto untuk diupload!');
                    imageInput.focus();
                    return;
                }
            } else if (selectedType.value === 'video') {
                const videoUrl = document.getElementById('video_url').value.trim();
                if (!videoUrl) {
                    e.preventDefault();
                    alert('URL video harus diisi!');
                    document.getElementById('video_url').focus();
                    return;
                }

                // Validate URL format
                try {
                    new URL(videoUrl);
                } catch (_) {
                    e.preventDefault();
                    alert('URL video tidak valid!');
                    document.getElementById('video_url').focus();
                    return;
                }
            }

            // Validate title
            const title = document.getElementById('title').value.trim();
            if (!title) {
                e.preventDefault();
                alert('Judul harus diisi!');
                document.getElementById('title').focus();
                return;
            }

            // Show loading state
            const submitBtn = this.querySelector('button[type="submit"]');
            const originalText = submitBtn.innerHTML;
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Menyimpan...';
            submitBtn.disabled = true;

            // Restore button if validation fails (timeout as backup)
            setTimeout(() => {
                if (submitBtn.disabled) {
                    submitBtn.innerHTML = originalText;
                    submitBtn.disabled = false;
                }
            }, 5000);
        });

        // Auto-fill category suggestions
        const categoryInput = document.getElementById('category');
        const categorySuggestions = document.getElementById('categorySuggestions');

        if (categoryInput && categorySuggestions) {
            // If you want to add new categories on the fly
            categoryInput.addEventListener('keydown', function(e) {
                if (e.key === 'Enter') {
                    e.preventDefault();
                    // Add new option to datalist
                    const newOption = document.createElement('option');
                    newOption.value = this.value;
                    categorySuggestions.appendChild(newOption);

                    // Show success message
                    const successDiv = document.createElement('div');
                    successDiv.className = 'mt-2 text-sm text-green-600';
                    successDiv.innerHTML = '<i class="fas fa-check-circle mr-1"></i> Kategori baru ditambahkan';
                    this.parentElement.appendChild(successDiv);

                    setTimeout(() => {
                        successDiv.remove();
                    }, 2000);
                }
            });
        }

        // Initialize on page load
        document.addEventListener('DOMContentLoaded', function() {
            console.log('Page loaded, initializing gallery form');

            // Initialize toggle state
            updateActiveToggle();

            // Check if there's already a file selected (on page refresh)
            const imageInput = document.getElementById('image');
            if (imageInput && imageInput.files.length > 0) {
                // Trigger preview for existing file
                const event = new Event('change');
                imageInput.dispatchEvent(event);
            }

            // Check video URL
            if (videoUrlInput && videoUrlInput.value.trim()) {
                videoUrlInput.dispatchEvent(new Event('blur'));
            }
        });
    </script>
</body>

</html>
