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
    return to_route('auth.login');
})->name('login')->middleware('guest');


Route::middleware('auth')->group(function () {
    
    Route::get('/get-student/{nim}', [LetterController::class, 'getStudentData'])->name('get-student');

    Route::get('/form', [LetterController::class, 'create'])->name('form');
    Route::get('/track', [LetterController::class, 'track'])->name('track');
    Route::post('/form/store', [LetterController::class, 'store'])->name('form.store');
    Route::get('/print/{id}', [LetterController::class, 'show'])->name('print');

    
    Route::prefix('admin')->group(function () {
        Route::get('/', function () {
            return view('admin.index');
        })->name('admin');
    
        Route::get('/pending', function () {
            return (new LetterController())->index(1, 'dtPending');
        })->name('pending');
        Route::get('/approved', function () {
            return (new LetterController())->index(2, 'dtApproved');
        })->name('approved');
        Route::get('/done', function () {
            return (new LetterController())->index(3, 'dtDone');
        })->name('done');
        Route::get('/rejected', function () {
            return (new LetterController())->index(4, 'dtRejected');
        })->name('rejected');
        Route::get('/detail/{id}', [LetterController::class, 'show'])->name('detail');
        Route::patch('/update/{id}', [LetterController::class, 'update'])->name('update');
    
        Route::resource('type', LetterTypeController::class);
    });

});



