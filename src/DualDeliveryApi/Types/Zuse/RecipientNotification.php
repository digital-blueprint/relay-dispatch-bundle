<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\Zuse;

class RecipientNotification
{
    /**
     * @var string
     */
    protected $NotificationMethod;

    /**
     * @var string
     */
    protected $Timestamp;

    public function __construct(string $NotificationMethod, \DateTimeInterface $Timestamp)
    {
        $this->NotificationMethod = $NotificationMethod;
        $this->Timestamp = $Timestamp->format(\DateTime::ATOM);
    }

    public function getNotificationMethod(): string
    {
        return $this->NotificationMethod;
    }

    public function setNotificationMethod(string $NotificationMethod): void
    {
        $this->NotificationMethod = $NotificationMethod;
    }

    public function getTimestamp(): \DateTimeInterface
    {
        return new \DateTimeImmutable($this->Timestamp);
    }

    public function setTimestamp(\DateTimeInterface $Timestamp): void
    {
        $this->Timestamp = $Timestamp->format(\DateTime::ATOM);
    }
}
