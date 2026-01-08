<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $news->title }} - Detail Berita</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .fade-in {
            animation: fadeIn 0.5s ease-in-out;
        }
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        .content-wrapper {
            line-height: 1.8;
        }
        .content-wrapper h1 {
            font-size: 1.875rem;
            font-weight: bold;
            margin: 1.5rem 0 1rem 0;
        }
        .content-wrapper h2 {
            font-size: 1.5rem;
            font-weight: bold;
            margin: 1.25rem 0 0.75rem 0;
        }
        .content-wrapper h3 {
            font-size: 1.25rem;
            font-weight: bold;
            margin: 1rem 0 0.5rem 0;
        }
        .content-wrapper p {
            margin: 1rem 0;
        }
        .content-wrapper ul, .content-wrapper ol {
            margin: 1rem 0;
            padding-left: 1.5rem;
        }
        .content-wrapper ul {
            list-style-type: disc;
        }
        .content-wrapper ol {
            list-style-type: decimal;
        }
        .content-wrapper img {
            max-width: 100%;
            height: auto;
            border-radius: 0.5rem;
            margin: 1.5rem 0;
        }
        .content-wrapper blockquote {
            border-left: 4px solid #3b82f6;
            padding-left: 1rem;
            margin: 1.5rem 0;
            font-style: italic;
            color: #4b5563;
        }
        .sticky-sidebar {
            position: sticky;
            top: 1rem;
        }
        .share-btn {
            transition: all 0.2s ease;
        }
        .share-btn:hover {
            transform: translateY(-2px);
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
                    <nav class="flex items-center text-sm text-gray-500 mb-2">
                        <a href="{{ route('admin.news.index') }}" class="hover:text-blue-600">Berita</a>
                        <i class="fas fa-chevron-right mx-2 text-xs"></i>
                        <span class="text-gray-700">Detail Berita</span>
                    </nav>
                    <h2 class="text-2xl font-bold text-gray-900">Detail Berita</h2>
                    <p class="text-gray-600 mt-1">Preview dan kelola berita "{{ Str::limit($news->title, 50) }}"</p>
                </div>
                
                <div class="flex gap-3">
                    <a href="{{ route('admin.news.edit', $news) }}" class="bg-yellow-500 text-white rounded-md px-4 py-2 text-sm hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-yellow-500 flex items-center">
                        <i class="fas fa-edit mr-2"></i>
                        Edit
                    </a>
                    <a href="{{ route('admin.news.index') }}" class="bg-gray-200 text-gray-700 rounded-md px-4 py-2 text-sm hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-500 flex items-center">
                        <i class="fas fa-arrow-left mr-2"></i>
                        Kembali
                    </a>
                </div>
            </div>
        </div>

        <!-- Main Content Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 fade-in">
            <!-- Left Column: Article Content -->
            <div class="lg:col-span-2">
                <!-- Article Card -->
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
                    <!-- Thumbnail -->
                    @if($news->thumbnail)
                    <div class="relative">
                        <img src="{{ $news->thumbnail }}" alt="{{ $news->title }}" 
                             class="w-full h-64 md:h-80 object-cover">
                        <!-- Status Badge -->
                        <div class="absolute top-4 left-4">
                            <span class="{{ $news->is_published ? 'bg-green-500' : 'bg-yellow-500' }} text-white px-3 py-1 rounded-full text-xs font-medium">
                                {{ $news->is_published ? 'Diterbitkan' : 'Draft' }}
                            </span>
                        </div>
                    </div>
                    @endif

                    <!-- Article Content -->
                    <div class="p-6 md:p-8">
                        <!-- Article Header -->
                        <div class="mb-6">
                            <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">{{ $news->title }}</h1>
                            
                            <!-- Meta Info -->
                            <div class="flex flex-wrap items-center gap-4 text-sm text-gray-600">
                                <div class="flex items-center">
                                    <div class="h-8 w-8 rounded-full bg-blue-100 flex items-center justify-center text-blue-700 font-medium mr-2">
                                        {{ strtoupper(substr($news->author->name ?? 'A', 0, 1)) }}
                                    </div>
                                    <div>
                                        <div class="font-medium text-gray-900">{{ $news->author->name ?? '-' }}</div>
                                        <div class="text-xs text-gray-500">{{ $news->author->role ?? 'Penulis' }}</div>
                                    </div>
                                </div>
                                
                                <div class="flex items-center">
                                    <i class="far fa-calendar-alt mr-2"></i>
                                    <span>{{ $news->created_at->format('d F Y') }}</span>
                                </div>
                                
                                <div class="flex items-center">
                                    <i class="far fa-clock mr-2"></i>
                                    <span>{{ $news->created_at->format('H:i') }} WIB</span>
                                </div>
                                
                                <div class="flex items-center">
                                    <i class="far fa-eye mr-2"></i>
                                    <span>{{ $news->views ?? 0 }} views</span>
                                </div>
                            </div>
                        </div>

                        <!-- Excerpt -->
                        @if($news->excerpt)
                        <div class="mb-8 p-4 bg-blue-50 border-l-4 border-blue-500 rounded-r">
                            <p class="text-gray-700 italic text-lg">{{ $news->excerpt }}</p>
                        </div>
                        @endif

                        <!-- Article Body -->
                        <div class="content-wrapper">
                            {!! $news->content !!}
                        </div>

                        <!-- Tags & Categories (if any) -->
                        <div class="mt-8 pt-6 border-t border-gray-200">
                            <div class="flex flex-wrap gap-2">
                                <span class="bg-gray-100 text-gray-700 px-3 py-1 rounded-full text-sm">
                                    <i class="fas fa-tag mr-1"></i> Berita
                                </span>
                                <span class="bg-gray-100 text-gray-700 px-3 py-1 rounded-full text-sm">
                                    <i class="fas fa-newspaper mr-1"></i> Artikel
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Share Section -->
                <div class="mt-6 bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Bagikan Berita Ini</h3>
                    <div class="flex flex-wrap gap-3">
                        <button onclick="shareOnFacebook()" class="share-btn flex items-center bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">
                            <i class="fab fa-facebook-f mr-2"></i> Facebook
                        </button>
                        <button onclick="shareOnTwitter()" class="share-btn flex items-center bg-blue-400 text-white px-4 py-2 rounded-md hover:bg-blue-500">
                            <i class="fab fa-twitter mr-2"></i> Twitter
                        </button>
                        <button onclick="shareOnWhatsApp()" class="share-btn flex items-center bg-green-500 text-white px-4 py-2 rounded-md hover:bg-green-600">
                            <i class="fab fa-whatsapp mr-2"></i> WhatsApp
                        </button>
                        <button onclick="copyLink()" class="share-btn flex items-center bg-gray-600 text-white px-4 py-2 rounded-md hover:bg-gray-700" id="copyLinkBtn">
                            <i class="fas fa-link mr-2"></i> Salin Link
                        </button>
                    </div>
                </div>
            </div>

            <!-- Right Column: Sidebar -->
            <div class="space-y-6">
                <!-- Status Card -->
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 sticky-sidebar">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Status Berita</h3>
                    
                    <div class="space-y-4">
                        <div class="flex items-center justify-between">
                            <span class="text-gray-600">Status Publikasi</span>
                            <form action="{{ route('admin.news.toggle-publish', $news) }}" method="POST" class="inline">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="{{ $news->is_published ? 'bg-green-100 text-green-800 hover:bg-green-200' : 'bg-yellow-100 text-yellow-800 hover:bg-yellow-200' }} px-4 py-2 rounded-md text-sm font-medium transition-colors">
                                    {{ $news->is_published ? 'Diterbitkan' : 'Draft' }}
                                </button>
                            </form>
                        </div>
                        
                        <div class="flex items-center justify-between">
                            <span class="text-gray-600">Tanggal Buat</span>
                            <span class="font-medium">{{ $news->created_at->format('d/m/Y') }}</span>
                        </div>
                        
                        <div class="flex items-center justify-between">
                            <span class="text-gray-600">Terakhir Diupdate</span>
                            <span class="font-medium">{{ $news->updated_at->format('d/m/Y') }}</span>
                        </div>
                        
                        @if($news->published_at)
                        <div class="flex items-center justify-between">
                            <span class="text-gray-600">Tanggal Terbit</span>
                            <span class="font-medium">{{ $news->published_at->format('d/m/Y') }}</span>
                        </div>
                        @endif
                        
                        <div class="flex items-center justify-between">
                            <span class="text-gray-600">Jumlah Views</span>
                            <span class="font-medium">{{ $news->views ?? 0 }}</span>
                        </div>
                        
                        <!-- Views Chart (simplified) -->
                        <div class="pt-4 border-t border-gray-200">
                            <div class="flex items-center justify-between mb-2">
                                <span class="text-gray-600 text-sm">Trend Views (7 hari)</span>
                                <span class="text-blue-600 text-sm font-medium">+15%</span>
                            </div>
                            <div class="flex items-end h-8 space-x-1">
                                @foreach([5, 8, 12, 10, 15, 18, 20] as $height)
                                <div class="flex-1 bg-blue-100 rounded-t" style="height: {{ ($height / 25) * 100 }}%"></div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Aksi Cepat</h3>
                    
                    <div class="space-y-3">
                        <a href="{{ route('admin.news.edit', $news) }}" class="w-full flex items-center justify-center bg-blue-600 text-white px-4 py-3 rounded-md hover:bg-blue-700 transition-colors">
                            <i class="fas fa-edit mr-2"></i>
                            Edit Berita
                        </a>
                        
                        <form action="{{ route('admin.news.toggle-publish', $news) }}" method="POST" class="w-full">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="w-full flex items-center justify-center {{ $news->is_published ? 'bg-yellow-500 hover:bg-yellow-600' : 'bg-green-500 hover:bg-green-600' }} text-white px-4 py-3 rounded-md transition-colors">
                                <i class="fas {{ $news->is_published ? 'fa-eye-slash' : 'fa-eye' }} mr-2"></i>
                                {{ $news->is_published ? 'Jadikan Draft' : 'Terbitkan Sekarang' }}
                            </button>
                        </form>
                        
                        <button onclick="confirmDelete()" class="w-full flex items-center justify-center bg-red-600 text-white px-4 py-3 rounded-md hover:bg-red-700 transition-colors">
                            <i class="fas fa-trash mr-2"></i>
                            Hapus Berita
                        </button>
                        
                        <a href="{{ route('news.show', $news->slug) }}" target="_blank" class="w-full flex items-center justify-center bg-purple-600 text-white px-4 py-3 rounded-md hover:bg-purple-700 transition-colors">
                            <i class="fas fa-external-link-alt mr-2"></i>
                            Lihat di Website
                        </a>
                    </div>
                </div>

                <!-- Author Info -->
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Tentang Penulis</h3>
                    
                    <div class="flex items-start space-x-4">
                        <div class="h-12 w-12 rounded-full bg-blue-100 flex items-center justify-center text-blue-700 font-bold text-lg">
                            {{ strtoupper(substr($news->author->name ?? 'A', 0, 1)) }}
                        </div>
                        <div>
                            <h4 class="font-medium text-gray-900">{{ $news->author->name ?? 'Penulis' }}</h4>
                            <p class="text-sm text-gray-600 mt-1">{{ $news->author->email ?? 'email@example.com' }}</p>
                            <div class="flex items-center mt-2">
                                <span class="bg-gray-100 text-gray-700 px-2 py-1 rounded text-xs">
                                    {{ $news->author->role ?? 'Admin' }}
                                </span>
                                <span class="ml-2 text-xs text-gray-500">
                                    <i class="fas fa-newspaper mr-1"></i>
                                    {{ $news->author->news_count ?? 0 }} berita
                                </span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mt-4 pt-4 border-t border-gray-200">
                        <div class="text-sm text-gray-600">
                            <div class="flex justify-between mb-1">
                                <span>Total Berita Ditulis</span>
                                <span class="font-medium">{{ $news->author->news_count ?? 0 }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span>Bergabung Sejak</span>
                                <span class="font-medium">{{ $news->author->created_at ? $news->author->created_at->format('M Y') : '-' }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Share URL -->
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">URL Berita</h3>
                    <div class="space-y-3">
                        <p class="text-sm text-gray-600">Link untuk berbagi berita:</p>
                        <div class="flex">
                            <input type="text" id="newsUrl" value="{{ route('news.show', $news->slug) }}" readonly 
                                   class="flex-1 border border-gray-300 rounded-l-md px-3 py-2 text-sm bg-gray-50 focus:outline-none">
                            <button onclick="copyNewsUrl()" class="bg-blue-600 text-white rounded-r-md px-4 py-2 text-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500" id="copyUrlBtn">
                                Salin
                            </button>
                        </div>
                        <div id="copySuccess" class="hidden text-green-600 text-sm">
                            <i class="fas fa-check-circle mr-1"></i> Link berhasil disalin!
                        </div>
                    </div>
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

    <!-- Delete Confirmation Modal -->
    <div id="deleteModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center p-4 z-50">
        <div class="bg-white rounded-lg shadow-xl max-w-md w-full p-6">
            <div class="text-center">
                <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-red-100 mb-4">
                    <i class="fas fa-exclamation-triangle text-red-600 text-xl"></i>
                </div>
                <h3 class="text-lg font-medium text-gray-900 mb-2">Hapus Berita?</h3>
                <p class="text-sm text-gray-500 mb-6">
                    Berita "{{ Str::limit($news->title, 50) }}" akan dihapus permanen. Tindakan ini tidak dapat dibatalkan.
                </p>
                <div class="flex justify-center space-x-3">
                    <button onclick="closeDeleteModal()" class="px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50">
                        Batal
                    </button>
                    <form action="{{ route('admin.news.destroy', $news) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-md text-sm font-medium hover:bg-red-700">
                            Ya, Hapus
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Delete Confirmation
        function confirmDelete() {
            document.getElementById('deleteModal').classList.remove('hidden');
        }

        function closeDeleteModal() {
            document.getElementById('deleteModal').classList.add('hidden');
        }

        // Share Functions
        function shareOnFacebook() {
            const url = encodeURIComponent(window.location.href);
            window.open(`https://www.facebook.com/sharer/sharer.php?u=${url}`, '_blank');
        }

        function shareOnTwitter() {
            const text = encodeURIComponent("{{ $news->title }}");
            const url = encodeURIComponent(window.location.href);
            window.open(`https://twitter.com/intent/tweet?text=${text}&url=${url}`, '_blank');
        }

        function shareOnWhatsApp() {
            const text = encodeURIComponent("{{ $news->title }} - " + window.location.href);
            window.open(`https://wa.me/?text=${text}`, '_blank');
        }

        function copyLink() {
            const el = document.createElement('textarea');
            el.value = window.location.href;
            document.body.appendChild(el);
            el.select();
            document.execCommand('copy');
            document.body.removeChild(el);
            
            // Show feedback
            const btn = document.getElementById('copyLinkBtn');
            const originalHTML = btn.innerHTML;
            btn.innerHTML = '<i class="fas fa-check mr-2"></i>Tersalin!';
            btn.classList.remove('bg-gray-600');
            btn.classList.add('bg-green-600');
            
            setTimeout(() => {
                btn.innerHTML = originalHTML;
                btn.classList.remove('bg-green-600');
                btn.classList.add('bg-gray-600');
            }, 2000);
        }

        // Copy News URL
        function copyNewsUrl() {
            const urlInput = document.getElementById('newsUrl');
            urlInput.select();
            document.execCommand('copy');
            
            // Show success message
            const copySuccess = document.getElementById('copySuccess');
            const copyBtn = document.getElementById('copyUrlBtn');
            
            copySuccess.classList.remove('hidden');
            copyBtn.innerHTML = '<i class="fas fa-check mr-1"></i>Tersalin';
            copyBtn.classList.remove('bg-blue-600');
            copyBtn.classList.add('bg-green-600');
            
            setTimeout(() => {
                copySuccess.classList.add('hidden');
                copyBtn.innerHTML = 'Salin';
                copyBtn.classList.remove('bg-green-600');
                copyBtn.classList.add('bg-blue-600');
            }, 3000);
        }

        // Close modal when clicking outside
        document.getElementById('deleteModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeDeleteModal();
            }
        });

        // Escape key to close modal
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeDeleteModal();
            }
        });

        // Update views on page load (simulated)
        document.addEventListener('DOMContentLoaded', function() {
            // Simulate view count update
            setTimeout(() => {
                const viewsElement = document.querySelector('.flex.items-center .fa-eye').nextElementSibling;
                if (viewsElement) {
                    const currentViews = parseInt(viewsElement.textContent) || 0;
                    viewsElement.textContent = (currentViews + 1) + ' views';
                }
            }, 1000);
        });

        // Print article
        function printArticle() {
            window.print();
        }
    </script>
</body>
</html>