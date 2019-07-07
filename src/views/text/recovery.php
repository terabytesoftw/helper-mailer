<?php

/**
 * @var \terabytesoft\app\user\models\TokenModel $token
 */
?>

<?= \Yii::t('app.user', 'Hello') ?>,

<?= \Yii::t(
    'app.user',
    'We have received a request to reset the password for your account on {0} - ' . \Yii::$app->name
)?> .
<?= \Yii::t('app.user', 'Please click the link below to complete your password reset') ?> .

<?= $token->url ?>

<?= \Yii::t('app.user', 'If you cannot click the link, please try pasting the text into your browser') ?> .
<?= \Yii::t('app.user', 'If you did not make this request you can ignore this email.') ?>
