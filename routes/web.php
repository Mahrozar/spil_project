<?php

use App\Http\Controllers\NewsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LetterController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfilDesaController;
use App\Http\Controllers\LayananDesaController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\PublicReportController;
use App\Http\Controllers\VisitorController;
use App\Http\Controllers\GalleryController;

// Public landing page (accessible without authentication)
Route::get('/', [LandingPageController::class, 'index'])->name('landing-page');
// Rute untuk buku tamu (hanya 2 input)
Route::get('/visitor/form', [VisitorController::class, 'showForm'])->name('visitor.form');
Route::post('/visitor/store', [VisitorController::class, 'store'])->name('visitor.store');
// Redirect legacy/shortcut URL to layanan pelaporan
Route::redirect('/pelaporan-fasilitas', '/layanan/pelaporan-fasilitas');
// routes/web.php
Route::get('/heatmap-data', [LandingPageController::class, 'getHeatmapData'])->name('landing.heatmap-data');
// Route untuk Profil Desa
Route::prefix('profil')->group(function () {
    Route::get('/visi-misi', [ProfilDesaController::class, 'visiMisi'])->name('profil.visi-misi');
    Route::get('/sejarah', [ProfilDesaController::class, 'sejarah'])->name('profil.sejarah');
    Route::get('/struktur', [ProfilDesaController::class, 'struktur'])->name('profil.struktur');
    Route::get('/gambaran', function () {
        return view('profileDesa.gambaran');
    })->name('profil.gambaran');
});

// Route untuk Layanan Desa
Route::prefix('layanan')->group(function () {

    Route::get('/prosedur', [LayananDesaController::class, 'prosedur'])->name('layanan.prosedur');
    Route::get('/dokumen', [LayananDesaController::class, 'dokumen'])->name('layanan.dokumen');
    Route::get('/surat-online', [LayananDesaController::class, 'suratOnline'])->name('layanan.surat-online');
    Route::post('/surat-online', [LayananDesaController::class, 'submitSurat'])->name('layanan.submit-surat');
    // Pelaporan fasilitas (landing page + simple submit handler)
    Route::get('/pelaporan-fasilitas', function () {
        return view('layanan.pelaporan-fasilitas');
    })->name('layanan.pelaporan-fasilitas');

    Route::post('/pelaporan-fasilitas', [ReportController::class, 'store'])->name('layanan.pelaporan-fasilitas.submit');
});
Route::get('/demo', [LandingPageController::class, 'demo'])->name('demo');
Route::post('/kontak', [LandingPageController::class, 'kirimPesan'])->name('kontak.kirim');

// Public Report Routes
Route::prefix('lapor')->name('reports.')->group(function () {
    Route::get('/buat', [PublicReportController::class, 'create'])->name('create');
    Route::post('/buat', [ReportController::class, 'store'])->name('store');
    Route::get('/status', [PublicReportController::class, 'checkStatus'])->name('check-status');
    Route::post('/status', [PublicReportController::class, 'checkStatus'])->name('check-status.post');
    Route::get('/{code}', [PublicReportController::class, 'show'])->name('show');
    Route::get('/', [PublicReportController::class, 'index'])->name('index');
});
Route::prefix('berita')->name('news.')->group(function () {
    Route::get('/', [NewsController::class, 'index'])->name('index');
    Route::get('/{slug}', [NewsController::class, 'show'])->name('show');
});
// Routes untuk galeri publik
Route::get('/galeri', [GalleryController::class, 'index'])->name('gallery.index');
Route::get('/galeri/{id}', [GalleryController::class, 'show'])->name('gallery.show');

// Admin Report Routes
Route::middleware(['auth', 'can:manage-reports'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('reports', ReportController::class)->except(['create', 'store']);
    Route::post('reports/{report}/comment', [ReportController::class, 'addComment'])->name('reports.comment');
    Route::post('reports/{report}/photos', [ReportController::class, 'uploadPhotos'])->name('reports.photos');
    Route::get('reports/statistics', [ReportController::class, 'statistics'])->name('reports.statistics');
    Route::get('reports/export', [ReportController::class, 'export'])->name('reports.export');
});

// Route::get('/', function () {
//     if (auth()->check()) {
//         $user = auth()->user();
//         if (($user->role ?? null) === 'admin') {
//             return redirect()->route('admin.dashboard');
//         }

//         return redirect()->route('dashboard');
//     }

//     return redirect()->route('login');
// });

// Include authentication routes provided by Breeze (login, register, etc.)
require __DIR__ . '/auth.php';

// Authenticated user routes
Route::middleware('auth')->group(function () {
    // User-facing letters and reports (simple resource-like)
    Route::get('user/letters', [LetterController::class, 'index'])->name('user.letters.index');
    Route::get('user/letters/create', [LetterController::class, 'create'])->name('user.letters.create');
    Route::post('user/letters', [LetterController::class, 'store'])->name('user.letters.store');
    Route::get('user/letters/{letter}', [LetterController::class, 'show'])->name('user.letters.show');
    Route::get('user/letters/{letter}/edit', [LetterController::class, 'edit'])->name('user.letters.edit');
    Route::put('user/letters/{letter}', [LetterController::class, 'update'])->name('user.letters.update');
    Route::delete('user/letters/{letter}', [LetterController::class, 'destroy'])->name('user.letters.destroy');

    Route::get('user/reports', [ReportController::class, 'index'])->name('user.reports.index');
    Route::get('user/reports/create', [ReportController::class, 'create'])->name('user.reports.create');
    Route::post('user/reports', [ReportController::class, 'store'])->name('user.reports.store');
    Route::get('user/reports/{report}', [ReportController::class, 'show'])->name('user.reports.show');
    Route::get('user/reports/{report}/edit', [ReportController::class, 'edit'])->name('user.reports.edit');
    Route::put('user/reports/{report}', [ReportController::class, 'update'])->name('user.reports.update');
    Route::delete('user/reports/{report}', [ReportController::class, 'destroy'])->name('user.reports.destroy');
});

// Admin routes (dashboard + management views)
Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/dashboard/data', [AdminController::class, 'dashboardData'])->name('dashboard.data');
    // management pages

    // Letter submissions (public online submissions)
    Route::get('/submissions', [AdminController::class, 'submissionsIndex'])->name('submissions.index');
    Route::get('/submissions/{submission}', [AdminController::class, 'submissionShow'])->name('submissions.show');
    Route::get('/submissions/{submission}/edit', [AdminController::class, 'submissionEdit'])->name('submissions.edit');
    Route::put('/submissions/{submission}', [AdminController::class, 'submissionUpdate'])->name('submissions.update');
    Route::delete('/submissions/{submission}', [AdminController::class, 'submissionDestroy'])->name('submissions.destroy');

    Route::get('/reports', [AdminController::class, 'reportsIndex'])->name('reports.index');
    Route::get('/reports/{report}', [AdminController::class, 'reportShow'])->name('reports.show');
    Route::get('/reports/{report}/edit', [AdminController::class, 'reportEdit'])->name('reports.edit');
    Route::put('/reports/{report}', [AdminController::class, 'reportUpdate'])->name('reports.update');
    Route::delete('/reports/{report}', [AdminController::class, 'reportDestroy'])->name('reports.destroy');
    Route::post('/reports/{report}/comments', [AdminController::class, 'reportAddComment'])->name('reports.addComment');
    Route::get('/reports/export', [AdminController::class, 'reportsExport'])->name('reports.export');
    Route::get('/reports/statistics', [AdminController::class, 'reportsStatistics'])->name('reports.statistics');

    // Gallery Routes
    Route::get('/galleries', [AdminController::class, 'galleriesIndex'])->name('galleries.index');
    Route::get('/galleries/create', [AdminController::class, 'galleryCreate'])->name('galleries.create');
    Route::post('/galleries', [AdminController::class, 'galleryStore'])->name('galleries.store');
    Route::get('/galleries/{gallery}', [AdminController::class, 'galleryShow'])->name('galleries.show');
    Route::get('/galleries/{gallery}/edit', [AdminController::class, 'galleryEdit'])->name('galleries.edit');
    Route::put('/galleries/{gallery}', [AdminController::class, 'galleryUpdate'])->name('galleries.update');
    Route::delete('/galleries/{gallery}', [AdminController::class, 'galleryDestroy'])->name('galleries.destroy');
    Route::post('/galleries/bulk-destroy', [AdminController::class, 'galleriesBulkDestroy'])->name('galleries.bulkDestroy');
    Route::patch('/galleries/{gallery}/toggle-active', [AdminController::class, 'galleryToggleActive'])->name('galleries.toggle-active');


    // News Routes
    Route::get('/news', [AdminController::class, 'newsIndex'])->name('news.index');
    Route::get('/news/create', [AdminController::class, 'newsCreate'])->name('news.create');
    Route::post('/news', [AdminController::class, 'newsStore'])->name('news.store');
    Route::get('/news/{news}', [AdminController::class, 'newsShow'])->name('news.show');
    Route::get('/news/{news}/edit', [AdminController::class, 'newsEdit'])->name('news.edit');
    Route::put('/news/{news}', [AdminController::class, 'newsUpdate'])->name('news.update');
    Route::delete('/news/{news}', [AdminController::class, 'newsDestroy'])->name('news.destroy');
    Route::post('/news/bulk-destroy', [AdminController::class, 'newsBulkDestroy'])->name('news.bulkDestroy');
    Route::patch('/news/{news}/toggle-publish', [AdminController::class, 'newsTogglePublish'])->name('news.toggle-publish');


    // Residents management (RT/RW + residents)
    Route::get('/residents', [\App\Http\Controllers\ResidentController::class, 'index'])->name('residents.index');
    Route::get('/residents/create', [\App\Http\Controllers\ResidentController::class, 'create'])->name('residents.create');
    Route::post('/residents', [\App\Http\Controllers\ResidentController::class, 'store'])->name('residents.store');
    Route::get('/residents/{resident}', [\App\Http\Controllers\ResidentController::class, 'show'])->name('residents.show');
    Route::get('/residents/{resident}/edit', [\App\Http\Controllers\ResidentController::class, 'edit'])->name('residents.edit');
    Route::put('/residents/{resident}', [\App\Http\Controllers\ResidentController::class, 'update'])->name('residents.update');
    Route::delete('/residents/{resident}', [\App\Http\Controllers\ResidentController::class, 'destroy'])->name('residents.destroy');
    // Import / Export residents
    Route::post('/residents/import', [\App\Http\Controllers\ResidentController::class, 'import'])->name('residents.import');
    Route::get('/residents/export', [\App\Http\Controllers\ResidentController::class, 'export'])->name('residents.export');
    // Import logs listing / download
    Route::get('/imports', [\App\Http\Controllers\ResidentController::class, 'importsIndex'])->name('imports.index');
    Route::get('/imports/download/{file}', [\App\Http\Controllers\ResidentController::class, 'downloadImport'])->name('imports.download');

    // Households / Kartu Keluarga listing
    Route::get('/households', [\App\Http\Controllers\Admin\HouseholdController::class, 'index'])->name('households.index');
    Route::post('/households/assign-head', [\App\Http\Controllers\Admin\HouseholdController::class, 'assignHead'])->name('households.assignHead');
    Route::post('/households/update-kk', [\App\Http\Controllers\Admin\HouseholdController::class, 'updateKk'])->name('households.updateKk');

    // RW (neighbourhood) CRUD
    Route::get('/rws', [\App\Http\Controllers\RWController::class, 'index'])->name('rws.index');
    Route::get('/rws/create', [\App\Http\Controllers\RWController::class, 'create'])->name('rws.create');
    Route::post('/rws', [\App\Http\Controllers\RWController::class, 'store'])->name('rws.store');
    Route::get('/rws/{rw}', [\App\Http\Controllers\RWController::class, 'show'])->name('rws.show');
    Route::get('/rws/{rw}/edit', [\App\Http\Controllers\RWController::class, 'edit'])->name('rws.edit');
    Route::put('/rws/{rw}', [\App\Http\Controllers\RWController::class, 'update'])->name('rws.update');
    Route::delete('/rws/{rw}', [\App\Http\Controllers\RWController::class, 'destroy'])->name('rws.destroy');

    // RT (neighbourhood block) CRUD
    Route::get('/rts', [\App\Http\Controllers\RTController::class, 'index'])->name('rts.index');
    Route::get('/rts/create', [\App\Http\Controllers\RTController::class, 'create'])->name('rts.create');
    Route::post('/rts', [\App\Http\Controllers\RTController::class, 'store'])->name('rts.store');
    Route::get('/rts/{rt}', [\App\Http\Controllers\RTController::class, 'show'])->name('rts.show');
    Route::get('/rts/{rt}/edit', [\App\Http\Controllers\RTController::class, 'edit'])->name('rts.edit');
    Route::put('/rts/{rt}', [\App\Http\Controllers\RTController::class, 'update'])->name('rts.update');
    Route::delete('/rts/{rt}', [\App\Http\Controllers\RTController::class, 'destroy'])->name('rts.destroy');

    // Admin-editable landing/home content
    Route::get('/settings/home', [\App\Http\Controllers\Admin\SettingController::class, 'editHome'])->name('settings.home.edit');
    Route::post('/settings/home', [\App\Http\Controllers\Admin\SettingController::class, 'updateHome'])->name('settings.home.update');
    // Simple media manager for uploaded home gallery
    Route::get('/settings/media', [\App\Http\Controllers\Admin\SettingController::class, 'mediaIndex'])->name('settings.media.index');
    Route::delete('/settings/media', [\App\Http\Controllers\Admin\SettingController::class, 'mediaDelete'])->name('settings.media.delete');
});

// Development helper: auto-login as admin (only in local environment)
if (app()->environment('local')) {
    Route::get('/dev/login-as-admin', function () {
        $admin = \App\Models\User::where('role', 'admin')->first();
        if (!$admin) {
            return response('No admin user found', 404);
        }
        \Illuminate\Support\Facades\Auth::loginUsingId($admin->id);
        return redirect('/admin/residents');
    });

    // Debug route to inspect auth/session/cookies (local only)
    Route::get('/_debug-user', function (\Illuminate\Http\Request $request) {
        return response()->json([
            'auth_check' => auth()->check(),
            'user' => auth()->user() ? auth()->user()->only(['id', 'name', 'email', 'role']) : null,
            'session_id' => session()->getId(),
            'cookies' => $request->cookies->all(),
            'app_url' => config('app.url'),
        ]);
    });

}
