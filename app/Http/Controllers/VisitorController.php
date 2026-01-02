<?php

namespace App\Http\Controllers;

use App\Models\Visitor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class VisitorController extends Controller
{
    /**
     * Tampilkan form buku tamu sederhana
     */
    public function showForm()
    {
        // Jika sudah mengisi, redirect ke home
        if (session('visitor_registered')) {
            return redirect()->route('landing-page');
        }
        
        return view('visitor.form');
    }

    /**
     * Simpan data pengunjung sederhana
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:100',
            'alamat' => 'required|string|max:200'
        ]);

        // Cek apakah sudah pernah mengisi di sesi ini
        $sessionId = Session::getId();
        $today = now()->startOfDay();
        
        $existingVisitor = Visitor::where('session_id', $sessionId)
            ->where('visited_at', '>=', $today)
            ->first();

        if ($existingVisitor) {
            session(['visitor_registered' => true]);
            session(['visitor_name' => $existingVisitor->nama]);
            return redirect()->route('landing-page');
        }

        // Simpan data baru
        Visitor::create([
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'session_id' => $sessionId,
            'ip_address' => $request->ip(),
            'visited_at' => now()
        ]);

        // Set session
        session(['visitor_registered' => true]);
        session(['visitor_name' => $request->nama]);

        return redirect()->route('landing-page');
    }

    /**
     * Periksa status pengunjung
     */
    public function checkVisitor()
    {
        // Cek session
        if (session('visitor_registered')) {
            return true;
        }

        // Cek database berdasarkan session_id
        $sessionId = Session::getId();
        $today = now()->startOfDay();
        
        $visitor = Visitor::where('session_id', $sessionId)
            ->where('visited_at', '>=', $today)
            ->first();

        if ($visitor) {
            session(['visitor_registered' => true]);
            session(['visitor_name' => $visitor->nama]);
            return true;
        }

        return false;
    }
}