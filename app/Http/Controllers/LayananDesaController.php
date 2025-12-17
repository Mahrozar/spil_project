<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LetterSubmission;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

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

        // Generate unique submission number
        $submissionNumber = 'SB' . strtoupper(Str::random(6));

        // Save to database
        $submission = LetterSubmission::create([
            'submission_number' => $submissionNumber,
            'jenis_surat' => $request->jenis_surat,
            'nama' => $request->nama,
            'nik' => $request->nik,
            'alamat' => $request->alamat,
            'keperluan' => $request->keperluan,
            'telepon' => $request->telepon,
            'email' => $request->email,
            'status' => 'pending',
        ]);

        return redirect()->route('layanan.surat-online')
            ->with('success', "Pengajuan surat Anda berhasil dikirim. Nomor pengajuan: {$submissionNumber}. Akan diproses dalam 1-3 hari kerja.");
    }
    public function suratOnlineStatus(Request $request)
    {
        // Jika ada data POST, cari status
        if ($request->isMethod('post')) {
            $request->validate([
                'submission_number' => 'required|string',
                'nik' => 'required|string|size:16',
            ]);

            // Cari pengajuan berdasarkan nomor dan NIK
            $submission = DB::table('letter_submissions')
                ->where('submission_number', $request->submission_number)
                ->where('nik', $request->nik)
                ->first();

            if (!$submission) {
                return back()->with('error', 'Data tidak ditemukan. Periksa kembali nomor pengajuan dan NIK.');
            }

            // Simpan di session untuk auto-fill form
            session()->flash('submission_number', $request->submission_number);
            session()->flash('nik', $request->nik);

            return view('layanan.surat-online-status', [
                'title' => 'Cek Status Pengajuan - Desa Cicangkang Hilir',
                'submission' => $submission
            ]);
        }

        // Jika GET, tampilkan form kosong
        return view('layanan.surat-online-status', [
            'title' => 'Cek Status Pengajuan - Desa Cicangkang Hilir'
        ]);
    }
}