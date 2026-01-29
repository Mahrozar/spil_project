@extends('layouts.app')

@section('title', 'Edit Berita - ' . $news->title)
@section('breadcrumb')
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
                <a href="{{ route('admin.news.index') }}" class="text-gray-400 hover:text-gray-600">
                    Berita
                </a>
            </li>
            <li class="flex items-center">
                <i class="fas fa-chevron-right text-gray-400 text-xs mx-2"></i>
                <span class="text-gray-600 font-medium">Edit: {{ Str::limit($news->title, 30) }}</span>
            </li>
        </ol>
    </nav>

@endsection
@section('content')
    <div class="admin-content-area">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">


            <!-- Page Header -->
            <div class="mb-8">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                    <div>
                        <h1 class="text-2xl font-bold text-gray-900">Edit Berita</h1>
                        <p class="text-gray-600 mt-1">Perbarui informasi berita</p>
                        <div class="mt-2 flex items-center gap-2">
                            <span
                                class="inline-flex items-center px-2 py-1 rounded text-xs font-medium 
                            {{ $news->is_published ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                                <i class="fas fa-{{ $news->is_published ? 'globe' : 'save' }} mr-1 text-xs"></i>
                                {{ $news->is_published ? 'Dipublikasikan' : 'Draft' }}
                            </span>
                            <span class="text-xs text-gray-500">
                                <i class="far fa-clock mr-1"></i>
                                {{ $news->created_at->format('d M Y') }}
                            </span>
                        </div>
                    </div>

                    <div class="flex gap-3">
                        <a href="{{ route('admin.news.show', $news) }}"
                            class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition-colors">
                            <i class="fas fa-eye mr-2"></i>
                            Lihat
                        </a>
                        <a href="{{ route('admin.news.index') }}"
                            class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition-colors">
                            <i class="fas fa-arrow-left mr-2"></i>
                            Kembali
                        </a>
                    </div>
                </div>
            </div>

            <!-- Form Container -->
            <div class="bg-white shadow overflow-hidden sm:rounded-lg border border-gray-200">
                <form id="newsForm" method="POST" action="{{ route('admin.news.update', $news) }}"
                    enctype="multipart/form-data" class="divide-y divide-gray-200">
                    @csrf
                    @method('PUT')

                    <div class="px-4 py-5 sm:p-6 space-y-6">
                        <!-- Title -->
                        <div>
                            <label for="title" class="block text-sm font-medium text-gray-700 mb-2">
                                <i class="fas fa-heading mr-2 text-blue-500"></i>
                                Judul Berita <span class="text-red-500">*</span>
                            </label>
                            <input type="text" id="title" name="title" value="{{ old('title', $news->title) }}"
                                required
                                class="block w-full border border-gray-300 rounded-md shadow-sm py-3 px-4 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm transition-colors"
                                placeholder="Masukkan judul berita yang menarik">
                            @error('title')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Excerpt -->
                        <div>
                            <label for="excerpt" class="block text-sm font-medium text-gray-700 mb-2">
                                <i class="fas fa-align-left mr-2 text-blue-500"></i>
                                Ringkasan
                            </label>
                            <textarea id="excerpt" name="excerpt" rows="3"
                                class="block w-full border border-gray-300 rounded-md shadow-sm py-3 px-4 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm transition-colors"
                                placeholder="Ringkasan singkat berita (akan ditampilkan di halaman daftar)">{{ old('excerpt', $news->excerpt) }}</textarea>
                            <div class="flex justify-between mt-1">
                                <p class="text-xs text-gray-500">Maksimal 500 karakter</p>
                                <p id="excerptCounter" class="text-xs text-gray-500">
                                    {{ Str::length(old('excerpt', $news->excerpt)) }}/500</p>
                            </div>
                            @error('excerpt')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Content -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                <i class="fas fa-newspaper mr-2 text-blue-500"></i>
                                Konten Berita <span class="text-red-500">*</span>
                            </label>

                            <!-- Rich Text Editor Toolbar -->
                            <div class="mb-2 border border-gray-300 rounded-t-lg bg-gray-50 p-2 flex flex-wrap gap-2">
                                <button type="button" onclick="formatText('bold')"
                                    class="p-2 rounded hover:bg-gray-200 transition-colors" title="Bold">
                                    <i class="fas fa-bold"></i>
                                </button>
                                <button type="button" onclick="formatText('italic')"
                                    class="p-2 rounded hover:bg-gray-200 transition-colors" title="Italic">
                                    <i class="fas fa-italic"></i>
                                </button>
                                <button type="button" onclick="formatText('underline')"
                                    class="p-2 rounded hover:bg-gray-200 transition-colors" title="Underline">
                                    <i class="fas fa-underline"></i>
                                </button>
                                <div class="w-px h-6 bg-gray-300"></div>
                                <button type="button" onclick="insertHeading(1)"
                                    class="p-2 rounded hover:bg-gray-200 transition-colors" title="Heading 1">
                                    <i class="fas fa-heading text-sm"></i> 1
                                </button>
                                <button type="button" onclick="insertHeading(2)"
                                    class="p-2 rounded hover:bg-gray-200 transition-colors" title="Heading 2">
                                    <i class="fas fa-heading text-sm"></i> 2
                                </button>
                                <button type="button" onclick="insertHeading(3)"
                                    class="p-2 rounded hover:bg-gray-200 transition-colors" title="Heading 3">
                                    <i class="fas fa-heading text-sm"></i> 3
                                </button>
                                <div class="w-px h-6 bg-gray-300"></div>
                                <button type="button" onclick="insertList('ordered')"
                                    class="p-2 rounded hover:bg-gray-200 transition-colors" title="Ordered List">
                                    <i class="fas fa-list-ol"></i>
                                </button>
                                <button type="button" onclick="insertList('unordered')"
                                    class="p-2 rounded hover:bg-gray-200 transition-colors" title="Unordered List">
                                    <i class="fas fa-list-ul"></i>
                                </button>
                                <div class="w-px h-6 bg-gray-300"></div>
                                <button type="button" onclick="insertLink()"
                                    class="p-2 rounded hover:bg-gray-200 transition-colors" title="Insert Link">
                                    <i class="fas fa-link"></i>
                                </button>
                                <button type="button" onclick="insertImage()"
                                    class="p-2 rounded hover:bg-gray-200 transition-colors" title="Insert Image">
                                    <i class="fas fa-image"></i>
                                </button>
                                <button type="button" onclick="clearFormatting()"
                                    class="p-2 rounded hover:bg-gray-200 text-red-500 transition-colors"
                                    title="Clear Formatting">
                                    <i class="fas fa-eraser"></i>
                                </button>
                            </div>

                            <!-- Content Textarea -->
                            <textarea id="content" name="content" rows="15"
                                class="block w-full border border-gray-300 border-t-0 rounded-b-lg shadow-sm py-3 px-4 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm transition-colors resize-none"
                                placeholder="Tulis konten berita Anda di sini...">{{ old('content', $news->content) }}</textarea>

                            <!-- Character Count -->
                            <div class="flex justify-between mt-1">
                                <p class="text-xs text-gray-500">Tulis konten berita dengan baik</p>
                                <p id="contentCounter" class="text-xs text-gray-500">0 karakter, 0 kata</p>
                            </div>

                            @error('content')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Thumbnail Upload -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                <i class="fas fa-image mr-2 text-blue-500"></i>
                                Thumbnail Berita
                            </label>
                            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                                <div class="lg:col-span-2">
                                    <div id="uploadArea"
                                        class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:border-blue-400 transition-colors cursor-pointer bg-gray-50 hover:bg-blue-50">
                                        <div class="space-y-3">
                                            <i class="fas fa-cloud-upload-alt text-4xl text-gray-400"></i>
                                            <div>
                                                <p class="text-sm font-medium text-gray-700" id="uploadText">
                                                    @if ($news->thumbnail)
                                                        Thumbnail sudah diupload
                                                    @else
                                                        Upload thumbnail
                                                    @endif
                                                </p>
                                                <p class="text-xs text-gray-500 mt-1">Klik atau drag & drop untuk memilih
                                                    file</p>
                                            </div>
                                            <input type="file" id="thumbnail" name="thumbnail" accept="image/*"
                                                class="hidden">

                                            <!-- Hidden input untuk menyimpan path gambar lama -->
                                            <input type="hidden" id="existing_thumbnail" name="existing_thumbnail"
                                                value="{{ $news->thumbnail }}">

                                            <button type="button" onclick="document.getElementById('thumbnail').click()"
                                                class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-md text-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
                                                <i class="fas fa-image mr-2"></i>
                                                {{ $news->thumbnail ? 'Ganti Gambar' : 'Pilih Gambar' }}
                                            </button>
                                            @if ($news->thumbnail)
                                                <button type="button" onclick="removeThumbnail()"
                                                    class="ml-2 inline-flex items-center px-4 py-2 bg-red-600 text-white rounded-md text-sm hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-colors">
                                                    <i class="fas fa-trash-alt mr-2"></i>
                                                    Hapus
                                                </button>
                                            @endif
                                            <p class="text-xs text-gray-500">Ukuran maksimal 2MB. Format: JPG, PNG, GIF</p>
                                        </div>
                                    </div>
                                    @error('thumbnail')
                                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Preview Thumbnail -->
                                <div>
                                    <div class="border border-gray-300 rounded-lg p-4 bg-gray-50 h-full">
                                        <p class="text-sm font-medium text-gray-700 mb-3">Preview Thumbnail</p>
                                        <div id="imagePreviewContainer" class="relative">
                                            <!-- Placeholder -->
                                            <div id="previewPlaceholder"
                                                class="aspect-video bg-gray-200 rounded-lg flex items-center justify-center {{ $news->thumbnail ? 'hidden' : '' }}">
                                                <div class="text-center">
                                                    <i class="fas fa-image text-3xl text-gray-400 mb-2"></i>
                                                    <p class="text-sm text-gray-500">Belum ada thumbnail</p>
                                                </div>
                                            </div>

                                            <!-- Image Preview -->
                                            @if ($news->thumbnail)
                                                <img id="imagePreview" src="{{ $news->thumbnail_url }}" alt="Preview"
                                                    class="w-full h-48 object-cover rounded-lg">
                                            @else
                                                <img id="imagePreview" src="" alt="Preview"
                                                    class="hidden w-full h-48 object-cover rounded-lg">
                                            @endif
                                        </div>
                                        <p class="text-xs text-gray-500 mt-3">Thumbnail akan ditampilkan di halaman daftar
                                            berita</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Author & Publish Date -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Author -->
                            <div>
                                <label for="author_id" class="block text-sm font-medium text-gray-700 mb-2">
                                    <i class="fas fa-user-edit mr-2 text-blue-500"></i>
                                    Penulis <span class="text-red-500">*</span>
                                </label>
                                <select id="author_id" name="author_id" required
                                    class="block w-full border border-gray-300 rounded-md shadow-sm py-3 px-4 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm bg-white">
                                    <option value="">Pilih Penulis</option>
                                    @foreach ($authors as $author)
                                        <option value="{{ $author->id }}"
                                            {{ old('author_id', $news->author_id) == $author->id ? 'selected' : '' }}>
                                            {{ $author->name }} ({{ $author->role }})
                                        </option>
                                    @endforeach
                                </select>
                                @error('author_id')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Publish Date -->
                            <div>
                                <label for="published_at" class="block text-sm font-medium text-gray-700 mb-2">
                                    <i class="far fa-calendar-alt mr-2 text-blue-500"></i>
                                    Tanggal Publikasi
                                </label>
                                <input type="datetime-local" id="published_at" name="published_at"
                                    value="{{ old('published_at', $news->published_at ? $news->published_at->format('Y-m-d\TH:i') : '') }}"
                                    class="block w-full border border-gray-300 rounded-md shadow-sm py-3 px-4 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                <p class="text-xs text-gray-500 mt-1">Kosongkan untuk menggunakan tanggal saat ini</p>
                                @error('published_at')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Publish Status -->
                        <div class="bg-blue-50 border border-blue-200 rounded-lg p-6">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center space-x-4">
                                    <div class="flex items-center">
                                        <input type="checkbox" name="is_published" value="1" id="is_published"
                                            {{ old('is_published', $news->is_published) ? 'checked' : '' }}
                                            class="sr-only">
                                        <div id="toggleButton"
                                            class="w-14 h-7 flex items-center {{ $news->is_published ? 'bg-blue-600' : 'bg-gray-300' }} rounded-full p-1 cursor-pointer transition-colors">
                                            <div id="toggleDot"
                                                class="bg-white w-5 h-5 rounded-full shadow-md transform transition-transform {{ $news->is_published ? 'translate-x-7' : '' }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        <label for="is_published"
                                            class="text-sm font-medium text-gray-900 cursor-pointer">
                                            Status Publikasi
                                        </label>
                                        <p class="text-xs text-gray-600 mt-1">
                                            Aktifkan untuk mempublikasikan berita
                                        </p>
                                    </div>
                                </div>

                                <div id="publishStatus" class="text-sm text-gray-600">
                                    @if ($news->is_published)
                                        <span class="inline-flex items-center text-green-600">
                                            <i class="fas fa-globe mr-2"></i>
                                            Dipublikasikan
                                        </span>
                                    @else
                                        <span class="inline-flex items-center text-yellow-600">
                                            <i class="fas fa-save mr-2"></i>
                                            Draft
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Last Updated Info -->
                        <div class="bg-gray-50 border border-gray-200 rounded-lg p-4">
                            <div class="flex items-center text-sm text-gray-600">
                                <i class="fas fa-history mr-2 text-gray-400"></i>
                                <span>Terakhir diperbarui: {{ $news->updated_at->format('d M Y H:i') }}
                                    @if ($news->author)
                                        oleh {{ $news->author->name }}
                                    @endif
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Form Actions -->
                    <div class="px-4 py-4 sm:px-6 bg-gray-50">
                        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                            <div class="text-sm text-gray-500">
                                <i class="fas fa-asterisk text-red-500 text-xs mr-1"></i>
                                Menandakan field wajib diisi
                            </div>
                            <div class="flex flex-wrap gap-3">
                                <button type="button" onclick="window.history.back()"
                                    class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition-colors">
                                    Batal
                                </button>
                                <button type="button" id="saveDraftBtn"
                                    class="inline-flex items-center px-4 py-2 border border-yellow-300 text-yellow-700 bg-yellow-50 hover:bg-yellow-100 rounded-md shadow-sm text-sm font-medium focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500 transition-colors">
                                    <i class="fas fa-save mr-2"></i>
                                    Simpan Draft
                                </button>
                                <button type="submit"
                                    class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
                                    <i class="fas fa-sync-alt mr-2"></i>
                                    Perbarui Berita
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
                        <h3 class="text-lg font-medium text-gray-900 mb-2">Tips Edit Berita yang Baik</h3>
                        <ul class="space-y-2 text-gray-600">
                            <li class="flex items-start">
                                <i class="fas fa-check text-green-500 mr-2 mt-1 text-xs"></i>
                                <span>Periksa dan perbaiki kesalahan penulisan</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check text-green-500 mr-2 mt-1 text-xs"></i>
                                <span>Update informasi yang sudah tidak relevan</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check text-green-500 mr-2 mt-1 text-xs"></i>
                                <span>Tambahkan informasi baru jika diperlukan</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check text-green-500 mr-2 mt-1 text-xs"></i>
                                <span>Perbarui thumbnail jika diperlukan</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check text-green-500 mr-2 mt-1 text-xs"></i>
                                <span>Preview sebelum menyimpan perubahan</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <style>
        #toggleButton.is-active {
            background-color: #3b82f6;
        }

        #toggleDot.is-active {
            transform: translateX(1.75rem);
        }

        #imagePreview {
            max-height: 200px;
            object-fit: cover;
        }

        .notification {
            position: fixed;
            bottom: 1rem;
            right: 1rem;
            z-index: 9999;
            animation: slideIn 0.3s ease-out;
        }

        @keyframes slideIn {
            from {
                transform: translateX(100%);
                opacity: 0;
            }

            to {
                transform: translateX(0);
                opacity: 1;
            }
        }

        @keyframes fadeOut {
            from {
                opacity: 1;
            }

            to {
                opacity: 0;
            }
        }

        /* Custom scrollbar for textarea */
        #content {
            scrollbar-width: thin;
            scrollbar-color: #cbd5e0 #f1f1f1;
        }

        #content::-webkit-scrollbar {
            width: 8px;
        }

        #content::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 4px;
        }

        #content::-webkit-scrollbar-thumb {
            background: #cbd5e0;
            border-radius: 4px;
        }

        #content::-webkit-scrollbar-thumb:hover {
            background: #a0aec0;
        }
    </style>
@endpush

@push('scripts')
    <script>
        // Initialize content counter
        function updateContentCounter() {
            const content = document.getElementById('content').value;
            const counter = document.getElementById('contentCounter');
            const charCount = content.length;
            const wordCount = content.trim().split(/\s+/).filter(word => word.length > 0).length;

            counter.textContent = `${charCount} karakter, ${wordCount} kata`;

            if (charCount > 5000) {
                counter.classList.add('text-green-600');
                counter.classList.remove('text-gray-500');
            } else {
                counter.classList.remove('text-green-600');
                counter.classList.add('text-gray-500');
            }
        }

        // Text formatting functions
        function formatText(command) {
            const textarea = document.getElementById('content');
            const start = textarea.selectionStart;
            const end = textarea.selectionEnd;
            const selectedText = textarea.value.substring(start, end);
            let formattedText = '';

            switch (command) {
                case 'bold':
                    formattedText = `<strong>${selectedText}</strong>`;
                    break;
                case 'italic':
                    formattedText = `<em>${selectedText}</em>`;
                    break;
                case 'underline':
                    formattedText = `<u>${selectedText}</u>`;
                    break;
            }

            textarea.value = textarea.value.substring(0, start) + formattedText + textarea.value.substring(end);
            updateContentCounter();
        }

        function insertHeading(level) {
            const textarea = document.getElementById('content');
            const start = textarea.selectionStart;
            const end = textarea.selectionEnd;
            const selectedText = textarea.value.substring(start, end);
            const heading = `<h${level}>${selectedText || 'Heading'}</h${level}>\n`;

            textarea.value = textarea.value.substring(0, start) + heading + textarea.value.substring(end);
            updateContentCounter();
        }

        function insertList(type) {
            const textarea = document.getElementById('content');
            const start = textarea.selectionStart;
            const end = textarea.selectionEnd;
            const selectedText = textarea.value.substring(start, end);

            let listItem = '';
            if (selectedText) {
                if (type === 'ordered') {
                    listItem = `<ol><li>${selectedText}</li></ol>\n`;
                } else {
                    listItem = `<ul><li>${selectedText}</li></ul>\n`;
                }
            } else {
                if (type === 'ordered') {
                    listItem = '<ol>\n<li>Item 1</li>\n<li>Item 2</li>\n</ol>\n';
                } else {
                    listItem = '<ul>\n<li>Item 1</li>\n<li>Item 2</li>\n</ul>\n';
                }
            }

            textarea.value = textarea.value.substring(0, start) + listItem + textarea.value.substring(end);
            updateContentCounter();
        }

        function insertLink() {
            const url = prompt('Masukkan URL:', 'https://');
            if (url) {
                const text = prompt('Masukkan teks untuk link:', 'Link');
                const link = `<a href="${url}" target="_blank" rel="noopener noreferrer">${text || url}</a>`;

                const textarea = document.getElementById('content');
                const start = textarea.selectionStart;
                textarea.value = textarea.value.substring(0, start) + link + textarea.value.substring(start);
                updateContentCounter();
            }
        }

        function insertImage() {
            const url = prompt('Masukkan URL gambar:', 'https://');
            if (url) {
                const alt = prompt('Masukkan teks alternatif (alt text):', 'Gambar');
                const img = `<img src="${url}" alt="${alt || 'Gambar'}" style="max-width: 100%; height: auto;">`;

                const textarea = document.getElementById('content');
                const start = textarea.selectionStart;
                textarea.value = textarea.value.substring(0, start) + img + textarea.value.substring(start);
                updateContentCounter();
            }
        }

        function clearFormatting() {
            const textarea = document.getElementById('content');
            const start = textarea.selectionStart;
            const end = textarea.selectionEnd;
            const selectedText = textarea.value.substring(start, end);

            // Remove HTML tags but keep the text
            const plainText = selectedText.replace(/<[^>]*>/g, '');

            textarea.value = textarea.value.substring(0, start) + plainText + textarea.value.substring(end);
            updateContentCounter();
        }

        // Image preview functionality
        document.getElementById('thumbnail').addEventListener('change', function(event) {
            const file = event.target.files[0];
            const imagePreview = document.getElementById('imagePreview');
            const previewPlaceholder = document.getElementById('previewPlaceholder');
            const uploadText = document.getElementById('uploadText');
            const uploadArea = document.getElementById('uploadArea');

            if (file) {
                // Validate file size (max 2MB)
                if (file.size > 2 * 1024 * 1024) {
                    showNotification('Ukuran file terlalu besar. Maksimal 2MB.', 'error');
                    event.target.value = '';
                    return;
                }

                // Validate file type
                const validTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif'];
                if (!validTypes.includes(file.type)) {
                    showNotification('Format file tidak didukung. Gunakan JPG, PNG, atau GIF.', 'error');
                    event.target.value = '';
                    return;
                }

                const reader = new FileReader();
                reader.onload = function(e) {
                    imagePreview.src = e.target.result;
                    imagePreview.classList.remove('hidden');
                    if (previewPlaceholder) previewPlaceholder.classList.add('hidden');
                    uploadText.textContent = file.name;
                    uploadText.classList.add('text-green-600');
                    uploadArea.classList.add('border-green-400', 'bg-green-50');
                };
                reader.readAsDataURL(file);
            }
        });

        // Remove thumbnail functionality
        function removeThumbnail() {
            if (confirm('Apakah Anda yakin ingin menghapus thumbnail ini?')) {
                // Hide the image preview
                const imagePreview = document.getElementById('imagePreview');
                const previewPlaceholder = document.getElementById('previewPlaceholder');
                const uploadText = document.getElementById('uploadText');
                const uploadArea = document.getElementById('uploadArea');
                const existingThumbnailInput = document.getElementById('existing_thumbnail');
                const thumbnailInput = document.getElementById('thumbnail');

                imagePreview.classList.add('hidden');
                if (previewPlaceholder) previewPlaceholder.classList.remove('hidden');
                uploadText.textContent = 'Upload thumbnail';
                uploadText.classList.remove('text-green-600');
                uploadArea.classList.remove('border-green-400', 'bg-green-50');

                // Clear the existing thumbnail value
                if (existingThumbnailInput) {
                    existingThumbnailInput.value = '';
                }

                // Clear the file input
                if (thumbnailInput) {
                    thumbnailInput.value = '';
                }

                // Change button text
                const uploadButton = uploadArea.querySelector('button');
                if (uploadButton) {
                    uploadButton.innerHTML = '<i class="fas fa-image mr-2"></i>Pilih Gambar';
                }

                // Remove remove button
                const removeButton = uploadArea.querySelector('button.bg-red-600');
                if (removeButton) {
                    removeButton.remove();
                }

                showNotification('Thumbnail berhasil dihapus', 'success');
            }
        }

        // Drag and drop functionality
        const uploadArea = document.getElementById('uploadArea');
        const thumbnailInput = document.getElementById('thumbnail');

        if (uploadArea && thumbnailInput) {
            uploadArea.addEventListener('dragover', function(e) {
                e.preventDefault();
                uploadArea.classList.add('border-blue-400', 'bg-blue-50');
            });

            uploadArea.addEventListener('dragleave', function(e) {
                e.preventDefault();
                uploadArea.classList.remove('border-blue-400', 'bg-blue-50');
            });

            uploadArea.addEventListener('drop', function(e) {
                e.preventDefault();
                uploadArea.classList.remove('border-blue-400', 'bg-blue-50');

                if (e.dataTransfer.files.length) {
                    thumbnailInput.files = e.dataTransfer.files;
                    const event = new Event('change', {
                        bubbles: true
                    });
                    thumbnailInput.dispatchEvent(event);
                }
            });
        }

        // Excerpt character counter
        const excerptTextarea = document.getElementById('excerpt');
        const excerptCounter = document.getElementById('excerptCounter');

        function updateExcerptCounter() {
            if (!excerptTextarea || !excerptCounter) return;

            const length = excerptTextarea.value.length;
            excerptCounter.textContent = `${length}/500`;

            if (length > 500) {
                excerptCounter.classList.add('text-red-500');
                excerptCounter.classList.remove('text-gray-500');
            } else {
                excerptCounter.classList.remove('text-red-500');
                excerptCounter.classList.add('text-gray-500');
            }
        }

        if (excerptTextarea && excerptCounter) {
            excerptTextarea.addEventListener('input', updateExcerptCounter);
            updateExcerptCounter(); // Initial count
        }

        // Publish toggle functionality
        const publishCheckbox = document.getElementById('is_published');
        const toggleButton = document.getElementById('toggleButton');
        const toggleDot = document.getElementById('toggleDot');
        const publishStatus = document.getElementById('publishStatus');

        function updatePublishToggle() {
            if (!publishCheckbox || !toggleButton || !toggleDot || !publishStatus) return;

            if (publishCheckbox.checked) {
                toggleButton.classList.add('is-active');
                toggleDot.classList.add('is-active');
                publishStatus.innerHTML = `
                <span class="inline-flex items-center text-green-600">
                    <i class="fas fa-globe mr-2"></i>
                    Dipublikasikan
                </span>
            `;
            } else {
                toggleButton.classList.remove('is-active');
                toggleDot.classList.remove('is-active');
                publishStatus.innerHTML = `
                <span class="inline-flex items-center text-yellow-600">
                    <i class="fas fa-save mr-2"></i>
                    Draft
                </span>
            `;
            }
        }

        if (toggleButton && publishCheckbox) {
            toggleButton.addEventListener('click', function() {
                publishCheckbox.checked = !publishCheckbox.checked;
                updatePublishToggle();
            });
        }

        if (publishCheckbox) {
            publishCheckbox.addEventListener('change', updatePublishToggle);
        }
        updatePublishToggle(); // Initial state

        // Save draft button
        const saveDraftBtn = document.getElementById('saveDraftBtn');
        if (saveDraftBtn) {
            saveDraftBtn.addEventListener('click', function() {
                if (publishCheckbox) publishCheckbox.checked = false;
                updatePublishToggle();
                document.getElementById('newsForm').submit();
            });
        }

        // Form validation
        const newsForm = document.getElementById('newsForm');
        if (newsForm) {
            newsForm.addEventListener('submit', function(e) {
                // Validate required fields
                const title = document.getElementById('title')?.value.trim();
                const content = document.getElementById('content')?.value.trim();
                const author = document.getElementById('author_id')?.value;
                const excerpt = excerptTextarea?.value;

                let isValid = true;
                let errorMessage = '';

                if (!title) {
                    errorMessage = 'Judul berita harus diisi!';
                    document.getElementById('title').focus();
                    isValid = false;
                } else if (content && content.length < 10) {
                    errorMessage = 'Konten berita terlalu pendek! Minimal 10 karakter.';
                    document.getElementById('content').focus();
                    isValid = false;
                } else if (!author) {
                    errorMessage = 'Penulis harus dipilih!';
                    document.getElementById('author_id').focus();
                    isValid = false;
                } else if (excerpt && excerpt.length > 500) {
                    errorMessage = 'Ringkasan terlalu panjang! Maksimal 500 karakter.';
                    excerptTextarea.focus();
                    isValid = false;
                }

                if (!isValid) {
                    e.preventDefault();
                    showNotification(errorMessage, 'error');
                } else {
                    // Show loading state
                    const submitBtn = this.querySelector('button[type="submit"]');
                    if (submitBtn) {
                        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Menyimpan...';
                        submitBtn.disabled = true;
                    }
                }
            });
        }

        // Notification function
        function showNotification(message, type = 'info') {
            // Remove existing notifications
            const existingNotifications = document.querySelectorAll('.notification');
            existingNotifications.forEach(notification => notification.remove());

            // Create notification element
            const notification = document.createElement('div');
            notification.className = `notification px-4 py-3 rounded-lg shadow-lg text-sm flex items-center max-w-md`;

            let bgColor = 'bg-blue-100 text-blue-800';
            let icon = 'fa-info-circle';

            if (type === 'success') {
                bgColor = 'bg-green-100 text-green-800';
                icon = 'fa-check-circle';
            } else if (type === 'error') {
                bgColor = 'bg-red-100 text-red-800';
                icon = 'fa-exclamation-circle';
            } else if (type === 'warning') {
                bgColor = 'bg-yellow-100 text-yellow-800';
                icon = 'fa-exclamation-triangle';
            }

            notification.className += ` ${bgColor}`;
            notification.innerHTML = `
            <i class="fas ${icon} mr-2"></i>
            <span>${message}</span>
        `;

            document.body.appendChild(notification);

            // Auto remove after 3 seconds
            setTimeout(() => {
                notification.style.animation = 'fadeOut 0.3s ease-out';
                setTimeout(() => notification.remove(), 300);
            }, 3000);
        }

        // Initialize content counter on load
        document.addEventListener('DOMContentLoaded', function() {
            updateContentCounter();

            // Content counter update
            const contentTextarea = document.getElementById('content');
            if (contentTextarea) {
                contentTextarea.addEventListener('input', updateContentCounter);
            }

            // Warn before leaving if unsaved changes
            window.addEventListener('beforeunload', function(e) {
                const title = document.getElementById('title')?.value;
                const originalTitle = '{{ $news->title }}';
                const content = document.getElementById('content')?.value;
                const originalContent = '{{ $news->content }}';

                if ((title && title !== originalTitle) || (content && content !== originalContent)) {
                    e.preventDefault();
                    e.returnValue =
                        'Anda memiliki perubahan yang belum disimpan. Apakah Anda yakin ingin meninggalkan halaman?';
                }
            });
        });
    </script>
@endpush
