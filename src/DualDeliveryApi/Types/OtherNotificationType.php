<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types;

class OtherNotificationType extends NotificationChannelSetType
{
    /**
     * @var ExtensionPointType
     */
    protected $NotificationInformation = null;

    /**
     * @param ExtensionPointType $NotificationInformation
     */
    public function __construct($NotificationInformation)
    {
        $this->NotificationInformation = $NotificationInformation;
    }

    public function getNotificationInformation(): ExtensionPointType
    {
        return $this->NotificationInformation;
    }

    public function setNotificationInformation(ExtensionPointType $NotificationInformation): self
    {
        $this->NotificationInformation = $NotificationInformation;

        return $this;
    }
}
