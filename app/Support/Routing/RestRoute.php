<?php

namespace Plugin\Support\Routing;

use Plugin\Support\Http\Request;
use WP_REST_Request;

class RestRoute extends Route
{
    /**
     * Dispatch the request to the route
     *
     * @param \Plugin\Support\Http\Request $request
     * @return void
     */
    public function dispatch(Request $request)
    {
        $this->router->listen('rest_api_init', function () use ($request) {
            register_rest_route($this->namespace(), $this->parseUri($this->uri), [
                'methods'             => $this->methods(),
                'callback'            => $this->handle($request),
                'permission_callback' => '__return_true',
            ]);
        });
    }

    public function namespace()
    {
        return $this->attributes['namespace'] ?? 'api';
    }

    /**
     * Parse the uri into a WordPress compatible format.
     *
     * @param string $uri
     * @return string
     */
    protected function parseUri(string $uri): string
    {
        return preg_replace('@\/\{([\w]+?)(\?)?\}@', '\/?(?P<$1>[\w-]+)$2', $this->attributes['prefix'] . '/' . $uri);
    }

    /**
     * Dispatch the route
     *
     * @return void
     */
    public function handle(Request $request)
    {
        return function (WP_REST_Request $wpRequest) use ($request) {
            die($this->runRequestThroughStack($request->merge($wpRequest->get_url_params())));
        };
    }
}
