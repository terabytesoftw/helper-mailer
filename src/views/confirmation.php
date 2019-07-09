<?php

use yii\helpers\Html;

/**
 * @var \terabytesoft\app\user\models\UserModel $user
 * @var \terabytesoft\app\user\models\TokenModel $token
 */

use terabytesoft\mailer\user\assets\MailerAsset;

MailerAsset::register($this);
?>

<?= Html::beginTag('p', ['class' => 'mailer-confirmation']) ?>
    <?= \Yii::t('mailer.user', 'Hello') ?>,
<?= Html::endTag('p') ?>

<?= Html::beginTag('p', ['class' => 'mailer-confirmation']) ?>
    <?= \Yii::t('mailer.user', 'Thank you for signing up on {0}', [\Yii::$app->name]) . '.' ?>
    <?= \Yii::t('mailer.user', 'In order to complete your registration, please click the link below') . '.' ?>
<?= Html::endTag('p') ?>

<?= Html::beginTag('p', ['class' => 'mailer-confirmation']) ?>
    <?= Html::a(Html::encode($token->url), $token->url) ?>
<?= Html::endTag('p') ?>

<?= Html::beginTag('p', ['class' => 'mailer-confirmation']) ?>
    <?= \Yii::t('mailer.user', 'If you cannot click the link, please try pasting the text into your browser') . '.' ?>
<?= Html::endTag('p') ?>

<?= Html::beginTag('p', ['class' => 'mailer-confirmation']) ?>
    <?= \Yii::t('mailer.user', 'If you did not make this request you can ignore this email') . '.' ?>
<?= Html::endTag('p');
