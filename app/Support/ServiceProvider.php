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
     * The files to publish
     *
     * @var array
     */
    protected static $publishes = [];

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

    /**
     * An array of files/directories to publish
     *
     * @param array $files
     * @return void
     */
    public function publishes(array $files)
    {
        static::$publishes[static::class] = $files;
    }

    /**
     * Get the paths to publish
     *
     * @return array
     */
    public static function pathsToPublish(string $provider)
    {
        return static::$publishes[$provider];
    }
}
