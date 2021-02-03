<?php

namespace Plugin\Providers;

use Plugin\Support\ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    protected $routeControllers = [
        \Plugin\Http\Controllers\AjaxController::class,
    ];

    /**
     * Register the provider
     *
     * @return void
     */
    public function register()
    {
        foreach ($this->routeControllers as $controller) {
            new $controller;
        }
    }
}
