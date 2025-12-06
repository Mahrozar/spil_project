<?php

namespace App\Imports;

use App\Models\Resident;
use App\Models\RT;
use App\Models\RW;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;

class ResidentsImport implements ToModel, WithHeadingRow, WithBatchInserts, WithChunkReading
{
    public int $created = 0;
    public int $updated = 0;
    public int $skipped = 0;

    public function model(array $row)
    {
        // Expected headings: nik, name, dob, gender, kk_number, rt_id or rt_name, rw_id or rw_name, occupation, education, phone, address
        $rtId = null;
        $rwId = null;

        if (!empty($row['rt_id'])) {
            $rtId = $row['rt_id'];
        } elseif (!empty($row['rt_name'])) {
            $rt = RT::where('name', $row['rt_name'])->first();
            $rtId = $rt->id ?? null;
        }

        if (!empty($row['rw_id'])) {
            $rwId = $row['rw_id'];
        } elseif (!empty($row['rw_name'])) {
            $rw = RW::where('name', $row['rw_name'])->first();
            $rwId = $rw->id ?? null;
        }

        $data = [
            'nik' => $row['nik'] ?? null,
            'name' => $row['name'] ?? null,
            'dob' => !empty($row['dob']) ? date('Y-m-d', strtotime($row['dob'])) : null,
            'gender' => $row['gender'] ?? null,
            'kk_number' => $row['kk_number'] ?? null,
            'rt_id' => $rtId,
            'rw_id' => $rwId,
            'occupation' => $row['occupation'] ?? null,
            'education' => $row['education'] ?? null,
            'phone' => $row['phone'] ?? null,
            'address' => $row['address'] ?? null,
        ];

        // Skip rows without a name
        if (empty($data['name'])) {
            $this->skipped++;
            return null;
        }

        // If NIK provided, update existing resident or create new one
        if (!empty($data['nik'])) {
            $existing = Resident::where('nik', $data['nik'])->first();
            if ($existing) {
                $existing->update($data);
                $this->updated++;
                return $existing;
            }
            $this->created++;
            return Resident::create($data);
        }

        // No NIK: create a new resident record
        $this->created++;
        return Resident::create($data);
    }

    public function batchSize(): int
    {
        return 1000;
    }

    public function chunkSize(): int
    {
        return 1000;
    }
}
