<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\EBInterface;

use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\Decimal2Type;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\PercentageType;

class ReductionAndSurchargeBaseType
{
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
