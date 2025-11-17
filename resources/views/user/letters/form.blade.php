<x-app-layout>
    <div class="bg-white shadow rounded-lg p-6">
    <h1 class="text-xl font-semibold text-gray-800">{{ isset($letter) ? 'Ubah Surat' : 'Surat Baru' }}</h1>

        <form method="POST" action="{{ isset($letter) ? route('user.letters.update', $letter) : route('user.letters.store') }}"> 
            @csrf
            @if(isset($letter))
                @method('PUT')
            @endif

            <div class="mt-4">
                <label class="block text-sm font-medium text-gray-700">Jenis</label>
                <input name="type" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500" value="{{ old('type', $letter->type ?? '') }}" required />
            </div>

            <div class="mt-4">
                <label class="block text-sm font-medium text-gray-700">Deskripsi</label>
                <textarea name="description" rows="4" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500">{{ old('description', $letter->description ?? '') }}</textarea>
            </div>

                <div class="mt-6">
                <button class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-white hover:bg-indigo-500 focus:outline-none">Kirim</button>
            </div>
        </form>
    </div>
</x-app-layout>
