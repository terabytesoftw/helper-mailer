<?php

require_once './vendor/yiisoft/yii2/Yii.php';

return [
    'mailer.user.email.usefiletransport' => true,
    'mailer.user.email.sender' => 'no-reply@mailer-user.com',
    'mailer.user.email.sender.name' => 'mailer-user.com mailer',
    'mailer.user.email.swiftmailer.logging' => true,
    'mailer.user.subject.password' => \Yii::t('mailer.user', 'Your password has been changed.'),
    'mailer.user.subject.reconfirmation' => \Yii::t('mailer.user', 'Confirm email change.'),
    'mailer.user.subject.recovery' => \Yii::t('mailer.user', 'Complete password reset.'),
    'mailer.user.subject.welcome' => \Yii::t('mailer.user', 'Welcome.')
];
