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

    public function getNotificationChannelSet(): NotificationChannelSetType
    {
        return $this->NotificationChannelSet;
    }

    public function setNotificationChannelSet(NotificationChannelSetType $NotificationChannelSet): self
    {
        $this->NotificationChannelSet = $NotificationChannelSet;

        return $this;
    }
}
