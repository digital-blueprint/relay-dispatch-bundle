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

    /**
     * @return ExtensionPointType
     */
    public function getDeliveryInformation()
    {
        return $this->DeliveryInformation;
    }

    /**
     * @param ExtensionPointType $DeliveryInformation
     *
     * @return OtherDeliveryType
     */
    public function setDeliveryInformation($DeliveryInformation)
    {
        $this->DeliveryInformation = $DeliveryInformation;

        return $this;
    }
}
