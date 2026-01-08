<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Berita Baru - Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Quill Editor -->
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <style>
        .ql-editor {
            min-height: 300px;
        }
        .ql-container {
            font-size: 16px;
        }
        .fade-in {
            animation: fadeIn 0.3s ease-in-out;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .preview-image {
            transition: all 0.3s ease;
        }
        .preview-image:hover {
            transform: scale(1.05);
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
                        <a href="/admin/dashboard" class="text-gray-600 hover:text-gray-900 px-3 py-2 text-sm font-medium">Dashboard</a>
                        <a href="/admin/letters" class="text-gray-600 hover:text-gray-900 px-3 py-2 text-sm font-medium">Surat</a>
                        <a href="/admin/news" class="bg-blue-100 text-blue-700 px-3 py-2 text-sm font-medium rounded-md">Berita</a>
                        <a href="/admin/reports" class="text-gray-600 hover:text-gray-900 px-3 py-2 text-sm font-medium">Laporan</a>
                    </nav>
                </div>
                <div class="flex items-center space-x-4">
                    <div class="relative">
                        <button class="flex items-center text-gray-700 hover:text-gray-900">
                            <div class="h-8 w-8 rounded-full bg-blue-100 flex items-center justify-center text-blue-700 font-semibold">
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

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Page Header -->
        <div class="mb-8">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div>
                    <h2 class="text-2xl font-bold text-gray-900">Tambah Berita Baru</h2>
                    <p class="text-gray-600 mt-1">Isi formulir untuk menambahkan berita baru.</p>
                </div>
                
                <div class="flex gap-3">
                    <a href="{{ route('admin.news.index') }}" class="bg-gray-200 text-gray-700 rounded-md px-4 py-2 text-sm hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-500 flex items-center">
                        <i class="fas fa-arrow-left mr-2"></i>
                        Kembali
                    </a>
                </div>
            </div>
        </div>

        <!-- Form Container -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
            <form id="newsForm" method="POST" action="{{ route('admin.news.store') }}" enctype="multipart/form-data" class="fade-in">
                @csrf
                
                <div class="p-6 space-y-8">
                    <!-- Title -->
                    <div>
                        <label for="title" class="block text-sm font-medium text-gray-700 mb-2">
                            Judul Berita <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="title" name="title" value="{{ old('title') }}" required
                            class="w-full border border-gray-300 rounded-md px-4 py-3 text-base focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                            placeholder="Masukkan judul berita yang menarik">
                        @error('title')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Excerpt -->
                    <div>
                        <label for="excerpt" class="block text-sm font-medium text-gray-700 mb-2">
                            Ringkasan
                        </label>
                        <textarea id="excerpt" name="excerpt" rows="3"
                            class="w-full border border-gray-300 rounded-md px-4 py-3 text-base focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                            placeholder="Ringkasan singkat berita (akan ditampilkan di halaman daftar)">{{ old('excerpt') }}</textarea>
                        <div class="flex justify-between mt-1">
                            <p class="text-xs text-gray-500">Maksimal 500 karakter.</p>
                            <p id="excerptCounter" class="text-xs text-gray-500">0/500</p>
                        </div>
                        @error('excerpt')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Content -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Konten Berita <span class="text-red-500">*</span>
                        </label>
                        <div id="editor-container" class="border border-gray-300 rounded-md overflow-hidden">
                            <div id="editor"></div>
                        </div>
                        <input type="hidden" id="content" name="content" value="{{ old('content') }}">
                        @error('content')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Thumbnail Upload -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Thumbnail Berita
                        </label>
                        <div class="flex flex-col lg:flex-row gap-6">
                            <div class="lg:w-2/3">
                                <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:border-blue-400 transition-colors">
                                    <div class="space-y-4">
                                        <i class="fas fa-cloud-upload-alt text-4xl text-gray-400"></i>
                                        <div>
                                            <p class="text-sm font-medium text-gray-700">Upload thumbnail</p>
                                            <p class="text-xs text-gray-500 mt-1">Drag & drop atau klik untuk memilih file</p>
                                        </div>
                                        <input type="file" id="thumbnail" name="thumbnail" accept="image/*" 
                                            class="hidden" onchange="previewImage(event)">
                                        <label for="thumbnail" class="cursor-pointer inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-md text-sm hover:bg-blue-700">
                                            <i class="fas fa-image mr-2"></i>
                                            Pilih Gambar
                                        </label>
                                        <p class="text-xs text-gray-500">Ukuran maksimal 2MB. Format: JPG, PNG, GIF.</p>
                                    </div>
                                </div>
                                @error('thumbnail')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <div class="lg:w-1/3">
                                <div class="border border-gray-300 rounded-lg p-4 bg-gray-50">
                                    <p class="text-sm font-medium text-gray-700 mb-3">Preview Thumbnail</p>
                                    <div id="imagePreviewContainer" class="relative">
                                        <div id="previewPlaceholder" class="aspect-video bg-gray-200 rounded-lg flex items-center justify-center">
                                            <div class="text-center">
                                                <i class="fas fa-image text-3xl text-gray-400 mb-2"></i>
                                                <p class="text-sm text-gray-500">Belum ada thumbnail</p>
                                            </div>
                                        </div>
                                        <img id="previewImage" src="" alt="Preview" class="hidden w-full h-auto rounded-lg preview-image">
                                    </div>
                                    <p class="text-xs text-gray-500 mt-3">Thumbnail akan ditampilkan di halaman daftar berita.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Author & Publish Date -->
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                        <!-- Author -->
                        <div>
                            <label for="author_id" class="block text-sm font-medium text-gray-700 mb-2">
                                Penulis <span class="text-red-500">*</span>
                            </label>
                            <select id="author_id" name="author_id" required
                                class="w-full border border-gray-300 rounded-md px-4 py-3 text-base focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors appearance-none bg-white">
                                <option value="">Pilih Penulis</option>
                                @foreach($authors as $author)
                                    <option value="{{ $author->id }}" {{ old('author_id') == $author->id ? 'selected' : '' }}>
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
                                Tanggal Publikasi
                            </label>
                            <input type="datetime-local" id="published_at" name="published_at"
                                value="{{ old('published_at') }}"
                                class="w-full border border-gray-300 rounded-md px-4 py-3 text-base focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                            <p class="text-xs text-gray-500 mt-1">Kosongkan untuk menggunakan tanggal saat ini</p>
                            @error('published_at')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Publish Status -->
                    <div class="bg-blue-50 border border-blue-200 rounded-lg p-6">
                        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                            <div>
                                <label class="flex items-center space-x-3 cursor-pointer">
                                    <div class="relative">
                                        <input type="checkbox" name="is_published" value="1" id="is_published"
                                            {{ old('is_published') ? 'checked' : '' }}
                                            class="sr-only">
                                        <div class="w-10 h-6 bg-gray-300 rounded-full toggle-bg"></div>
                                        <div class="absolute left-1 top-1 bg-white w-4 h-4 rounded-full transition toggle-dot"></div>
                                    </div>
                                    <div>
                                        <span class="text-sm font-medium text-gray-900">Publikasikan sekarang</span>
                                        <p class="text-xs text-gray-600 mt-1">Jika dimatikan, berita akan disimpan sebagai draft.</p>
                                    </div>
                                </label>
                            </div>
                            
                            <div id="publishInfo" class="text-sm text-gray-600 {{ !old('is_published') ? 'hidden' : '' }}">
                                <i class="fas fa-globe mr-2 text-green-500"></i>
                                <span>Berita akan langsung dipublikasikan</span>
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
                            <button type="button" onclick="window.history.back()" class="px-6 py-3 border border-gray-300 rounded-md text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-gray-500 transition-colors">
                                Batal
                            </button>
                            <button type="button" id="saveDraftBtn" class="px-6 py-3 border border-yellow-300 rounded-md text-sm font-medium text-yellow-700 bg-yellow-50 hover:bg-yellow-100 focus:outline-none focus:ring-2 focus:ring-yellow-500 transition-colors">
                                Simpan Draft
                            </button>
                            <button type="submit" class="px-6 py-3 bg-blue-600 text-white rounded-md text-sm font-medium hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-colors">
                                <i class="fas fa-paper-plane mr-2"></i>
                                Simpan & Terbitkan
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
                    <h3 class="text-lg font-medium text-gray-900 mb-2">Tips Menulis Berita yang Baik</h3>
                    <ul class="space-y-2 text-gray-600">
                        <li class="flex items-start">
                            <i class="fas fa-check text-green-500 mr-2 mt-1 text-xs"></i>
                            <span>Gunakan judul yang menarik dan informatif</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check text-green-500 mr-2 mt-1 text-xs"></i>
                            <span>Buat ringkasan yang jelas dan padat</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check text-green-500 mr-2 mt-1 text-xs"></i>
                            <span>Gunakan gambar thumbnail yang relevan dan berkualitas</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check text-green-500 mr-2 mt-1 text-xs"></i>
                            <span>Struktur konten dengan paragraf yang jelas</span>
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

    <!-- Quill Editor JS -->
    <script src="https://cdn.quilljs.com/1.3.6/quill.min.js"></script>
    
    <script>
        // Initialize Quill Editor
        const quill = new Quill('#editor', {
            theme: 'snow',
            modules: {
                toolbar: [
                    [{ 'header': [1, 2, 3, false] }],
                    ['bold', 'italic', 'underline', 'strike'],
                    [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                    [{ 'color': [] }, { 'background': [] }],
                    ['link', 'image'],
                    ['clean']
                ]
            },
            placeholder: 'Tulis konten berita Anda di sini...'
        });

        // Set initial content if exists
        const initialContent = document.getElementById('content').value;
        if (initialContent) {
            quill.root.innerHTML = initialContent;
        }

        // Update hidden input on content change
        quill.on('text-change', function() {
            document.getElementById('content').value = quill.root.innerHTML;
        });

        // Image preview functionality
        function previewImage(event) {
            const file = event.target.files[0];
            const previewImage = document.getElementById('previewImage');
            const previewPlaceholder = document.getElementById('previewPlaceholder');
            
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    previewImage.src = e.target.result;
                    previewImage.classList.remove('hidden');
                    previewPlaceholder.classList.add('hidden');
                }
                reader.readAsDataURL(file);
            }
        }

        // Excerpt character counter
        const excerptTextarea = document.getElementById('excerpt');
        const excerptCounter = document.getElementById('excerptCounter');
        
        function updateExcerptCounter() {
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
        
        excerptTextarea.addEventListener('input', updateExcerptCounter);
        updateExcerptCounter(); // Initial count

        // Toggle publish status
        const publishCheckbox = document.getElementById('is_published');
        const publishInfo = document.getElementById('publishInfo');
        const toggleBg = document.querySelector('.toggle-bg');
        const toggleDot = document.querySelector('.toggle-dot');

        function updatePublishToggle() {
            if (publishCheckbox.checked) {
                toggleBg.classList.remove('bg-gray-300');
                toggleBg.classList.add('bg-blue-600');
                toggleDot.style.transform = 'translateX(1rem)';
                publishInfo.classList.remove('hidden');
            } else {
                toggleBg.classList.remove('bg-blue-600');
                toggleBg.classList.add('bg-gray-300');
                toggleDot.style.transform = 'translateX(0)';
                publishInfo.classList.add('hidden');
            }
        }

        publishCheckbox.addEventListener('change', updatePublishToggle);
        updatePublishToggle(); // Initial state

        // Custom checkbox click
        document.querySelector('.toggle-bg').addEventListener('click', function() {
            publishCheckbox.checked = !publishCheckbox.checked;
            publishCheckbox.dispatchEvent(new Event('change'));
        });

        // Save as draft button
        document.getElementById('saveDraftBtn').addEventListener('click', function() {
            document.getElementById('is_published').checked = false;
            updatePublishToggle();
            document.getElementById('newsForm').submit();
        });

        // Form validation before submit
        document.getElementById('newsForm').addEventListener('submit', function(e) {
            // Update content before submit
            document.getElementById('content').value = quill.root.innerHTML;
            
            // Validate title
            const title = document.getElementById('title').value.trim();
            if (!title) {
                e.preventDefault();
                alert('Judul berita harus diisi!');
                document.getElementById('title').focus();
                return;
            }

            // Validate content
            const content = quill.getText().trim();
            if (content.length < 10) {
                e.preventDefault();
                alert('Konten berita terlalu pendek!');
                quill.focus();
                return;
            }

            // Validate author
            const author = document.getElementById('author_id').value;
            if (!author) {
                e.preventDefault();
                alert('Penulis harus dipilih!');
                document.getElementById('author_id').focus();
                return;
            }

            // Show loading state
            const submitBtn = this.querySelector('button[type="submit"]');
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Menyimpan...';
            submitBtn.disabled = true;
        });

        // Auto-save draft (every 30 seconds)
        let autoSaveTimer;
        function autoSaveDraft() {
            const title = document.getElementById('title').value;
            const excerpt = document.getElementById('excerpt').value;
            const content = quill.root.innerHTML;
            
            if (title || excerpt || content.length > 50) {
                localStorage.setItem('newsDraft', JSON.stringify({
                    title,
                    excerpt,
                    content,
                    timestamp: new Date().toISOString()
                }));
                
                // Show auto-save notification
                const notification = document.createElement('div');
                notification.className = 'fixed bottom-4 right-4 bg-green-100 text-green-800 px-4 py-2 rounded-lg shadow-lg text-sm';
                notification.innerHTML = '<i class="fas fa-save mr-2"></i>Draft tersimpan otomatis';
                document.body.appendChild(notification);
                
                setTimeout(() => {
                    notification.remove();
                }, 2000);
            }
        }

        // Start auto-save
        if (quill.getText().trim().length < 10 && !document.getElementById('title').value) {
            // Load draft if exists
            const savedDraft = localStorage.getItem('newsDraft');
            if (savedDraft) {
                try {
                    const draft = JSON.parse(savedDraft);
                    if (confirm('Ada draft berita yang tersimpan. Muat sekarang?')) {
                        document.getElementById('title').value = draft.title || '';
                        document.getElementById('excerpt').value = draft.excerpt || '';
                        if (draft.content) {
                            quill.root.innerHTML = draft.content;
                        }
                        updateExcerptCounter();
                    }
                } catch (e) {
                    console.error('Error loading draft:', e);
                }
            }
        }

        // Set up auto-save interval
        setInterval(autoSaveDraft, 30000);

        // Clear draft on successful submit
        document.getElementById('newsForm').addEventListener('submit', function() {
            localStorage.removeItem('newsDraft');
        });
    </script>
</body>
</html>