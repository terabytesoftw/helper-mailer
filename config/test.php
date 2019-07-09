<?php

/**
 * Web application configuration shared by all test types
 */

$params = require __DIR__ . '/params.php';

$config = [
    'id' => 'testme-mailer-user',
    'name'=> 'testme-mailer-user',
    'aliases' => [
        '@bower'   => '@root/node_modules',
        '@npm'   => '@root/node_modules',
        '@public' => '@root/tests/public',
        '@runtime' => '@root/tests/public/@runtime',
        '@terabytesoft/mailer/user' => '@root/src',
    ],
    'basePath' => '@root/src',
    'bootstrap' => ['log'],
    'components' => [
        'assetManager' => [
            'appendTimestamp' => true,
            'basePath' => '@public/assets',
            'forceCopy' => true,
        ],
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=localhost;dbname=appuser',
            'username' => 'root',
            'password' => '1234',
            'charset' => 'utf8',
        ],
        'i18n' => [
            'translations' => [
                'mailer.user' => [
                    'class' => yii\i18n\PhpMessageSource::class,
                ],
            ],
        ],
        'log' => [
            'traceLevel' => 'YII_DEBUG' ? 3 : 0,
            'targets' => [
                [
                    'class' => \yii\log\FileTarget::class,
                    'levels' => ['error', 'warning', 'info'],
                    'logFile' => '@runtime/logs/app.log',
                ],
            ],
        ],
        'mailer' => [
            'useFileTransport' => true,
        ],
        'request' => [
            'cookieValidationKey' => 'testme-asset-floatlabels',
            'enableCsrfValidation' => true,
        ],
    ],
    'modules' => [
        'user' => [
            'class' => terabytesoft\app\user\AppUser::class,
            'accountGeneratingPassword' => true,
            'modelMap' => [
                'TokenModel'   => \terabytesoft\app\user\models\TokenModel::class,
                'UserModel'    => \terabytesoft\app\user\models\UserModel::class,
            ],
        ],
    ],
    'params' => $params,
];

return $config;
