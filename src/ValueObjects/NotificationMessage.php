<?php

namespace App\ValueObjects;

class NotificationMessage
{
    private string $title;
    private string $message;
    private string $to;

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     * @return NotificationMessage
     */
    public function setTitle(string $title): NotificationMessage
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
    }

    /**
     * @param string $message
     * @return NotificationMessage
     */
    public function setMessage(string $message): NotificationMessage
    {
        $this->message = $message;
        return $this;
    }

    /**
     * @return string
     */
    public function getTo(): string
    {
        return $this->to;
    }

    /**
     * @param string $to
     * @return NotificationMessage
     */
    public function setTo(string $to): NotificationMessage
    {
        $this->to = $to;
        return $this;
    }
}