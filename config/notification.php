<?php

return [

    /*
    |--------------------------------------------------------------------------
    | User Model
    |--------------------------------------------------------------------------
    |
    | We need to know which Eloquent model should be used to retrieve your users. 
    | Of course, it is often just the "User" model but you may use whatever you like.
    |
    */

    'model' => App\User::class,

    /*
    |--------------------------------------------------------------------------
    | Default Notification Driver
    |--------------------------------------------------------------------------
    |
    | This option controls the notification driver that will be utilized.
    | Supported: "alert", "mail"
    |
    */

    'default' => 'alert',

    /*
    |--------------------------------------------------------------------------
    | Notification Drivers
    |--------------------------------------------------------------------------
    |
    | Here are each of the notification drivers for your application.
    |
    */

    'drivers' => [

        'alert' => [
            'driver' => 'alert',
        ],

        'mail' => [
            'driver' => 'mail',
        ],

        'mobile' => [
            'ios' => [
                'environment' => 'development',
                'certificate' => '/path/to/certificate.pem',
                'passPhrase'  => 'password',
                'service'     => 'apns',
            ],
            'android' => [
                'environment' => 'production',
                'apiKey'      => 'yourAPIKey',
                'service'     => 'gcm',
            ],
        ],
    ],
];
