<?php

namespace terabytesoft\helpers;

use yii\base\Component;

/**
 * Class Mailer
 *
 **/
class Mailer extends Component
{
    /**
     * @var \yii\mail\MessageInterface $emailConfig
     */
    private $emailConfig;

    /**
     * @var object $mailer
     */
    private $mailer;

    /**
     * __construct
     */
    public function __construct(object $mailer)
    {
        $this->mailer = $mailer;
        if (isset(\Yii::$app->params['helper.mailer.viewpath'])) {
            $this->mailer->viewPath = \Yii::$app->params['helper.mailer.viewpath'];
        }
    }

    /**
     * sendMessage
     */
    public function sendMessage(
        string $to,
        string $subject,
        array $options = [],
        array $params = []
    ): bool {
        $views = isset($options['views']) ? $options['views'] : [];

        $this->emailConfig = $this->mailer
            ->compose($views, $params)
            ->setTo($to)
            ->setFrom(
                [\Yii::$app->params['helper.mailer.sender'] => \Yii::$app->params['helper.mailer.sender.name']]
            )
            ->setSubject($subject);

        if (isset($options['replyTo'])) {
            $this->emailConfig = $this->emailConfig
                ->setReplyTo($options['replyTo']);
        }

        if (isset($options['textBody'])) {
            $this->emailConfig = $this->emailConfig
                ->setTextBody($options['textBody']);
        }

        if (isset($options['textHtml'])) {
            $this->emailConfig = $this->emailConfig
                ->setHtmlBody($options['textHtml']);
        }

        return $this->mailer->send($this->emailConfig);
    }
}
