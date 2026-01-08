<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    /**
     * Menampilkan halaman index galeri
     */
    public function index(Request $request)
    {
        // Ambil parameter pencarian dan kategori
        $search = $request->input('search');
        $category = $request->input('category');
        
        // Query galeri
        $query = Gallery::active()->ordered();
        
        // Filter berdasarkan pencarian
        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', '%' . $search . '%')
                  ->orWhere('description', 'like', '%' . $search . '%');
            });
        }
        
        // Filter berdasarkan kategori
        if ($category) {
            $query->where('category', $category);
        }
        
        // Pagination dengan 9 item per halaman
        $galleries = $query->paginate(9);
        
        // Ambil semua kategori unik untuk filter
        $categories = Gallery::active()
            ->select('category')
            ->whereNotNull('category')
            ->distinct()
            ->pluck('category');
            
        return view('gallery.index', compact('galleries', 'categories', 'category', 'search'));
    }

    /**
     * Menampilkan detail galeri
     */
    public function show($id)
    {
        $gallery = Gallery::active()->findOrFail($id);
        
        // Ambil galeri terkait menggunakan method related()
        $relatedGalleries = $gallery->related();
            
        return view('gallery.show', compact('gallery', 'relatedGalleries'));
    }
}