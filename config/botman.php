<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Default Session Driver
    |--------------------------------------------------------------------------
    |
    | This option controls the default session "driver" that will be used on
    | requests. By default, we will use the file driver but you may specify
    | any of the other wonderful drivers provided here.
    |
    | Supported: "file", "cookie", "database", "apc",
    |            "memcached", "redis", "array"
    |
    */
    'session' => [
        'driver' => 'file',
    ],

    /*
    |--------------------------------------------------------------------------
    | Default Cache Driver
    |--------------------------------------------------------------------------
    |
    | This option controls the default cache "driver" that will be used on
    | requests. By default, we will use the file driver but you may specify
    | any of the other wonderful drivers provided here.
    |
    | Supported: "file", "database", "apc",
    |            "memcached", "redis", "array"
    |
    */
    'cache' => [
        'driver' => 'file',
    ],

    /*
    |--------------------------------------------------------------------------
    | Default Conversation Driver
    |--------------------------------------------------------------------------
    |
    | This option controls the default conversation "driver" that will be used on
    | requests. By default, we will use the file driver but you may specify
    | any of the other wonderful drivers provided here.
    |
    | Supported: "file", "database", "apc",
    |            "memcached", "redis", "array"
    |
    */
    'conversation' => [
        'driver' => 'file',
    ],

    /*
    |--------------------------------------------------------------------------
    | Default Driver
    |--------------------------------------------------------------------------
    |
    | This option controls the default driver that will be used on
    | requests. By default, we will use the web driver but you may specify
    | any of the other wonderful drivers provided here.
    |
    | Supported: "web", "facebook", "telegram", "slack", "twilio", "wechat"
    |
    */
    'default' => 'web',

    /*
    |--------------------------------------------------------------------------
    | Drivers
    |--------------------------------------------------------------------------
    |
    | Here you may specify the driver information for each service that
    | is used by your application. A default configuration has been
    | added for each back-end shipped with BotMan. You are free to add more.
    |
    */
    'drivers' => [
        'web' => [
            'matchingData' => [
                'driver' => 'web',
            ],
        ],
    ],
]; 