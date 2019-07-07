<?php

namespace terabytesoft\app\user\mailer;

use terabytesoft\app\user\models\TokenModel;
use terabytesoft\app\user\models\UserModel;
use terabytesoft\app\user\traits\ModuleTrait;
use yii\base\Component;

/**
 * Class Mailer.
 *
 **/
class Mailer extends Component
{
    use ModuleTrait;

    public $mailerComponent;
    public $sender;
    public $viewPath = '@terabytesoft/app/user/views/mail';

    protected $confirmationSubject;
    protected $newPasswordSubject;
    protected $reconfirmationSubject;
    protected $recoverySubject;
    protected $welcomeSubject;


    /**
     * getWelcomeSubject.
     *
     * @return string
     **/
    public function getWelcomeSubject(): string
    {
        if ($this->welcomeSubject == null) {
            $this->setWelcomeSubject(\Yii::t(
                'app.user',
                'Welcome to {0}',
                [$this->app->name]
            ));
        }

        return $this->welcomeSubject;
    }

    /**
     * setWelcomeSubject.
     *
     * @param string $welcomeSubject
     *
     * @return string
     **/
    public function setWelcomeSubject(string $welcomeSubject)
    {
        $this->welcomeSubject = $welcomeSubject;
    }

    /**
     * getNewPasswordSubject.
     *
     * @return string
     **/
    public function getNewPasswordSubject(): string
    {
        if ($this->newPasswordSubject == null) {
            $this->setNewPasswordSubject(\Yii::t(
                'app.user',
                'Your password on {0} has been changed',
                [$this->app->name]
            ));
        }

        return $this->newPasswordSubject;
    }

    /**
     * setNewPasswordSubject.
     *
     * @param string $newPasswordSubject
     *
     * @return string
     **/
    public function setNewPasswordSubject(string $newPasswordSubject)
    {
        $this->newPasswordSubject = $newPasswordSubject;
    }

    /**
     * getConfirmationSubject.
     *
     * @return string
     **/
    public function getConfirmationSubject(): string
    {
        if ($this->confirmationSubject == null) {
            $this->setConfirmationSubject(\Yii::t(
                'app.user',
                'Confirm account on {0}',
                [$this->app->name]
            ));
        }

        return $this->confirmationSubject;
    }

    /**
     * setConfirmationSubject.
     *
     * @param string $newPasswordSubject
     *
     * @return string
     **/
    public function setConfirmationSubject(string $confirmationSubject)
    {
        $this->confirmationSubject = $confirmationSubject;
    }

    /**
     * getReconfirmationSubject.
     *
     * @return string
     **/
    public function getReconfirmationSubject(): string
    {
        if ($this->reconfirmationSubject == null) {
            $this->setReconfirmationSubject(\Yii::t(
                'app.user',
                'Confirm email change on {0}',
                [$this->app->name]
            ));
        }

        return $this->reconfirmationSubject;
    }

    /**
     * setReconfirmationSubject.
     *
     * @param string $reconfirmationSubject
     *
     * @return string
     **/
    public function setReconfirmationSubject($reconfirmationSubject)
    {
        $this->reconfirmationSubject = $reconfirmationSubject;
    }

    /**
     * getRecoverySubject.
     *
     * @return string
     **/
    public function getRecoverySubject()
    {
        if ($this->recoverySubject == null) {
            $this->setRecoverySubject(\Yii::t(
                'app.user',
                'Complete password reset on {0}',
                [$this->app->name]
            ));
        }

        return $this->recoverySubject;
    }

    /**
     * setRecoverySubject.
     *
     * @param string $recoverySubject
     *
     * @return string|null
     **/
    public function setRecoverySubject(string $recoverySubject)
    {
        $this->recoverySubject = $recoverySubject;
    }

    /**
     * sendWelcomeMessage.
     *
     * sends an email to a user after registration.
     *
     * @param UserModel $user
     * @param TokenModel $token
     * @param bool $showPassword
     *
     * @return bool
     **/
    public function sendWelcomeMessage(UserModel $user, TokenModel $token = null, $showPassword = false): bool
    {
        return $this->sendMessage(
            $user->email,
            $this->getWelcomeSubject(),
            'welcome',
            ['user' => $user, 'token' => $token, 'module' => $this->module, 'showPassword' => $showPassword]
        );
    }

    /**
     * sendGeneratedPassword.
     *
     * sends a new generated password to a user
     *
     * @param UserModel $user
     * @param \app\user\helpers\PasswordHelper $password
     *
     * @return bool
     **/
    public function sendGeneratedPassword(UserModel $user, $password): bool
    {
        return $this->sendMessage(
            $user->email,
            $this->getNewPasswordSubject(),
            'New_Password',
            ['user' => $user, 'password' => $password, 'module' => $this->module]
        );
    }

    /**
     * sendConfirmationMessage.
     *
     * sends an email to a user with confirmation link
     *
     * @param UserModel $user
     * @param TokenModel $token
     *
     * @return bool
     **/
    public function sendConfirmationMessage(UserModel $user, TokenModel $token): bool
    {
        return $this->sendMessage(
            $user->email,
            $this->getConfirmationSubject(),
            'Confirmation',
            ['user' => $user, 'token' => $token, 'module' => $this->module]
        );
    }

    /**
     * sendReconfirmationMessage.
     *
     * sends an email to a user with reconfirmation link.
     *
     * @param UserModel $user
     * @param TokenModel $token
     *
     * @return bool
     **/
    public function sendReconfirmationMessage(UserModel $user, TokenModel $token): bool
    {
        if ($token->type == TokenModel::TYPE_CONFIRM_NEW_EMAIL) {
            $email = $user->unconfirmed_email;
        } else {
            $email = $user->email;
        }

        return $this->sendMessage(
            $email,
            $this->getReconfirmationSubject(),
            'Reconfirmation',
            ['user' => $user, 'token' => $token, 'module' => $this->module]
        );
    }

    /**
     * sendRecoveryMessage.
     *
     * sends an email to a user with recovery link
     *
     * @param UserModel $user
     * @param TokenModel $token
     *
     * @return bool
     **/
    public function sendRecoveryMessage(UserModel $user, TokenModel $token)
    {
        $this->app->session->set('sendRecoveryMessage', true);
        return $this->sendMessage(
            $user->email,
            $this->getRecoverySubject(),
            'Recovery',
            ['user' => $user, 'token' => $token, 'module' => $this->module]
        );
    }

    /**
     * sendMessage.
     *
     * @param string $to
     * @param string $subject
     * @param string $view
     * @param array  $params
     *
     * @return bool
     **/
    protected function sendMessage($to, $subject, $view, $params = []): bool
    {
        $mailer = $this->mailerComponent === null ? $this->app->mailer : $this->app->get($this->mailerComponent);

        $mailer->viewPath = $this->viewPath;

        if ($this->sender === null) {
            $this->sender = isset($this->app->params['adminEmail']) ?
                $this->app->params['adminEmail']
                : 'no-reply@example.com';
        }

        return $mailer->compose(['html' => $view, 'text' => 'text/' . $view], $params)
            ->setTo($to)
            ->setFrom($this->sender)
            ->setSubject($subject)
            ->send();
    }
}
