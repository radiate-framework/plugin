<?php

use Radiate\Foundation\Application;
use Radiate\Http\ResponseFactory;
use Radiate\View\Factory as ViewFactory;

if (!function_exists('app')) {
    /**
     * Get the available container instance.
     *
     * @param  string|null  $abstract
     * @param  array  $parameters
     * @return mixed|\Radiate\Foundation\Application
     */
    function app(?string $abstract = null, array $parameters = [])
    {
        if (is_null($abstract)) {
            return Application::getInstance();
        }

        return Application::getInstance()->make($abstract, $parameters);
    }
}

if (!function_exists('base_path')) {
    /**
     * Get a path from the app base path
     *
     * @param string $path
     * @return string
     */
    function base_path(?string $path = null)
    {
        return app()->basePath($path);
    }
}

if (!function_exists('env')) {
    /**
     * Get an "environment" variable with getenv or constant
     *
     * @param string $key
     * @param mixed $default
     * @return mixed
     */
    function env(string $key, $default = null)
    {
        if ($env = getenv($key)) {
            return $env;
        }

        if (defined($key)) {
            return constant($key);
        }

        return $default;
    }
}

if (!function_exists('response')) {
    /**
     * Create a HTTP response
     *
     * @param mixed $content
     * @param integer $status
     * @param array $headers
     * @return \Radiate\Http\ResponseFactory|\Radiate\Http\Response
     */
    function response($content = '', int $status = 200, array $headers = [])
    {
        $factory = app(ResponseFactory::class);

        if (func_num_args() === 0) {
            return $factory;
        }

        return $factory->make($content, $status, $headers);
    }
}

if (!function_exists('view')) {
    /**
     * Create a view
     *
     * @param string|null $view
     * @param array $data
     * @return \Radiate\View\Factory|\Radiate\View\View
     */
    function view(?string $view = null, array $data = [])
    {
        $factory = app(ViewFactory::class);

        if (func_num_args() === 0) {
            return $factory;
        }

        return $factory->make($view, $data);
    }
}
