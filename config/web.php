<?php

/**
 * Web application configuration shared by all test types
 */

$params = require __DIR__ . '/params.php';

$params = $params ?? [];

$config = [
    'components' => [
        'i18n' => [
            'translations' => [
                'mailer.user' => [
                    'class' => \yii\i18n\PhpMessageSource::class,
                ],
            ],
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'enableSwiftMailerLogging' => $params['web.mailer.enable.swiftmailer.logging'],
        ],
    ],
    'params' => $params,
];

return $config;
