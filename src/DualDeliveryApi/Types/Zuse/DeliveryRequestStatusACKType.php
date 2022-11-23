<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\Zuse;

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
     */
    public function setAppDeliveryID($AppDeliveryID): self
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
     */
    public function setZSDeliveryID($ZSDeliveryID): self
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
     */
    public function setVersion($version): self
    {
        $this->version = $version;

        return $this;
    }
}
