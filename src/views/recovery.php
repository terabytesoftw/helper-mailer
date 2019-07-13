<?php

/**
 * @var string $tokenUrl
 */

use terabytesoft\mailer\user\assets\MailerAsset;
use yii\helpers\Html;

MailerAsset::register($this);

Html::beginTag('p', ['class' => 'mailer-recovery']);
    echo \Yii::t('mailer.user', 'Hello') . ',';
Html::endTag('p');

Html::beginTag('p', ['class' => 'mailer-recovery']);
    echo \Yii::t('mailer.user', 'We have received a request to reset the password for your account on {0}.', [\Yii::$app->name]) .
    \Yii::t('mailer.user', 'Please click the link below to complete your password reset.');
Html::endTag('p');

Html::beginTag('p', ['class' => 'mailer-recovery']);
    echo Html::a(Html::encode($tokenUrl), $tokenUrl);
Html::endTag('p');

Html::beginTag('p', ['class' => 'mailer-recovery']);
    echo \Yii::t('mailer.user', 'If you cannot click the link, please try pasting the text into your browser.');
Html::endTag('p');

Html::beginTag('p', ['class' => 'mailer-recovery']);
    echo \Yii::t('mailer.user', 'If you did not make this request you can ignore this email.');
Html::endTag('p');
