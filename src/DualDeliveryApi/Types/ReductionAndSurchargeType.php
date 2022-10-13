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

    /**
     * @return TaxRateType
     */
    public function getTaxRate()
    {
        return $this->TaxRate;
    }

    /**
     * @param TaxRateType $TaxRate
     *
     * @return ReductionAndSurchargeType
     */
    public function setTaxRate($TaxRate)
    {
        $this->TaxRate = $TaxRate;

        return $this;
    }
}
