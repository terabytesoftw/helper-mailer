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
    public function sendMessage(string $to, string $subject, string $view, array $params = []): bool
    {
        return $this->mailer->compose(['html' => $view, 'text' => 'text/' . $view], $params)
            ->setTo($to)
            ->setFrom(
                [\Yii::$app->params['helper.mailer.sender'] => \Yii::$app->params['helper.mailer.sender.name']]
            )
            ->setSubject($subject)
            ->send();
    }
}
