<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RT extends Model
{
    use HasFactory;

    // table name is 'rts' (migration uses 'rts'),
    // Eloquent's default pluralization for class 'RT' would be 'r_t_s',
    // so we explicitly set the table name here.
    protected $table = 'rts';

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
