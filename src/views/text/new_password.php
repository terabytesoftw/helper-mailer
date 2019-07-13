<?php

/**
 * @var string $password
 */

echo \Yii::t('mailer.user', 'Hello') . ',';

echo \Yii::t('mailer.user', 'Your account on {0} has a new password.', [\Yii::$app->name]);
echo \Yii::t('mailer.user', 'We have generated a password for you: ') ;

echo '<b>' . $password . '</b>';

echo \Yii::t('mailer.user', 'If you did not make this request you can ignore this email.');
