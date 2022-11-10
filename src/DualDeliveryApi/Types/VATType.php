<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types;

class VATType
{
    /**
     * @var string
     */
    protected $TaxExemption = null;

    /**
     * @var ItemType
     */
    protected $Item = null;

    /**
     * @param string   $TaxExemption
     * @param ItemType $Item
     */
    public function __construct($TaxExemption, $Item)
    {
        $this->TaxExemption = $TaxExemption;
        $this->Item = $Item;
    }

    public function getTaxExemption(): string
    {
        return $this->TaxExemption;
    }

    public function setTaxExemption(string $TaxExemption): self
    {
        $this->TaxExemption = $TaxExemption;

        return $this;
    }

    public function getItem(): ItemType
    {
        return $this->Item;
    }

    public function setItem(ItemType $Item): self
    {
        $this->Item = $Item;

        return $this;
    }
}
