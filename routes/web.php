<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LetterController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\AdminController;

Route::get('/', function () {
    if (auth()->check()) {
        $user = auth()->user();
        if (($user->role ?? null) === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        return redirect()->route('dashboard');
    }

    return redirect()->route('login');
});

// Include authentication routes provided by Breeze (login, register, etc.)
require __DIR__.'/auth.php';

// Default dashboard route used by Breeze after login.
Route::middleware('auth')->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

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
    Route::get('/letters', [AdminController::class, 'lettersIndex'])->name('letters');
    Route::get('/letters/{letter}', [AdminController::class, 'letterShow'])->name('letters.show');
    Route::get('/letters/{letter}/edit', [AdminController::class, 'letterEdit'])->name('letters.edit');
    Route::put('/letters/{letter}', [AdminController::class, 'letterUpdate'])->name('letters.update');
    Route::delete('/letters/{letter}', [AdminController::class, 'letterDestroy'])->name('letters.destroy');
    Route::post('/letters/bulk-delete', [AdminController::class, 'lettersBulkDestroy'])->name('letters.bulkDestroy');

    Route::get('/reports', [AdminController::class, 'reportsIndex'])->name('reports');

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
});

// Development helper: auto-login as admin (only in local environment)
if (app()->environment('local')) {
    Route::get('/dev/login-as-admin', function () {
        $admin = \App\Models\User::where('role', 'admin')->first();
        if (! $admin) {
            return response('No admin user found', 404);
        }
        \Illuminate\Support\Facades\Auth::loginUsingId($admin->id);
        return redirect('/admin/residents');
    });

    // Debug route to inspect auth/session/cookies (local only)
    Route::get('/_debug-user', function (\Illuminate\Http\Request $request) {
        return response()->json([
            'auth_check' => auth()->check(),
            'user' => auth()->user() ? auth()->user()->only(['id','name','email','role']) : null,
            'session_id' => session()->getId(),
            'cookies' => $request->cookies->all(),
            'app_url' => config('app.url'),
        ]);
    });
}
