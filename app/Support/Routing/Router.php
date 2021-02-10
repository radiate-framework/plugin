<?php

namespace Plugin\Support\Routing;

use Closure;
use Plugin\Support\Events\Dispatcher;
use Plugin\Support\Http\Request;

class Router
{
    /**
     * The events instance
     *
     * @var \Plugin\Support\Events\Dispatcher
     */
    public $events;

    /**
     * The router group stack
     *
     * @var array
     */
    protected $groupStack = [];

    /**
     * The current group
     *
     * @var array
     */
    protected $currentGroup = [];

    /**
     * The registered routes
     *
     * @var array
     */
    protected $routes = [];

    /**
     * Create the router instance
     *
     * @param \Plugin\Support\Events\Dispatcher $events
     */
    public function __construct(Dispatcher $events)
    {
        $this->events = $events;
    }

    /**
     * Create an ajax route
     *
     * @param string $uri
     * @param \Closure $action
     * @return void
     */
    public function ajax(string $uri, $action)
    {
        return $this->addRoute(new AjaxRoute(['AUTH', 'GUEST'], $uri, $action));
    }

    /**
     * Create an ajax route
     *
     * @param string $uri
     * @param \Closure $action
     * @return void
     */
    public function get(string $uri, $action)
    {
        return $this->addRoute(new RestRoute(['GET', 'HEAD'], $uri, $action));
    }

    /**
     * Regsiter the route in the router
     *
     * @param Plugin\Support\Routing\Route $route
     * @return void
     */
    public function addRoute(Route $route)
    {
        $this->routes[] = $route;

        // $route->addMiddlewareAndPrefix()

        return $route;
    }

    /**
     * Set a group middleware
     *
     * @param string|array $middleware
     * @return self
     */
    public function middleware($middleware)
    {
        $this->currentGroup['middleware'] = (array) $middleware;

        return $this;
    }

    /**
     * Get teh group middleware
     *
     * @return array
     */
    public function getMiddleware()
    {
        return array_column($this->groupStack, 'middleware');
    }

    /**
     * Set the group prefix
     *
     * @param string $prefix
     * @return self
     */
    public function prefix(string $prefix)
    {
        $this->currentGroup['prefix'] = trim($prefix, '/');

        return $this;
    }

    /**
     * Get the group prefix
     *
     * @return string
     */
    public function getPrefix()
    {
        return implode('/', array_column($this->groupStack, 'prefix'));
    }

    /**
     * Set the group namespace
     *
     * @param string $namespace
     * @return self
     */
    public function namespace(string $namespace)
    {
        $this->currentGroup['namespace'] = trim($namespace, '/');

        return $this;
    }

    /**
     * Get the group namespace
     *
     * @return string
     */
    public function getNamespace()
    {
        return implode('/', array_column($this->groupStack, 'namespace'));
    }

    /**
     * Define a group in the router
     *
     * @param \Closure|string $callback
     * @return void
     */
    public function group($callback)
    {
        $this->groupStack[] = $this->currentGroup;

        $callback = $this->resolveGroupCallback($callback);

        $callback($this);

        array_pop($this->groupStack);

        $this->currentGroup = [];
    }

    /**
     * Resolve the group callback
     *
     * @param \Closure|string $callback
     * @return \Closure
     */
    protected function resolveGroupCallback($callback)
    {
        return $callback instanceof Closure ?: function ($router) use ($callback) {
            require $callback;
        };
    }

    /**
     * Dispatch the request
     *
     * @param Plugin\Support\Http\Request $request
     * @return void
     */
    public function dispatch(Request $request)
    {
        foreach ($this->routes as $route) {
            $route->setRouter($this)->dispatch($request);
        }
    }
}
