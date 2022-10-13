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

    /**
     * @return ExtensionPointType
     */
    public function getNotificationInformation()
    {
        return $this->NotificationInformation;
    }

    /**
     * @param ExtensionPointType $NotificationInformation
     *
     * @return OtherNotificationType
     */
    public function setNotificationInformation($NotificationInformation)
    {
        $this->NotificationInformation = $NotificationInformation;

        return $this;
    }
}
