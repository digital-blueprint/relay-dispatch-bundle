<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types;

class PostalAddressType extends AbstractAddressType
{
    /**
     * @var string
     */
    protected $CountryCode = null;

    /**
     * @var string
     */
    protected $PostalCode = null;

    /**
     * @var string
     */
    protected $Municipality = null;

    /**
     * @var string
     */
    protected $MunicipalityNumber = null;

    /**
     * @var DeliveryAddress
     */
    protected $DeliveryAddress = null;

    /**
     * @var anonymous223
     */
    protected $type = null;

    /**
     * @param string          $Id
     * @param string          $PostalCode
     * @param string          $Municipality
     * @param string          $MunicipalityNumber
     * @param DeliveryAddress $DeliveryAddress
     * @param anonymous223    $type
     */
    public function __construct($Id, $PostalCode, $Municipality, $MunicipalityNumber, $DeliveryAddress, $type)
    {
        parent::__construct($Id);
        $this->PostalCode = $PostalCode;
        $this->Municipality = $Municipality;
        $this->MunicipalityNumber = $MunicipalityNumber;
        $this->DeliveryAddress = $DeliveryAddress;
        $this->type = $type;
    }

    /**
     * @return string
     */
    public function getCountryCode()
    {
        return $this->CountryCode;
    }

    /**
     * @param string $CountryCode
     *
     * @return PostalAddressType
     */
    public function setCountryCode($CountryCode)
    {
        $this->CountryCode = $CountryCode;

        return $this;
    }

    /**
     * @return string
     */
    public function getPostalCode()
    {
        return $this->PostalCode;
    }

    /**
     * @param string $PostalCode
     *
     * @return PostalAddressType
     */
    public function setPostalCode($PostalCode)
    {
        $this->PostalCode = $PostalCode;

        return $this;
    }

    /**
     * @return string
     */
    public function getMunicipality()
    {
        return $this->Municipality;
    }

    /**
     * @param string $Municipality
     *
     * @return PostalAddressType
     */
    public function setMunicipality($Municipality)
    {
        $this->Municipality = $Municipality;

        return $this;
    }

    /**
     * @return string
     */
    public function getMunicipalityNumber()
    {
        return $this->MunicipalityNumber;
    }

    /**
     * @param string $MunicipalityNumber
     *
     * @return PostalAddressType
     */
    public function setMunicipalityNumber($MunicipalityNumber)
    {
        $this->MunicipalityNumber = $MunicipalityNumber;

        return $this;
    }

    /**
     * @return DeliveryAddress
     */
    public function getDeliveryAddress()
    {
        return $this->DeliveryAddress;
    }

    /**
     * @param DeliveryAddress $DeliveryAddress
     *
     * @return PostalAddressType
     */
    public function setDeliveryAddress($DeliveryAddress)
    {
        $this->DeliveryAddress = $DeliveryAddress;

        return $this;
    }

    /**
     * @return anonymous223
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param anonymous223 $type
     *
     * @return PostalAddressType
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }
}
