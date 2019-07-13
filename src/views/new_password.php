<?php

/**
 * @var string $password
 */

use terabytesoft\mailer\user\assets\MailerAsset;
use yii\helpers\Html;

MailerAsset::register($this);

Html::beginTag('p', ['class' => 'mailer-new_password']);
    echo \Yii::t('mailer.user', 'Hello') . ',';
Html::endTag('p');

Html::beginTag('p', ['class' => 'mailer-new_password']);
    echo \Yii::t('mailer.user', 'Your account on {0} has a new password.', [\Yii::$app->name]);
    echo \Yii::t('mailer.user', 'We have generated a password for you:');
    echo '<b>' . $password . '</b>';
Html::endTag('p');

Html::beginTag('p', ['class' => 'mailer-new_password']);
    echo \Yii::t('mailer.user', 'If you did not make this request you can ignore this email.');
Html::endTag('p');
