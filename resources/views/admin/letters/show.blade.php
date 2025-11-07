<x-app-layout>
    <div class="p-6">
        <div class="max-w-3xl mx-auto bg-white shadow rounded-lg p-6">
            <h2 class="text-xl font-semibold mb-4">Letter #{{ $letter->id }}</h2>

            <div class="grid grid-cols-1 gap-4">
                <div>
                    <div class="text-sm text-gray-500">User</div>
                    <div class="font-medium">{{ $letter->user->name ?? '-' }} &lt;{{ $letter->user->email ?? '' }}&gt;</div>
                </div>

                <div>
                    <div class="text-sm text-gray-500">Type</div>
                    <div class="font-medium">{{ $letter->type }}</div>
                </div>

                <div>
                    <div class="text-sm text-gray-500">Status</div>
                    <div class="font-medium">{{ ucfirst($letter->status) }}</div>
                </div>

                <div>
                    <div class="text-sm text-gray-500">Description</div>
                    <div class="mt-2 text-gray-700">{{ $letter->description }}</div>
                </div>

                <div>
                    <div class="text-sm text-gray-500">Created at</div>
                    <div class="font-medium">{{ $letter->created_at->toDayDateTimeString() }}</div>
                </div>
            </div>

            <div class="mt-6 flex items-center gap-2">
                <a href="{{ route('admin.letters') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 rounded">Back</a>
                <a href="{{ route('admin.letters.edit', $letter) }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white rounded">Edit</a>
            </div>
        </div>
    </div>
</x-app-layout>
