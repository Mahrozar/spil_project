<x-app-layout>
    <div class="p-6">
        <div class="max-w-7xl mx-auto">
            <div class="bg-white rounded-lg shadow p-6 mb-6">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                    <div>
                        <h2 class="text-2xl font-bold text-slate-700">Pengajuan Surat Online</h2>
                        <p class="text-sm text-slate-500">Kelola pengajuan surat yang masuk dari masyarakat desa.</p>
                    </div>

                    <div class="flex items-center gap-3">
                        <form method="GET" action="{{ route('admin.submissions.index') }}" class="flex items-center">
                            <label for="q" class="sr-only">Cari</label>
                            <div class="relative">
                                <input id="q" type="text" name="q" value="{{ request('q') }}" placeholder="Cari nomor, nama, NIK atau jenis" class="px-3 py-2 border rounded-md text-sm w-64 focus:outline-none focus:ring-2 focus:ring-primary" />
                                <button type="submit" class="absolute right-1 top-1/2 -translate-y-1/2 px-2 py-1 bg-primary text-white rounded-md text-xs">Cari</button>
                            </div>
                        </form>
                        <a href="{{ route('admin.dashboard') }}" class="ml-2 inline-flex items-center gap-2 px-3 py-2 bg-white border border-primary text-primary rounded-lg shadow-sm hover:bg-primary hover:text-white transition"> 
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                            Kembali
                        </a>
                    </div>
                </div>

                <div class="mt-4 grid grid-cols-2 sm:grid-cols-5 gap-3">
                    @php
                        $total = \App\Models\LetterSubmission::count();
                        $approved = \App\Models\LetterSubmission::where('status','approve')->count();
                        $pending = \App\Models\LetterSubmission::where('status','pending')->count();
                        $onprogres = \App\Models\LetterSubmission::where('status','on progres')->count();
                        $rejected = \App\Models\LetterSubmission::where('status','rejected')->count();
                    @endphp
                    <div class="p-3 bg-slate-50 rounded-md text-center">
                        <div class="text-xs text-slate-500">Total</div>
                        <div class="text-lg font-semibold text-slate-700">{{ $total }}</div>
                    </div>
                    <div class="p-3 bg-emerald-50 rounded-md text-center">
                        <div class="text-xs text-slate-500">Disetujui</div>
                        <div class="text-lg font-semibold text-emerald-700">{{ $approved }}</div>
                    </div>
                    <div class="p-3 bg-yellow-50 rounded-md text-center">
                        <div class="text-xs text-slate-500">Menunggu</div>
                        <div class="text-lg font-semibold text-yellow-600">{{ $pending }}</div>
                    </div>
                    <div class="p-3 bg-indigo-50 rounded-md text-center">
                        <div class="text-xs text-slate-500">Proses</div>
                        <div class="text-lg font-semibold text-indigo-700">{{ $onprogres }}</div>
                    </div>
                    <div class="p-3 bg-rose-50 rounded-md text-center">
                        <div class="text-xs text-slate-500">Ditolak</div>
                        <div class="text-lg font-semibold text-rose-700">{{ $rejected }}</div>
                    </div>
                </div>
            </div>

            <div class="bg-purple-50 rounded-lg shadow-lg overflow-hidden">
                <div class="p-6 bg-white rounded-t-lg">
                    <h3 class="text-xl font-semibold text-gray-700 text-center mb-3">Daftar Pengajuan</h3>
                    <p class="text-sm text-gray-500 text-center">Tinjau dan kelola pengajuan surat dari masyarakat</p>
                </div>

                <div class="p-6">
                    <div class="overflow-x-auto">
                        <table class="w-full table-fixed border-collapse text-sm">
                            <thead>
                                <tr class="bg-purple-600 text-white">
                                    <th class="w-10 px-4 py-3 border-r border-purple-500">No</th>
                                    <th class="w-40 px-4 py-3 border-r border-purple-500">Kode</th>
                                    <th class="px-4 py-3 border-r border-purple-500">Nama Pemohon</th>
                                    <th class="px-4 py-3 border-r border-purple-500">Jenis Surat</th>
                                    <th class="w-48 px-4 py-3 border-r border-purple-500">Kontak</th>
                                    <th class="w-36 px-4 py-3 border-r border-purple-500">Status</th>
                                    <th class="w-36 px-4 py-3">Aksi</th>
                                </tr>
                            </thead>

                            <tbody class="bg-white">
                                @foreach($submissions as $s)
                                    <tr class="even:bg-purple-50/40">
                                        <td class="px-4 py-3 text-center border-b border-gray-100">{{ $loop->iteration + ($submissions->currentPage()-1) * $submissions->perPage() }}</td>
                                        <td class="px-4 py-3 border-b border-gray-100 font-mono text-xs">{{ $s->submission_number }}</td>
                                        <td class="px-4 py-3 border-b border-gray-100">
                                            <div class="font-medium">{{ $s->nama }}</div>
                                            <div class="text-xs text-gray-400">NIK: {{ $s->nik }}</div>
                                        </td>
                                        <td class="px-4 py-3 border-b border-gray-100">{{ Str::limit($s->jenis_surat ?? $s->nama_surat ?? '-', 60) }}</td>
                                        <td class="px-4 py-3 border-b border-gray-100 text-sm">{{ $s->telepon }}<div class="text-xs text-gray-400">{{ $s->email ?? '' }}</div></td>
                                        <td class="px-4 py-3 border-b border-gray-100">
                                            <span class="{{ $s->badgeClass() }}">{{ $s->statusLabel() }}</span>
                                        </td>
                                        <td class="px-4 py-3 border-b border-gray-100">
                                            <div class="flex gap-2 items-center">
                                                <a href="{{ route('admin.submissions.edit', $s) }}" class="inline-block px-3 py-1 text-xs bg-emerald-500 text-white rounded-full hover:bg-emerald-600">Edit</a>
                                                <a href="{{ route('admin.submissions.show', $s) }}" class="inline-block px-3 py-1 text-xs bg-sky-500 text-white rounded-full hover:bg-sky-600">Lihat</a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-4 flex items-center justify-between">
                        <div class="text-xs text-gray-500">Menampilkan {{ $submissions->firstItem() ?? 0 }} - {{ $submissions->lastItem() ?? 0 }} dari {{ $submissions->total() ?? 0 }} pengajuan</div>
                        <div>
                            {{ $submissions->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
