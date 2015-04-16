<?php

$params = require(__DIR__ . '/params.php');

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'language'=>'en',
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'CGcaMnJ1asyrTBuG9qkxN7Xa-Yc-vrLP',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\site\User',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'backend/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
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
        'db' => require(__DIR__ . '/db.php'),
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => true,
            'rules' => [
            ]
        ],
        'i18n' => [
        'translations' => [
            'app*' => [
                'class' => 'yii\i18n\DbMessageSource',

            ],
        ],
    ],
    ],
    'defaultRoute' => 'site',
    'params' => $params,
    'modules' => [
        'redactor' => 'yii\redactor\RedactorModule',
        'cmsparticles' => [
            'class' => 'app\modules\cmsparticles\particle',
        ], 
        'loginwidget' => [
            'class' => 'app\modules\loginwidget\login',
        ],
    ],
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = 'yii\debug\Module';

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = 'yii\gii\Module';

    $config['bootstrap'][] = 'utility';
    $config['modules']['utility'] = [
        'class' => 'c006\utility\migration\Module',
    ];
}

return $config;
