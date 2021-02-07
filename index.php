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

$app = new Plugin\Support\Foundation\Application(__DIR__);

// register the global middleware. The middleware response can then be
// dispatched to ajax and rest routes, or used within the plugin. This allows
// the plugin to handle the request even if the route is not ajax or rest.
$app->middleware(Plugin\Support\Foundation\Http\Middleware\TrimStrings::class);
$app->middleware(Plugin\Support\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class);

// register the service providers. The providers allow for a pluggable interface
// so vendor packages can be loaded within the framework.
$app->register(Plugin\Providers\EventServiceProvider::class);
$app->register(Plugin\Providers\RoutingServiceProvider::class);

// boot the app. This will capture the request, run it through the global
// middleware, and then boot each provider.
$app->boot();
