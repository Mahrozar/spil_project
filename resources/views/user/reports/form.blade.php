<x-app-layout>
    <div class="bg-white shadow rounded-lg p-6">
        <h1 class="text-xl font-semibold text-gray-800">{{ isset($report) ? 'Edit Report' : 'New Report' }}</h1>

        <form method="POST" action="{{ isset($report) ? route('user.reports.update', $report) : route('user.reports.store') }}" enctype="multipart/form-data">
            @csrf
            @if(isset($report))
                @method('PUT')
            @endif

                <div class="mt-4">
                    <label class="block text-sm font-medium text-gray-700">Category</label>
                    <input name="category" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500" value="{{ old('category', $report->category ?? '') }}" required />
                </div>

                <div class="mt-4">
                    <label class="block text-sm font-medium text-gray-700">Location</label>
                    <input name="location" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500" value="{{ old('location', $report->location ?? '') }}" />
                </div>

                <div class="mt-4">
                    <label class="block text-sm font-medium text-gray-700">Photo</label>
                    <input type="file" name="photo" class="mt-1 block w-full" />
                    @if(!empty($report->photo))
                        <div class="mt-2"><img src="{{ asset('storage/' . $report->photo) }}" alt="photo" class="max-w-xs rounded-md" /></div>
                    @endif
                </div>

                <div class="mt-4">
                    <label class="block text-sm font-medium text-gray-700">Description</label>
                    <textarea name="description" rows="4" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500">{{ old('description', $report->description ?? '') }}</textarea>
                </div>

                <div class="mt-6">
                    <button class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-white hover:bg-indigo-500 focus:outline-none">Submit</button>
                </div>
            </form>
        </div>
</x-app-layout>
