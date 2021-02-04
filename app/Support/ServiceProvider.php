<?php

namespace Plugin\Support;

use Plugin\Support\Foundation\Application;

abstract class ServiceProvider
{
    /**
     * The app instance
     *
     * @var \Plugin\Support\Foundation\Application
     */
    protected $app;

    /**
     * Create the provider
     *
     * @param \Plugin\Support\Foundation\Application $app
     */
    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    /**
     * Register the provider
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
