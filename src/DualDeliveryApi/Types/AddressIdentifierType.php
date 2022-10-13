<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types;

class AddressIdentifierType
{
    /**
     * @var AddressIdentifierTypeType
     */
    protected $AddressIdentifierType = null;

    /**
     * @param AddressIdentifierTypeType $AddressIdentifierType
     */
    public function __construct($AddressIdentifierType)
    {
        $this->AddressIdentifierType = $AddressIdentifierType;
    }

    /**
     * @return AddressIdentifierTypeType
     */
    public function getAddressIdentifierType()
    {
        return $this->AddressIdentifierType;
    }

    /**
     * @param AddressIdentifierTypeType $AddressIdentifierType
     *
     * @return AddressIdentifierType
     */
    public function setAddressIdentifierType($AddressIdentifierType)
    {
        $this->AddressIdentifierType = $AddressIdentifierType;

        return $this;
    }
}
