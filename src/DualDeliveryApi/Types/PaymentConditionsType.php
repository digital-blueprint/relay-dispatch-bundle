<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types;

class PaymentConditionsType
{
    /**
     * @var date
     */
    protected $DueDate = null;

    /**
     * @var DiscountType
     */
    protected $Discount = null;

    /**
     * @var Decimal2Type
     */
    protected $MinimumPayment = null;

    /**
     * @var string
     */
    protected $Comment = null;

    /**
     * @var PaymentConditionsExtensionType
     */
    protected $PaymentConditionsExtension = null;

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
     *
     * @return PaymentConditionsType
     */
    public function setDueDate($DueDate)
    {
        $this->DueDate = $DueDate;

        return $this;
    }

    /**
     * @return DiscountType
     */
    public function getDiscount()
    {
        return $this->Discount;
    }

    /**
     * @param DiscountType $Discount
     *
     * @return PaymentConditionsType
     */
    public function setDiscount($Discount)
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
     *
     * @return PaymentConditionsType
     */
    public function setMinimumPayment($MinimumPayment)
    {
        $this->MinimumPayment = $MinimumPayment;

        return $this;
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
     * @return PaymentConditionsType
     */
    public function setComment($Comment)
    {
        $this->Comment = $Comment;

        return $this;
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
     * @return PaymentConditionsType
     */
    public function setPaymentConditionsExtension($PaymentConditionsExtension)
    {
        $this->PaymentConditionsExtension = $PaymentConditionsExtension;

        return $this;
    }
}
