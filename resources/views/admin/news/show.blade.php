@extends('layouts.app')

@section('title', $news->title . ' - Detail Berita')
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
                <span class="text-gray-600 font-medium">{{ Str::limit($news->title, 50) }}</span>
            </li>
        </ol>
    </nav>
@endsection
@section('content')
    <div class="admin-content-area">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">


            <!-- Header -->
            <div class="mb-8">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                    <div>
                        <h1 class="text-2xl font-bold text-gray-900 mb-2">Detail Berita</h1>
                        <p class="text-gray-600">Preview dan kelola berita "{{ Str::limit($news->title, 50) }}"</p>
                    </div>

                    <div class="flex gap-3">
                        <a href="{{ route('admin.news.edit', $news) }}"
                            class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-yellow-600 hover:bg-yellow-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500">
                            <i class="fas fa-edit mr-2"></i>
                            Edit Berita
                        </a>
                        <a href="{{ route('admin.news.index') }}"
                            class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                            <i class="fas fa-arrow-left mr-2"></i>
                            Kembali ke Daftar
                        </a>
                    </div>
                </div>
            </div>

            <!-- Main Content Grid -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Left Column: Article Content -->
                <div class="lg:col-span-2 space-y-6">
                    <!-- Article Card -->
                    <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                        <!-- Thumbnail -->
                        @if ($news->thumbnail)
                            <div class="relative">
                                <img src="{{ $news->thumbnail ? asset('storage/' . $news->thumbnail) : 'https://via.placeholder.com/400x300/cccccc/ffffff?text=No+Image' }}"
                                    class="w-full h-64 md:h-80 object-cover">
                                <!-- Status Badge -->
                                <div class="absolute top-4 left-4">
                                    <span
                                        class="{{ $news->is_published ? 'bg-green-500' : 'bg-yellow-500' }} text-white px-3 py-1.5 rounded-full text-xs font-medium shadow">
                                        <i class="fas {{ $news->is_published ? 'fa-eye' : 'fa-eye-slash' }} mr-1"></i>
                                        {{ $news->is_published ? 'Diterbitkan' : 'Draft' }}
                                    </span>
                                </div>
                            </div>
                        @endif

                        <!-- Article Content -->
                        <div class="px-4 py-6 sm:p-8">
                            <!-- Article Header -->
                            <div class="mb-6">
                                <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4 leading-tight">
                                    {{ $news->title }}</h1>

                                <!-- Meta Info -->
                                <div class="flex flex-wrap items-center gap-4 text-sm text-gray-600 mb-6">
                                    <div class="flex items-center">
                                        <div
                                            class="h-10 w-10 rounded-full bg-blue-100 flex items-center justify-center text-blue-700 font-medium mr-3">
                                            {{ strtoupper(substr($news->author->name ?? 'A', 0, 1)) }}
                                        </div>
                                        <div>
                                            <div class="font-medium text-gray-900">{{ $news->author->name ?? '-' }}</div>
                                            <div class="text-xs text-gray-500">{{ $news->author->role ?? 'Penulis' }}</div>
                                        </div>
                                    </div>

                                    <div class="h-4 w-px bg-gray-300"></div>

                                    <div class="flex items-center">
                                        <i class="far fa-calendar-alt text-gray-400 mr-2"></i>
                                        <span>{{ $news->created_at->format('d F Y') }}</span>
                                    </div>

                                    <div class="flex items-center">
                                        <i class="far fa-clock text-gray-400 mr-2"></i>
                                        <span>{{ $news->created_at->format('H:i') }} WIB</span>
                                    </div>

                                    <div class="flex items-center">
                                        <i class="far fa-eye text-gray-400 mr-2"></i>
                                        <span>{{ $news->views ?? 0 }} kali dilihat</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Excerpt -->
                            @if ($news->excerpt)
                                <div class="mb-8 p-4 bg-blue-50 border-l-4 border-blue-500 rounded-r-lg">
                                    <p class="text-gray-700 text-lg italic leading-relaxed">{{ $news->excerpt }}</p>
                                </div>
                            @endif

                            <!-- Article Body -->
                            <div class="prose prose-lg max-w-none">
                                {!! $news->content !!}
                            </div>

                            <!-- Tags & Categories -->
                            <div class="mt-8 pt-6 border-t border-gray-200">
                                <div class="flex flex-wrap gap-2">
                                    <span
                                        class="inline-flex items-center bg-gray-100 text-gray-700 px-3 py-1.5 rounded-full text-sm">
                                        <i class="fas fa-tag mr-1.5 text-xs"></i> Berita
                                    </span>
                                    <span
                                        class="inline-flex items-center bg-gray-100 text-gray-700 px-3 py-1.5 rounded-full text-sm">
                                        <i class="fas fa-newspaper mr-1.5 text-xs"></i> Artikel
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Share Section -->
                    <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                        <div class="px-4 py-5 sm:px-6 border-b border-gray-200">
                            <h3 class="text-lg font-medium text-gray-900 flex items-center">
                                <i class="fas fa-share-alt mr-2 text-blue-500"></i>
                                Bagikan Berita Ini
                            </h3>
                        </div>
                        <div class="px-4 py-5 sm:p-6">
                            <div class="flex flex-wrap gap-3">
                                <button onclick="shareOnFacebook()"
                                    class="inline-flex items-center px-4 py-2.5 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-200 hover:-translate-y-0.5">
                                    <i class="fab fa-facebook-f mr-2"></i> Facebook
                                </button>
                                <button onclick="shareOnTwitter()"
                                    class="inline-flex items-center px-4 py-2.5 bg-blue-400 text-white rounded-md hover:bg-blue-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-400 transition-all duration-200 hover:-translate-y-0.5">
                                    <i class="fab fa-twitter mr-2"></i> Twitter
                                </button>
                                <button onclick="shareOnWhatsApp()"
                                    class="inline-flex items-center px-4 py-2.5 bg-green-500 text-white rounded-md hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-all duration-200 hover:-translate-y-0.5">
                                    <i class="fab fa-whatsapp mr-2"></i> WhatsApp
                                </button>
                                <button onclick="copyLink()"
                                    class="inline-flex items-center px-4 py-2.5 bg-gray-600 text-white rounded-md hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition-all duration-200 hover:-translate-y-0.5"
                                    id="copyLinkBtn">
                                    <i class="fas fa-link mr-2"></i> Salin Link
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Column: Sidebar -->
                <div class="space-y-6">
                    <!-- Status Card -->
                    <div class="bg-white shadow overflow-hidden sm:rounded-lg sticky top-6">
                        <div class="px-4 py-5 sm:px-6 border-b border-gray-200">
                            <h3 class="text-lg font-medium text-gray-900 flex items-center">
                                <i class="fas fa-chart-line mr-2 text-blue-500"></i>
                                Status Berita
                            </h3>
                        </div>
                        <div class="px-4 py-5 sm:p-6">
                            <div class="space-y-4">
                                <!-- Publication Status -->
                                <div class="flex items-center justify-between">
                                    <span class="text-sm text-gray-600">Status Publikasi</span>
                                    <form action="{{ route('admin.news.toggle-publish', $news) }}" method="POST"
                                        class="inline">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit"
                                            class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-medium {{ $news->is_published ? 'bg-green-100 text-green-800 hover:bg-green-200' : 'bg-yellow-100 text-yellow-800 hover:bg-yellow-200' }} transition-colors">
                                            <i
                                                class="fas {{ $news->is_published ? 'fa-eye' : 'fa-eye-slash' }} mr-1.5"></i>
                                            {{ $news->is_published ? 'Diterbitkan' : 'Draft' }}
                                        </button>
                                    </form>
                                </div>

                                <!-- Date Information -->
                                <div class="space-y-3">
                                    <div class="flex items-center justify-between">
                                        <span class="text-sm text-gray-600">Tanggal Buat</span>
                                        <span
                                            class="text-sm font-medium text-gray-900">{{ $news->created_at->format('d/m/Y') }}</span>
                                    </div>

                                    <div class="flex items-center justify-between">
                                        <span class="text-sm text-gray-600">Terakhir Diupdate</span>
                                        <span
                                            class="text-sm font-medium text-gray-900">{{ $news->updated_at->format('d/m/Y') }}</span>
                                    </div>

                                    @if ($news->published_at)
                                        <div class="flex items-center justify-between">
                                            <span class="text-sm text-gray-600">Tanggal Terbit</span>
                                            <span
                                                class="text-sm font-medium text-gray-900">{{ $news->published_at->format('d/m/Y') }}</span>
                                        </div>
                                    @endif
                                </div>

                                <!-- Views -->
                                <div class="flex items-center justify-between">
                                    <span class="text-sm text-gray-600">Jumlah Views</span>
                                    <span class="text-sm font-medium text-gray-900">{{ $news->views ?? 0 }}</span>
                                </div>

                                <!-- Views Chart -->
                                <div class="pt-4 mt-4 border-t border-gray-200">
                                    <div class="flex items-center justify-between mb-2">
                                        <span class="text-sm text-gray-600">Trend Views (7 hari)</span>
                                        <span class="text-sm font-medium text-blue-600">+15%</span>
                                    </div>
                                    <div class="flex items-end h-8 space-x-1">
                                        @foreach ([5, 8, 12, 10, 15, 18, 20] as $height)
                                            <div class="flex-1 bg-blue-100 rounded-t"
                                                style="height: {{ ($height / 25) * 100 }}%"></div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Quick Actions -->
                    <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                        <div class="px-4 py-5 sm:px-6 border-b border-gray-200">
                            <h3 class="text-lg font-medium text-gray-900 flex items-center">
                                <i class="fas fa-bolt mr-2 text-blue-500"></i>
                                Aksi Cepat
                            </h3>
                        </div>
                        <div class="px-4 py-5 sm:p-6">
                            <div class="space-y-3">
                                <a href="{{ route('admin.news.edit', $news) }}"
                                    class="w-full inline-flex items-center justify-center bg-blue-600 text-white px-4 py-3 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
                                    <i class="fas fa-edit mr-2"></i>
                                    Edit Berita
                                </a>

                                <form action="{{ route('admin.news.toggle-publish', $news) }}" method="POST"
                                    class="w-full">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit"
                                        class="w-full inline-flex items-center justify-center {{ $news->is_published ? 'bg-yellow-600 hover:bg-yellow-700' : 'bg-green-600 hover:bg-green-700' }} text-white px-4 py-3 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 {{ $news->is_published ? 'focus:ring-yellow-500' : 'focus:ring-green-500' }} transition-colors">
                                        <i class="fas {{ $news->is_published ? 'fa-eye-slash' : 'fa-eye' }} mr-2"></i>
                                        {{ $news->is_published ? 'Jadikan Draft' : 'Terbitkan Sekarang' }}
                                    </button>
                                </form>

                                <button onclick="confirmDelete()"
                                    class="w-full inline-flex items-center justify-center bg-red-600 text-white px-4 py-3 rounded-md hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-colors">
                                    <i class="fas fa-trash mr-2"></i>
                                    Hapus Berita
                                </button>

                                <a href="{{ route('news.show', $news->slug) }}" target="_blank"
                                    class="w-full inline-flex items-center justify-center bg-purple-600 text-white px-4 py-3 rounded-md hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500 transition-colors">
                                    <i class="fas fa-external-link-alt mr-2"></i>
                                    Lihat di Website
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Author Info -->
                    <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                        <div class="px-4 py-5 sm:px-6 border-b border-gray-200">
                            <h3 class="text-lg font-medium text-gray-900 flex items-center">
                                <i class="fas fa-user-edit mr-2 text-blue-500"></i>
                                Tentang Penulis
                            </h3>
                        </div>
                        <div class="px-4 py-5 sm:p-6">
                            <div class="flex items-start space-x-4">
                                <div
                                    class="h-14 w-14 rounded-full bg-blue-100 flex items-center justify-center text-blue-700 font-bold text-xl">
                                    {{ strtoupper(substr($news->author->name ?? 'A', 0, 1)) }}
                                </div>
                                <div class="flex-1">
                                    <h4 class="font-medium text-gray-900">{{ $news->author->name ?? 'Penulis' }}</h4>
                                    <p class="text-sm text-gray-600 mt-1">
                                        {{ $news->author->email ?? 'email@example.com' }}</p>
                                    <div class="flex items-center mt-3">
                                        <span
                                            class="inline-flex items-center bg-gray-100 text-gray-700 px-2.5 py-1 rounded-full text-xs">
                                            {{ $news->author->role ?? 'Admin' }}
                                        </span>
                                        <span class="ml-3 text-xs text-gray-500">
                                            <i class="fas fa-newspaper mr-1"></i>
                                            {{ $news->author->news_count ?? 0 }} berita
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <div class="mt-6 pt-4 border-t border-gray-200">
                                <div class="space-y-2">
                                    <div class="flex justify-between">
                                        <span class="text-sm text-gray-600">Total Berita Ditulis</span>
                                        <span
                                            class="text-sm font-medium text-gray-900">{{ $news->author->news_count ?? 0 }}</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-sm text-gray-600">Bergabung Sejak</span>
                                        <span
                                            class="text-sm font-medium text-gray-900">{{ $news->author->created_at ? $news->author->created_at->format('M Y') : '-' }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Share URL -->
                    <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                        <div class="px-4 py-5 sm:px-6 border-b border-gray-200">
                            <h3 class="text-lg font-medium text-gray-900 flex items-center">
                                <i class="fas fa-link mr-2 text-blue-500"></i>
                                URL Berita
                            </h3>
                        </div>
                        <div class="px-4 py-5 sm:p-6">
                            <div class="space-y-3">
                                <p class="text-sm text-gray-600">Link untuk berbagi berita:</p>
                                <div class="flex">
                                    <input type="text" id="newsUrl" value="{{ route('news.show', $news->slug) }}"
                                        readonly
                                        class="flex-1 border border-gray-300 rounded-l-md px-3 py-2.5 text-sm bg-gray-50 focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500">
                                    <button onclick="copyNewsUrl()"
                                        class="inline-flex items-center bg-blue-600 text-white rounded-r-md px-4 py-2.5 text-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                        id="copyUrlBtn">
                                        <i class="fas fa-copy mr-2"></i>
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
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div id="deleteModal"
        class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center p-4 z-50 transition-opacity duration-300">
        <div class="bg-white rounded-lg shadow-xl max-w-md w-full p-6 transform transition-all duration-300 scale-95 opacity-0"
            id="modalContent">
            <div class="text-center">
                <div class="mx-auto flex items-center justify-center h-14 w-14 rounded-full bg-red-100 mb-4">
                    <i class="fas fa-exclamation-triangle text-red-600 text-xl"></i>
                </div>
                <h3 class="text-lg font-medium text-gray-900 mb-2">Hapus Berita?</h3>
                <p class="text-sm text-gray-500 mb-6">
                    Berita "{{ Str::limit($news->title, 50) }}" akan dihapus permanen. Tindakan ini tidak dapat dibatalkan.
                </p>
                <div class="flex justify-center space-x-3">
                    <button onclick="closeDeleteModal()"
                        class="px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition-colors">
                        Batal
                    </button>
                    <form action="{{ route('admin.news.destroy', $news) }}" method="POST" class="inline">
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

@push('styles')
    <style>
        .sticky {
            position: -webkit-sticky;
            position: sticky;
        }

        .prose {
            color: #374151;
        }

        .prose h1 {
            font-size: 2.25rem;
            font-weight: bold;
            margin-top: 2rem;
            margin-bottom: 1rem;
            color: #111827;
        }

        .prose h2 {
            font-size: 1.875rem;
            font-weight: bold;
            margin-top: 1.75rem;
            margin-bottom: 0.75rem;
            color: #1f2937;
        }

        .prose h3 {
            font-size: 1.5rem;
            font-weight: bold;
            margin-top: 1.5rem;
            margin-bottom: 0.5rem;
            color: #374151;
        }

        .prose p {
            margin-top: 1rem;
            margin-bottom: 1rem;
            line-height: 1.8;
        }

        .prose ul,
        .prose ol {
            margin-top: 1rem;
            margin-bottom: 1rem;
            padding-left: 1.5rem;
        }

        .prose ul {
            list-style-type: disc;
        }

        .prose ol {
            list-style-type: decimal;
        }

        .prose img {
            max-width: 100%;
            height: auto;
            border-radius: 0.5rem;
            margin: 1.5rem 0;
        }

        .prose blockquote {
            border-left: 4px solid #3b82f6;
            padding-left: 1rem;
            margin: 1.5rem 0;
            font-style: italic;
            color: #4b5563;
        }
    </style>
@endpush

@push('scripts')
    <script>
        // Delete Confirmation
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
            urlInput.setSelectionRange(0, 99999);
            document.execCommand('copy');

            // Show success message
            const copySuccess = document.getElementById('copySuccess');
            const copyBtn = document.getElementById('copyUrlBtn');

            copySuccess.classList.remove('hidden');
            copyBtn.innerHTML = '<i class="fas fa-check mr-2"></i>Tersalin';
            copyBtn.classList.remove('bg-blue-600');
            copyBtn.classList.add('bg-green-600');

            setTimeout(() => {
                copySuccess.classList.add('hidden');
                copyBtn.innerHTML = '<i class="fas fa-copy mr-2"></i>Salin';
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
    </script>
@endpush
