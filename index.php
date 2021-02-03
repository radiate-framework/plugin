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

$app = new Plugin\Support\Application(__DIR__);

// $app->register(Plugin\Providers\RouteServiceProvider::class);
$app->register(Plugin\Support\Console\ConsoleServiceProvider::class);
$app->register(Plugin\Support\View\ViewServiceProvider::class);

$app->boot();
