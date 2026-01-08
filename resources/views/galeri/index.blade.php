@extends('layouts.home-app')

@section('title', 'Galeri Desa Cicangkang Hilir')

@push('styles')
<style>
    .gallery-card {
        transition: all 0.3s ease;
        border-radius: 0.75rem;
        overflow: hidden;
    }
    
    .gallery-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
    }
    
    .category-badge {
        display: inline-block;
        padding: 0.25rem 0.75rem;
        background: #1e40af;
        color: white;
        border-radius: 9999px;
        font-size: 0.75rem;
        font-weight: 500;
    }
    
    .pagination .page-link {
        padding: 0.5rem 1rem;
        border: 1px solid #e5e7eb;
        color: #1e40af;
        margin: 0 0.25rem;
        border-radius: 0.375rem;
        transition: all 0.2s ease;
    }
    
    .pagination .page-link:hover {
        background: #1e40af;
        color: white;
        border-color: #1e40af;
    }
    
    .pagination .active .page-link {
        background: #1e40af;
        color: white;
        border-color: #1e40af;
    }
    
    .search-box {
        position: relative;
    }
    
    .search-box input {
        padding-left: 3rem;
    }
    
    .search-box svg {
        position: absolute;
        left: 1rem;
        top: 50%;
        transform: translateY(-50%);
        color: #9ca3af;
    }
    
    .image-container {
        position: relative;
        overflow: hidden;
        height: 250px;
    }
    
    .image-container img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }
    
    .gallery-card:hover .image-container img {
        transform: scale(1.05);
    }
    
    .image-overlay {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        background: linear-gradient(to top, rgba(0,0,0,0.7), transparent);
        padding: 1rem;
        opacity: 0;
        transition: opacity 0.3s ease;
    }
    
    .gallery-card:hover .image-overlay {
        opacity: 1;
    }
    
    .filter-btn {
        transition: all 0.2s ease;
    }
    
    .filter-btn.active {
        background: #1e40af;
        color: white;
    }
</style>
@endpush

@section('content')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="container mx-auto px-4">
        <!-- Page Header -->
        <div class="text-center mb-12">
            <h1 class="text-3xl md:text-4xl font-bold text-primary mb-4">Galeri Desa</h1>
            <p class="text-gray-600 max-w-2xl mx-auto">Dokumentasi kegiatan dan potensi Desa Cicangkang Hilir</p>
        </div>

        <!-- Search and Filter -->
        <div class="mb-8">
            <form action="{{ route('gallery.index') }}" method="GET" class="flex flex-col md:flex-row gap-4 mb-6">
                <div class="flex-1">
                    <div class="search-box">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                        <input type="text" 
                               name="search" 
                               value="{{ request('search') }}"
                               placeholder="Cari gambar..."
                               class="w-full px-4 py-3 pl-12 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent">
                    </div>
                </div>
                <button type="submit" 
                        class="bg-primary text-white font-semibold py-3 px-6 rounded-lg hover:bg-secondary transition duration-300">
                    <i class="fas fa-search mr-2"></i> Cari
                </button>
                <a href="{{ route('gallery.index') }}"
                   class="bg-gray-200 text-gray-700 font-semibold py-3 px-6 rounded-lg hover:bg-gray-300 transition duration-300 text-center">
                    <i class="fas fa-redo mr-2"></i> Reset
                </a>
            </form>

            <!-- Category Filters -->
            @if($categories->count() > 0)
                <div class="flex flex-wrap gap-2 justify-center">
                    <a href="{{ route('gallery.index') }}" 
                       class="filter-btn px-4 py-2 rounded-full border {{ !$category ? 'active' : 'border-gray-300 hover:bg-gray-50' }}">
                        Semua
                    </a>
                    @foreach($categories as $cat)
                        <a href="{{ route('gallery.index', ['category' => $cat]) }}" 
                           class="filter-btn px-4 py-2 rounded-full border {{ $category == $cat ? 'active' : 'border-gray-300 hover:bg-gray-50' }}">
                            {{ ucfirst($cat) }}
                        </a>
                    @endforeach
                </div>
            @endif
        </div>

        <!-- Gallery Grid -->
        @if($galleries->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
                @foreach ($galleries as $item)
                    <div class="gallery-card bg-white rounded-xl shadow-md overflow-hidden border border-gray-100">
                        <!-- Image with Lightbox -->
                        <div class="image-container">
                            <a href="{{ asset('storage/' . $item->image_path) }}" 
                               data-lightbox="gallery" 
                               data-title="{{ $item->title ?: 'Galeri Desa' }}"
                               class="block w-full h-full">
                                <img src="{{ asset('storage/' . $item->image_path) }}" 
                                     alt="{{ $item->title ?: 'Galeri Desa' }}">
                            </a>
                            
                            <!-- Category Badge -->
                            @if($item->category)
                                <div class="image-overlay">
                                    <span class="category-badge">{{ ucfirst($item->category) }}</span>
                                </div>
                            @endif
                        </div>
                        
                        <!-- Content -->
                        <div class="p-6">
                            <div class="flex items-center justify-between mb-3">
                                <div class="text-sm text-gray-500">
                                    <i class="far fa-calendar mr-1"></i>
                                    {{ $item->created_at->format('d M Y') }}
                                </div>
                                @if($item->type === 'video')
                                <div class="text-sm text-red-600">
                                    <i class="fas fa-video mr-1"></i> Video
                                </div>
                                @endif
                            </div>
                            
                            @if($item->title)
                                <h3 class="text-xl font-bold text-gray-900 mb-3 line-clamp-2">
                                    {{ $item->title }}
                                </h3>
                            @endif
                            
                            @if($item->description)
                                <p class="text-gray-600 mb-4 line-clamp-2">
                                    {{ $item->description }}
                                </p>
                            @endif
                            
                            <div class="flex items-center justify-between">
                                <a href="{{ route('gallery.show', $item->id) }}" 
                                   class="text-primary font-medium hover:text-secondary">
                                    Lihat Detail
                                    <i class="fas fa-arrow-right ml-2"></i>
                                </a>
                                <button onclick="shareGallery('{{ route('gallery.show', $item->id) }}', '{{ $item->title }}')"
                                        class="text-gray-500 hover:text-primary">
                                    <i class="fas fa-share-alt"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            @if($galleries->hasPages())
            <div class="flex justify-center">
                <div class="pagination">
                    {{ $galleries->links() }}
                </div>
            </div>
            @endif
        @else
            <!-- No Gallery Found -->
            <div class="text-center py-12">
                <div class="inline-block p-6 bg-gray-100 rounded-full mb-4">
                    <svg class="w-16 h-16 mx-auto text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                              d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-700 mb-2">Tidak ada galeri ditemukan</h3>
                <p class="text-gray-600 mb-6">
                    @if(request()->has('search'))
                        Tidak ada gambar yang sesuai dengan pencarian "{{ request('search') }}"
                    @elseif(request()->has('category'))
                        Tidak ada gambar dalam kategori "{{ ucfirst(request('category')) }}"
                    @else
                        Belum ada galeri yang tersedia
                    @endif
                </p>
                <a href="{{ route('gallery.index') }}"
                   class="inline-block bg-primary text-white font-semibold py-3 px-6 rounded-lg hover:bg-secondary transition duration-300">
                    <i class="fas fa-images mr-2"></i> Lihat Semua Galeri
                </a>
            </div>
        @endif
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Share function
    function shareGallery(url, title) {
        if (navigator.share) {
            navigator.share({
                title: title || 'Galeri Desa',
                text: 'Lihat galeri menarik dari Desa Cicangkang Hilir',
                url: url
            }).then(() => {
                console.log('Thanks for sharing!');
            }).catch(console.error);
        } else {
            // Fallback: copy to clipboard
            navigator.clipboard.writeText(url).then(() => {
                alert('Link berhasil disalin ke clipboard!');
            });
        }
    }
    
    // Category filter with active state
    document.querySelectorAll('.filter-btn').forEach(btn => {
        btn.addEventListener('click', function(e) {
            if (this.classList.contains('active')) {
                e.preventDefault();
            }
        });
    });
</script>
@endpush