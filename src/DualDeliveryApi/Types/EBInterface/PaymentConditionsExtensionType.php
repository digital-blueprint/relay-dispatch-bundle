<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\EBInterface;

class PaymentConditionsExtensionType
{
    /**
     * @var PaymentConditionsExtensionType
     */
    protected $PaymentConditionsExtension;

    /**
     * @var CustomType
     */
    protected $Custom;

    /**
     * @param PaymentConditionsExtensionType $PaymentConditionsExtension
     * @param CustomType                     $Custom
     */
    public function __construct($PaymentConditionsExtension, $Custom)
    {
        $this->PaymentConditionsExtension = $PaymentConditionsExtension;
        $this->Custom = $Custom;
    }

    public function getPaymentConditionsExtension(): PaymentConditionsExtensionType
    {
        return $this->PaymentConditionsExtension;
    }

    public function setPaymentConditionsExtension(PaymentConditionsExtensionType $PaymentConditionsExtension): self
    {
        $this->PaymentConditionsExtension = $PaymentConditionsExtension;

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
