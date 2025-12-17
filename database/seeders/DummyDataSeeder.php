<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class DummyDataSeeder extends Seeder
{
    public function run()
    {
        // Ensure imports directory exists
        Storage::makeDirectory('imports');
        Storage::makeDirectory('imports/errors');

        // Create 3 sample import summary JSON files
        $samples = [
            [
                'file' => 'residents-sample-1.xlsx',
                'created' => 12,
                'updated' => 8,
                'skipped' => 4,
            ],
            [
                'file' => 'residents-sample-2.xlsx',
                'created' => 5,
                'updated' => 10,
                'skipped' => 0,
            ],
            [
                'file' => 'residents-sample-3.csv',
                'created' => 20,
                'updated' => 0,
                'skipped' => 2,
            ],
        ];

        $now = now();
        foreach ($samples as $i => $s) {
            $ts = $now->copy()->subDays($i)->format('Y-m-d H:i:s');
            $summary = [
                'user_id' => 1,
                'file' => $s['file'],
                'created' => $s['created'],
                'updated' => $s['updated'],
                'skipped' => $s['skipped'],
                'timestamp' => $ts,
            ];
            $filename = 'imports/import-sample-' . ($i+1) . '-' . $now->copy()->subDays($i)->format('Ymd-His') . '.json';
            Storage::put($filename, json_encode($summary, JSON_PRETTY_PRINT));

            // Also write a small error CSV for one of them
            if ($i === 2) {
                $errorCsv = "nik,name,error\n";
                $errorCsv .= "123456789012345,John Doe,Missing RT\n";
                $errorCsv .= "234567890123456,Jane Smith,Invalid NIK length\n";
                $errName = 'imports/errors/import-sample-' . ($i+1) . '-errors.csv';
                Storage::put($errName, $errorCsv);
            }
        }
    }
}
