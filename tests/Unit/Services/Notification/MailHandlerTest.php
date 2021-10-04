<?php

namespace App\Tests\Unit\Services\Notification;

use App\Services\Notification\Handlers\MailHandler;
use App\ValueObjects\NotificationMessage;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Mailer\MailerInterface;

class MailHandlerTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
    }

    public function testItTypeIsSupported()
    {
        $mailer = $this->createMock(MailerInterface::class);
        $mailHandler = new MailHandler('from@test.com', $mailer);

        $result = $mailHandler->support('mail');
        $this->assertTrue($result);
    }

    public function testItTypeIsNotSupported()
    {
        $mailer = $this->createMock(MailerInterface::class);
        $mailHandler = new MailHandler('from@test.com', $mailer);

        $result = $mailHandler->support('test');
        $this->assertFalse($result);
    }

    public function testSendMail(): void
    {
        $mailer = $this->createMock(MailerInterface::class);
        $mailer->expects($this->once())->method('send');
        $mailHandler = new MailHandler('from@test.com', $mailer);
        $message = $this->createMessageObj();

        $mailHandler->handle($message);
    }

    private function createMessageObj(): NotificationMessage
    {
        return (new NotificationMessage)
            ->setMessage("my message")
            ->setTitle("title")
            ->setTo("test@test.com");
    }
}