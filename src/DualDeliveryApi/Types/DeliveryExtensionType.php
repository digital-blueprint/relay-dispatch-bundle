<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types;

class DeliveryExtensionType
{
    /**
     * @var DeliveryExtensionType
     */
    protected $DeliveryExtension = null;

    /**
     * @var CustomType
     */
    protected $Custom = null;

    /**
     * @param DeliveryExtensionType $DeliveryExtension
     * @param CustomType            $Custom
     */
    public function __construct($DeliveryExtension, $Custom)
    {
        $this->DeliveryExtension = $DeliveryExtension;
        $this->Custom = $Custom;
    }

    public function getDeliveryExtension(): DeliveryExtensionType
    {
        return $this->DeliveryExtension;
    }

    public function setDeliveryExtension(DeliveryExtensionType $DeliveryExtension): self
    {
        $this->DeliveryExtension = $DeliveryExtension;

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
