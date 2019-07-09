<?php

namespace terabytesoft\mailer\user;

use yii\base\Component;
use yii\db\ActiveRecord;

/**
 * Class Mailer
 *
 **/
class Mailer extends Component
{
    public $mailerComponent;
    public $sender;
    public $viewPath = '@terabytesoft/mailer/user/views';

    protected $confirmationSubject;
    protected $newPasswordSubject;
    protected $reconfirmationSubject;
    protected $recoverySubject;
    protected $welcomeSubject;


    /**
     * getWelcomeSubject
     **/
    public function getWelcomeSubject(): string
    {
        if ($this->welcomeSubject == null) {
            $this->setWelcomeSubject(\Yii::t(
                'mailer.user',
                'Welcome to {0}',
                [\Yii::$app->name]
            ));
        }

        return $this->welcomeSubject;
    }

    /**
     * setWelcomeSubject
     **/
    public function setWelcomeSubject(string $welcomeSubject): string
    {
        return $this->welcomeSubject = $welcomeSubject;
    }

    /**
     * getNewPasswordSubject
     **/
    public function getNewPasswordSubject(): string
    {
        if ($this->newPasswordSubject == null) {
            $this->setNewPasswordSubject(\Yii::t(
                'mailer.user',
                'Your password on {0} has been changed',
                [\Yii::$app->name]
            ));
        }

        return $this->newPasswordSubject;
    }

    /**
     * setNewPasswordSubject
     **/
    public function setNewPasswordSubject(string $newPasswordSubject): string
    {
        return $this->newPasswordSubject = $newPasswordSubject;
    }

    /**
     * getConfirmationSubject
     **/
    public function getConfirmationSubject(): string
    {
        if ($this->confirmationSubject == null) {
            $this->setConfirmationSubject(\Yii::t(
                'mailer.user',
                'Confirm account on {0}',
                [\Yii::$app->name]
            ));
        }

        return $this->confirmationSubject;
    }

    /**
     * setConfirmationSubject
     **/
    public function setConfirmationSubject(string $confirmationSubject): string
    {
        return $this->confirmationSubject = $confirmationSubject;
    }

    /**
     * getReconfirmationSubject
     **/
    public function getReconfirmationSubject(): string
    {
        if ($this->reconfirmationSubject == null) {
            $this->setReconfirmationSubject(\Yii::t(
                'mailer.user',
                'Confirm email change on {0}',
                [\Yii::$app->name]
            ));
        }

        return $this->reconfirmationSubject;
    }

    /**
     * setReconfirmationSubject
     **/
    public function setReconfirmationSubject($reconfirmationSubject): string
    {
        return $this->reconfirmationSubject = $reconfirmationSubject;
    }

    /**
     * getRecoverySubject
     **/
    public function getRecoverySubject(): string
    {
        if ($this->recoverySubject == null) {
            $this->setRecoverySubject(\Yii::t(
                'mailer.user',
                'Complete password reset on {0}',
                [\Yii::$app->name]
            ));
        }

        return $this->recoverySubject;
    }

    /**
     * setRecoverySubject
     **/
    public function setRecoverySubject(string $recoverySubject): string
    {
        return $this->recoverySubject = $recoverySubject;
    }

    /**
     * sendWelcomeMessage
     *
     * sends an email to a user after registration
     **/
    public function sendWelcomeMessage(
        ActiveRecord $user,
        ActiveRecord $token = null,
        object $module,
        $showPassword = false
    ): bool {
        return $this->sendMessage(
            $user->email,
            $this->getWelcomeSubject(),
            'welcome',
            ['user' => $user, 'token' => $token, 'showPassword' => $showPassword, 'module' => $module]
        );
    }

    /**
     * sendGeneratedPassword
     *
     * sends a new generated password to a user
     **/
    public function sendGeneratedPassword(ActiveRecord $user, string $password): bool
    {
        return $this->sendMessage(
            $user->email,
            $this->getNewPasswordSubject(),
            'new_password',
            ['user' => $user, 'password' => $password]
        );
    }

    /**
     * sendConfirmationMessage
     *
     * sends an email to a user with confirmation link
     **/
    public function sendConfirmationMessage(ActiveRecord $user, ActiveRecord $token): bool
    {
        return $this->sendMessage(
            $user->email,
            $this->getConfirmationSubject(),
            'confirmation',
            ['user' => $user, 'token' => $token]
        );
    }

    /**
     * sendReconfirmationMessage.
     *
     * sends an email to a user with reconfirmation link
     **/
    public function sendReconfirmationMessage(ActiveRecord $user, ActiveRecord $token): bool
    {
        if ($token->type == $token::TYPE_CONFIRM_NEW_EMAIL) {
            $email = $user->unconfirmed_email;
        } else {
            $email = $user->email;
        }

        return $this->sendMessage(
            $email,
            $this->getReconfirmationSubject(),
            'reconfirmation',
            ['user' => $user, 'token' => $token]
        );
    }

    /**
     * sendRecoveryMessage
     *
     * sends an email to a user with recovery link
     **/
    public function sendRecoveryMessage(ActiveRecord $user, ActiveRecord $token): bool
    {
        \Yii::$app->session->set('sendRecoveryMessage', true);
        return $this->sendMessage(
            $user->email,
            $this->getRecoverySubject(),
            'recovery',
            ['user' => $user, 'token' => $token]
        );
    }

    /**
     * sendMessage
     **/
    protected function sendMessage(string $to, string $subject, string $view, array $params = []): bool
    {
        $mailer = $this->mailerComponent === null ? \Yii::$app->mailer : \Yii::$app->get($this->mailerComponent);

        $mailer->viewPath = $this->viewPath;

        return $mailer->compose(['html' => $view, 'text' => 'text/' . $view], $params)
            ->setTo($to)
            ->setFrom(
                [\Yii::$app->params['mailer.user.email.sender'] => \Yii::$app->params['mailer.user.email.sender.name']]
            )
            ->setSubject($subject)
            ->send();
    }
}
