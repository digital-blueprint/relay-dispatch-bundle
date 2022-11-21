<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\EBInterface;

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

    public function getComment(): string
    {
        return $this->Comment;
    }

    public function setComment(string $Comment): self
    {
        $this->Comment = $Comment;

        return $this;
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
}
