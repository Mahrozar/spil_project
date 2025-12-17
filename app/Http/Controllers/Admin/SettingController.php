<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class SettingController extends Controller
{
    public function editHome()
    {
        $user = auth()->user();
        if (! $user || ($user->role ?? null) !== 'admin') {
            abort(403);
        }

        return view('admin.settings.home', [
            'hero_title' => Setting::get('home.hero_title', 'Selamat Datang di'),
            'hero_subtitle' => Setting::get('home.hero_subtitle', 'Desa Cicangkang Hilir'),
            'hero_lead' => Setting::get('home.hero_lead', 'Desa yang maju, mandiri, dan sejahtera berbasis teknologi informasi.'),
            'cta_primary' => Setting::get('home.cta_primary', 'Layanan Desa'),
            'cta_secondary' => Setting::get('home.cta_secondary', 'Profil Desa'),
            'stat_population' => Setting::get('home.stat_population', '3,250'),
            'stat_kk' => Setting::get('home.stat_kk', '950'),
            'stat_area' => Setting::get('home.stat_area', '245 Ha'),
            'stat_dusun' => Setting::get('home.stat_dusun', '4'),
            // Profil / Layanan / Berita / Galeri (stored as JSON for complex structures)
            'profil_title' => Setting::get('home.profil_title', 'Profil Desa Cicangkang Hilir'),
            'profil_text' => Setting::get('home.profil_text', "Desa Cicangkang Hilir merupakan salah satu desa di Kecamatan Cipongkor, Kabupaten Bandung Barat. Desa ini memiliki potensi alam yang indah dengan masyarakat yang ramah dan gotong royong."),
            'layanan' => json_decode(Setting::get('home.layanan', '[]'), true) ?: [],
            'berita' => json_decode(Setting::get('home.berita', '[]'), true) ?: [],
            'galeri' => json_decode(Setting::get('home.galeri', '[]'), true) ?: [],
        ]);
    }

    public function updateHome(Request $request)
    {
        $user = auth()->user();
        if (! $user || ($user->role ?? null) !== 'admin') {
            abort(403);
        }

        $data = $request->validate([
            'hero_title' => 'nullable|string|max:255',
            'hero_subtitle' => 'nullable|string|max:255',
            'hero_lead' => 'nullable|string|max:1000',
            'cta_primary' => 'nullable|string|max:100',
            'cta_secondary' => 'nullable|string|max:100',
            'stat_population' => 'nullable|string|max:50',
            'stat_kk' => 'nullable|string|max:50',
            'stat_area' => 'nullable|string|max:50',
            'stat_dusun' => 'nullable|string|max:50',
            // profil
            'profil_title' => 'nullable|string|max:255',
            'profil_text' => 'nullable|string|max:2000',
            // layanan - array of cards
            'layanan' => 'nullable|array',
            'layanan.*.title' => 'nullable|string|max:255',
            'layanan.*.description' => 'nullable|string|max:1000',
            'layanan.*.link' => 'nullable|url|max:500',
            // berita - array of items
            'berita' => 'nullable|array',
            'berita.*.date' => 'nullable|date',
            'berita.*.title' => 'nullable|string|max:255',
            'berita.*.excerpt' => 'nullable|string|max:1000',
            'berita.*.link' => 'nullable|url|max:500',
            // galeri - array of image urls
            'galeri' => 'nullable|array',
            'galeri.*' => 'nullable|url|max:500',
            // uploaded gallery files
            'galeri_files' => 'nullable|array',
            'galeri_files.*' => 'nullable|image|max:5120', // max 5MB each
            // uploaded layanan and berita files
            'layanan_files' => 'nullable|array',
            'layanan_files.*' => 'nullable|image|max:5120',
            'berita_files' => 'nullable|array',
            'berita_files.*' => 'nullable|image|max:5120',
        ]);

        // Save simple scalar settings
        $scalarKeys = [
            'hero_title','hero_subtitle','hero_lead','cta_primary','cta_secondary',
            'stat_population','stat_kk','stat_area','stat_dusun',
            'profil_title','profil_text'
        ];

        foreach ($scalarKeys as $k) {
            if (array_key_exists($k, $data)) {
                Setting::set('home.' . $k, $data[$k]);
            }
        }

        // Process layanan: handle uploaded images, provided URLs, and keep existing ones
        $existingLayanan = json_decode(Setting::get('home.layanan', '[]'), true) ?: [];
        $filesLayanan = $request->file('layanan_files') ?: [];
        $inputLayanan = $data['layanan'] ?? [];
        $finalLayanan = [];
        $toDelete = [];
        for ($i = 0; $i < 3; $i++) {
            $itemInput = $inputLayanan[$i] ?? [];
            $chosenImage = null;

            if (isset($filesLayanan[$i]) && $filesLayanan[$i]) {
                $p = Storage::disk('public')->putFile('home/layanan', $filesLayanan[$i]);
                if ($p) $chosenImage = Storage::url($p);
            }

            if ($chosenImage === null && !empty($itemInput['image'] ?? null)) {
                $chosenImage = $itemInput['image'];
            }

            if ($chosenImage === null && !empty($existingLayanan[$i]['image'] ?? null)) {
                $chosenImage = $existingLayanan[$i]['image'];
            }

            if (!empty($existingLayanan[$i]['image'] ?? null) && $chosenImage !== ($existingLayanan[$i]['image'] ?? null)) {
                $old = $existingLayanan[$i]['image'];
                if (Str::contains($old, '/storage/')) {
                    if (preg_match('#/storage/(.+)$#', $old, $m)) {
                        $toDelete[] = $m[1];
                    }
                }
            }

            $finalLayanan[] = [
                'title' => $itemInput['title'] ?? ($existingLayanan[$i]['title'] ?? ''),
                'description' => $itemInput['description'] ?? ($existingLayanan[$i]['description'] ?? ''),
                'link' => $itemInput['link'] ?? ($existingLayanan[$i]['link'] ?? ''),
                'image' => $chosenImage ?? null,
            ];
        }

        // Process berita: handle uploaded images and URLs
        $existingBerita = json_decode(Setting::get('home.berita', '[]'), true) ?: [];
        $filesBerita = $request->file('berita_files') ?: [];
        $inputBerita = $data['berita'] ?? [];
        $finalBerita = [];
        for ($i = 0; $i < 3; $i++) {
            $itemInput = $inputBerita[$i] ?? [];
            $chosenImage = null;

            if (isset($filesBerita[$i]) && $filesBerita[$i]) {
                $p = Storage::disk('public')->putFile('home/berita', $filesBerita[$i]);
                if ($p) $chosenImage = Storage::url($p);
            }

            if ($chosenImage === null && !empty($itemInput['image'] ?? null)) {
                $chosenImage = $itemInput['image'];
            }

            if ($chosenImage === null && !empty($existingBerita[$i]['image'] ?? null)) {
                $chosenImage = $existingBerita[$i]['image'];
            }

            if (!empty($existingBerita[$i]['image'] ?? null) && $chosenImage !== ($existingBerita[$i]['image'] ?? null)) {
                $old = $existingBerita[$i]['image'];
                if (Str::contains($old, '/storage/')) {
                    if (preg_match('#/storage/(.+)$#', $old, $m)) {
                        $toDelete[] = $m[1];
                    }
                }
            }

            $finalBerita[] = [
                'date' => $itemInput['date'] ?? ($existingBerita[$i]['date'] ?? null),
                'title' => $itemInput['title'] ?? ($existingBerita[$i]['title'] ?? ''),
                'excerpt' => $itemInput['excerpt'] ?? ($existingBerita[$i]['excerpt'] ?? ''),
                'link' => $itemInput['link'] ?? ($existingBerita[$i]['link'] ?? ''),
                'image' => $chosenImage ?? null,
            ];
        }

        // Build final galeri array by preferring uploaded files, then explicit URLs, then existing entries
        $existingGaleri = json_decode(Setting::get('home.galeri', '[]'), true) ?: [];
        $files = $request->file('galeri_files') ?: [];

        $finalGaleri = [];
        $toDelete = [];
        for ($i = 0; $i < 8; $i++) {
            $chosen = null;

            // uploaded file for this slot
            if (isset($files[$i]) && $files[$i]) {
                $path = Storage::disk('public')->putFile('home/galeri', $files[$i]);
                if ($path) {
                    $chosen = Storage::url($path);
                }
            }

            // if no uploaded file, use provided URL in the form
            if ($chosen === null && !empty($data['galeri'][$i] ?? null)) {
                $chosen = $data['galeri'][$i];
            }

            // if still null, keep existing if present
            if ($chosen === null && !empty($existingGaleri[$i] ?? null)) {
                $chosen = $existingGaleri[$i];
            }

            // if existing value exists and is different from chosen, and existing is a storage file, mark for deletion
            if (!empty($existingGaleri[$i] ?? null) && $chosen !== ($existingGaleri[$i] ?? null)) {
                $old = $existingGaleri[$i];
                // detect storage path (contains '/storage/')
                if (Str::contains($old, '/storage/')) {
                    // extract relative path after '/storage/'
                    if (preg_match('#/storage/(.+)$#', $old, $m)) {
                        $rel = $m[1];
                        $toDelete[] = $rel;
                    }
                }
            }

            if ($chosen !== null) {
                $finalGaleri[] = $chosen;
            }
        }

        // delete old storage files that were replaced
        foreach (array_unique($toDelete) as $del) {
            try {
                Storage::disk('public')->delete($del);
            } catch (\Exception $e) {
                // ignore deletion errors
            }
        }

        // Persist final galeri (filter out empty)
        $finalGaleri = array_values(array_filter($finalGaleri));
        Setting::set('home.galeri', json_encode($finalGaleri));
        // Persist layanan and berita structures
        Setting::set('home.layanan', json_encode($finalLayanan));
        Setting::set('home.berita', json_encode($finalBerita));

        return redirect()->route('admin.settings.home.edit')->with('success', 'Home content updated.');
    }

    /**
     * Show media files under public/home/galeri
     */
    public function mediaIndex()
    {
        $user = auth()->user();
        if (! $user || ($user->role ?? null) !== 'admin') {
            abort(403);
        }

        $files = Storage::disk('public')->files('home/galeri');
        $list = [];
        foreach ($files as $f) {
            $list[] = [
                'path' => $f,
                'url' => Storage::url($f),
            ];
        }

        return view('admin.settings.media', ['files' => $list]);
    }

    /**
     * Delete a media file and remove references from settings
     */
    public function mediaDelete(Request $request)
    {
        $user = auth()->user();
        if (! $user || ($user->role ?? null) !== 'admin') {
            abort(403);
        }

        $request->validate([
            'path' => 'required|string',
        ]);

        $path = $request->input('path');
        try {
            Storage::disk('public')->delete($path);
        } catch (\Exception $e) {
            // ignore
        }

        // Remove from settings lists if referenced
        $existing = json_decode(Setting::get('home.galeri', '[]'), true) ?: [];
        $new = array_values(array_filter(array_map(function ($item) use ($path) {
            // compare Storage::url path
            if (is_string($item) && strpos($item, '/storage/') !== false) {
                if (preg_match('#/storage/(.+)$#', $item, $m)) {
                    if ($m[1] === $path) return null;
                }
            }
            return $item;
        }, $existing)));

        Setting::set('home.galeri', json_encode($new));

        return redirect()->route('admin.settings.media.index')->with('success', 'File dihapus.');
    }
}
