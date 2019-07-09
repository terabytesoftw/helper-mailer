<?php

namespace terabytesoft\mailer\user\tests\_data;

/**
 * Class Module mock
 *
 * This is the main module class for the app-user
 **/
class AppUser extends \yii\base\Module
{
    /**
     * Whether to remove password field from registration form
     *
     * @var bool
     **/
    public $accountGeneratingPassword;

    /**
     * Mailer configuration
     *
     * @var array
     **/
    public $mailer = [];
}
