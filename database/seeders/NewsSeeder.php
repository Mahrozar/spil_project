<?php

namespace Database\Seeders;

use App\Models\News;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class NewsSeeder extends Seeder
{
    public function run()
    {
        $news = [
            [
                'title' => 'Program Bantuan Sosial Tahap II',
                'excerpt' => 'Pendistribusian bantuan sosial untuk masyarakat terdampak akan dilaksanakan mulai minggu depan.',
                'content' => '<p>Pemerintah Desa Cicangkang Hilir akan melaksanakan pendistribusian bantuan sosial tahap II mulai minggu depan. Program ini ditujukan untuk masyarakat yang terdampak ekonomi akibat berbagai faktor.</p>
                <p>Bantuan akan disalurkan dalam bentuk sembako dan bantuan tunai kepada 250 kepala keluarga yang telah terdaftar dalam program ini.</p>
                <p>Warga diharapkan membawa KTP dan Kartu Keluarga asli saat pengambilan bantuan di Balai Desa.</p>',
                'thumbnail' => 'https://images.unsplash.com/photo-1582213782179-e0d53f98f2ca?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
                'published_at' => Carbon::now()->subDays(2),
            ],
            [
                'title' => 'Gotong Royong Perbaikan Jalan Dusun',
                'excerpt' => 'Ayo ramaikan kegiatan gotong royong perbaikan jalan dusun pada hari Sabtu, 18 Maret 2024.',
                'content' => '<p>Dalam rangka meningkatkan aksesibilitas dan kenyamanan warga, Desa Cicangkang Hilir akan mengadakan kegiatan gotong royong perbaikan jalan dusun.</p>
                <p>Kegiatan akan dilaksanakan:</p>
                <ul>
                    <li>Hari/Tanggal: Sabtu, 18 Maret 2024</li>
                    <li>Waktu: 07.00 - 12.00 WIB</li>
                    <li>Lokasi: Jalan Dusun Krajan RT 01-03</li>
                </ul>
                <p>Warga diharapkan membawa alat kerja seperti cangkul, sekop, dan gerobak.</p>',
                'thumbnail' => 'https://images.unsplash.com/photo-1544636331-e26879cd4d9b?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
                'published_at' => Carbon::now()->subDays(5),
            ],
            [
                'title' => 'Pelatihan Digital Marketing UMKM',
                'excerpt' => 'Pelatihan gratis untuk pelaku UMKM desa dalam memanfaatkan digital untuk pemasaran produk.',
                'content' => '<p>Dinas Koperasi dan UMKM bekerjasama dengan Desa Cicangkang Hilir akan mengadakan pelatihan digital marketing untuk pelaku UMKM.</p>
                <p>Pelatihan ini bertujuan untuk:</p>
                <ol>
                    <li>Meningkatkan penjualan produk UMKM melalui platform digital</li>
                    <li>Memperluas jangkauan pasar</li>
                    <li>Meningkatkan branding produk lokal</li>
                </ol>
                <p>Pendaftaran dibuka mulai hari ini melalui Kantor Desa atau WhatsApp Admin.</p>',
                'thumbnail' => 'https://images.unsplash.com/photo-1551434678-e076c223a692?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
                'published_at' => Carbon::now()->subDays(8),
            ],
            [
                'title' => 'Pembangunan Taman Baca Masyarakat',
                'excerpt' => 'Desa Cicangkang Hilir akan membangun taman baca masyarakat untuk meningkatkan minat baca warga.',
                'content' => '<p>Dalam upaya meningkatkan literasi dan minat baca masyarakat, Pemerintah Desa Cicangkang Hilir akan membangun Taman Baca Masyarakat (TBM).</p>
                <p>TBM akan dilengkapi dengan:</p>
                <ul>
                    <li>Koleksi buku anak-anak dan dewasa</li>
                    <li>Area baca yang nyaman</li>
                    <li>Wi-Fi gratis</li>
                    <li>Komputer untuk akses digital</li>
                </ul>
                <p>Donasi buku masih dibuka untuk umum.</p>',
                'thumbnail' => 'https://images.unsplash.com/photo-1524995997946-a1c2e315a42f?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
                'published_at' => Carbon::now()->subDays(10),
            ],
            [
                'title' => 'Posyandu Bulanan April 2024',
                'excerpt' => 'Jadwal posyandu bulan April 2024 untuk bayi, balita, dan ibu hamil.',
                'content' => '<p>Posyandu Desa Cicangkang Hilir akan dilaksanakan pada:</p>
                <p><strong>Hari/Tanggal:</strong> Rabu, 10 April 2024<br>
                <strong>Waktu:</strong> 08.00 - 12.00 WIB<br>
                <strong>Tempat:</strong> Balai Desa Cicangkang Hilir</p>
                <p>Layanan yang tersedia:</p>
                <ul>
                    <li>Penimbangan berat badan bayi dan balita</li>
                    <li>Pemberian vitamin A</li>
                    <li>Imunisasi</li>
                    <li>Konsultasi gizi</li>
                    <li>Pemeriksaan ibu hamil</li>
                </ul>',
                'thumbnail' => 'https://images.unsplash.com/photo-1519494026892-80bbd2d6fd0d?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
                'published_at' => Carbon::now()->subDays(12),
            ],
            [
                'title' => 'Pelaksanaan Sensus Pertanian 2024',
                'excerpt' => 'Sensus pertanian akan dilaksanakan mulai bulan Mei 2024 untuk mendata potensi pertanian desa.',
                'content' => '<p>Badan Pusat Statistik (BPS) bekerjasama dengan Pemerintah Desa akan melaksanakan Sensus Pertanian 2024.</p>
                <p>Sensus ini bertujuan untuk:</p>
                <ol>
                    <li>Memetakan potensi pertanian desa</li>
                    <li>Mendata petani dan lahan pertanian</li>
                    <li>Merencanakan program pembangunan pertanian</li>
                </ol>
                <p>Petugas sensus akan mendatangi rumah-rumah warga mulai 1 Mei 2024. Warga diharapkan kooperatif dan memberikan data yang akurat.</p>',
                'thumbnail' => 'https://images.unsplash.com/photo-1500382017468-9049fed747ef?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
                'published_at' => Carbon::now()->subDays(15),
            ],
        ];
        
        foreach ($news as $item) {
            News::create(array_merge($item, [
                'is_published' => true,
                'author_id' => 1,
            ]));
        }
    }
}