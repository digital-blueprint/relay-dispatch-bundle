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

    /**
     * @return UsedDeliveryChannelType
     */
    public function getUsedDeliveryChannel()
    {
        return $this->UsedDeliveryChannel;
    }

    /**
     * @param UsedDeliveryChannelType $UsedDeliveryChannel
     *
     * @return UsedDeliveryChannels
     */
    public function setUsedDeliveryChannel($UsedDeliveryChannel)
    {
        $this->UsedDeliveryChannel = $UsedDeliveryChannel;

        return $this;
    }
}
