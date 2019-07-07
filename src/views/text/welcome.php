<?php

/**
 * @var \terabytesoft\app\user\models\UserModel $user
 */
?>

<?= \Yii::t('app.user', 'Hello') ?>,

<?= \Yii::t('app.user', 'Your account on {0} has been created', [\Yii::$app->name]) ?> .

<?php if ($module->accountGeneratingPassword) : ?>
    <?= \Yii::t('app.user', 'We have generated a password for you') ?>:
    <?= $user->password ?>
<?php endif ?>

<?php if ($token !== null) : ?>
    <?= \Yii::t('app.user', 'In order to complete your registration, please click the link below') ?> .

    <?= $token->url ?>

    <?= \Yii::t('app.user', 'If you cannot click the link, please try pasting the text into your browser') ?> .
<?php endif ?>

<?= \Yii::t('app.user', 'If you did not make this request you can ignore this email.') ?>
