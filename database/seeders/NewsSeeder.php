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
                'content' => 'Isi lengkap berita tentang Program Bantuan Sosial...',
                'published_at' => Carbon::now()->subDays(2),
            ],
            [
                'title' => 'Gotong Royong Perbaikan Jalan Dusun',
                'excerpt' => 'Ayo ramaikan kegiatan gotong royong perbaikan jalan dusun pada hari Sabtu, 18 Maret 2024.',
                'content' => 'Isi lengkap berita tentang Gotong Royong...',
                'published_at' => Carbon::now()->subDays(5),
            ],
            [
                'title' => 'Pelatihan Digital Marketing UMKM',
                'excerpt' => 'Pelatihan gratis untuk pelaku UMKM desa dalam memanfaatkan digital untuk pemasaran produk.',
                'content' => 'Isi lengkap berita tentang Pelatihan Digital Marketing...',
                'published_at' => Carbon::now()->subDays(8),
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