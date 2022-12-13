<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualDeliveryNotification;

use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualDelivery\ErrorType;

class Result
{
    /**
     * @var NotificationChannel
     */
    protected $NotificationChannel = null;

    /**
     * @var ErrorType
     */
    protected $Error = null;

    public function __construct(NotificationChannel $NotificationChannel, ErrorType $Error)
    {
        $this->NotificationChannel = $NotificationChannel;
        $this->Error = $Error;
    }

    public function getNotificationChannel(): ?NotificationChannel
    {
        return $this->NotificationChannel;
    }

    public function setNotificationChannel(NotificationChannel $NotificationChannel): void
    {
        $this->NotificationChannel = $NotificationChannel;
    }

    public function getError(): ?ErrorType
    {
        return $this->Error;
    }

    public function setError(ErrorType $Error): void
    {
        $this->Error = $Error;
    }
}
