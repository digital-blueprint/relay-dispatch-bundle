<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\Zuse;

class DeliveryAnswerType
{
    /**
     * @var string
     */
    protected $DeliveryService = null;

    /**
     * @var string
     */
    protected $AppDeliveryID = null;

    /**
     * @var string
     */
    protected $GZ = null;

    /**
     * @var ?string
     */
    protected $MZSDeliveryID = null;

    /**
     * @var ?string
     */
    protected $ZSDeliveryID = null;

    /**
     * @var ?bool
     */
    protected $RelayedViaERV = null;

    public function __construct(string $DeliveryService, string $AppDeliveryID, ?string $GZ, ?string $MZSDeliveryID, string $ZSDeliveryID)
    {
        $this->DeliveryService = $DeliveryService;
        $this->AppDeliveryID = $AppDeliveryID;
        $this->GZ = $GZ;
        $this->MZSDeliveryID = $MZSDeliveryID;
        $this->ZSDeliveryID = $ZSDeliveryID;
    }

    public function getDeliveryService(): string
    {
        return $this->DeliveryService;
    }

    public function setDeliveryService($DeliveryService): void
    {
        $this->DeliveryService = $DeliveryService;
    }

    public function getAppDeliveryID(): string
    {
        return $this->AppDeliveryID;
    }

    public function setAppDeliveryID(string $AppDeliveryID): void
    {
        $this->AppDeliveryID = $AppDeliveryID;
    }

    public function getGZ(): ?string
    {
        return $this->GZ;
    }

    public function setGZ(string $GZ): void
    {
        $this->GZ = $GZ;
    }

    public function getMZSDeliveryID(): ?string
    {
        return $this->MZSDeliveryID;
    }

    public function setMZSDeliveryID(string $MZSDeliveryID): void
    {
        $this->MZSDeliveryID = $MZSDeliveryID;
    }

    public function getZSDeliveryID(): ?string
    {
        return $this->ZSDeliveryID;
    }

    public function setZSDeliveryID(string $ZSDeliveryID): void
    {
        $this->ZSDeliveryID = $ZSDeliveryID;
    }

    public function getRelayedViaERV(): ?bool
    {
        return $this->RelayedViaERV;
    }

    public function setRelayedViaERV(bool $RelayedViaERV): void
    {
        $this->RelayedViaERV = $RelayedViaERV;
    }
}
