@extends('layouts.app')

@section('title', 'Buat Laporan Baru - Admin')

@section('content')
<div class="admin-content-area">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Breadcrumb -->
        <nav class="mb-6" aria-label="Breadcrumb">
            <ol class="flex items-center space-x-2 text-sm">
                <li>
                    <a href="{{ route('admin.dashboard') }}" class="text-gray-400 hover:text-gray-600">
                        Dashboard
                    </a>
                </li>
                <li class="flex items-center">
                    <i class="fas fa-chevron-right text-gray-400 text-xs mx-2"></i>
                    <a href="{{ route('admin.reports.index') }}" class="text-gray-400 hover:text-gray-600">
                        Laporan Fasilitas
                    </a>
                </li>
                <li class="flex items-center">
                    <i class="fas fa-chevron-right text-gray-400 text-xs mx-2"></i>
                    <span class="text-gray-600 font-medium">Buat Laporan Baru</span>
                </li>
            </ol>
        </nav>

        <!-- Header -->
        <div class="mb-8">
            <div class="flex items-center gap-3">
                <div class="flex-shrink-0 h-12 w-12 flex items-center justify-center bg-blue-100 rounded-xl">
                    <i class="fas fa-plus-circle text-blue-600 text-xl"></i>
                </div>
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">Buat Laporan Baru</h1>
                    <p class="text-gray-600 mt-1">Tambahkan laporan fasilitas umum baru ke dalam sistem</p>
                </div>
            </div>
        </div>

        <!-- Main Form -->
        <div class="bg-white shadow overflow-hidden sm:rounded-lg">
            <div class="px-4 py-5 sm:px-6 border-b border-gray-200 bg-gray-50">
                <h3 class="text-lg font-medium text-gray-900 flex items-center">
                    <i class="fas fa-file-alt mr-2 text-blue-500"></i>
                    Formulir Laporan
                </h3>
                <p class="mt-1 text-sm text-gray-500">
                    Isi semua informasi yang diperlukan untuk membuat laporan baru
                </p>
            </div>

            <form action="{{ route('admin.reports.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="px-4 py-5 sm:p-6">
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                        <!-- Left Column -->
                        <div class="space-y-6">
                            <!-- Informasi Dasar -->
                            <div class="bg-blue-50 p-4 rounded-lg border border-blue-100">
                                <h4 class="text-sm font-medium text-blue-900 mb-3 flex items-center">
                                    <i class="fas fa-info-circle mr-2"></i>
                                    INFORMASI DASAR
                                </h4>
                                
                                <!-- Judul Laporan -->
                                <div class="mb-4">
                                    <label for="title" class="block text-sm font-medium text-gray-700 mb-2">
                                        <i class="fas fa-heading mr-1 text-gray-400"></i>
                                        Judul Laporan
                                    </label>
                                    <input type="text" 
                                           name="title" 
                                           id="title"
                                           value="{{ old('title') }}"
                                           required
                                           class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                                           placeholder="Contoh: Jalan Berlubang di RT 02">
                                    @error('title')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Deskripsi -->
                                <div>
                                    <label for="description" class="block text-sm font-medium text-gray-700 mb-2">
                                        <i class="fas fa-align-left mr-1 text-gray-400"></i>
                                        Deskripsi Lengkap
                                    </label>
                                    <textarea name="description" 
                                              id="description" 
                                              rows="4"
                                              required
                                              class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                                              placeholder="Jelaskan kondisi fasilitas yang dilaporkan secara detail...">{{ old('description') }}</textarea>
                                    @error('description')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <!-- Kategori Fasilitas -->
                            <div class="bg-purple-50 p-4 rounded-lg border border-purple-100">
                                <h4 class="text-sm font-medium text-purple-900 mb-3 flex items-center">
                                    <i class="fas fa-tag mr-2"></i>
                                    KATEGORI FASILITAS
                                </h4>
                                
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <!-- Kategori -->
                                    <div>
                                        <label for="facility_category" class="block text-sm font-medium text-gray-700 mb-2">
                                            Kategori Utama
                                        </label>
                                        <select name="facility_category" 
                                                id="facility_category"
                                                required
                                                class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                                            <option value="">-- Pilih Kategori --</option>
                                            @foreach(App\Models\Report::getFacilityCategories() as $key => $label)
                                                <option value="{{ $key }}" {{ old('facility_category') == $key ? 'selected' : '' }}>
                                                    {{ $label }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('facility_category')
                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <!-- Jenis Fasilitas -->
                                    <div>
                                        <label for="facility_type" class="block text-sm font-medium text-gray-700 mb-2">
                                            Jenis Fasilitas
                                        </label>
                                        <select name="facility_type" 
                                                id="facility_type"
                                                required
                                                class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                                            <option value="">-- Pilih Jenis --</option>
                                            <!-- Options will be populated by JavaScript based on category selection -->
                                        </select>
                                        @error('facility_type')
                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Lokasi -->
                            <div class="bg-green-50 p-4 rounded-lg border border-green-100">
                                <h4 class="text-sm font-medium text-green-900 mb-3 flex items-center">
                                    <i class="fas fa-map-marker-alt mr-2"></i>
                                    LOKASI FASILITAS
                                </h4>
                                
                                <div class="space-y-4">
                                    <!-- Alamat -->
                                    <div>
                                        <label for="address" class="block text-sm font-medium text-gray-700 mb-2">
                                            <i class="fas fa-road mr-1 text-gray-400"></i>
                                            Alamat Lengkap
                                        </label>
                                        <textarea name="address" 
                                                  id="address"
                                                  rows="2"
                                                  required
                                                  class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                                                  placeholder="Jl. Contoh No. 123">{{ old('address') }}</textarea>
                                        @error('address')
                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                        <!-- Dusun -->
                                        <div>
                                            <label for="dusun" class="block text-sm font-medium text-gray-700 mb-2">
                                                Dusun
                                            </label>
                                            <input type="text" 
                                                   name="dusun" 
                                                   id="dusun"
                                                   value="{{ old('dusun') }}"
                                                   class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                                                   placeholder="Dusun">
                                            @error('dusun')
                                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <!-- RT -->
                                        <div>
                                            <label for="rt" class="block text-sm font-medium text-gray-700 mb-2">
                                                RT
                                            </label>
                                            <input type="text" 
                                                   name="rt" 
                                                   id="rt"
                                                   value="{{ old('rt') }}"
                                                   class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                                                   placeholder="001">
                                            @error('rt')
                                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <!-- RW -->
                                        <div>
                                            <label for="rw" class="block text-sm font-medium text-gray-700 mb-2">
                                                RW
                                            </label>
                                            <input type="text" 
                                                   name="rw" 
                                                   id="rw"
                                                   value="{{ old('rw') }}"
                                                   class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                                                   placeholder="001">
                                            @error('rw')
                                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <!-- Latitude -->
                                        <div>
                                            <label for="latitude" class="block text-sm font-medium text-gray-700 mb-2">
                                                <i class="fas fa-globe-asia mr-1 text-gray-400"></i>
                                                Latitude
                                            </label>
                                            <input type="number" 
                                                   step="any"
                                                   name="latitude" 
                                                   id="latitude"
                                                   value="{{ old('latitude') }}"
                                                   class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                                                   placeholder="-7.123456">
                                            @error('latitude')
                                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <!-- Longitude -->
                                        <div>
                                            <label for="longitude" class="block text-sm font-medium text-gray-700 mb-2">
                                                <i class="fas fa-globe mr-1 text-gray-400"></i>
                                                Longitude
                                            </label>
                                            <input type="number" 
                                                   step="any"
                                                   name="longitude" 
                                                   id="longitude"
                                                   value="{{ old('longitude') }}"
                                                   class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                                                   placeholder="110.123456">
                                            @error('longitude')
                                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Right Column -->
                        <div class="space-y-6">
                            <!-- Informasi Pelapor -->
                            <div class="bg-yellow-50 p-4 rounded-lg border border-yellow-100">
                                <h4 class="text-sm font-medium text-yellow-900 mb-3 flex items-center">
                                    <i class="fas fa-user mr-2"></i>
                                    INFORMASI PELAPOR
                                </h4>
                                
                                <div class="space-y-4">
                                    <!-- Nama Pelapor -->
                                    <div>
                                        <label for="reporter_name" class="block text-sm font-medium text-gray-700 mb-2">
                                            <i class="fas fa-user-circle mr-1 text-gray-400"></i>
                                            Nama Lengkap
                                        </label>
                                        <input type="text" 
                                               name="reporter_name" 
                                               id="reporter_name"
                                               value="{{ old('reporter_name', auth()->user()->name ?? '') }}"
                                               required
                                               class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                                               placeholder="Nama pelapor">
                                        @error('reporter_name')
                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <!-- Telepon -->
                                        <div>
                                            <label for="reporter_phone" class="block text-sm font-medium text-gray-700 mb-2">
                                                <i class="fas fa-phone mr-1 text-gray-400"></i>
                                                No. Telepon
                                            </label>
                                            <input type="tel" 
                                                   name="reporter_phone" 
                                                   id="reporter_phone"
                                                   value="{{ old('reporter_phone') }}"
                                                   class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                                                   placeholder="081234567890">
                                            @error('reporter_phone')
                                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <!-- Email -->
                                        <div>
                                            <label for="reporter_email" class="block text-sm font-medium text-gray-700 mb-2">
                                                <i class="fas fa-envelope mr-1 text-gray-400"></i>
                                                Email
                                            </label>
                                            <input type="email" 
                                                   name="reporter_email" 
                                                   id="reporter_email"
                                                   value="{{ old('reporter_email', auth()->user()->email ?? '') }}"
                                                   class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                                                   placeholder="email@contoh.com">
                                            @error('reporter_email')
                                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Anonim -->
                                    <div class="flex items-center">
                                        <input type="checkbox" 
                                               name="is_anonymous" 
                                               id="is_anonymous"
                                               value="1"
                                               {{ old('is_anonymous') ? 'checked' : '' }}
                                               class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                        <label for="is_anonymous" class="ml-2 block text-sm text-gray-700">
                                            <i class="fas fa-user-secret mr-1"></i>
                                            Tampilkan sebagai laporan anonim
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <!-- Status & Prioritas -->
                            <div class="bg-red-50 p-4 rounded-lg border border-red-100">
                                <h4 class="text-sm font-medium text-red-900 mb-3 flex items-center">
                                    <i class="fas fa-cog mr-2"></i>
                                    PENGATURAN SISTEM
                                </h4>
                                
                                <div class="space-y-4">
                                    <!-- Status -->
                                    <div>
                                        <label for="status" class="block text-sm font-medium text-gray-700 mb-2">
                                            <i class="fas fa-flag mr-1 text-gray-400"></i>
                                            Status Laporan
                                        </label>
                                        <select name="status" 
                                                id="status"
                                                required
                                                class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                                            @foreach(App\Models\Report::getStatusLabels() as $key => $label)
                                                <option value="{{ $key }}" {{ old('status') == $key ? 'selected' : '' }}>
                                                    {{ $label }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('status')
                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <!-- Prioritas -->
                                    <div>
                                        <label for="priority" class="block text-sm font-medium text-gray-700 mb-2">
                                            <i class="fas fa-exclamation-circle mr-1 text-gray-400"></i>
                                            Prioritas
                                        </label>
                                        <select name="priority" 
                                                id="priority"
                                                required
                                                class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                                            @foreach(App\Models\Report::getPriorityLabels() as $key => $label)
                                                <option value="{{ $key }}" {{ old('priority', 'medium') == $key ? 'selected' : '' }}>
                                                    {{ $label }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('priority')
                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <!-- Petugas -->
                                    <div>
                                        <label for="assigned_to" class="block text-sm font-medium text-gray-700 mb-2">
                                            <i class="fas fa-user-tie mr-1 text-gray-400"></i>
                                            Tugaskan Kepada
                                        </label>
                                        <select name="assigned_to" 
                                                id="assigned_to"
                                                class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                                            <option value="">-- Pilih Petugas --</option>
                                            @foreach($users ?? [] as $user)
                                                <option value="{{ $user->id }}" {{ old('assigned_to') == $user->id ? 'selected' : '' }}>
                                                    {{ $user->name }} ({{ $user->email }})
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('assigned_to')
                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <!-- Batas Waktu -->
                                    <div>
                                        <label for="due_date" class="block text-sm font-medium text-gray-700 mb-2">
                                            <i class="far fa-calendar-alt mr-1 text-gray-400"></i>
                                            Batas Waktu Penyelesaian
                                        </label>
                                        <input type="date" 
                                               name="due_date" 
                                               id="due_date"
                                               value="{{ old('due_date') }}"
                                               class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                                        @error('due_date')
                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Foto Laporan -->
                            <div class="bg-indigo-50 p-4 rounded-lg border border-indigo-100">
                                <h4 class="text-sm font-medium text-indigo-900 mb-3 flex items-center">
                                    <i class="fas fa-camera mr-2"></i>
                                    FOTO LAPORAN
                                </h4>
                                
                                <div class="space-y-4">
                                    <div id="photoUploadArea" class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:border-blue-400 transition-colors">
                                        <i class="fas fa-cloud-upload-alt text-gray-400 text-3xl mb-3"></i>
                                        <p class="text-sm text-gray-600 mb-2">Unggah foto fasilitas yang dilaporkan</p>
                                        <input type="file" 
                                               name="photos[]" 
                                               id="photos"
                                               multiple
                                               accept="image/*"
                                               class="hidden"
                                               onchange="previewPhotos()">
                                        <button type="button" 
                                                onclick="document.getElementById('photos').click()"
                                                class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition-colors">
                                            <i class="fas fa-plus mr-2"></i>
                                            Pilih Foto
                                        </button>
                                        <p class="text-xs text-gray-500 mt-2">Maksimal 5 foto, format JPG/PNG/WebP (max 2MB)</p>
                                    </div>

                                    <!-- Photo Preview -->
                                    <div id="photoPreview" class="grid grid-cols-2 md:grid-cols-3 gap-2"></div>

                                    <!-- Visibility -->
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center">
                                            <input type="checkbox" 
                                                   name="is_public" 
                                                   id="is_public"
                                                   value="1"
                                                   {{ old('is_public', true) ? 'checked' : '' }}
                                                   class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                            <label for="is_public" class="ml-2 block text-sm text-gray-700">
                                                <i class="fas fa-eye mr-1"></i>
                                                Tampilkan ke publik
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Catatan Tambahan -->
                            <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
                                <h4 class="text-sm font-medium text-gray-900 mb-3 flex items-center">
                                    <i class="fas fa-sticky-note mr-2"></i>
                                    CATATAN TAMBAHAN
                                </h4>
                                
                                <div class="space-y-3">
                                    <div>
                                        <label for="additional_notes" class="block text-sm font-medium text-gray-700 mb-2">
                                            Catatan Internal
                                        </label>
                                        <textarea name="additional_notes" 
                                                  id="additional_notes"
                                                  rows="3"
                                                  class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                                                  placeholder="Catatan tambahan untuk tim internal...">{{ old('additional_notes') }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Form Actions -->
                <div class="px-4 py-5 sm:px-6 border-t border-gray-200 bg-gray-50">
                    <div class="flex flex-wrap items-center justify-between gap-4">
                        <div>
                            <a href="{{ route('admin.reports.index') }}" 
                               class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                                <i class="fas fa-times mr-2"></i>
                                Batal
                            </a>
                        </div>
                        <div class="flex items-center gap-3">
                            <button type="button" 
                                    onclick="resetForm()"
                                    class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                                <i class="fas fa-redo mr-2"></i>
                                Reset Form
                            </button>
                            <button type="submit" 
                                    class="inline-flex items-center px-6 py-3 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                <i class="fas fa-save mr-2"></i>
                                Simpan Laporan
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Facility type options mapping
    const facilityTypes = @json(App\Models\Report::getFacilityTypes());

    // Update facility type options based on category selection
    document.getElementById('facility_category').addEventListener('change', function() {
        const category = this.value;
        const typeSelect = document.getElementById('facility_type');
        
        // Clear existing options
        typeSelect.innerHTML = '<option value="">-- Pilih Jenis --</option>';
        
        // Add new options if category is selected
        if (category && facilityTypes[category]) {
            Object.entries(facilityTypes[category]).forEach(([key, label]) => {
                const option = document.createElement('option');
                option.value = key;
                option.textContent = label;
                typeSelect.appendChild(option);
            });
        }
    });

    // Initialize facility type options if category is already selected
    document.addEventListener('DOMContentLoaded', function() {
        const categorySelect = document.getElementById('facility_category');
        const typeSelect = document.getElementById('facility_type');
        
        // Populate initial types if category is selected
        if (categorySelect.value) {
            const category = categorySelect.value;
            if (facilityTypes[category]) {
                Object.entries(facilityTypes[category]).forEach(([key, label]) => {
                    const option = document.createElement('option');
                    option.value = key;
                    option.textContent = label;
                    if (key === "{{ old('facility_type') }}") {
                        option.selected = true;
                    }
                    typeSelect.appendChild(option);
                });
            }
        }
    });

    // Photo preview functionality
    function previewPhotos() {
        const input = document.getElementById('photos');
        const preview = document.getElementById('photoPreview');
        const files = input.files;
        
        preview.innerHTML = '';
        
        // Limit to 5 files
        if (files.length > 5) {
            alert('Maksimal 5 foto yang diunggah');
            return;
        }
        
        for (let i = 0; i < Math.min(files.length, 5); i++) {
            const file = files[i];
            
            // Validate file size (max 2MB)
            if (file.size > 2 * 1024 * 1024) {
                alert(`File ${file.name} terlalu besar. Maksimal 2MB.`);
                continue;
            }
            
            // Validate file type
            if (!file.type.match('image.*')) {
                alert(`File ${file.name} bukan gambar.`);
                continue;
            }
            
            const reader = new FileReader();
            
            reader.onload = function(e) {
                const div = document.createElement('div');
                div.className = 'relative group';
                div.innerHTML = `
                    <img src="${e.target.result}" 
                         alt="Preview ${i+1}"
                         class="w-full h-32 object-cover rounded-lg shadow-sm">
                    <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-20 transition-opacity rounded-lg flex items-center justify-center opacity-0 group-hover:opacity-100">
                        <button type="button" 
                                onclick="removePhoto(${i})"
                                class="bg-red-500 text-white p-1 rounded-full hover:bg-red-600">
                            <i class="fas fa-times text-xs"></i>
                        </button>
                    </div>
                    <div class="mt-1 text-xs text-gray-500 truncate">${file.name}</div>
                `;
                preview.appendChild(div);
            };
            
            reader.readAsDataURL(file);
        }
    }

    // Remove photo from preview
    function removePhoto(index) {
        const input = document.getElementById('photos');
        const dt = new DataTransfer();
        
        // Add all files except the one to remove
        for (let i = 0; i < input.files.length; i++) {
            if (i !== index) {
                dt.items.add(input.files[i]);
            }
        }
        
        input.files = dt.files;
        previewPhotos(); // Re-render preview
    }

    // Reset form
    function resetForm() {
        if (confirm('Apakah Anda yakin ingin mengosongkan semua data yang telah diisi?')) {
            document.querySelector('form').reset();
            document.getElementById('photoPreview').innerHTML = '';
            document.getElementById('photos').value = '';
        }
    }

    // Auto-generate coordinates from address (placeholder for future implementation)
    function getCoordinatesFromAddress() {
        const address = document.getElementById('address').value;
        if (address.length > 10) {
            // In a real implementation, you would call a geocoding API here
            // For now, just show a message
            alert('Fitur geolokasi akan mencari koordinat berdasarkan alamat. Dalam implementasi nyata, ini akan memanggil API geocoding.');
        }
    }

    // Add event listener for address input (optional)
    document.getElementById('address').addEventListener('blur', getCoordinatesFromAddress);
</script>

<style>
    /* Custom scrollbar for select elements */
    select {
        scrollbar-width: thin;
        scrollbar-color: #cbd5e0 #f7fafc;
    }

    select::-webkit-scrollbar {
        width: 8px;
    }

    select::-webkit-scrollbar-track {
        background: #f7fafc;
        border-radius: 4px;
    }

    select::-webkit-scrollbar-thumb {
        background-color: #cbd5e0;
        border-radius: 4px;
    }

    /* Form field focus styles */
    input:focus, textarea:focus, select:focus {
        outline: none;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
    }
</style>
@endpush