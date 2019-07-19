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
        $this->mailer = new Mailer();
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
            [
                'replyTo' => 'replyto@helpermailer.com',
                'textBody' => 'Plain text content'
            ],
            [],
            \Yii::$app->mailer
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
            'Plain text content',
            $emailMessage
        );
    }

    /**
     * testSendMessageOptionsViews
     */
    public function testSendMessageOptionsViews(): void
    {
        $this->mailer->sendMessage(
            'test@helpermailer.com',
            'test mailer user codecept',
            [
                'views' => 'viewtest',
                'textBody' => 'Plain text content',
                'textHtml' => '<b>Plain text content</b>',
            ],
            [],
            \Yii::$app->mailer
        );

        $this->tester->seeEmailIsSent();

        $emailMessage = $this->tester->grabLastSentEmail();

        \PHPUnit_Framework_Assert::assertInstanceOf(\yii\mail\MessageInterface::class, $emailMessage);
        \PHPUnit_Framework_Assert::assertArrayHasKey('test@helpermailer.com', $emailMessage->getTo());
        \PHPUnit_Framework_Assert::assertArrayHasKey('no-reply@helpermailer.com', $emailMessage->getFrom());
        \PHPUnit_Framework_Assert::assertStringContainsString(
            'Plain text content',
            $emailMessage
        );
        \PHPUnit_Framework_Assert::assertStringContainsString(
            '<b>Plain text content</b>',
            $emailMessage
        );
    }

    /**
     * testSendMessageOptionsViewsWithParams
     */
    public function testSendMessageOptionsViewsWithParams(): void
    {
        $this->mailer->sendMessage(
            'test@helpermailer.com',
            'test mailer user codecept',
            [
                'views' => 'viewtest',
            ],
            [
                'params' => 'Params text content'
            ],
            \Yii::$app->mailer
        );

        $this->tester->seeEmailIsSent();

        $emailMessage = $this->tester->grabLastSentEmail();

        \PHPUnit_Framework_Assert::assertInstanceOf(\yii\mail\MessageInterface::class, $emailMessage);
        \PHPUnit_Framework_Assert::assertArrayHasKey('test@helpermailer.com', $emailMessage->getTo());
        \PHPUnit_Framework_Assert::assertArrayHasKey('no-reply@helpermailer.com', $emailMessage->getFrom());
        \PHPUnit_Framework_Assert::assertStringContainsString(
            'Params text content',
            $emailMessage
        );
    }
}
