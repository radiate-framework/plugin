<?php

namespace Plugin\Support\Routing;

use Throwable;
use Plugin\Support\Events\Dispatcher;
use Plugin\Support\Foundation\Application;
use Plugin\Support\Http\Request;
use Plugin\Support\Routing\Pipeline;

abstract class Controller
{
    /**
     * The app instance
     *
     * @var \Plugin\Support\Foundation\Application
     */
    protected $app;

    /**
     * The event dispatcher
     *
     * @var \Plugin\Support\Events\Dispatcher
     */
    protected $events;

    /**
     * The route middleware
     *
     * @var array
     */
    protected $middleware = [];

    /**
     * Create the controller instance
     */
    public function __construct(Dispatcher $events, Application $app)
    {
        $this->events = $events;
        $this->app = $app;
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
                ->through($this->middleware)
                ->then(function ($request) {
                    return $this->handle($request);
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
     * Handle the controller action
     *
     * @return mixed
     */
    abstract public function handle(Request $request);
}
