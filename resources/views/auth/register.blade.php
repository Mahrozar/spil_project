@extends('layouts.guest')

@section('title', 'Registrasi Admin - SIDeKa Desa Cicangkang Hilir')

@push('styles')
<style>
    .auth-background {
        background: linear-gradient(rgba(30, 64, 175, 0.05), rgba(30, 64, 175, 0.1)), url('https://images.unsplash.com/photo-1545569341-9eb8b30979d9?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80');
        background-size: cover;
        background-position: center;
        background-attachment: fixed;
    }
    
    .glass-card {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.2);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
    }
    
    .input-group:focus-within {
        transform: translateY(-2px);
        transition: transform 0.3s ease;
    }
    
    .btn-register {
        background: linear-gradient(135deg, #10b981 0%, #34d399 100%);
        transition: all 0.3s ease;
    }
    
    .btn-register:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 25px rgba(16, 185, 129, 0.3);
    }
    
    .password-strength {
        height: 4px;
        border-radius: 2px;
        transition: all 0.3s ease;
    }
    
    .strength-weak { background-color: #ef4444; width: 25%; }
    .strength-fair { background-color: #f59e0b; width: 50%; }
    .strength-good { background-color: #3b82f6; width: 75%; }
    .strength-strong { background-color: #10b981; width: 100%; }
    
    /* Animasi untuk form */
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }
    
    .form-group {
        animation: fadeIn 0.5s ease-out forwards;
        opacity: 0;
    }
    
    .form-group:nth-child(1) { animation-delay: 0.1s; }
    .form-group:nth-child(2) { animation-delay: 0.2s; }
    .form-group:nth-child(3) { animation-delay: 0.3s; }
    .form-group:nth-child(4) { animation-delay: 0.4s; }
    .form-group:nth-child(5) { animation-delay: 0.5s; }
    .form-group:nth-child(6) { animation-delay: 0.6s; }
</style>
@endpush

@section('content')
<div class="min-h-screen auth-background flex items-center justify-center p-4">
    <div class="w-full max-w-6xl">
        <div class="glass-card rounded-3xl overflow-hidden">
            <div class="grid grid-cols-1 lg:grid-cols-2">
                <!-- Left Column - Branding & Info -->
                <div class="bg-gradient-to-br from-primary to-secondary p-8 lg:p-12 text-white">
                    <div class="h-full flex flex-col justify-between">
                        <div>
                            <!-- Logo -->
                            <div class="flex items-center space-x-3 mb-8">
                                <div class="bg-white text-primary p-3 rounded-xl">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                    </svg>
                                </div>
                                <div>
                                    <h1 class="text-2xl font-bold">SIDeKa</h1>
                                    <p class="text-sm opacity-90">Desa Cicangkang Hilir</p>
                                </div>
                            </div>
                            
                            <!-- Welcome Message -->
                            <h2 class="text-3xl font-bold mb-6">Daftar Akun Admin</h2>
                            <p class="text-lg mb-8 opacity-90">
                                Buat akun administrator untuk mengelola Sistem Informasi Desa Cicangkang Hilir. Pastikan data yang Anda masukkan valid.
                            </p>
                            
                            <!-- Requirements List -->
                            <div class="space-y-4 mb-8">
                                <div class="flex items-center">
                                    <svg class="w-6 h-6 text-green-300 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                    <span>Gunakan email resmi desa</span>
                                </div>
                                <div class="flex items-center">
                                    <svg class="w-6 h-6 text-green-300 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                    <span>Buat kata sandi yang kuat</span>
                                </div>
                                <div class="flex items-center">
                                    <svg class="w-6 h-6 text-green-300 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                    <span>Isi data diri dengan benar</span>
                                </div>
                            </div>
                            
                            <!-- Note about admin approval -->
                            <div class="bg-white/10 rounded-lg p-4">
                                <div class="flex items-start">
                                    <svg class="w-5 h-5 text-yellow-300 mt-0.5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <div>
                                        <p class="text-sm font-medium">Proses Verifikasi</p>
                                        <p class="text-xs opacity-90 mt-1">
                                            Akun yang baru dibuat memerlukan verifikasi dari Super Admin sebelum dapat digunakan.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Security Notice -->
                        <div class="mt-8 pt-6 border-t border-white/20">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 text-yellow-300 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                </svg>
                                <p class="text-sm opacity-90">
                                    <strong>Data Sensitif:</strong> Informasi yang Anda berikan akan dilindungi dan hanya digunakan untuk keperluan administrasi desa.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Right Column - Registration Form -->
                <div class="bg-white p-8 lg:p-12">
                    <div class="max-w-md mx-auto">
                        <!-- Header -->
                        <div class="text-center mb-8">
                            <h2 class="text-2xl font-bold text-gray-800">Buat Akun Admin Baru</h2>
                            <p class="text-gray-600 mt-2">Isi formulir di bawah untuk mendaftar</p>
                        </div>
                        
                        <!-- Error Messages -->
                        @if ($errors->any())
                            <div class="mb-6 p-4 bg-red-50 text-red-700 rounded-lg border border-red-200">
                                <div class="font-medium">Terjadi kesalahan:</div>
                                <ul class="mt-2 list-disc list-inside text-sm">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        
                        <!-- Registration Form -->
                        <form method="POST" action="{{ route('register') }}" class="space-y-6" id="registerForm">
                            @csrf
                            
                            <!-- Name Input -->
                            <div class="form-group input-group">
                                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                                    Nama Lengkap
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                        </svg>
                                    </div>
                                    <input 
                                        id="name" 
                                        type="text" 
                                        name="name" 
                                        value="{{ old('name') }}" 
                                        required 
                                        autofocus 
                                        class="pl-10 w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent @error('name') border-red-300 @enderror"
                                        placeholder="Nama lengkap sesuai KTP">
                                </div>
                                @error('name')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <!-- Email Input -->
                            <div class="form-group input-group">
                                <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                                    Alamat Email
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                                        </svg>
                                    </div>
                                    <input 
                                        id="email" 
                                        type="email" 
                                        name="email" 
                                        value="{{ old('email') }}" 
                                        required 
                                        class="pl-10 w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent @error('email') border-red-300 @enderror"
                                        placeholder="nama@desa.id">
                                </div>
                                <p class="mt-1 text-xs text-gray-500">
                                    Gunakan email resmi desa jika memungkinkan
                                </p>
                                @error('email')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <!-- Password Input -->
                            <div class="form-group input-group">
                                <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                                    Kata Sandi
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                        </svg>
                                    </div>
                                    <input 
                                        id="password" 
                                        type="password" 
                                        name="password" 
                                        required 
                                        class="pl-10 w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent @error('password') border-red-300 @enderror"
                                        placeholder="Minimal 8 karakter"
                                        onkeyup="checkPasswordStrength(this.value)">
                                    <button type="button" onclick="togglePasswordVisibility('password')" class="absolute inset-y-0 right-0 pr-3 flex items-center">
                                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                    </button>
                                </div>
                                
                                <!-- Password Strength Meter -->
                                <div class="mt-2">
                                    <div class="flex justify-between text-xs text-gray-500 mb-1">
                                        <span>Kekuatan kata sandi:</span>
                                        <span id="passwordStrengthText">-</span>
                                    </div>
                                    <div class="w-full bg-gray-200 rounded-full h-2">
                                        <div id="passwordStrength" class="password-strength"></div>
                                    </div>
                                </div>
                                
                                <!-- Password Requirements -->
                                <div class="mt-3 text-xs text-gray-500 space-y-1">
                                    <p class="flex items-center">
                                        <span id="lengthCheck" class="w-4 h-4 inline-flex items-center justify-center mr-2">⭕</span>
                                        Minimal 8 karakter
                                    </p>
                                    <p class="flex items-center">
                                        <span id="uppercaseCheck" class="w-4 h-4 inline-flex items-center justify-center mr-2">⭕</span>
                                        Mengandung huruf besar
                                    </p>
                                    <p class="flex items-center">
                                        <span id="numberCheck" class="w-4 h-4 inline-flex items-center justify-center mr-2">⭕</span>
                                        Mengandung angka
                                    </p>
                                </div>
                                
                                @error('password')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <!-- Confirm Password Input -->
                            <div class="form-group input-group">
                                <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">
                                    Konfirmasi Kata Sandi
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                        </svg>
                                    </div>
                                    <input 
                                        id="password_confirmation" 
                                        type="password" 
                                        name="password_confirmation" 
                                        required 
                                        class="pl-10 w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent"
                                        placeholder="Ketik ulang kata sandi">
                                    <button type="button" onclick="togglePasswordVisibility('password_confirmation')" class="absolute inset-y-0 right-0 pr-3 flex items-center">
                                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                    </button>
                                </div>
                                <div id="passwordMatch" class="mt-1 text-xs"></div>
                            </div>
                            
                            <!-- Terms Agreement -->
                            <div class="form-group">
                                <div class="flex items-start">
                                    <input 
                                        id="terms" 
                                        name="terms" 
                                        type="checkbox" 
                                        required
                                        class="h-4 w-4 mt-1 text-primary focus:ring-primary border-gray-300 rounded"
                                        {{ old('terms') ? 'checked' : '' }}>
                                    <label for="terms" class="ml-2 text-sm text-gray-700">
                                        Saya menyetujui 
                                        <a href="#" class="text-primary hover:text-secondary font-medium" onclick="showTerms()">
                                            Syarat & Ketentuan
                                        </a> 
                                        dan 
                                        <a href="#" class="text-primary hover:text-secondary font-medium" onclick="showPrivacy()">
                                            Kebijakan Privasi
                                        </a>
                                        Sistem Informasi Desa Cicangkang Hilir
                                    </label>
                                </div>
                                @error('terms')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <!-- Submit Button -->
                            <button type="submit" class="btn-register w-full text-white font-bold py-3 px-4 rounded-lg">
                                Daftar Akun Admin
                            </button>
                        </form>
                        
                        <!-- Login Link -->
                        <div class="mt-8 text-center">
                            <p class="text-gray-600">
                                Sudah punya akun?
                                <a href="{{ route('login') }}" class="text-primary hover:text-secondary font-medium">
                                    Masuk di sini
                                </a>
                            </p>
                        </div>
                        
                        <!-- Footer Links -->
                        <div class="mt-8 pt-6 border-t border-gray-200 text-center">
                            <p class="text-gray-600 text-sm">
                                Kembali ke 
                                <a href="{{ route('landing-page') }}" class="text-primary hover:text-secondary font-medium">
                                    Beranda Desa
                                </a>
                                • 
                                Butuh bantuan? 
                                <a href="{{ route('landing-page') }}#kontak" class="text-primary hover:text-secondary font-medium">
                                    Hubungi Admin
                                </a>
                            </p>
                            <p class="mt-2 text-xs text-gray-500">
                                © {{ date('Y') }} Pemerintah Desa Cicangkang Hilir • Kec. Cipongkor, Kab. Bandung Barat
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal for Terms & Conditions -->
<div id="termsModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden p-4">
    <div class="bg-white rounded-2xl max-w-2xl w-full max-h-[80vh] overflow-y-auto">
        <div class="p-6">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-2xl font-bold text-primary">Syarat & Ketentuan</h3>
                <button onclick="closeModal()" class="text-gray-400 hover:text-gray-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <div class="prose max-w-none">
                <p>Dengan mendaftar sebagai Admin Desa Cicangkang Hilir, Anda menyetujui:</p>
                <ol class="list-decimal pl-5 mt-4 space-y-2">
                    <li>Menggunakan sistem hanya untuk keperluan administrasi desa</li>
                    <li>Menjaga kerahasiaan data yang diakses melalui sistem</li>
                    <li>Tidak menyalahgunakan akses untuk kepentingan pribadi</li>
                    <li>Melaporkan setiap kecurigaan penyalahgunaan sistem</li>
                    <li>Mematuhi semua peraturan dan kebijakan yang berlaku</li>
                </ol>
                <p class="mt-4 text-sm text-gray-600">
                    *Akun yang melanggar ketentuan akan dinonaktifkan secara permanen.
                </p>
            </div>
            <div class="mt-6 flex justify-end">
                <button onclick="closeModal()" class="px-6 py-2 bg-primary text-white rounded-lg hover:bg-secondary">
                    Mengerti
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal for Privacy Policy -->
<div id="privacyModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden p-4">
    <div class="bg-white rounded-2xl max-w-2xl w-full max-h-[80vh] overflow-y-auto">
        <div class="p-6">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-2xl font-bold text-primary">Kebijakan Privasi</h3>
                <button onclick="closeModal()" class="text-gray-400 hover:text-gray-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <div class="prose max-w-none">
                <p>Kami berkomitmen melindungi data pribadi Anda:</p>
                <ul class="list-disc pl-5 mt-4 space-y-2">
                    <li>Data hanya digunakan untuk keperluan administrasi desa</li>
                    <li>Informasi pribadi tidak akan dibagikan kepada pihak ketiga</li>
                    <li>Sistem menggunakan enkripsi untuk melindungi data sensitif</li>
                    <li>Anda dapat mengakses dan memperbarui data pribadi Anda</li>
                    <li>Log aktivitas disimpan untuk keamanan sistem</li>
                </ul>
                <p class="mt-4 text-sm text-gray-600">
                    *Kebijakan ini dapat diperbarui sesuai dengan perkembangan sistem.
                </p>
            </div>
            <div class="mt-6 flex justify-end">
                <button onclick="closeModal()" class="px-6 py-2 bg-primary text-white rounded-lg hover:bg-secondary">
                    Mengerti
                </button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Toggle password visibility
    function togglePasswordVisibility(fieldId) {
        const field = document.getElementById(fieldId);
        if (field.type === 'password') {
            field.type = 'text';
        } else {
            field.type = 'password';
        }
    }
    
    // Check password strength
    function checkPasswordStrength(password) {
        const strengthBar = document.getElementById('passwordStrength');
        const strengthText = document.getElementById('passwordStrengthText');
        const lengthCheck = document.getElementById('lengthCheck');
        const uppercaseCheck = document.getElementById('uppercaseCheck');
        const numberCheck = document.getElementById('numberCheck');
        
        let strength = 0;
        let text = '';
        let className = '';
        
        // Check length
        if (password.length >= 8) {
            strength += 1;
            lengthCheck.innerHTML = '✅';
            lengthCheck.classList.add('text-green-500');
        } else {
            lengthCheck.innerHTML = '❌';
            lengthCheck.classList.remove('text-green-500');
        }
        
        // Check uppercase
        if (/[A-Z]/.test(password)) {
            strength += 1;
            uppercaseCheck.innerHTML = '✅';
            uppercaseCheck.classList.add('text-green-500');
        } else {
            uppercaseCheck.innerHTML = '❌';
            uppercaseCheck.classList.remove('text-green-500');
        }
        
        // Check numbers
        if (/[0-9]/.test(password)) {
            strength += 1;
            numberCheck.innerHTML = '✅';
            numberCheck.classList.add('text-green-500');
        } else {
            numberCheck.innerHTML = '❌';
            numberCheck.classList.remove('text-green-500');
        }
        
        // Check special characters (bonus)
        if (/[^A-Za-z0-9]/.test(password)) {
            strength += 1;
        }
        
        // Determine strength level
        switch(strength) {
            case 0:
            case 1:
                text = 'Lemah';
                className = 'strength-weak';
                break;
            case 2:
                text = 'Cukup';
                className = 'strength-fair';
                break;
            case 3:
                text = 'Baik';
                className = 'strength-good';
                break;
            case 4:
                text = 'Kuat';
                className = 'strength-strong';
                break;
        }
        
        // Update UI
        strengthBar.className = `password-strength ${className}`;
        strengthText.textContent = text;
        strengthText.className = strength < 2 ? 'text-red-600' : 
                                strength < 3 ? 'text-yellow-600' : 
                                strength < 4 ? 'text-blue-600' : 'text-green-600';
        
        // Check password match
        checkPasswordMatch();
    }
    
    // Check password confirmation
    function checkPasswordMatch() {
        const password = document.getElementById('password').value;
        const confirmPassword = document.getElementById('password_confirmation').value;
        const matchDiv = document.getElementById('passwordMatch');
        
        if (!confirmPassword) {
            matchDiv.textContent = '';
            matchDiv.className = 'mt-1 text-xs';
            return;
        }
        
        if (password === confirmPassword) {
            matchDiv.textContent = '✓ Kata sandi cocok';
            matchDiv.className = 'mt-1 text-xs text-green-600';
        } else {
            matchDiv.textContent = '✗ Kata sandi tidak cocok';
            matchDiv.className = 'mt-1 text-xs text-red-600';
        }
    }
    
    // Modal functions
    function showTerms() {
        event.preventDefault();
        document.getElementById('termsModal').classList.remove('hidden');
    }
    
    function showPrivacy() {
        event.preventDefault();
        document.getElementById('privacyModal').classList.remove('hidden');
    }
    
    function closeModal() {
        document.getElementById('termsModal').classList.add('hidden');
        document.getElementById('privacyModal').classList.add('hidden');
    }
    
    // Close modal on outside click
    document.addEventListener('DOMContentLoaded', function() {
        const modals = document.querySelectorAll('#termsModal, #privacyModal');
        modals.forEach(modal => {
            modal.addEventListener('click', function(e) {
                if (e.target === this) {
                    closeModal();
                }
            });
        });
        
        // Real-time password confirmation check
        document.getElementById('password_confirmation').addEventListener('input', checkPasswordMatch);
        
        // Auto-focus on name field
        const nameInput = document.getElementById('name');
        if (nameInput && !nameInput.value) {
            setTimeout(() => nameInput.focus(), 300);
        }
        
        // Form submission loading state
        const form = document.getElementById('registerForm');
        if (form) {
            form.addEventListener('submit', function() {
                const submitBtn = this.querySelector('button[type="submit"]');
                if (submitBtn) {
                    submitBtn.innerHTML = `
                        <svg class="animate-spin h-5 w-5 text-white mx-auto" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        <span class="ml-2">Mendaftarkan...</span>
                    `;
                    submitBtn.disabled = true;
                }
            });
        }
        
        // Initialize password strength check
        const passwordInput = document.getElementById('password');
        if (passwordInput.value) {
            checkPasswordStrength(passwordInput.value);
        }
    });
</script>
@endpush