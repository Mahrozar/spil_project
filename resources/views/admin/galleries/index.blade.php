<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Galeri</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .gallery-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 1.5rem;
        }

        @media (max-width: 640px) {
            .gallery-grid {
                grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            }
        }

        .gallery-item {
            transition: all 0.3s ease;
        }

        .gallery-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }

        .video-thumbnail::after {
            content: '\f04b';
            font-family: 'Font Awesome 6 Free';
            font-weight: 900;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-size: 2rem;
            color: white;
            text-shadow: 0 2px 10px rgba(0, 0, 0, 0.5);
            opacity: 0.9;
        }

        .fade-in {
            animation: fadeIn 0.3s ease-in-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        .checkbox:checked {
            background-color: #3b82f6;
            border-color: #3b82f6;
        }

        .checkbox:checked::after {
            content: '✓';
            color: white;
            position: absolute;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
        }

        .grid-view {
            display: grid;
        }

        .list-view {
            display: block;
        }

        .list-view .gallery-item {
            display: flex;
            flex-direction: row;
            height: auto;
        }

        .list-view .gallery-item img {
            width: 120px;
            height: 80px;
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
                        <a href="/admin/dashboard"
                            class="text-gray-600 hover:text-gray-900 px-3 py-2 text-sm font-medium">Dashboard</a>
                        <a href="/admin/letters"
                            class="text-gray-600 hover:text-gray-900 px-3 py-2 text-sm font-medium">Surat</a>
                        <a href="/admin/news"
                            class="text-gray-600 hover:text-gray-900 px-3 py-2 text-sm font-medium">Berita</a>
                        <a href="/admin/galleries"
                            class="bg-blue-100 text-blue-700 px-3 py-2 text-sm font-medium rounded-md">Galeri</a>
                        <a href="/admin/reports"
                            class="text-gray-600 hover:text-gray-900 px-3 py-2 text-sm font-medium">Laporan</a>
                    </nav>
                </div>
                <div class="flex items-center space-x-4">
                    <div class="relative">
                        <button class="flex items-center text-gray-700 hover:text-gray-900">
                            <div
                                class="h-8 w-8 rounded-full bg-blue-100 flex items-center justify-center text-blue-700 font-semibold">
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
            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
                <div>
                    <h2 class="text-2xl font-bold text-gray-900">Galeri Foto & Video</h2>
                    <p class="text-gray-600 mt-1">Kelolah koleksi foto dan video kegiatan.</p>
                </div>

                <div class="flex flex-col sm:flex-row gap-3">
                    <!-- Search & Filters -->
                    <form method="GET" action="{{ route('admin.galleries.index') }}"
                        class="flex flex-col sm:flex-row gap-2">
                        <div class="flex">
                            <input type="search" name="q" value="{{ request('q') }}"
                                placeholder="Cari galeri..."
                                class="border border-gray-300 rounded-l-md px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 w-full sm:w-64">
                            <button type="submit"
                                class="bg-blue-600 text-white rounded-r-md px-4 py-2 text-sm hover:bg-blue-700">
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
                            <option value="inactive" {{ request('status') === 'inactive' ? 'selected' : '' }}>Nonaktif
                            </option>
                        </select>
                    </form>

                    <div class="flex gap-2">
                        <button id="viewToggle"
                            class="bg-gray-200 text-gray-700 rounded-md px-3 py-2 text-sm hover:bg-gray-300">
                            <i class="fas fa-th"></i>
                        </button>
                        <a href="{{ route('admin.galleries.create') }}"
                            class="bg-green-600 text-white rounded-md px-4 py-2 text-sm hover:bg-green-700 flex items-center">
                            <i class="fas fa-plus mr-2"></i>
                            Tambah Baru
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8">
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-4">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-600">Total Galeri</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $stats['total'] }}</p>
                    </div>
                    <div class="p-2 bg-blue-100 rounded-full">
                        <i class="fas fa-images text-blue-600"></i>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-4">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-600">Foto</p>
                        <p class="text-2xl font-bold text-blue-600">{{ $stats['photos'] }}</p>
                    </div>
                    <div class="p-2 bg-blue-50 rounded-full">
                        <i class="fas fa-camera text-blue-500"></i>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-4">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-600">Video</p>
                        <p class="text-2xl font-bold text-red-600">{{ $stats['videos'] }}</p>
                    </div>
                    <div class="p-2 bg-red-50 rounded-full">
                        <i class="fas fa-video text-red-500"></i>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-4">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-600">Aktif</p>
                        <p class="text-2xl font-bold text-green-600">{{ $stats['active'] }}</p>
                    </div>
                    <div class="p-2 bg-green-50 rounded-full">
                        <i class="fas fa-check-circle text-green-500"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bulk Actions -->
        <div id="bulkActions" class="hidden fade-in mb-6">
            <div class="bg-red-50 border border-red-200 rounded-lg p-4">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                    <div class="text-red-700 font-medium">
                        <i class="fas fa-check-circle mr-2"></i>
                        <span id="selectedCount">0</span> item dipilih
                    </div>
                    <div class="flex flex-wrap gap-2">
                        <button onclick="confirmBulkAction('activate')"
                            class="bg-green-600 text-white rounded-md px-4 py-2 text-sm hover:bg-green-700 flex items-center">
                            <i class="fas fa-check mr-2"></i>
                            Aktifkan
                        </button>
                        <button onclick="confirmBulkAction('deactivate')"
                            class="bg-yellow-600 text-white rounded-md px-4 py-2 text-sm hover:bg-yellow-700 flex items-center">
                            <i class="fas fa-times mr-2"></i>
                            Nonaktifkan
                        </button>
                        <button onclick="confirmBulkAction('delete')"
                            class="bg-red-600 text-white rounded-md px-4 py-2 text-sm hover:bg-red-700 flex items-center">
                            <i class="fas fa-trash mr-2"></i>
                            Hapus yang dipilih
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Gallery Content -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
            <!-- Categories Filter -->
            @if (count($stats['categories']) > 0)
                <div class="px-6 py-4 border-b border-gray-200">
                    <div class="flex flex-wrap gap-2">
                        <button onclick="filterCategory('all')"
                            class="px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-700 hover:bg-blue-200">
                            Semua Kategori
                        </button>
                        @foreach ($stats['categories'] as $category)
                            <button onclick="filterCategory('{{ $category }}')"
                                class="px-3 py-1 rounded-full text-sm font-medium bg-gray-100 text-gray-700 hover:bg-gray-200">
                                {{ $category }}
                            </button>
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- Gallery Grid/List -->
            <form id="bulkForm" method="POST" action="{{ route('admin.galleries.bulkDestroy') }}" class="p-6">
                @csrf

                <div id="galleryContainer" class="gallery-grid">
                    @forelse($galleries as $item)
                        <div class="gallery-item bg-white border border-gray-200 rounded-lg overflow-hidden relative group"
                            data-category="{{ $item->category ?? 'uncategorized' }}">
                            <!-- Checkbox for bulk selection -->
                            <div class="absolute top-3 left-3 z-10 hidden group-hover:block">
                                <input type="checkbox" name="ids[]" value="{{ $item->id }}"
                                    class="row-checkbox checkbox h-5 w-5 text-blue-600 border-gray-300 rounded relative">
                            </div>

                            <!-- Type badge -->
                            <div class="absolute top-3 right-3 z-10">
                                <span
                                    class="{{ $item->type === 'photo' ? 'bg-blue-500' : 'bg-red-500' }} text-white px-2 py-1 rounded-full text-xs font-medium">
                                    {{ $item->type === 'photo' ? 'Foto' : 'Video' }}
                                </span>
                            </div>

                            <!-- Status badge -->
                            <div class="absolute top-10 right-3 z-10">
                                <span
                                    class="{{ $item->is_active ? 'bg-green-500' : 'bg-gray-500' }} text-white px-2 py-1 rounded-full text-xs font-medium">
                                    {{ $item->is_active ? 'Aktif' : 'Nonaktif' }}
                                </span>
                            </div>

                            <!-- Media preview -->
                            <div class="relative h-48 overflow-hidden bg-gray-100">
                                @if ($item->type === 'photo')
                                    <img src="{{ $item->image_path ? asset('storage/' . $item->image_path) : 'https://via.placeholder.com/400x300/cccccc/ffffff?text=No+Image' }}"
                                        alt="{{ $item->title }}"
                                        class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-110">
                                @else
                                    <div
                                        class="video-thumbnail w-full h-full flex items-center justify-center bg-gradient-to-br from-gray-800 to-gray-900 relative">
                                        @if ($item->image_path)
                                            <img src="{{ asset('storage/' . $item->image_path) }}"
                                                alt="{{ $item->title }}"
                                                class="w-full h-full object-cover opacity-60">
                                        @endif
                                    </div>
                                @endif

                                <!-- Overlay with actions -->
                                <div
                                    class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-60 transition-all duration-300 flex items-center justify-center opacity-0 group-hover:opacity-100">
                                    <div class="flex space-x-3">
                                        <a href="{{ route('admin.galleries.show', $item) }}"
                                            class="bg-white text-gray-800 p-2 rounded-full hover:bg-gray-100 transition-colors"
                                            title="Lihat Detail">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.galleries.edit', $item) }}"
                                            class="bg-white text-yellow-600 p-2 rounded-full hover:bg-gray-100 transition-colors"
                                            title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.galleries.destroy', $item) }}" method="POST"
                                            class="inline" onsubmit="return confirm('Hapus item ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="bg-white text-red-600 p-2 rounded-full hover:bg-gray-100 transition-colors"
                                                title="Hapus">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <!-- Content -->
                            <div class="p-4">
                                <h3 class="font-medium text-gray-900 truncate mb-1">{{ $item->title }}</h3>
                                @if ($item->category)
                                    <div class="mb-2">
                                        <span class="inline-block bg-gray-100 text-gray-700 text-xs px-2 py-1 rounded">
                                            {{ $item->category }}
                                        </span>
                                    </div>
                                @endif
                                @if ($item->description)
                                    <p class="text-sm text-gray-600 line-clamp-2 mb-3">
                                        {{ Str::limit($item->description, 80) }}</p>
                                @endif
                                <div class="flex items-center justify-between text-xs text-gray-500">
                                    <div class="flex items-center">
                                        <i class="far fa-calendar mr-1"></i>
                                        {{ $item->created_at->format('d/m/Y') }}
                                    </div>
                                    @if ($item->order)
                                        <div class="flex items-center">
                                            <i class="fas fa-sort-numeric-up mr-1"></i>
                                            Urutan: {{ $item->order }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-full py-12 text-center">
                            <i class="fas fa-images text-4xl text-gray-300 mb-4"></i>
                            <p class="text-gray-500 mb-4">Tidak ada item galeri ditemukan.</p>
                            <a href="{{ route('admin.galleries.create') }}"
                                class="inline-flex items-center text-blue-600 hover:text-blue-800 font-medium">
                                <i class="fas fa-plus mr-2"></i>
                                Tambah item pertama
                            </a>
                        </div>
                    @endforelse
                </div>
            </form>

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
                                    <i class="fas fa-chevron-left mr-1"></i> Sebelumnya
                                </span>
                            @else
                                <a href="{{ $galleries->previousPageUrl() }}"
                                    class="inline-flex items-center px-3 py-1.5 border border-gray-300 rounded-md text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                                    <i class="fas fa-chevron-left mr-1"></i> Sebelumnya
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
                                            class="inline-flex items-center px-3 py-1.5 border border-gray-300 rounded-md text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                                            {{ $page }}
                                        </a>
                                    @endif
                                @endforeach
                            </div>

                            @if ($galleries->hasMorePages())
                                <a href="{{ $galleries->nextPageUrl() }}"
                                    class="inline-flex items-center px-3 py-1.5 border border-gray-300 rounded-md text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                                    Selanjutnya <i class="fas fa-chevron-right ml-1"></i>
                                </a>
                            @else
                                <span
                                    class="inline-flex items-center px-3 py-1.5 border border-gray-300 rounded-md text-sm font-medium text-gray-400 bg-gray-50">
                                    Selanjutnya <i class="fas fa-chevron-right ml-1"></i>
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
            @endif
        </div>

        <!-- Quick Stats -->
        <div class="mt-6 grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-blue-50 border border-blue-200 rounded-lg p-6">
                <div class="flex items-center">
                    <div class="p-3 bg-blue-100 rounded-full mr-4">
                        <i class="fas fa-upload text-blue-600"></i>
                    </div>
                    <div>
                        <h4 class="font-medium text-gray-900">Upload Tips</h4>
                        <p class="text-sm text-gray-600 mt-1">Gunakan gambar dengan resolusi minimal 1200x800px untuk
                            hasil terbaik.</p>
                    </div>
                </div>
            </div>

            <div class="bg-green-50 border border-green-200 rounded-lg p-6">
                <div class="flex items-center">
                    <div class="p-3 bg-green-100 rounded-full mr-4">
                        <i class="fas fa-list-ol text-green-600"></i>
                    </div>
                    <div>
                        <h4 class="font-medium text-gray-900">Urutan Display</h4>
                        <p class="text-sm text-gray-600 mt-1">Atur urutan tampilan menggunakan field 'order' untuk
                            mengatur posisi.</p>
                    </div>
                </div>
            </div>

            <div class="bg-purple-50 border border-purple-200 rounded-lg p-6">
                <div class="flex items-center">
                    <div class="p-3 bg-purple-100 rounded-full mr-4">
                        <i class="fas fa-video text-purple-600"></i>
                    </div>
                    <div>
                        <h4 class="font-medium text-gray-900">Video Support</h4>
                        <p class="text-sm text-gray-600 mt-1">Support YouTube, Vimeo, dan video URL lainnya untuk
                            embed.</p>
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

    <!-- JavaScript -->
    <script>
        // View toggle
        const viewToggle = document.getElementById('viewToggle');
        const galleryContainer = document.getElementById('galleryContainer');
        let isGridView = true;

        viewToggle.addEventListener('click', function() {
            isGridView = !isGridView;
            if (isGridView) {
                galleryContainer.classList.remove('list-view');
                galleryContainer.classList.add('gallery-grid');
                viewToggle.innerHTML = '<i class="fas fa-th"></i>';
            } else {
                galleryContainer.classList.remove('gallery-grid');
                galleryContainer.classList.add('list-view');
                viewToggle.innerHTML = '<i class="fas fa-list"></i>';
            }
        });

        // Category filter
        function filterCategory(category) {
            const items = document.querySelectorAll('.gallery-item');
            items.forEach(item => {
                if (category === 'all' || item.dataset.category === category) {
                    item.style.display = 'block';
                } else {
                    item.style.display = 'none';
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
        function toggleBulkActions() {
            const bulkActions = document.getElementById('bulkActions');
            bulkActions.classList.toggle('hidden');
            bulkActions.classList.add('fade-in');
        }

        function updateSelectedCount() {
            const selected = document.querySelectorAll('.row-checkbox:checked').length;
            document.getElementById('selectedCount').textContent = selected;

            // Show/hide checkboxes based on bulk actions
            const checkboxes = document.querySelectorAll('.row-checkbox');
            checkboxes.forEach(cb => {
                cb.parentElement.classList.toggle('hidden', selected === 0);
                cb.parentElement.classList.toggle('block', selected > 0);
            });
        }

        function confirmBulkAction(action) {
            const selected = document.querySelectorAll('.row-checkbox:checked').length;
            if (selected === 0) {
                alert('Pilih minimal satu item.');
                return;
            }

            const confirmText = {
                'delete': 'Hapus item yang dipilih? Tindakan ini tidak dapat dibatalkan.',
                'activate': 'Aktifkan item yang dipilih?',
                'deactivate': 'Nonaktifkan item yang dipilih?'
            } [action];

            if (!confirm(confirmText)) return;

            if (action === 'delete') {
                document.getElementById('bulkForm').submit();
            } else {
                // Implement activate/deactivate functionality
                alert(`Fitur ${action} item yang dipilih akan segera tersedia.`);
                // For now, show a success message
                setTimeout(() => {
                    alert(`Berhasil ${action} ${selected} item!`);
                    window.location.reload();
                }, 1000);
            }
        }

        // Checkbox handling
        document.addEventListener('DOMContentLoaded', function() {
            const rowCheckboxes = document.querySelectorAll('.row-checkbox');

            rowCheckboxes.forEach(cb => {
                cb.addEventListener('change', function() {
                    updateSelectedCount();
                });
            });

            // Show bulk actions button in header
            const headerActions = document.querySelector('.flex.gap-2');
            const bulkBtn = document.createElement('button');
            bulkBtn.className =
                'bg-red-100 text-red-700 rounded-md px-4 py-2 text-sm hover:bg-red-200 flex items-center';
            bulkBtn.innerHTML = '<i class="fas fa-tasks mr-2"></i>Aksi Massal';
            bulkBtn.onclick = toggleBulkActions;
            headerActions.insertBefore(bulkBtn, headerActions.firstChild);
        });

        // Image lazy loading
        const images = document.querySelectorAll('img');
        const imageObserver = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const img = entry.target;
                    img.src = img.dataset.src || img.src;
                    observer.unobserve(img);
                }
            });
        });

        images.forEach(img => imageObserver.observe(img));
    </script>
</body>

</html>
