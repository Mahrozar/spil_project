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
                    <div class="font-medium"><span class="{{ $submission->badgeClass() }}">{{ $submission->statusLabel() }}</span></div>
                </div>

                <div>
                    <div class="text-sm text-gray-500">Dibuat pada</div>
                    <div class="font-medium">{{ $submission->created_at->toDayDateTimeString() }}</div>
                </div>
            </div>

            <div class="mt-6 flex items-center gap-2">
                <a href="{{ route('admin.submissions.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 rounded">Kembali</a>
                <a href="{{ route('admin.submissions.edit', $submission) }}" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded">Ubah</a>
            </div>
        </div>
    </div>
</x-app-layout>
