<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Authentication Provider Default
    |--------------------------------------------------------------------------
    |
    | This option controls the default authentication "provider". You may
    | change this default as required.
    |
    | Supported: "radiate", "wordpress"
    |
    */

    'default' => 'radiate',

    /*
    |--------------------------------------------------------------------------
    | User Providers
    |--------------------------------------------------------------------------
    |
    | All authentication drivers have a user provider. This defines how the
    | users are accessed from the authentication system.
    |
    */

    'providers' => [

        'radiate' => [
            'driver' => 'radiate',
            'model'  => \Plugin\Models\User::class,
        ],

        'wordpress' => [
            'driver' => 'wordpress',
        ],
    ],
];
