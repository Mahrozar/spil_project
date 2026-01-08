<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'image_path',
        'type',
        'video_url',
        'order',
        'is_active',
        'category'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'order' => 'integer'
    ];

    /**
     * Scope untuk galeri aktif
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope untuk foto saja
     */
    public function scopePhotos($query)
    {
        return $query->where('type', 'photo');
    }

    /**
     * Scope untuk video saja
     */
    public function scopeVideos($query)
    {
        return $query->where('type', 'video');
    }

    /**
     * Scope untuk urutan
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('order')->orderBy('created_at', 'desc');
    }

    /**
     * Get next gallery (based on order and created_at)
     */
    public function next()
    {
        return self::active()
            ->where(function($query) {
                $query->where('order', '>', $this->order)
                      ->orWhere(function($q) {
                          $q->where('order', '=', $this->order)
                            ->where('created_at', '>', $this->created_at);
                      });
            })
            ->orderBy('order')
            ->orderBy('created_at')
            ->first();
    }

    /**
     * Get previous gallery (based on order and created_at)
     */
    public function previous()
    {
        return self::active()
            ->where(function($query) {
                $query->where('order', '<', $this->order)
                      ->orWhere(function($q) {
                          $q->where('order', '=', $this->order)
                            ->where('created_at', '<', $this->created_at);
                      });
            })
            ->orderBy('order', 'desc')
            ->orderBy('created_at', 'desc')
            ->first();
    }

    /**
     * Get related galleries (same category)
     */
    public function related()
    {
        return self::active()
            ->where('category', $this->category)
            ->where('id', '!=', $this->id)
            ->ordered()
            ->limit(3)
            ->get();
    }
}