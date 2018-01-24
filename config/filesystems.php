<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Filesystem Disk
    |--------------------------------------------------------------------------
    |
    | Here you may specify the default filesystem disk that should be used
    | by the framework. The "local" disk, as well as a variety of cloud
    | based disks are available to your application. Just store away!
    |
    */

    'default' => env('FILESYSTEM_DRIVER', 'local'),

    /*
    |--------------------------------------------------------------------------
    | Default Cloud Filesystem Disk
    |--------------------------------------------------------------------------
    |
    | Many applications store files both locally and in the cloud. For this
    | reason, you may specify a default "cloud" driver here. This driver
    | will be bound as the Cloud disk implementation in the container.
    |
    */

    'cloud' => env('FILESYSTEM_CLOUD', 's3'),

    /*
    |--------------------------------------------------------------------------
    | Filesystem Disks
    |--------------------------------------------------------------------------
    |
    | Here you may configure as many filesystem "disks" as you wish, and you
    | may even configure multiple disks of the same driver. Defaults have
    | been setup for each driver as an example of the required options.
    |
    | Supported Drivers: "local", "ftp", "s3", "rackspace"
    |
    */

    'disks' => [

        'local' => [
            'driver' => 'local',
            'root' => storage_path('app'),
        ],

        'public' => [
            'driver' => 'local',
            'root' => storage_path('app/public'),
            'url' => env('APP_URL').'/storage',
            'visibility' => 'public',
        ],

        's3' => [
            'driver' => 's3',
            'key' => env('AWS_KEY'),
            'secret' => env('AWS_SECRET'),
            'region' => env('AWS_REGION'),
            'bucket' => env('AWS_BUCKET'),
        ],


        'qiniu' => [
            'driver'        => 'qiniu',
            'domain'        => env('QINIU_DOMAIN', ''),
            'access_key'    => env('QINIU_ACCESS_KEY', ''),
            'secret_key'    => env('QINIU_SECRET_KEY', ''),
            'bucket'        => env('QINIU_BUCKET', ''),
            'transport'     => 'http',
        ],

        'upyun' => [
            'driver'        => 'upyun',
            'domain'        => env('UPYUN_DOMAIN'),
            'username'      => env('UPYUN_USERNAME'),
            'password'      => env('UPYUN_PASSWORD'),
            'bucket'        => env('UPYUN_BUCKET'),
            'timeout'       => 130,
            'endpoint'      => env('UPYUN_ENDPOINT'),
            'transport'     => 'http',
        ],

        'oss'	=> [
            'driver'			=> 'oss',
            'accessKeyId'		=> '',
            'accessKeySecret' 	=> '',
            'endpoint'			=> '',
            'isCName'			=> false,
            'securityToken'		=> null,
            'bucket'            => '',
            'timeout'           => '5184000',
            'connectTimeout'    => '10',
            'transport'     	=> 'http',
            'max_keys'          => 1000,
        ],

        'cos'	=> [
            'driver'			=> 'cos',
            'domain'            => '',
            'app_id'            => '',
            'secret_id'         => '',
            'secret_key'        => '',
            'region'            => 'gz',
            'transport'     	=> 'http',
            'timeout'           => 60,
            'bucket'            => '',
        ],

    ],

];
