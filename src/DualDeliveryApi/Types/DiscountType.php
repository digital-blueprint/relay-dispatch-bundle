<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types;

class DiscountType
{
    /**
     * @var date
     */
    protected $PaymentDate = null;

    /**
     * @var Decimal2Type
     */
    protected $BaseAmount = null;

    /**
     * @var PercentageType
     */
    protected $Percentage = null;

    /**
     * @var Decimal2Type
     */
    protected $Amount = null;

    /**
     * @param date           $PaymentDate
     * @param Decimal2Type   $BaseAmount
     * @param PercentageType $Percentage
     * @param Decimal2Type   $Amount
     */
    public function __construct($PaymentDate, $BaseAmount, $Percentage, $Amount)
    {
        $this->PaymentDate = $PaymentDate;
        $this->BaseAmount = $BaseAmount;
        $this->Percentage = $Percentage;
        $this->Amount = $Amount;
    }

    /**
     * @return date
     */
    public function getPaymentDate()
    {
        return $this->PaymentDate;
    }

    /**
     * @param date $PaymentDate
     *
     * @return DiscountType
     */
    public function setPaymentDate($PaymentDate)
    {
        $this->PaymentDate = $PaymentDate;

        return $this;
    }

    /**
     * @return Decimal2Type
     */
    public function getBaseAmount()
    {
        return $this->BaseAmount;
    }

    /**
     * @param Decimal2Type $BaseAmount
     *
     * @return DiscountType
     */
    public function setBaseAmount($BaseAmount)
    {
        $this->BaseAmount = $BaseAmount;

        return $this;
    }

    /**
     * @return PercentageType
     */
    public function getPercentage()
    {
        return $this->Percentage;
    }

    /**
     * @param PercentageType $Percentage
     *
     * @return DiscountType
     */
    public function setPercentage($Percentage)
    {
        $this->Percentage = $Percentage;

        return $this;
    }

    /**
     * @return Decimal2Type
     */
    public function getAmount()
    {
        return $this->Amount;
    }

    /**
     * @param Decimal2Type $Amount
     *
     * @return DiscountType
     */
    public function setAmount($Amount)
    {
        $this->Amount = $Amount;

        return $this;
    }
}
