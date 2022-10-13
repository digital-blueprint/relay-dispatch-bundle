<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types;

class ItemType
{
    /**
     * @var Decimal2Type
     */
    protected $TaxedAmount = null;

    /**
     * @var TaxRateType
     */
    protected $TaxRate = null;

    /**
     * @var Decimal2Type
     */
    protected $Amount = null;

    /**
     * @param Decimal2Type $TaxedAmount
     * @param TaxRateType  $TaxRate
     * @param Decimal2Type $Amount
     */
    public function __construct($TaxedAmount, $TaxRate, $Amount)
    {
        $this->TaxedAmount = $TaxedAmount;
        $this->TaxRate = $TaxRate;
        $this->Amount = $Amount;
    }

    /**
     * @return Decimal2Type
     */
    public function getTaxedAmount()
    {
        return $this->TaxedAmount;
    }

    /**
     * @param Decimal2Type $TaxedAmount
     *
     * @return ItemType
     */
    public function setTaxedAmount($TaxedAmount)
    {
        $this->TaxedAmount = $TaxedAmount;

        return $this;
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
     * @return ItemType
     */
    public function setTaxRate($TaxRate)
    {
        $this->TaxRate = $TaxRate;

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
     * @return ItemType
     */
    public function setAmount($Amount)
    {
        $this->Amount = $Amount;

        return $this;
    }
}
