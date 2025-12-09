<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\LetterSubmission;
use Illuminate\Support\Str;
use Faker\Factory as Faker;

class LetterSubmissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        $statuses = [
            LetterSubmission::STATUS_PENDING,
            LetterSubmission::STATUS_APPROVE,
            LetterSubmission::STATUS_ON_PROGRESS,
            LetterSubmission::STATUS_REJECTED,
        ];

        for ($i = 0; $i < 10; $i++) {
            LetterSubmission::create([
                'submission_number' => 'SB' . strtoupper(Str::random(6)),
                'jenis_surat' => $faker->randomElement([
                    'Surat Keterangan Domisili',
                    'Surat Keterangan Tidak Mampu',
                    'Surat Keterangan Usaha',
                    'Surat Pengantar SKCK',
                    'Surat Keterangan Pindah Domisili',
                    'Surat Keterangan Belum Menikah',
                    'Surat Keterangan Kelahiran',
                    'Surat Keterangan Kematian',
                    'Surat Pernyataan',
                    'Surat Kuasa'
                ]),
                'nama' => $faker->name,
                'nik' => $faker->unique()->numerify('################'),
                'alamat' => $faker->address,
                'keperluan' => $faker->sentence(6),
                'telepon' => $faker->phoneNumber,
                'email' => $faker->unique()->safeEmail,
                'status' => $faker->randomElement($statuses),
            ]);
        }
    }
}
