@extends('layouts.app')

@section('title', 'Daftar RW (Rukun Warga)')

@section('content')
<div class="admin-content-area">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Header -->
        <div class="md:flex md:items-center md:justify-between mb-8">
            <div class="flex-1 min-w-0">
                <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:text-3xl sm:truncate">
                    Daftar RW (Rukun Warga)
                </h2>
                <p class="mt-1 text-sm text-gray-500">
                    Kelola data Rukun Warga di lingkungan Anda
                </p>
            </div>
            <div class="mt-4 flex md:mt-0 md:ml-4">
                <a href="{{ route('admin.rws.create') }}" 
                   class="ml-3 inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    <i class="fas fa-plus mr-2"></i>
                    Tambah RW Baru
                </a>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 gap-5 sm:grid-cols-3 mb-8">
            <div class="bg-white overflow-hidden shadow rounded-lg">
                <div class="p-5">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <i class="fas fa-users text-gray-400 text-xl"></i>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-medium text-gray-500 truncate">
                                    Total RW
                                </dt>
                                <dd class="text-lg font-medium text-gray-900">
                                    {{ $totalRWs ?? $rws->total() }}
                                </dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow rounded-lg">
                <div class="p-5">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <i class="fas fa-user-tie text-gray-400 text-xl"></i>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-medium text-gray-500 truncate">
                                    Ketua RW Terdaftar
                                </dt>
                                <dd class="text-lg font-medium text-gray-900">
                                    {{ $rws->whereNotNull('ketua_rw')->count() }}
                                </dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow rounded-lg">
                <div class="p-5">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <i class="fas fa-phone text-gray-400 text-xl"></i>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-medium text-gray-500 truncate">
                                    Kontak Tersedia
                                </dt>
                                <dd class="text-lg font-medium text-gray-900">
                                    {{ $rws->whereNotNull('no_hp_ketua_rw')->count() }}
                                </dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="bg-white shadow overflow-hidden sm:rounded-lg">
            <!-- Search and Filter -->
            <div class="px-4 py-5 border-b border-gray-200 sm:px-6">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                    <div class="w-full sm:w-1/2 mb-4 sm:mb-0">
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-search text-gray-400"></i>
                            </div>
                            <input type="text" 
                                   id="search" 
                                   placeholder="Cari RW atau Ketua RW..." 
                                   class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md leading-5 bg-white placeholder-gray-500 focus:outline-none focus:placeholder-gray-400 focus:ring-1 focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                        </div>
                    </div>
                    <div class="flex items-center space-x-2">
                        <span class="text-sm text-gray-700">
                            Menampilkan {{ $rws->firstItem() ?? 0 }} - {{ $rws->lastItem() ?? 0 }} dari {{ $rws->total() }} RW
                        </span>
                    </div>
                </div>
            </div>

            <!-- Table -->
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-16">
                                <div class="flex items-center">
                                    No
                                    <i class="fas fa-chevron-down ml-1 text-xs"></i>
                                </div>
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                RW
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Ketua RW
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                No. HP
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Dibuat
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Status
                            </th>
                            <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($rws as $index => $rw)
                        <tr class="hover:bg-gray-50 transition-colors duration-150">
                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                <div class="text-sm font-medium text-gray-900">
                                    {{ $rws->firstItem() + $index }}
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-10 w-10 flex items-center justify-center bg-blue-100 rounded-lg">
                                        <span class="text-blue-600 font-bold">{{ substr($rw->name, 3) }}</span>
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900">{{ $rw->name }}</div>
                                        <div class="text-sm text-gray-500">
                                            {{ $rw->rts_count ?? 0 }} RT • {{ $rw->residents_count ?? 0 }} Warga
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($rw->ketua_rw)
                                    <div class="text-sm font-medium text-gray-900">{{ $rw->ketua_rw }}</div>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                        Belum Ditentukan
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($rw->no_hp_ketua_rw)
                                    <div class="flex items-center">
                                        <i class="fas fa-phone text-gray-400 mr-1 text-sm"></i>
                                        <a href="tel:{{ $rw->no_hp_ketua_rw }}" class="text-sm text-blue-600 hover:text-blue-900">
                                            {{ $rw->no_hp_ketua_rw }}
                                        </a>
                                    </div>
                                @else
                                    <span class="text-sm text-gray-400">-</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $rw->created_at->format('d M Y') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($rw->ketua_rw && $rw->no_hp_ketua_rw)
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        <i class="fas fa-circle text-green-400 mr-1.5 text-xs"></i>
                                        Lengkap
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                        <i class="fas fa-circle text-yellow-400 mr-1.5 text-xs"></i>
                                        Belum Lengkap
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <div class="flex items-center justify-end space-x-2">
                                    <a href="{{ route('admin.rws.show', $rw) }}" 
                                       class="text-blue-600 hover:text-blue-900 p-1 rounded hover:bg-blue-50"
                                       title="Lihat Detail">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.rws.edit', $rw) }}" 
                                       class="text-yellow-600 hover:text-yellow-900 p-1 rounded hover:bg-yellow-50"
                                       title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.rws.destroy', $rw) }}" method="POST" class="inline delete-form" data-rw-name="{{ $rw->name }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" 
                                                onclick="confirmDelete(this)" 
                                                class="text-red-600 hover:text-red-900 p-1 rounded hover:bg-red-50"
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
                                <i class="fas fa-users mx-auto text-4xl text-gray-400 mb-4"></i>
                                <h3 class="mt-2 text-sm font-medium text-gray-900">Tidak ada data RW</h3>
                                <p class="mt-1 text-sm text-gray-500">
                                    Mulai dengan menambahkan RW baru.
                                </p>
                                <div class="mt-6">
                                    <a href="{{ route('admin.rws.create') }}" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                        <i class="fas fa-plus mr-2"></i>
                                        Tambah RW Baru
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if($rws->hasPages())
            <div class="bg-white px-4 py-3 border-t border-gray-200 sm:px-6">
                <div class="flex items-center justify-between">
                    <div class="flex-1 flex justify-between sm:hidden">
                        @if($rws->onFirstPage())
                        <span class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-300 bg-white cursor-not-allowed">
                            Sebelumnya
                        </span>
                        @else
                        <a href="{{ $rws->previousPageUrl() }}" class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                            Sebelumnya
                        </a>
                        @endif

                        @if($rws->hasMorePages())
                        <a href="{{ $rws->nextPageUrl() }}" class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                            Selanjutnya
                        </a>
                        @else
                        <span class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-300 bg-white cursor-not-allowed">
                            Selanjutnya
                        </span>
                        @endif
                    </div>
                    <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                        <div>
                            <p class="text-sm text-gray-700">
                                Menampilkan 
                                <span class="font-medium">{{ $rws->firstItem() }}</span>
                                sampai 
                                <span class="font-medium">{{ $rws->lastItem() }}</span>
                                dari 
                                <span class="font-medium">{{ $rws->total() }}</span>
                                hasil
                            </p>
                        </div>
                        <div>
                            {{ $rws->links() }}
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    // Search functionality
    document.getElementById('search').addEventListener('keyup', function(e) {
        const searchTerm = e.target.value.toLowerCase();
        const rows = document.querySelectorAll('tbody tr');
        
        rows.forEach(row => {
            const text = row.textContent.toLowerCase();
            row.style.display = text.includes(searchTerm) ? '' : 'none';
        });
    });

    // Delete confirmation function
    function confirmDelete(button) {
        const form = button.closest('form.delete-form');
        const rwName = form.getAttribute('data-rw-name');

        Swal.fire({
            title: 'Hapus RW?',
            html: `Apakah Anda yakin ingin menghapus <strong>${rwName}</strong>?<br><br>
                  <span class="text-sm text-red-600">Data yang dihapus tidak dapat dikembalikan!</span>`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal',
            reverseButtons: true,
            showLoaderOnConfirm: true,
            preConfirm: () => {
                return new Promise((resolve) => {
                    setTimeout(() => {
                        resolve();
                    }, 500);
                });
            }
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    }

    // Alternative delete confirmation jika SweetAlert2 tidak tersedia
    function confirmDeleteFallback(button) {
        const form = button.closest('form.delete-form');
        const rwName = form.getAttribute('data-rw-name');

        if (confirm(`Apakah Anda yakin ingin menghapus ${rwName}?\n\nData yang dihapus tidak dapat dikembalikan!`)) {
            form.submit();
        }
    }

    // Sort functionality untuk kolom No (opsional)
    document.querySelector('th:first-child').addEventListener('click', function() {
        const table = this.closest('table');
        const tbody = table.querySelector('tbody');
        const rows = Array.from(tbody.querySelectorAll('tr'));
        
        // Check current sort order
        const isAscending = this.getAttribute('data-sort') !== 'desc';
        
        rows.sort((a, b) => {
            const aNo = parseInt(a.querySelector('td:first-child').textContent.trim());
            const bNo = parseInt(b.querySelector('td:first-child').textContent.trim());
            
            return isAscending ? aNo - bNo : bNo - aNo;
        });
        
        // Toggle sort order
        this.setAttribute('data-sort', isAscending ? 'desc' : 'asc');
        
        // Update icon
        const icon = this.querySelector('i');
        icon.style.transform = isAscending ? 'rotate(180deg)' : 'rotate(0deg)';
        
        // Reappend rows
        rows.forEach(row => tbody.appendChild(row));
    });
</script>
@endpush