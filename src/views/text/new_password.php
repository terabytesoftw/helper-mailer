<?php

/**
 * @var \terabytesoft\app\user\models\UserModel $user
 */

?>

<?= \Yii::t('mailer.user', 'Hello') ?>,

<?= \Yii::t('mailer.user', 'Your account on {0} has a new password', [\Yii::$app->name]) ?> .
<?= \Yii::t('mailer.user', 'We have generated a password for you') ?>:

<?= $user->password ?>

<?= \Yii::t('mailer.user', 'If you did not make this request you can ignore this email.') ?>
