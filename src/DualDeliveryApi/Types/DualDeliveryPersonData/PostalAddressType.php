<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualDeliveryPersonData;

class PostalAddressType extends AbstractAddressType
{
    /**
     * Code for the country, use ISO or international Postalstandard, compare Staatscode.
     *
     * @var ?string
     */
    protected $CountryCode = null;

    /**
     * ZIP, compare Postleitzahl.
     *
     * @var string
     */
    protected $PostalCode = null;

    /**
     * compare Gemeinde.
     *
     * @var string
     */
    protected $Municipality = null;

    /**
     * @var DeliveryAddress
     */
    protected $DeliveryAddress = null;

    public function __construct(?string $Id, string $PostalCode, string $Municipality, DeliveryAddress $DeliveryAddress)
    {
        parent::__construct($Id);
        $this->PostalCode = $PostalCode;
        $this->Municipality = $Municipality;
        $this->DeliveryAddress = $DeliveryAddress;
    }

    public function getCountryCode(): ?string
    {
        return $this->CountryCode;
    }

    public function setCountryCode(string $CountryCode): void
    {
        $this->CountryCode = $CountryCode;
    }

    public function getPostalCode(): string
    {
        return $this->PostalCode;
    }

    public function setPostalCode(string $PostalCode): void
    {
        $this->PostalCode = $PostalCode;
    }

    public function getMunicipality(): string
    {
        return $this->Municipality;
    }

    public function setMunicipality(string $Municipality): void
    {
        $this->Municipality = $Municipality;
    }

    public function getDeliveryAddress(): DeliveryAddress
    {
        return $this->DeliveryAddress;
    }

    public function setDeliveryAddress(DeliveryAddress $DeliveryAddress): void
    {
        $this->DeliveryAddress = $DeliveryAddress;
    }
}
