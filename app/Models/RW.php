<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RW extends Model
{
    use HasFactory;

    // table name is 'rws' (migration uses 'rws'),
    // Eloquent's default pluralization for class 'RW' would be 'r_w_s',
    // so we explicitly set the table name here.
    protected $table = 'rws';

    protected $fillable = ['name'];

    public function rts()
    {
        return $this->hasMany(RT::class);
    }

    public function residents()
    {
        return $this->hasMany(Resident::class);
    }
}
