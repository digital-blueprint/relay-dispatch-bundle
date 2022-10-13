<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types;

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

    /**
     * @return PaymentMethodExtensionType
     */
    public function getPaymentMethodExtension()
    {
        return $this->PaymentMethodExtension;
    }

    /**
     * @param PaymentMethodExtensionType $PaymentMethodExtension
     *
     * @return PaymentMethodExtensionType
     */
    public function setPaymentMethodExtension($PaymentMethodExtension)
    {
        $this->PaymentMethodExtension = $PaymentMethodExtension;

        return $this;
    }

    /**
     * @return CustomType
     */
    public function getCustom()
    {
        return $this->Custom;
    }

    /**
     * @param CustomType $Custom
     *
     * @return PaymentMethodExtensionType
     */
    public function setCustom($Custom)
    {
        $this->Custom = $Custom;

        return $this;
    }
}
