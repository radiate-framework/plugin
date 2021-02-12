<?php

namespace Plugin\Support\Foundation\Providers;

use Plugin\Support\ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * Map the routes
     *
     * @return void
     */
    public function map()
    {
        //
    }

    /**
     * Boot the provider
     *
     * @return void
     */
    public function boot()
    {
        $this->map();

        $this->router()->dispatch($this->app['request']);
    }

    /**
     * Get the router instance
     *
     * @return \Plugin\Support\Routing\Router
     */
    public function router()
    {
        return $this->app['router'];
    }
}
