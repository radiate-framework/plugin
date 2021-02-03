<?php

namespace App;

/**
 * This file is for all the plugin helper functions. Functions should be called
 * using the namespace to prevent function conflicts with other plugins or the theme.
 */

/**
 * Dump and die the given arguments
 *
 * @param mixed ...$args
 * @return void
 */
function dd(...$args): void
{
    die(dump(...$args));
}

/**
 * Dump the given arguments
 *
 * @param mixed ...$args
 * @return void
 */
function dump(...$args): void
{
    var_dump(...$args);
}

/**
 * Include a view with optional passed parameters
 *
 * @param string $path
 * @param array $args
 * @return string
 */
function view(string $path, array $args = []): string
{
    $path = str_replace('.', DIRECTORY_SEPARATOR, 'views.' . $path) . '.php';

    ob_start();

    extract($args);

    require __DIR__ . DIRECTORY_SEPARATOR . $path;

    return ob_get_clean();
}
