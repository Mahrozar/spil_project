<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RW extends Model
{
    use HasFactory;

    protected $table = 'rws';

    protected $fillable = [
        'name',
        'ketua_rw',
        'no_hp_ketua_rw'
    ];

    // Jika foreign key adalah 'rw_id'
    public function rts()
    {
        return $this->hasMany(RT::class, 'rw_id');
    }

    public function residents()
    {
        return $this->hasMany(Resident::class, 'rw_id');
    }
}