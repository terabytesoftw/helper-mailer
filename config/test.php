<?php

/**
 * Web application configuration shared by all test types
 */

$params = require __DIR__ . '/maileruser.php';

$config = [
    'id' => 'test.helper.mailer',
    'name'=> 'Helper Mailer',
    'aliases' => [
        '@bower'   => '@root/node_modules',
        '@npm'   => '@root/node_modules',
        '@public' => '@root/tests/public',
        '@runtime' => '@root/tests/public/@runtime',
    ],
    'basePath' => '@root/src',
    'bootstrap' => ['log'],
    'components' => [
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
    ],
    'params' => $params,
];

return $config;
