<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\EBInterface;

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

    public function getVAT(): VATType
    {
        return $this->VAT;
    }

    public function setVAT(VATType $VAT): self
    {
        $this->VAT = $VAT;

        return $this;
    }

    public function getOtherTax(): OtherTaxType
    {
        return $this->OtherTax;
    }

    public function setOtherTax(OtherTaxType $OtherTax): self
    {
        $this->OtherTax = $OtherTax;

        return $this;
    }

    public function getTaxExtension(): TaxExtensionType
    {
        return $this->TaxExtension;
    }

    public function setTaxExtension(TaxExtensionType $TaxExtension): self
    {
        $this->TaxExtension = $TaxExtension;

        return $this;
    }
}
