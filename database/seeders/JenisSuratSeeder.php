<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class JenisSuratSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $items = [
            ['nama_surat' => 'Surat Keterangan Domisili', 'keterangan' => 'Keterangan domisili warga', 'status' => 'active'],
            ['nama_surat' => 'Surat Keterangan Tidak Mampu', 'keterangan' => 'Keterangan tidak mampu (SKTM)', 'status' => 'active'],
            ['nama_surat' => 'Surat Keterangan Usaha', 'keterangan' => 'Keterangan usaha', 'status' => 'active'],
            ['nama_surat' => 'Surat Pengantar SKCK', 'keterangan' => 'Surat pengantar pembuatan SKCK', 'status' => 'active'],
            ['nama_surat' => 'Surat Keterangan Pindah Domisili', 'keterangan' => 'Keterangan pindah domisili', 'status' => 'active'],
            ['nama_surat' => 'Surat Keterangan Belum Menikah', 'keterangan' => 'Keterangan belum menikah', 'status' => 'active'],
            ['nama_surat' => 'Surat Keterangan Kelahiran', 'keterangan' => 'Keterangan kelahiran anak', 'status' => 'active'],
            ['nama_surat' => 'Surat Keterangan Kematian', 'keterangan' => 'Keterangan kematian', 'status' => 'active'],
            ['nama_surat' => 'Surat Pernyataan', 'keterangan' => 'Surat pernyataan umum', 'status' => 'active'],
            ['nama_surat' => 'Surat Kuasa', 'keterangan' => 'Surat kuasa', 'status' => 'active'],
        ];

        foreach ($items as $item) {
            DB::table('jenis_surat')->updateOrInsert(
                ['nama_surat' => $item['nama_surat']],
                ['keterangan' => $item['keterangan'], 'status' => $item['status'], 'updated_at' => now(), 'created_at' => now()]
            );
        }
    }
}
