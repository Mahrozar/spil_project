@extends('layouts.app')

@section('title', 'Galeri Foto & Video')

@section('content')
<div class="admin-content-area">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Loading Overlay -->
        <div id="loadingOverlay" class="fixed inset-0 bg-white bg-opacity-80 hidden items-center justify-center z-50">
            <div class="flex flex-col items-center">
                <div class="loader border-4 border-gray-200 border-t-blue-600 rounded-full w-12 h-12 animate-spin mb-3"></div>
                <span class="text-gray-700">Memproses...</span>
            </div>
        </div>

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
                    <span class="text-gray-600 font-medium">Galeri</span>
                </li>
            </ol>
        </nav>

        <!-- Header -->
        <div class="mb-8">
            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900 mb-2">Galeri Foto & Video</h1>
                    <p class="text-gray-600">Kelola koleksi foto dan video kegiatan</p>
                </div>

                <div class="flex flex-col sm:flex-row gap-3">
                    <!-- Search & Filters -->
                    <form method="GET" action="{{ route('admin.galleries.index') }}"
                        class="flex flex-col sm:flex-row gap-2">
                        <div class="flex">
                            <input type="search" 
                                   name="q" 
                                   value="{{ request('q') }}"
                                   placeholder="Cari galeri..."
                                   class="border border-gray-300 rounded-l-md px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 w-full sm:w-64">
                            <button type="submit"
                                class="inline-flex items-center bg-blue-600 text-white rounded-r-md px-4 py-2 text-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>

                        <select name="type"
                            class="border border-gray-300 rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                            onchange="this.form.submit()">
                            <option value="">Semua Tipe</option>
                            <option value="photo" {{ request('type') === 'photo' ? 'selected' : '' }}>Foto</option>
                            <option value="video" {{ request('type') === 'video' ? 'selected' : '' }}>Video</option>
                        </select>

                        <select name="status"
                            class="border border-gray-300 rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                            onchange="this.form.submit()">
                            <option value="">Semua Status</option>
                            <option value="active" {{ request('status') === 'active' ? 'selected' : '' }}>Aktif</option>
                            <option value="inactive" {{ request('status') === 'inactive' ? 'selected' : '' }}>Nonaktif</option>
                        </select>
                    </form>

                    <div class="flex gap-2">
                        <button id="bulkToggleBtn"
                            class="inline-flex items-center bg-red-100 text-red-700 rounded-md px-4 py-2 text-sm hover:bg-red-200 focus:outline-none focus:ring-2 focus:ring-red-500 transition-colors">
                            <i class="fas fa-tasks mr-2"></i>Aksi Massal
                        </button>
                        <button id="viewToggle"
                            class="inline-flex items-center bg-gray-200 text-gray-700 rounded-md px-3 py-2 text-sm hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-500 transition-colors">
                            <i class="fas fa-th"></i>
                        </button>
                        <a href="{{ route('admin.galleries.create') }}"
                            class="inline-flex items-center bg-green-600 text-white rounded-md px-4 py-2 text-sm hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 transition-colors">
                            <i class="fas fa-plus mr-2"></i>
                            Tambah Baru
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8">
            <div class="bg-white shadow-sm border border-gray-200 rounded-lg p-4">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-600">Total Galeri</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $stats['total'] }}</p>
                    </div>
                    <div class="p-3 bg-blue-100 rounded-full">
                        <i class="fas fa-images text-blue-600 text-lg"></i>
                    </div>
                </div>
            </div>

            <div class="bg-white shadow-sm border border-gray-200 rounded-lg p-4">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-600">Foto</p>
                        <p class="text-2xl font-bold text-blue-600">{{ $stats['photos'] }}</p>
                    </div>
                    <div class="p-3 bg-blue-50 rounded-full">
                        <i class="fas fa-camera text-blue-500 text-lg"></i>
                    </div>
                </div>
            </div>

            <div class="bg-white shadow-sm border border-gray-200 rounded-lg p-4">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-600">Video</p>
                        <p class="text-2xl font-bold text-red-600">{{ $stats['videos'] }}</p>
                    </div>
                    <div class="p-3 bg-red-50 rounded-full">
                        <i class="fas fa-video text-red-500 text-lg"></i>
                    </div>
                </div>
            </div>

            <div class="bg-white shadow-sm border border-gray-200 rounded-lg p-4">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-600">Aktif</p>
                        <p class="text-2xl font-bold text-green-600">{{ $stats['active'] }}</p>
                    </div>
                    <div class="p-3 bg-green-50 rounded-full">
                        <i class="fas fa-check-circle text-green-500 text-lg"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bulk Actions -->
        <div id="bulkActions" class="hidden animate-fadeIn mb-6">
            <div class="bg-red-50 border border-red-200 rounded-lg p-4">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                    <div class="text-red-700 font-medium flex items-center">
                        <i class="fas fa-check-circle mr-2"></i>
                        <span id="selectedCount">0</span> item dipilih
                    </div>
                    <div class="flex flex-wrap gap-2">
                        <button onclick="executeBulkAction('activate')"
                            class="inline-flex items-center bg-green-600 text-white rounded-md px-4 py-2 text-sm hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 transition-colors">
                            <i class="fas fa-check mr-2"></i>
                            Aktifkan
                        </button>
                        <button onclick="executeBulkAction('deactivate')"
                            class="inline-flex items-center bg-yellow-600 text-white rounded-md px-4 py-2 text-sm hover:bg-yellow-700 focus:outline-none focus:ring-2 focus:ring-yellow-500 transition-colors">
                            <i class="fas fa-times mr-2"></i>
                            Nonaktifkan
                        </button>
                        <button onclick="executeBulkAction('delete')"
                            class="inline-flex items-center bg-red-600 text-white rounded-md px-4 py-2 text-sm hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 transition-colors">
                            <i class="fas fa-trash mr-2"></i>
                            Hapus yang dipilih
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="bg-white shadow-sm border border-gray-200 rounded-lg overflow-hidden">
            <!-- Categories Filter -->
            @if (isset($stats['categories']) && count($stats['categories']) > 0)
                <div class="px-6 py-4 border-b border-gray-200">
                    <div class="flex flex-wrap gap-2">
                        <button onclick="filterCategory('all')"
                            class="px-3 py-1.5 rounded-full text-sm font-medium bg-blue-100 text-blue-700 hover:bg-blue-200 transition-colors focus:outline-none focus:ring-2 focus:ring-blue-500">
                            Semua Kategori
                        </button>
                        @foreach ($stats['categories'] as $category)
                            <button onclick="filterCategory('{{ $category }}')"
                                class="px-3 py-1.5 rounded-full text-sm font-medium bg-gray-100 text-gray-700 hover:bg-gray-200 transition-colors focus:outline-none focus:ring-2 focus:ring-gray-500">
                                {{ $category }}
                            </button>
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- Gallery Grid/List -->
            <div class="p-6">
                <div id="galleryContainer" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                    @forelse($galleries as $item)
                        <div class="gallery-item bg-white border border-gray-200 rounded-lg overflow-hidden relative group transition-all duration-300 hover:shadow-lg hover:-translate-y-1"
                            data-category="{{ $item->category ?? 'uncategorized' }}">
                            <!-- Checkbox for bulk selection -->
                            <div class="absolute top-3 left-3 z-10 hidden group-hover:block">
                                <input type="checkbox" name="ids[]" value="{{ $item->id }}"
                                    class="row-checkbox h-5 w-5 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                            </div>

                            <!-- Type badge -->
                            <div class="absolute top-3 right-3 z-10">
                                <span
                                    class="{{ $item->type === 'photo' ? 'bg-blue-500' : 'bg-red-500' }} text-white px-2.5 py-1 rounded-full text-xs font-medium shadow">
                                    @if($item->type === 'photo')
                                        <i class="fas fa-camera mr-1"></i> Foto
                                    @else
                                        <i class="fas fa-video mr-1"></i> Video
                                    @endif
                                </span>
                            </div>

                            <!-- Status badge -->
                            <div class="absolute top-12 right-3 z-10">
                                <span
                                    class="{{ $item->is_active ? 'bg-green-500' : 'bg-gray-500' }} text-white px-2.5 py-1 rounded-full text-xs font-medium shadow">
                                    @if($item->is_active)
                                        <i class="fas fa-check-circle mr-1"></i> Aktif
                                    @else
                                        <i class="fas fa-times-circle mr-1"></i> Nonaktif
                                    @endif
                                </span>
                            </div>

                            <!-- Media preview -->
                            <div class="relative h-48 overflow-hidden bg-gray-100">
                                @if ($item->type === 'photo')
                                    <img src="{{ $item->image_path ? asset('storage/' . $item->image_path) : 'https://via.placeholder.com/400x300/cccccc/ffffff?text=No+Image' }}"
                                        alt="{{ $item->title }}"
                                        class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                                @else
                                    <div class="video-thumbnail w-full h-full flex items-center justify-center bg-gradient-to-br from-gray-800 to-gray-900 relative">
                                        @if ($item->image_path)
                                            <img src="{{ asset('storage/' . $item->image_path) }}"
                                                alt="{{ $item->title }}"
                                                class="w-full h-full object-cover opacity-60">
                                        @endif
                                        <div class="absolute inset-0 flex items-center justify-center">
                                            <div class="h-14 w-14 rounded-full bg-white bg-opacity-20 flex items-center justify-center">
                                                <i class="fas fa-play text-white text-2xl"></i>
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                <!-- Overlay with actions -->
                                <div
                                    class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-60 transition-all duration-300 flex items-center justify-center opacity-0 group-hover:opacity-100">
                                    <div class="flex space-x-3">
                                        <a href="{{ route('admin.galleries.show', $item) }}"
                                            class="bg-white text-gray-800 p-3 rounded-full hover:bg-gray-100 transition-colors shadow"
                                            title="Lihat Detail">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.galleries.edit', $item) }}"
                                            class="bg-white text-yellow-600 p-3 rounded-full hover:bg-gray-100 transition-colors shadow"
                                            title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <button onclick="deleteItem({{ $item->id }}, '{{ addslashes($item->title) }}')"
                                            class="bg-white text-red-600 p-3 rounded-full hover:bg-gray-100 transition-colors shadow"
                                            title="Hapus">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <!-- Content -->
                            <div class="p-4">
                                <h3 class="font-medium text-gray-900 truncate mb-1">{{ $item->title }}</h3>
                                @if ($item->category)
                                    <div class="mb-2">
                                        <span class="inline-flex items-center bg-gray-100 text-gray-700 text-xs px-2.5 py-1 rounded-full">
                                            <i class="fas fa-tag mr-1 text-xs"></i>
                                            {{ $item->category }}
                                        </span>
                                    </div>
                                @endif
                                @if ($item->description)
                                    <p class="text-sm text-gray-600 line-clamp-2 mb-3">
                                        {{ Str::limit($item->description, 80) }}
                                    </p>
                                @endif
                                <div class="flex items-center justify-between text-xs text-gray-500">
                                    <div class="flex items-center">
                                        <i class="far fa-calendar mr-1.5"></i>
                                        {{ $item->created_at->format('d/m/Y') }}
                                    </div>
                                    @if ($item->order)
                                        <div class="flex items-center">
                                            <i class="fas fa-sort-numeric-up mr-1.5"></i>
                                            Urutan: {{ $item->order }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-full py-16 text-center">
                            <div class="inline-flex items-center justify-center h-20 w-20 rounded-full bg-gray-100 mb-4">
                                <i class="fas fa-images text-3xl text-gray-400"></i>
                            </div>
                            <p class="text-gray-500 mb-4 text-lg">Tidak ada item galeri ditemukan.</p>
                            <a href="{{ route('admin.galleries.create') }}"
                                class="inline-flex items-center text-blue-600 hover:text-blue-800 font-medium">
                                <i class="fas fa-plus mr-2"></i>
                                Tambah item pertama
                            </a>
                        </div>
                    @endforelse
                </div>
            </div>

            <!-- Pagination -->
            @if ($galleries->hasPages())
                <div class="px-6 py-4 border-t border-gray-200">
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                        <div class="text-sm text-gray-700 mb-4 sm:mb-0">
                            Menampilkan
                            <span class="font-medium">{{ $galleries->firstItem() ?? 0 }}</span>
                            sampai
                            <span class="font-medium">{{ $galleries->lastItem() ?? 0 }}</span>
                            dari
                            <span class="font-medium">{{ $galleries->total() ?? 0 }}</span>
                            item
                        </div>

                        <div class="flex items-center space-x-2">
                            @if ($galleries->onFirstPage())
                                <span
                                    class="inline-flex items-center px-3 py-1.5 border border-gray-300 rounded-md text-sm font-medium text-gray-400 bg-gray-50">
                                    <i class="fas fa-chevron-left mr-1.5"></i> Sebelumnya
                                </span>
                            @else
                                <a href="{{ $galleries->previousPageUrl() }}"
                                    class="inline-flex items-center px-3 py-1.5 border border-gray-300 rounded-md text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 transition-colors">
                                    <i class="fas fa-chevron-left mr-1.5"></i> Sebelumnya
                                </a>
                            @endif

                            <div class="flex space-x-1">
                                @foreach ($galleries->getUrlRange(1, $galleries->lastPage()) as $page => $url)
                                    @if ($page == $galleries->currentPage())
                                        <span
                                            class="inline-flex items-center px-3 py-1.5 border border-blue-500 rounded-md text-sm font-medium text-white bg-blue-600">
                                            {{ $page }}
                                        </span>
                                    @else
                                        <a href="{{ $url }}"
                                            class="inline-flex items-center px-3 py-1.5 border border-gray-300 rounded-md text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 transition-colors">
                                            {{ $page }}
                                        </a>
                                    @endif
                                @endforeach
                            </div>

                            @if ($galleries->hasMorePages())
                                <a href="{{ $galleries->nextPageUrl() }}"
                                    class="inline-flex items-center px-3 py-1.5 border border-gray-300 rounded-md text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 transition-colors">
                                    Selanjutnya <i class="fas fa-chevron-right ml-1.5"></i>
                                </a>
                            @else
                                <span
                                    class="inline-flex items-center px-3 py-1.5 border border-gray-300 rounded-md text-sm font-medium text-gray-400 bg-gray-50">
                                    Selanjutnya <i class="fas fa-chevron-right ml-1.5"></i>
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
            @endif
        </div>

        <!-- Quick Tips -->
        <div class="mt-6 grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-blue-50 border border-blue-200 rounded-lg p-6">
                <div class="flex items-center">
                    <div class="p-3 bg-blue-100 rounded-full mr-4">
                        <i class="fas fa-upload text-blue-600 text-lg"></i>
                    </div>
                    <div>
                        <h4 class="font-medium text-gray-900">Upload Tips</h4>
                        <p class="text-sm text-gray-600 mt-1">Gunakan gambar dengan resolusi minimal 1200×800px untuk hasil terbaik.</p>
                    </div>
                </div>
            </div>

            <div class="bg-green-50 border border-green-200 rounded-lg p-6">
                <div class="flex items-center">
                    <div class="p-3 bg-green-100 rounded-full mr-4">
                        <i class="fas fa-list-ol text-green-600 text-lg"></i>
                    </div>
                    <div>
                        <h4 class="font-medium text-gray-900">Urutan Display</h4>
                        <p class="text-sm text-gray-600 mt-1">Atur urutan tampilan untuk mengatur posisi galeri.</p>
                    </div>
                </div>
            </div>

            <div class="bg-purple-50 border border-purple-200 rounded-lg p-6">
                <div class="flex items-center">
                    <div class="p-3 bg-purple-100 rounded-full mr-4">
                        <i class="fas fa-video text-purple-600 text-lg"></i>
                    </div>
                    <div>
                        <h4 class="font-medium text-gray-900">Video Support</h4>
                        <p class="text-sm text-gray-600 mt-1">Support YouTube, Vimeo, dan video URL lainnya.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .animate-fadeIn {
        animation: fadeIn 0.3s ease-in-out;
    }

    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }

    .line-clamp-2 {
        overflow: hidden;
        display: -webkit-box;
        -webkit-box-orient: vertical;
        -webkit-line-clamp: 2;
    }

    .loader {
        border: 4px solid #f3f3f3;
        border-top: 4px solid #3b82f6;
        border-radius: 50%;
        width: 50px;
        height: 50px;
        animation: spin 1s linear infinite;
    }

    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }

    .list-view .gallery-item {
        display: flex;
        flex-direction: row;
        height: auto;
        min-height: 120px;
    }

    .list-view .gallery-item > div:first-child {
        flex: 0 0 160px;
        height: auto;
    }

    .list-view .gallery-item > div:last-child {
        flex: 1;
    }
</style>
@endpush

@push('scripts')
<script>
    // Loading overlay control
    function showLoading() {
        document.getElementById('loadingOverlay').classList.remove('hidden');
    }

    function hideLoading() {
        document.getElementById('loadingOverlay').classList.add('hidden');
    }

    // View toggle
    const viewToggle = document.getElementById('viewToggle');
    const galleryContainer = document.getElementById('galleryContainer');
    let isGridView = true;

    viewToggle.addEventListener('click', function() {
        isGridView = !isGridView;
        if (isGridView) {
            galleryContainer.classList.remove('list-view');
            galleryContainer.classList.add('grid', 'grid-cols-1', 'sm:grid-cols-2', 'lg:grid-cols-3', 'xl:grid-cols-4', 'gap-6');
            viewToggle.innerHTML = '<i class="fas fa-th"></i>';
        } else {
            galleryContainer.classList.remove('grid', 'grid-cols-1', 'sm:grid-cols-2', 'lg:grid-cols-3', 'xl:grid-cols-4', 'gap-6');
            galleryContainer.classList.add('list-view', 'space-y-4');
            viewToggle.innerHTML = '<i class="fas fa-list"></i>';
        }
    });

    // Category filter
    function filterCategory(category) {
        const items = document.querySelectorAll('.gallery-item');
        items.forEach(item => {
            if (category === 'all' || item.dataset.category === category) {
                item.classList.remove('hidden');
            } else {
                item.classList.add('hidden');
            }
        });

        // Update active filter button
        document.querySelectorAll('[onclick^="filterCategory"]').forEach(btn => {
            btn.classList.remove('bg-blue-100', 'text-blue-700');
            btn.classList.add('bg-gray-100', 'text-gray-700');
        });

        // Highlight active filter
        const activeBtn = document.querySelector(`[onclick="filterCategory('${category}')"]`);
        if (activeBtn) {
            activeBtn.classList.remove('bg-gray-100', 'text-gray-700');
            activeBtn.classList.add('bg-blue-100', 'text-blue-700');
        }
    }

    // Bulk Actions
    const bulkActions = document.getElementById('bulkActions');
    const bulkToggleBtn = document.getElementById('bulkToggleBtn');

    function toggleBulkActions() {
        const isHidden = bulkActions.classList.contains('hidden');
        bulkActions.classList.toggle('hidden');
        
        if (isHidden) {
            bulkActions.classList.add('animate-fadeIn');
            // Show all checkboxes
            document.querySelectorAll('.row-checkbox').forEach(cb => {
                cb.closest('.absolute').classList.remove('hidden');
                cb.closest('.absolute').classList.add('block');
            });
        } else {
            // Hide all checkboxes
            document.querySelectorAll('.row-checkbox').forEach(cb => {
                cb.closest('.absolute').classList.remove('block');
                cb.closest('.absolute').classList.add('hidden');
            });
        }
    }

    function updateSelectedCount() {
        const selected = document.querySelectorAll('.row-checkbox:checked').length;
        document.getElementById('selectedCount').textContent = selected;
    }

    async function executeBulkAction(action) {
        const selectedIds = Array.from(document.querySelectorAll('.row-checkbox:checked'))
            .map(checkbox => checkbox.value);

        if (selectedIds.length === 0) {
            alert('Pilih minimal satu item.');
            return;
        }

        const confirmText = {
            'delete': `Hapus ${selectedIds.length} item? Tindakan ini tidak dapat dibatalkan.`,
            'activate': `Aktifkan ${selectedIds.length} item?`,
            'deactivate': `Nonaktifkan ${selectedIds.length} item?`
        }[action];

        if (!confirm(confirmText)) return;

        showLoading();

        try {
            const response = await fetch('{{ route("admin.galleries.bulkAction") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: JSON.stringify({
                    action: action,
                    ids: selectedIds
                })
            });

            const data = await response.json();

            if (response.ok) {
                alert(data.message || 'Aksi berhasil dilakukan!');
                window.location.reload();
            } else {
                throw new Error(data.message || 'Terjadi kesalahan');
            }
        } catch (error) {
            console.error('Error:', error);
            alert('Terjadi kesalahan saat memproses: ' + error.message);
        } finally {
            hideLoading();
        }
    }

    // Delete single item
    async function deleteItem(id, title) {
        if (!confirm(`Hapus "${title}"? Tindakan ini tidak dapat dibatalkan.`)) {
            return;
        }

        showLoading();

        try {
            const url = '{{ route("admin.galleries.destroy", ":id") }}'.replace(':id', id);
            const response = await fetch(url, {
                method: 'DELETE',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'X-Requested-With': 'XMLHttpRequest'
                }
            });

            const data = await response.json();

            if (response.ok) {
                alert(data.message || 'Item berhasil dihapus!');
                window.location.reload();
            } else {
                throw new Error(data.message || 'Terjadi kesalahan');
            }
        } catch (error) {
            console.error('Error:', error);
            alert('Terjadi kesalahan saat menghapus item: ' + error.message);
        } finally {
            hideLoading();
        }
    }

    // Initialize
    document.addEventListener('DOMContentLoaded', function() {
        // Checkbox handling
        document.addEventListener('change', function(e) {
            if (e.target.classList.contains('row-checkbox')) {
                updateSelectedCount();
            }
        });

        // Toggle bulk actions
        bulkToggleBtn.addEventListener('click', toggleBulkActions);

        // Lazy loading for images
        const images = document.querySelectorAll('img');
        const imageObserver = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const img = entry.target;
                    if (img.dataset.src) {
                        img.src = img.dataset.src;
                    }
                    observer.unobserve(img);
                }
            });
        });

        images.forEach(img => {
            if (img.complete) return;
            imageObserver.observe(img);
        });
    });
</script>
@endpush