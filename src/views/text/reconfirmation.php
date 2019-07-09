<?php

/**
 * @var \terabytesoft\app\user\models\TokenModel $token
 */

?>

<?= \Yii::t('mailer.user', 'Hello') ?>,

<?= \Yii::t(
    'mailer.user',
    'We have received a request to change the email address for your account on {0}',
    [\Yii::$app->name]
) ?> .

<?= \Yii::t('mailer.user', 'In order to complete your request, please click the link below') ?> .

<?= $token->url ?>

<?= \Yii::t('mailer.user', 'If you cannot click the link, please try pasting the text into your browser') ?> .

<?= \Yii::t('mailer.user', 'If you did not make this request you can ignore this email.') ?>
