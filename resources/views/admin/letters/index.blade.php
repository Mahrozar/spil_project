@push('styles')
    @vite(['resources/css/app.css', 'resources/js/admin.js'])
@endpush

<x-app-layout>
    <div class="admin-content-area">
    <div class="dashboard-frame">
        <div class="mb-4 flex items-center justify-between">
            <div>
                <h2 class="text-2xl font-semibold text-gray-800">Surat</h2>
                <p class="text-sm text-gray-500">Kelola semua surat yang diajukan — filter, lihat, dan ubah status.</p>
            </div>

            <div class="flex items-center gap-3">
                <form method="GET" action="{{ route('admin.letters') }}" class="flex items-center">
                    <input type="search" name="q" value="{{ request('q') }}" placeholder="Cari berdasarkan pengguna atau jenis" class="border rounded-md px-3 py-2 text-sm" />
                    <button type="submit" class="ml-2 inline-flex items-center px-3 py-2 bg-blue-600 text-white rounded-md text-sm">Cari</button>
                </form>

                <a href="{{ route('user.letters.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-md text-sm">Buat Surat</a>
            </div>
        </div>

        <div class="bg-white shadow rounded-lg overflow-hidden">
            <div class="p-4">
                    <div class="mb-3 flex items-center justify-between">
                    <div class="text-sm text-gray-600">Aksi massal: pilih surat lalu hapus.</div>
                    <div class="flex items-center gap-2">
                        <button id="bulkDeleteBtn" type="button" class="inline-flex items-center px-3 py-2 bg-red-600 text-white rounded-md text-sm">Hapus yang dipilih</button>
                    </div>
                </div>

                <form id="bulkForm" method="POST" action="{{ route('admin.letters.bulkDestroy') }}">
                    @csrf
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-4 py-3">
                                    <input type="checkbox" id="select_all" class="h-4 w-4 text-blue-600 border-gray-300 rounded" />
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
                                    <input type="checkbox" name="ids[]" value="{{ $letter->id }}" class="row-checkbox h-4 w-4 text-blue-600 border-gray-300 rounded" />
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">#{{ $letter->id }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm flex items-center gap-3">
                                    <div class="h-8 w-8 rounded-full bg-gray-100 flex items-center justify-center text-sm text-gray-600">{{ strtoupper(substr($letter->user->name ?? '-',0,1)) }}</div>
                                    <div>
                                        <div class="font-medium text-gray-900">{{ $letter->user->name ?? '-' }}</div>
                                        <div class="text-xs text-gray-500">{{ $letter->user->email ?? '' }}</div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $letter->type }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm">
                                    @php
                                        $statusClass = $letter->status === 'pending' ? 'bg-yellow-50 text-yellow-800' : ($letter->status === 'approved' ? 'bg-blue-50 text-blue-800' : 'bg-gray-50 text-gray-800');
                                    @endphp
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium {{ $statusClass }}">{{ ucfirst($letter->status) }}</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $letter->created_at->format('Y-m-d') }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm">
                                    <a href="{{ route('admin.letters.show', $letter) }}" class="text-blue-600 hover:text-blue-900 mr-2" title="Lihat">
                                        <x-icon name="eye" class="h-5 w-5 inline" />
                                    </a>
                                    <a href="{{ route('admin.letters.edit', $letter) }}" class="text-yellow-500 hover:text-yellow-700 mr-2" title="Ubah">
                                        <x-icon name="pencil" class="h-5 w-5 inline" />
                                    </a>
                                    <form action="{{ route('admin.letters.destroy', $letter) }}" method="POST" class="inline">@csrf @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-800" title="Hapus">
                                            <x-icon name="trash" class="h-5 w-5 inline" />
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="px-6 py-12 text-center text-gray-500">Tidak ada surat. Coba ubah filter atau buat surat baru.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                    </div>
                </form>

                <div class="mt-4 flex items-center justify-between">
                    <div class="text-sm text-gray-600">Menampilkan {{ $letters->firstItem() ?? 0 }} - {{ $letters->lastItem() ?? 0 }} dari {{ $letters->total() ?? 0 }}</div>
                    <div>{{ $letters->withQueryString()->links() }}</div>
                </div>

                <script>
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
                                if (!any) { alert('Pilih minimal satu surat.'); return; }
                                if (!confirm('Hapus surat yang dipilih? Tindakan ini tidak dapat dibatalkan.')) return;
                                bulkForm.submit();
                            });
                        }
                    })();
                </script>
                </div>

                <div class="mt-4 flex items-center justify-between">
                    <div class="text-sm text-gray-600">Menampilkan {{ $letters->firstItem() ?? 0 }} - {{ $letters->lastItem() ?? 0 }} dari {{ $letters->total() ?? 0 }}</div>
                    <div>{{ $letters->withQueryString()->links() }}</div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
