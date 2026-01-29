@extends('layouts.app')

@section('title', 'Surat - Admin')

@push('styles')
    @vite(['resources/css/app.css', 'resources/js/admin.js'])
@endpush

@section('content')
<div class="admin-content-area">
    <div class="dashboard-frame">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
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
                        <span class="text-gray-600 font-medium">Surat</span>
                    </li>
                </ol>
            </nav>

            <!-- Header -->
            <div class="mb-4 md:flex md:items-center md:justify-between">
                <div class="flex-1 min-w-0">
                    <h2 class="text-2xl font-semibold text-gray-800">Surat</h2>
                    <p class="text-sm text-gray-500">Kelola semua surat yang diajukan — filter, lihat, dan ubah status.</p>
                </div>

                <div class="mt-4 flex md:mt-0 items-center gap-3">
                    <form method="GET" action="{{ route('admin.submissions.index') }}" class="flex items-center">
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-search text-gray-400"></i>
                            </div>
                            <input type="search" name="q" value="{{ request('q') }}" placeholder="Cari berdasarkan pengguna atau jenis" 
                                   class="pl-10 pr-3 py-2 border border-gray-300 rounded-md text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" />
                        </div>
                        <button type="submit" class="ml-2 inline-flex items-center px-3 py-2 bg-blue-600 text-white rounded-md text-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Cari
                        </button>
                    </form>

                    <a href="{{ route('user.letters.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-md text-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        <i class="fas fa-plus mr-2"></i>
                        Buat Surat
                    </a>
                </div>
            </div>

            <!-- Main Content -->
            <div class="bg-white shadow rounded-lg overflow-hidden">
                <div class="p-4">
                    <div class="mb-3 flex items-center justify-between">
                        <div class="text-sm text-gray-600">Aksi massal: pilih surat lalu hapus.</div>
                        <div class="flex items-center gap-2">
                            <button id="bulkDeleteBtn" type="button" class="inline-flex items-center px-3 py-2 bg-red-600 text-white rounded-md text-sm hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                <i class="fas fa-trash mr-2"></i>
                                Hapus yang dipilih
                            </button>
                        </div>
                    </div>

                    <form id="bulkForm" method="POST" action="{{ route('admin.submissions.bulkDestroy') }}">
                        @csrf
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-4 py-3">
                                            <input type="checkbox" id="select_all" class="h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500" />
                                        </th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pengguna</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jenis</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Dibuat</th>
                                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @forelse($letters as $letter)
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-4 py-4 whitespace-nowrap">
                                            <input type="checkbox" name="ids[]" value="{{ $letter->id }}" class="row-checkbox h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500" />
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">#{{ $letter->id }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm flex items-center gap-3">
                                            <div class="h-8 w-8 rounded-full bg-gray-100 flex items-center justify-center text-sm text-gray-600">
                                                {{ strtoupper(substr($letter->user->name ?? '-',0,1)) }}
                                            </div>
                                            <div>
                                                <div class="font-medium text-gray-900">{{ $letter->user->name ?? '-' }}</div>
                                                <div class="text-xs text-gray-500">{{ $letter->user->email ?? '' }}</div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $letter->type }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                                            <span class="{{ $letter->badgeClass() }}">{{ $letter->statusLabel() }}</span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            <i class="far fa-calendar text-gray-400 mr-1"></i>
                                            {{ $letter->created_at->format('Y-m-d') }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm">
                                            <div class="flex items-center justify-end space-x-2">
                                                <a href="{{ route('admin.submissions.show', $letter) }}" class="text-blue-600 hover:text-blue-900 p-1 rounded hover:bg-blue-50" title="Lihat">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="{{ route('admin.submissions.edit', $letter) }}" class="text-yellow-500 hover:text-yellow-700 p-1 rounded hover:bg-yellow-50" title="Ubah">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="{{ route('admin.submissions.destroy', $letter) }}" method="POST" class="inline delete-form" data-letter-id="{{ $letter->id }}">
                                                    @csrf 
                                                    @method('DELETE')
                                                    <button type="button" onclick="confirmDelete(this)" class="text-red-600 hover:text-red-800 p-1 rounded hover:bg-red-50" title="Hapus">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="7" class="px-6 py-12 text-center">
                                            <i class="fas fa-envelope mx-auto text-4xl text-gray-400 mb-4"></i>
                                            <h3 class="mt-2 text-sm font-medium text-gray-900">Tidak ada surat</h3>
                                            <p class="mt-1 text-sm text-gray-500">
                                                Coba ubah filter atau buat surat baru.
                                            </p>
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </form>

                    <div class="mt-4 flex items-center justify-between">
                        <div class="text-sm text-gray-600">
                            Menampilkan {{ $letters->firstItem() ?? 0 }} - {{ $letters->lastItem() ?? 0 }} dari {{ $letters->total() ?? 0 }}
                        </div>
                        <div>{{ $letters->withQueryString()->links() }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Bulk selection functionality
    (function(){
        const selectAll = document.getElementById('select_all');
        const rowCheckboxes = document.querySelectorAll('.row-checkbox');
        const bulkBtn = document.getElementById('bulkDeleteBtn');
        const bulkForm = document.getElementById('bulkForm');

        if (selectAll) {
            selectAll.addEventListener('change', function(){
                rowCheckboxes.forEach(cb => cb.checked = selectAll.checked);
            });
        }

        if (bulkBtn && bulkForm) {
            bulkBtn.addEventListener('click', function(){
                const any = Array.from(rowCheckboxes).some(cb => cb.checked);
                if (!any) { 
                    alert('Pilih minimal satu surat.'); 
                    return; 
                }
                if (!confirm('Hapus surat yang dipilih? Tindakan ini tidak dapat dibatalkan.')) return;
                bulkForm.submit();
            });
        }

        // Individual delete confirmation
        window.confirmDelete = function(button) {
            const form = button.closest('form.delete-form');
            const letterId = form.getAttribute('data-letter-id');
            
            if (confirm(`Hapus surat #${letterId}? Tindakan ini tidak dapat dibatalkan.`)) {
                form.submit();
            }
        }

        // Update select all checkbox when individual checkboxes change
        rowCheckboxes.forEach(checkbox => {
            checkbox.addEventListener('change', function() {
                const allChecked = Array.from(rowCheckboxes).every(cb => cb.checked);
                const someChecked = Array.from(rowCheckboxes).some(cb => cb.checked);
                
                if (selectAll) {
                    selectAll.checked = allChecked;
                    selectAll.indeterminate = someChecked && !allChecked;
                }
            });
        });
    })();
</script>
@endpush