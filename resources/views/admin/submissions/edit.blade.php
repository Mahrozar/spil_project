<x-app-layout>
    <div class="p-6">
        <div class="max-w-3xl mx-auto bg-white shadow rounded-lg p-6">
            <h2 class="text-xl font-semibold mb-4">Ubah Pengajuan {{ $submission->submission_number }}</h2>

            <form method="POST" action="{{ route('admin.submissions.update', $submission) }}">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Status</label>
                        <select name="status" class="mt-1 block w-full border rounded-md px-3 py-2">
                            @foreach(\App\Models\LetterSubmission::allowedStatuses() as $st)
                                <option value="{{ $st }}" {{ $submission->status === $st ? 'selected' : '' }}>{{ $st }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Keperluan</label>
                        <textarea class="mt-1 block w-full border rounded-md px-3 py-2" rows="4" disabled>{{ $submission->keperluan }}</textarea>
                    </div>
                </div>

                <div class="mt-6 flex items-center gap-2">
                    <a href="{{ route('admin.submissions.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 rounded">Batal</a>
                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
