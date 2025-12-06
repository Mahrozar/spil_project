<x-app-layout>
    <div class="admin-content-area">
    <div class="admin-content-area">
    <div class="max-w-7xl mx-auto p-6">
        <div class="flex items-center justify-between mb-4">
            <div>
                <h2 class="text-xl font-semibold">Penduduk</h2>
                <p class="text-sm text-gray-500">Kelola data penduduk (RT/RW).</p>
            </div>
            <div class="flex items-center gap-3">
                <a href="{{ route('admin.residents.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded shadow hover:bg-blue-700">Penduduk Baru</a>

                <form method="POST" action="{{ route('admin.residents.import') }}" enctype="multipart/form-data" class="flex items-center gap-3" id="importForm">
                    @csrf
                    <div class="flex items-center gap-2">
                        <label for="residentFile" class="inline-flex items-center px-3 py-2 bg-white border rounded text-sm text-gray-700 cursor-pointer shadow-sm">Pilih file</label>
                        <input id="residentFile" type="file" name="file" accept=".csv, .xlsx, .xls" class="sr-only" />
                        <span id="fileName" class="text-sm text-gray-700">Belum ada file dipilih</span>
                        <span id="fileError" class="ml-3 text-sm text-red-600 hidden"></span>
                    </div>
                    <button id="uploadBtn" type="submit" class="px-3 py-2 bg-green-600 text-white rounded font-medium disabled:opacity-50 hover:bg-green-700 shadow" disabled>Unggah</button>
                </form>

                <a href="{{ route('admin.residents.export') }}" class="inline-flex items-center px-3 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 shadow">Export</a>
            </div>
        </div>

        <div class="bg-white shadow rounded overflow-hidden">
            @if(session('import_summary'))
            <div class="p-4 border-b">
                <div class="rounded-md bg-green-50 p-3 text-sm text-green-800">
                    <strong>Ringkasan Import:</strong>
                    Dibuat: {{ session('import_summary.created') ?? session('import_summary')['created'] ?? '—' }},
                    Diperbarui: {{ session('import_summary.updated') ?? session('import_summary')['updated'] ?? '—' }},
                    Dilewati: {{ session('import_summary.skipped') ?? session('import_summary')['skipped'] ?? '—' }}.
                    @if(session('import_summary.file'))
                        File: <em>{{ session('import_summary.file') }}</em>.
                    @endif
                </div>
            </div>
            @endif
            <div class="p-4 border-b">
                <form method="GET" class="flex gap-2">
                    <input type="search" name="q" value="{{ request('q') }}" placeholder="Cari nama / NIK" class="border rounded px-3 py-2" />
                    <button class="px-3 py-2 bg-blue-600 text-white rounded">Cari</button>
                </form>
            </div>

            <div class="p-4 overflow-x-auto">
                <table class="min-w-full divide-y">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-2 text-left text-sm">NIK</th>
                            <th class="px-4 py-2 text-left text-sm">Nama</th>
                            <th class="px-4 py-2 text-left text-sm">RT / RW</th>
                            <th class="px-4 py-2 text-left text-sm">Telepon</th>
                            <th class="px-4 py-2 text-right text-sm">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y">
                        @foreach($residents as $r)
                        <tr>
                            <td class="px-4 py-2 text-sm">{{ $r->nik }}</td>
                            <td class="px-4 py-2 text-sm">{{ $r->name }}</td>
                            <td class="px-4 py-2 text-sm">{{ $r->rt->name ?? '-' }} / {{ $r->rw->name ?? '-' }}</td>
                            <td class="px-4 py-2 text-sm">{{ $r->phone }}</td>
                            <td class="px-4 py-2 text-right text-sm">
                                <a href="{{ route('admin.residents.show', $r) }}" class="text-blue-600 mr-2">Lihat</a>
                                <a href="{{ route('admin.residents.edit', $r) }}" class="text-yellow-600 mr-2">Ubah</a>
                                <form action="{{ route('admin.residents.destroy', $r) }}" method="POST" class="inline">@csrf @method('DELETE')<button class="text-red-600">Hapus</button></form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="p-4">{{ $residents->withQueryString()->links() }}</div>
        </div>
    </div>
    </div>
    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function(){
            const fileInput = document.getElementById('residentFile');
            const fileName = document.getElementById('fileName');
            const uploadBtn = document.getElementById('uploadBtn');
            const label = document.querySelector('label[for="residentFile"]');

            if (!fileInput) return;

            // When clicking the visible label, it will open file chooser automatically because of for="residentFile"
            const fileError = document.getElementById('fileError');
            const allowed = ['csv','xlsx','xls'];
            const maxBytes = 10 * 1024 * 1024; // 10MB

            fileInput.addEventListener('change', function(e){
                const f = e.target.files && e.target.files[0];
                fileError.classList.add('hidden');
                fileError.textContent = '';
                if (f) {
                    // validate extension
                    const parts = f.name.split('.');
                    const ext = parts.length > 1 ? parts.pop().toLowerCase() : '';
                    if (! allowed.includes(ext)) {
                        fileName.textContent = 'Tipe file tidak didukung';
                        fileError.textContent = 'Hanya file .csv, .xlsx, .xls yang diperbolehkan.';
                        fileError.classList.remove('hidden');
                        uploadBtn.disabled = true;
                        return;
                    }

                    // validate size
                    if (f.size > maxBytes) {
                        fileName.textContent = 'File terlalu besar';
                        fileError.textContent = 'Ukuran file maksimal 10 MB.';
                        fileError.classList.remove('hidden');
                        uploadBtn.disabled = true;
                        return;
                    }

                    // ok
                    fileName.textContent = f.name;
                    fileError.classList.add('hidden');
                    uploadBtn.disabled = false;
                } else {
                    fileName.textContent = 'No file chosen';
                    uploadBtn.disabled = true;
                }
            });

            // prevent form submit if uploadBtn disabled (extra safeguard)
            const importForm = document.getElementById('importForm');
            if (importForm) {
                importForm.addEventListener('submit', function(e){
                    if (uploadBtn.disabled) {
                        e.preventDefault();
                        fileError.classList.remove('hidden');
                        fileError.textContent = fileError.textContent || 'Pilih file yang valid sebelum mengunggah.';
                    }
                });
            }

            // Optional: show filename if user cancels or reopens
            // Accessibility: allow keyboard to focus label
            if (label) {
                label.addEventListener('keydown', function(e){
                    if (e.key === 'Enter' || e.key === ' ') {
                        e.preventDefault();
                        fileInput.click();
                    }
                });
            }
        });
    </script>
    @endpush
</x-app-layout>
