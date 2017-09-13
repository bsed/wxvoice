<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'web-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    'components' => [
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
        ],
		'request' => [
            'csrfParam' => '_csrf',
			'cookieValidationKey' => 'fcuVvgFv0Vex88Qm5N2-h6HH5anM4HEd',
        ],
		
		
		'urlManager' => [
			   'enablePrettyUrl' => true,
			   'showScriptName' => false,
			   'suffix' => '.html',
			   'rules' => [
			   'news/<pid:\d+>' => 'site/article-list',
			   'case/<pid:\d+>' => 'site/case-list',
			   'view/<id:\d+>' => 'site/article-content',
			   'page/<pid:\d+>' => 'site/page',
			   
				 ],
				],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],

    ],
    'params' => $params,
];
