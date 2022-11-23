<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualDeliveryBulk;

use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\PayloadType;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\Sender;

class DualDeliveryBulkRequestType
{
    /**
     * @var Sender
     */
    protected $Sender = null;

    /**
     * @var MetaData
     */
    protected $MetaData = null;

    /**
     * @var PayloadType
     */
    protected $Payload = null;

    /**
     * @var bool
     */
    protected $StartBulk = null;

    /**
     * @var FinishBulk
     */
    protected $FinishBulk = null;

    /**
     * @var string
     */
    protected $version = null;

    /**
     * @param Sender      $Sender
     * @param MetaData    $MetaData
     * @param PayloadType $Payload
     * @param bool        $StartBulk
     * @param FinishBulk  $FinishBulk
     * @param string      $version
     */
    public function __construct($Sender, $MetaData, $Payload, $StartBulk, $FinishBulk, $version)
    {
        $this->Sender = $Sender;
        $this->MetaData = $MetaData;
        $this->Payload = $Payload;
        $this->StartBulk = $StartBulk;
        $this->FinishBulk = $FinishBulk;
        $this->version = $version;
    }

    public function getSender(): Sender
    {
        return $this->Sender;
    }

    public function setSender(Sender $Sender): self
    {
        $this->Sender = $Sender;

        return $this;
    }

    public function getMetaData(): MetaData
    {
        return $this->MetaData;
    }

    public function setMetaData(MetaData $MetaData): self
    {
        $this->MetaData = $MetaData;

        return $this;
    }

    public function getPayload(): PayloadType
    {
        return $this->Payload;
    }

    public function setPayload(PayloadType $Payload): self
    {
        $this->Payload = $Payload;

        return $this;
    }

    public function getStartBulk(): bool
    {
        return $this->StartBulk;
    }

    public function setStartBulk(bool $StartBulk): self
    {
        $this->StartBulk = $StartBulk;

        return $this;
    }

    public function getFinishBulk(): FinishBulk
    {
        return $this->FinishBulk;
    }

    public function setFinishBulk(FinishBulk $FinishBulk): self
    {
        $this->FinishBulk = $FinishBulk;

        return $this;
    }

    public function getVersion(): string
    {
        return $this->version;
    }

    public function setVersion(string $version): self
    {
        $this->version = $version;

        return $this;
    }
}
