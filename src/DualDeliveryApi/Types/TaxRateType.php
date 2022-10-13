<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types;

class TaxRateType
{
    /**
     * @var PercentageType
     */
    protected $_ = null;

    /**
     * @var TaxCodeType
     */
    protected $TaxCode = null;

    /**
     * @param PercentageType $_
     * @param TaxCodeType    $TaxCode
     */
    public function __construct($_, $TaxCode)
    {
        $this->_ = $_;
        $this->TaxCode = $TaxCode;
    }

    /**
     * @return PercentageType
     */
    public function get_()
    {
        return $this->_;
    }

    /**
     * @param PercentageType $_
     *
     * @return TaxRateType
     */
    public function set_($_)
    {
        $this->_ = $_;

        return $this;
    }

    /**
     * @return TaxCodeType
     */
    public function getTaxCode()
    {
        return $this->TaxCode;
    }

    /**
     * @param TaxCodeType $TaxCode
     *
     * @return TaxRateType
     */
    public function setTaxCode($TaxCode)
    {
        $this->TaxCode = $TaxCode;

        return $this;
    }
}
