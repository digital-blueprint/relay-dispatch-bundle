<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types;

class DeliveryRequestStatusACKType
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
     * @var anonymous276
     */
    protected $version = null;

    /**
     * @param token255     $AppDeliveryID
     * @param token255     $ZSDeliveryID
     * @param anonymous276 $version
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
     * @return DeliveryRequestStatusACKType
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
     * @return DeliveryRequestStatusACKType
     */
    public function setZSDeliveryID($ZSDeliveryID)
    {
        $this->ZSDeliveryID = $ZSDeliveryID;

        return $this;
    }

    /**
     * @return anonymous276
     */
    public function getVersion()
    {
        return $this->version;
    }

    /**
     * @param anonymous276 $version
     *
     * @return DeliveryRequestStatusACKType
     */
    public function setVersion($version)
    {
        $this->version = $version;

        return $this;
    }
}
