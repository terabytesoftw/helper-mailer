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
     * sendConfirmationMessage
     *
     * sends an email to a user with confirmation link
     **/
    public function sendConfirmationMessage(string $email, array $params): bool
    {
        return $this->sendMessage(
            $email,
            \Yii::$app->params['mailer.user.subject.reconfirmation'],
            'confirmation',
            [
                'tokenUrl' => $params['tokenUrl']
            ]
        );
    }

    /**
     * sendGeneratedPassword
     *
     * sends a new generated password to a user
     **/
    public function sendGeneratedPassword(string $email, array $params): bool
    {
        return $this->sendMessage(
            $email,
            \Yii::$app->params['mailer.user.subject.password'],
            'new_password',
            [
                'password' => $params['password']
            ]
        );
    }

    /**
     * sendReconfirmationMessage.
     *
     * sends an email to a user with reconfirmation link
     **/
    public function sendReconfirmationMessage(string $email, array $params): bool
    {
        return $this->sendMessage(
            $email,
            \Yii::$app->params['mailer.user.subject.reconfirmation'],
            'reconfirmation',
            [
                'tokenUrl' => $params['tokenUrl']
            ]
        );
    }

    /**
     * sendRecoveryMessage
     *
     * sends an email to a user with recovery link
     **/
    public function sendRecoveryMessage(string $email, array $params): bool
    {
        \Yii::$app->session->set('sendRecoveryMessage', true);
        return $this->sendMessage(
            $email,
            \Yii::$app->params['mailer.user.subject.recovery'],
            'recovery',
            [
                'tokenUrl' => $params['tokenUrl']
            ]
        );
    }

    /**
     * sendWelcomeMessage
     *
     * sends an email to a user after registration
     **/
    public function sendWelcomeMessage(string $email, array $params): bool
    {
        return $this->sendMessage(
            $email,
            \Yii::$app->params['mailer.user.subject.welcome'],
            'welcome',
            [
                'accountGeneratingPassword' => $params['accountGeneratingPassword'],
                'password' => $params['password'],
                'showPassword' => $params['showPassword'],
                'tokenUrl' => $params['tokenUrl']
            ]
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
