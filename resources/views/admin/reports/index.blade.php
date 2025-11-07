<x-app-layout>
    <div class="bg-white shadow rounded-lg overflow-hidden">
        <div class="px-6 py-4 border-b">
            <h2 class="text-lg font-semibold text-gray-800">Infrastructure Reports</h2>
        </div>
        <div class="p-4">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">User</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Category</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Location</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Created</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($reports as $report)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $report->id }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $report->user->name ?? '-' }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $report->category }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $report->location }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm"> <span class="inline-flex px-2 text-xs font-semibold leading-5 rounded-full {{ $report->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : ($report->status === 'resolved' ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800') }}">{{ ucfirst($report->status) }}</span></td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $report->created_at->format('Y-m-d') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-4">{{ $reports->links() }}</div>
        </div>
    </div>
</x-app-layout>
