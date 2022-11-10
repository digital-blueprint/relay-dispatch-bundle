<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types;

class ListLineItemExtensionType
{
    /**
     * @var ListLineItemExtensionType
     */
    protected $ListLineItemExtension = null;

    /**
     * @var CustomType
     */
    protected $Custom = null;

    /**
     * @param ListLineItemExtensionType $ListLineItemExtension
     * @param CustomType                $Custom
     */
    public function __construct($ListLineItemExtension, $Custom)
    {
        $this->ListLineItemExtension = $ListLineItemExtension;
        $this->Custom = $Custom;
    }

    public function getListLineItemExtension(): ListLineItemExtensionType
    {
        return $this->ListLineItemExtension;
    }

    public function setListLineItemExtension(ListLineItemExtensionType $ListLineItemExtension): self
    {
        $this->ListLineItemExtension = $ListLineItemExtension;

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
