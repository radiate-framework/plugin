<?php

namespace Plugin\Support\Routing;

use Plugin\Support\Http\Request;

class AjaxRoute extends Route
{
    /**
     * Dispatch the request to the route
     *
     * @param \Plugin\Support\Http\Request $request
     * @return void
     */
    public function dispatch(Request $request)
    {
        if (in_array('AUTH', $this->methods())) {
            $this->router->events->listen("wp_ajax_{$this->uri}", $this->handle($request));
        }
        if (in_array('GUEST', $this->methods())) {
            $this->router->events->listen("wp_ajax_nopriv_{$this->uri}", $this->handle($request));
        }
    }

    /**
     * Dispatch the route
     *
     * @return void
     */
    public function handle(Request $request)
    {
        return function () use ($request) {
            die($this->runRequestThroughStack($request));
        };
    }
}
