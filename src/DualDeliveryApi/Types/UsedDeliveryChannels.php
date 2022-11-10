<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types;

class UsedDeliveryChannels
{
    /**
     * @var UsedDeliveryChannelType
     */
    protected $UsedDeliveryChannel = null;

    /**
     * @param UsedDeliveryChannelType $UsedDeliveryChannel
     */
    public function __construct($UsedDeliveryChannel)
    {
        $this->UsedDeliveryChannel = $UsedDeliveryChannel;
    }

    public function getUsedDeliveryChannel(): UsedDeliveryChannelType
    {
        return $this->UsedDeliveryChannel;
    }

    public function setUsedDeliveryChannel(UsedDeliveryChannelType $UsedDeliveryChannel): self
    {
        $this->UsedDeliveryChannel = $UsedDeliveryChannel;

        return $this;
    }
}
