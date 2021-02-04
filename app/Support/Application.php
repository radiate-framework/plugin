<?php

namespace Plugin\Support;

use Plugin\Support\Console\ConsoleServiceProvider;
use Plugin\Support\Container\Container;
use Plugin\Support\Filesystem\FilesystemServiceProvider;
use Plugin\Support\View\ViewServiceProvider;

class Application extends Container
{
    /**
     * The base path
     *
     * @var string
     */
    protected $basePath;

    /**
     * The registered providers
     *
     * @var array
     */
    protected $providers = [];

    /**
     * The application namespace
     *
     * @var string
     */
    protected $namespace = 'Plugin';

    /**
     * Create the applicaiton
     *
     * @param string $basePath
     */
    public function __construct(string $basePath = null)
    {
        if ($basePath) {
            $this->basePath = $basePath;
        }

        $this->registerBaseBindings();
        $this->registerCoreProviders();
    }

    /**
     * Register the basic bindings into the container.
     *
     * @return void
     */
    protected function registerBaseBindings()
    {
        static::setInstance($this);

        $this->instance('app', $this);
    }

    /**
     * Register the core service providers
     *
     * @return void
     */
    protected function registerCoreProviders()
    {
        $this->register(ConsoleServiceProvider::class);
        $this->register(FilesystemServiceProvider::class);
        $this->register(ViewServiceProvider::class);
    }

    /**
     * Get the app base path
     *
     * @return string
     */
    public function basePath(string $path = null)
    {
        return $this->basePath . ($path ? DIRECTORY_SEPARATOR . $path : $path);
    }

    /**
     * Register a service provider
     *
     * @param string $provider
     * @return void
     */
    public function register(string $provider)
    {
        $provider = new $provider($this);

        $provider->register();

        $this->providers[] = $provider;
    }

    /**
     * Boot the service providers
     *
     * @return void
     */
    public function bootProviders()
    {
        foreach ($this->providers as $provider) {
            if (method_exists($provider, 'boot')) {
                $provider->boot();
            }
        }
    }

    /**
     * Boot the application
     *
     * @return void
     */
    public function boot()
    {
        $this->bootProviders();
    }

    /**
     * Get the app namespace
     *
     * @return string
     */
    public function getNamespace()
    {
        return $this->namespace;
    }
}
