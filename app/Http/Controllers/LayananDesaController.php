<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LayananDesaController extends Controller
{
    /**
     * Menampilkan halaman Prosedur Layanan
     */
    public function prosedur()
    {
        return view('layanan.prosedur', [
            'title' => 'Prosedur Layanan - Desa Cicangkang Hilir'
        ]);
    }

    /**
     * Menampilkan halaman Dokumen Desa
     */
    public function dokumen()
    {
        return view('layanan.dokumen', [
            'title' => 'Dokumen Desa - Desa Cicangkang Hilir'
        ]);
    }

    /**
     * Menampilkan halaman Ajukan Surat Online
     */
    public function suratOnline()
    {
        return view('layanan.surat-online', [
            'title' => 'Ajukan Surat Online - Desa Cicangkang Hilir'
        ]);
    }

    /**
     * Proses pengajuan surat online
     */
    public function submitSurat(Request $request)
    {
        $request->validate([
            'jenis_surat' => 'required|string',
            'nama' => 'required|string|max:255',
            'nik' => 'required|string|size:16',
            'alamat' => 'required|string',
            'keperluan' => 'required|string',
            'telepon' => 'required|string',
            'email' => 'nullable|email',
        ]);

        // Di sini Anda bisa menambahkan logika penyimpanan ke database
        
        return redirect()->route('layanan.surat-online')
            ->with('success', 'Pengajuan surat Anda berhasil dikirim. Akan diproses dalam 1-3 hari kerja.');
    }
}