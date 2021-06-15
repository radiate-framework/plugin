<?php

use Radiate\Support\Facades\App;

if (!function_exists('base_path')) {
    /**
     * Get a path from the app base path
     *
     * @param string $path
     * @return string
     */
    function base_path(?string $path = null)
    {
        return App::basePath($path);
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
