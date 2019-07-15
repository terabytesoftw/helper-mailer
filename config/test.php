<?php

/**
 * Web application configuration shared by all test types
 */

$params = require __DIR__ . '/maileruser.php';

$config = [
    'id' => 'Mailer-User',
    'name'=> 'Mailer-User',
    'aliases' => [
        '@bower'   => '@root/node_modules',
        '@npm'   => '@root/node_modules',
        '@public' => '@root/tests/public',
        '@runtime' => '@root/tests/public/@runtime',
        '@terabytesoft/helpers/tests/views' => '@root/tests/_data',
    ],
    'basePath' => '@root/src',
    'bootstrap' => ['log'],
    'components' => [
        'assetManager' => [
            'appendTimestamp' => true,
            'basePath' => '@public/assets',
            'forceCopy' => true,
        ],
        'log' => [
            'traceLevel' => 'YII_DEBUG' ? 3 : 0,
            'targets' => [
                [
                    'class' => \yii\log\FileTarget::class,
                    'categories' => [
                        'yii\swiftmailer\Logger::add'
                    ],
                    'levels' => ['error', 'warning', 'info'],
                    'logFile' => '@runtime/logs/app.log',
                ],
            ],
        ],
        'mailer' => [
            'class' => \yii\swiftmailer\Mailer::class,
            'enableSwiftMailerLogging' => true,
            'useFileTransport' => true,
        ],
        'request' => [
            'cookieValidationKey' => 'testme-asset-floatlabels',
            'enableCsrfValidation' => true,
        ],
    ],
    'modules' => [
        'user' => [
            'class' => \terabytesoft\mailer\user\tests\_data\AppUser::class,
            'accountGeneratingPassword' => true,
        ],
    ],
    'params' => $params,
];

return $config;
