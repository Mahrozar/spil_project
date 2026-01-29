@extends('layouts.app')

@section('title', 'Pengajuan Surat Online')

@section('content')
<div class="admin-content-area">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Header -->
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
                            <button type="submit" class="absolute right-1 top-1/2 -translate-y-1/2 px-2 py-1 bg-primary text-white rounded-md text-xs">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </form>
                    <a href="{{ route('admin.dashboard') }}" class="ml-2 inline-flex items-center gap-2 px-3 py-2 bg-white border border-primary text-primary rounded-lg shadow-sm hover:bg-primary hover:text-white transition"> 
                        <i class="fas fa-arrow-left"></i>
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

        <!-- Daftar Pengajuan -->
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <div class="p-6 bg-gradient-to-r from-purple-600 to-indigo-600 text-white rounded-t-lg">
                <h3 class="text-xl font-semibold text-center mb-2">Daftar Pengajuan</h3>
                <p class="text-sm text-purple-100 text-center">Tinjau dan kelola pengajuan surat dari masyarakat</p>
            </div>

            <div class="p-6">
                <div class="overflow-x-auto">
                    <table class="w-full border-collapse text-sm">
                        <thead>
                            <tr class="bg-purple-50 border-b border-purple-100">
                                <th class="px-4 py-3 text-left font-medium text-purple-800">No</th>
                                <th class="px-4 py-3 text-left font-medium text-purple-800">Kode</th>
                                <th class="px-4 py-3 text-left font-medium text-purple-800">Nama Pemohon</th>
                                <th class="px-4 py-3 text-left font-medium text-purple-800">Jenis Surat</th>
                                <th class="px-4 py-3 text-left font-medium text-purple-800">Kontak</th>
                                <th class="px-4 py-3 text-left font-medium text-purple-800">Status</th>
                                <th class="px-4 py-3 text-left font-medium text-purple-800">Aksi</th>
                            </tr>
                        </thead>

                        <tbody class="bg-white">
                            @forelse($submissions as $s)
                                <tr class="hover:bg-purple-50/30 transition-colors border-b border-gray-100">
                                    <td class="px-4 py-3">
                                        {{ $loop->iteration + ($submissions->currentPage()-1) * $submissions->perPage() }}
                                    </td>
                                    <td class="px-4 py-3 font-mono text-xs text-gray-600">
                                        {{ $s->submission_number }}
                                    </td>
                                    <td class="px-4 py-3">
                                        <div class="font-medium text-gray-800">{{ $s->nama }}</div>
                                        <div class="text-xs text-gray-500 mt-1">
                                            <i class="fas fa-id-card mr-1"></i>
                                            NIK: {{ $s->nik }}
                                        </div>
                                    </td>
                                    <td class="px-4 py-3 text-gray-700">
                                        <div class="flex items-center">
                                            <i class="fas fa-envelope text-purple-400 mr-2"></i>
                                            {{ Str::limit($s->jenis_surat ?? $s->nama_surat ?? '-', 60) }}
                                        </div>
                                    </td>
                                    <td class="px-4 py-3 text-sm">
                                        <div class="mb-1">
                                            <i class="fas fa-phone text-gray-400 mr-2"></i>
                                            {{ $s->telepon }}
                                        </div>
                                        @if($s->email)
                                        <div class="text-xs text-gray-500">
                                            <i class="fas fa-envelope text-gray-400 mr-2"></i>
                                            {{ $s->email }}
                                        </div>
                                        @endif
                                    </td>
                                    <td class="px-4 py-3">
                                        <span class="{{ $s->badgeClass() }} inline-flex items-center px-3 py-1 rounded-full text-xs font-medium">
                                            @if($s->status == 'approve')
                                                <i class="fas fa-check-circle mr-1.5"></i>
                                            @elseif($s->status == 'pending')
                                                <i class="fas fa-clock mr-1.5"></i>
                                            @elseif($s->status == 'on progres')
                                                <i class="fas fa-sync-alt mr-1.5"></i>
                                            @elseif($s->status == 'rejected')
                                                <i class="fas fa-times-circle mr-1.5"></i>
                                            @endif
                                            {{ $s->statusLabel() }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-3">
                                        <div class="flex gap-2 items-center">
                                            <a href="{{ route('admin.submissions.edit', $s) }}" 
                                               class="inline-flex items-center px-3 py-1.5 text-xs bg-emerald-500 text-white rounded-lg hover:bg-emerald-600 transition-colors"
                                               title="Edit">
                                                <i class="fas fa-edit mr-1"></i>
                                                Edit
                                            </a>
                                            <a href="{{ route('admin.submissions.show', $s) }}" 
                                               class="inline-flex items-center px-3 py-1.5 text-xs bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition-colors"
                                               title="Lihat Detail">
                                                <i class="fas fa-eye mr-1"></i>
                                                Lihat
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="px-4 py-8 text-center">
                                        <i class="fas fa-inbox text-4xl text-gray-300 mb-3"></i>
                                        <p class="text-gray-500">Belum ada pengajuan surat</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if($submissions->count() > 0)
                <div class="mt-6 flex flex-col sm:flex-row items-center justify-between">
                    <div class="text-sm text-gray-600 mb-4 sm:mb-0">
                        <i class="fas fa-list mr-1"></i>
                        Menampilkan {{ $submissions->firstItem() ?? 0 }} - {{ $submissions->lastItem() ?? 0 }} dari {{ $submissions->total() ?? 0 }} pengajuan
                    </div>
                    <div class="flex items-center">
                        {{ $submissions->links() }}
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection