{{-- resources/views/news/show.blade.php --}}
@extends('layouts.home-app')

@section('title', $news->title . ' - Berita Desa Cicangkang Hilir')

@push('styles')
<style>
    .news-content img {
        max-width: 100%;
        height: auto;
        border-radius: 8px;
        margin: 1.5rem 0;
    }
    
    .news-content h2 {
        font-size: 1.5rem;
        font-weight: bold;
        margin: 1.5rem 0 1rem;
        color: #1e40af;
    }
    
    .news-content h3 {
        font-size: 1.25rem;
        font-weight: bold;
        margin: 1.25rem 0 0.75rem;
        color: #374151;
    }
    
    .news-content p {
        margin-bottom: 1rem;
        line-height: 1.7;
        color: #4b5563;
    }
    
    .news-content ul, .news-content ol {
        margin-bottom: 1rem;
        padding-left: 1.5rem;
    }
    
    .news-content li {
        margin-bottom: 0.5rem;
        line-height: 1.6;
    }
    
    .news-header {
        background: linear-gradient(rgba(30, 64, 175, 0.05), rgba(30, 64, 175, 0.1));
        border-radius: 12px;
        padding: 2rem;
        margin-bottom: 2rem;
    }
    
    .news-meta {
        display: flex;
        flex-wrap: wrap;
        gap: 1rem;
        margin-bottom: 1rem;
        color: #6b7280;
        font-size: 0.875rem;
    }
    
    .meta-item {
        display: flex;
        align-items: center;
        gap: 0.375rem;
    }
    
    .meta-item svg {
        width: 1rem;
        height: 1rem;
    }
    
    .share-buttons {
        display: flex;
        gap: 0.75rem;
        margin-top: 2rem;
        padding-top: 1.5rem;
        border-top: 1px solid #e5e7eb;
    }
    
    .share-button {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 2.5rem;
        height: 2.5rem;
        border-radius: 50%;
        background: #f3f4f6;
        color: #374151;
        transition: all 0.2s ease;
    }
    
    .share-button:hover {
        background: #e5e7eb;
        transform: translateY(-2px);
    }
    
    .share-button.whatsapp:hover {
        background: #25D366;
        color: white;
    }
    
    .share-button.facebook:hover {
        background: #1877F2;
        color: white;
    }
    
    .share-button.twitter:hover {
        background: #1DA1F2;
        color: white;
    }
    
    .news-navigation {
        display: flex;
        justify-content: space-between;
        margin-top: 3rem;
        padding-top: 2rem;
        border-top: 1px solid #e5e7eb;
    }
    
    .nav-link {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        color: #1e40af;
        font-weight: 500;
        transition: color 0.2s ease;
    }
    
    .nav-link:hover {
        color: #1e3a8a;
    }
    
    .related-news {
        margin-top: 4rem;
    }
    
    .related-news-title {
        font-size: 1.5rem;
        font-weight: bold;
        color: #1e40af;
        margin-bottom: 1.5rem;
        padding-bottom: 0.75rem;
        border-bottom: 2px solid #e5e7eb;
    }
    
    @media (max-width: 768px) {
        .news-header {
            padding: 1.5rem;
        }
        
        .news-meta {
            flex-direction: column;
            gap: 0.5rem;
        }
        
        .news-navigation {
            flex-direction: column;
            gap: 1rem;
        }
    }
</style>
@endpush

@section('content')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="container mx-auto px-4">
        <!-- Breadcrumb -->
        <nav class="mb-6">
            <ol class="flex items-center space-x-2 text-sm text-gray-600">
                <li>
                    <a href="{{ route('landing-page') }}" class="hover:text-primary">Beranda</a>
                </li>
                <li class="flex items-center">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                    <a href="{{ route('news.index') }}" class="ml-2 hover:text-primary">Berita</a>
                </li>
                <li class="flex items-center">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                    <span class="ml-2 text-gray-400 line-clamp-1">{{ $news->title }}</span>
                </li>
            </ol>
        </nav>

        <!-- News Header -->
        <article class="bg-white rounded-xl shadow-lg overflow-hidden">
            <!-- Thumbnail -->
            <div class="h-64 md:h-96 overflow-hidden">
                <img src="{{ $news->thumbnail }}" 
                     alt="{{ $news->title }}"
                     class="w-full h-full object-cover">
            </div>
            
            <!-- Content -->
            <div class="p-6 md:p-8">
                <!-- News Header -->
                <div class="news-header">
                    <h1 class="text-2xl md:text-3xl font-bold text-gray-900 mb-4">
                        {{ $news->title }}
                    </h1>
                    
                    <!-- Meta Information -->
                    <div class="news-meta">
                        <div class="meta-item">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            <span>{{ $news->published_date }}</span>
                        </div>
                        
                        @if($news->author)
                        <div class="meta-item">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                            <span>{{ $news->author->name }}</span>
                        </div>
                        @endif
                        
                        <div class="meta-item">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span>{{ $news->reading_time }}</span>
                        </div>
                        
                        <div class="meta-item">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                            <span>{{ number_format($news->views) }} dilihat</span>
                        </div>
                    </div>
                    
                    <!-- Excerpt -->
                    <div class="text-gray-600 text-lg leading-relaxed mb-4">
                        {{ $news->excerpt }}
                    </div>
                </div>
                
                <!-- News Content -->
                <div class="news-content prose prose-lg max-w-none">
                    {!! $news->content !!}
                </div>
                
                <!-- Share Buttons -->
                <div class="share-buttons">
                    <span class="text-gray-600 font-medium">Bagikan:</span>
                    <a href="https://wa.me/?text={{ urlencode($news->title . ' - ' . url()->current()) }}" 
                       target="_blank"
                       class="share-button whatsapp">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"/>
                        </svg>
                    </a>
                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}" 
                       target="_blank"
                       class="share-button facebook">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                        </svg>
                    </a>
                    <a href="https://twitter.com/intent/tweet?url={{ urlencode(url()->current()) }}&text={{ urlencode($news->title) }}" 
                       target="_blank"
                       class="share-button twitter">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.213c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/>
                        </svg>
                    </a>
                </div>
                
                <!-- Navigation -->
                <div class="news-navigation">
                    @if($previousNews = \App\Models\News::where('is_published', true)
                        ->where('published_at', '<', $news->published_at)
                        ->orderBy('published_at', 'desc')
                        ->first())
                    <a href="{{ route('news.show', $previousNews->slug) }}" class="nav-link">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                        </svg>
                        <span>Berita Sebelumnya</span>
                    </a>
                    @else
                    <div></div>
                    @endif
                    
                    @if($nextNews = \App\Models\News::where('is_published', true)
                        ->where('published_at', '>', $news->published_at)
                        ->orderBy('published_at', 'asc')
                        ->first())
                    <a href="{{ route('news.show', $nextNews->slug) }}" class="nav-link">
                        <span>Berita Selanjutnya</span>
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </a>
                    @endif
                </div>
            </div>
        </article>

        <!-- Related News -->
        @php
            $relatedNews = \App\Models\News::where('is_published', true)
                ->where('id', '!=', $news->id)
                ->where('published_at', '<=', now())
                ->orderBy('published_at', 'desc')
                ->take(3)
                ->get();
        @endphp
        
        @if($relatedNews->count() > 0)
        <div class="related-news">
            <h2 class="related-news-title">Berita Terkait</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach($relatedNews as $related)
                <a href="{{ route('news.show', $related->slug) }}" 
                   class="bg-white rounded-lg shadow-md overflow-hidden border border-gray-100 hover:shadow-lg transition-shadow duration-300">
                    <div class="h-48 overflow-hidden">
                        <img src="{{ $related->thumbnail }}" 
                             alt="{{ $related->title }}"
                             class="w-full h-full object-cover hover:scale-105 transition-transform duration-300">
                    </div>
                    <div class="p-4">
                        <div class="text-sm text-gray-500 mb-2">
                            {{ $related->published_date }}
                        </div>
                        <h3 class="font-bold text-gray-800 mb-2 line-clamp-2">
                            {{ $related->title }}
                        </h3>
                        <p class="text-gray-600 text-sm line-clamp-2">
                            {{ $related->short_excerpt }}
                        </p>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
        @endif
    </div>
</div>
@endsection