<?php

namespace App\Providers;

use App\Models\Project;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\File;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Ensure public/storage directory exists for shared hosting
        File::ensureDirectoryExists(public_path('storage'));

        View::composer('layouts.sidebar', function ($view) {
            $query = Project::query();
            
            if (auth()->check() && auth()->user()->isSiteSupervisor()) {
                $siteManager = auth()->user()->siteManager;
                if ($siteManager && $siteManager->project_id) {
                    $query->where('id', $siteManager->project_id);
                } else {
                    $query->where('id', 0);
                }
            }

            $view->with('sidebarProjects', $query->latest()->take(10)->get());
        });
    }
}
