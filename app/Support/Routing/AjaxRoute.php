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
        $uri = $this->uri();

        $this->router->listen(
            ['wp_ajax_' . $uri, 'wp_ajax_nopriv_' . $uri],
            $this->handle($request)
        );
    }

    /**
     * Dispatch the route
     *
     * @param \Plugin\Support\Http\Request $request
     * @return void
     */
    public function handle(Request $request)
    {
        return function () use ($request) {
            die($this->runRequestThroughStack($request));
        };
    }
}
