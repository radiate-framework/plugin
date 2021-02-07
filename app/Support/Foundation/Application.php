<?php

namespace Plugin\Support\Foundation;

use Plugin\Support\Container\Container;
use Plugin\Support\Events\EventServiceProvider;
use Plugin\Support\Foundation\Providers\ConsoleServiceProvider;
use Plugin\Support\Filesystem\FilesystemServiceProvider;
use Plugin\Support\Http\Request;
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
    protected $namespace = 'Plugin\\';

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
        $this->register(EventServiceProvider::class);
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
    protected function bootProviders()
    {
        foreach ($this->providers as $provider) {
            if (method_exists($provider, 'boot')) {
                $provider->boot();
            }
        }
    }

    /**
     * Capture the server request
     *
     * @return void
     */
    protected function captureRequest()
    {
        $this->instance('request', Request::capture());
    }

    /**
     * Boot the application
     *
     * @return void
     */
    public function boot()
    {
        $this->captureRequest();

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

    /**
     * Determine if the app is running in the console
     *
     * @return bool
     */
    public function runningInConsole()
    {
        return class_exists('WP_CLI');
    }
}
