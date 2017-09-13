<?php
return [
    'adminEmail' => 'admin@example.com',
    'supportEmail' => 'support@example.com',
    'user.passwordResetTokenExpire' => 3600,
    //上传时用到的静态文件
    'public' => 'http://imgs.emifo.top',
    //前端静态文件地址
    'frontdata' => '',

    //配置微信
    'wechat' => [
        'debug'  => false,
        'app_id'  => '',
        'secret'  => '',
        'oauth' => [
            'aes_key' => '',
            'scopes'   => ['snsapi_userinfo'],
            'callback' => '',
        ],
        'payment' => [
            'merchant_id'        => '',
            'key'                => '',
            'cert_path'          => 'path/to/your/cert.pem', // XXX: 绝对路径！！！！
            'key_path'           => 'path/to/your/key',      // XXX: 绝对路径！！！！
            'notify_url'         => '',       // 你也可以在下单时单独设置来想覆盖它
        ],

    ],
    //配置七牛
    'qiniu'=>[
        'accessKey' => '',
        'secretKey' => '',
        'bucket' => '',
        'pipeline' => '',
        'bucketUrl' => '',
    ],
    //配置阿里大鱼
    'alidayu'=>[
        'accessKeyId'    => '',
        'accessKeySecret' => '',
    ]


];
