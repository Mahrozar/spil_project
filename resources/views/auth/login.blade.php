<x-guest-layout>
    <div class="auth-frame">
        <div class="auth-inner">
            <div class="auth-left">
                <h1>Welcome to SPIL</h1>
                <p>Manage letters, track reports, and stay on top of your organization's communications. Secure and simple.</p>
                <img src="{{ asset('images/auth-illustration.svg') }}" alt="illustration" class="auth-illustration" style="max-width:420px;max-height:320px;width:100%;height:auto;display:block;margin:0 auto;object-fit:contain;" />
            </div>

            <div class="auth-right">
                <div class="auth-card">
                <div class="text-center mb-4">
                    <h2 class="auth-title text-2xl">Selamat datang kembali</h2>
                    <p class="auth-subtitle">Masuk untuk mengelola surat dan laporan</p>
                </div>

                <!-- Session Status -->
                <x-auth-session-status class="mb-4" :status="session('status')" />

                <div class="mb-4">
                    <a href="#" class="btn-google w-full justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 533.5 544.3" aria-hidden="true"><path fill="#4285f4" d="M533.5 278.4c0-17.4-1.6-34.3-4.7-50.6H272v95.6h146.9c-6.3 33.9-25 62.6-53.4 81.8v68.1h86.1c50.4-46.4 80-115 80-194.9z"/><path fill="#34a853" d="M272 544.3c72.6 0 133.6-24 178.1-65.4l-86.1-68.1c-24 16.2-54.6 25.9-92 25.9-70.6 0-130.3-47.6-151.7-111.4H29.8v69.9C74 478.4 165 544.3 272 544.3z"/><path fill="#fbbc04" d="M120.3 324.8c-10.6-31.2-10.6-64.9 0-96.1V159h-90.5C8.6 205.6 0 242.8 0 278.4s8.6 72.8 29.8 119.4l90.5-73z"/><path fill="#ea4335" d="M272 108.9c39.4 0 75 13.6 103 40.2l77.4-77.4C409 24.5 343.9 0 272 0 165 0 74 65.9 29.8 159l90.5 69.9C141.7 156.5 201.4 108.9 272 108.9z"/></svg>
                        <span>Masuk dengan Google</span>
                    </a>
                </div>

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <!-- Email Address -->
                    <div class="mb-4">
                        <x-input-label for="email" :value="__('Email')" />
                        <x-text-input id="email" class="{{ $errors->has('email') ? 'input-error-border' : '' }} block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <!-- Password -->
                    <div class="mb-4">
                        <x-input-label for="password" :value="__('Password')" />

                        <x-text-input id="password" class="{{ $errors->has('password') ? 'input-error-border' : '' }} block mt-1 w-full"
                                        type="password"
                                        name="password"
                                        required autocomplete="current-password" />

                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <div class="flex items-center justify-between mt-6">
                        <div class="flex items-center">
                                <label for="remember_me" class="inline-flex items-center">
                                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                                <span class="ms-2 text-sm text-gray-600">Ingat saya</span>
                            </label>
                        </div>

                        <div class="text-right">
                                @if (Route::has('password.request'))
                                <a class="text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">Lupa kata sandi?</a>
                            @endif
                        </div>
                    </div>

                    <div class="mt-6">
                        <x-primary-button class="auth-cta w-full">
                            Masuk
                        </x-primary-button>
                    </div>
                </form>

                <div class="auth-footer mt-6">
                    <p>
                        Belum punya akun?
                        <a href="{{ route('register') }}" class="text-indigo-600 hover:underline">Buat akun</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
