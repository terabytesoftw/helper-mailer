<?php

/**
 * @var \terabytesoft\app\user\models\TokenModel $token
 */

?>

<?= \Yii::t('app.user', 'Hello') ?>,

<?= \Yii::t('app.user', 'Thank you for signing up on {0}', [\Yii::$app->name]) ?> .
<?= \Yii::t('app.user', 'In order to complete your registration, please click the link below') ?> .

<?= $token->url ?>

<?= \Yii::t('app.user', 'If you cannot click the link, please try pasting the text into your browser') ?> .
<?= \Yii::t('app.user', 'If you did not make this request you can ignore this email.') ?>
