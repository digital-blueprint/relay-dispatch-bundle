<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types;

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

    /**
     * @return DualNotificationRequest
     */
    public function getDualNotificationRequest()
    {
        return $this->DualNotificationRequest;
    }

    /**
     * @param DualNotificationRequest $DualNotificationRequest
     *
     * @return BulkElements
     */
    public function setDualNotificationRequest($DualNotificationRequest)
    {
        $this->DualNotificationRequest = $DualNotificationRequest;

        return $this;
    }
}
