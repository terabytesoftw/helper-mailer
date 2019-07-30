<?php

namespace terabytesoft\helpers;

use yii\base\Component;
use yii\mail\MailerInterface;

/**
 * Class Mailer
 *
 **/
class Mailer extends Component
{
    /**
     * @var \yii\mail\MessageInterface $emailConfig
     */
    protected $emailConfig;

    /**
     * @var object $mailer
     */
    protected $mailer;

    /**
     * @var array $view
     */
    protected $views;

    /**
     * __construct
     */
    public function __construct()
    {
        $this->setMailer();
        $this->setViewPath();
    }

    /**
     * sendMessage
     */
    public function sendMessage(string $to, string $subject, array $options = [], array $params = []): bool
    {
        $this->setView($options);

        $this->emailConfig = $this->mailer
            ->compose($this->views, $params)
            ->setTo($to)
            ->setFrom(
                [\Yii::$app->params['helper.mailer.sender'] => \Yii::$app->params['helper.mailer.sender.name']]
            )
            ->setSubject($subject);

        $this->setHtmlBody($options);
        $this->setReplyTo($options);
        $this->setTextBody($options);

        return $this->mailer->send($this->emailConfig);
    }

    /**
     * setHtmlBody
     */
    public function setHtmlBody(array $options): void
    {
        if (isset($options['htmlBody'])) {
            $this->emailConfig = $this->emailConfig
                ->setHtmlBody($options['htmlBody']);
        }
    }

    /**
     * setMailer
     */
    public function setMailer(): MailerInterface
    {
        return $this->mailer = \Yii::$app->mailer;
    }

    /**
     * setReplyTo
     */
    public function setReplyTo(array $options): void
    {
        if (isset($options['replyTo'])) {
            $this->emailConfig = $this->emailConfig
                ->setReplyTo($options['replyTo']);
        }
    }

    /**
     * setTextBody
     */
    public function setTextBody(array $options): void
    {
        if (isset($options['textBody'])) {
            $this->emailConfig = $this->emailConfig
                ->setTextBody($options['textBody']);
        }
    }

    /**
     * setView
     */
    public function setView(array $options): void
    {
        $this->views = isset($options['views']) ? $options['views'] : [];
    }

    /**
     * setViewPath
     */
    public function setViewPath(): void
    {
        if (isset(\Yii::$app->params['helper.mailer.viewpath'])) {
            $this->mailer->viewPath = \Yii::$app->params['helper.mailer.viewpath'];
        }
    }
}
