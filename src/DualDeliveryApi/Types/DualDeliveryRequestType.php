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
     * @var PayloadType
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
     * @param PayloadType           $Payload
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

    /**
     * @return SenderType
     */
    public function getSender()
    {
        return $this->Sender;
    }

    /**
     * @param SenderType $Sender
     *
     * @return DualDeliveryRequestType
     */
    public function setSender($Sender)
    {
        $this->Sender = $Sender;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getRecipientID()
    {
        return $this->RecipientID;
    }

    /**
     * @param string|null $RecipientID
     *
     * @return DualDeliveryRequestType
     */
    public function setRecipientID($RecipientID)
    {
        $this->RecipientID = $RecipientID;

        return $this;
    }

    /**
     * @return RecipientType
     */
    public function getRecipient()
    {
        return $this->Recipient;
    }

    /**
     * @param RecipientType $Recipient
     *
     * @return DualDeliveryRequestType
     */
    public function setRecipient($Recipient)
    {
        $this->Recipient = $Recipient;

        return $this;
    }

    /**
     * @return MetaData
     */
    public function getMetaData()
    {
        return $this->MetaData;
    }

    /**
     * @param MetaData $MetaData
     *
     * @return DualDeliveryRequestType
     */
    public function setMetaData($MetaData)
    {
        $this->MetaData = $MetaData;

        return $this;
    }

    /**
     * @return DeliveryChannels
     */
    public function getDeliveryChannels()
    {
        return $this->DeliveryChannels;
    }

    /**
     * @param DeliveryChannels $DeliveryChannels
     *
     * @return DualDeliveryRequestType
     */
    public function setDeliveryChannels($DeliveryChannels)
    {
        $this->DeliveryChannels = $DeliveryChannels;

        return $this;
    }

    /**
     * @return PayloadType
     */
    public function getPayload()
    {
        return $this->Payload;
    }

    /**
     * @param PayloadType $Payload
     *
     * @return DualDeliveryRequestType
     */
    public function setPayload($Payload)
    {
        $this->Payload = $Payload;

        return $this;
    }

    /**
     * @return string
     */
    public function getVersion()
    {
        return $this->version;
    }

    /**
     * @param string $version
     *
     * @return DualDeliveryRequestType
     */
    public function setVersion($version)
    {
        $this->version = $version;

        return $this;
    }
}
