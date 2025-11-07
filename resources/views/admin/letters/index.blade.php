@push('styles')
    @vite(['resources/css/admin.css', 'resources/js/admin.js'])
@endpush

<x-app-layout>
    <div class="dashboard-frame">
        <div class="mb-4 flex items-center justify-between">
            <div>
                <h2 class="text-2xl font-semibold text-gray-800">Letters</h2>
                <p class="text-sm text-gray-500">Manage all submitted letters — filter, view and change status.</p>
            </div>

            <div class="flex items-center gap-3">
                <form method="GET" action="{{ route('admin.letters') }}" class="flex items-center">
                    <input type="search" name="q" value="{{ request('q') }}" placeholder="Search by user or type" class="border rounded-md px-3 py-2 text-sm" />
                    <button type="submit" class="ml-2 inline-flex items-center px-3 py-2 bg-indigo-600 text-white rounded-md text-sm">Search</button>
                </form>

                <a href="{{ route('user.letters.create') }}" class="inline-flex items-center px-4 py-2 bg-green-600 text-white rounded-md text-sm">Create Letter</a>
            </div>
        </div>

        <div class="bg-white shadow rounded-lg overflow-hidden">
            <div class="p-4">
                <div class="mb-3 flex items-center justify-between">
                    <div class="text-sm text-gray-600">Bulk actions: select letters then delete.</div>
                    <div class="flex items-center gap-2">
                        <button id="bulkDeleteBtn" type="button" class="inline-flex items-center px-3 py-2 bg-red-600 text-white rounded-md text-sm">Delete selected</button>
                    </div>
                </div>

                <form id="bulkForm" method="POST" action="{{ route('admin.letters.bulkDestroy') }}">
                    @csrf
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-4 py-3">
                                    <input type="checkbox" id="select_all" class="h-4 w-4 text-indigo-600 border-gray-300 rounded" />
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">User</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Type</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Created</th>
                                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Action</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($letters as $letter)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-4 whitespace-nowrap">
                                    <input type="checkbox" name="ids[]" value="{{ $letter->id }}" class="row-checkbox h-4 w-4 text-indigo-600 border-gray-300 rounded" />
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
                                        $statusClass = $letter->status === 'pending' ? 'bg-yellow-50 text-yellow-800' : ($letter->status === 'approved' ? 'bg-green-50 text-green-800' : 'bg-gray-50 text-gray-800');
                                    @endphp
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium {{ $statusClass }}">{{ ucfirst($letter->status) }}</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $letter->created_at->format('Y-m-d') }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm">
                                    <a href="{{ route('admin.letters.show', $letter) }}" class="text-indigo-600 hover:text-indigo-900 mr-2" title="View">
                                        <!-- Eye icon -->
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline" viewBox="0 0 20 20" fill="currentColor"><path d="M10 3C5 3 1.2 6.3.2 10c1 3.7 4.8 7 9.8 7s8.8-3.3 9.8-7C18.8 6.3 15 3 10 3zM10 15a5 5 0 110-10 5 5 0 010 10z"/></svg>
                                    </a>
                                    <a href="{{ route('admin.letters.edit', $letter) }}" class="text-yellow-500 hover:text-yellow-700 mr-2" title="Edit">
                                        <!-- Pencil icon -->
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline" viewBox="0 0 20 20" fill="currentColor"><path d="M17.414 2.586a2 2 0 010 2.828L8.828 14H6v-2.828l8.586-8.586a2 2 0 012.828 0z"/></svg>
                                    </a>
                                    <form action="{{ route('admin.letters.destroy', $letter) }}" method="POST" class="inline">@csrf @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-800" title="Delete">
                                            <!-- Trash icon -->
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H3a1 1 0 100 2h14a1 1 0 100-2h-2V3a1 1 0 00-1-1H6zm3 6a1 1 0 00-2 0v6a1 1 0 002 0V8zm4 0a1 1 0 10-2 0v6a1 1 0 102 0V8z" clip-rule="evenodd"/></svg>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="px-6 py-12 text-center text-gray-500">No letters found. Try adjusting your filters or create a new letter.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                    </div>
                </form>

                <div class="mt-4 flex items-center justify-between">
                    <div class="text-sm text-gray-600">Displaying {{ $letters->firstItem() ?? 0 }} - {{ $letters->lastItem() ?? 0 }} of {{ $letters->total() ?? 0 }}</div>
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
                                if (!any) { alert('Please select at least one letter.'); return; }
                                if (!confirm('Delete selected letters? This action cannot be undone.')) return;
                                bulkForm.submit();
                            });
                        }
                    })();
                </script>
                </div>

                <div class="mt-4 flex items-center justify-between">
                    <div class="text-sm text-gray-600">Displaying {{ $letters->firstItem() ?? 0 }} - {{ $letters->lastItem() ?? 0 }} of {{ $letters->total() ?? 0 }}</div>
                    <div>{{ $letters->withQueryString()->links() }}</div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
