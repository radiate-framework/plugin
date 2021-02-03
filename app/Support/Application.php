<?php

namespace Plugin\Support;

use ArrayAccess;
use Plugin\Support\Console\ConsoleServiceProvider;
use Plugin\Support\View\ViewServiceProvider;

class Application implements ArrayAccess
{
    /**
     * The app instance
     *
     * @var \Plugin\Support\Application
     */
    protected static $instance;

    /**
     * The base path
     *
     * @var string
     */
    protected $basePath;

    /**
     * The bound instances
     *
     * @var array
     */
    protected $instances = [];

    /**
     * The registered providers
     *
     * @var array
     */
    protected $providers = [];

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
     * Bind an instance to the app
     *
     * @param string $abstract
     * @param mixed $concrete
     * @return void
     */
    public function instance(string $abstract, $concrete)
    {
        $this->instances[$abstract] = $concrete;
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
     * Get the app instance
     *
     * @return self
     */
    public static function getInstance()
    {
        if (is_null(static::$instance)) {
            static::$instance = new static;
        }

        return static::$instance;
    }

    /**
     * Set the app instance
     *
     * @param \Plugin\Support\Application $container
     * @return self
     */
    public static function setInstance(Application $app = null)
    {
        return static::$instance = $app;
    }

    /**
     * Get a bound instance
     *
     * @param string $abstract
     * @return mixed
     */
    public function get(string $abstract)
    {
        return $this[$abstract];
    }

    /**
     * Determine if a bound instance exists
     *
     * @param string $key
     * @return bool
     */
    public function offsetExists($key)
    {
        return isset($this->instances[$key]);
    }

    /**
     * Get a bound instance
     *
     * @param string $key
     * @return mixed
     */
    public function offsetGet($key)
    {
        return $this->instances[$key];
    }

    /**
     * Bind an instance
     *
     * @param string $key
     * @param mixed $value
     * @return void
     */
    public function offsetSet($key, $value)
    {
        $this->instances[$key] = $value;
    }

    /**
     * Unbind an instance
     *
     * @param string $key
     * @return void
     */
    public function offsetUnset($key)
    {
        unset($this->instances[$key]);
    }
}
