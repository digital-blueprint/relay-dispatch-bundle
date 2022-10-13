<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types;

class DeliveryExtensionType
{
    /**
     * @var DeliveryExtensionType
     */
    protected $DeliveryExtension = null;

    /**
     * @var CustomType
     */
    protected $Custom = null;

    /**
     * @param DeliveryExtensionType $DeliveryExtension
     * @param CustomType            $Custom
     */
    public function __construct($DeliveryExtension, $Custom)
    {
        $this->DeliveryExtension = $DeliveryExtension;
        $this->Custom = $Custom;
    }

    /**
     * @return DeliveryExtensionType
     */
    public function getDeliveryExtension()
    {
        return $this->DeliveryExtension;
    }

    /**
     * @param DeliveryExtensionType $DeliveryExtension
     *
     * @return DeliveryExtensionType
     */
    public function setDeliveryExtension($DeliveryExtension)
    {
        $this->DeliveryExtension = $DeliveryExtension;

        return $this;
    }

    /**
     * @return CustomType
     */
    public function getCustom()
    {
        return $this->Custom;
    }

    /**
     * @param CustomType $Custom
     *
     * @return DeliveryExtensionType
     */
    public function setCustom($Custom)
    {
        $this->Custom = $Custom;

        return $this;
    }
}
