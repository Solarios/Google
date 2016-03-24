<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Connection Name
    |--------------------------------------------------------------------------
    |
    | Here you may specify which of the connections below you wish to use as
    | your default connection for all work. Of course, you may use many
    | connections at once using the manager class.
    |
    */

    'default' => 'main',

    /*
    |--------------------------------------------------------------------------
    | Default Connection User
    |--------------------------------------------------------------------------
    |
    */

    'user' => '',

    /*
    |--------------------------------------------------------------------------
    | Google Connections
    |--------------------------------------------------------------------------
    |
    | Here are each of the connections setup for your application. Example
    | configuration has been included, but you may add as many connections as
    | you would like. Note that the 3 supported authentication methods are:
    | "application", "password", and "token".
    |
    */

    'connections' => [

        'main' => [
            'email' => '',
            'account' => '',
            'key' => storage_path() . '/google-service.p12',
            'scopes' => [
                'https://www.googleapis.com/auth/drive'
            ],
            'method' => 'application',
        ],

    ],

];
