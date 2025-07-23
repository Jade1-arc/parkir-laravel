<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends \Illuminate\Auth\AuthServiceProvider
{
    /**
     * The application's policies.
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

        Gate::define('manage-users', function ($user) {
            return $user->role === 'admin';
        });
    }
} 