<?php

/**
 * Web application configuration shared by all test types
 */

$params = require __DIR__ . '/maileruser.php';

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
            'enableSwiftMailerLogging' => $params['mailer.user.email.swiftmailer.logging'],
            'useFileTransport' => $params['mailer.user.email.usefiletransport'],
        ],
    ],
    'params' => $params,
];

return $config;
