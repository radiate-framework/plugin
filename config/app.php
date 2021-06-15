<?php

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

    'asset_url' => plugin_dir_url(base_path('index.php')) . 'assets/',

    /*
    |--------------------------------------------------------------------------
    | Encryption Key
    |--------------------------------------------------------------------------
    |
    | This key is used by the Illuminate encrypter service and should be set
    | to a random, 32 character string, otherwise these encrypted strings
    | will not be safe. Please do this before deploying an application!
    |
    */

    'key' => env('RADIATE_KEY'),

    'cipher' => 'AES-256-CBC',
];
