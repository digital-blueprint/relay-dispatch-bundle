<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\EBInterface;

class OrderingPartyExtensionType
{
    /**
     * @var OrderingPartyExtensionType
     */
    protected $OrderingPartyExtension;

    /**
     * @var CustomType
     */
    protected $Custom;

    /**
     * @param OrderingPartyExtensionType $OrderingPartyExtension
     * @param CustomType                 $Custom
     */
    public function __construct($OrderingPartyExtension, $Custom)
    {
        $this->OrderingPartyExtension = $OrderingPartyExtension;
        $this->Custom = $Custom;
    }

    public function getOrderingPartyExtension(): OrderingPartyExtensionType
    {
        return $this->OrderingPartyExtension;
    }

    public function setOrderingPartyExtension(OrderingPartyExtensionType $OrderingPartyExtension): self
    {
        $this->OrderingPartyExtension = $OrderingPartyExtension;

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
