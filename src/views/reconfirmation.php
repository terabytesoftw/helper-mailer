<?php

use yii\helpers\Html;

/**
 * @var \terabytesoft\app\user\AppUser $module
 * @var \terabytesoft\app\user\models\TokenModel $token
 */

use terabytesoft\mailer\user\assets\MailerAsset;

MailerAsset::register($this);
?>

<?= Html::beginTag('p', ['class' => 'mailer-reconfirmation'])?>
    <?= \Yii::t('app.user', 'Hello') ?>,
<?= Html::endTag('p') ?>

<?= Html::beginTag('p', ['class' => 'mailer-reconfirmation'])?>
    <?= \Yii::t(
        'app.user',
        'We have received a request to change the email address for your account on {0}',
        [$module->getApp()->name]
    ) ?>.
    <?= \Yii::t('app.user', 'In order to complete your request, please click the link below') ?> .
<?= Html::endTag('p') ?>

<?= Html::beginTag('p', ['class' => 'mailer-reconfirmation'])?>
    <?= Html::a(Html::encode($token->getUrl()), $token->getUrl()); ?>
<?= Html::endTag('p') ?>

<?= Html::beginTag('p', ['class' => 'mailer-reconfirmation'])?>
    <?= \Yii::t('app.user', 'If you cannot click the link, please try pasting the text into your browser') ?> .
<?= Html::endTag('p') ?>

<?= Html::beginTag('p', ['class' => 'mailer-reconfirmation'])?>
    <?= \Yii::t('app.user', 'If you did not make this request you can ignore this email.') ?>
<?= Html::endTag('p') ?>
