<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualDeliveryBulk;

use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualDeliveryNotification\DualNotificationResponseType;

class DualNotificationResponses
{
    /**
     * @var DualNotificationResponseType
     */
    protected $DualNotificationResponse = null;

    /**
     * @var string
     */
    protected $ApplicationDeliveryID = null;

    /**
     * @var int
     */
    protected $DualZSID = null;

    /**
     * @param DualNotificationResponseType $DualNotificationResponse
     * @param string                       $ApplicationDeliveryID
     * @param int                          $DualZSID
     */
    public function __construct($DualNotificationResponse, $ApplicationDeliveryID, $DualZSID)
    {
        $this->DualNotificationResponse = $DualNotificationResponse;
        $this->ApplicationDeliveryID = $ApplicationDeliveryID;
        $this->DualZSID = $DualZSID;
    }

    public function getDualNotificationResponse(): DualNotificationResponseType
    {
        return $this->DualNotificationResponse;
    }

    public function setDualNotificationResponse(DualNotificationResponseType $DualNotificationResponse): self
    {
        $this->DualNotificationResponse = $DualNotificationResponse;

        return $this;
    }

    public function getApplicationDeliveryID(): string
    {
        return $this->ApplicationDeliveryID;
    }

    public function setApplicationDeliveryID(string $ApplicationDeliveryID): self
    {
        $this->ApplicationDeliveryID = $ApplicationDeliveryID;

        return $this;
    }

    public function getDualZSID(): int
    {
        return $this->DualZSID;
    }

    public function setDualZSID(int $DualZSID): self
    {
        $this->DualZSID = $DualZSID;

        return $this;
    }
}
