<?php

namespace Plugin\Support\Foundation\Providers;

use Plugin\Support\ServiceProvider;

class RoutingServiceProvider extends ServiceProvider
{
    /**
     * The route controllers
     *
     * @var array
     */
    protected $controllers = [];

    /**
     * Boot the provider
     *
     * @return void
     */
    public function boot()
    {
        foreach ($this->controllers as $controller) {
            $route = new $controller($this->app['events'], $this->app);

            $route->dispatch($this->app['request']);
        }
    }
}
