<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types;

class ReductionAndSurchargeType extends ReductionAndSurchargeBaseType
{
    /**
     * @var TaxRateType
     */
    protected $TaxRate = null;

    /**
     * @param Decimal2Type   $BaseAmount
     * @param PercentageType $Percentage
     * @param Decimal2Type   $Amount
     * @param TaxRateType    $TaxRate
     */
    public function __construct($BaseAmount, $Percentage, $Amount, $TaxRate)
    {
        parent::__construct($BaseAmount, $Percentage, $Amount);
        $this->TaxRate = $TaxRate;
    }

    public function getTaxRate(): TaxRateType
    {
        return $this->TaxRate;
    }

    public function setTaxRate(TaxRateType $TaxRate): self
    {
        $this->TaxRate = $TaxRate;

        return $this;
    }
}
