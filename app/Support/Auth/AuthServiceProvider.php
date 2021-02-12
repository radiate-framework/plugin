<?php

namespace Plugin\Support\Auth;

use Plugin\Support\Support\ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->singleton('auth', function () {
            return new AuthManager();
        });
    }

    /**
     * Boot the services
     *
     * @return void
     */
    public function boot()
    {
        $this->app['request']->setUserResolver(function () {
            return $this->app['auth']->user();
        });
    }
}
