<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index()
    {
        $news = News::where('is_published', true)
            ->where('published_at', '<=', now())
            ->orderBy('published_at', 'desc')
            ->paginate(12);
            
        return view('news.index', compact('news'));
    }
    
    public function show($slug)
    {
        $news = News::where('slug', $slug)
            ->where('is_published', true)
            ->where('published_at', '<=', now())
            ->firstOrFail();
            
        // Increment views
        $news->increment('views');
            
        return view('news.show', compact('news'));
    }
}