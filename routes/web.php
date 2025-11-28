<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SuratController;
use App\Http\Controllers\JenisController;
use App\Http\Controllers\KoordinatorController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\AdminPSController;
use App\Http\Controllers\Auth\OAuthController;
use App\Http\Controllers\MahasiswaController;


Route::get('/', function () {
    return view('index');
})->name('/');
    
Route::prefix('auth')->group(function () {
    Route::get('/login', [OAuthController::class, 'redirect'])->name('auth.login');
    Route::get('/callback', [OAuthController::class, 'callback'])->name('auth.callback');
    Route::post('/logout', [OAuthController::class, 'logout'])->name('auth.logout');
});
Route::get('/track', [HomeController::class, 'index'])->name('track');
Route::get('/form', [HomeController::class, 'create'])->name('form');
Route::post('/form/store', [HomeController::class, 'store'])->name('form.store');
Route::get('/print/{id}', [HomeController::class, 'show'])->name('print');

Route::prefix('admin')->group(function () {
    Route::get('/', function () {
        return view('admin.index');
    })->name('admin');

    Route::get('/srtproses', function () {
        return (new SuratController())->index(1, 'dtSrtDiproses');
    })->name('srtproses');
    Route::get('/srtselesai', function () {
        return (new SuratController())->index(2, 'dtSrtSelesai');
    })->name('srtselesai');
    Route::get('/srttolak', function () {
        return (new SuratController())->index(3, 'dtSrtDitolak');
    })->name('srttolak');
    Route::get('/detail/{id}', [SuratController::class, 'show'])->name('detail');
    Route::patch('/update/{id}', [SuratController::class, 'update'])->name('update');
    // Route::get('/print/{id}', [SuratController::class, 'show'])->name('print');

    Route::resource('jenis', JenisController::class);
    Route::get('/koordinator', [KoordinatorController::class, 'index'])->name('koordinator');
    Route::get('/dosen', [DosenController::class, 'index'])->name('dosen');
    Route::get('/adminps', [AdminPSController::class, 'index'])->name('adminps');
    Route::get('/mahasiswa', [MahasiswaController::class, 'index'])->name('mahasiswa');
});



