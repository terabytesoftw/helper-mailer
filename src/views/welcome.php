<?php

/**
 * @var bool $accountGeneratingPassword
 * @var string $password
 * @var bool $showPassword
 * @var string $token_url
 */

use terabytesoft\mailer\user\assets\MailerAsset;
use yii\helpers\Html;

MailerAsset::register($this);

Html::beginTag('p', ['class' => 'mailer-welcome']);
    echo \Yii::t('mailer.user', 'Hello') . ',';
Html::endTag('p');

Html::beginTag('p', ['class' => 'mailer-welcome']);
    echo \Yii::t('mailer.user', 'Your account on {0} has been created.', [\Yii::$app->name]);
    if ($showPassword || $accountGeneratingPassword) {
        echo \Yii::t('mailer.user', 'We have generated a password for you:');
        echo '<b>' . $password . '</b>';
    }
Html::endTag('p');

if ($tokenUrl !== null) {
    Html::beginTag('p', ['class' => 'mailer-welcome']);
    echo \Yii::t('mailer.user', 'In order to complete your registration, please click the link below.');
    Html::endTag('p');
    Html::beginTag('p', ['class' => 'mailer-welcome']);
    Html::a(Html::encode($tokenUrl), $tokenUrl);
    Html::endTag('p');
    Html::beginTag('p', ['class' => 'mailer-welcome']);
    echo \Yii::t(
            'mailer.user',
            'If you cannot click the link, please try pasting the text into your browser.'
        );
    Html::endTag('p');
}

Html::beginTag('p', ['class' => 'mailer-welcome']);
    echo \Yii::t('mailer.user', 'If you did not make this request you can ignore this email.');
Html::endTag('p');
