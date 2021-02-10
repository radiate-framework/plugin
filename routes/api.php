<?php

/**
 * @var \Plugin\Support\Routing\Router $router
 */

$router->get('test/{name?}', Plugin\Http\Controllers\RestController::class);
