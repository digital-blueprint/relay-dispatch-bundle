<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types;

class StatusRequestType
{
    /**
     * @var ApplicationID
     */
    protected $ApplicationID = null;

    /**
     * @var string
     */
    protected $ApplicationDeliveryID = null;

    /**
     * @var string
     */
    protected $DualDeliveryID = null;

    /**
     * @param ApplicationID $ApplicationID
     * @param string        $AppDeliveryID
     * @param string        $DualDeliveryID
     */
    public function __construct($ApplicationID = null, $ApplicationDeliveryID, $DualDeliveryID = null)
    {
        $this->ApplicationID = $ApplicationID;
        $this->ApplicationDeliveryID = $ApplicationDeliveryID;
        $this->DualDeliveryID = $DualDeliveryID;
    }

    public function getApplicationID(): ApplicationID
    {
        return $this->ApplicationID;
    }

    public function setApplicationID(ApplicationID $ApplicationID): self
    {
        $this->ApplicationID = $ApplicationID;

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

    public function getDualDeliveryID(): string
    {
        return $this->DualDeliveryID;
    }

    public function setDualDeliveryID(string $DualDeliveryID): self
    {
        $this->DualDeliveryID = $DualDeliveryID;

        return $this;
    }
}
