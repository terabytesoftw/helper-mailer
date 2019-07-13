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

        $this->mailer->sendConfirmationMessage(
            $this->userModel->email,
            [
                'tokenUrl' => $this->tokenModel->url
            ]
        );

        $this->tester->seeEmailIsSent();

        $emailMessage = $this->tester->grabLastSentEmail();

        \PHPUnit_Framework_Assert::assertArrayHasKey('mailer@mailer-user.com', $emailMessage->getTo());
        \PHPUnit_Framework_Assert::assertArrayHasKey('no-reply@mailer-user.com', $emailMessage->getFrom());
        \PHPUnit_Framework_Assert::assertEquals(
            \Yii::$app->params['mailer.user.subject.reconfirmation'],
            $emailMessage->getSubject()
        );
    }

    /**
     * testMailerSendGeneratedPassword
     */
    public function testMailerSendGeneratedPassword(): void
    {
        $this->userModel->email = 'mailer@mailer-user.com';
        $this->userModel->password = 'testGeneratedPassword';

        $this->mailer->sendGeneratedPassword(
            $this->userModel->email,
            [
                'password' => $this->userModel->password
            ]
        );

        $this->tester->seeEmailIsSent();

        $emailMessage = $this->tester->grabLastSentEmail();

        \PHPUnit_Framework_Assert::assertArrayHasKey('mailer@mailer-user.com', $emailMessage->getTo());
        \PHPUnit_Framework_Assert::assertArrayHasKey('no-reply@mailer-user.com', $emailMessage->getFrom());
        \PHPUnit_Framework_Assert::assertEquals(
            \Yii::$app->params['mailer.user.subject.password'],
            $emailMessage->getSubject()
        );
        \PHPUnit_Framework_Assert::assertStringContainsString(
            $this->userModel->password,
            $emailMessage
        );
    }

    /**
     * testMailerSendReconfirmationMessage
     */
    public function testMailerSendReconfirmationMessage(): void
    {
        $this->tokenModel->type = TokenModel::TYPE_CONFIRM_OLD_EMAIL;
        $this->userModel->email = 'mailer@mailer-user.com';

        $this->mailer->sendReconfirmationMessage(
            $this->userModel->email,
            [
                'tokenUrl' => $this->tokenModel->url
            ]
        );

        $this->tester->seeEmailIsSent();

        $emailMessage = $this->tester->grabLastSentEmail();

        \PHPUnit_Framework_Assert::assertArrayHasKey('mailer@mailer-user.com', $emailMessage->getTo());
        \PHPUnit_Framework_Assert::assertArrayHasKey('no-reply@mailer-user.com', $emailMessage->getFrom());
        \PHPUnit_Framework_Assert::assertEquals(
            \Yii::$app->params['mailer.user.subject.reconfirmation'],
            $emailMessage->getSubject()
        );
    }

    /**
     * testMailerSendReconfirmationMessageConfirmNewEmail
     */
    public function testMailerSendReconfirmationMessageConfirmNewEmail(): void
    {
        $this->tokenModel->type = TokenModel::TYPE_CONFIRM_NEW_EMAIL;
        $this->userModel->unconfirmed_email = 'mailer@mailer-user.com';

        $this->mailer->sendReconfirmationMessage(
            $this->userModel->unconfirmed_email,
            [
                'tokenUrl' => $this->tokenModel->url
            ]
        );

        $this->tester->seeEmailIsSent();

        $emailMessage = $this->tester->grabLastSentEmail();

        \PHPUnit_Framework_Assert::assertArrayHasKey('mailer@mailer-user.com', $emailMessage->getTo());
        \PHPUnit_Framework_Assert::assertArrayHasKey('no-reply@mailer-user.com', $emailMessage->getFrom());
        \PHPUnit_Framework_Assert::assertEquals(
            \Yii::$app->params['mailer.user.subject.reconfirmation'],
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

        $this->mailer->sendRecoveryMessage(
            $this->userModel->email,
            [
                'tokenUrl' => $this->tokenModel->url
            ]
        );

        $this->tester->seeEmailIsSent();

        $emailMessage = $this->tester->grabLastSentEmail();

        \PHPUnit_Framework_Assert::assertArrayHasKey('mailer@mailer-user.com', $emailMessage->getTo());
        \PHPUnit_Framework_Assert::assertArrayHasKey('no-reply@mailer-user.com', $emailMessage->getFrom());
        \PHPUnit_Framework_Assert::assertEquals(
            \Yii::$app->params['mailer.user.subject.recovery'],
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

        $this->mailer->sendWelcomeMessage(
            $this->userModel->email,
            [
                'accountGeneratingPassword' => $this->module->accountGeneratingPassword,
                'password' => $this->userModel->password,
                'showPassword' => true,
                'tokenUrl' => $this->tokenModel->url
            ]
        );

        $this->tester->seeEmailIsSent();

        $emailMessage = $this->tester->grabLastSentEmail();

        \PHPUnit_Framework_Assert::assertArrayHasKey('mailer@mailer-user.com', $emailMessage->getTo());
        \PHPUnit_Framework_Assert::assertArrayHasKey('no-reply@mailer-user.com', $emailMessage->getFrom());
        \PHPUnit_Framework_Assert::assertEquals(
            \Yii::$app->params['mailer.user.subject.welcome'],
            $emailMessage->getSubject()
        );
        \PHPUnit_Framework_Assert::assertStringContainsString(
            $this->userModel->password,
            $emailMessage
        );
    }
}
