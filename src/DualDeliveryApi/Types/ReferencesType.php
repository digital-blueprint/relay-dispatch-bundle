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
     *
     * @return ReferencesType
     */
    public function setAppDeliveryID($AppDeliveryID)
    {
        $this->AppDeliveryID = $AppDeliveryID;

        return $this;
    }

    /**
     * @return string
     */
    public function getGZ()
    {
        return $this->GZ;
    }

    /**
     * @param string $GZ
     *
     * @return ReferencesType
     */
    public function setGZ($GZ)
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
     *
     * @return ReferencesType
     */
    public function setMZSDeliveryID($MZSDeliveryID)
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
     *
     * @return ReferencesType
     */
    public function setZSDeliveryID($ZSDeliveryID)
    {
        $this->ZSDeliveryID = $ZSDeliveryID;

        return $this;
    }
}
