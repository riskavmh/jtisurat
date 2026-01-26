<?php

namespace App\Providers;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use App\Http\Controllers\LettersController;

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
            $counts = LettersController::getStatusCounts();
            $view->with('suratCounts', $counts); 
        });
    }
}
