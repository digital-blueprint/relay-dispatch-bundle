<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types;

class DeliveryChannels
{
    /**
     * @var DeliveryChannelSetType
     */
    protected $DeliveryChannelSet = null;

    /**
     * @param DeliveryChannelSetType $DeliveryChannelSet
     */
    public function __construct($DeliveryChannelSet = null)
    {
        $this->DeliveryChannelSet = $DeliveryChannelSet;
    }

    public function getDeliveryChannelSet(): DeliveryChannelSetType
    {
        return $this->DeliveryChannelSet;
    }

    public function setDeliveryChannelSet(DeliveryChannelSetType $DeliveryChannelSet): self
    {
        $this->DeliveryChannelSet = $DeliveryChannelSet;

        return $this;
    }
}
