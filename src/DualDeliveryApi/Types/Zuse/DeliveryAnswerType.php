<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\Zuse;

use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\string255;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\token255;

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
     */
    public function setDeliveryService($DeliveryService): self
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

    public function getRelayedViaERV(): bool
    {
        return $this->RelayedViaERV;
    }

    public function setRelayedViaERV(bool $RelayedViaERV): self
    {
        $this->RelayedViaERV = $RelayedViaERV;

        return $this;
    }
}
