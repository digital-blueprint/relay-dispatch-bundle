<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types;

class ReductionAndSurchargeBaseType
{
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
     * @param Decimal2Type   $BaseAmount
     * @param PercentageType $Percentage
     * @param Decimal2Type   $Amount
     */
    public function __construct($BaseAmount, $Percentage, $Amount)
    {
        $this->BaseAmount = $BaseAmount;
        $this->Percentage = $Percentage;
        $this->Amount = $Amount;
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
     * @return ReductionAndSurchargeBaseType
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
     * @return ReductionAndSurchargeBaseType
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
     * @return ReductionAndSurchargeBaseType
     */
    public function setAmount($Amount)
    {
        $this->Amount = $Amount;

        return $this;
    }
}
