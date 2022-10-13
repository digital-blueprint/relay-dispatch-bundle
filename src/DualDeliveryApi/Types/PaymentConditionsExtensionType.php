<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types;

class PaymentConditionsExtensionType
{
    /**
     * @var PaymentConditionsExtensionType
     */
    protected $PaymentConditionsExtension = null;

    /**
     * @var CustomType
     */
    protected $Custom = null;

    /**
     * @param PaymentConditionsExtensionType $PaymentConditionsExtension
     * @param CustomType                     $Custom
     */
    public function __construct($PaymentConditionsExtension, $Custom)
    {
        $this->PaymentConditionsExtension = $PaymentConditionsExtension;
        $this->Custom = $Custom;
    }

    /**
     * @return PaymentConditionsExtensionType
     */
    public function getPaymentConditionsExtension()
    {
        return $this->PaymentConditionsExtension;
    }

    /**
     * @param PaymentConditionsExtensionType $PaymentConditionsExtension
     *
     * @return PaymentConditionsExtensionType
     */
    public function setPaymentConditionsExtension($PaymentConditionsExtension)
    {
        $this->PaymentConditionsExtension = $PaymentConditionsExtension;

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
     * @return PaymentConditionsExtensionType
     */
    public function setCustom($Custom)
    {
        $this->Custom = $Custom;

        return $this;
    }
}
