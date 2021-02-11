<?php

/**
 * @var \Plugin\Support\Routing\Router $router
 */
$router->prefix('user/{user}')->group(function ($router) {
    $router->get('test/{name?}', function ($request) {
        return $request;
    });
});
