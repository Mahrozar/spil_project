@extends('layouts.app')

@section('title', 'Tambah RT Baru')

@section('breadcrumb')
    <nav class="mb-6" aria-label="Breadcrumb">
        <ol class="flex items-center space-x-2 text-sm">
            <li>
                <a href="{{ route('admin.dashboard') }}" class="text-gray-400 hover:text-gray-600">
                    Dashboard
                </a>
            </li>
            <li class="flex items-center">
                <i class="fas fa-chevron-right text-gray-400 text-xs mx-2"></i>
                <a href="{{ route('admin.rts.index') }}" class="ml-2 text-gray-400 hover:text-gray-600">
                    Daftar RT
                </a>
            </li>
            <li class="flex items-center">
                <i class="fas fa-chevron-right text-gray-400 text-xs mx-2"></i>
                <span class="ml-2 text-gray-600 font-medium">Tambah RT Baru</span>
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
                        <h1 class="text-2xl font-bold text-gray-900">
                            Tambah RT Baru
                        </h1>
                        <p class="mt-1 text-sm text-gray-500">
                            Isi form di bawah untuk menambahkan Rukun Tetangga baru
                        </p>
                    </div>
                    <div class="mt-4 flex md:mt-0">
                        <a href="{{ route('admin.rts.index') }}"
                            class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            <i class="fas fa-arrow-left mr-2 text-gray-400"></i>
                            Kembali
                        </a>
                    </div>
                </div>
            </div>

            <!-- Form -->
            <div class="bg-white shadow rounded-lg">
                <form method="POST" action="{{ route('admin.rts.store') }}">
                    @csrf

                    <div class="p-6 space-y-6">
                        <!-- RW Selection -->
                        <div>
                            <label for="rw_id" class="block text-sm font-medium text-gray-700 mb-1">
                                RW <span class="text-red-500">*</span>
                            </label>
                            <div class="mt-1">
                                <select name="rw_id" id="rw_id" required
                                    class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('rw_id') border-red-300 text-red-900 placeholder-red-300 focus:ring-red-500 focus:border-red-500 @enderror">
                                    <option value="">-- Pilih RW --</option>
                                    @foreach ($rws as $rw)
                                        <option value="{{ $rw->id }}" {{ old('rw_id') == $rw->id ? 'selected' : '' }}>
                                            {{ $rw->name }} @if ($rw->ketua_rw)
                                                - Ketua: {{ $rw->ketua_rw }}
                                            @endif
                                        </option>
                                    @endforeach
                                </select>
                                @error('rw_id')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Nama RT -->
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-1">
                                Nama RT <span class="text-red-500">*</span>
                            </label>
                            <div class="mt-1 relative rounded-md shadow-sm">
                                <input type="text" name="name" id="name" value="{{ old('name') }}" required
                                    class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('name') border-red-300 text-red-900 placeholder-red-300 focus:ring-red-500 focus:border-red-500 @enderror"
                                    placeholder="Contoh: RT 001">
                                @error('name')
                                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                        <i class="fas fa-exclamation-circle text-red-500"></i>
                                    </div>
                                @enderror
                            </div>
                            @error('name')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @else
                                <p class="mt-2 text-sm text-gray-500">Masukkan nama RT dengan format "RT XXX"</p>
                            @enderror
                        </div>

                        <!-- Nama Ketua RT -->
                        <div>
                            <label for="leader_name" class="block text-sm font-medium text-gray-700 mb-1">
                                Nama Ketua RT
                            </label>
                            <div class="mt-1">
                                <input type="text" name="leader_name" id="leader_name" value="{{ old('leader_name') }}"
                                    class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('leader_name') border-red-300 text-red-900 placeholder-red-300 focus:ring-red-500 focus:border-red-500 @enderror"
                                    placeholder="Nama lengkap ketua RT">
                                @error('leader_name')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- No. HP Ketua RT -->
                        <div>
                            <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">
                                Nomor HP Ketua RT
                            </label>
                            <div class="mt-1 relative rounded-md shadow-sm">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-phone text-gray-400"></i>
                                </div>
                                <input type="tel" name="phone" id="phone" value="{{ old('phone') }}"
                                    class="block w-full pl-10 px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('phone') border-red-300 text-red-900 placeholder-red-300 focus:ring-red-500 focus:border-red-500 @enderror"
                                    placeholder="0812xxxxxx">
                                @error('phone')
                                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                        <i class="fas fa-exclamation-circle text-red-500"></i>
                                    </div>
                                @enderror
                            </div>
                            @error('phone')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @else
                                <p class="mt-2 text-sm text-gray-500">Masukkan nomor HP yang dapat dihubungi</p>
                            @enderror
                        </div>

                        <!-- Error Messages -->
                        @if ($errors->any())
                            <div class="rounded-md bg-red-50 p-4">
                                <div class="flex">
                                    <div class="flex-shrink-0">
                                        <i class="fas fa-exclamation-circle text-red-400"></i>
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
                        <div class="flex justify-end space-x-3">
                            <a href="{{ route('admin.rts.index') }}"
                                class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                Batal
                            </a>
                            <button type="submit"
                                class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                <i class="fas fa-check mr-2"></i>
                                Simpan RT Baru
                            </button>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Info Card -->
            <div class="mt-6 bg-blue-50 border border-blue-200 rounded-lg p-4">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <i class="fas fa-info-circle text-blue-400"></i>
                    </div>
                    <div class="ml-3">
                        <h3 class="text-sm font-medium text-blue-800">Tips</h3>
                        <div class="mt-2 text-sm text-blue-700">
                            <ul class="list-disc pl-5 space-y-1">
                                <li>Pastikan RT belum ada dalam sistem untuk RW yang dipilih</li>
                                <li>Data ketua RT dan nomor HP dapat diisi nanti</li>
                                <li>Format nomor HP: 0812xxxxxx atau 62812xxxxxx</li>
                            </ul>
                        </div>
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
    </script>
@endpush
