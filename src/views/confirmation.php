<?php

/**
 * @var string $tokenUrl
 */

use terabytesoft\mailer\user\assets\MailerAsset;
use yii\helpers\Html;

MailerAsset::register($this);

Html::beginTag('p', ['class' => 'mailer-confirmation']);
    echo \Yii::t('mailer.user', 'Hello') . ',';
Html::endTag('p');

Html::beginTag('p', ['class' => 'mailer-confirmation']);
    echo \Yii::t('mailer.user', 'Thank you for signing up on {0}.', [\Yii::$app->name]) .
    \Yii::t('mailer.user', 'In order to complete your registration, please click the link below.');
Html::endTag('p');

Html::beginTag('p', ['class' => 'mailer-confirmation']);
    echo Html::a(Html::encode($tokenUrl), $tokenUrl);
Html::endTag('p');

Html::beginTag('p', ['class' => 'mailer-confirmation']);
    echo \Yii::t('mailer.user', 'If you cannot click the link, please try pasting the text into your browser.');
Html::endTag('p');

Html::beginTag('p', ['class' => 'mailer-confirmation']);
    echo \Yii::t('mailer.user', 'If you did not make this request you can ignore this email.');
Html::endTag('p');
