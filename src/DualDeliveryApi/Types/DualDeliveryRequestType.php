<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types;

use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualDelivery\MetaData;

class DualDeliveryRequestType
{
    /**
     * @var ?SenderType
     */
    protected $Sender = null;

    /**
     * @var ?string
     */
    protected $RecipientID = null;

    /**
     * @var ?RecipientType
     */
    protected $Recipient = null;

    /**
     * @var MetaData
     */
    protected $MetaData = null;

    /**
     * @var DeliveryChannels|null
     */
    protected $DeliveryChannels = null;

    /**
     * @var PayloadType[]
     */
    protected $Payload = null;

    /**
     * @var string
     */
    protected $version = null;

    public function __construct(?SenderType $Sender, ?string $RecipientID, ?RecipientType $Recipient, MetaData $MetaData, ?DeliveryChannels $DeliveryChannels, array $Payload, string $version)
    {
        if ($RecipientID === null && $Recipient === null) {
            throw new \RuntimeException('Either RecipientID or Recipient needs to be set');
        }

        $this->Sender = $Sender;
        $this->RecipientID = $RecipientID;
        $this->Recipient = $Recipient;
        $this->MetaData = $MetaData;
        $this->DeliveryChannels = $DeliveryChannels;
        $this->Payload = $Payload;
        $this->version = $version;
    }

    public function getSender(): ?SenderType
    {
        return $this->Sender;
    }

    public function setSender(SenderType $Sender): void
    {
        $this->Sender = $Sender;
    }

    public function getRecipientID(): ?string
    {
        return $this->RecipientID;
    }

    public function setRecipientID(?string $RecipientID): void
    {
        $this->RecipientID = $RecipientID;
    }

    public function getRecipient(): ?RecipientType
    {
        return $this->Recipient;
    }

    public function setRecipient(RecipientType $Recipient): void
    {
        $this->Recipient = $Recipient;
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

    /**
     * @return PayloadType[]
     */
    public function getPayload(): array
    {
        return $this->Payload ?? [];
    }

    public function setPayload(array $Payload): void
    {
        $this->Payload = $Payload;
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
