<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualDeliveryBulk;

use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualDeliveryNotification\DualNotificationRequest;

class BulkElements
{
    /**
     * @var DualNotificationRequest[]
     */
    protected $DualNotificationRequest = null;

    /**
     * @param DualNotificationRequest[] $DualNotificationRequest
     */
    public function __construct(array $DualNotificationRequest)
    {
        $this->DualNotificationRequest = $DualNotificationRequest;
    }

    /**
     * @return DualNotificationRequest[]
     */
    public function getDualNotificationRequest(): array
    {
        return $this->DualNotificationRequest;
    }

    /**
     * @param DualNotificationRequest[] $DualNotificationRequest
     */
    public function setDualNotificationRequest(array $DualNotificationRequest): void
    {
        $this->DualNotificationRequest = $DualNotificationRequest;
    }
}
