<?php

/**
 * @var \terabytesoft\app\user\models\TokenModel $token
 */

?>

<?= \Yii::t('mailer.user', 'Hello') ?>,

<?= \Yii::t('mailer.user', 'Thank you for signing up on {0}', [\Yii::$app->name]) ?> .
<?= \Yii::t('mailer.user', 'In order to complete your registration, please click the link below') ?> .

<?= $token->url ?>

<?= \Yii::t('mailer.user', 'If you cannot click the link, please try pasting the text into your browser') ?> .
<?= \Yii::t('mailer.user', 'If you did not make this request you can ignore this email.') ?>
