<?php

namespace App\Providers;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use App\Http\Controllers\LetterController;


class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        View::composer(['admin.layouts.sidebar', 'admin.index'], function ($view) {
            if (auth()->check()) {
                $user = auth()->user();
                
                // Cek apakah user adalah superadmin
                $isSuperAdmin = ($user->role === 'superadmin'); 
                $studyProgramId = $user->id_study_program;

                // Panggil fungsi dengan parameter tambahan isSuperAdmin
                $counts = LetterController::getStatusCounts($studyProgramId, $isSuperAdmin);

                $view->with('letterCounts', $counts);
            }
        });
    }
}
