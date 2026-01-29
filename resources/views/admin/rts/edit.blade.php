@extends('layouts.app')

@section('title', 'Edit RT - ' . $rt->name)

@section('breadcrumb')
<nav class="mb-6" aria-label="Breadcrumb">
    <ol class="flex items-center space-x-2 text-sm">
        <li>
            <a href="{{ route('admin.dashboard') }}" class="text-gray-400 hover:text-gray-600">
                <i class="fas fa-home"></i> Dashboard
            </a>
        </li>
        <li class="flex items-center">
            <i class="fas fa-chevron-right text-gray-400 text-xs"></i>
            <a href="{{ route('admin.rts.index') }}" class="ml-2 text-gray-400 hover:text-gray-600">
                <i class="fas fa-list mr-1"></i> Daftar RT
            </a>
        </li>
        <li class="flex items-center">
            <i class="fas fa-chevron-right text-gray-400 text-xs"></i>
            <a href="{{ route('admin.rts.show', $rt) }}" class="ml-2 text-gray-400 hover:text-gray-600">
                <i class="fas fa-eye mr-1"></i> {{ $rt->name }}
            </a>
        </li>
        <li class="flex items-center">
            <i class="fas fa-chevron-right text-gray-400 text-xs"></i>
            <span class="ml-2 text-gray-600 font-medium">
                <i class="fas fa-edit mr-1"></i> Edit
            </span>
        </li>
    </ol>
</nav>
@endsection

@section('content')
<div class="admin-content-area">
    <div class="max-w-4xl mx-auto px-4 py-8">
        <!-- Header -->
        <div class="mb-8">
            <div class="md:flex md:items-center md:justify-between">
                <div class="flex-1 min-w-0">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 h-12 w-12 flex items-center justify-center bg-blue-100 rounded-lg mr-4">
                            <span class="text-blue-600 font-bold text-lg">{{ substr($rt->name, 2) }}</span>
                        </div>
                        <div>
                            <h1 class="text-2xl font-bold text-gray-900">
                                Edit {{ $rt->name }}
                            </h1>
                            <p class="mt-1 text-sm text-gray-500">
                                Perbarui informasi Rukun Tetangga
                                <br>
                                <span class="text-xs">Dibuat: {{ $rt->created_at->format('d M Y, H:i') }}</span>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="mt-4 flex md:mt-0 space-x-3">
                    <a href="{{ route('admin.rts.show', $rt) }}" 
                       class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        <i class="fas fa-eye mr-2"></i>
                        Lihat Detail
                    </a>
                    <a href="{{ route('admin.rts.index') }}" 
                       class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        <i class="fas fa-arrow-left mr-2"></i>
                        Kembali
                    </a>
                </div>
            </div>
        </div>

        <!-- Form -->
        <div class="bg-white shadow rounded-lg">
            <form method="POST" action="{{ route('admin.rts.update', $rt) }}">
                @csrf 
                @method('PUT')
                
                <div class="p-6 space-y-6">
                    <!-- RW Selection -->
                    <div>
                        <label for="rw_id" class="block text-sm font-medium text-gray-700 mb-1">
                            <i class="fas fa-building mr-1"></i> RW <span class="text-red-500">*</span>
                        </label>
                        <div class="mt-1">
                            <select name="rw_id" 
                                    id="rw_id"
                                    required
                                    class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('rw_id') border-red-300 text-red-900 placeholder-red-300 focus:ring-red-500 focus:border-red-500 @enderror">
                                <option value="">-- Pilih RW --</option>
                                @foreach($rws as $rw)
                                    <option value="{{ $rw->id }}" {{ old('rw_id', $rt->rw_id) == $rw->id ? 'selected' : '' }}>
                                        {{ $rw->name }} @if($rw->ketua_rw) - Ketua: {{ $rw->ketua_rw }} @endif
                                    </option>
                                @endforeach
                            </select>
                            @error('rw_id')
                            <p class="mt-2 text-sm text-red-600">
                                <i class="fas fa-exclamation-circle mr-1"></i> {{ $message }}
                            </p>
                            @enderror
                        </div>
                    </div>

                    <!-- Nama RT -->
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-1">
                            <i class="fas fa-home mr-1"></i> Nama RT <span class="text-red-500">*</span>
                        </label>
                        <div class="mt-1 relative rounded-md shadow-sm">
                            <input type="text" 
                                   name="name" 
                                   id="name"
                                   value="{{ old('name', $rt->name) }}"
                                   required
                                   class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('name') border-red-300 text-red-900 placeholder-red-300 focus:ring-red-500 focus:border-red-500 @enderror"
                                   placeholder="Contoh: RT 001">
                            @error('name')
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                <i class="fas fa-exclamation-circle text-red-500"></i>
                            </div>
                            @enderror
                        </div>
                        @error('name')
                        <p class="mt-2 text-sm text-red-600">
                            <i class="fas fa-exclamation-circle mr-1"></i> {{ $message }}
                        </p>
                        @enderror
                    </div>

                    <!-- Nama Ketua RT -->
                    <div>
                        <label for="leader_name" class="block text-sm font-medium text-gray-700 mb-1">
                            <i class="fas fa-user mr-1"></i> Nama Ketua RT
                        </label>
                        <div class="mt-1">
                            <input type="text" 
                                   name="leader_name" 
                                   id="leader_name"
                                   value="{{ old('leader_name', $rt->leader_name) }}"
                                   class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('leader_name') border-red-300 text-red-900 placeholder-red-300 focus:ring-red-500 focus:border-red-500 @enderror"
                                   placeholder="Nama lengkap ketua RT">
                            @error('leader_name')
                            <p class="mt-2 text-sm text-red-600">
                                <i class="fas fa-exclamation-circle mr-1"></i> {{ $message }}
                            </p>
                            @enderror
                        </div>
                    </div>

                    <!-- No. HP Ketua RT -->
                    <div>
                        <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">
                            <i class="fas fa-phone mr-1"></i> Nomor HP Ketua RT
                        </label>
                        <div class="mt-1 relative rounded-md shadow-sm">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-phone text-gray-400"></i>
                            </div>
                            <input type="tel" 
                                   name="phone" 
                                   id="phone"
                                   value="{{ old('phone', $rt->phone) }}"
                                   class="block w-full pl-10 px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('phone') border-red-300 text-red-900 placeholder-red-300 focus:ring-red-500 focus:border-red-500 @enderror"
                                   placeholder="0812xxxxxx">
                            @error('phone')
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                <i class="fas fa-exclamation-circle text-red-500"></i>
                            </div>
                            @enderror
                        </div>
                        @error('phone')
                        <p class="mt-2 text-sm text-red-600">
                            <i class="fas fa-exclamation-circle mr-1"></i> {{ $message }}
                        </p>
                        @enderror
                    </div>

                    <!-- Statistics -->
                    <div class="pt-4 border-t border-gray-200">
                        <div class="text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-chart-bar mr-1"></i> Statistik
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <div class="text-center p-4 bg-gray-50 rounded-lg">
                                <div class="text-sm font-medium text-gray-500">
                                    <i class="fas fa-users mr-1"></i> Jumlah Warga
                                </div>
                                <div class="mt-1 text-2xl font-semibold text-gray-900">{{ $rt->residents_count ?? 0 }}</div>
                            </div>
                            <div class="text-center p-4 bg-gray-50 rounded-lg">
                                <div class="text-sm font-medium text-gray-500">
                                    <i class="fas fa-circle mr-1"></i> Status
                                </div>
                                <div class="mt-1">
                                    @if($rt->leader_name)
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                            <i class="fas fa-check-circle mr-1"></i> Aktif
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                            <i class="fas fa-exclamation-circle mr-1"></i> Tidak Aktif
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Error Messages -->
                    @if ($errors->any())
                    <div class="rounded-md bg-red-50 p-4">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <i class="fas fa-exclamation-triangle text-red-400"></i>
                            </div>
                            <div class="ml-3">
                                <h3 class="text-sm font-medium text-red-800">
                                    Terdapat {{ $errors->count() }} kesalahan dalam pengisian form
                                </h3>
                                <div class="mt-2 text-sm text-red-700">
                                    <ul class="list-disc pl-5 space-y-1">
                                        @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>

                <!-- Form Footer -->
                <div class="px-6 py-3 bg-gray-50 text-right rounded-b-lg border-t border-gray-200">
                    <div class="flex justify-between items-center">
                        <div>
                            @if($rt->updated_at)
                            <p class="text-xs text-gray-500">
                                <i class="fas fa-clock mr-1"></i> 
                                Terakhir diperbarui: {{ $rt->updated_at->format('d M Y, H:i') }}
                            </p>
                            @endif
                        </div>
                        <div class="flex space-x-3">
                            <a href="{{ route('admin.rts.index') }}" 
                               class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                <i class="fas fa-times mr-2"></i> Batal
                            </a>
                            <button type="submit" 
                                    class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                <i class="fas fa-check mr-2"></i> Simpan Perubahan
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <!-- Delete Card -->
        <div class="mt-6 bg-red-50 border border-red-200 rounded-lg p-4">
            <div class="md:flex md:items-center md:justify-between">
                <div class="flex-1">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <i class="fas fa-exclamation-triangle text-red-400"></i>
                        </div>
                        <div class="ml-3">
                            <h3 class="text-sm font-medium text-red-800">Zona Berbahaya</h3>
                            <div class="mt-2 text-sm text-red-700">
                                <p>Menghapus RT akan menghapus semua data warga yang terkait. Tindakan ini tidak dapat dibatalkan.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-4 md:mt-0 md:ml-6 md:flex-shrink-0">
                    <form action="{{ route('admin.rts.destroy', $rt) }}" method="POST" id="delete-form">
                        @csrf
                        @method('DELETE')
                        <button type="button" 
                                onclick="confirmDelete()"
                                class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                            <i class="fas fa-trash mr-2"></i>
                            Hapus RT
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Format nomor HP secara otomatis
    document.getElementById('phone').addEventListener('input', function(e) {
        let value = e.target.value.replace(/\D/g, '');
        
        if (value.startsWith('0')) {
            value = value.substring(0, 13);
        } else if (value.startsWith('62')) {
            value = value.substring(0, 15);
        } else {
            if (value.length > 0 && !value.startsWith('0')) {
                value = '0' + value.substring(0, 12);
            }
        }
        
        e.target.value = value;
    });

    // Auto capitalize untuk nama ketua
    document.getElementById('leader_name').addEventListener('input', function(e) {
        let words = e.target.value.split(' ');
        words = words.map(word => {
            return word.charAt(0).toUpperCase() + word.slice(1).toLowerCase();
        });
        e.target.value = words.join(' ');
    });

    // Auto format untuk nama RT
    document.getElementById('name').addEventListener('input', function(e) {
        let value = e.target.value.toUpperCase();
        e.target.value = value;
    });

    // Delete confirmation
    function confirmDelete() {
        if (typeof Swal !== 'undefined') {
            Swal.fire({
                title: 'Hapus {{ $rt->name }}?',
                html: `Tindakan ini akan:<br>
                      <ul class="text-left mt-2 pl-4">
                        <li><i class="fas fa-users text-red-500 mr-2"></i> Menghapus semua data warga di RT ini</li>
                        <li><i class="fas fa-exclamation-triangle text-red-500 mr-2"></i> Tidak dapat dikembalikan</li>
                      </ul>`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: '<i class="fas fa-trash mr-2"></i> Ya, Hapus Selamanya!',
                cancelButtonText: '<i class="fas fa-times mr-2"></i> Batal',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form').submit();
                }
            });
        } else {
            if (confirm('Apakah Anda yakin ingin menghapus RT {{ $rt->name }}? Tindakan ini tidak dapat dibatalkan.')) {
                document.getElementById('delete-form').submit();
            }
        }
    }
</script>
@endpush