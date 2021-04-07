<?php

use Radiate\Support\Facades\App;

return [
    /*
    |--------------------------------------------------------------------------
    | Asset URL
    |--------------------------------------------------------------------------
    |
    | This URL is used to properly generate URLs when using the UrlGenerator
    | class.
    |
    */

    'asset_url' => plugin_dir_url(App::basePath('index.php')) . 'assets/',
];
