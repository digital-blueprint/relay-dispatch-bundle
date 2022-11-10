<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types;

use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualDeliveryPre\MetaData;

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
     * @var DeliveryChannels
     */
    protected $DeliveryChannels = null;

    /**
     * @var string
     */
    protected $version = null;

    /**
     * @param SenderType $Sender
     * @param Recipients $Recipients
     * @param MetaData   $MetaData
     * @param string     $version
     */
    public function __construct($Sender, $Recipients, $MetaData, ?DeliveryChannels $DeliveryChannels, $version)
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

    public function setSender(SenderType $Sender): self
    {
        $this->Sender = $Sender;

        return $this;
    }

    public function getRecipients(): Recipients
    {
        return $this->Recipients;
    }

    public function setRecipients(Recipients $Recipients): self
    {
        $this->Recipients = $Recipients;

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

    public function getDeliveryChannels(): DeliveryChannels
    {
        return $this->DeliveryChannels;
    }

    public function setDeliveryChannels(DeliveryChannels $DeliveryChannels): self
    {
        $this->DeliveryChannels = $DeliveryChannels;

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
