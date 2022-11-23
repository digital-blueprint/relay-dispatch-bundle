<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualDeliveryNotification;

use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualDelivery\ExtensionPointType;

class OtherNotificationType extends NotificationChannelSetType
{
    /**
     * @var ExtensionPointType
     */
    protected $NotificationInformation = null;

    public function __construct(ExtensionPointType $NotificationInformation)
    {
        parent::__construct();
        $this->NotificationInformation = $NotificationInformation;
    }

    public function getNotificationInformation(): ExtensionPointType
    {
        return $this->NotificationInformation;
    }

    public function setNotificationInformation(ExtensionPointType $NotificationInformation): void
    {
        $this->NotificationInformation = $NotificationInformation;
    }
}
