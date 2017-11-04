<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        $this->registerPostPolicies();
    }

    public function registerPostPolicies()
    {
        Gate::define('access-admin', function ($user) {
            return $user->hasAccess(['access-admin']);
        });
        Gate::define('manage-users', function ($user) {
            return $user->hasAccess(['manage-users']);
        });
        // Gate::define('update-post', function ($user, Post $post) {
        //     return $user->hasAccess(['update-post']) or $user->id == $post->user_id;
        // });
        // Gate::define('see-all-drafts', function ($user) {
        //     return $user->inRole('editor');
        // });
    }
}
