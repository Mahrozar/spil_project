<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $gallery->title }} - Detail Galeri</title>
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
        .media-container {
            transition: all 0.3s ease;
        }
        .sticky-sidebar {
            position: sticky;
            top: 1rem;
        }
        .video-wrapper {
            position: relative;
            padding-bottom: 56.25%; /* 16:9 Aspect Ratio */
            height: 0;
            overflow: hidden;
        }
        .video-wrapper iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border: 0;
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
                        <a href="/admin/news" class="text-gray-600 hover:text-gray-900 px-3 py-2 text-sm font-medium">Berita</a>
                        <a href="/admin/galleries" class="bg-blue-100 text-blue-700 px-3 py-2 text-sm font-medium rounded-md">Galeri</a>
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
                        <a href="{{ route('admin.galleries.index') }}" class="hover:text-blue-600">Galeri</a>
                        <i class="fas fa-chevron-right mx-2 text-xs"></i>
                        <span class="text-gray-700">Detail Item</span>
                    </nav>
                    <h2 class="text-2xl font-bold text-gray-900">Detail Item Galeri</h2>
                    <p class="text-gray-600 mt-1">Preview dan kelola "{{ Str::limit($gallery->title, 50) }}"</p>
                </div>
                
                <div class="flex gap-3">
                    <a href="{{ route('admin.galleries.edit', $gallery) }}" class="bg-yellow-500 text-white rounded-md px-4 py-2 text-sm hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-yellow-500 flex items-center">
                        <i class="fas fa-edit mr-2"></i>
                        Edit
                    </a>
                    <a href="{{ route('admin.galleries.index') }}" class="bg-gray-200 text-gray-700 rounded-md px-4 py-2 text-sm hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-500 flex items-center">
                        <i class="fas fa-arrow-left mr-2"></i>
                        Kembali
                    </a>
                </div>
            </div>
        </div>

        <!-- Main Content Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 fade-in">
            <!-- Left Column: Media Content -->
            <div class="lg:col-span-2">
                <!-- Media Display Card -->
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
                    <!-- Media Display -->
                    <div class="media-container">
                        @if($gallery->type === 'photo')
                            <div class="relative">
                                <img src="{{ $gallery->image_path ? asset('storage/' . $gallery->image_path) : 'https://via.placeholder.com/1200x800/cccccc/ffffff?text=No+Image' }}" 
                                     alt="{{ $gallery->title }}"
                                     class="w-full h-auto max-h-[500px] object-contain bg-gray-100">
                                
                                <!-- Type & Status Badges -->
                                <div class="absolute top-4 left-4 flex gap-2">
                                    <span class="bg-blue-500 text-white px-3 py-1 rounded-full text-sm font-medium">
                                        Foto
                                    </span>
                                    <span class="{{ $gallery->is_active ? 'bg-green-500' : 'bg-gray-500' }} text-white px-3 py-1 rounded-full text-sm font-medium">
                                        {{ $gallery->is_active ? 'Aktif' : 'Nonaktif' }}
                                    </span>
                                </div>
                            </div>
                        @else
                            <div class="bg-gray-900 p-4">
                                <div class="video-wrapper">
                                    @php
                                        // Extract video ID from URL
                                        $videoUrl = $gallery->video_url;
                                        $videoId = null;
                                        
                                        if (strpos($videoUrl, 'youtube.com') !== false || strpos($videoUrl, 'youtu.be') !== false) {
                                            // YouTube
                                            preg_match('/(?:youtube\.com\/watch\?v=|youtu\.be\/)([a-zA-Z0-9_-]+)/', $videoUrl, $matches);
                                            $videoId = $matches[1] ?? null;
                                            if ($videoId) {
                                                $embedUrl = "https://www.youtube.com/embed/{$videoId}";
                                            }
                                        } elseif (strpos($videoUrl, 'vimeo.com') !== false) {
                                            // Vimeo
                                            preg_match('/vimeo\.com\/(\d+)/', $videoUrl, $matches);
                                            $videoId = $matches[1] ?? null;
                                            if ($videoId) {
                                                $embedUrl = "https://player.vimeo.com/video/{$videoId}";
                                            }
                                        }
                                    @endphp
                                    
                                    @if(isset($embedUrl))
                                        <iframe src="{{ $embedUrl }}" 
                                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                                                allowfullscreen>
                                        </iframe>
                                    @else
                                        <div class="absolute inset-0 flex items-center justify-center">
                                            <div class="text-center">
                                                <i class="fas fa-video text-4xl text-gray-400 mb-2"></i>
                                                <p class="text-gray-300">Video preview tidak tersedia</p>
                                                <a href="{{ $videoUrl }}" target="_blank" class="text-blue-400 hover:text-blue-300 text-sm mt-2 inline-block">
                                                    Buka video di tab baru
                                                </a>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                                
                                <!-- Type & Status Badges -->
                                <div class="flex gap-2 mt-4">
                                    <span class="bg-red-500 text-white px-3 py-1 rounded-full text-sm font-medium">
                                        Video
                                    </span>
                                    <span class="{{ $gallery->is_active ? 'bg-green-500' : 'bg-gray-500' }} text-white px-3 py-1 rounded-full text-sm font-medium">
                                        {{ $gallery->is_active ? 'Aktif' : 'Nonaktif' }}
                                    </span>
                                </div>
                            </div>
                        @endif
                    </div>

                    <!-- Content Details -->
                    <div class="p-6 md:p-8">
                        <!-- Title & Meta -->
                        <div class="mb-6">
                            <h1 class="text-2xl md:text-3xl font-bold text-gray-900 mb-4">{{ $gallery->title }}</h1>
                            
                            <!-- Meta Info -->
                            <div class="flex flex-wrap items-center gap-4 text-sm text-gray-600">
                                <div class="flex items-center">
                                    <i class="far fa-calendar-alt mr-2"></i>
                                    <span>Ditambahkan: {{ $gallery->created_at->format('d F Y') }}</span>
                                </div>
                                
                                <div class="flex items-center">
                                    <i class="far fa-clock mr-2"></i>
                                    <span>{{ $gallery->created_at->format('H:i') }}</span>
                                </div>
                                
                                @if($gallery->order)
                                <div class="flex items-center">
                                    <i class="fas fa-sort-numeric-up mr-2"></i>
                                    <span>Urutan: {{ $gallery->order }}</span>
                                </div>
                                @endif
                            </div>
                        </div>

                        <!-- Category -->
                        @if($gallery->category)
                        <div class="mb-6">
                            <span class="inline-block bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-sm font-medium">
                                <i class="fas fa-tag mr-1"></i>
                                {{ $gallery->category }}
                            </span>
                        </div>
                        @endif

                        <!-- Description -->
                        @if($gallery->description)
                        <div class="mb-8">
                            <h3 class="text-lg font-medium text-gray-900 mb-3">Deskripsi</h3>
                            <div class="bg-gray-50 border border-gray-200 rounded-lg p-4">
                                <p class="text-gray-700 whitespace-pre-line">{{ $gallery->description }}</p>
                            </div>
                        </div>
                        @endif

                        <!-- File Info -->
                        <div class="border-t border-gray-200 pt-6">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Informasi File</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div class="bg-gray-50 rounded-lg p-4">
                                    <div class="flex items-center">
                                        <i class="fas {{ $gallery->type === 'photo' ? 'fa-camera' : 'fa-video' }} text-gray-400 mr-3"></i>
                                        <div>
                                            <p class="text-sm font-medium text-gray-900">Tipe Media</p>
                                            <p class="text-sm text-gray-600">{{ $gallery->type === 'photo' ? 'Gambar' : 'Video' }}</p>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="bg-gray-50 rounded-lg p-4">
                                    <div class="flex items-center">
                                        <i class="fas fa-link text-gray-400 mr-3"></i>
                                        <div>
                                            <p class="text-sm font-medium text-gray-900">Status</p>
                                            <p class="text-sm text-gray-600">{{ $gallery->is_active ? 'Aktif' : 'Nonaktif' }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Share Section -->
                @if($gallery->is_active)
                <div class="mt-6 bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Bagikan</h3>
                    <div class="flex flex-wrap gap-3">
                        @if($gallery->type === 'photo')
                            <button onclick="sharePhoto()" class="flex items-center bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 transition-colors">
                                <i class="fab fa-facebook-f mr-2"></i> Facebook
                            </button>
                            <button onclick="downloadPhoto()" class="flex items-center bg-green-600 text-white px-4 py-2 rounded-md hover:bg-green-700 transition-colors">
                                <i class="fas fa-download mr-2"></i> Download
                            </button>
                        @else
                            <button onclick="shareVideo()" class="flex items-center bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 transition-colors">
                                <i class="fab fa-youtube mr-2"></i> YouTube
                            </button>
                        @endif
                        <button onclick="copyMediaLink()" class="flex items-center bg-gray-600 text-white px-4 py-2 rounded-md hover:bg-gray-700 transition-colors" id="copyLinkBtn">
                            <i class="fas fa-link mr-2"></i> Salin Link
                        </button>
                    </div>
                </div>
                @endif
            </div>

            <!-- Right Column: Sidebar -->
            <div class="space-y-6">
                <!-- Status Card -->
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 sticky-sidebar">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Status Item</h3>
                    
                    <div class="space-y-4">
                        <div class="flex items-center justify-between">
                            <span class="text-gray-600">Status Publikasi</span>
                            <form action="{{ route('admin.galleries.toggle-active', $gallery) }}" method="POST" class="inline">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="{{ $gallery->is_active ? 'bg-green-100 text-green-800 hover:bg-green-200' : 'bg-gray-100 text-gray-800 hover:bg-gray-200' }} px-4 py-2 rounded-md text-sm font-medium transition-colors">
                                    {{ $gallery->is_active ? 'Aktif' : 'Nonaktif' }}
                                </button>
                            </form>
                        </div>
                        
                        <div class="flex items-center justify-between">
                            <span class="text-gray-600">Tanggal Ditambahkan</span>
                            <span class="font-medium">{{ $gallery->created_at->format('d/m/Y') }}</span>
                        </div>
                        
                        <div class="flex items-center justify-between">
                            <span class="text-gray-600">Terakhir Diupdate</span>
                            <span class="font-medium">{{ $gallery->updated_at->format('d/m/Y') }}</span>
                        </div>
                        
                        @if($gallery->order)
                        <div class="flex items-center justify-between">
                            <span class="text-gray-600">Urutan Tampilan</span>
                            <span class="font-medium">{{ $gallery->order }}</span>
                        </div>
                        @endif
                        
                        @if($gallery->category)
                        <div class="flex items-center justify-between">
                            <span class="text-gray-600">Kategori</span>
                            <span class="font-medium">{{ $gallery->category }}</span>
                        </div>
                        @endif
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Aksi Cepat</h3>
                    
                    <div class="space-y-3">
                        <a href="{{ route('admin.galleries.edit', $gallery) }}" class="w-full flex items-center justify-center bg-blue-600 text-white px-4 py-3 rounded-md hover:bg-blue-700 transition-colors">
                            <i class="fas fa-edit mr-2"></i>
                            Edit Item
                        </a>
                        
                        <form action="{{ route('admin.galleries.toggle-active', $gallery) }}" method="POST" class="w-full">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="w-full flex items-center justify-center {{ $gallery->is_active ? 'bg-yellow-500 hover:bg-yellow-600' : 'bg-green-500 hover:bg-green-600' }} text-white px-4 py-3 rounded-md transition-colors">
                                <i class="fas {{ $gallery->is_active ? 'fa-eye-slash' : 'fa-eye' }} mr-2"></i>
                                {{ $gallery->is_active ? 'Nonaktifkan' : 'Aktifkan' }}
                            </button>
                        </form>
                        
                        <button onclick="confirmDelete()" class="w-full flex items-center justify-center bg-red-600 text-white px-4 py-3 rounded-md hover:bg-red-700 transition-colors">
                            <i class="fas fa-trash mr-2"></i>
                            Hapus Item
                        </button>
                        
                        @if($gallery->is_active)
                        <a href="{{ url('/galeri/' . $gallery->id) }}" target="_blank" class="w-full flex items-center justify-center bg-purple-600 text-white px-4 py-3 rounded-md hover:bg-purple-700 transition-colors">
                            <i class="fas fa-external-link-alt mr-2"></i>
                            Lihat di Website
                        </a>
                        @endif
                    </div>
                </div>

                <!-- Related Galleries -->
                @if($related->count() > 0)
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Item Terkait</h3>
                    
                    <div class="space-y-4">
                        @foreach($related as $item)
                        <a href="{{ route('admin.galleries.show', $item) }}" class="flex items-center p-3 border border-gray-200 rounded-lg hover:bg-gray-50 transition-colors">
                            <div class="flex-shrink-0 mr-3">
                                @if($item->type === 'photo')
                                    <img src="{{ $item->image_path ? asset('storage/' . $item->image_path) : 'https://via.placeholder.com/60x60/cccccc/ffffff?text=No+Image' }}" 
                                         alt="{{ $item->title }}"
                                         class="w-12 h-12 object-cover rounded">
                                @else
                                    <div class="w-12 h-12 bg-red-100 rounded flex items-center justify-center">
                                        <i class="fas fa-video text-red-500"></i>
                                    </div>
                                @endif
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-medium text-gray-900 truncate">{{ $item->title }}</p>
                                <div class="flex items-center text-xs text-gray-500 mt-1">
                                    <span class="{{ $item->type === 'photo' ? 'text-blue-600' : 'text-red-600' }}">
                                        {{ $item->type === 'photo' ? 'Foto' : 'Video' }}
                                    </span>
                                    <span class="mx-2">•</span>
                                    <span>{{ $item->created_at->format('d/m/Y') }}</span>
                                </div>
                            </div>
                        </a>
                        @endforeach
                    </div>
                </div>
                @endif

                <!-- File Details -->
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Detail Teknis</h3>
                    
                    <div class="space-y-3">
                        <div class="flex justify-between items-center">
                            <span class="text-gray-600 text-sm">ID Item</span>
                            <span class="font-mono text-sm text-gray-900">{{ $gallery->id }}</span>
                        </div>
                        
                        <div class="flex justify-between items-center">
                            <span class="text-gray-600 text-sm">Tipe Database</span>
                            <span class="text-sm text-gray-900">{{ get_class($gallery) }}</span>
                        </div>
                        
                        @if($gallery->image_path)
                        <div class="flex justify-between items-center">
                            <span class="text-gray-600 text-sm">Path File</span>
                            <span class="text-sm text-gray-900 truncate ml-2">{{ Str::limit($gallery->image_path, 30) }}</span>
                        </div>
                        @endif
                        
                        @if($gallery->video_url)
                        <div class="flex justify-between items-center">
                            <span class="text-gray-600 text-sm">URL Video</span>
                            <a href="{{ $gallery->video_url }}" target="_blank" class="text-sm text-blue-600 hover:text-blue-800 truncate ml-2">
                                {{ Str::limit($gallery->video_url, 30) }}
                            </a>
                        </div>
                        @endif
                        
                        <div class="pt-4 border-t border-gray-200">
                            <button onclick="showRawData()" class="w-full flex items-center justify-center text-gray-600 hover:text-gray-900 text-sm">
                                <i class="fas fa-code mr-2"></i>
                                Tampilkan Data Raw
                            </button>
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
                <h3 class="text-lg font-medium text-gray-900 mb-2">Hapus Item Galeri?</h3>
                <p class="text-sm text-gray-500 mb-6">
                    Item "{{ Str::limit($gallery->title, 50) }}" akan dihapus permanen. Tindakan ini tidak dapat dibatalkan.
                </p>
                <div class="flex justify-center space-x-3">
                    <button onclick="closeDeleteModal()" class="px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50">
                        Batal
                    </button>
                    <form action="{{ route('admin.galleries.destroy', $gallery) }}" method="POST" class="inline">
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

    <!-- Raw Data Modal -->
    <div id="rawDataModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center p-4 z-50">
        <div class="bg-white rounded-lg shadow-xl max-w-2xl w-full max-h-[80vh] overflow-hidden">
            <div class="p-6 border-b border-gray-200">
                <div class="flex items-center justify-between">
                    <h3 class="text-lg font-medium text-gray-900">Data Raw Item</h3>
                    <button onclick="closeRawDataModal()" class="text-gray-400 hover:text-gray-500">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
            <div class="p-6 overflow-auto max-h-[60vh]">
                <pre class="text-sm bg-gray-50 p-4 rounded-lg overflow-x-auto">{{ json_encode($gallery->toArray(), JSON_PRETTY_PRINT) }}</pre>
            </div>
            <div class="p-6 border-t border-gray-200">
                <button onclick="closeRawDataModal()" class="w-full px-4 py-2 bg-gray-200 text-gray-700 rounded-md text-sm font-medium hover:bg-gray-300">
                    Tutup
                </button>
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

        // Raw Data Modal
        function showRawData() {
            document.getElementById('rawDataModal').classList.remove('hidden');
        }

        function closeRawDataModal() {
            document.getElementById('rawDataModal').classList.add('hidden');
        }

        // Share Functions
        function sharePhoto() {
            const url = encodeURIComponent(window.location.href);
            const text = encodeURIComponent("Lihat foto: {{ $gallery->title }}");
            window.open(`https://www.facebook.com/sharer/sharer.php?u=${url}&quote=${text}`, '_blank');
        }

        function shareVideo() {
            const url = encodeURIComponent(window.location.href);
            const text = encodeURIComponent("Tonton video: {{ $gallery->title }}");
            window.open(`https://www.facebook.com/sharer/sharer.php?u=${url}&quote=${text}`, '_blank');
        }

        function downloadPhoto() {
            @if($gallery->image_path)
                const link = document.createElement('a');
                link.href = "{{ asset('storage/' . $gallery->image_path) }}";
                link.download = "{{ Str::slug($gallery->title) }}.jpg";
                document.body.appendChild(link);
                link.click();
                document.body.removeChild(link);
            @else
                alert('Foto tidak tersedia untuk download.');
            @endif
        }

        function copyMediaLink() {
            const url = window.location.href;
            navigator.clipboard.writeText(url).then(() => {
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
            });
        }

        // Close modals when clicking outside
        document.getElementById('deleteModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeDeleteModal();
            }
        });

        document.getElementById('rawDataModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeRawDataModal();
            }
        });

        // Escape key to close modals
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeDeleteModal();
                closeRawDataModal();
            }
        });

        // Zoom image on click
        document.addEventListener('DOMContentLoaded', function() {
            const photoImg = document.querySelector('.media-container img');
            if (photoImg) {
                photoImg.addEventListener('click', function() {
                    this.classList.toggle('cursor-zoom-out');
                    this.classList.toggle('max-h-[500px]');
                    this.classList.toggle('max-h-none');
                });
            }
        });
    </script>
</body>
</html>