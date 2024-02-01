<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\EBInterface;

class AddressIdentifierType
{
    /**
     * @var AddressIdentifierTypeType
     */
    protected $AddressIdentifierType;

    /**
     * @param AddressIdentifierTypeType $AddressIdentifierType
     */
    public function __construct($AddressIdentifierType)
    {
        $this->AddressIdentifierType = $AddressIdentifierType;
    }

    public function getAddressIdentifierType(): AddressIdentifierTypeType
    {
        return $this->AddressIdentifierType;
    }

    public function setAddressIdentifierType(AddressIdentifierTypeType $AddressIdentifierType): self
    {
        $this->AddressIdentifierType = $AddressIdentifierType;

        return $this;
    }
}
