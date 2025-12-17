<x-app-layout>
    <div class="p-6">
        <div class="max-w-3xl mx-auto bg-white shadow rounded-lg p-6">
            <h2 class="text-xl font-semibold mb-4">Pengajuan {{ $submission->submission_number }}</h2>

            <div class="grid grid-cols-1 gap-4">
                <div>
                    <div class="text-sm text-gray-500">Nama</div>
                    <div class="font-medium">{{ $submission->nama }}</div>
                </div>

                <div>
                    <div class="text-sm text-gray-500">Jenis Surat</div>
                    <div class="font-medium">{{ $submission->jenis_surat }}</div>
                </div>

                <div>
                    <div class="text-sm text-gray-500">NIK</div>
                    <div class="font-medium">{{ $submission->nik }}</div>
                </div>

                <div>
                    <div class="text-sm text-gray-500">Alamat</div>
                    <div class="mt-2 text-gray-700">{{ $submission->alamat }}</div>
                </div>

                <div>
                    <div class="text-sm text-gray-500">Keperluan</div>
                    <div class="mt-2 text-gray-700">{{ $submission->keperluan }}</div>
                </div>

                <div>
                    <div class="text-sm text-gray-500">Telepon</div>
                    <div class="font-medium">{{ $submission->telepon }}</div>
                </div>

                <div>
                    <div class="text-sm text-gray-500">Status</div>
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
                    <div class="font-medium flex items-center gap-3"><span class="w-3 h-3 rounded-full {{ $dot }}"></span><span class="{{ $submission->badgeClass() }}">{{ $submission->statusLabel() }}</span></div>
                </div>

                <div>
                    <div class="text-sm text-gray-500">Dibuat pada</div>
                    <div class="font-medium">{{ $submission->created_at->toDayDateTimeString() }}</div>
                </div>
            </div>

            <div class="mt-6 flex flex-wrap items-center gap-3">
                <a href="{{ route('admin.submissions.index') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-white border border-primary text-primary rounded-lg shadow-sm hover:bg-primary hover:text-white transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                    Kembali
                </a>

                <a href="{{ route('admin.submissions.edit', $submission) }}" class="inline-flex items-center gap-2 px-4 py-2 bg-emerald-600 text-white rounded-lg shadow-sm hover:bg-emerald-700 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5h6M5 11h6m-6 6h6"/></svg>
                    Ubah
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
