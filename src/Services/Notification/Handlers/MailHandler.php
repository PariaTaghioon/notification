<?php

namespace App\Services\Notification\Handlers;

use App\Exceptions\NotificationException;
use App\Services\Notification\Handlers\Interfaces\HandlerStrategyInterface;
use App\ValueObjects\NotificationMessage;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class MailHandler implements HandlerStrategyInterface
{
    private MailerInterface $mailer;
    private const TYPE = 'mail';
    private string $from;

    /**
     * @param string $from
     * @param MailerInterface $mailer
     */
    public function __construct(string $from, MailerInterface $mailer)
    {
        $this->mailer = $mailer;
        $this->from = $from;
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
     * @throws TransportExceptionInterface
     */
    public function handle(NotificationMessage $message): void
    {
        try {
            $email = (new Email())
                ->from('from@test.com')
                ->to($message->getTo())
                ->subject($message->getTitle())
                ->text($message->getMessage());

            $this->mailer->send($email);
        } catch (\Exception $exception) {
            throw new NotificationException();
        }

    }
}