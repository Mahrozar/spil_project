<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfilDesaController extends Controller
{
    /**
     * Menampilkan halaman Visi & Misi Desa
     */
    public function visiMisi()
    {
        return view('profileDesa.visi-misi', [
            'title' => 'Visi & Misi - Desa Cicangkang Hilir'
        ]);
    }

    /**
     * Menampilkan halaman Sejarah Desa
     */
    public function sejarah()
    {
        return view('profileDesa.sejarah', [
            'title' => 'Sejarah - Desa Cicangkang Hilir'
        ]);
    }

    /**
     * Menampilkan halaman Struktur Pemerintahan Desa
     */
    public function struktur()
    {
        return view('profileDesa.struktur', [
            'title' => 'Struktur Pemerintahan - Desa Cicangkang Hilir'
        ]);
    }
}