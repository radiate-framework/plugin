<?php

namespace Plugin\Support\Foundation\Providers;

use Plugin\Support\Routing\Router;
use Plugin\Support\ServiceProvider;

class RoutingServiceProvider extends ServiceProvider
{
    /**
     * Register the provider
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('router', function ($app) {
            return new Router($app['events']);
        });
    }

    /**
     * Boot the provider
     *
     * @return void
     */
    public function boot()
    {
        $this->map();

        $this->app['router']->dispatch($this->app['request']);
    }

    /**
     * Map the routes
     *
     * @return void
     */
    public function map()
    {
        //
    }
}
