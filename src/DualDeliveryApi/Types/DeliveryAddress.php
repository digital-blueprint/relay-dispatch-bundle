<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types;

class DeliveryAddress
{
    /**
     * @var string
     */
    protected $StreetName = null;

    /**
     * @var string
     */
    protected $BuildingNumber = null;

    /**
     * @var string
     */
    protected $Unit = null;

    /**
     * @var string
     */
    protected $DoorNumber = null;

    /**
     * @param string $StreetName
     * @param string $BuildingNumber
     * @param string $Unit
     * @param string $DoorNumber
     */
    public function __construct($StreetName, $BuildingNumber, $Unit, $DoorNumber)
    {
        $this->StreetName = $StreetName;
        $this->BuildingNumber = $BuildingNumber;
        $this->Unit = $Unit;
        $this->DoorNumber = $DoorNumber;
    }

    public function getStreetName(): string
    {
        return $this->StreetName;
    }

    public function setStreetName(string $StreetName): self
    {
        $this->StreetName = $StreetName;

        return $this;
    }

    public function getBuildingNumber(): string
    {
        return $this->BuildingNumber;
    }

    public function setBuildingNumber(string $BuildingNumber): self
    {
        $this->BuildingNumber = $BuildingNumber;

        return $this;
    }

    public function getUnit(): string
    {
        return $this->Unit;
    }

    public function setUnit(string $Unit): self
    {
        $this->Unit = $Unit;

        return $this;
    }

    public function getDoorNumber(): string
    {
        return $this->DoorNumber;
    }

    public function setDoorNumber(string $DoorNumber): self
    {
        $this->DoorNumber = $DoorNumber;

        return $this;
    }
}
