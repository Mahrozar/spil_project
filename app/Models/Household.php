<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Household extends Model
{
    use HasFactory;

    protected $fillable = [
        'kk_number', 'head_id'
    ];

    public function residents()
    {
        return $this->hasMany(Resident::class);
    }

    public function head()
    {
        return $this->belongsTo(Resident::class, 'head_id');
    }
}
