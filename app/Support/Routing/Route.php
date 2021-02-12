<?php

namespace Plugin\Support\Routing;

use Plugin\Support\Foundation\Application;
use Plugin\Support\Http\Request;
use Throwable;

abstract class Route
{
    /**
     * The router instance
     *
     * @var \Plugin\Support\Routing\Router
     */
    protected $router;

    /**
     * The router instance
     *
     * @var \Plugin\Support\Foundation\Application
     */
    protected $app;

    /**
     * The route methods
     *
     * @var array
     */
    protected $methods;

    /**
     * The route URI
     *
     * @var string
     */
    protected $uri;

    /**
     * The route action
     *
     * @var mixed
     */
    protected $action;

    /**
     * The route attributes
     *
     * @var array
     */
    protected $attributes;

    /**
     * Create the route instance
     *
     * @param array|string $methods
     * @param string $uri
     * @param mixed $action
     */
    public function __construct($methods, string $uri, $action)
    {
        $this->methods = (array) $methods;
        $this->uri = $uri;
        $this->action = $action;
    }

    /**
     * Get the URI
     *
     * @return string
     */
    public function uri()
    {
        return $this->prefix($this->uri);
    }

    /**
     * Get the route action
     *
     * @return mixed
     */
    public function action()
    {
        if (is_callable($this->action)) {
            return $this->action;
        }
        if (is_string($this->action) && class_exists($this->action)) {
            return [new $this->action, '__invoke'];
        }
    }

    /**
     * Return the route methods
     *
     * @return array
     */
    public function methods()
    {
        return $this->methods;
    }

    /**
     * Get the route middleware
     *
     * @return array
     */
    public function middleware()
    {
        return $this->attributes['middleware'] ?? [];
    }

    /**
     * Get the route prefix
     *
     * @param string $path
     * @param string $sep
     * @return string
     */
    public function prefix(string $path = '')
    {
        return trim($this->attributes['prefix'] . ($path ? '/' . $path : $path), '/');
    }

    /**
     * Get the route namespace
     *
     * @return string
     */
    public function namespace()
    {
        return $this->attributes['namespace'] ?? 'api';
    }

    /**
     * Set the group attributes
     *
     * @param array $attributes
     * @return void
     */
    public function setGroupAttributes(array $attributes)
    {
        $this->attributes = $attributes;
    }

    /**
     * Set the router
     *
     * @param Plugin\Support\Routing\Router $router
     * @return self
     */
    public function setRouter(Router $router)
    {
        $this->router = $router;

        return $this;
    }

    /**
     * Set the container
     *
     * @param \Plugin\Support\Routing\Application $app
     * @return self
     */
    public function setContainer(Application $app)
    {
        $this->app = $app;

        return $this;
    }

    /**
     * Handle the controller action
     *
     * @param \Plugin\Support\Http\Request $request
     * @param array $parameters
     * @return mixed
     */
    protected function runRequestThroughStack(Request $request, array $parameters = [])
    {
        try {
            $response = (new Pipeline())
                ->send($request)
                ->through($this->middleware())
                ->then(function ($request) use ($parameters) {
                    return call_user_func($this->action(), $request, ...$parameters);
                });
        } catch (Throwable $e) {
            $response = $this->app->renderException($request, $e);
        }

        return $response;
    }

    /**
     * Dispatch the request to the route
     *
     * @param \Plugin\Support\Http\Request $request
     * @return void
     */
    abstract public function dispatch(Request $request);

    /**
     * Handle the route
     *
     * @param \Plugin\Support\Http\Request $request
     * @return void
     */
    abstract public function handle(Request $request);
}
