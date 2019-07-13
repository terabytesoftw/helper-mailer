<?php

/**
 * @var string $tokenUrl
 */

echo \Yii::t('mailer.user', 'Hello') . ',';

echo \Yii::t(
    'mailer.user',
    'We have received a request to reset the password for your account on {0}.',
    [\Yii::$app->name]
) .
\Yii::t('mailer.user', 'Please click the link below to complete your password reset.');

'<b>' . $tokenUrl . '</b>';

echo \Yii::t('mailer.user', 'If you cannot click the link, please try pasting the text into your browser.');
echo \Yii::t('mailer.user', 'If you did not make this request you can ignore this email.');
