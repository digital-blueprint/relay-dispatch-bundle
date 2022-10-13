<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types;

class NotificationChannel
{
    /**
     * @var NotificationChannelSetType
     */
    protected $NotificationChannelSet = null;

    /**
     * @param NotificationChannelSetType $NotificationChannelSet
     */
    public function __construct($NotificationChannelSet)
    {
        $this->NotificationChannelSet = $NotificationChannelSet;
    }

    /**
     * @return NotificationChannelSetType
     */
    public function getNotificationChannelSet()
    {
        return $this->NotificationChannelSet;
    }

    /**
     * @param NotificationChannelSetType $NotificationChannelSet
     *
     * @return NotificationChannel
     */
    public function setNotificationChannelSet($NotificationChannelSet)
    {
        $this->NotificationChannelSet = $NotificationChannelSet;

        return $this;
    }
}
