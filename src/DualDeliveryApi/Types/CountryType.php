<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types;

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

    /**
     * @return CountryCodeType
     */
    public function getCountryCode()
    {
        return $this->CountryCode;
    }

    /**
     * @param CountryCodeType $CountryCode
     *
     * @return CountryType
     */
    public function setCountryCode($CountryCode)
    {
        $this->CountryCode = $CountryCode;

        return $this;
    }
}
