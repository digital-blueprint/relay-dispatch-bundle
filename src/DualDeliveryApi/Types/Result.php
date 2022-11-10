<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types;

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

    /**
     * @param NotificationChannel $NotificationChannel
     * @param ErrorType           $Error
     */
    public function __construct($NotificationChannel, $Error)
    {
        $this->NotificationChannel = $NotificationChannel;
        $this->Error = $Error;
    }

    public function getNotificationChannel(): NotificationChannel
    {
        return $this->NotificationChannel;
    }

    public function setNotificationChannel(NotificationChannel $NotificationChannel): self
    {
        $this->NotificationChannel = $NotificationChannel;

        return $this;
    }

    public function getError(): ErrorType
    {
        return $this->Error;
    }

    public function setError(ErrorType $Error): self
    {
        $this->Error = $Error;

        return $this;
    }
}
