<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LetterController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\AdminController;

Route::get('/', function () {
    return view('welcome');
});

// Include authentication routes provided by Breeze (login, register, etc.)
require __DIR__.'/auth.php';

// Default dashboard route used by Breeze after login.
Route::middleware('auth')->get('/dashboard', function () {
    $user = auth()->user();
    // If user has role 'admin' redirect to admin dashboard
    if (($user->role ?? null) === 'admin') {
        return redirect()->route('admin.dashboard');
    }

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
    // management pages
    Route::get('/letters', [AdminController::class, 'lettersIndex'])->name('letters');
    Route::get('/letters/{letter}', [AdminController::class, 'letterShow'])->name('letters.show');
    Route::get('/letters/{letter}/edit', [AdminController::class, 'letterEdit'])->name('letters.edit');
    Route::put('/letters/{letter}', [AdminController::class, 'letterUpdate'])->name('letters.update');
    Route::delete('/letters/{letter}', [AdminController::class, 'letterDestroy'])->name('letters.destroy');
    Route::post('/letters/bulk-delete', [AdminController::class, 'lettersBulkDestroy'])->name('letters.bulkDestroy');

    Route::get('/reports', [AdminController::class, 'reportsIndex'])->name('reports');
});
