<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\EBInterface;

use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\AddressIdentifierTypeType;

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
