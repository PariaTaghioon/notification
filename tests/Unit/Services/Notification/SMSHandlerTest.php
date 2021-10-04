<?php

namespace App\Tests\Unit\Services\Notification;

use App\Services\Notification\Handlers\SMSHandler;
use App\ValueObjects\NotificationMessage;
use Kavenegar\KavenegarApi;
use Monolog\Test\TestCase;

class SMSHandlerTest extends TestCase
{
    protected function setUp():void
    {
        parent::setUp();
    }

    public function testItTypeIsSupported()
    {
        $this->createMock(KavenegarApi::class);
        $smsHandler = new SMSHandler('test', 'test');

        $result = $smsHandler->support('SMS');
        $this->assertTrue($result);
    }

    public function testItTypeIsNotSupported()
    {
        $this->createMock(KavenegarApi::class);
        $smsHandler = new SMSHandler('test', 'test');

        $result = $smsHandler->support('test');
        $this->assertFalse($result);
    }

    public function testSendSMS(): void
    {
        $kavenegar = $this->createMock(KavenegarApi::class);
        $kavenegar->expects($this->once())->method('send');
        $logHandler = new SMSHandler('test', 'test');
        $message = $this->createMessageObj();
        $logHandler->handle($message);
    }

    private function createMessageObj(): NotificationMessage
    {
        return (new NotificationMessage)
            ->setMessage("my message")
            ->setTitle("title")
            ->setTo("09124900155");
    }
}