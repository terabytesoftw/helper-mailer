<?php

namespace terabytesoft\mailer\user\tests\_data\models;

use yii\db\ActiveRecord;

/**
 * UserModel mock class
 */
class UserModel extends ActiveRecord
{
    /** @var string plain password. Used for model validation * */
    public $password;
}
