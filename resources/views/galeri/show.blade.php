@extends('layouts.home-app')

@section('title', ($gallery->title ?: 'Detail Galeri') . ' - Galeri Desa')

@push('styles')
<style>
    .gallery-image {
        max-height: 70vh;
        object-fit: contain;
    }
    
    .back-link:hover {
        transform: translateX(-3px);
        transition: transform 0.2s ease;
    }
    
    .related-card {
        transition: all 0.3s ease;
    }
    
    .related-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }
    
    .share-btn {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.2s ease;
    }
    
    .share-btn:hover {
        transform: scale(1.1);
    }
    
    .zoom-btn {
        position: absolute;
        top: 1rem;
        right: 1rem;
        background: rgba(255, 255, 255, 0.9);
        border-radius: 50%;
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.2s ease;
    }
    
    .zoom-btn:hover {
        background: white;
        transform: scale(1.1);
    }
</style>
@endpush

@section('content')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="container mx-auto px-4">
        <!-- Back Button -->
        <div class="mb-6">
            <a href="{{ route('gallery.index') }}" 
               class="inline-flex items-center text-primary font-medium back-link">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Kembali ke Galeri
            </a>
        </div>

        <!-- Gallery Detail -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden mb-12">
            <!-- Image -->
            <div class="relative bg-gray-900 p-4">
                <div class="relative max-w-4xl mx-auto">
                    <img src="{{ asset('storage/' . $gallery->image_path) }}" 
                         alt="{{ $gallery->title ?: 'Galeri Desa' }}"
                         class="gallery-image w-full rounded-lg">
                    
                    <!-- Zoom Button -->
                    <button onclick="openFullscreen()" class="zoom-btn">
                        <i class="fas fa-expand text-gray-700"></i>
                    </button>
                </div>
            </div>

            <!-- Content -->
            <div class="p-8">
                <!-- Header Info -->
                <div class="flex flex-col md:flex-row md:items-center justify-between mb-6 pb-6 border-b">
                    <div>
                        @if($gallery->title)
                            <h1 class="text-2xl md:text-3xl font-bold text-gray-900 mb-2">
                                {{ $gallery->title }}
                            </h1>
                        @endif
                        
                        <div class="flex items-center space-x-4 text-sm text-gray-600">
                            <div class="flex items-center">
                                <i class="far fa-calendar mr-1"></i>
                                {{ $gallery->created_at->format('d F Y') }}
                            </div>
                            @if($gallery->category)
                                <span class="px-3 py-1 bg-primary text-white rounded-full text-xs">
                                    {{ ucfirst($gallery->category) }}
                                </span>
                            @endif
                        </div>
                    </div>
                    
                    <!-- Share Buttons -->
                    <div class="flex items-center space-x-3 mt-4 md:mt-0">
                        <span class="text-gray-600 text-sm">Bagikan:</span>
                        <button onclick="shareToFacebook()" 
                                class="share-btn bg-blue-600 text-white">
                            <i class="fab fa-facebook-f"></i>
                        </button>
                        <button onclick="shareToTwitter()" 
                                class="share-btn bg-blue-400 text-white">
                            <i class="fab fa-twitter"></i>
                        </button>
                        <button onclick="shareToWhatsApp()" 
                                class="share-btn bg-green-500 text-white">
                            <i class="fab fa-whatsapp"></i>
                        </button>
                        <button onclick="copyLink()" 
                                class="share-btn bg-gray-200 text-gray-700">
                            <i class="fas fa-link"></i>
                        </button>
                    </div>
                </div>

                <!-- Description -->
                @if($gallery->description)
                    <div class="prose max-w-none mb-8">
                        <p class="text-gray-700 leading-relaxed">
                            {{ $gallery->description }}
                        </p>
                    </div>
                @else
                    <p class="text-gray-500 italic mb-8">Tidak ada deskripsi</p>
                @endif

                <!-- Actions -->
                <div class="flex flex-wrap gap-4">
                    <a href="{{ asset('storage/' . $gallery->image_path) }}" 
                       download="{{ Str::slug($gallery->title ?: 'gallery') }}.jpg"
                       class="inline-flex items-center bg-primary text-white font-semibold py-3 px-6 rounded-lg hover:bg-secondary transition duration-300">
                        <i class="fas fa-download mr-2"></i> Unduh Gambar
                    </a>
                    
                    <button onclick="printGallery()"
                            class="inline-flex items-center bg-gray-200 text-gray-700 font-semibold py-3 px-6 rounded-lg hover:bg-gray-300 transition duration-300">
                        <i class="fas fa-print mr-2"></i> Cetak
                    </button>
                </div>
            </div>
        </div>

        <!-- Related Galleries -->
        @if($relatedGalleries->count() > 0)
            <div class="mb-12">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">Galeri Terkait</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    @foreach($relatedGalleries as $related)
                        <a href="{{ route('gallery.show', $related->id) }}" 
                           class="related-card bg-white rounded-lg shadow-md overflow-hidden border border-gray-100">
                            <div class="h-40 overflow-hidden">
                                <img src="{{ asset('storage/' . $related->image_path) }}" 
                                     alt="{{ $related->title ?: 'Galeri' }}"
                                     class="w-full h-full object-cover">
                            </div>
                            <div class="p-4">
                                @if($related->title)
                                    <h3 class="font-semibold text-gray-900 mb-2 line-clamp-2">
                                        {{ $related->title }}
                                    </h3>
                                @endif
                                <div class="flex items-center justify-between text-sm text-gray-600">
                                    <span>{{ $related->created_at->format('d M Y') }}</span>
                                    <span class="text-primary">Lihat →</span>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        @endif

        <!-- Navigation -->
        <div class="flex justify-between border-t border-gray-200 pt-8">
            @php
                $prev = $gallery->previous();
                $next = $gallery->next();
            @endphp
            
            @if($prev)
                <a href="{{ route('gallery.show', $prev->id) }}" 
                   class="flex items-center text-primary hover:text-secondary">
                    <i class="fas fa-arrow-left mr-2"></i> Sebelumnya
                </a>
            @else
                <div></div>
            @endif
            
            @if($next)
                <a href="{{ route('gallery.show', $next->id) }}" 
                   class="flex items-center text-primary hover:text-secondary">
                    Selanjutnya <i class="fas fa-arrow-right ml-2"></i>
                </a>
            @endif
        </div>
    </div>
</div>

<!-- Fullscreen Modal -->
<div id="fullscreenModal" 
     class="fixed inset-0 bg-black bg-opacity-95 z-50 hidden items-center justify-center">
    <button onclick="closeFullscreen()" 
            class="absolute top-4 right-4 text-white text-2xl">
        <i class="fas fa-times"></i>
    </button>
    <div class="max-w-6xl max-h-[90vh] p-4">
        <img src="{{ asset('storage/' . $gallery->image_path) }}" 
             alt="{{ $gallery->title ?: 'Galeri' }}"
             class="w-full h-full object-contain">
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Fullscreen functionality
    function openFullscreen() {
        const modal = document.getElementById('fullscreenModal');
        modal.classList.remove('hidden');
        modal.classList.add('flex');
        document.body.style.overflow = 'hidden';
    }
    
    function closeFullscreen() {
        const modal = document.getElementById('fullscreenModal');
        modal.classList.remove('flex');
        modal.classList.add('hidden');
        document.body.style.overflow = 'auto';
    }
    
    // Close modal on ESC key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeFullscreen();
        }
    });
    
    // Share functions
    const currentUrl = window.location.href;
    const title = "{{ $gallery->title ?: 'Galeri Desa' }}";
    
    function shareToFacebook() {
        window.open(`https://www.facebook.com/sharer/sharer.php?u=${encodeURIComponent(currentUrl)}`, '_blank');
    }
    
    function shareToTwitter() {
        window.open(`https://twitter.com/intent/tweet?url=${encodeURIComponent(currentUrl)}&text=${encodeURIComponent(title)}`, '_blank');
    }
    
    function shareToWhatsApp() {
        window.open(`https://api.whatsapp.com/send?text=${encodeURIComponent(title + ' ' + currentUrl)}`, '_blank');
    }
    
    function copyLink() {
        navigator.clipboard.writeText(currentUrl).then(() => {
            alert('Link berhasil disalin!');
        });
    }
    
    function printGallery() {
        const printContent = `
            <html>
                <head>
                    <title>{{ $gallery->title ?: 'Galeri Desa' }}</title>
                    <style>
                        body { font-family: Arial, sans-serif; margin: 20px; }
                        img { max-width: 100%; height: auto; }
                        .title { font-size: 24px; font-weight: bold; margin-bottom: 10px; }
                        .date { color: #666; margin-bottom: 20px; }
                        .description { margin-top: 20px; line-height: 1.6; }
                    </style>
                </head>
                <body>
                    <div class="title">{{ $gallery->title ?: 'Galeri Desa' }}</div>
                    <div class="date">Diupload: {{ $gallery->created_at->format('d F Y') }}</div>
                    <img src="${window.location.origin}/storage/{{ $gallery->image_path }}" alt="{{ $gallery->title ?: 'Galeri Desa' }}">
                    @if($gallery->description)
                        <div class="description">{{ $gallery->description }}</div>
                    @endif
                </body>
            </html>
        `;
        
        const printWindow = window.open('', '_blank');
        printWindow.document.write(printContent);
        printWindow.document.close();
        printWindow.focus();
        printWindow.print();
        printWindow.close();
    }
</script>
@endpush