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

    /**
     * @return DeliveryChannelSetType
     */
    public function getDeliveryChannelSet()
    {
        return $this->DeliveryChannelSet;
    }

    /**
     * @param DeliveryChannelSetType $DeliveryChannelSet
     *
     * @return DeliveryChannels
     */
    public function setDeliveryChannelSet($DeliveryChannelSet)
    {
        $this->DeliveryChannelSet = $DeliveryChannelSet;

        return $this;
    }
}
