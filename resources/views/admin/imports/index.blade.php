<x-app-layout>
    <div class="max-w-7xl mx-auto p-6">
        <h2 class="text-xl font-semibold mb-3">Import Logs</h2>
        <p class="text-sm text-gray-500 mb-4">Daftar ringkasan import yang tersimpan di server (storage/app/imports).</p>

        <div class="bg-white shadow rounded overflow-hidden">
            <div class="p-4">
                @if(empty($summaries))
                    <div class="text-sm text-gray-600">Belum ada import yang tersimpan.</div>
                @else
                    <table class="min-w-full divide-y">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-4 py-2 text-left text-sm">File</th>
                                <th class="px-4 py-2 text-left text-sm">User ID</th>
                                <th class="px-4 py-2 text-left text-sm">Dibuat</th>
                                <th class="px-4 py-2 text-left text-sm">Created</th>
                                <th class="px-4 py-2 text-right text-sm">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y">
                            @foreach($summaries as $s)
                            <tr>
                                <td class="px-4 py-2 text-sm">{{ $s['file'] }}</td>
                                <td class="px-4 py-2 text-sm">{{ $s['summary']['user_id'] ?? '-' }}</td>
                                <td class="px-4 py-2 text-sm">{{ $s['summary']['timestamp'] ?? '-' }}</td>
                                <td class="px-4 py-2 text-sm">Created: {{ $s['summary']['created'] ?? '-' }} / Updated: {{ $s['summary']['updated'] ?? '-' }} / Skipped: {{ $s['summary']['skipped'] ?? '-' }}</td>
                                <td class="px-4 py-2 text-right text-sm">
                                    <a href="{{ route('imports.download', ['file' => $s['file']]) }}" class="px-3 py-2 bg-blue-600 text-white rounded">Download</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
