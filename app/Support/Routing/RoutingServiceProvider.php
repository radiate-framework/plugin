<?php

namespace Plugin\Support\Routing;

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
            return new Router($app['events'], $app);
        });
    }

    /**
     * Boot the provider
     *
     * @return void
     */
    public function boot()
    {
        $this->commands([
            \Plugin\Support\Routing\Console\MakeController::class,
            \Plugin\Support\Routing\Console\MakeMiddleware::class,
        ]);
    }
}
