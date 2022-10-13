<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types;

class PaymentMethodType
{
    /**
     * @var string
     */
    protected $Comment = null;

    /**
     * @var PaymentMethodExtensionType
     */
    protected $PaymentMethodExtension = null;

    /**
     * @param string                     $Comment
     * @param PaymentMethodExtensionType $PaymentMethodExtension
     */
    public function __construct($Comment, $PaymentMethodExtension)
    {
        $this->Comment = $Comment;
        $this->PaymentMethodExtension = $PaymentMethodExtension;
    }

    /**
     * @return string
     */
    public function getComment()
    {
        return $this->Comment;
    }

    /**
     * @param string $Comment
     *
     * @return PaymentMethodType
     */
    public function setComment($Comment)
    {
        $this->Comment = $Comment;

        return $this;
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
     * @return PaymentMethodType
     */
    public function setPaymentMethodExtension($PaymentMethodExtension)
    {
        $this->PaymentMethodExtension = $PaymentMethodExtension;

        return $this;
    }
}
