<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ReportPhoto extends Model
{
    use HasFactory;

    protected $fillable = [
        'report_id',
        'photo_path',
        'thumbnail_path',
        'caption',
        'order',
        'is_before',
    ];

    protected $casts = [
        'is_before' => 'boolean',
    ];

    // Relationships
    public function report()
    {
        return $this->belongsTo(Report::class);
    }

    // Accessors
    public function getPhotoUrlAttribute()
    {
        return asset('storage/' . $this->photo_path);
    }

    public function getThumbnailUrlAttribute()
    {
        if ($this->thumbnail_path) {
            return asset('storage/' . $this->thumbnail_path);
        }
        return $this->photo_url;
    }

    // Methods
    public function isImage()
    {
        $ext = pathinfo($this->photo_path, PATHINFO_EXTENSION);
        return in_array(strtolower($ext), ['jpg', 'jpeg', 'png', 'gif', 'webp']);
    }
}