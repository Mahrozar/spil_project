@extends('layouts.guest')

@section('title', 'Login - SIDeKa Desa Cicangkang Hilir')

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
    
    .btn-login {
        background: linear-gradient(135deg, #1e40af 0%, #3b82f6 100%);
        transition: all 0.3s ease;
    }
    
    .btn-login:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 25px rgba(30, 64, 175, 0.3);
    }
</style>
@endpush

@section('content')
<div class="min-h-screen auth-background flex items-center justify-center p-4">
    <div class="w-full max-w-6xl">
        <div class="glass-card rounded-3xl overflow-hidden auth-card">
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
                            <h2 class="text-3xl font-bold mb-6">Sistem Informasi Desa Digital</h2>
                            <p class="text-lg mb-8 opacity-90">
                                Akses sistem administrasi desa untuk mengelola data kependudukan, surat menyurat, dan pembangunan desa secara digital.
                            </p>
                            
                            <!-- Features List -->
                            <div class="space-y-4">
                                <div class="flex items-center">
                                    <svg class="w-6 h-6 text-green-300 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                    <span>Kelola data penduduk & kependudukan</span>
                                </div>
                                <div class="flex items-center">
                                    <svg class="w-6 h-6 text-green-300 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                    <span>Proses surat administrasi digital</span>
                                </div>
                                <div class="flex items-center">
                                    <svg class="w-6 h-6 text-green-300 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                    <span>Monitor perkembangan desa real-time</span>
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
                                    <strong>Akses Terbatas:</strong> Hanya untuk perangkat desa yang berwenang
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Right Column - Login Form -->
                <div class="bg-white p-8 lg:p-12">
                    <div class="max-w-md mx-auto">
                        <!-- Header -->
                        <div class="text-center mb-8">
                            <h2 class="text-2xl font-bold text-gray-800">Masuk ke Dashboard</h2>
                            <p class="text-gray-600 mt-2">Gunakan akun Anda untuk mengakses sistem</p>
                        </div>
                        
                        <!-- Session Status -->
                        @if (session('status'))
                            <div class="mb-6 p-4 bg-green-50 text-green-700 rounded-lg border border-green-200">
                                {{ session('status') }}
                            </div>
                        @endif
                        
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
                        
                        <!-- Login Form -->
                        <form method="POST" action="{{ route('login') }}" class="space-y-6">
                            @csrf
                            
                            <!-- Email Input -->
                            <div class="input-group">
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
                                        autofocus 
                                        class="pl-10 w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent @error('email') border-red-300 @enderror"
                                        placeholder="admin@desa.id">
                                </div>
                                @error('email')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <!-- Password Input -->
                            <div class="input-group">
                                <div class="flex justify-between items-center mb-2">
                                    <label for="password" class="block text-sm font-medium text-gray-700">
                                        Kata Sandi
                                    </label>
                                    @if (Route::has('password.request'))
                                        <a href="{{ route('password.request') }}" class="text-sm text-primary hover:text-secondary">
                                            Lupa kata sandi?
                                        </a>
                                    @endif
                                </div>
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
                                        placeholder="••••••••">
                                </div>
                                @error('password')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <!-- Remember Me -->
                            <div class="flex items-center">
                                <input 
                                    id="remember_me" 
                                    name="remember" 
                                    type="checkbox" 
                                    class="h-4 w-4 text-primary focus:ring-primary border-gray-300 rounded"
                                    {{ old('remember') ? 'checked' : '' }}>
                                <label for="remember_me" class="ml-2 text-sm text-gray-700">
                                    Ingat perangkat ini
                                </label>
                            </div>
                            
                            <!-- Submit Button -->
                            <button type="submit" class="btn-login w-full text-white font-bold py-3 px-4 rounded-lg">
                                Masuk ke Sistem
                            </button>
                        </form>
                        
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
@endsection

@push('scripts')
<script>
    // Auto-focus on email field
    document.addEventListener('DOMContentLoaded', function() {
        const emailInput = document.getElementById('email');
        if (emailInput && !emailInput.value) {
            setTimeout(() => emailInput.focus(), 300);
        }
        
        // Form submission loading state
        const form = document.querySelector('form');
        if (form) {
            form.addEventListener('submit', function() {
                const submitBtn = this.querySelector('button[type="submit"]');
                if (submitBtn) {
                    submitBtn.innerHTML = `
                        <svg class="animate-spin h-5 w-5 text-white mx-auto" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        <span class="ml-2">Memproses...</span>
                    `;
                    submitBtn.disabled = true;
                }
            });
        }
    });
</script>
@endpush