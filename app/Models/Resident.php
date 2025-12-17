<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resident extends Model
{
    use HasFactory;

    protected $fillable = [
        'nik', 'name', 'dob', 'gender', 'kk_number', 'rt_id', 'rw_id', 'occupation', 'education', 'phone', 'address', 'source_import', 'is_head'
    ];

    protected $dates = ['dob'];

    protected $casts = [
        'is_head' => 'boolean',
    ];

    public function household()
    {
        return $this->belongsTo(Household::class);
    }

    public function rt()
    {
        return $this->belongsTo(RT::class);
    }

    public function rw()
    {
        return $this->belongsTo(RW::class);
    }
}
