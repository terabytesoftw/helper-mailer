<?php

/**
 * @var \terabytesoft\app\user\models\UserModel $user
 */

?>

<?= \Yii::t('app.user', 'Hello') ?>,

<?= \Yii::t('app.user', 'Your account on {0} has a new password', [\Yii::$app->name]) ?> .
<?= \Yii::t('app.user', 'We have generated a password for you') ?>:

<?= $user->password ?>

<?= \Yii::t('app.user', 'If you did not make this request you can ignore this email.') ?>
