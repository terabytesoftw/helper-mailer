<?php

namespace terabytesoft\mailer\user\tests;

use terabytesoft\mailer\user\Mailer;
use terabytesoft\mailer\user\tests\_data\AppUser;
use terabytesoft\mailer\user\tests\_data\models\TokenModel;
use terabytesoft\mailer\user\tests\_data\models\UserModel;
use yii\mail\MessageInterface;

/**
 * Class MailerTest
 *
 * Unit tests for codeception for asset user
 */
class MailerTest extends \Codeception\Test\Unit
{
    const TYPE_CONFIRMATION      = 0;
    const TYPE_RECOVERY          = 1;
    const TYPE_CONFIRM_NEW_EMAIL = 2;
    const TYPE_CONFIRM_OLD_EMAIL = 3;

    /**
     * @var Mailer $mailer
     */
    private $mailer;

    /**
     * @var object $module
     */
    private $module;

    /**
     * @var \UnitTester
     */
    public $tester;

    /**
     * @var TokenModel $tokenModel
     */
    private $tokenModel;

    /**
     * @var UserModel $userModel
     */
    private $userModel;

    /**
     *  _before
     */
    public function _before(): void
    {
        $this->mailer = new Mailer();
        $this->module = \Yii::$app->getModule('user');
        $this->tokenModel = $this->getMockBuilder(TokenModel::class)
            ->setMethods(['attributes'])
            ->getMock();
        $this->tokenModel->method('attributes')->willReturn([
            'user_id',
            'code',
            'type',
        ]);
        $this->userModel = $this->getMockBuilder(UserModel::class)
            ->setMethods(['attributes'])
            ->getMock();
        $this->userModel->method('attributes')->willReturn([
            'user_id',
            'email',
            'unconfirmed_email',
        ]);
    }

    /**
     * _after
     */
    public function _after(): void
    {
        unset($this->mailer);
        unset($this->module);
        unset($this->tokenModel);
        unset($this->userModel);
    }

    /**
     * testMailerSendConfirmationMessage
     */
    public function testMailerSendConfirmationMessage(): void
    {
        $this->tokenModel->type = TokenModel::TYPE_CONFIRMATION;
        $this->userModel->email = 'mailer@mailer-user.com';

        $this->mailer->sendConfirmationMessage($this->userModel, $this->tokenModel);

        $this->tester->seeEmailIsSent();

        $emailMessage = $this->tester->grabLastSentEmail();

        \PHPUnit_Framework_Assert::assertArrayHasKey('mailer@mailer-user.com', $emailMessage->getTo());
        \PHPUnit_Framework_Assert::assertArrayHasKey('no-reply@mailer-user.com', $emailMessage->getFrom());
        \PHPUnit_Framework_Assert::assertEquals('Confirm account on testme-mailer-user', $emailMessage->getSubject());
    }

    /**
     * testMailerSendGeneratedPassword
     */
    public function testMailerSendGeneratedPassword(): void
    {
        $this->userModel->email = 'mailer@mailer-user.com';
        $this->userModel->password = 'testGeneratedPassword';

        $this->mailer->sendGeneratedPassword($this->userModel, $this->userModel->password);

        $this->tester->seeEmailIsSent();

        $emailMessage = $this->tester->grabLastSentEmail();

        \PHPUnit_Framework_Assert::assertArrayHasKey('mailer@mailer-user.com', $emailMessage->getTo());
        \PHPUnit_Framework_Assert::assertArrayHasKey('no-reply@mailer-user.com', $emailMessage->getFrom());
        \PHPUnit_Framework_Assert::assertEquals(
            'Your password on testme-mailer-user has been changed',
            $emailMessage->getSubject()
        );
        \PHPUnit_Framework_Assert::assertStringContainsString(
            $this->userModel->password,
            $emailMessage
        );
    }

    /**
     * testMailerSendReconfirmationMessageNewMailTokenTypeConfirmNewMail
     */
    public function testMailerSendReconfirmationMessageNewMailTokenTypeConfirmNewMail(): void
    {
        $this->tokenModel->type = TokenModel::TYPE_CONFIRM_NEW_EMAIL;
        $this->userModel->unconfirmed_email = 'mailer@mailer-user.com';

        $this->mailer->sendReconfirmationMessage($this->userModel, $this->tokenModel);

        $this->tester->seeEmailIsSent();

        $emailMessage = $this->tester->grabLastSentEmail();

        \PHPUnit_Framework_Assert::assertArrayHasKey('mailer@mailer-user.com', $emailMessage->getTo());
        \PHPUnit_Framework_Assert::assertArrayHasKey('no-reply@mailer-user.com', $emailMessage->getFrom());
        \PHPUnit_Framework_Assert::assertEquals(
            'Confirm email change on testme-mailer-user',
            $emailMessage->getSubject()
        );
    }

    /**
     * testMailerSendReconfirmationMessageNewMailTokenTypeConfirmOldMail
     */
    public function testMailerSendReconfirmationMessageNewMailTokenTypeConfirmOldMail(): void
    {
        $this->tokenModel->type = TokenModel::TYPE_CONFIRM_OLD_EMAIL;
        $this->userModel->email = 'mailer@mailer-user.com';

        $this->mailer->sendReconfirmationMessage($this->userModel, $this->tokenModel);

        $this->tester->seeEmailIsSent();

        $emailMessage = $this->tester->grabLastSentEmail();

        \PHPUnit_Framework_Assert::assertArrayHasKey('mailer@mailer-user.com', $emailMessage->getTo());
        \PHPUnit_Framework_Assert::assertArrayHasKey('no-reply@mailer-user.com', $emailMessage->getFrom());
        \PHPUnit_Framework_Assert::assertEquals(
            'Confirm email change on testme-mailer-user',
            $emailMessage->getSubject()
        );
    }

    /**
     * testMailerSendRecoveryMessage
     */
    public function testMailerSendRecoveryMessage(): void
    {
        $this->tokenModel->type = TokenModel::TYPE_RECOVERY;
        $this->userModel->email = 'mailer@mailer-user.com';

        $this->mailer->sendRecoveryMessage($this->userModel, $this->tokenModel);

        $this->tester->seeEmailIsSent();

        $emailMessage = $this->tester->grabLastSentEmail();

        \PHPUnit_Framework_Assert::assertArrayHasKey('mailer@mailer-user.com', $emailMessage->getTo());
        \PHPUnit_Framework_Assert::assertArrayHasKey('no-reply@mailer-user.com', $emailMessage->getFrom());
        \PHPUnit_Framework_Assert::assertEquals(
            'Complete password reset on testme-mailer-user',
            $emailMessage->getSubject()
        );
    }

    /**
     * testMailerSendWelcomeMessage
     */
    public function testMailerSendWelcomeMessage(): void
    {
        $this->tokenModel->type = TokenModel::TYPE_CONFIRMATION;
        $this->userModel->email = 'mailer@mailer-user.com';
        $this->userModel->password = 'testGeneratedPassword';

        $this->mailer->sendWelcomeMessage($this->userModel, $this->tokenModel, $this->module);

        $this->tester->seeEmailIsSent();

        $emailMessage = $this->tester->grabLastSentEmail();

        \PHPUnit_Framework_Assert::assertArrayHasKey('mailer@mailer-user.com', $emailMessage->getTo());
        \PHPUnit_Framework_Assert::assertArrayHasKey('no-reply@mailer-user.com', $emailMessage->getFrom());
        \PHPUnit_Framework_Assert::assertEquals(
            'Welcome to testme-mailer-user',
            $emailMessage->getSubject()
        );
        \PHPUnit_Framework_Assert::assertStringContainsString(
            $this->userModel->password,
            $emailMessage
        );
    }
}
