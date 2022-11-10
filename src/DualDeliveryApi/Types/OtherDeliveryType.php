<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types;

class OtherDeliveryType extends DeliveryChannelSetType
{
    /**
     * @var ExtensionPointType
     */
    protected $DeliveryInformation = null;

    /**
     * @param ExtensionPointType $DeliveryInformation
     */
    public function __construct($DeliveryInformation)
    {
        $this->DeliveryInformation = $DeliveryInformation;
    }

    public function getDeliveryInformation(): ExtensionPointType
    {
        return $this->DeliveryInformation;
    }

    public function setDeliveryInformation(ExtensionPointType $DeliveryInformation): self
    {
        $this->DeliveryInformation = $DeliveryInformation;

        return $this;
    }
}
