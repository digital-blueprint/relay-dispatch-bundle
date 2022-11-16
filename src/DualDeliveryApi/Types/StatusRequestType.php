<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types;

class StatusRequestType
{
    /**
     * @var ?ApplicationID
     */
    protected $ApplicationID = null;

    /**
     * @var string
     */
    protected $AppDeliveryID = null;

    /**
     * @var ?string
     */
    protected $DualDeliveryID = null;

    public function __construct(?ApplicationID $ApplicationID, string $AppDeliveryID, ?string $DualDeliveryID = null)
    {
        $this->ApplicationID = $ApplicationID;
        $this->AppDeliveryID = $AppDeliveryID;
        $this->DualDeliveryID = $DualDeliveryID;
    }

    public function getApplicationID(): ?ApplicationID
    {
        return $this->ApplicationID;
    }

    public function setApplicationID(ApplicationID $ApplicationID): self
    {
        $this->ApplicationID = $ApplicationID;

        return $this;
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
