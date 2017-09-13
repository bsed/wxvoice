<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
    ],
    'modules'=>[

        'gii' => [
            'class' => 'yiigiiModule',
            // 配置访问IP地址
            'allowedIPs' => ['127.0.0.1', '::1', '123.114.84.228']
        ],
        'debug' => [
            'class' => 'yiidebugModule',
            // 配置访问IP地址
            'allowedIPs' => ['127.0.0.1', '::1', '123.114.81.119']
        ],
    ]
];
