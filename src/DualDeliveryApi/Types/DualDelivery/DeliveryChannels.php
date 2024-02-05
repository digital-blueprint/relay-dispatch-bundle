<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualDelivery;

class DeliveryChannels
{
    /**
     * @var ?DeliveryChannelSetType
     */
    protected $DeliveryChannelSet;

    public function __construct(?DeliveryChannelSetType $DeliveryChannelSet = null)
    {
        $this->DeliveryChannelSet = $DeliveryChannelSet;
    }

    public function getDeliveryChannelSet(): ?DeliveryChannelSetType
    {
        return $this->DeliveryChannelSet;
    }

    public function setDeliveryChannelSet(DeliveryChannelSetType $DeliveryChannelSet): void
    {
        $this->DeliveryChannelSet = $DeliveryChannelSet;
    }
}
