<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\Zuse;

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
     * @var string
     */
    protected $type = null;

    /**
     * @param string|null     $Id
     * @param string          $PostalCode
     * @param string          $Municipality
     * @param string|null     $MunicipalityNumber
     * @param DeliveryAddress $DeliveryAddress
     * @param string|null     $type
     */
    public function __construct($Id, $PostalCode, $Municipality, $MunicipalityNumber, $DeliveryAddress, $type = null)
    {
        parent::__construct($Id);
        $this->PostalCode = $PostalCode;
        $this->Municipality = $Municipality;
        $this->MunicipalityNumber = $MunicipalityNumber;
        $this->DeliveryAddress = $DeliveryAddress;
        $this->type = $type;
    }

    public function getCountryCode(): string
    {
        return $this->CountryCode;
    }

    public function setCountryCode(string $CountryCode): self
    {
        $this->CountryCode = $CountryCode;

        return $this;
    }

    public function getPostalCode(): string
    {
        return $this->PostalCode;
    }

    public function setPostalCode(string $PostalCode): self
    {
        $this->PostalCode = $PostalCode;

        return $this;
    }

    public function getMunicipality(): string
    {
        return $this->Municipality;
    }

    public function setMunicipality(string $Municipality): self
    {
        $this->Municipality = $Municipality;

        return $this;
    }

    public function getMunicipalityNumber(): string
    {
        return $this->MunicipalityNumber;
    }

    public function setMunicipalityNumber(string $MunicipalityNumber): self
    {
        $this->MunicipalityNumber = $MunicipalityNumber;

        return $this;
    }

    public function getDeliveryAddress(): DeliveryAddress
    {
        return $this->DeliveryAddress;
    }

    public function setDeliveryAddress(DeliveryAddress $DeliveryAddress): self
    {
        $this->DeliveryAddress = $DeliveryAddress;

        return $this;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType($type): self
    {
        $this->type = $type;

        return $this;
    }
}
