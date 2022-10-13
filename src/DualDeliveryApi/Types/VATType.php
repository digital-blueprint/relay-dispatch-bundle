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

    /**
     * @return string
     */
    public function getTaxExemption()
    {
        return $this->TaxExemption;
    }

    /**
     * @param string $TaxExemption
     *
     * @return VATType
     */
    public function setTaxExemption($TaxExemption)
    {
        $this->TaxExemption = $TaxExemption;

        return $this;
    }

    /**
     * @return ItemType
     */
    public function getItem()
    {
        return $this->Item;
    }

    /**
     * @param ItemType $Item
     *
     * @return VATType
     */
    public function setItem($Item)
    {
        $this->Item = $Item;

        return $this;
    }
}
