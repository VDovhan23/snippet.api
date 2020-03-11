<?php

namespace App\Providers;

use App\Observers\SnippetObserver;
use App\Observers\StepObserver;
use App\Snippet;
use App\Step;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Snippet::observe(SnippetObserver::class);
        Step::observe(StepObserver::class);
    }
}
