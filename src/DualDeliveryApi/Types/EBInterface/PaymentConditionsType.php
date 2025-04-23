<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\EBInterface;

use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\date;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\Decimal2Type;

class PaymentConditionsType
{
    /**
     * @var date
     */
    protected $DueDate;

    /**
     * @var DiscountType
     */
    protected $Discount;

    /**
     * @var Decimal2Type
     */
    protected $MinimumPayment;

    /**
     * @var string
     */
    protected $Comment;

    /**
     * @var PaymentConditionsExtensionType
     */
    protected $PaymentConditionsExtension;

    /**
     * @param date                           $DueDate
     * @param DiscountType                   $Discount
     * @param Decimal2Type                   $MinimumPayment
     * @param string                         $Comment
     * @param PaymentConditionsExtensionType $PaymentConditionsExtension
     */
    public function __construct($DueDate, $Discount, $MinimumPayment, $Comment, $PaymentConditionsExtension)
    {
        $this->DueDate = $DueDate;
        $this->Discount = $Discount;
        $this->MinimumPayment = $MinimumPayment;
        $this->Comment = $Comment;
        $this->PaymentConditionsExtension = $PaymentConditionsExtension;
    }

    /**
     * @return date
     */
    public function getDueDate()
    {
        return $this->DueDate;
    }

    /**
     * @param date $DueDate
     */
    public function setDueDate($DueDate): self
    {
        $this->DueDate = $DueDate;

        return $this;
    }

    public function getDiscount(): DiscountType
    {
        return $this->Discount;
    }

    public function setDiscount(DiscountType $Discount): self
    {
        $this->Discount = $Discount;

        return $this;
    }

    /**
     * @return Decimal2Type
     */
    public function getMinimumPayment()
    {
        return $this->MinimumPayment;
    }

    /**
     * @param Decimal2Type $MinimumPayment
     */
    public function setMinimumPayment($MinimumPayment): self
    {
        $this->MinimumPayment = $MinimumPayment;

        return $this;
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

    public function getPaymentConditionsExtension(): PaymentConditionsExtensionType
    {
        return $this->PaymentConditionsExtension;
    }

    public function setPaymentConditionsExtension(PaymentConditionsExtensionType $PaymentConditionsExtension): self
    {
        $this->PaymentConditionsExtension = $PaymentConditionsExtension;

        return $this;
    }
}
