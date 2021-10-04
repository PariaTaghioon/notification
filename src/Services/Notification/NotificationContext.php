<?php

namespace App\Services\Notification;

use App\Exceptions\NotificationException;
use App\Services\Notification\Handlers\Interfaces\HandlerStrategyInterface;
use App\ValueObjects\NotificationMessage;

class NotificationContext
{
    private array $strategies;

    /**
     * @param HandlerStrategyInterface $strategy
     */
    public function setStrategy(HandlerStrategyInterface $strategy): void
    {
        $this->strategies[] = $strategy;
    }

    public function handle(string $type, NotificationMessage $message): void
    {
        foreach ($this->strategies as $strategy) {
            if ($strategy->support($type)) {
                $strategy->handle($message);

                return;
            }
        }
        throw new NotificationException();
    }
}