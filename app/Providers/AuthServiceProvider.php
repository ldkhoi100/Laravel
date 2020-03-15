<?php

namespace App\Providers;

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
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        // Quyền Super admin

        // Gate::before(function ($user) {
        //     if ($user->id === 2) {
        //         return true;
        //     }
        // });

        // Quyền Gate
        // Gate::define('edit', function ($user) {
        //     return true;
        // });

    }
}