<x-app-layout>
    @include('admin.partials.sidebar')
    <div class="admin-content-area">
    <div class="max-w-2xl mx-auto p-6">
        <h2 class="text-lg font-semibold mb-4">Buat RW</h2>

        <form method="POST" action="{{ route('admin.rws.store') }}">
            @csrf
            <div class="grid gap-4">
                <div>
                    <label class="block text-sm">Name</label>
                    <input name="name" required class="w-full border rounded px-3 py-2" value="{{ old('name') }}" />
                </div>
                <div class="flex gap-2">
                    <a href="{{ route('admin.rws.index') }}" class="px-3 py-2 bg-gray-200 rounded">Batal</a>
                    <button class="px-3 py-2 bg-blue-600 text-white rounded">Buat</button>
                </div>
            </div>
        </form>
    </div>
    </div>
</x-app-layout>
