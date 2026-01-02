<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visitor extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'alamat',
        'session_id',
        'ip_address',
        'visited_at'
    ];

    protected $casts = [
        'visited_at' => 'datetime'
    ];
}