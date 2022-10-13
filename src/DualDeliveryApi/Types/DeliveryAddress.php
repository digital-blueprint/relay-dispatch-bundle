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

    /**
     * @return string
     */
    public function getStreetName()
    {
        return $this->StreetName;
    }

    /**
     * @param string $StreetName
     *
     * @return DeliveryAddress
     */
    public function setStreetName($StreetName)
    {
        $this->StreetName = $StreetName;

        return $this;
    }

    /**
     * @return string
     */
    public function getBuildingNumber()
    {
        return $this->BuildingNumber;
    }

    /**
     * @param string $BuildingNumber
     *
     * @return DeliveryAddress
     */
    public function setBuildingNumber($BuildingNumber)
    {
        $this->BuildingNumber = $BuildingNumber;

        return $this;
    }

    /**
     * @return string
     */
    public function getUnit()
    {
        return $this->Unit;
    }

    /**
     * @param string $Unit
     *
     * @return DeliveryAddress
     */
    public function setUnit($Unit)
    {
        $this->Unit = $Unit;

        return $this;
    }

    /**
     * @return string
     */
    public function getDoorNumber()
    {
        return $this->DoorNumber;
    }

    /**
     * @param string $DoorNumber
     *
     * @return DeliveryAddress
     */
    public function setDoorNumber($DoorNumber)
    {
        $this->DoorNumber = $DoorNumber;

        return $this;
    }
}
