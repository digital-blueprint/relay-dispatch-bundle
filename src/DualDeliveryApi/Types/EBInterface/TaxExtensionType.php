<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\EBInterface;

class TaxExtensionType
{
    /**
     * @var TaxExtensionType
     */
    protected $TaxExtension = null;

    /**
     * @var CustomType
     */
    protected $Custom = null;

    /**
     * @param TaxExtensionType $TaxExtension
     * @param CustomType       $Custom
     */
    public function __construct($TaxExtension, $Custom)
    {
        $this->TaxExtension = $TaxExtension;
        $this->Custom = $Custom;
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

    public function getCustom(): CustomType
    {
        return $this->Custom;
    }

    public function setCustom(CustomType $Custom): self
    {
        $this->Custom = $Custom;

        return $this;
    }
}
