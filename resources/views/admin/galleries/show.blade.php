@extends('layouts.app')

@section('title', $gallery->title . ' - Detail Galeri')

@section('content')
<div class="admin-content-area">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
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
                    <span class="text-gray-600 font-medium">{{ Str::limit($gallery->title, 50) }}</span>
                </li>
            </ol>
        </nav>

        <!-- Header -->
        <div class="mb-8">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900 mb-2">Detail Item Galeri</h1>
                    <p class="text-gray-600">Preview dan kelola "{{ Str::limit($gallery->title, 50) }}"</p>
                </div>
                
                <div class="flex gap-3">
                    <a href="{{ route('admin.galleries.edit', $gallery) }}" 
                       class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-yellow-600 hover:bg-yellow-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500">
                        <i class="fas fa-edit mr-2"></i>
                        Edit Item
                    </a>
                    <a href="{{ route('admin.galleries.index') }}" 
                       class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                        <i class="fas fa-arrow-left mr-2"></i>
                        Kembali ke Daftar
                    </a>
                </div>
            </div>
        </div>

        <!-- Main Content Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Left Column: Media Content -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Media Display Card -->
                <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                    <!-- Media Display -->
                    <div class="relative">
                        @if($gallery->type === 'photo')
                            <div class="relative bg-gray-100 flex items-center justify-center min-h-[400px]">
                                <img src="{{ $gallery->image_path ? asset('storage/' . $gallery->image_path) : 'https://via.placeholder.com/1200x800/cccccc/ffffff?text=No+Image' }}" 
                                     alt="{{ $gallery->title }}"
                                     class="max-w-full max-h-[500px] object-contain cursor-pointer transition-transform duration-300 hover:scale-105"
                                     id="galleryImage">
                                
                                <!-- Type & Status Badges -->
                                <div class="absolute top-4 left-4 flex gap-2">
                                    <span class="inline-flex items-center bg-blue-500 text-white px-3 py-1.5 rounded-full text-sm font-medium shadow">
                                        <i class="fas fa-camera mr-1.5"></i>
                                        Foto
                                    </span>
                                    <span class="inline-flex items-center {{ $gallery->is_active ? 'bg-green-500' : 'bg-gray-500' }} text-white px-3 py-1.5 rounded-full text-sm font-medium shadow">
                                        <i class="fas {{ $gallery->is_active ? 'fa-eye' : 'fa-eye-slash' }} mr-1.5"></i>
                                        {{ $gallery->is_active ? 'Aktif' : 'Nonaktif' }}
                                    </span>
                                </div>

                                <!-- Image Actions -->
                                <div class="absolute top-4 right-4 flex gap-2">
                                    @if($gallery->image_path)
                                    <button onclick="downloadPhoto()" 
                                            class="inline-flex items-center bg-white text-gray-700 px-3 py-1.5 rounded-full text-sm hover:bg-gray-50 shadow"
                                            title="Download Foto">
                                        <i class="fas fa-download mr-1.5"></i>
                                    </button>
                                    <button onclick="openFullScreen()" 
                                            class="inline-flex items-center bg-white text-gray-700 px-3 py-1.5 rounded-full text-sm hover:bg-gray-50 shadow"
                                            title="Full Screen">
                                        <i class="fas fa-expand mr-1.5"></i>
                                    </button>
                                    @endif
                                </div>
                            </div>
                        @else
                            <div class="bg-gray-900 p-4 md:p-6">
                                <div class="relative" style="padding-bottom: 56.25%; height: 0;">
                                    @php
                                        $videoUrl = $gallery->video_url;
                                        $embedUrl = null;
                                        
                                        if (strpos($videoUrl, 'youtube.com') !== false || strpos($videoUrl, 'youtu.be') !== false) {
                                            preg_match('/(?:youtube\.com\/watch\?v=|youtu\.be\/)([a-zA-Z0-9_-]+)/', $videoUrl, $matches);
                                            $videoId = $matches[1] ?? null;
                                            if ($videoId) {
                                                $embedUrl = "https://www.youtube.com/embed/{$videoId}";
                                            }
                                        } elseif (strpos($videoUrl, 'vimeo.com') !== false) {
                                            preg_match('/vimeo\.com\/(\d+)/', $videoUrl, $matches);
                                            $videoId = $matches[1] ?? null;
                                            if ($videoId) {
                                                $embedUrl = "https://player.vimeo.com/video/{$videoId}";
                                            }
                                        }
                                    @endphp
                                    
                                    @if($embedUrl)
                                        <iframe src="{{ $embedUrl }}" 
                                                class="absolute top-0 left-0 w-full h-full"
                                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                                                allowfullscreen>
                                        </iframe>
                                    @else
                                        <div class="absolute inset-0 flex flex-col items-center justify-center bg-gray-800">
                                            <i class="fas fa-video text-5xl text-gray-400 mb-4"></i>
                                            <p class="text-gray-300 text-lg mb-2">Video preview tidak tersedia</p>
                                            <a href="{{ $videoUrl }}" target="_blank" 
                                               class="inline-flex items-center text-blue-400 hover:text-blue-300 text-sm">
                                                <i class="fas fa-external-link-alt mr-2"></i>
                                                Buka video di tab baru
                                            </a>
                                        </div>
                                    @endif
                                </div>
                                
                                <!-- Type & Status Badges -->
                                <div class="flex gap-2 mt-4">
                                    <span class="inline-flex items-center bg-red-500 text-white px-3 py-1.5 rounded-full text-sm font-medium">
                                        <i class="fas fa-video mr-1.5"></i>
                                        Video
                                    </span>
                                    <span class="inline-flex items-center {{ $gallery->is_active ? 'bg-green-500' : 'bg-gray-500' }} text-white px-3 py-1.5 rounded-full text-sm font-medium">
                                        <i class="fas {{ $gallery->is_active ? 'fa-eye' : 'fa-eye-slash' }} mr-1.5"></i>
                                        {{ $gallery->is_active ? 'Aktif' : 'Nonaktif' }}
                                    </span>
                                </div>
                            </div>
                        @endif
                    </div>

                    <!-- Content Details -->
                    <div class="px-4 py-6 sm:p-8">
                        <!-- Title & Meta -->
                        <div class="mb-6">
                            <h1 class="text-2xl md:text-3xl font-bold text-gray-900 mb-4 leading-tight">{{ $gallery->title }}</h1>
                            
                            <!-- Meta Info -->
                            <div class="flex flex-wrap items-center gap-4 text-sm text-gray-600">
                                <div class="flex items-center">
                                    <i class="far fa-calendar-alt text-gray-400 mr-2"></i>
                                    <span>Ditambahkan: {{ $gallery->created_at->format('d F Y') }}</span>
                                </div>
                                
                                <div class="flex items-center">
                                    <i class="far fa-clock text-gray-400 mr-2"></i>
                                    <span>{{ $gallery->created_at->format('H:i') }}</span>
                                </div>
                                
                                @if($gallery->order)
                                <div class="flex items-center">
                                    <i class="fas fa-sort-numeric-up text-gray-400 mr-2"></i>
                                    <span>Urutan: {{ $gallery->order }}</span>
                                </div>
                                @endif
                            </div>
                        </div>

                        <!-- Category -->
                        @if($gallery->category)
                        <div class="mb-6">
                            <span class="inline-flex items-center bg-blue-100 text-blue-700 px-3 py-1.5 rounded-full text-sm font-medium">
                                <i class="fas fa-tag mr-1.5"></i>
                                {{ $gallery->category }}
                            </span>
                        </div>
                        @endif

                        <!-- Description -->
                        @if($gallery->description)
                        <div class="mb-8">
                            <h3 class="text-lg font-medium text-gray-900 mb-3 flex items-center">
                                <i class="fas fa-align-left mr-2 text-gray-400"></i>
                                Deskripsi
                            </h3>
                            <div class="bg-gray-50 border border-gray-200 rounded-lg p-4">
                                <p class="text-gray-700 whitespace-pre-line leading-relaxed">{{ $gallery->description }}</p>
                            </div>
                        </div>
                        @endif

                        <!-- File Info -->
                        <div class="border-t border-gray-200 pt-6">
                            <h3 class="text-lg font-medium text-gray-900 mb-4 flex items-center">
                                <i class="fas fa-info-circle mr-2 text-gray-400"></i>
                                Informasi File
                            </h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div class="bg-gray-50 rounded-lg p-4">
                                    <div class="flex items-center">
                                        <i class="fas {{ $gallery->type === 'photo' ? 'fa-camera' : 'fa-video' }} text-gray-400 text-lg mr-3"></i>
                                        <div>
                                            <p class="text-sm font-medium text-gray-900">Tipe Media</p>
                                            <p class="text-sm text-gray-600">{{ $gallery->type === 'photo' ? 'Gambar' : 'Video' }}</p>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="bg-gray-50 rounded-lg p-4">
                                    <div class="flex items-center">
                                        <i class="fas fa-link text-gray-400 text-lg mr-3"></i>
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
                <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                    <div class="px-4 py-5 sm:px-6 border-b border-gray-200">
                        <h3 class="text-lg font-medium text-gray-900 flex items-center">
                            <i class="fas fa-share-alt mr-2 text-blue-500"></i>
                            Bagikan
                        </h3>
                    </div>
                    <div class="px-4 py-5 sm:p-6">
                        <div class="flex flex-wrap gap-3">
                            @if($gallery->type === 'photo')
                                <button onclick="sharePhoto()" 
                                        class="inline-flex items-center px-4 py-2.5 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-200 hover:-translate-y-0.5">
                                    <i class="fab fa-facebook-f mr-2"></i> Facebook
                                </button>
                                <button onclick="downloadPhoto()" 
                                        class="inline-flex items-center px-4 py-2.5 bg-green-600 text-white rounded-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-all duration-200 hover:-translate-y-0.5">
                                    <i class="fas fa-download mr-2"></i> Download
                                </button>
                            @else
                                <button onclick="shareVideo()" 
                                        class="inline-flex items-center px-4 py-2.5 bg-red-600 text-white rounded-md hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-all duration-200 hover:-translate-y-0.5">
                                    <i class="fab fa-youtube mr-2"></i> YouTube
                                </button>
                            @endif
                            <button onclick="copyMediaLink()" 
                                    class="inline-flex items-center px-4 py-2.5 bg-gray-600 text-white rounded-md hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition-all duration-200 hover:-translate-y-0.5" 
                                    id="copyLinkBtn">
                                <i class="fas fa-link mr-2"></i> Salin Link
                            </button>
                        </div>
                    </div>
                </div>
                @endif
            </div>

            <!-- Right Column: Sidebar -->
            <div class="space-y-6">
                <!-- Status Card -->
                <div class="bg-white shadow overflow-hidden sm:rounded-lg sticky top-6">
                    <div class="px-4 py-5 sm:px-6 border-b border-gray-200">
                        <h3 class="text-lg font-medium text-gray-900 flex items-center">
                            <i class="fas fa-chart-line mr-2 text-blue-500"></i>
                            Status Item
                        </h3>
                    </div>
                    <div class="px-4 py-5 sm:p-6">
                        <div class="space-y-4">
                            <!-- Publication Status -->
                            <div class="flex items-center justify-between">
                                <span class="text-sm text-gray-600">Status Publikasi</span>
                                <form action="{{ route('admin.galleries.toggle-active', $gallery) }}" method="POST" class="inline">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" 
                                            class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-medium {{ $gallery->is_active ? 'bg-green-100 text-green-800 hover:bg-green-200' : 'bg-gray-100 text-gray-800 hover:bg-gray-200' }} transition-colors">
                                        <i class="fas {{ $gallery->is_active ? 'fa-eye' : 'fa-eye-slash' }} mr-1.5"></i>
                                        {{ $gallery->is_active ? 'Aktif' : 'Nonaktif' }}
                                    </button>
                                </form>
                            </div>
                            
                            <!-- Date Information -->
                            <div class="space-y-3">
                                <div class="flex items-center justify-between">
                                    <span class="text-sm text-gray-600">Tanggal Ditambahkan</span>
                                    <span class="text-sm font-medium text-gray-900">{{ $gallery->created_at->format('d/m/Y') }}</span>
                                </div>
                                
                                <div class="flex items-center justify-between">
                                    <span class="text-sm text-gray-600">Terakhir Diupdate</span>
                                    <span class="text-sm font-medium text-gray-900">{{ $gallery->updated_at->format('d/m/Y') }}</span>
                                </div>
                                
                                @if($gallery->order)
                                <div class="flex items-center justify-between">
                                    <span class="text-sm text-gray-600">Urutan Tampilan</span>
                                    <span class="text-sm font-medium text-gray-900">{{ $gallery->order }}</span>
                                </div>
                                @endif
                                
                                @if($gallery->category)
                                <div class="flex items-center justify-between">
                                    <span class="text-sm text-gray-600">Kategori</span>
                                    <span class="text-sm font-medium text-gray-900">{{ $gallery->category }}</span>
                                </div>
                                @endif
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
                            <a href="{{ route('admin.galleries.edit', $gallery) }}" 
                               class="w-full inline-flex items-center justify-center bg-blue-600 text-white px-4 py-3 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
                                <i class="fas fa-edit mr-2"></i>
                                Edit Item
                            </a>
                            
                            <form action="{{ route('admin.galleries.toggle-active', $gallery) }}" method="POST" class="w-full">
                                @csrf
                                @method('PATCH')
                                <button type="submit" 
                                        class="w-full inline-flex items-center justify-center {{ $gallery->is_active ? 'bg-yellow-600 hover:bg-yellow-700' : 'bg-green-600 hover:bg-green-700' }} text-white px-4 py-3 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 {{ $gallery->is_active ? 'focus:ring-yellow-500' : 'focus:ring-green-500' }} transition-colors">
                                    <i class="fas {{ $gallery->is_active ? 'fa-eye-slash' : 'fa-eye' }} mr-2"></i>
                                    {{ $gallery->is_active ? 'Nonaktifkan' : 'Aktifkan' }}
                                </button>
                            </form>
                            
                            <button onclick="confirmDelete()" 
                                    class="w-full inline-flex items-center justify-center bg-red-600 text-white px-4 py-3 rounded-md hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-colors">
                                <i class="fas fa-trash mr-2"></i>
                                Hapus Item
                            </button>
                            
                            @if($gallery->is_active)
                            <a href="{{ url('/galeri/' . $gallery->id) }}" 
                               target="_blank"
                               class="w-full inline-flex items-center justify-center bg-purple-600 text-white px-4 py-3 rounded-md hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500 transition-colors">
                                <i class="fas fa-external-link-alt mr-2"></i>
                                Lihat di Website
                            </a>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Related Galleries -->
                @if(isset($related) && $related->count() > 0)
                <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                    <div class="px-4 py-5 sm:px-6 border-b border-gray-200">
                        <h3 class="text-lg font-medium text-gray-900 flex items-center">
                            <i class="fas fa-images mr-2 text-blue-500"></i>
                            Item Terkait
                        </h3>
                    </div>
                    <div class="px-4 py-5 sm:p-6">
                        <div class="space-y-4">
                            @foreach($related as $item)
                            <a href="{{ route('admin.galleries.show', $item) }}" 
                               class="flex items-center p-3 border border-gray-200 rounded-lg hover:bg-gray-50 transition-colors group">
                                <div class="flex-shrink-0 mr-3">
                                    @if($item->type === 'photo')
                                        <img src="{{ $item->image_path ? asset('storage/' . $item->image_path) : 'https://via.placeholder.com/60x60/cccccc/ffffff?text=No+Image' }}" 
                                             alt="{{ $item->title }}"
                                             class="w-12 h-12 object-cover rounded group-hover:scale-105 transition-transform">
                                    @else
                                        <div class="w-12 h-12 bg-red-100 rounded flex items-center justify-center group-hover:bg-red-200 transition-colors">
                                            <i class="fas fa-video text-red-500"></i>
                                        </div>
                                    @endif
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-medium text-gray-900 truncate group-hover:text-blue-600 transition-colors">{{ $item->title }}</p>
                                    <div class="flex items-center text-xs text-gray-500 mt-1">
                                        <span class="inline-flex items-center {{ $item->type === 'photo' ? 'text-blue-600' : 'text-red-600' }}">
                                            <i class="fas {{ $item->type === 'photo' ? 'fa-camera' : 'fa-video' }} mr-1 text-xs"></i>
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
                </div>
                @endif

                <!-- File Details -->
                <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                    <div class="px-4 py-5 sm:px-6 border-b border-gray-200">
                        <h3 class="text-lg font-medium text-gray-900 flex items-center">
                            <i class="fas fa-terminal mr-2 text-blue-500"></i>
                            Detail Teknis
                        </h3>
                    </div>
                    <div class="px-4 py-5 sm:p-6">
                        <div class="space-y-3">
                            <div class="flex justify-between items-center">
                                <span class="text-gray-600 text-sm">ID Item</span>
                                <span class="font-mono text-sm text-gray-900 bg-gray-100 px-2 py-0.5 rounded">{{ $gallery->id }}</span>
                            </div>
                            
                            <div class="flex justify-between items-center">
                                <span class="text-gray-600 text-sm">Tipe Media</span>
                                <span class="text-sm font-medium text-gray-900">{{ $gallery->type === 'photo' ? 'Gambar' : 'Video' }}</span>
                            </div>
                            
                            @if($gallery->image_path)
                            <div class="flex justify-between items-center">
                                <span class="text-gray-600 text-sm">Path File</span>
                                <span class="text-sm text-gray-900 truncate ml-2" title="{{ $gallery->image_path }}">
                                    {{ Str::limit($gallery->image_path, 30) }}
                                </span>
                            </div>
                            @endif
                            
                            @if($gallery->video_url)
                            <div class="flex justify-between items-center">
                                <span class="text-gray-600 text-sm">URL Video</span>
                                <a href="{{ $gallery->video_url }}" 
                                   target="_blank" 
                                   class="text-sm text-blue-600 hover:text-blue-800 truncate ml-2"
                                   title="{{ $gallery->video_url }}">
                                    {{ Str::limit($gallery->video_url, 30) }}
                                </a>
                            </div>
                            @endif
                            
                            <div class="pt-4 border-t border-gray-200">
                                <button onclick="showRawData()" 
                                        class="w-full inline-flex items-center justify-center text-gray-600 hover:text-gray-900 text-sm">
                                    <i class="fas fa-code mr-2"></i>
                                    Tampilkan Data Raw
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div id="deleteModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center p-4 z-50 transition-opacity duration-300">
    <div class="bg-white rounded-lg shadow-xl max-w-md w-full p-6 transform transition-all duration-300 scale-95 opacity-0" id="deleteModalContent">
        <div class="text-center">
            <div class="mx-auto flex items-center justify-center h-14 w-14 rounded-full bg-red-100 mb-4">
                <i class="fas fa-exclamation-triangle text-red-600 text-xl"></i>
            </div>
            <h3 class="text-lg font-medium text-gray-900 mb-2">Hapus Item Galeri?</h3>
            <p class="text-sm text-gray-500 mb-6">
                Item "{{ Str::limit($gallery->title, 50) }}" akan dihapus permanen. Tindakan ini tidak dapat dibatalkan.
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

<!-- Raw Data Modal -->
<div id="rawDataModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center p-4 z-50 transition-opacity duration-300">
    <div class="bg-white rounded-lg shadow-xl max-w-2xl w-full max-h-[80vh] overflow-hidden transform transition-all duration-300 scale-95 opacity-0" id="rawDataModalContent">
        <div class="p-6 border-b border-gray-200">
            <div class="flex items-center justify-between">
                <h3 class="text-lg font-medium text-gray-900">Data Raw Item</h3>
                <button onclick="closeRawDataModal()" 
                        class="text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 rounded-full p-1">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>
        <div class="p-6 overflow-auto max-h-[60vh]">
            <pre class="text-sm bg-gray-50 p-4 rounded-lg overflow-x-auto font-mono text-gray-800">{{ json_encode($gallery->toArray(), JSON_PRETTY_PRINT) }}</pre>
        </div>
        <div class="p-6 border-t border-gray-200">
            <button onclick="closeRawDataModal()" 
                    class="w-full px-4 py-2 bg-gray-200 text-gray-700 rounded-md text-sm font-medium hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition-colors">
                Tutup
            </button>
        </div>
    </div>
</div>

<!-- Full Screen Image Modal -->
<div id="fullScreenModal" class="fixed inset-0 bg-black bg-opacity-90 hidden items-center justify-center p-4 z-50 transition-opacity duration-300">
    <div class="relative w-full h-full flex items-center justify-center">
        <button onclick="closeFullScreen()" 
                class="absolute top-4 right-4 text-white hover:text-gray-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-white rounded-full p-2">
            <i class="fas fa-times text-2xl"></i>
        </button>
        @if($gallery->type === 'photo' && $gallery->image_path)
        <img src="{{ asset('storage/' . $gallery->image_path) }}" 
             alt="{{ $gallery->title }}"
             class="max-w-full max-h-full object-contain">
        @endif
    </div>
</div>
@endsection

@push('styles')
<style>
    .sticky {
        position: -webkit-sticky;
        position: sticky;
    }
</style>
@endpush

@push('scripts')
<script>
    // Delete Confirmation
    function confirmDelete() {
        const modal = document.getElementById('deleteModal');
        const modalContent = document.getElementById('deleteModalContent');
        modal.classList.remove('hidden');
        setTimeout(() => {
            modalContent.classList.remove('scale-95', 'opacity-0');
            modalContent.classList.add('scale-100', 'opacity-100');
        }, 10);
    }

    function closeDeleteModal() {
        const modal = document.getElementById('deleteModal');
        const modalContent = document.getElementById('deleteModalContent');
        modalContent.classList.remove('scale-100', 'opacity-100');
        modalContent.classList.add('scale-95', 'opacity-0');
        setTimeout(() => {
            modal.classList.add('hidden');
        }, 300);
    }

    // Raw Data Modal
    function showRawData() {
        const modal = document.getElementById('rawDataModal');
        const modalContent = document.getElementById('rawDataModalContent');
        modal.classList.remove('hidden');
        setTimeout(() => {
            modalContent.classList.remove('scale-95', 'opacity-0');
            modalContent.classList.add('scale-100', 'opacity-100');
        }, 10);
    }

    function closeRawDataModal() {
        const modal = document.getElementById('rawDataModal');
        const modalContent = document.getElementById('rawDataModalContent');
        modalContent.classList.remove('scale-100', 'opacity-100');
        modalContent.classList.add('scale-95', 'opacity-0');
        setTimeout(() => {
            modal.classList.add('hidden');
        }, 300);
    }

    // Full Screen Image
    function openFullScreen() {
        const modal = document.getElementById('fullScreenModal');
        modal.classList.remove('hidden');
    }

    function closeFullScreen() {
        const modal = document.getElementById('fullScreenModal');
        modal.classList.add('hidden');
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
        @if($gallery->type === 'photo' && $gallery->image_path)
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
        }).catch(err => {
            console.error('Gagal menyalin link:', err);
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

    document.getElementById('fullScreenModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeFullScreen();
        }
    });

    // Escape key to close modals
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeDeleteModal();
            closeRawDataModal();
            closeFullScreen();
        }
    });

    // Image click to zoom
    document.addEventListener('DOMContentLoaded', function() {
        const galleryImage = document.getElementById('galleryImage');
        if (galleryImage) {
            galleryImage.addEventListener('click', function() {
                openFullScreen();
            });
        }
    });
</script>
@endpush