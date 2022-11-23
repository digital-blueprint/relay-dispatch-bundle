<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types;

use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\EBInterface\CustomType;

class PaymentMethodExtensionType
{
    /**
     * @var PaymentMethodExtensionType
     */
    protected $PaymentMethodExtension = null;

    /**
     * @var CustomType
     */
    protected $Custom = null;

    /**
     * @param PaymentMethodExtensionType $PaymentMethodExtension
     * @param CustomType                 $Custom
     */
    public function __construct($PaymentMethodExtension, $Custom)
    {
        $this->PaymentMethodExtension = $PaymentMethodExtension;
        $this->Custom = $Custom;
    }

    public function getPaymentMethodExtension(): PaymentMethodExtensionType
    {
        return $this->PaymentMethodExtension;
    }

    public function setPaymentMethodExtension(PaymentMethodExtensionType $PaymentMethodExtension): self
    {
        $this->PaymentMethodExtension = $PaymentMethodExtension;

        return $this;
    }

    public function getCustom(): CustomType
    {
        return $this->Custom;
    }

    public function setCustom(CustomType $Custom): self
    {
        $this->Custom = $Custom;

        return $this;
    }
}
