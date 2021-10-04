<?php

namespace App\Services\Notification\Handlers;

use App\Exceptions\NotificationException;
use App\Services\Notification\Handlers\Interfaces\HandlerStrategyInterface;
use App\ValueObjects\NotificationMessage;
use Kavenegar\KavenegarApi;

class SMSHandler implements HandlerStrategyInterface
{
    private const TYPE = 'SMS';
    private string $sender;
    private KavenegarApi $api;

    public function __construct(string $apiKey, string $sender)
    {
        $this->api = new KavenegarApi($apiKey);
        $this->sender = $sender;
    }

    /**
     * @param string $type
     * @return bool
     */
    public function support(string $type): bool
    {
        return $type === self::TYPE;
    }

    /**
     * @param NotificationMessage $message
     * @throws NotificationException
     */
    public function handle(NotificationMessage $message): void
    {
        try {
            $this->api->Send(
                $this->sender,
                $message->getTo(),
                printf("%s-%s", $message->getTitle(), $message->getMessage())
            );
        } catch (\Exception $exception) {
            throw new NotificationException();
        }

    }
}