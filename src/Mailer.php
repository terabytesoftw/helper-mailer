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
        $this->mailer->viewPath = \Yii::$app->params['helper.mailer.viewpath'];
    }

    /**
     * sendMessage
     */
    public function sendMessage(
        string $to,
        string $subject,
        string $view,
        array $options = [],
        array $params = []
    ): bool {
        $this->emailConfig = $this->mailer
            ->compose(['html' => $view, 'text' => 'text/' . $view], $params)
            ->setTo($to)
            ->setFrom(
                [\Yii::$app->params['helper.mailer.sender'] => \Yii::$app->params['helper.mailer.sender.name']]
            )
            ->setSubject($subject);

        if (isset($options['replyTo'])) {
            $this->emailConfig = $this->emailConfig
                ->setReplyTo($options['replyTo']);
        }

        return $this->mailer->send($this->emailConfig);
    }
}
