<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\Zuse;

class ReferencesType
{
    /**
     * @var ?string
     */
    protected $AppDeliveryID;

    /**
     * @var ?string
     */
    protected $GZ;

    /**
     * @var ?string
     */
    protected $MZSDeliveryID;

    /**
     * @var ?string
     */
    protected $ZSDeliveryID;

    public function __construct(?string $AppDeliveryID, ?string $GZ, ?string $MZSDeliveryID, ?string $ZSDeliveryID)
    {
        $this->AppDeliveryID = $AppDeliveryID;
        $this->GZ = $GZ;
        $this->MZSDeliveryID = $MZSDeliveryID;
        $this->ZSDeliveryID = $ZSDeliveryID;
    }

    public function getAppDeliveryID(): ?string
    {
        return $this->AppDeliveryID;
    }

    public function setAppDeliveryID(string $AppDeliveryID): void
    {
        $this->AppDeliveryID = $AppDeliveryID;
    }

    public function getGZ(): ?string
    {
        return $this->GZ;
    }

    public function setGZ(string $GZ): void
    {
        $this->GZ = $GZ;
    }

    public function getMZSDeliveryID(): ?string
    {
        return $this->MZSDeliveryID;
    }

    public function setMZSDeliveryID(?string $MZSDeliveryID): void
    {
        $this->MZSDeliveryID = $MZSDeliveryID;
    }

    public function getZSDeliveryID(): ?string
    {
        return $this->ZSDeliveryID;
    }

    public function setZSDeliveryID(?string $ZSDeliveryID): void
    {
        $this->ZSDeliveryID = $ZSDeliveryID;
    }
}
