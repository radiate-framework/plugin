<?php

/**
 * Plugin name: WP Base Plugin
 * Plugin URI: https://benrutlandweb.co.uk
 * Description: A WordPress plugin boilerplate
 * Version: 1.0.0
 * Author: Ben Rutland
 * Author URI: https://benrutlandweb.co.uk
 * Text Domain: brw
 */

require __DIR__ . '/vendor/autoload.php';

$app = new Radiate\Foundation\Application(__DIR__);

// register the global middleware. The middleware response can then be
// dispatched to ajax and rest routes, or used within the plugin. This allows
// the plugin to handle the request even if the route is not ajax or rest.
$app->middleware([
    Radiate\Foundation\Http\Middleware\TrimStrings::class,
    Radiate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class,
]);

// register the route middleware. This middleware can be used in route groups
// when defining ajax and rest routes for the applciation.
$app->routeMiddleware([
    'auth' => Radiate\Auth\Middleware\Authenticate::class,
    'ajax' => [
        //
    ],
    'api' => [
        //
    ],
]);

// register the service providers. The providers allow for a pluggable interface
// so vendor packages can be loaded within the framework.
$app->register(Plugin\Providers\EventServiceProvider::class);
$app->register(Plugin\Providers\RouteServiceProvider::class);
$app->register(Radiate\Mail\MailServiceProvider::class);

// boot the app. This will capture the request, run it through the global
// middleware, and then boot each provider.
$app->boot();
