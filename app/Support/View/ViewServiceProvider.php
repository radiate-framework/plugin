<?php

namespace Plugin\Support\View;

use Plugin\Support\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register the provider
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('view', function ($app) {
            return new View($app->basePath('views'));
        });
    }

    /**
     * Boot the provider
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/resources/views' => $this->app->basePath('views'),
        ], 'views');
    }
}
