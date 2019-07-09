<?php

/**
 * @var \terabytesoft\app\user\models\UserModel $user
 */
?>

<?= \Yii::t('mailer.user', 'Hello') ?>,

<?= \Yii::t('mailer.user', 'Your account on {0} has been created', [\Yii::$app->name]) ?> .

<?php if ($module->accountGeneratingPassword) : ?>
    <?= \Yii::t('mailer.user', 'We have generated a password for you') ?>:
    <?= $user->password ?>
<?php endif ?>

<?php if ($token !== null) : ?>
    <?= \Yii::t('mailer.user', 'In order to complete your registration, please click the link below') ?> .

    <?= $token->url ?>

    <?= \Yii::t('mailer.user', 'If you cannot click the link, please try pasting the text into your browser') ?> .
<?php endif ?>

<?= \Yii::t('mailer.user', 'If you did not make this request you can ignore this email.') ?>
