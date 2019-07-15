<?php

/**
 * Web application configuration shared by all test types
 */

$params = require __DIR__ . '/maileruser.php';

$params = $params ?? [];

$config = [
    'components' => [
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'enableSwiftMailerLogging' => $params['helper.mailer.swiftmailer.logging'],
            'useFileTransport' => $params['helper.mailer.usefiletransport'],
        ],
    ],
    'params' => $params,
];

return $config;
