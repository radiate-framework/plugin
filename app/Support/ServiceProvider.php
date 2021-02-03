<?php

namespace Plugin\Support;

use Plugin\Support\Application;

abstract class ServiceProvider
{
    /**
     * The app instance
     *
     * @var \Plugin\Support\Application
     */
    protected $app;

    /**
     * Create the provider
     *
     * @param \Plugin\Support\Application $app
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
