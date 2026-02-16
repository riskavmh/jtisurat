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
            // 1. Ambil data dari Session (Hasil AuthHelper saat login)
            $userData = session('user_api_data');

            // 2. Cek apakah user adalah Super Admin (Roles adalah Array)
            $userRoles = auth()->user()->roles ?? [];
            $isSuperAdmin = in_array('superadmin_jtisurat', $userRoles); 

            // 3. Tarik array ID prodi dengan aman (Null Coalescing)
            $studyProgramIds = collect($userData['employee_detail']['position_assignments'] ?? [])
                ->pluck('study_program_id_parent')
                ->filter()
                ->unique()
                ->toArray();

            // 4. Hitung status surat
            $counts = LetterController::getStatusCounts($studyProgramIds, $isSuperAdmin);

            $view->with('letterCounts', $counts);
        }
    });
}
}
