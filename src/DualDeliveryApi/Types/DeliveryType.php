<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types;

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
     *
     * @return DeliveryType
     */
    public function setDeliveryID($DeliveryID)
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
     *
     * @return DeliveryType
     */
    public function setDate($Date)
    {
        $this->Date = $Date;

        return $this;
    }

    /**
     * @return PeriodType
     */
    public function getPeriod()
    {
        return $this->Period;
    }

    /**
     * @param PeriodType $Period
     *
     * @return DeliveryType
     */
    public function setPeriod($Period)
    {
        $this->Period = $Period;

        return $this;
    }

    /**
     * @return AddressType
     */
    public function getAddress()
    {
        return $this->Address;
    }

    /**
     * @param AddressType $Address
     *
     * @return DeliveryType
     */
    public function setAddress($Address)
    {
        $this->Address = $Address;

        return $this;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->Description;
    }

    /**
     * @param string $Description
     *
     * @return DeliveryType
     */
    public function setDescription($Description)
    {
        $this->Description = $Description;

        return $this;
    }

    /**
     * @return DeliveryExtensionType
     */
    public function getDeliveryExtension()
    {
        return $this->DeliveryExtension;
    }

    /**
     * @param DeliveryExtensionType $DeliveryExtension
     *
     * @return DeliveryType
     */
    public function setDeliveryExtension($DeliveryExtension)
    {
        $this->DeliveryExtension = $DeliveryExtension;

        return $this;
    }
}
