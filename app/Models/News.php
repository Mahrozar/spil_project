<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class News extends Model
{
    protected $fillable = [
        'title', 'slug', 'excerpt', 'content', 'thumbnail',
        'published_at', 'is_published', 'author_id', 'views'
    ];

    protected $casts = [
        'published_at' => 'date',
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
            return asset('storage/' . $this->thumbnail);
        }
        return asset('images/default-news.jpg');
    }

    public function getPublishedDateAttribute()
    {
        return $this->published_at->format('d F Y');
    }

    public function getShortExcerptAttribute()
    {
        return Str::limit($this->excerpt ?? $this->content, 150);
    }
}