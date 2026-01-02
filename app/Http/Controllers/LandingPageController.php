<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Resident;
use App\Models\RT;
use App\Models\RW;
use App\Models\Setting;
use App\Models\LetterSubmission;

class LandingPageController extends Controller
{
    /**
     * Show the public landing page with live statistics.
     */
    public function index(Request $request)
    {
        $visitorController = new VisitorController();
        
        // Cek apakah pengunjung sudah mengisi form
        if (!$visitorController->checkVisitor()) {
            // Redirect ke form buku tamu
            return redirect()->route('visitor.form');
        }
        $population = Resident::count();
        $kk = Resident::select('kk_number')->distinct()->count();
        $rtCount = RT::count();
        $rwCount = RW::count();

        $stat_area = Setting::get('home.stat_area', '245 Ha');
        $stat_dusun = Setting::get('home.stat_dusun', '4');

        // Frontpage editable content
        $profil_title = Setting::get('home.profil_title', 'Profil Desa Cicangkang Hilir');
        $profil_text = Setting::get('home.profil_text', "Desa Cicangkang Hilir merupakan salah satu desa di Kecamatan Cipongkor, Kabupaten Bandung Barat. Desa ini memiliki potensi alam yang indah dengan masyarakat yang ramah dan gotong royong.");
        $layanan = json_decode(Setting::get('home.layanan', '[]'), true) ?: [];
        $berita = json_decode(Setting::get('home.berita', '[]'), true) ?: [];
        $galeri = json_decode(Setting::get('home.galeri', '[]'), true) ?: [];

        // Load all recent submissions (public) so Statistik Pengajuan dapat digulir dan melihat seluruh data
        $mySubmissions = LetterSubmission::orderBy('created_at', 'desc')->get();

        return view('frontend.home', compact(
            'population',
            'kk',
            'rtCount',
            'rwCount',
            'stat_area',
            'stat_dusun'
        ))->with([
            'profil_title' => $profil_title,
            'profil_text' => $profil_text,
            'layanan' => $layanan,
            'berita' => $berita,
            'galeri' => $galeri,
            'mySubmissions' => $mySubmissions,
        ]);
    }
}
