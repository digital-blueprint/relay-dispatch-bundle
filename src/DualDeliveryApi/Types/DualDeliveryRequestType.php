<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types;

use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualDelivery\MetaData;

class DualDeliveryRequestType
{
    /**
     * @var SenderType
     */
    protected $Sender = null;

    /**
     * @var string|null
     */
    protected $RecipientID = null;

    /**
     * @var RecipientType
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

    /**
     * @param SenderType            $Sender
     * @param string|null           $RecipientID
     * @param RecipientType         $Recipient
     * @param MetaData              $MetaData
     * @param DeliveryChannels|null $DeliveryChannels
     * @param PayloadType[]         $Payload
     * @param string                $version
     */
    public function __construct($Sender, $RecipientID, $Recipient, $MetaData, $DeliveryChannels, $Payload, $version)
    {
        $this->Sender = $Sender;
        $this->RecipientID = $RecipientID;
        $this->Recipient = $Recipient;
        $this->MetaData = $MetaData;
        $this->DeliveryChannels = $DeliveryChannels;
        $this->Payload = $Payload;
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

    public function getRecipientID(): ?string
    {
        return $this->RecipientID;
    }

    public function setRecipientID(?string $RecipientID): self
    {
        $this->RecipientID = $RecipientID;

        return $this;
    }

    public function getRecipient(): RecipientType
    {
        return $this->Recipient;
    }

    public function setRecipient(RecipientType $Recipient): self
    {
        $this->Recipient = $Recipient;

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

    public function getDeliveryChannels(): ?DeliveryChannels
    {
        return $this->DeliveryChannels;
    }

    public function setDeliveryChannels(DeliveryChannels $DeliveryChannels): self
    {
        $this->DeliveryChannels = $DeliveryChannels;

        return $this;
    }

    /**
     * @return PayloadType[]
     */
    public function getPayload(): array
    {
        return $this->Payload ?? [];
    }

    public function setPayload(array $Payload): self
    {
        $this->Payload = $Payload;

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
