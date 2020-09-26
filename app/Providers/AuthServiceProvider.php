<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider {
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    public function boot() {
        $this->registerPolicies();

        $user = Auth::user();

        // Auth gates for: Roles
        Gate::define('role_access', function ($user) {
            return in_array($user->role_id, []);
        });
        Gate::define('role_create', function ($user) {
            return in_array($user->role_id, []);
        });
        Gate::define('role_edit', function ($user) {
            return in_array($user->role_id, []);
        });
        Gate::define('role_view', function ($user) {
            return in_array($user->role_id, []);
        });
        Gate::define('role_delete', function ($user) {
            return in_array($user->role_id, []);
        });

        // Auth gates for: Users
        Gate::define('product_access', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('product_create', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('product_edit', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('product_view', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('product_delete', function ($user) {
            return in_array($user->role_id, [1]);
        });

        // Auth gates for: Reader
        Gate::define('category_access', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('category_create', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('category_edit', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('category_view', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('category_delete', function ($user) {
            return in_array($user->role_id, [1]);
        });
    }
}