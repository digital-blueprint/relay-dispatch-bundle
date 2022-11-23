<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualDeliveryPreAddressing;

use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DeliveryChannels;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\Recipients;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\SenderType;

class DualDeliveryPreAddressingRequestType
{
    /**
     * @var SenderType
     */
    protected $Sender = null;

    /**
     * @var Recipients
     */
    protected $Recipients = null;

    /**
     * @var MetaData
     */
    protected $MetaData = null;

    /**
     * @var ?DeliveryChannels
     */
    protected $DeliveryChannels = null;

    /**
     * @var string
     */
    protected $version = null;

    public function __construct(SenderType $Sender, Recipients $Recipients, MetaData $MetaData, ?DeliveryChannels $DeliveryChannels, string $version)
    {
        $this->Sender = $Sender;
        $this->Recipients = $Recipients;
        $this->MetaData = $MetaData;
        $this->DeliveryChannels = $DeliveryChannels;
        $this->version = $version;
    }

    public function getSender(): SenderType
    {
        return $this->Sender;
    }

    public function setSender(SenderType $Sender): void
    {
        $this->Sender = $Sender;
    }

    public function getRecipients(): Recipients
    {
        return $this->Recipients;
    }

    public function setRecipients(Recipients $Recipients): void
    {
        $this->Recipients = $Recipients;
    }

    public function getMetaData(): MetaData
    {
        return $this->MetaData;
    }

    public function setMetaData(MetaData $MetaData): void
    {
        $this->MetaData = $MetaData;
    }

    public function getDeliveryChannels(): ?DeliveryChannels
    {
        return $this->DeliveryChannels;
    }

    public function setDeliveryChannels(DeliveryChannels $DeliveryChannels): void
    {
        $this->DeliveryChannels = $DeliveryChannels;
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
