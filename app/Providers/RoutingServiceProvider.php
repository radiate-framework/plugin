<?php

namespace Plugin\Providers;

use Plugin\Support\Foundation\Providers\RoutingServiceProvider as ServiceProvider;

class RoutingServiceProvider extends ServiceProvider
{
    /**
     * The REST API namespace
     *
     * @var string
     */
    protected $namespace = 'api';

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
        $this->app['router']->group($this->app->basePath('routes/ajax.php'));
    }

    /**
     * Map the API routes
     *
     * @return void
     */
    public function mapApiRoutes()
    {
        $this->app['router']->namespace($this->namespace)
            ->group($this->app->basePath('routes/api.php'));
    }
}
