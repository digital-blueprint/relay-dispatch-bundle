<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\EBInterface;

use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\CountryCodeType;

class CountryType
{
    /**
     * @var CountryCodeType
     */
    protected $CountryCode = null;

    /**
     * @param CountryCodeType $CountryCode
     */
    public function __construct($CountryCode)
    {
        $this->CountryCode = $CountryCode;
    }

    public function getCountryCode(): CountryCodeType
    {
        return $this->CountryCode;
    }

    public function setCountryCode(CountryCodeType $CountryCode): self
    {
        $this->CountryCode = $CountryCode;

        return $this;
    }
}
