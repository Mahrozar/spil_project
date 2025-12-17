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
                        @php
                            if($submission->isApproved()) {
                                $dot = 'bg-emerald-500';
                            } elseif($submission->isInProgress()) {
                                $dot = 'bg-yellow-400';
                            } elseif($submission->isRejected()) {
                                $dot = 'bg-rose-500';
                            } else {
                                $dot = 'bg-gray-400';
                            }
                        @endphp
                        <div class="mt-1 flex items-center gap-3">
                            <select name="status" class="block w-full border rounded-md px-3 py-2">
                                @foreach(\App\Models\LetterSubmission::allowedStatuses() as $st)
                                    <option value="{{ $st }}" {{ $submission->status === $st ? 'selected' : '' }}>{{ $st }}</option>
                                @endforeach
                            </select>
                            <span class="w-3 h-3 rounded-full {{ $dot }}"></span>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Keperluan</label>
                        <textarea class="mt-1 block w-full border rounded-md px-3 py-2" rows="4" disabled>{{ $submission->keperluan }}</textarea>
                    </div>
                </div>

                <div class="mt-6 flex items-center gap-3">
                    <a href="{{ route('admin.submissions.index') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-white border border-slate-200 text-slate-700 rounded-lg hover:bg-slate-50 transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                        Batal
                    </a>

                    <button id="btn-save" aria-label="Simpan perubahan" type="submit" class="ml-auto inline-flex items-center gap-2 px-4 py-2 bg-primary text-white rounded-lg shadow-md hover:bg-secondary transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
