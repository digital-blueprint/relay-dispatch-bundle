<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualDeliveryPersonData;

class DeliveryAddress
{
    /**
     * @var string
     */
    protected $StreetName;

    /**
     * @var string
     */
    protected $BuildingNumber;

    /**
     * Stiege oder näheren Bezeichnung wie z.b. Werkstatt.
     *
     * @var ?string
     */
    protected $Unit;

    /**
     * @var ?string
     */
    protected $DoorNumber;

    public function __construct(string $StreetName, string $BuildingNumber, ?string $Unit = null, ?string $DoorNumber = null)
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

    public function setStreetName(string $StreetName): void
    {
        $this->StreetName = $StreetName;
    }

    public function getBuildingNumber(): string
    {
        return $this->BuildingNumber;
    }

    public function setBuildingNumber(string $BuildingNumber): void
    {
        $this->BuildingNumber = $BuildingNumber;
    }

    public function getUnit(): ?string
    {
        return $this->Unit;
    }

    public function setUnit(string $Unit): void
    {
        $this->Unit = $Unit;
    }

    public function getDoorNumber(): ?string
    {
        return $this->DoorNumber;
    }

    public function setDoorNumber(string $DoorNumber): void
    {
        $this->DoorNumber = $DoorNumber;
    }
}
