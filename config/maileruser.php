<?php

require_once './vendor/yiisoft/yii2/Yii.php';

return [
    'helper.mailer.usefiletransport' => true,
    'helper.mailer.sender' => 'no-reply@helpermailer.com',
    'helper.mailer.sender.name' => 'helper mailer example',
    'helper.mailer.swiftmailer.logging' => false,
    'helper.mailer.viewpath' => '@root/tests/_data/views',
];
