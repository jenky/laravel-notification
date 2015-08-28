<?php

return [
	
    /*
    |--------------------------------------------------------------------------
    | Default Notification Driver
    |--------------------------------------------------------------------------
    |
    | This option controls the notification driver that will be utilized.
    | Supported: "message", "mail"
    |
    */

    'default' => ['message', 'mail'],

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
    | Notification Drivers
    |--------------------------------------------------------------------------
    |
    | Here are each of the notification drivers for your application.
    |
    */

    'drivers' => [

    ],
];