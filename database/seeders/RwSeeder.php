<?php

namespace Database\Seeders;

use App\Models\RW;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class RwSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $rws = [
            [
                'name' => 'RW 001',
                'ketua_rw' => 'Saepudin',
                'no_hp_ketua_rw' => '081234567890',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'RW 002',
                'ketua_rw' => 'Edi Iskandar',
                'no_hp_ketua_rw' => '081234567891',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'RW 003',
                'ketua_rw' => 'Endang',
                'no_hp_ketua_rw' => '081234567892',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'RW 004',
                'ketua_rw' => 'Budi',
                'no_hp_ketua_rw' => '081234567893',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'RW 005',
                'ketua_rw' => 'Odis Rukmana',
                'no_hp_ketua_rw' => '081234567894',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'RW 006',
                'ketua_rw' => 'Dedi Rusmiadi',
                'no_hp_ketua_rw' => '081234567895',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'RW 007',
                'ketua_rw' => 'Aceng Supriatna',
                'no_hp_ketua_rw' => '081234567895',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'RW 008',
                'ketua_rw' => 'Nirmana',
                'no_hp_ketua_rw' => '081234567895',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'RW 009',
                'ketua_rw' => 'Iim Hidayat',
                'no_hp_ketua_rw' => '081234567895',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'RW 010',
                'ketua_rw' => 'Oleh',
                'no_hp_ketua_rw' => '081234567895',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'RW 011',
                'ketua_rw' => 'Adang',
                'no_hp_ketua_rw' => '081234567895',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'RW 012',
                'ketua_rw' => 'Mustopa',
                'no_hp_ketua_rw' => '081234567895',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'RW 013',
                'ketua_rw' => 'Asum Sumarna',
                'no_hp_ketua_rw' => '081234567895',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ];

        // Insert data ke database
        RW::insert($rws);
    }
}