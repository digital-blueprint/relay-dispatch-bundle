<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualDelivery;

class UsedDeliveryChannels
{
    /**
     * @var UsedDeliveryChannelType[]
     */
    protected $UsedDeliveryChannel = null;

    /**
     * @param UsedDeliveryChannelType[] $UsedDeliveryChannel
     */
    public function __construct(array $UsedDeliveryChannel)
    {
        $this->UsedDeliveryChannel = $UsedDeliveryChannel;
    }

    /**
     * @return UsedDeliveryChannelType[]
     */
    public function getUsedDeliveryChannel(): array
    {
        return $this->UsedDeliveryChannel;
    }

    /**
     * @param UsedDeliveryChannelType[] $UsedDeliveryChannel
     */
    public function setUsedDeliveryChannel(array $UsedDeliveryChannel): void
    {
        $this->UsedDeliveryChannel = $UsedDeliveryChannel;
    }
}
