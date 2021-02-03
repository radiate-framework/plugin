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

$app = new App\Application();

$app->boot();
