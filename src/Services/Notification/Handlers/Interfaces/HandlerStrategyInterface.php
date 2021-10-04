<?php

namespace App\Services\Notification\Handlers\Interfaces;

use App\ValueObjects\NotificationMessage;

interface HandlerStrategyInterface
{
    public function support(string $type): bool;
    public function handle(NotificationMessage $message): void;
}
