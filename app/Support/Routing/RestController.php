<?php

namespace Plugin\Support\Routing;

use Plugin\Support\Http\Request;
use WP_REST_Request;

abstract class RestController extends Controller
{
    /**
     * The REST namespace
     *
     * @var string
     */
    protected $namespace;

    /**
     * The REST uri
     *
     * @var string
     */
    protected $uri;

    /**
     * The route methods
     *
     * @var array
     */
    protected $methods = [];

    /**
     * Dispatch the request to the route
     *
     * @param \Plugin\Support\Http\Request $request
     * @return void
     */
    public function dispatch(Request $request)
    {
        $this->request = $request;

        $this->events->listen('rest_api_init', [$this, 'register']);
    }

    /**
     * Register the REST route
     *
     * @return void
     */
    public function register()
    {
        register_rest_route($this->namespace, $this->parseUri($this->uri), [
            'methods'             => $this->methods,
            'callback'            => [$this, 'runRoute'],
            'permission_callback' => '__return_true',
        ]);
    }

    /**
     * Parse the uri into a WordPress compatible format.
     *
     * @param string $uri
     * @return string
     */
    protected function parseUri(string $uri): string
    {
        return preg_replace('@\/\{([\w]+?)(\?)?\}@', '\/?(?P<$1>[\w-]+)$2', $uri);
    }

    /**
     * Dispatch the route
     *
     * @return void
     */
    public function runRoute(WP_REST_Request $wpRequest)
    {
        $request = $this->request->merge($wpRequest->get_url_params());

        die($this->runRequestThroughStack($request));
    }
}
