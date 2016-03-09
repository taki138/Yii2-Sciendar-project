<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    'components' => [
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'enableStrictParsing' => true,
            'rules' => [
                'feedback' => 'site/feedback',
                '' => 'site/index',
                'site/<action:(contact|signup|login|about|logout)>' => 'site/<action>'
            ],

        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
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
        'reCaptcha' => [
                'name' => 'reCaptcha',
                'class' => 'himiklab\yii2\recaptcha\ReCaptcha',
                'siteKey' => '6LfAABgTAAAAABqIJkAyOwAW0DjUk4B5XKeHNN7l',
                'secret' => '6LfAABgTAAAAAFTvKHIM5irhUOTO0vdEE0rkpHlL',
                ],
    ],
    'params' => $params,
];
