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

    /**
     * @return ListLineItemExtensionType
     */
    public function getListLineItemExtension()
    {
        return $this->ListLineItemExtension;
    }

    /**
     * @param ListLineItemExtensionType $ListLineItemExtension
     *
     * @return ListLineItemExtensionType
     */
    public function setListLineItemExtension($ListLineItemExtension)
    {
        $this->ListLineItemExtension = $ListLineItemExtension;

        return $this;
    }

    /**
     * @return CustomType
     */
    public function getCustom()
    {
        return $this->Custom;
    }

    /**
     * @param CustomType $Custom
     *
     * @return ListLineItemExtensionType
     */
    public function setCustom($Custom)
    {
        $this->Custom = $Custom;

        return $this;
    }
}
