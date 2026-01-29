@extends('layouts.app')

@section('title', 'Berita & Pengumuman')
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
                <span class="text-gray-600 font-medium">Berita & Pengumuman</span>
            </li>
        </ol>
    </nav>

@endsection
@section('content')
    <div class="admin-content-area">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <!-- Page Header -->
            <div class="mb-8">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                    <div>
                        <h1 class="text-2xl font-bold text-gray-900">Berita & Pengumuman</h1>
                        <p class="text-gray-600 mt-1">Kelola semua berita dan pengumuman yang diterbitkan.</p>
                    </div>

                    <div class="flex flex-col sm:flex-row gap-3">
                        <form method="GET" action="{{ route('admin.news.index') }}"
                            class="flex flex-col sm:flex-row gap-2">
                            <select name="status"
                                class="border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                                onchange="this.form.submit()">
                                <option value="">Semua Status</option>
                                <option value="published" {{ request('status') === 'published' ? 'selected' : '' }}>
                                    Diterbitkan</option>
                                <option value="draft" {{ request('status') === 'draft' ? 'selected' : '' }}>Draft</option>
                            </select>
                            <div class="flex">
                                <input type="search" name="q" value="{{ request('q') }}"
                                    placeholder="Cari berita..."
                                    class="border border-gray-300 rounded-l-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors w-full sm:w-64">
                                <button type="submit"
                                    class="bg-blue-600 text-white rounded-r-lg px-4 py-2 text-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-colors">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </form>

                        <a href="{{ route('admin.news.create') }}"
                            class="bg-green-600 text-white rounded-lg px-4 py-2.5 text-sm font-medium hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition-colors flex items-center justify-center">
                            <i class="fas fa-plus mr-2"></i>
                            Tambah Berita
                        </a>
                    </div>
                </div>
            </div>

            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <!-- Total Berita Card -->
                <div
                    class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow duration-200">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-600">Total Berita</p>
                            <p class="text-2xl font-bold text-gray-900 mt-1">{{ $stats['total'] ?? 0 }}</p>
                            <p class="text-xs text-gray-500 mt-2">
                                <i class="fas fa-calendar-alt mr-1 text-xs"></i>
                                {{ $stats['monthly'] ?? 0 }} berita baru bulan ini
                            </p>
                        </div>
                        <div class="p-3 bg-blue-50 rounded-full">
                            <i class="fas fa-newspaper text-blue-600 text-xl"></i>
                        </div>
                    </div>
                </div>

                <!-- Diterbitkan Card -->
                <div
                    class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow duration-200">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-600">Diterbitkan</p>
                            <p class="text-2xl font-bold text-green-600 mt-1">{{ $stats['published'] ?? 0 }}</p>
                            <p class="text-xs text-gray-500 mt-2">
                                @if ($stats['total'] > 0)
                                    {{ round(($stats['published'] / $stats['total']) * 100, 1) }}% dari total
                                @else
                                    0% dari total
                                @endif
                            </p>
                        </div>
                        <div class="p-3 bg-green-50 rounded-full">
                            <i class="fas fa-check-circle text-green-600 text-xl"></i>
                        </div>
                    </div>
                </div>

                <!-- Draft Card -->
                <div
                    class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow duration-200">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-600">Draft</p>
                            <p class="text-2xl font-bold text-yellow-600 mt-1">{{ $stats['draft'] ?? 0 }}</p>
                            <p class="text-xs text-gray-500 mt-2">
                                <i class="fas fa-clock mr-1 text-xs"></i>
                                Belum dipublikasikan
                            </p>
                        </div>
                        <div class="p-3 bg-yellow-50 rounded-full">
                            <i class="fas fa-file-alt text-yellow-600 text-xl"></i>
                        </div>
                    </div>
                </div>

                <!-- Total Views Card -->
                <div
                    class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow duration-200">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-600">Total Views</p>
                            <p class="text-2xl font-bold text-purple-600 mt-1">{{ $stats['total_views'] ?? 0 }}</p>
                            <p class="text-xs text-gray-500 mt-2">
                                <i class="fas fa-eye mr-1 text-xs"></i>
                                Total dilihat
                            </p>
                        </div>
                        <div class="p-3 bg-purple-50 rounded-full">
                            <i class="fas fa-eye text-purple-600 text-xl"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Bulk Actions -->
            <div id="bulkActions" class="hidden animate-fade-in mb-6">
                <div class="bg-red-50 border border-red-200 rounded-lg p-4">
                    <div class="flex flex-col sm:flex-row items-center justify-between gap-4">
                        <div class="text-red-700 font-medium flex items-center">
                            <i class="fas fa-check-circle mr-2"></i>
                            <span id="selectedCount">0</span> berita dipilih
                        </div>
                        <div class="flex flex-wrap gap-2">
                            <button onclick="confirmBulkAction('publish')"
                                class="bg-green-600 text-white rounded-lg px-4 py-2 text-sm font-medium hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition-colors flex items-center">
                                <i class="fas fa-check-circle mr-2"></i>
                                Terbitkan
                            </button>
                            <button onclick="confirmBulkAction('unpublish')"
                                class="bg-yellow-600 text-white rounded-lg px-4 py-2 text-sm font-medium hover:bg-yellow-700 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-offset-2 transition-colors flex items-center">
                                <i class="fas fa-times-circle mr-2"></i>
                                Jadikan Draft
                            </button>
                            <button onclick="confirmBulkAction('delete')"
                                class="bg-red-600 text-white rounded-lg px-4 py-2 text-sm font-medium hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition-colors flex items-center">
                                <i class="fas fa-trash mr-2"></i>
                                Hapus yang dipilih
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Table -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
                <form id="bulkForm" method="POST" action="{{ route('admin.news.bulkDestroy') }}">
                    @csrf
                    @method('DELETE')

                    <!-- Table Container -->
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left">
                                        <input type="checkbox" id="select_all"
                                            class="h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                                    </th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Berita
                                    </th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Penulis
                                    </th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Status
                                    </th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Dibuat
                                    </th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        <i class="fas fa-eye"></i>
                                    </th>
                                    <th
                                        class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Aksi
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($news as $item)
                                    <tr class="hover:bg-gray-50 transition-colors duration-150">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <input type="checkbox" name="ids[]" value="{{ $item->id }}"
                                                class="row-checkbox h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="flex items-start space-x-4">
                                                <div class="flex-shrink-0">
                                                    <img src="{{ $item->thumbnail ? asset('storage/' . $item->thumbnail) : 'https://via.placeholder.com/400x300/cccccc/ffffff?text=No+Image' }}"
                                                        alt="{{ $item->title }}"
                                                        class="h-12 w-16 object-cover rounded-md border border-gray-200">
                                                </div>
                                                <div class="min-w-0 flex-1">
                                                    <a href="{{ route('admin.news.show', $item) }}"
                                                        class="text-sm font-medium text-gray-900 hover:text-blue-600 truncate block transition-colors">
                                                        {{ Str::limit($item->title, 60) }}
                                                    </a>
                                                    <p class="text-sm text-gray-500 mt-1 line-clamp-2">
                                                        @if ($item->excerpt)
                                                            {{ Str::limit($item->excerpt, 80) }}
                                                        @else
                                                            {{ Str::limit(strip_tags($item->content), 80) }}
                                                        @endif
                                                    </p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div
                                                    class="h-8 w-8 rounded-full bg-gray-100 flex items-center justify-center text-gray-600 font-medium text-sm border border-gray-200">
                                                    {{ strtoupper(substr($item->author->name ?? 'A', 0, 1)) }}
                                                </div>
                                                <div class="ml-3">
                                                    <div class="text-sm font-medium text-gray-900">
                                                        {{ $item->author->name ?? 'Admin' }}
                                                    </div>
                                                    <div class="text-xs text-gray-500 truncate max-w-[120px]">
                                                        {{ $item->author->email ?? '-' }}
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <form action="{{ route('admin.news.toggle-publish', $item) }}" method="POST"
                                                class="inline">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit"
                                                    class="{{ $item->is_published ? 'bg-green-100 text-green-800 hover:bg-green-200' : 'bg-yellow-100 text-yellow-800 hover:bg-yellow-200' }} text-xs font-medium px-3 py-1.5 rounded-full transition-colors flex items-center">
                                                    @if ($item->is_published)
                                                        <i class="fas fa-check-circle mr-1 text-xs"></i>
                                                        Diterbitkan
                                                    @else
                                                        <i class="fas fa-file-alt mr-1 text-xs"></i>
                                                        Draft
                                                    @endif
                                                </button>
                                            </form>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">
                                                {{ $item->created_at->format('d/m/Y') }}
                                            </div>
                                            <div class="text-xs text-gray-500">
                                                {{ $item->created_at->format('H:i') }}
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center text-sm text-gray-900">
                                                <i class="fas fa-eye text-gray-400 mr-2"></i>
                                                {{ $item->views ?? 0 }}
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <div class="flex justify-end space-x-3">
                                                <a href="{{ route('admin.news.show', $item) }}"
                                                    class="text-blue-600 hover:text-blue-900 transition-colors"
                                                    title="Lihat Detail">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="{{ route('admin.news.edit', $item) }}"
                                                    class="text-yellow-600 hover:text-yellow-900 transition-colors"
                                                    title="Edit">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="{{ route('admin.news.destroy', $item) }}" method="POST"
                                                    class="inline"
                                                    onsubmit="return confirm('Hapus berita ini? Tindakan ini tidak dapat dibatalkan.')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="text-red-600 hover:text-red-900 transition-colors"
                                                        title="Hapus">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="px-6 py-12 text-center">
                                            <div class="flex flex-col items-center">
                                                <i class="fas fa-newspaper text-gray-300 text-4xl mb-4"></i>
                                                <p class="text-gray-500 mb-2">Tidak ada berita ditemukan.</p>
                                                <a href="{{ route('admin.news.create') }}"
                                                    class="inline-flex items-center text-blue-600 hover:text-blue-800 font-medium transition-colors">
                                                    <i class="fas fa-plus mr-2"></i>
                                                    Tambah berita pertama
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    @if ($news->hasPages())
                        <div class="px-6 py-4 border-t border-gray-200">
                            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                                <div class="text-sm text-gray-700 mb-4 sm:mb-0">
                                    Menampilkan
                                    <span class="font-medium">{{ $news->firstItem() ?? 0 }}</span>
                                    sampai
                                    <span class="font-medium">{{ $news->lastItem() ?? 0 }}</span>
                                    dari
                                    <span class="font-medium">{{ $news->total() ?? 0 }}</span>
                                    hasil
                                </div>

                                <div class="flex items-center space-x-2">
                                    @if ($news->onFirstPage())
                                        <span
                                            class="inline-flex items-center px-3 py-1.5 border border-gray-300 rounded-lg text-sm font-medium text-gray-400 bg-gray-50">
                                            <i class="fas fa-chevron-left mr-1"></i> Sebelumnya
                                        </span>
                                    @else
                                        <a href="{{ $news->previousPageUrl() }}"
                                            class="inline-flex items-center px-3 py-1.5 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 transition-colors">
                                            <i class="fas fa-chevron-left mr-1"></i> Sebelumnya
                                        </a>
                                    @endif

                                    <div class="flex space-x-1">
                                        @foreach ($news->getUrlRange(1, $news->lastPage()) as $page => $url)
                                            @if ($page == $news->currentPage())
                                                <span
                                                    class="inline-flex items-center px-3 py-1.5 border border-blue-500 rounded-lg text-sm font-medium text-white bg-blue-600">
                                                    {{ $page }}
                                                </span>
                                            @else
                                                <a href="{{ $url }}"
                                                    class="inline-flex items-center px-3 py-1.5 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 transition-colors">
                                                    {{ $page }}
                                                </a>
                                            @endif
                                        @endforeach
                                    </div>

                                    @if ($news->hasMorePages())
                                        <a href="{{ $news->nextPageUrl() }}"
                                            class="inline-flex items-center px-3 py-1.5 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 transition-colors">
                                            Selanjutnya <i class="fas fa-chevron-right ml-1"></i>
                                        </a>
                                    @else
                                        <span
                                            class="inline-flex items-center px-3 py-1.5 border border-gray-300 rounded-lg text-sm font-medium text-gray-400 bg-gray-50">
                                            Selanjutnya <i class="fas fa-chevron-right ml-1"></i>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endif
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        // Bulk Actions
        function toggleBulkActions() {
            const bulkActions = document.getElementById('bulkActions');
            bulkActions.classList.toggle('hidden');
            bulkActions.classList.add('animate-fade-in');
        }

        function updateSelectedCount() {
            const selected = document.querySelectorAll('.row-checkbox:checked').length;
            document.getElementById('selectedCount').textContent = selected;

            // Show/hide bulk actions based on selection
            const bulkActions = document.getElementById('bulkActions');
            if (selected > 0 && bulkActions.classList.contains('hidden')) {
                toggleBulkActions();
            } else if (selected === 0 && !bulkActions.classList.contains('hidden')) {
                bulkActions.classList.add('hidden');
            }
        }

        function confirmBulkAction(action) {
            const selected = document.querySelectorAll('.row-checkbox:checked').length;
            if (selected === 0) {
                alert('Pilih minimal satu berita.');
                return;
            }

            const confirmText = {
                'delete': 'Hapus berita yang dipilih? Tindakan ini tidak dapat dibatalkan.',
                'publish': 'Terbitkan berita yang dipilih?',
                'unpublish': 'Jadikan berita yang dipilih sebagai draft?'
            } [action];

            if (!confirm(confirmText)) return;

            if (action === 'delete') {
                document.getElementById('bulkForm').submit();
            } else {
                // Handle publish/unpublish via AJAX
                const ids = Array.from(document.querySelectorAll('.row-checkbox:checked'))
                    .map(cb => cb.value);

                const url = action === 'publish' ?
                    '{{ route('admin.news.bulkPublish') }}' :
                    '{{ route('admin.news.bulkUnpublish') }}';

                fetch(url, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            ids: ids
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            alert(
                                `Berhasil ${action === 'publish' ? 'menerbitkan' : 'menjadikan draft'} ${selected} berita!`);
                            window.location.reload();
                        } else {
                            alert('Terjadi kesalahan. Silakan coba lagi.');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Terjadi kesalahan. Silakan coba lagi.');
                    });
            }
        }

        // Checkbox handling
        document.addEventListener('DOMContentLoaded', function() {
            const selectAll = document.getElementById('select_all');
            const rowCheckboxes = document.querySelectorAll('.row-checkbox');

            if (selectAll) {
                selectAll.addEventListener('change', function() {
                    rowCheckboxes.forEach(cb => {
                        cb.checked = selectAll.checked;
                    });
                    updateSelectedCount();
                });
            }

            rowCheckboxes.forEach(cb => {
                cb.addEventListener('change', function() {
                    updateSelectedCount();

                    // Update select all checkbox state
                    const allChecked = document.querySelectorAll('.row-checkbox:checked').length ===
                        rowCheckboxes.length;
                    if (selectAll) {
                        selectAll.checked = allChecked;
                    }
                });
            });

            // Initialize count
            updateSelectedCount();
        });
    </script>

    <style>
        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        .animate-fade-in {
            animation: fadeIn 0.3s ease-in-out;
        }

        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
    </style>
@endpush
