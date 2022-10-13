<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types;

class DeliveryNotificationACKType
{
    /**
     * @var token255
     */
    protected $AppDeliveryID = null;

    /**
     * @var token255
     */
    protected $ZSDeliveryID = null;

    /**
     * @var anonymous293
     */
    protected $version = null;

    /**
     * @param token255     $AppDeliveryID
     * @param token255     $ZSDeliveryID
     * @param anonymous293 $version
     */
    public function __construct($AppDeliveryID, $ZSDeliveryID, $version)
    {
        $this->AppDeliveryID = $AppDeliveryID;
        $this->ZSDeliveryID = $ZSDeliveryID;
        $this->version = $version;
    }

    /**
     * @return token255
     */
    public function getAppDeliveryID()
    {
        return $this->AppDeliveryID;
    }

    /**
     * @param token255 $AppDeliveryID
     *
     * @return DeliveryNotificationACKType
     */
    public function setAppDeliveryID($AppDeliveryID)
    {
        $this->AppDeliveryID = $AppDeliveryID;

        return $this;
    }

    /**
     * @return token255
     */
    public function getZSDeliveryID()
    {
        return $this->ZSDeliveryID;
    }

    /**
     * @param token255 $ZSDeliveryID
     *
     * @return DeliveryNotificationACKType
     */
    public function setZSDeliveryID($ZSDeliveryID)
    {
        $this->ZSDeliveryID = $ZSDeliveryID;

        return $this;
    }

    /**
     * @return anonymous293
     */
    public function getVersion()
    {
        return $this->version;
    }

    /**
     * @param anonymous293 $version
     *
     * @return DeliveryNotificationACKType
     */
    public function setVersion($version)
    {
        $this->version = $version;

        return $this;
    }
}
