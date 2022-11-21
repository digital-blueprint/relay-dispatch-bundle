<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\EBInterface;

class NoPaymentType extends PaymentMethodType
{
    /**
     * @param string                     $Comment
     * @param PaymentMethodExtensionType $PaymentMethodExtension
     */
    public function __construct($Comment, $PaymentMethodExtension)
    {
        parent::__construct($Comment, $PaymentMethodExtension);
    }
}
