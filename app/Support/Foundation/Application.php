<?php

namespace Plugin\Support\Foundation;

use Plugin\Support\Auth\AuthServiceProvider;
use Plugin\Support\Container\Container;
use Plugin\Support\Events\EventServiceProvider;
use Plugin\Support\Foundation\Exceptions\Handler as ExceptionHandler;
use Plugin\Support\Foundation\Providers\ConsoleServiceProvider;
use Plugin\Support\Filesystem\FilesystemServiceProvider;
use Plugin\Support\Http\Request;
use Plugin\Support\Routing\Pipeline;
use Plugin\Support\View\ViewServiceProvider;
use Throwable;

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
     * The global middleware
     *
     * @var array
     */
    protected $middleware = [];

    /**
     * The route middleware
     *
     * @var array
     */
    protected $routeMiddleware = [];

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

        $this->singleton(ExceptionHandler::class, function ($app) {
            return new ExceptionHandler($app);
        });
    }

    /**
     * Register the core service providers
     *
     * @return void
     */
    protected function registerCoreProviders()
    {
        $this->register(AuthServiceProvider::class);
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
     * @return \Plugin\Support\Http\Request
     */
    protected function captureRequest()
    {
        $this->instance('request', $request = Request::capture());

        return $request;
    }

    /**
     * Capture the server request
     *
     * @return void
     */
    protected function runRequestThroughStack(Request $request)
    {
        try {
            $response = (new Pipeline())
                ->send($request)
                ->through($this->middleware)
                ->then(function ($request) {
                    $this->instance('request', $request);

                    return $request;
                });
        } catch (Throwable $e) {
            $response = $this->renderException($request, $e);
        }

        return $response;
    }

    /**
     * Add a global middleware to the app
     *
     * @param array $middleware
     * @return self
     */
    public function middleware(array $middleware)
    {
        $this->middleware = array_unique(array_merge($this->middleware, $middleware));

        return $this;
    }

    /**
     * Add a global middleware to the app
     *
     * @param array $middleware
     * @return self
     */
    public function routeMiddleware(array $middleware)
    {
        $this->routeMiddleware = array_merge($this->routeMiddleware, $middleware);

        return $this;
    }

    /**
     * Get the route middleware
     *
     * @return array
     */
    public function getRouteMiddleware()
    {
        return $this->routeMiddleware;
    }

    /**
     * Boot the application
     *
     * @return void
     */
    public function boot()
    {
        $request = $this->captureRequest();

        $this->runRequestThroughStack($request);

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

    /**
     * Render an HTTP exception
     *
     * @param \Plugin\Support\Http\Request $request
     * @param \Throwable $e
     * @return string
     */
    public function renderException(Request $request, Throwable $e)
    {
        return $this[ExceptionHandler::class]->render($request, $e);
    }
}
