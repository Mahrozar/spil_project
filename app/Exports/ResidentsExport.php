<?php

namespace App\Exports;

use App\Models\Resident;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ResidentsExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Resident::select([
            'nik','name','dob','gender','kk_number','rt_id','rw_id','occupation','education','phone','address'
        ])->get();
    }

    public function headings(): array
    {
        return [
            'nik','name','dob','gender','kk_number','rt_id','rw_id','occupation','education','phone','address'
        ];
    }
}
