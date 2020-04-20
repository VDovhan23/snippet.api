<?php

namespace App\Providers;

use App\Policies\SnippetPolicy;
use App\Policies\StepPolicy;
use App\Policies\UserPolicy;
use App\Snippet;
use App\Step;
use App\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
         Snippet::class => SnippetPolicy::class,
         Step::class => StepPolicy::class,
         User::class => UserPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
