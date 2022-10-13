<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types;

class DeliveryAnswerType
{
    /**
     * @var string255
     */
    protected $DeliveryService = null;

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
     * @var bool
     */
    protected $RelayedViaERV = null;

    /**
     * @param string255 $DeliveryService
     * @param token255  $AppDeliveryID
     * @param string    $GZ
     * @param token255  $MZSDeliveryID
     * @param token255  $ZSDeliveryID
     */
    public function __construct($DeliveryService, $AppDeliveryID, $GZ, $MZSDeliveryID, $ZSDeliveryID)
    {
        $this->DeliveryService = $DeliveryService;
        $this->AppDeliveryID = $AppDeliveryID;
        $this->GZ = $GZ;
        $this->MZSDeliveryID = $MZSDeliveryID;
        $this->ZSDeliveryID = $ZSDeliveryID;
    }

    /**
     * @return string255
     */
    public function getDeliveryService()
    {
        return $this->DeliveryService;
    }

    /**
     * @param string255 $DeliveryService
     *
     * @return DeliveryAnswerType
     */
    public function setDeliveryService($DeliveryService)
    {
        $this->DeliveryService = $DeliveryService;

        return $this;
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
     * @return DeliveryAnswerType
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
     * @return DeliveryAnswerType
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
     * @return DeliveryAnswerType
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
     * @return DeliveryAnswerType
     */
    public function setZSDeliveryID($ZSDeliveryID)
    {
        $this->ZSDeliveryID = $ZSDeliveryID;

        return $this;
    }

    /**
     * @return bool
     */
    public function getRelayedViaERV()
    {
        return $this->RelayedViaERV;
    }

    /**
     * @param bool $RelayedViaERV
     *
     * @return DeliveryAnswerType
     */
    public function setRelayedViaERV($RelayedViaERV)
    {
        $this->RelayedViaERV = $RelayedViaERV;

        return $this;
    }
}
