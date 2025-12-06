<!-- Footer -->
<footer class="bg-dark text-white py-12">
    <div class="container mx-auto px-6">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
            <!-- Logo & Description -->
            <div>
                <div class="flex items-center mb-4">
                    <div class="bg-primary text-white p-2 rounded-lg mr-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-xl font-bold">SIDeKa</h1>
                        <p class="text-gray-400 text-sm">Sistem Informasi Desa Digital</p>
                    </div>
                </div>
                <p class="text-gray-400">Platform digital terintegrasi untuk mengelola administrasi, pelayanan publik, dan informasi desa.</p>
            </div>
            
            <!-- Quick Links -->
            <div>
                <h3 class="text-lg font-bold mb-6">Tautan Cepat</h3>
                <ul class="space-y-3">
                    <li><a href="{{ route('landing-page') }}#home" class="text-gray-400 hover:text-white">Beranda</a></li>
                    <li><a href="{{ route('landing-page') }}#fitur" class="text-gray-400 hover:text-white">Fitur</a></li>
                    <li><a href="{{ route('landing-page') }}#layanan" class="text-gray-400 hover:text-white">Layanan</a></li>
                    <li><a href="{{ route('landing-page') }}#statistik" class="text-gray-400 hover:text-white">Statistik</a></li>
                    <li><a href="{{ route('landing-page') }}#kontak" class="text-gray-400 hover:text-white">Kontak</a></li>
                    
                    @auth
                        <li><a href="{{ route('home') }}" class="text-gray-400 hover:text-white">Dashboard</a></li>
                    @else
                        <li><a href="{{ route('login') }}" class="text-gray-400 hover:text-white">Masuk</a></li>
                        <li><a href="{{ route('register') }}" class="text-gray-400 hover:text-white">Daftar</a></li>
                    @endauth
                </ul>
            </div>
            
            <!-- Services -->
            <div>
                <h3 class="text-lg font-bold mb-6">Layanan</h3>
                <ul class="space-y-3">
                    <li class="text-gray-400">Administrasi Kependudukan</li>
                    <li class="text-gray-400">Pelayanan Surat Menyurat</li>
                    <li class="text-gray-400">Keuangan & APBDes</li>
                    <li class="text-gray-400">UMKM Digital</li>
                    <li class="text-gray-400">Informasi Publik</li>
                </ul>
            </div>
            
            <!-- Newsletter & Social -->
            <div>
                <h3 class="text-lg font-bold mb-6">Berlangganan Newsletter</h3>
                <p class="text-gray-400 mb-4">Dapatkan informasi terbaru tentang perkembangan SIDeKa.</p>
                <form id="newsletter-form" class="flex">
                    <input type="email" placeholder="Email Anda" required
                           class="flex-grow px-4 py-2 rounded-l-lg text-dark focus:outline-none focus:ring-2 focus:ring-primary">
                    <button type="submit" class="bg-primary hover:bg-secondary px-4 py-2 rounded-r-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                        </svg>
                    </button>
                </form>
                
                <div class="mt-6">
                    <h4 class="font-bold mb-4">Ikuti Kami</h4>
                    <div class="flex space-x-4">
                        <a href="#" class="bg-gray-800 hover:bg-gray-700 p-2 rounded-lg transition duration-300">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                            </svg>
                        </a>
                        <a href="#" class="bg-gray-800 hover:bg-gray-700 p-2 rounded-lg transition duration-300">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.213c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/>
                            </svg>
                        </a>
                        <a href="#" class="bg-gray-800 hover:bg-gray-700 p-2 rounded-lg transition duration-300">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
                            </svg>
                        </a>
                        <a href="#" class="bg-gray-800 hover:bg-gray-700 p-2 rounded-lg transition duration-300">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z"/>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Copyright -->
        <div class="border-t border-gray-800 mt-8 pt-8 text-center text-gray-400">
            <p>&copy; {{ date('Y') }} SIDeKa - Sistem Informasi Desa Digital. Hak Cipta Dilindungi.</p>
            <p class="mt-2">Dikembangkan untuk mendukung transformasi digital desa di Indonesia.</p>
        </div>
    </div>
</footer>

<script>
    // Newsletter form submission
    document.getElementById('newsletter-form').addEventListener('submit', function(e) {
        e.preventDefault();
        const email = this.querySelector('input[type="email"]').value;
        
        // Simulasi pengiriman
        alert('Terima kasih! Email ' + email + ' telah berhasil didaftarkan untuk newsletter.');
        this.reset();
    });
</script>