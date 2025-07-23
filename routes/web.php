<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ParkirController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::resource('user', App\Http\Controllers\UserController::class);
    Route::post('user/{user}/makeadmin', [App\Http\Controllers\UserController::class, 'makeAdmin'])->name('user.makeadmin');
});

Route::middleware(['auth', 'role:petugas'])->group(function () {
    Route::get('petugas/dashboard', [App\Http\Controllers\PetugasDashboardController::class, 'index'])->name('petugas.dashboard');
});

// Route umum
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('parkir/{parkir}/keluar', [ParkirController::class, 'keluar'])->name('parkir.keluar');
    Route::post('parkir/{parkir}/masuk', [ParkirController::class, 'masuk'])->name('parkir.masuk');
    Route::get('laporan', [App\Http\Controllers\LaporanController::class, 'index'])->name('laporan.index');
    Route::get('laporan/export', [App\Http\Controllers\LaporanController::class, 'export'])->name('laporan.export');
    Route::get('scan', function() { return view('parkir.scan'); })->name('scan');
});

Route::resource('parkir', ParkirController::class);

Route::get('login-petugas', [App\Http\Controllers\PetugasAuthController::class, 'showLoginForm'])->name('petugas.login');
Route::post('login-petugas', [App\Http\Controllers\PetugasAuthController::class, 'login']);

require __DIR__.'/auth.php';
