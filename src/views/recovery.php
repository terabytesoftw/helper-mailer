<?php

use yii\helpers\Html;

/**
 * @var \terabytesoft\app\user\models\UserModel $user
 * @var \terabytesoft\app\user\models\TokenModel $token
 */

use terabytesoft\mailer\user\assets\MailerAsset;

MailerAsset::register($this);
?>

<?= Html::beginTag('p', ['class' => 'mailer-recovery'])?>
    <?= \Yii::t('app.user', 'Hello') ?>,
<?= Html::endTag('p') ?>

<?= Html::beginTag('p', ['class' => 'mailer-recovery'])?>
    <?= \Yii::t(
        'app.user',
        'We have received a request to reset the password for your account on {0}',
        [\Yii::$app->name]
    ) ?> .
    <?= \Yii::t('app.user', 'Please click the link below to complete your password reset') ?> .
<?= Html::endTag('p') ?>

<?= Html::beginTag('p', ['class' => 'mailer-recovery'])?>
    <?= Html::a(Html::encode($token->url), $token->url); ?>
<?= Html::endTag('p') ?>

<?= Html::beginTag('p', ['class' => 'mailer-recovery'])?>
    <?= \Yii::t('app.user', 'If you cannot click the link, please try pasting the text into your browser') ?> .
<?= Html::endTag('p') ?>

<?= Html::beginTag('p', ['class' => 'mailer-recovery'])?>
    <?= \Yii::t('app.user', 'If you did not make this request you can ignore this email.') ?>
<?= Html::endTag('p') ?>
