<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualDeliveryNotification;

use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualDelivery\ApplicationID;

class StatusRequestType
{
    /**
     * @var ?ApplicationID
     */
    protected $ApplicationID;

    /**
     * @var ?string
     */
    protected $AppDeliveryID;

    /**
     * @var ?string
     */
    protected $DualDeliveryID;

    public function __construct(?ApplicationID $ApplicationID = null, ?string $AppDeliveryID = null, ?string $DualDeliveryID = null)
    {
        $this->ApplicationID = $ApplicationID;
        $this->AppDeliveryID = $AppDeliveryID;
        $this->DualDeliveryID = $DualDeliveryID;
    }

    public function getApplicationID(): ?ApplicationID
    {
        return $this->ApplicationID;
    }

    public function setApplicationID(ApplicationID $ApplicationID): void
    {
        $this->ApplicationID = $ApplicationID;
    }

    public function getAppDeliveryID(): ?string
    {
        return $this->AppDeliveryID;
    }

    public function setAppDeliveryID(string $AppDeliveryID): void
    {
        $this->AppDeliveryID = $AppDeliveryID;
    }

    public function getDualDeliveryID(): ?string
    {
        return $this->DualDeliveryID;
    }

    public function setDualDeliveryID(string $DualDeliveryID): void
    {
        $this->DualDeliveryID = $DualDeliveryID;
    }
}
