<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualDeliveryBulk;

use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualDeliveryNotification\DualNotificationResponseType;

class DualNotificationResponses
{
    /**
     * @var DualNotificationResponseType
     */
    protected $DualNotificationResponse;

    /**
     * @var string
     */
    protected $ApplicationDeliveryID;

    /**
     * @var ?int
     */
    protected $DualZSID;

    public function __construct(DualNotificationResponseType $DualNotificationResponse, string $ApplicationDeliveryID, ?int $DualZSID)
    {
        $this->DualNotificationResponse = $DualNotificationResponse;
        $this->ApplicationDeliveryID = $ApplicationDeliveryID;
        $this->DualZSID = $DualZSID;
    }

    public function getDualNotificationResponse(): DualNotificationResponseType
    {
        return $this->DualNotificationResponse;
    }

    public function setDualNotificationResponse(DualNotificationResponseType $DualNotificationResponse): void
    {
        $this->DualNotificationResponse = $DualNotificationResponse;
    }

    public function getApplicationDeliveryID(): string
    {
        return $this->ApplicationDeliveryID;
    }

    public function setApplicationDeliveryID(string $ApplicationDeliveryID): void
    {
        $this->ApplicationDeliveryID = $ApplicationDeliveryID;
    }

    public function getDualZSID(): ?int
    {
        return $this->DualZSID;
    }

    public function setDualZSID(int $DualZSID): void
    {
        $this->DualZSID = $DualZSID;
    }
}
