<?php

namespace terabytesoft\mailer\user\tests;

use terabytesoft\mailer\user\Mailer;
use terabytesoft\app\user\models\TokenModel;
use terabytesoft\app\user\models\UserModel;
use yii\mail\MessageInterface;

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
        $this->tokenModel = new TokenModel();
        $this->userModel = new UserModel();
    }

    /**
     * _after
     */
    public function _after(): void
    {
        unset($this->mailer);
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

        $this->mailer->sendConfirmationMessage(
            $this->userModel,
            $this->tokenModel,
        );

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
        $this->userModel->unconfirmed_email = 'mailer@mailer-user.com';
        $this->tokenModel->type = TokenModel::TYPE_CONFIRM_NEW_EMAIL;

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
        $this->userModel->email = 'mailer@mailer-user.com';
        $this->tokenModel->type = TokenModel::TYPE_CONFIRM_OLD_EMAIL;

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
        $this->userModel->email = 'mailer@mailer-user.com';
        $this->tokenModel->type = TokenModel::TYPE_RECOVERY;

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
        $this->userModel->password = 'testGeneratedPassword';
        $this->userModel->email = 'mailer@mailer-user.com';

        $this->mailer->sendWelcomeMessage(
            $this->userModel,
            isset($this->tokenModel) ? $this->tokenModel : null
        );

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
