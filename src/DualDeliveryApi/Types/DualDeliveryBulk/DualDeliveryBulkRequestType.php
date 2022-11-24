<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualDeliveryBulk;

use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualDelivery\PayloadType;

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
     * @var PayloadType[]
     */
    protected $Payload = null;

    /**
     * @var ?bool
     */
    protected $StartBulk = null;

    /**
     * @var ?FinishBulk
     */
    protected $FinishBulk = null;

    /**
     * @var string
     */
    protected $version = null;

    /**
     * @param PayloadType[] $Payload
     */
    public function __construct(Sender $Sender, MetaData $MetaData, array $Payload, ?bool $StartBulk, ?FinishBulk $FinishBulk, string $version)
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

    public function setSender(Sender $Sender): void
    {
        $this->Sender = $Sender;
    }

    public function getMetaData(): MetaData
    {
        return $this->MetaData;
    }

    public function setMetaData(MetaData $MetaData): void
    {
        $this->MetaData = $MetaData;
    }

    /**
     * @return PayloadType[]
     */
    public function getPayload(): array
    {
        return $this->Payload;
    }

    /**
     * @param PayloadType[] $Payload
     */
    public function setPayload(array $Payload): void
    {
        $this->Payload = $Payload;
    }

    public function getStartBulk(): ?bool
    {
        return $this->StartBulk;
    }

    public function setStartBulk(bool $StartBulk): void
    {
        $this->StartBulk = $StartBulk;
    }

    public function getFinishBulk(): ?FinishBulk
    {
        return $this->FinishBulk;
    }

    public function setFinishBulk(FinishBulk $FinishBulk): void
    {
        $this->FinishBulk = $FinishBulk;
    }

    public function getVersion(): string
    {
        return $this->version;
    }

    public function setVersion(string $version): void
    {
        $this->version = $version;
    }
}
