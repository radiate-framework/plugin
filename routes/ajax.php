<?php

/**
 * @var \Plugin\Support\Routing\Router $router
 */

$router->prefix('qwerty')->group(function ($router) {
    $router->prefix('user')->group(function ($router) {
        $router->ajax('test', function ($request) {
            return $request;
        });
    });
});
