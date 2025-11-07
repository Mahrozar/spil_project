<x-app-layout>
    <div class="p-6">
        <div class="max-w-3xl mx-auto bg-white shadow rounded-lg p-6">
            <h2 class="text-xl font-semibold mb-4">Edit Letter #{{ $letter->id }}</h2>

            <form method="POST" action="{{ route('admin.letters.update', $letter) }}">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Status</label>
                        <select name="status" class="mt-1 block w-full border rounded-md px-3 py-2">
                            <option value="pending" {{ $letter->status === 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="approved" {{ $letter->status === 'approved' ? 'selected' : '' }}>Approved</option>
                            <option value="rejected" {{ $letter->status === 'rejected' ? 'selected' : '' }}>Rejected</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Description</label>
                        <textarea class="mt-1 block w-full border rounded-md px-3 py-2" rows="4" disabled>{{ $letter->description }}</textarea>
                    </div>
                </div>

                <div class="mt-6 flex items-center gap-2">
                    <a href="{{ route('admin.letters') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 rounded">Cancel</a>
                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white rounded">Save</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
