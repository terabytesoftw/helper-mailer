<?php

use yii\helpers\Html;

/**
 * @var \terabytesoft\app\user\models\Password $password
 * @var \terabytesoft\app\user\models\UserModel $user
 */

use terabytesoft\mailer\user\assets\MailerAsset;

MailerAsset::register($this);
?>

<?= Html::beginTag('p', ['class' => 'mailer-new_password'])?>
    <?= \Yii::t('app.user', 'Hello') ?>,
<?= Html::endTag('p') ?>

<?= Html::beginTag('p', ['class' => 'mailer-new_password'])?>
    <?= \Yii::t('app.user', 'Your account on {0} has a new password', [\Yii::$app->name]) ?> .
    <?= \Yii::t('app.user', 'We have generated a password for you') ?>: <strong><?= $user->password ?></strong>
<?= Html::endTag('p') ?>

<?= Html::beginTag('p', ['class' => 'mailer-new_password'])?>
    <?= \Yii::t('app.user', 'If you did not make this request you can ignore this email.') ?>
<?= Html::endTag('p') ?>
