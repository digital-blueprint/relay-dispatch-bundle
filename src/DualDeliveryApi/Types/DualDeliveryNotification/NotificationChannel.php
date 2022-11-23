<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualDeliveryNotification;

class NotificationChannel
{
    /**
     * @var NotificationChannelSetType
     */
    protected $NotificationChannelSet = null;

    public function __construct(NotificationChannelSetType $NotificationChannelSet)
    {
        $this->NotificationChannelSet = $NotificationChannelSet;
    }

    public function getNotificationChannelSet(): NotificationChannelSetType
    {
        return $this->NotificationChannelSet;
    }

    public function setNotificationChannelSet(NotificationChannelSetType $NotificationChannelSet): void
    {
        $this->NotificationChannelSet = $NotificationChannelSet;
    }
}
