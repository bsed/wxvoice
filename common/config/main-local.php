<?php
return [
    'components' => [
        'db' => [
            'class' => 'yii\db\Connection',
<<<<<<< HEAD
            'dsn' => 'mysql:host=127.0.0.1;dbname=maibeila_emifo_',
            'username' => 'maibeila_emifo_',
            'password' => 'JmeChBFapA',
=======
            'dsn' => 'mysql:host=127.0.0.1;dbname=',
            'username' => '',
            'password' => '',
>>>>>>> 9b5bfa44e34f6f53bf6c6b99920ab11a52ec7307
            'charset' => 'utf8',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'viewPath' => '@common/mail',
            'useFileTransport' => true,
        ],
        /*'authManager' => [
            'class' => 'yii\rbac\DbManager',
            'itemTable' => 'auth_item',
            'assignmentTable' => 'auth_assignment',
            'itemChildTable' => 'auth_item_child',
        ],*/
    ],
];
