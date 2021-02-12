<?php

namespace Plugin\Support\Foundation\Providers;

use Plugin\Support\Support\ServiceProvider;

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

        $this->app['router']->dispatch($this->app['request']);
    }
}
