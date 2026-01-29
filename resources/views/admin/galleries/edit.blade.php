@extends('layouts.app')

@section('title', 'Edit Item Galeri - ' . $gallery->title)

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
                    <span class="text-gray-600 font-medium">Edit Item</span>
                </li>
            </ol>
        </nav>

        <!-- Header -->
        <div class="mb-8">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">Edit Item Galeri</h1>
                    <p class="text-gray-600 mt-1">Ubah data foto/video di galeri.</p>
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
            <form id="galleryForm" method="POST" action="{{ route('admin.galleries.update', $gallery) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="px-4 py-5 sm:p-6 space-y-8">
                    <!-- Type Selection -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-3">
                            Tipe Konten <span class="text-red-500">*</span>
                        </label>
                        <div class="grid grid-cols-2 gap-4">
                            <label class="relative cursor-pointer">
                                <input type="radio" name="type" value="photo" class="sr-only peer" 
                                       {{ old('type', $gallery->type) === 'photo' ? 'checked' : '' }}>
                                <div class="border-2 border-blue-200 rounded-lg p-4 flex flex-col items-center justify-center hover:border-blue-300 peer-checked:border-blue-500 peer-checked:bg-blue-50 transition-all duration-200">
                                    <i class="fas fa-camera text-3xl mb-2 text-blue-500 peer-checked:text-blue-600"></i>
                                    <span class="font-medium text-gray-700 peer-checked:text-gray-900">Foto</span>
                                    <p class="text-xs text-gray-500 peer-checked:text-gray-600 mt-1">Upload gambar</p>
                                </div>
                            </label>

                            <label class="relative cursor-pointer">
                                <input type="radio" name="type" value="video" class="sr-only peer" 
                                       {{ old('type', $gallery->type) === 'video' ? 'checked' : '' }}>
                                <div class="border-2 border-red-200 rounded-lg p-4 flex flex-col items-center justify-center hover:border-red-300 peer-checked:border-red-500 peer-checked:bg-red-50 transition-all duration-200">
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
                        <input type="text" id="title" name="title" value="{{ old('title', $gallery->title) }}" required
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
                            placeholder="Deskripsi singkat tentang foto/video ini">{{ old('description', $gallery->description) }}</textarea>
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
                                <input type="text" id="category" name="category" value="{{ old('category', $gallery->category) }}"
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
                            <input type="number" id="order" name="order" value="{{ old('order', $gallery->order) }}"
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
                    <div id="photoSection" class="{{ old('type', $gallery->type) === 'photo' ? 'block' : 'hidden' }}">
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Foto <span class="text-red-500">*</span>
                        </label>

                        <div class="space-y-6">
                            <!-- Current Image -->
                            @if($gallery->type === 'photo' && $gallery->image_path)
                                <div>
                                    <p class="text-sm font-medium text-gray-700 mb-3">Foto Saat Ini</p>
                                    <div class="border border-gray-300 rounded-lg p-4 bg-gray-50">
                                        <div class="aspect-video rounded-lg overflow-hidden bg-gray-200">
                                            <img src="{{ asset('storage/' . $gallery->image_path) }}" 
                                                 alt="{{ $gallery->title }}"
                                                 class="w-full h-full object-cover">
                                        </div>
                                        <div class="mt-3 flex items-center text-sm text-gray-600">
                                            <i class="fas fa-image mr-2"></i>
                                            <span>Foto saat ini akan tetap digunakan jika tidak diganti</span>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            <!-- Upload New Image -->
                            <div>
                                <p class="text-sm font-medium text-gray-700 mb-2">
                                    @if($gallery->type === 'photo' && $gallery->image_path)
                                        Ganti Foto (Opsional)
                                    @else
                                        Upload Foto Baru <span class="text-red-500">*</span>
                                    @endif
                                </p>
                                <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:border-blue-400 transition-colors">
                                    <div class="space-y-4">
                                        <i class="fas fa-cloud-upload-alt text-4xl text-gray-400"></i>
                                        <div>
                                            <p class="text-sm font-medium text-gray-700">Upload foto baru</p>
                                            <p class="text-xs text-gray-500 mt-1">Drag & drop atau klik untuk memilih file</p>
                                        </div>
                                        <input type="file" id="image" name="image" accept="image/*"
                                            class="hidden">
                                        <label for="image"
                                            class="cursor-pointer inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-md text-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
                                            <i class="fas fa-image mr-2"></i>
                                            Pilih Gambar Baru
                                        </label>
                                        <p class="text-xs text-gray-500">Ukuran maksimal 5MB. Format: JPG, PNG, GIF, WebP.</p>
                                    </div>
                                </div>

                                <!-- Preview -->
                                <div id="photoPreviewContainer" class="hidden">
                                    <p class="text-sm font-medium text-gray-700 mt-4 mb-3">Preview Foto Baru</p>
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
                                        <p class="text-xs text-gray-500 mt-3">Foto akan ditampilkan di galeri dengan rasio 4:3.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @error('image')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Video URL Section -->
                    <div id="videoSection" class="{{ old('type', $gallery->type) === 'video' ? 'block' : 'hidden' }}">
                        <div class="space-y-6">
                            <!-- Current Video -->
                            @if($gallery->type === 'video' && $gallery->video_url)
                                <div>
                                    <p class="text-sm font-medium text-gray-700 mb-3">Video Saat Ini</p>
                                    <div class="border border-gray-300 rounded-lg p-4 bg-gray-50">
                                        <div class="flex items-center space-x-3">
                                            <div class="h-12 w-12 rounded-lg bg-red-100 flex items-center justify-center">
                                                <i class="fas fa-video text-red-600"></i>
                                            </div>
                                            <div class="flex-1 min-w-0">
                                                <p class="text-sm font-medium text-gray-900 truncate">{{ $gallery->video_url }}</p>
                                                <p class="text-xs text-gray-500 mt-1">URL video saat ini</p>
                                            </div>
                                            <a href="{{ $gallery->video_url }}" target="_blank" 
                                               class="text-blue-600 hover:text-blue-800 text-sm">
                                                <i class="fas fa-external-link-alt"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            <!-- Video URL Input -->
                            <div>
                                <label for="video_url" class="block text-sm font-medium text-gray-700 mb-2">
                                    URL Video 
                                    @if($gallery->type === 'video')
                                        <span class="text-gray-500 text-xs">(Isi jika ingin mengganti)</span>
                                    @else
                                        <span class="text-red-500">*</span>
                                    @endif
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
                                <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:border-blue-400 transition-colors">
                                    <div class="space-y-4">
                                        <i class="fas fa-cloud-upload-alt text-3xl text-gray-400"></i>
                                        <div>
                                            <p class="text-sm font-medium text-gray-700">Upload thumbnail custom</p>
                                            <p class="text-xs text-gray-500 mt-1">Ganti thumbnail default dari video</p>
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
                                    {{ old('is_active', $gallery->is_active) ? 'checked' : '' }} 
                                    class="h-5 w-5 text-blue-600 border-gray-300 rounded focus:ring-blue-500 transition-colors">
                            </div>
                            <div>
                                <label for="is_active" class="text-sm font-medium text-gray-900 cursor-pointer">
                                    Aktifkan item
                                </label>
                                <p class="text-xs text-gray-600 mt-1">Item akan ditampilkan di galeri publik</p>
                            </div>
                        </div>
                    </div>

                    <!-- Delete Option -->
                    <div class="border border-red-200 rounded-lg p-6 bg-red-50">
                        <div class="flex items-start">
                            <div class="flex-shrink-0">
                                <i class="fas fa-exclamation-triangle text-red-600 text-lg mt-1"></i>
                            </div>
                            <div class="ml-3 flex-1">
                                <h3 class="text-sm font-medium text-red-800">Hapus Item Galeri</h3>
                                <div class="mt-2 text-sm text-red-700">
                                    <p>Item ini akan dihapus permanen dari sistem.</p>
                                </div>
                                <div class="mt-4">
                                    <button type="button" onclick="confirmDelete()"
                                            class="inline-flex items-center px-4 py-2 border border-transparent rounded-md text-sm font-medium text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-colors">
                                        <i class="fas fa-trash mr-2"></i>
                                        Hapus Item
                                    </button>
                                </div>
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
                                Simpan Perubahan
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
                    <h3 class="text-lg font-medium text-gray-900 mb-2">Tips Edit Galeri</h3>
                    <ul class="space-y-2 text-gray-600">
                        <li class="flex items-start">
                            <i class="fas fa-check text-green-500 mr-2 mt-1 text-xs"></i>
                            <span>Ganti foto hanya jika diperlukan untuk menjaga kualitas</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check text-green-500 mr-2 mt-1 text-xs"></i>
                            <span>Pastikan URL video baru valid sebelum menyimpan</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check text-green-500 mr-2 mt-1 text-xs"></i>
                            <span>Periksa preview sebelum menyimpan perubahan</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check text-green-500 mr-2 mt-1 text-xs"></i>
                            <span>Ubah status aktif untuk menyembunyikan sementara item</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div id="deleteModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center p-4 z-50 transition-opacity duration-300">
    <div class="bg-white rounded-lg shadow-xl max-w-md w-full p-6 transform transition-all duration-300 scale-95 opacity-0" id="modalContent">
        <div class="text-center">
            <div class="mx-auto flex items-center justify-center h-14 w-14 rounded-full bg-red-100 mb-4">
                <i class="fas fa-exclamation-triangle text-red-600 text-xl"></i>
            </div>
            <h3 class="text-lg font-medium text-gray-900 mb-2">Hapus Item Galeri?</h3>
            <p class="text-sm text-gray-500 mb-6">
                Item "{{ $gallery->title }}" akan dihapus permanen. Tindakan ini tidak dapat dibatalkan.
            </p>
            <div class="flex justify-center space-x-3">
                <button onclick="closeDeleteModal()" 
                        class="px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition-colors">
                    Batal
                </button>
                <form action="{{ route('admin.galleries.destroy', $gallery) }}" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" 
                            class="px-4 py-2 bg-red-600 text-white rounded-md text-sm font-medium hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-colors">
                        Ya, Hapus
                    </button>
                </form>
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
        const photoPreviewContainer = document.getElementById('photoPreviewContainer');
        const videoThumbnailInput = document.getElementById('video_thumbnail');

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
                photoPreviewContainer.classList.add('hidden');
                return;
            }

            // Validate file type
            const validImageTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif', 'image/webp'];
            if (!validImageTypes.includes(file.type)) {
                alert('Format file tidak didukung. Harap pilih file gambar (JPG, PNG, GIF, WebP).');
                event.target.value = '';
                photoPreviewContainer.classList.add('hidden');
                return;
            }

            // Validate file size (max 5MB)
            const maxSize = 5 * 1024 * 1024;
            if (file.size > maxSize) {
                alert('Ukuran file terlalu besar. Maksimal 5MB.');
                event.target.value = '';
                photoPreviewContainer.classList.add('hidden');
                return;
            }

            const reader = new FileReader();
            reader.onload = function(e) {
                previewImage.src = e.target.result;
                previewImage.classList.remove('hidden');
                if (photoPlaceholder) {
                    photoPlaceholder.classList.add('hidden');
                }
                photoPreviewContainer.classList.remove('hidden');
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

                if (selectedType.value === 'video') {
                    const videoUrl = document.getElementById('video_url');
                    const currentVideoUrl = "{{ $gallery->video_url ?? '' }}";
                    
                    // Only validate if changing to video type or changing video URL
                    if (selectedType.value === 'video' && 
                        (!videoUrl.value.trim() && !currentVideoUrl)) {
                        e.preventDefault();
                        alert('URL video harus diisi!');
                        videoUrl?.focus();
                        return;
                    }

                    // Validate URL format if provided
                    if (videoUrl.value.trim()) {
                        try {
                            new URL(videoUrl.value.trim());
                        } catch (_) {
                            e.preventDefault();
                            alert('URL video tidak valid!');
                            videoUrl.focus();
                            return;
                        }
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
    });

    // Delete Confirmation Modal
    function confirmDelete() {
        const modal = document.getElementById('deleteModal');
        const modalContent = document.getElementById('modalContent');
        modal.classList.remove('hidden');
        setTimeout(() => {
            modalContent.classList.remove('scale-95', 'opacity-0');
            modalContent.classList.add('scale-100', 'opacity-100');
        }, 10);
    }

    function closeDeleteModal() {
        const modal = document.getElementById('deleteModal');
        const modalContent = document.getElementById('modalContent');
        modalContent.classList.remove('scale-100', 'opacity-100');
        modalContent.classList.add('scale-95', 'opacity-0');
        setTimeout(() => {
            modal.classList.add('hidden');
        }, 300);
    }

    // Close modal when clicking outside or pressing escape
    document.getElementById('deleteModal')?.addEventListener('click', function(e) {
        if (e.target === this) {
            closeDeleteModal();
        }
    });

    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeDeleteModal();
        }
    });
</script>
@endpush