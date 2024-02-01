<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\EBInterface;

class DiscountType
{
    /**
     * @var date
     */
    protected $PaymentDate;

    /**
     * @var Decimal2Type
     */
    protected $BaseAmount;

    /**
     * @var PercentageType
     */
    protected $Percentage;

    /**
     * @var Decimal2Type
     */
    protected $Amount;

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
     */
    public function setPaymentDate($PaymentDate): self
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
     */
    public function setBaseAmount($BaseAmount): self
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
     */
    public function setPercentage($Percentage): self
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
     */
    public function setAmount($Amount): self
    {
        $this->Amount = $Amount;

        return $this;
    }
}
