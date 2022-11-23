<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualDelivery;

class OtherDeliveryType extends DeliveryChannelSetType
{
    /**
     * @var ExtensionPointType
     */
    protected $DeliveryInformation = null;

    public function __construct(ExtensionPointType $DeliveryInformation)
    {
        parent::__construct();
        $this->DeliveryInformation = $DeliveryInformation;
    }

    public function getDeliveryInformation(): ExtensionPointType
    {
        return $this->DeliveryInformation;
    }

    public function setDeliveryInformation(ExtensionPointType $DeliveryInformation): void
    {
        $this->DeliveryInformation = $DeliveryInformation;
    }
}
