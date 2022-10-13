<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types;

class AddressIdentifierTypeType
{
    public const __default = 'GLN';
    public const GLN = 'GLN';
    public const DUNS = 'DUNS';
    public const ProprietaryAddressID = 'ProprietaryAddressID';
}
