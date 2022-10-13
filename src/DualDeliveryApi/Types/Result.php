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

    /**
     * @return NotificationChannel
     */
    public function getNotificationChannel()
    {
        return $this->NotificationChannel;
    }

    /**
     * @param NotificationChannel $NotificationChannel
     *
     * @return Result
     */
    public function setNotificationChannel($NotificationChannel)
    {
        $this->NotificationChannel = $NotificationChannel;

        return $this;
    }

    /**
     * @return ErrorType
     */
    public function getError()
    {
        return $this->Error;
    }

    /**
     * @param ErrorType $Error
     *
     * @return Result
     */
    public function setError($Error)
    {
        $this->Error = $Error;

        return $this;
    }
}
