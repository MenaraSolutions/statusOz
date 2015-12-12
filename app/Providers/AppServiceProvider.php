<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Subject;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // Bind our eloquent subject collection to the interface
        $this->app->singleton('App\Contracts\SubjectsCollectionInterface', function() {
            return Subject::all();
        });

        // Use speedtest tester for tests
        $this->app->bind('App\Contracts\TesterInterface', 'App\Services\SpeedtestTester');
    }
}
