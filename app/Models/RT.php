<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RT extends Model
{
    use HasFactory;

    protected $fillable = ['rw_id', 'name', 'leader_name', 'phone', 'centroid_lat', 'centroid_lng'];

    public function rw()
    {
        return $this->belongsTo(RW::class);
    }

    public function residents()
    {
        return $this->hasMany(Resident::class);
    }
}
