<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Berita</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* Custom styles for better UX */
        .hover-card:hover {
            transform: translateY(-2px);
            transition: all 0.2s ease-in-out;
        }
        .fade-in {
            animation: fadeIn 0.3s ease-in-out;
        }
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
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
                        <a href="/admin/news" class="bg-blue-100 text-blue-700 px-3 py-2 text-sm font-medium rounded-md">Berita</a>
                        <a href="/admin/reports" class="text-gray-600 hover:text-gray-900 px-3 py-2 text-sm font-medium">Laporan</a>
                        <a href="/admin/users" class="text-gray-600 hover:text-gray-900 px-3 py-2 text-sm font-medium">Pengguna</a>
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
                    <h2 class="text-2xl font-bold text-gray-900">Berita & Pengumuman</h2>
                    <p class="text-gray-600 mt-1">Kelola semua berita dan pengumuman yang diterbitkan.</p>
                </div>
                
                <div class="flex flex-col sm:flex-row gap-3">
                    <form method="GET" action="{{ route('admin.news.index') }}" class="flex flex-col sm:flex-row gap-2">
                        <select name="status" class="border border-gray-300 rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" onchange="this.form.submit()">
                            <option value="">Semua Status</option>
                            <option value="published" {{ request('status') === 'published' ? 'selected' : '' }}>Diterbitkan</option>
                            <option value="draft" {{ request('status') === 'draft' ? 'selected' : '' }}>Draft</option>
                        </select>
                        <div class="flex">
                            <input type="search" name="q" value="{{ request('q') }}" placeholder="Cari berita..." class="border border-gray-300 rounded-l-md px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 w-full sm:w-64">
                            <button type="submit" class="bg-blue-600 text-white rounded-r-md px-4 py-2 text-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </form>
                    
                    <a href="{{ route('admin.news.create') }}" class="bg-green-600 text-white rounded-md px-4 py-2 text-sm hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 flex items-center justify-center">
                        <i class="fas fa-plus mr-2"></i>
                        Tambah Berita
                    </a>
                </div>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <!-- Total Berita Card -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 hover-card">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600">Total Berita</p>
                        <p class="text-2xl font-bold text-gray-900 mt-1">{{ $stats['total'] ?? 0 }}</p>
                        <p class="text-xs text-gray-500 mt-2">{{ $stats['monthly'] ?? 0 }} berita baru bulan ini</p>
                    </div>
                    <div class="p-3 bg-blue-50 rounded-full">
                        <i class="fas fa-newspaper text-blue-600 text-xl"></i>
                    </div>
                </div>
            </div>

            <!-- Diterbitkan Card -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 hover-card">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600">Diterbitkan</p>
                        <p class="text-2xl font-bold text-green-600 mt-1">{{ $stats['published'] ?? 0 }}</p>
                        <p class="text-xs text-gray-500 mt-2">
                            {{ $stats['published'] > 0 ? round(($stats['published'] / $stats['total']) * 100, 1) : 0 }}% dari total
                        </p>
                    </div>
                    <div class="p-3 bg-green-50 rounded-full">
                        <i class="fas fa-check-circle text-green-600 text-xl"></i>
                    </div>
                </div>
            </div>

            <!-- Draft Card -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 hover-card">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600">Draft</p>
                        <p class="text-2xl font-bold text-yellow-600 mt-1">{{ $stats['draft'] ?? 0 }}</p>
                        <p class="text-xs text-gray-500 mt-2">Belum dipublikasikan</p>
                    </div>
                    <div class="p-3 bg-yellow-50 rounded-full">
                        <i class="fas fa-file-alt text-yellow-600 text-xl"></i>
                    </div>
                </div>
            </div>

            <!-- Aksi Cepat Card -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 hover-card">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600">Aksi Cepat</p>
                        <div class="flex gap-2 mt-3">
                            <a href="{{ route('admin.news.create') }}" class="bg-blue-100 text-blue-700 text-xs px-3 py-1.5 rounded hover:bg-blue-200 font-medium">
                                <i class="fas fa-plus mr-1"></i>Tambah
                            </a>
                            <button onclick="toggleBulkActions()" class="bg-red-100 text-red-700 text-xs px-3 py-1.5 rounded hover:bg-red-200 font-medium">
                                <i class="fas fa-trash mr-1"></i>Hapus Massal
                            </button>
                        </div>
                    </div>
                    <div class="p-3 bg-purple-50 rounded-full">
                        <i class="fas fa-bolt text-purple-600 text-xl"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bulk Actions -->
        <div id="bulkActions" class="hidden fade-in mb-6">
            <div class="bg-red-50 border border-red-200 rounded-lg p-4">
                <div class="flex flex-col sm:flex-row items-center justify-between gap-4">
                    <div class="text-red-700 font-medium">
                        <i class="fas fa-check-circle mr-2"></i>
                        <span id="selectedCount">0</span> berita dipilih
                    </div>
                    <div class="flex flex-wrap gap-2">
                        <button onclick="confirmBulkAction('publish')" class="bg-green-600 text-white rounded-md px-4 py-2 text-sm hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 flex items-center">
                            <i class="fas fa-check-circle mr-2"></i>
                            Terbitkan
                        </button>
                        <button onclick="confirmBulkAction('unpublish')" class="bg-yellow-600 text-white rounded-md px-4 py-2 text-sm hover:bg-yellow-700 focus:outline-none focus:ring-2 focus:ring-yellow-500 flex items-center">
                            <i class="fas fa-times-circle mr-2"></i>
                            Jadikan Draft
                        </button>
                        <button onclick="confirmBulkAction('delete')" class="bg-red-600 text-white rounded-md px-4 py-2 text-sm hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 flex items-center">
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
                
                <!-- Table Container -->
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left">
                                    <input type="checkbox" id="select_all" class="checkbox h-4 w-4 text-blue-600 border-gray-300 rounded relative">
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Berita
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Penulis
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Status
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Dibuat
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Views
                                </th>
                                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Aksi
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($news as $item)
                            <tr class="hover:bg-gray-50 transition-colors duration-150">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <input type="checkbox" name="ids[]" value="{{ $item->id }}" class="row-checkbox checkbox h-4 w-4 text-blue-600 border-gray-300 rounded relative">
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-start space-x-4">
                                        <div class="flex-shrink-0">
                                            <img src="{{ $item->thumbnail ?? 'https://via.placeholder.com/64x48/cccccc/ffffff?text=No+Image' }}" alt="{{ $item->title }}" class="h-12 w-16 object-cover rounded-md">
                                        </div>
                                        <div class="min-w-0 flex-1">
                                            <a href="{{ route('admin.news.show', $item) }}" class="text-sm font-medium text-gray-900 hover:text-blue-600 truncate block">
                                                {{ Str::limit($item->title, 60) }}
                                            </a>
                                            <p class="text-sm text-gray-500 mt-1 line-clamp-2">
                                                {{ $item->excerpt ? Str::limit($item->excerpt, 80) : Str::limit(strip_tags($item->content), 80) }}
                                            </p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="h-8 w-8 rounded-full bg-gray-100 flex items-center justify-center text-gray-600 font-medium text-sm">
                                            {{ strtoupper(substr($item->author->name ?? '-', 0, 1)) }}
                                        </div>
                                        <div class="ml-3">
                                            <div class="text-sm font-medium text-gray-900">{{ $item->author->name ?? '-' }}</div>
                                            <div class="text-xs text-gray-500">{{ $item->author->email ?? '' }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <form action="{{ route('admin.news.toggle-publish', $item) }}" method="POST" class="inline">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="{{ $item->is_published ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }} text-xs font-medium px-3 py-1 rounded-full hover:opacity-90 transition-opacity">
                                            {{ $item->is_published ? 'Diterbitkan' : 'Draft' }}
                                        </button>
                                    </form>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $item->created_at->format('d/m/Y') }}
                                    <div class="text-xs text-gray-400">
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
                                        <a href="{{ route('admin.news.show', $item) }}" class="text-blue-600 hover:text-blue-900" title="Lihat">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.news.edit', $item) }}" class="text-yellow-600 hover:text-yellow-900" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.news.destroy', $item) }}" method="POST" class="inline" onsubmit="return confirm('Hapus berita ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-900" title="Hapus">
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
                                        <p class="text-gray-500">Tidak ada berita ditemukan.</p>
                                        <a href="{{ route('admin.news.create') }}" class="mt-4 inline-flex items-center text-blue-600 hover:text-blue-800 font-medium">
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
                @if($news->hasPages())
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
                            @if($news->onFirstPage())
                                <span class="inline-flex items-center px-3 py-1.5 border border-gray-300 rounded-md text-sm font-medium text-gray-400 bg-gray-50">
                                    <i class="fas fa-chevron-left mr-1"></i> Sebelumnya
                                </span>
                            @else
                                <a href="{{ $news->previousPageUrl() }}" class="inline-flex items-center px-3 py-1.5 border border-gray-300 rounded-md text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                                    <i class="fas fa-chevron-left mr-1"></i> Sebelumnya
                                </a>
                            @endif
                            
                            <div class="flex space-x-1">
                                @foreach ($news->getUrlRange(1, $news->lastPage()) as $page => $url)
                                    @if ($page == $news->currentPage())
                                        <span class="inline-flex items-center px-3 py-1.5 border border-blue-500 rounded-md text-sm font-medium text-white bg-blue-600">
                                            {{ $page }}
                                        </span>
                                    @else
                                        <a href="{{ $url }}" class="inline-flex items-center px-3 py-1.5 border border-gray-300 rounded-md text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                                            {{ $page }}
                                        </a>
                                    @endif
                                @endforeach
                            </div>
                            
                            @if($news->hasMorePages())
                                <a href="{{ $news->nextPageUrl() }}" class="inline-flex items-center px-3 py-1.5 border border-gray-300 rounded-md text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                                    Selanjutnya <i class="fas fa-chevron-right ml-1"></i>
                                </a>
                            @else
                                <span class="inline-flex items-center px-3 py-1.5 border border-gray-300 rounded-md text-sm font-medium text-gray-400 bg-gray-50">
                                    Selanjutnya <i class="fas fa-chevron-right ml-1"></i>
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
                @endif
            </form>
        </div>

        <!-- Footer -->
        <footer class="mt-8 pt-8 border-t border-gray-200">
            <div class="text-center text-sm text-gray-500">
                <p>&copy; {{ date('Y') }} Admin Dashboard. All rights reserved.</p>
                <p class="mt-1">Sistem Pengelolaan Berita dan Pengumuman</p>
            </div>
        </footer>
    </div>

    <!-- JavaScript -->
    <script>
        // Bulk Actions
        function toggleBulkActions() {
            const bulkActions = document.getElementById('bulkActions');
            bulkActions.classList.toggle('hidden');
            bulkActions.classList.add('fade-in');
        }

        function updateSelectedCount() {
            const selected = document.querySelectorAll('.row-checkbox:checked').length;
            document.getElementById('selectedCount').textContent = selected;
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
            }[action];

            if (!confirm(confirmText)) return;

            if (action === 'delete') {
                document.getElementById('bulkForm').submit();
            } else {
                // Implement publish/unpublish functionality
                alert(`Fitur ${action} berita yang dipilih akan segera tersedia.`);
                // For now, show a success message
                setTimeout(() => {
                    alert(`Berhasil ${action} ${selected} berita!`);
                    window.location.reload();
                }, 1000);
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
                        cb.dispatchEvent(new Event('change'));
                    });
                });
            }

            rowCheckboxes.forEach(cb => {
                cb.addEventListener('change', function() {
                    updateSelectedCount();
                    
                    // Update select all checkbox state
                    const allChecked = document.querySelectorAll('.row-checkbox:checked').length === rowCheckboxes.length;
                    selectAll.checked = allChecked;
                });
            });

            // Initialize count
            updateSelectedCount();
        });

        // Responsive table functions
        function toggleTableResponsive() {
            const tableContainer = document.querySelector('.overflow-x-auto');
            tableContainer.classList.toggle('responsive-table');
        }
    </script>
</body>
</html>