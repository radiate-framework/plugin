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

$app->register(Plugin\Providers\EventServiceProvider::class);
$app->register(Plugin\Providers\PluginServiceProvider::class);

$app->boot();


$app['events']->listen('test_event', function ($test) {
    echo $test;
});

Plugin\event('test_event', 'yep init blud');
