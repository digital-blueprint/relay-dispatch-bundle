<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\EBInterface;

use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\AlphaNumIDType;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\date;

class DeliveryType
{
    /**
     * @var AlphaNumIDType
     */
    protected $DeliveryID = null;

    /**
     * @var date
     */
    protected $Date = null;

    /**
     * @var PeriodType
     */
    protected $Period = null;

    /**
     * @var AddressType
     */
    protected $Address = null;

    /**
     * @var string
     */
    protected $Description = null;

    /**
     * @var DeliveryExtensionType
     */
    protected $DeliveryExtension = null;

    /**
     * @param AlphaNumIDType        $DeliveryID
     * @param date                  $Date
     * @param PeriodType            $Period
     * @param AddressType           $Address
     * @param string                $Description
     * @param DeliveryExtensionType $DeliveryExtension
     */
    public function __construct($DeliveryID, $Date, $Period, $Address, $Description, $DeliveryExtension)
    {
        $this->DeliveryID = $DeliveryID;
        $this->Date = $Date;
        $this->Period = $Period;
        $this->Address = $Address;
        $this->Description = $Description;
        $this->DeliveryExtension = $DeliveryExtension;
    }

    /**
     * @return AlphaNumIDType
     */
    public function getDeliveryID()
    {
        return $this->DeliveryID;
    }

    /**
     * @param AlphaNumIDType $DeliveryID
     */
    public function setDeliveryID($DeliveryID): self
    {
        $this->DeliveryID = $DeliveryID;

        return $this;
    }

    /**
     * @return date
     */
    public function getDate()
    {
        return $this->Date;
    }

    /**
     * @param date $Date
     */
    public function setDate($Date): self
    {
        $this->Date = $Date;

        return $this;
    }

    public function getPeriod(): PeriodType
    {
        return $this->Period;
    }

    public function setPeriod(PeriodType $Period): self
    {
        $this->Period = $Period;

        return $this;
    }

    public function getAddress(): AddressType
    {
        return $this->Address;
    }

    public function setAddress(AddressType $Address): self
    {
        $this->Address = $Address;

        return $this;
    }

    public function getDescription(): string
    {
        return $this->Description;
    }

    public function setDescription(string $Description): self
    {
        $this->Description = $Description;

        return $this;
    }

    public function getDeliveryExtension(): DeliveryExtensionType
    {
        return $this->DeliveryExtension;
    }

    public function setDeliveryExtension(DeliveryExtensionType $DeliveryExtension): self
    {
        $this->DeliveryExtension = $DeliveryExtension;

        return $this;
    }
}
