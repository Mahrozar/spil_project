<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RT extends Model
{
    use HasFactory;

    protected $table = 'rts';

    protected $fillable = ['rw_id', 'name', 'leader_name', 'phone'];

    public function rw()
    {
        return $this->belongsTo(RW::class, 'rw_id');
    }

    public function residents()
    {
        return $this->hasMany(Resident::class, 'rt_id');
    }
}
