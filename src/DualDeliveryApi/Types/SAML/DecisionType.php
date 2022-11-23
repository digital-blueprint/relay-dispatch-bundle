<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\SAML;

class DecisionType
{
    public const __default = 'Permit';
    public const Permit = 'Permit';
    public const Deny = 'Deny';
    public const Indeterminate = 'Indeterminate';
}
