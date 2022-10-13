<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types;

class TaxType
{
    /**
     * @var VATType
     */
    protected $VAT = null;

    /**
     * @var OtherTaxType
     */
    protected $OtherTax = null;

    /**
     * @var TaxExtensionType
     */
    protected $TaxExtension = null;

    /**
     * @param VATType          $VAT
     * @param OtherTaxType     $OtherTax
     * @param TaxExtensionType $TaxExtension
     */
    public function __construct($VAT, $OtherTax, $TaxExtension)
    {
        $this->VAT = $VAT;
        $this->OtherTax = $OtherTax;
        $this->TaxExtension = $TaxExtension;
    }

    /**
     * @return VATType
     */
    public function getVAT()
    {
        return $this->VAT;
    }

    /**
     * @param VATType $VAT
     *
     * @return TaxType
     */
    public function setVAT($VAT)
    {
        $this->VAT = $VAT;

        return $this;
    }

    /**
     * @return OtherTaxType
     */
    public function getOtherTax()
    {
        return $this->OtherTax;
    }

    /**
     * @param OtherTaxType $OtherTax
     *
     * @return TaxType
     */
    public function setOtherTax($OtherTax)
    {
        $this->OtherTax = $OtherTax;

        return $this;
    }

    /**
     * @return TaxExtensionType
     */
    public function getTaxExtension()
    {
        return $this->TaxExtension;
    }

    /**
     * @param TaxExtensionType $TaxExtension
     *
     * @return TaxType
     */
    public function setTaxExtension($TaxExtension)
    {
        $this->TaxExtension = $TaxExtension;

        return $this;
    }
}
