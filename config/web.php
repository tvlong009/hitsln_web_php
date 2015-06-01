<?php

$params = require(__DIR__ . '/params.php');

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'defaultRoute' => 'home',
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'Pk7u3PXPlzgQ9hnCMnsn_IfTbfTTHAwW',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
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
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => true,
            'rules' => [
                'cmsparticles/content-list/files/<path:[0-9a-zA-Z\._-]+>/<file:[0-9a-zA-Z\._-]+>' => 'cmsparticles/content-list/files',
                'pages/files/<path:[0-9a-zA-Z\._-]+>/<file:[0-9a-zA-Z\._-]+>' => 'pages/files',
                'home/files/<path:[0-9a-zA-Z\._-]+>/<file:[0-9a-zA-Z\._-]+>' => 'home/files'
            ]
        ],
        'db' => require(__DIR__ . '/db.php'),
    ],
    'modules' => [
        'redactor' => [
            'class' => 'yii\redactor\RedactorModule',
            'uploadDir' => '@webroot/files',
            'uploadUrl' => 'files'
        ],
        'cmsparticles' => [
            'class' => 'app\modules\cmsparticles\particle',
        ],
        'loginwidget' => [
            'class' => 'app\modules\loginwidget\login',
        ],
        'streamingwidget' => [
            'class' => 'app\modules\streamingwidget\streaming',
        ],
        'socialwidget' => [
            'class' => 'app\modules\socialwidget\socialwidget',
        ],
        'slidewidget' => [
            'class' => 'app\modules\slidewidget\slidewidget',
        ],
        'newsletterwidget' => [
            'class' => 'app\modules\newsletterwidget\newsletter',
        ],
        'quicklinkwidget' => [
            'class' => 'app\modules\quicklinkwidget\quicklink',
        ],
        'userpropertywidget' => [
            'class' => 'app\modules\userpropertywidget\userproperty',
        ],
        'useractivity' => [
            'class' => 'app\modules\useractivity\activity',
        ],
        'menuwidget' => [
            'class' => 'app\modules\menuwidget\menu',
        ],
        'languagewidget' => [
            'class' => 'app\modules\languagewidget\language',
        ],
        'signupwidget' => [
            'class' => 'app\modules\signupwidget\signup',
        ],
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = 'yii\debug\Module';

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = 'yii\gii\Module';
}

return $config;
