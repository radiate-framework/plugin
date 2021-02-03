<?php

namespace Plugin\Support\View;

use Plugin\Support\ServiceProvider;
use Plugin\Support\View\View;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register the provider
     *
     * @return void
     */
    public function register()
    {
        $this->app->instance('view', new View($this->app->basePath('views')));
    }
}
