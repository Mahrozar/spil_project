@extends('layouts.home-app')

@section('title', 'Berita Desa Cicangkang Hilir')

@push('styles')
<style>
    .news-card {
        transition: all 0.3s ease;
    }
    
    .news-card:hover {
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
</style>
@endpush

@section('content')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="container mx-auto px-4">
        <!-- Page Header -->
        <div class="text-center mb-12">
            <h1 class="text-3xl md:text-4xl font-bold text-primary mb-4">Berita Desa</h1>
            <p class="text-gray-600 max-w-2xl mx-auto">Informasi terbaru dan kegiatan dari Pemerintah Desa Cicangkang Hilir</p>
        </div>

        <!-- Search and Filter -->
        <div class="mb-8">
            <form action="{{ route('news.index') }}" method="GET" class="flex flex-col md:flex-row gap-4">
                <div class="flex-1">
                    <div class="search-box">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                        <input type="text" 
                               name="search" 
                               value="{{ request('search') }}"
                               placeholder="Cari berita..."
                               class="w-full px-4 py-3 pl-12 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent">
                    </div>
                </div>
                <button type="submit" 
                        class="bg-primary text-white font-semibold py-3 px-6 rounded-lg hover:bg-secondary transition duration-300">
                    Cari
                </button>
                <a href="{{ route('news.index') }}"
                   class="bg-gray-200 text-gray-700 font-semibold py-3 px-6 rounded-lg hover:bg-gray-300 transition duration-300 text-center">
                    Reset
                </a>
            </form>
        </div>

        <!-- News Grid -->
        @if($news->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
                @foreach ($news as $item)
                    <a href="{{ route('news.show', $item->slug) }}" 
                       class="news-card bg-white rounded-xl shadow-md overflow-hidden border border-gray-100">
                        <!-- Thumbnail -->
                        <div class="h-56 overflow-hidden">
                            <img src="{{ $item->thumbnail ? asset('storage/' . $item->thumbnail) : 'https://via.placeholder.com/400x300/cccccc/ffffff?text=No+Image' }}" 
                                 alt="{{ $item->title }}"
                                 class="w-full h-full object-cover">
                        </div>
                        
                        <!-- Content -->
                        <div class="p-6">
                            <div class="flex items-center justify-between mb-3">
                                <div class="text-sm text-gray-500">
                                    {{ $item->published_date }}
                                </div>
                                @if($item->author)
                                <div class="text-sm text-gray-600">
                                    {{ $item->author->name }}
                                </div>
                                @endif
                            </div>
                            
                            <h3 class="text-xl font-bold text-gray-900 mb-3 line-clamp-2">
                                {{ $item->title }}
                            </h3>
                            
                            <p class="text-gray-600 mb-4 line-clamp-3">
                                {{ $item->short_excerpt }}
                            </p>
                            
                            <div class="flex items-center text-primary font-medium">
                                <span>Baca Selengkapnya</span>
                                <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                </svg>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>

            <!-- Pagination -->
            @if($news->hasPages())
            <div class="flex justify-center">
                <div class="pagination">
                    {{ $news->links() }}
                </div>
            </div>
            @endif
        @else
            <!-- No News Found -->
            <div class="text-center py-12">
                <svg class="w-20 h-20 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <h3 class="text-xl font-semibold text-gray-700 mb-2">Tidak ada berita ditemukan</h3>
                <p class="text-gray-600 mb-6">
                    @if(request()->has('search'))
                        Tidak ada berita yang sesuai dengan pencarian "{{ request('search') }}"
                    @else
                        Belum ada berita yang dipublikasikan
                    @endif
                </p>
                <a href="{{ route('news.index') }}"
                   class="inline-block bg-primary text-white font-semibold py-3 px-6 rounded-lg hover:bg-secondary transition duration-300">
                    Lihat Semua Berita
                </a>
            </div>
        @endif
    </div>
</div>
@endsection