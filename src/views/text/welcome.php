<?php

/**
 * @var bool $accountGeneratingPassword
 * @var string $password
 * @var bool $showPassword
 * @var string $tokenUrl
 */

echo \Yii::t('mailer.user', 'Hello') . ',';

echo \Yii::t('mailer.user', 'Your account on {0} has been created.', [\Yii::$app->name]);

if ($showPassword || $accountGeneratingPassword) {
    echo \Yii::t('mailer.user', 'We have generated a password for you:');
    echo '<b>' . $password . '</b>';
}

if ($tokenUrl !== null) {
    echo \Yii::t('mailer.user', 'In order to complete your registration, please click the link below.');
    echo '<b>' . $tokenUrl . '</b>';
    echo \Yii::t('mailer.user', 'If you cannot click the link, please try pasting the text into your browser.');
}

echo \Yii::t('mailer.user', 'If you did not make this request you can ignore this email.');
