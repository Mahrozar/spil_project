<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Resident;
use App\Models\RT;
use App\Models\RW;
use App\Models\Setting;
use App\Models\LetterSubmission;
use App\Models\Report;
use Illuminate\Support\Str;

class LandingPageController extends Controller
{
    public function index(Request $request)
    {
        $visitorController = new VisitorController();

        if (!$visitorController->checkVisitor()) {
            return redirect()->route('visitor.form');
        }

        // Statistics
        $population = Resident::count();
        $kk = Resident::select('kk_number')->distinct()->count();
        $rtCount = RT::count();
        $rwCount = RW::count();

        $stat_area = Setting::get('home.stat_area', '245 Ha');

        // Content
        $profil_title = Setting::get('home.profil_title', 'Profil Desa Cicangkang Hilir');
        $profil_text = Setting::get('home.profil_text', "Desa Cicangkang Hilir merupakan salah satu desa di Kecamatan Cipongkor, Kabupaten Bandung Barat. Desa ini memiliki potensi alam yang indah dengan masyarakat yang ramah dan gotong royong.");
        $layanan = json_decode(Setting::get('home.layanan', '[]'), true) ?: [];
        $berita = json_decode(Setting::get('home.berita', '[]'), true) ?: [];
        $galeri = json_decode(Setting::get('home.galeri', '[]'), true) ?: [];

        // Data for tables and heatmap
        $mySubmissions = LetterSubmission::orderBy('created_at', 'desc')->get();

        $myReports = Report::with('user')
            ->where('is_public', true)
            ->whereNotNull('latitude')
            ->whereNotNull('longitude')
            ->orderBy('created_at', 'desc')
            ->take(200)
            ->get();

        // Prepare heatmap data
        $heatmapData = [];
        foreach ($myReports as $report) {
            if ($report->latitude && $report->longitude) {
                $weight = 1;
                if ($report->priority === 'high')
                    $weight = 3;
                elseif ($report->priority === 'urgent')
                    $weight = 5;
                elseif ($report->priority === 'medium')
                    $weight = 2;

                if ($report->status === 'in_progress')
                    $weight += 1;
                if ($report->status === 'submitted')
                    $weight += 0.5;

                $heatmapData[] = [
                    'lat' => floatval($report->latitude),
                    'lng' => floatval($report->longitude),
                    'weight' => $weight,
                    'category' => $report->facility_category,
                    'type' => $report->facility_type,
                    'status' => $report->status,
                    'address' => $report->address
                ];
            }
        }
        // Ambil berita terbaru
        $berita = \App\Models\News::where('is_published', true)
            ->where('published_at', '<=', now())
            ->orderBy('published_at', 'desc')
            ->take(6)
            ->get();

        return view('frontend.home', compact(
            'population',
            'kk',
            'rtCount',
            'rwCount',
            'stat_area',
            'profil_title',
            'profil_text',
            'layanan',
            'berita',
            'galeri',
            'mySubmissions',
            'myReports',
            'heatmapData'
        ));
    }
}