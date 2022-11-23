<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualDeliveryBulk;

use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualDeliveryNotification\DualNotificationRequest;

class BulkElements
{
    /**
     * @var DualNotificationRequest
     */
    protected $DualNotificationRequest = null;

    /**
     * @param DualNotificationRequest $DualNotificationRequest
     */
    public function __construct($DualNotificationRequest)
    {
        $this->DualNotificationRequest = $DualNotificationRequest;
    }

    public function getDualNotificationRequest(): DualNotificationRequest
    {
        return $this->DualNotificationRequest;
    }

    public function setDualNotificationRequest(DualNotificationRequest $DualNotificationRequest): self
    {
        $this->DualNotificationRequest = $DualNotificationRequest;

        return $this;
    }
}
