<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types;

class ReferencesType
{
    /**
     * @var token255
     */
    protected $AppDeliveryID = null;

    /**
     * @var string
     */
    protected $GZ = null;

    /**
     * @var token255
     */
    protected $MZSDeliveryID = null;

    /**
     * @var token255
     */
    protected $ZSDeliveryID = null;

    /**
     * @param token255 $AppDeliveryID
     * @param string   $GZ
     * @param token255 $MZSDeliveryID
     * @param token255 $ZSDeliveryID
     */
    public function __construct($AppDeliveryID, $GZ, $MZSDeliveryID, $ZSDeliveryID)
    {
        $this->AppDeliveryID = $AppDeliveryID;
        $this->GZ = $GZ;
        $this->MZSDeliveryID = $MZSDeliveryID;
        $this->ZSDeliveryID = $ZSDeliveryID;
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

    public function getGZ(): string
    {
        return $this->GZ;
    }

    public function setGZ(string $GZ): self
    {
        $this->GZ = $GZ;

        return $this;
    }

    /**
     * @return token255
     */
    public function getMZSDeliveryID()
    {
        return $this->MZSDeliveryID;
    }

    /**
     * @param token255 $MZSDeliveryID
     */
    public function setMZSDeliveryID($MZSDeliveryID): self
    {
        $this->MZSDeliveryID = $MZSDeliveryID;

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
}
