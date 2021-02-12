<?php

namespace Plugin\Providers;

use Plugin\Support\Foundation\Providers\RouteServiceProvider as ServiceProvider;

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
     * @return void
     */
    public function mapAjaxRoutes()
    {
        $this->router()
            ->middleware('ajax')
            ->group($this->app->basePath('routes/ajax.php'));
    }

    /**
     * Map the API routes
     *
     * @return void
     */
    public function mapApiRoutes()
    {
        $this->router()
            ->namespace('api')
            ->middleware('api')
            ->group($this->app->basePath('routes/api.php'));
    }
}
