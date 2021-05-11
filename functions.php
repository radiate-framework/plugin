<?php

/**
 * Plugin name: Radiate Plugin
 * Plugin URI: https://benrutlandweb.co.uk
 * Description: A WordPress plugin boilerplate
 * Version: 1.0.0
 * Author: Ben Rutland
 * Author URI: https://benrutlandweb.co.uk
 * Text Domain: radiate
 */

/**
 * -----------------------------------------------------------------------------
 *  Register The Auto Loader
 * -----------------------------------------------------------------------------
 *
 *  Composer provides a convenient, automatically generated class loader for
 *  our application. We just need to utilize it! We'll simply require it
 *  into the script here so that we don't have to worry about manual
 *  loading any of our classes later on. It feels great to relax.
 *
 */

require __DIR__ . '/vendor/autoload.php';


/**
 * -----------------------------------------------------------------------------
 *  Create The Application
 * -----------------------------------------------------------------------------
 *
 *  The first thing we will do is create a new Radiate application instance
 *  which serves as the "glue" for all the components, and is the IoC container
 *  for the system binding all of the various parts.
 *
 */

$app = new Radiate\Foundation\Application(__DIR__);


/**
 * -----------------------------------------------------------------------------
 *  Register the middleware
 * -----------------------------------------------------------------------------
 *
 *  The global and route middleware can be assigned here. The request is run
 *  through the global middleware on every request whilst the route
 *  middleware may be assigned to individual routes or groups of routes.
 *
 */

$app->middleware([
    Radiate\Foundation\Http\Middleware\TrimStrings::class,
    Radiate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class,
]);

$app->routeMiddleware([
    'auth' => Radiate\Auth\Middleware\Authenticate::class,
    'ajax' => [
        //
    ],
    'api' => [
        //
    ],
    'signed' => Radiate\Routing\Middleware\ValidateSignature::class,
]);


/**
 * -----------------------------------------------------------------------------
 *  Autoloaded Service Providers
 * -----------------------------------------------------------------------------
 *
 *  The service providers listed here will be loaded on the request
 *  to your application. Feel free to add your own services to
 *  grant expanded functionality to your applications.
 *
 */

$app->register(Radiate\Auth\AuthServiceProvider::class);
$app->register(Radiate\Cache\CacheServiceProvider::class);
$app->register(Radiate\Database\DatabaseServiceProvider::class);
$app->register(Radiate\Foundation\Providers\FormRequestServiceProvider::class);
$app->register(Radiate\Mail\MailServiceProvider::class);
$app->register(Radiate\Routing\RoutingServiceProvider::class);
$app->register(Radiate\Validation\ValidationServiceProvider::class);
$app->register(Radiate\View\ViewServiceProvider::class);
$app->register(Radiate\WordPress\WordPressServiceProvider::class);

$app->register(Plugin\Providers\EventServiceProvider::class);
$app->register(Plugin\Providers\PluginServiceProvider::class);
$app->register(Plugin\Providers\RouteServiceProvider::class);
$app->register(Plugin\Providers\WordPressServiceProvider::class);


/**
 * -----------------------------------------------------------------------------
 *  Class Aliases
 * -----------------------------------------------------------------------------
 *
 * This array of class aliases will be registered when this application
 * is started. However, feel free to register as many as you wish as
 * the aliases are "lazy" loaded so they don't hinder performance.
 *
 */

$app->aliases([
    'App'        => \Radiate\Support\Facades\App::class,
    'Arr'        => \Radiate\Support\Arr::class,
    'Auth'       => \Radiate\Support\Facades\Auth::class,
    'Cache'      => \Radiate\Support\Facades\Cache::class,
    'Collection' => \Radiate\Support\Collection::class,
    'Config'     => \Radiate\Support\Facades\Config::class,
    'DB'         => \Radiate\Support\Facades\DB::class,
    'Event'      => \Radiate\Support\Facades\Event::class,
    'File'       => \Radiate\Support\Facades\File::class,
    'Hash'       => \Radiate\Support\Hash::class,
    'Http'       => \Radiate\Support\Facades\Http::class,
    'Mail'       => \Radiate\Support\Facades\Mail::class,
    'Request'    => \Radiate\Support\Facades\Request::class,
    'Route'      => \Radiate\Support\Facades\Route::class,
    'Str'        => \Radiate\Support\Str::class,
    'URL'        => \Radiate\Support\Facades\URL::class,
    'Validator'  => \Radiate\Support\Facades\Validator::class,
    'View'       => \Radiate\Support\Facades\View::class,
]);


/**
 * -----------------------------------------------------------------------------
 *  Run The Application
 * -----------------------------------------------------------------------------
 *
 *  Once we have the application, we can handle the incoming request and
 *  allow the client to enjoy the creative and wonderful
 *  application we have prepared for them.
 *
 */

$app->boot();
