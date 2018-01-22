<?php

return [
    'default_app' => 'default',
    'base' => [
        'debug' => true,
        'log' => [
            'name' => 'youzan',
            'file' => storage_path('logs/youzan.log'),
            'level' => 'debug',
            'permission' => 0777,
        ]
    ],
    'apps' => [
        'default' => [
            'client_id' => env('YOUZAN_CLIENT_ID', ''),
            'client_secret' => env('YOUZAN_CLIENT_SECRET', ''),
            'type' => \Hanson\Youzan\Youzan::PERSONAL,
            'kdt_id' => env('YOUZAN_KDT_ID', ''),
        ],
    ]
];