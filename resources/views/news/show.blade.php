{{-- resources/views/news/show.blade.php --}}
@extends('layouts.home-app')

@section('title', $news->title . ' - Berita Desa Cicangkang Hilir')

@section('content')
<div class="pt-24 pb-16 bg-gradient-to-b from-gray-50/50 via-white to-gray-50/50">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Breadcrumb Navigation -->
        <nav class="mb-8">
            <ol class="flex items-center space-x-2 text-sm text-gray-600">
                <li>
                    <a href="{{ route('landing-page') }}" class="hover:text-primary transition-colors flex items-center">
                        <i class="fas fa-home mr-1"></i>
                        Beranda
                    </a>
                </li>
                <li class="flex items-center">
                    <i class="fas fa-chevron-right w-4 h-4 mx-2 text-gray-400"></i>
                    <a href="{{ route('news.index') }}" class="hover:text-primary transition-colors flex items-center">
                        <i class="fas fa-newspaper mr-1"></i>
                        Berita Desa
                    </a>
                </li>
                <li class="flex items-center">
                    <i class="fas fa-chevron-right w-4 h-4 mx-2 text-gray-400"></i>
                    <span class="text-gray-400 line-clamp-1 max-w-xs">{{ $news->title }}</span>
                </li>
            </ol>
        </nav>

        <!-- Main Article -->
        <article class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100 mb-8">
            <!-- Hero Image -->
            <div class="relative h-80 md:h-96 overflow-hidden">
                <img src="{{ $news->thumbnail ? asset('storage/' . $news->thumbnail) : 'https://via.placeholder.com/1200x600/cccccc/ffffff?text=Berita+Desa' }}" 
                     alt="{{ $news->title }}"
                     class="w-full h-full object-cover">
                <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-black/30 to-transparent"></div>
                <div class="absolute bottom-0 left-0 right-0 p-6 md:p-8 text-white">
                    <h1 class="text-3xl md:text-4xl font-bold mb-4">{{ $news->title }}</h1>
                </div>
            </div>
            
            <!-- Article Header -->
            <div class="relative bg-gradient-to-r from-primary/10 via-primary/5 to-white p-6 md:p-8 border-b border-gray-100">
                <!-- Meta Information -->
                <div class="flex flex-wrap items-center gap-4 md:gap-6 mb-6 text-gray-600">
                    <div class="flex items-center gap-2 text-sm md:text-base">
                        <i class="fas fa-calendar-alt w-5 h-5 text-primary"></i>
                        <span>{{ $news->published_date }}</span>
                    </div>
                    
                    @if($news->author)
                    <div class="flex items-center gap-2 text-sm md:text-base">
                        <i class="fas fa-user w-5 h-5 text-primary"></i>
                        <span>{{ $news->author->name }}</span>
                    </div>
                    @endif
                    
                    <div class="flex items-center gap-2 text-sm md:text-base">
                        <i class="fas fa-clock w-5 h-5 text-primary"></i>
                        <span>{{ $news->reading_time }}</span>
                    </div>
                    
                    <div class="flex items-center gap-2 text-sm md:text-base">
                        <i class="fas fa-eye w-5 h-5 text-primary"></i>
                        <span>{{ number_format($news->views) }} dilihat</span>
                    </div>
                    
                    @if($news->category)
                    <div class="flex items-center gap-2 text-sm md:text-base">
                        <i class="fas fa-tag w-5 h-5 text-primary"></i>
                        <span class="px-3 py-1 bg-primary/10 text-primary rounded-full text-sm">
                            {{ $news->category }}
                        </span>
                    </div>
                    @endif
                </div>
                
                <!-- Excerpt -->
                <div class="text-lg text-gray-700 leading-relaxed italic border-l-4 border-primary pl-4 py-2">
                    {{ $news->excerpt }}
                </div>
            </div>
            
            <!-- Article Content -->
            <div class="prose prose-lg max-w-none p-6 md:p-8">
                {!! $news->content !!}
            </div>
            
            <!-- Share Section -->
            <div class="p-6 md:p-8 border-t border-gray-100 bg-gradient-to-r from-gray-50 to-white">
                <div class="text-lg font-bold text-dark mb-4 flex items-center">
                    <i class="fas fa-share-alt mr-2"></i>
                    <span>Bagikan Berita Ini</span>
                </div>
                
                <div class="flex gap-3">
                    <a href="https://wa.me/?text={{ urlencode($news->title . ' - ' . url()->current()) }}" 
                       target="_blank"
                       class="relative flex items-center justify-center w-12 h-12 rounded-full transition-all duration-300 hover:scale-110 hover:shadow-lg bg-green-100 text-green-600 hover:bg-green-500 hover:text-white"
                       aria-label="Share via WhatsApp">
                        <i class="fab fa-whatsapp text-xl"></i>
                    </a>
                    
                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}" 
                       target="_blank"
                       class="relative flex items-center justify-center w-12 h-12 rounded-full transition-all duration-300 hover:scale-110 hover:shadow-lg bg-blue-100 text-blue-600 hover:bg-blue-500 hover:text-white"
                       aria-label="Share on Facebook">
                        <i class="fab fa-facebook-f text-xl"></i>
                    </a>
                    
                    <a href="https://twitter.com/intent/tweet?url={{ urlencode(url()->current()) }}&text={{ urlencode($news->title) }}" 
                       target="_blank"
                       class="relative flex items-center justify-center w-12 h-12 rounded-full transition-all duration-300 hover:scale-110 hover:shadow-lg bg-sky-100 text-sky-600 hover:bg-sky-500 hover:text-white"
                       aria-label="Share on Twitter">
                        <i class="fab fa-twitter text-xl"></i>
                    </a>
                    
                    <button onclick="copyToClipboard()"
                            class="relative flex items-center justify-center w-12 h-12 rounded-full transition-all duration-300 hover:scale-110 hover:shadow-lg bg-gray-100 text-gray-600 hover:bg-primary hover:text-white"
                            aria-label="Copy link">
                        <i class="fas fa-link text-xl"></i>
                    </button>
                </div>
                
                <!-- Copy Link Success Message -->
                <div id="copy-success" class="hidden mt-3 p-3 bg-green-50 text-green-700 rounded-lg text-sm">
                    <i class="fas fa-check-circle mr-2"></i>
                    <span>Link berhasil disalin ke clipboard!</span>
                </div>
            </div>
            
            <!-- Navigation -->
            <div class="p-6 md:p-8 border-t border-gray-100 bg-white">
                <div class="flex flex-col sm:flex-row justify-between gap-4">
                    @if($previousNews = \App\Models\News::where('is_published', true)
                        ->where('published_at', '<', $news->published_at)
                        ->orderBy('published_at', 'desc')
                        ->first())
                    <a href="{{ route('news.show', $previousNews->slug) }}" 
                       class="group flex items-center gap-3 px-5 py-3 rounded-xl border border-gray-200 hover:border-primary hover:bg-primary/5 transition-all duration-300 justify-start">
                        <i class="fas fa-chevron-left w-5 h-5 transition-transform duration-300 group-hover:-translate-x-1"></i>
                        <div class="flex flex-col">
                            <span class="text-sm text-gray-500 mb-1">
                                <i class="fas fa-arrow-left mr-1"></i>Berita Sebelumnya
                            </span>
                            <span class="font-medium text-dark line-clamp-1">{{ $previousNews->title }}</span>
                        </div>
                    </a>
                    @else
                    <div></div>
                    @endif
                    
                    @if($nextNews = \App\Models\News::where('is_published', true)
                        ->where('published_at', '>', $news->published_at)
                        ->orderBy('published_at', 'asc')
                        ->first())
                    <a href="{{ route('news.show', $nextNews->slug) }}" 
                       class="group flex items-center gap-3 px-5 py-3 rounded-xl border border-gray-200 hover:border-primary hover:bg-primary/5 transition-all duration-300 justify-end sm:justify-start">
                        <div class="flex flex-col">
                            <span class="text-sm text-gray-500 mb-1">
                                Berita Selanjutnya <i class="fas fa-arrow-right ml-1"></i>
                            </span>
                            <span class="font-medium text-dark line-clamp-1 text-right sm:text-left">{{ $nextNews->title }}</span>
                        </div>
                        <i class="fas fa-chevron-right w-5 h-5 transition-transform duration-300 group-hover:translate-x-1"></i>
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
        <div class="mt-8">
            <h2 class="text-2xl font-bold text-primary mb-8 pb-3 border-b border-gray-200 flex items-center">
                <i class="fas fa-newspaper mr-3"></i>
                <span>Berita Terkait Lainnya</span>
            </h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($relatedNews as $related)
                <a href="{{ route('news.show', $related->slug) }}" 
                   class="group relative bg-white rounded-xl shadow-md border border-gray-200 overflow-hidden hover:shadow-xl hover:border-primary/30 transition-all duration-300">
                    <div class="relative h-48 overflow-hidden">
                        <img src="{{ $related->thumbnail ? asset('storage/' . $related->thumbnail) : 'https://via.placeholder.com/400x300/cccccc/ffffff?text=Berita+Desa' }}" 
                             alt="{{ $related->title }}"
                             class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/40 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    </div>
                    <div class="p-5">
                        <div class="text-xs text-gray-500 mb-2 flex items-center">
                            <i class="fas fa-calendar-alt mr-2"></i>
                            {{ $related->published_date }}
                        </div>
                        <h3 class="font-bold text-dark mb-2 line-clamp-2 group-hover:text-primary transition-colors">
                            {{ $related->title }}
                        </h3>
                        <p class="text-sm text-gray-600 line-clamp-2">
                            {{ $related->short_excerpt }}
                        </p>
                        <div class="inline-flex items-center text-primary font-medium mt-3 group-hover:text-secondary transition-colors">
                            Baca Selengkapnya
                            <i class="fas fa-arrow-right ml-2 transition-transform group-hover:translate-x-1"></i>
                        </div>
                    </div>
                </a>
                @endforeach
            </div>
            
            <!-- View All Button -->
            <div class="text-center mt-8">
                <a href="{{ route('news.index') }}" 
                   class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-primary to-secondary text-white rounded-xl hover:from-primary/90 hover:to-secondary/90 transition-all duration-300 shadow-md hover:shadow-lg">
                    <i class="fas fa-list mr-2"></i>
                    Lihat Semua Berita
                </a>
            </div>
        </div>
        @endif
        
        <!-- Back to List -->
        <div class="mt-8 text-center">
            <a href="{{ route('news.index') }}" 
               class="inline-flex items-center px-5 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors duration-200 font-medium">
                <i class="fas fa-arrow-left mr-2"></i>
                Kembali ke Daftar Berita
            </a>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    function copyToClipboard() {
        const url = window.location.href;
        navigator.clipboard.writeText(url).then(() => {
            const successMessage = document.getElementById('copy-success');
            successMessage.classList.remove('hidden');
            
            setTimeout(() => {
                successMessage.classList.add('hidden');
            }, 3000);
        }).catch(err => {
            console.error('Failed to copy: ', err);
            alert('Gagal menyalin link');
        });
    }
    
    // Add smooth scrolling for anchor links within article content
    document.addEventListener('DOMContentLoaded', function() {
        const articleLinks = document.querySelectorAll('.prose a[href^="#"]');
        articleLinks.forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                const targetId = this.getAttribute('href');
                if (targetId === '#') return;
                
                const targetElement = document.querySelector(targetId);
                if (targetElement) {
                    window.scrollTo({
                        top: targetElement.offsetTop - 100,
                        behavior: 'smooth'
                    });
                }
            });
        });
        
        // Update view count
        fetch(`/api/news/{{ $news->id }}/view`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        }).catch(err => console.error('View count update failed:', err));
    });
</script>
@endpush