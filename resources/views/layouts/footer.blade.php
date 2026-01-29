<!-- Footer -->
<footer class="bg-dark text-white mt-auto">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 lg:gap-12">
            <!-- Logo & Description -->
            <div>
                <div class="flex items-center mb-6">
                    <div class="bg-primary text-white p-3 rounded-lg mr-4">
                        <i class="fas fa-home text-2xl"></i>
                    </div>
                    <div>
                        <h1 class="text-2xl font-bold">Desa Cicangkang Hilir</h1>
                        <p class="text-gray-400 text-sm mt-1">Sistem Informasi Desa Digital</p>
                    </div>
                </div>
                <p class="text-gray-400 leading-relaxed">
                    Platform digital terintegrasi untuk mengelola administrasi, pelayanan publik, 
                    dan informasi desa yang modern dan efisien.
                </p>
                
                <div class="mt-6">
                    <h4 class="font-bold mb-3">Jam Operasional</h4>
                    <div class="space-y-1 text-gray-400 text-sm">
                        <div class="flex items-center">
                            <i class="fas fa-clock mr-2 text-primary"></i>
                            <span>Senin - Kamis: 08.00 - 15.00 WIB</span>
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-clock mr-2 text-primary"></i>
                            <span>Jumat: 08.00 - 11.00 WIB</span>
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-clock mr-2 text-primary"></i>
                            <span>Sabtu: 08.00 - 13.00 WIB</span>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Quick Links -->
            <div>
                <h3 class="text-lg font-bold mb-6 flex items-center">
                    <i class="fas fa-link mr-2 text-primary"></i>Tautan Cepat
                </h3>
                <ul class="space-y-3">
                    <li>
                        <a href="{{ route('landing-page') }}#home" 
                           class="text-gray-400 hover:text-white transition-colors duration-200 flex items-center group">
                            <i class="fas fa-chevron-right text-xs mr-2 text-primary group-hover:translate-x-1 transition-transform"></i>
                            Beranda
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('landing-page') }}#layanan" 
                           class="text-gray-400 hover:text-white transition-colors duration-200 flex items-center group">
                            <i class="fas fa-chevron-right text-xs mr-2 text-primary group-hover:translate-x-1 transition-transform"></i>
                            Layanan Desa
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('landing-page') }}#berita" 
                           class="text-gray-400 hover:text-white transition-colors duration-200 flex items-center group">
                            <i class="fas fa-chevron-right text-xs mr-2 text-primary group-hover:translate-x-1 transition-transform"></i>
                            Berita & Informasi
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('landing-page') }}#galeri" 
                           class="text-gray-400 hover:text-white transition-colors duration-200 flex items-center group">
                            <i class="fas fa-chevron-right text-xs mr-2 text-primary group-hover:translate-x-1 transition-transform"></i>
                            Galeri Desa
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('landing-page') }}#kontak" 
                           class="text-gray-400 hover:text-white transition-colors duration-200 flex items-center group">
                            <i class="fas fa-chevron-right text-xs mr-2 text-primary group-hover:translate-x-1 transition-transform"></i>
                            Kontak & Lokasi
                        </a>
                    </li>
                    
                    @auth
                        <li>
                            <a href="{{ route('admin.dashboard') }}" 
                               class="text-gray-400 hover:text-white transition-colors duration-200 flex items-center group">
                                <i class="fas fa-chevron-right text-xs mr-2 text-primary group-hover:translate-x-1 transition-transform"></i>
                                Dashboard Admin
                            </a>
                        </li>
                    @else
                        <li>
                            <a href="{{ route('login') }}" 
                               class="text-gray-400 hover:text-white transition-colors duration-200 flex items-center group">
                                <i class="fas fa-chevron-right text-xs mr-2 text-primary group-hover:translate-x-1 transition-transform"></i>
                                Masuk Admin
                            </a>
                        </li>
                    @endauth
                </ul>
            </div>
            
            <!-- Layanan -->
            <div>
                <h3 class="text-lg font-bold mb-6 flex items-center">
                    <i class="fas fa-hands-helping mr-2 text-accent"></i>Layanan Desa
                </h3>
                <ul class="space-y-3">
                    <li class="text-gray-400 flex items-center">
                        <i class="fas fa-check-circle text-accent mr-2 text-sm"></i>
                        Administrasi Kependudukan
                    </li>
                    <li class="text-gray-400 flex items-center">
                        <i class="fas fa-check-circle text-accent mr-2 text-sm"></i>
                        Pelayanan Surat Menyurat
                    </li>
                    <li class="text-gray-400 flex items-center">
                        <i class="fas fa-check-circle text-accent mr-2 text-sm"></i>
                        Pengaduan Masyarakat
                    </li>
                    <li class="text-gray-400 flex items-center">
                        <i class="fas fa-check-circle text-accent mr-2 text-sm"></i>
                        Informasi Publik
                    </li>
                    <li class="text-gray-400 flex items-center">
                        <i class="fas fa-check-circle text-accent mr-2 text-sm"></i>
                        Data Statistik Desa
                    </li>
                </ul>
                
                <!-- Quick Contact -->
                <div class="mt-8 pt-6 border-t border-gray-800">
                    <h4 class="font-bold mb-3 flex items-center">
                        <i class="fas fa-phone-alt mr-2 text-primary"></i>Kontak Cepat
                    </h4>
                    <div class="space-y-2">
                        <a href="tel:+622212345678" class="text-gray-400 hover:text-white transition-colors duration-200 flex items-center">
                            <i class="fas fa-phone mr-2 text-sm"></i>
                            (022) 1234-5678
                        </a>
                        <a href="https://wa.me/6281234567890" target="_blank" 
                           class="text-gray-400 hover:text-white transition-colors duration-200 flex items-center">
                            <i class="fab fa-whatsapp mr-2 text-sm"></i>
                            0812-3456-7890
                        </a>
                    </div>
                </div>
            </div>
            
            <!-- Newsletter & Social -->
            <div>
                <h3 class="text-lg font-bold mb-6 flex items-center">
                    <i class="fas fa-envelope mr-2 text-primary"></i>Berlangganan Info
                </h3>
                <p class="text-gray-400 mb-4 leading-relaxed">
                    Dapatkan informasi terbaru tentang perkembangan desa dan layanan langsung ke email Anda.
                </p>
                <form id="newsletter-form" class="flex mb-8">
                    <input type="email" placeholder="Email Anda" required
                           class="flex-grow px-4 py-3 rounded-l-lg text-dark focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent">
                    <button type="submit" 
                            class="bg-primary hover:bg-secondary px-4 py-3 rounded-r-lg transition-colors duration-200">
                        <i class="fas fa-paper-plane"></i>
                    </button>
                </form>
                
                <!-- Social Media -->
                <div>
                    <h4 class="font-bold mb-4 flex items-center">
                        <i class="fas fa-share-alt mr-2 text-primary"></i>Ikuti Kami
                    </h4>
                    <div class="flex space-x-3">
                        <a href="#" 
                           class="w-10 h-10 bg-gray-800 hover:bg-blue-600 text-white rounded-full flex items-center justify-center transition-colors duration-200">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" 
                           class="w-10 h-10 bg-gray-800 hover:bg-blue-400 text-white rounded-full flex items-center justify-center transition-colors duration-200">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" 
                           class="w-10 h-10 bg-gray-800 hover:bg-pink-600 text-white rounded-full flex items-center justify-center transition-colors duration-200">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="#" 
                           class="w-10 h-10 bg-gray-800 hover:bg-red-600 text-white rounded-full flex items-center justify-center transition-colors duration-200">
                            <i class="fab fa-youtube"></i>
                        </a>
                        <a href="#" 
                           class="w-10 h-10 bg-gray-800 hover:bg-green-500 text-white rounded-full flex items-center justify-center transition-colors duration-200">
                            <i class="fab fa-whatsapp"></i>
                        </a>
                    </div>
                </div>
                
                <!-- QR Code / Quick Access -->
                <div class="mt-8 pt-6 border-t border-gray-800">
                    <h4 class="font-bold mb-3 flex items-center">
                        <i class="fas fa-qrcode mr-2 text-primary"></i>Scan QR Code
                    </h4>
                    <p class="text-gray-400 text-sm mb-3">
                        Scan untuk mengakses website desa langsung dari smartphone Anda.
                    </p>
                    <div class="bg-white p-3 rounded-lg inline-block">
                        <div class="w-24 h-24 bg-gray-200 rounded flex items-center justify-center">
                            <i class="fas fa-qrcode text-4xl text-gray-400"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Copyright & Bottom Links -->
        <div class="border-t border-gray-800 mt-12 pt-8">
            <div class="flex flex-col md:flex-row justify-between items-center">
                <!-- Copyright -->
                <div class="text-center md:text-left mb-4 md:mb-0">
                    <p class="text-gray-400">
                        &copy; {{ date('Y') }} Desa Cicangkang Hilir. Hak Cipta Dilindungi.
                    </p>
                    <p class="text-gray-500 text-sm mt-1">
                        Kecamatan Cipongkor, Kabupaten Bandung Barat, Jawa Barat
                    </p>
                </div>
                
                <!-- Bottom Links -->
                <div class="flex flex-wrap justify-center gap-4">
                    <a href="#" class="text-gray-400 hover:text-white text-sm transition-colors duration-200">
                        Kebijakan Privasi
                    </a>
                    <span class="text-gray-600">•</span>
                    <a href="#" class="text-gray-400 hover:text-white text-sm transition-colors duration-200">
                        Syarat & Ketentuan
                    </a>
                    <span class="text-gray-600">•</span>
                    <a href="#" class="text-gray-400 hover:text-white text-sm transition-colors duration-200">
                        Peta Situs
                    </a>
                    <span class="text-gray-600">•</span>
                    <a href="#" class="text-gray-400 hover:text-white text-sm transition-colors duration-200">
                        Bantuan
                    </a>
                </div>
            </div>
            
            <!-- Accreditation -->
            <div class="mt-6 text-center">
                <p class="text-gray-500 text-xs">
                    Dikembangkan dengan ❤️ untuk mendukung transformasi digital desa di Indonesia.
                </p>
            </div>
        </div>
    </div>
</footer>

<script>
    // Newsletter form submission
    document.addEventListener('DOMContentLoaded', function() {
        const newsletterForm = document.getElementById('newsletter-form');
        if (newsletterForm) {
            newsletterForm.addEventListener('submit', function(e) {
                e.preventDefault();
                const emailInput = this.querySelector('input[type="email"]');
                const email = emailInput.value;
                
                if (email) {
                    // Show success message
                    const button = this.querySelector('button');
                    const originalHtml = button.innerHTML;
                    
                    button.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';
                    button.disabled = true;
                    
                    // Simulate API call
                    setTimeout(() => {
                        alert('Terima kasih! Email ' + email + ' telah berhasil didaftarkan untuk newsletter.');
                        emailInput.value = '';
                        button.innerHTML = originalHtml;
                        button.disabled = false;
                    }, 1000);
                }
            });
        }
    });
</script>