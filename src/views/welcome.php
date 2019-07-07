<?php

use yii\helpers\Html;

/**
 * @var \terabytesoft\app\user\AppUser $module
 * @var \terabytesoft\app\user\models\TokenModel $token
 * @var bool $showPassword
 */

use terabytesoft\mailer\user\assets\MailerAsset;

MailerAsset::register($this);
?>

<?= Html::beginTag('p', ['class' => 'mailer-welcome'])?>
    <?= \Yii::t('app.user', 'Hello') ?>,
<?= Html::endTag('p') ?>

<?= Html::beginTag('p', ['class' => 'mailer-welcome'])?>
    <?= \Yii::t('app.user', 'Your account on {0} has been created', [\Yii::$app->name]) ?> .
    <?php if ($showPassword || $module->accountGeneratingPassword) : ?>
        <?= \Yii::t('app.user', 'We have generated a password for you') ?>: <strong><?= $user->password ?></strong>
    <?php endif ?>

<?= Html::endTag('p') ?>

<?php if ($token !== null) : ?>
    <?= Html::beginTag('p', ['class' => 'mailer-welcome'])?>
        <?= \Yii::t('app.user', 'In order to complete your registration, please click the link below') ?> .
    <?= Html::endTag('p') ?>
    <?= Html::beginTag('p', ['class' => 'mailer-welcome'])?>
        <?= Html::a(Html::encode($token->url), $token->url); ?>
    <?= Html::endTag('p') ?>
    <?= Html::beginTag('p', ['class' => 'mailer-welcome'])?>
        <?= \Yii::t('app.user', 'If you cannot click the link, please try pasting the text into your browser') ?> .
    <?= Html::endTag('p') ?>
<?php endif ?>

<?= Html::beginTag('p', ['class' => 'mailer-welcome'])?>
    <?= \Yii::t('app.user', 'If you did not make this request you can ignore this email.') ?>
<?= Html::endTag('p') ?>
