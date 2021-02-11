<?php

namespace Plugin\Support\Routing;

use Plugin\Support\Foundation\Application;
use Throwable;
use Plugin\Support\Http\Request;

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
        $this->action = $this->resolveAction($action);
    }

    /**
     * Resolve the action to a callable
     *
     * @param mixed $action
     * @return mixed
     */
    public function resolveAction($action)
    {
        if (is_callable($action)) {
            return $action;
        }
        if (is_string($action) && class_exists($action)) {
            return [new $action, '__invoke'];
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
     * @return mixed
     */
    protected function runRequestThroughStack(Request $request)
    {
        try {
            $response = (new Pipeline())
                ->send($request)
                ->through($this->attributes['middleware'] ?? [])
                ->then(function ($request) {
                    return call_user_func($this->action, $request);
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
     * @return void
     */
    abstract public function handle(Request $request);
}
