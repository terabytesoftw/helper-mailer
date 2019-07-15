<?php

namespace terabytesoft\helpers;

use yii\base\Component;
use yii\db\ActiveRecord;

/**
 * Class Mailer
 *
 **/
class Mailer extends Component
{
    /**
     * sendMessage
     **/
    public function sendMessage(string $to, string $subject, string $view, array $params = []): bool
    {
        $mailer = \Yii::$app->mailer;

        $mailer->viewPath = \Yii::$app->params['helper.mailer.viewpath'];

        return $mailer->compose(['html' => $view, 'text' => 'text/' . $view], $params)
            ->setTo($to)
            ->setFrom(
                [\Yii::$app->params['helper.mailer.sender'] => \Yii::$app->params['helper.mailer.sender.name']]
            )
            ->setSubject($subject)
            ->send();
    }
}
