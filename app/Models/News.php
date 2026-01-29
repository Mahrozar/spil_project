<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class News extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'excerpt',
        'content',
        'thumbnail',
        'published_at',
        'is_published',
        'author_id',
        'views'
    ];

    protected $casts = [
        'published_at' => 'datetime',
        'is_published' => 'boolean'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($news) {
            if (empty($news->slug)) {
                $news->slug = Str::slug($news->title);
            }
        });
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function getThumbnailUrlAttribute()
    {
        if ($this->thumbnail) {
            // Pastikan storage link sudah dibuat: php artisan storage:link
            return asset('storage/' . $this->thumbnail);
        }
        return asset('images/default-news.jpg');
    }

    public function getPublishedDateAttribute()
    {
        return $this->published_at ? $this->published_at->format('d F Y') : 'Belum dipublikasikan';
    }

    public function getShortExcerptAttribute()
    {
        return Str::limit($this->excerpt ?? strip_tags($this->content), 150);
    }
}