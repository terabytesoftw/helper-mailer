<?php

namespace terabytesoft\helpers\tests;

use terabytesoft\helpers\Mailer;

/**
 * Class MailerTest
 *
 * Unit tests for codeception for asset user
 */
class MailerTest extends \Codeception\Test\Unit
{
    /**
     * @var Mailer $mailer
     */
    private $mailer;

    /**
     * @var \UnitTester
     */
    public $tester;

    /**
     *  _before
     */
    public function _before(): void
    {
        $this->mailer = new Mailer(\Yii::$app->mailer);
    }

    /**
     * _after
     */
    public function _after(): void
    {
        unset($this->mailer);
        unset($this->tester);
    }

    /**
     * testSendMessage
     */
    public function testSendMessage(): void
    {
        $this->mailer->sendMessage(
            'test@helpermailer.com',
            'test mailer user codecept',
            'viewtest',
            [
                'replyTo' => 'replyto@helpermailer.com',
                'params' => 'test codecept params',
            ]
        );

        $this->tester->seeEmailIsSent();

        $emailMessage = $this->tester->grabLastSentEmail();

        \PHPUnit_Framework_Assert::assertInstanceOf(\yii\mail\MessageInterface::class, $emailMessage);
        \PHPUnit_Framework_Assert::assertArrayHasKey('test@helpermailer.com', $emailMessage->getTo());
        \PHPUnit_Framework_Assert::assertArrayHasKey('no-reply@helpermailer.com', $emailMessage->getFrom());
        \PHPUnit_Framework_Assert::assertArrayHasKey('replyto@helpermailer.com', $emailMessage->getReplyTo());
        \PHPUnit_Framework_Assert::assertEquals(
            'test mailer user codecept',
            $emailMessage->getSubject()
        );
        \PHPUnit_Framework_Assert::assertStringContainsString(
            'test codecept params',
            $emailMessage
        );
    }
}
