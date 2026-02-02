<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LetterController;
use App\Http\Controllers\LetterTypeController;
use App\Http\Controllers\Auth\OAuthController;


Route::get('/', function () {
    return view('index');
})->name('/');
    
Route::prefix('auth')->group(function () {
    Route::get('/login', [OAuthController::class, 'redirect'])->name('auth.login');
    Route::get('/callback', [OAuthController::class, 'callback'])->name('auth.callback');
    Route::post('/logout', [OAuthController::class, 'logout'])->name('auth.logout');
});

Route::get('/login', function () {
    // return view('index');
    return to_route('auth.login');
})->name('login')->middleware('guest');

Route::middleware('auth')->group(function () {
    Route::get('/form', [LetterController::class, 'create'])->name('form');
    Route::get('/track', [LetterController::class, 'track'])->name('track');
    Route::post('/form/store', [LetterController::class, 'store'])->name('form.store');
    Route::get('/print/{id}', [LetterController::class, 'show'])->name('print');

    Route::prefix('admin')->group(function () {
        Route::get('/', function () {
            return view('admin.index');
        })->name('admin');
    
        Route::get('/srtproses', function () {
            return (new LetterController())->index(1, 'dtSrtDiproses');
        })->name('srtproses');
        Route::get('/srtselesai', function () {
            return (new LetterController())->index(2, 'dtSrtSelesai');
        })->name('srtselesai');
        Route::get('/srttolak', function () {
            return (new LetterController())->index(3, 'dtSrtDitolak');
        })->name('srttolak');
        Route::get('/detail/{id}', [LetterController::class, 'show'])->name('detail');
        Route::patch('/update/{id}', [LetterController::class, 'update'])->name('update');
        // Route::get('/print/{id}', [LetterController::class, 'show'])->name('print');
    
        Route::resource('type', LetterTypeController::class);
    });
});





