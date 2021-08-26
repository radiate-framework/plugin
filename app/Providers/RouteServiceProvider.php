<?php

namespace Plugin\Providers;

use Radiate\Foundation\Providers\RouteServiceProvider as ServiceProvider;
use Radiate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * Map the routes
     *
     * @return void
     */
    public function map()
    {
        $this->mapAjaxRoutes();

        $this->mapApiRoutes();
    }

    /**
     * Map the AJAX routes
     *
     * These routes all receive CSRF protection, etc.
     *
     * @return void
     */
    public function mapAjaxRoutes()
    {
        Route::middleware('ajax')
            ->group($this->app->basePath('routes/ajax.php'));
    }

    /**
     * Map the API routes
     *
     * These routes are stateless.
     *
     * @return void
     */
    public function mapApiRoutes()
    {
        Route::namespace('api')
            ->middleware('api')
            ->group($this->app->basePath('routes/api.php'));
    }
}
