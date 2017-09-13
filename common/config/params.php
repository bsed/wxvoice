<?php
return [
    'adminEmail' => 'admin@example.com',
    'supportEmail' => 'support@example.com',
    'user.passwordResetTokenExpire' => 3600,
    //上传时用到的静态文件
    'public' => 'http://imgs.emifo.top',
    //前端静态文件地址
    'frontdata' => 'http://maibeila.emifo.top/attachment',

    //配置微信
    'wechat' => [
        'debug'  => false,
        'app_id'  => 'wx46b3ddbed629ab60',
        'secret'  => 'b48686496d6a5eedc51cbcd967ab35df',
        'oauth' => [
            'aes_key' => '',
            'scopes'   => ['snsapi_userinfo'],
            'callback' => 'http://maibeila.emifo.top/members/wxlogin.html',
        ],
        'payment' => [
            'merchant_id'        => '1402693502',
            'key'                => 'X7nQ0NbRLsinSe4JRzQdLRRI0RsiGX0s',
            'cert_path'          => 'path/to/your/cert.pem', // XXX: 绝对路径！！！！
            'key_path'           => 'path/to/your/key',      // XXX: 绝对路径！！！！
            'notify_url'         => '',       // 你也可以在下单时单独设置来想覆盖它
        ],

    ],
    //配置七牛
    'qiniu'=>[
        'accessKey' => 'qWvxyJ6MS3SWwBDJndCAr0IEV8vs07zKOcA8HGzq',
        'secretKey' => 'bN5QoVWDoacgF1rAPQP-WfK00bRcCCsq-mEyxV-l',
        'bucket' => 'd9dao',
        'pipeline' => 'medias',
        'bucketUrl' => 'http://7xvkxv.com1.z0.glb.clouddn.com/',
    ],
    //配置阿里大鱼
    'alidayu'=>[
        'accessKeyId'    => 'LTAIpjk51FmhZYj2',
        'accessKeySecret' => 'Jm7W5vxZn1ZhPWWmkOjSk9CM43T2Vj',
    ]


];
