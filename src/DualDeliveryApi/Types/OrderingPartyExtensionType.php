<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types;

class OrderingPartyExtensionType
{
    /**
     * @var OrderingPartyExtensionType
     */
    protected $OrderingPartyExtension = null;

    /**
     * @var CustomType
     */
    protected $Custom = null;

    /**
     * @param OrderingPartyExtensionType $OrderingPartyExtension
     * @param CustomType                 $Custom
     */
    public function __construct($OrderingPartyExtension, $Custom)
    {
        $this->OrderingPartyExtension = $OrderingPartyExtension;
        $this->Custom = $Custom;
    }

    /**
     * @return OrderingPartyExtensionType
     */
    public function getOrderingPartyExtension()
    {
        return $this->OrderingPartyExtension;
    }

    /**
     * @param OrderingPartyExtensionType $OrderingPartyExtension
     *
     * @return OrderingPartyExtensionType
     */
    public function setOrderingPartyExtension($OrderingPartyExtension)
    {
        $this->OrderingPartyExtension = $OrderingPartyExtension;

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
     * @return OrderingPartyExtensionType
     */
    public function setCustom($Custom)
    {
        $this->Custom = $Custom;

        return $this;
    }
}
