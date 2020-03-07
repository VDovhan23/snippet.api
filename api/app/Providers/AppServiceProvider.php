<?php

namespace App\Providers;

use App\Observers\SnippetObserver;
use App\Snippet;
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
    }
}
