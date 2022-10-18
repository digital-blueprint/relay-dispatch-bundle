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
     * @param SenderType       $Sender
     * @param Recipients       $Recipients
     * @param MetaData         $MetaData
     * @param DeliveryChannels $DeliveryChannels
     * @param string           $version
     */
    public function __construct($Sender, $Recipients, $MetaData, $DeliveryChannels, $version)
    {
        $this->Sender = $Sender;
        $this->Recipients = $Recipients;
        $this->MetaData = $MetaData;
        $this->DeliveryChannels = $DeliveryChannels;
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
     * @return DualDeliveryPreAddressingRequestType
     */
    public function setSender($Sender)
    {
        $this->Sender = $Sender;

        return $this;
    }

    /**
     * @return Recipients
     */
    public function getRecipients()
    {
        return $this->Recipients;
    }

    /**
     * @param Recipients $Recipients
     *
     * @return DualDeliveryPreAddressingRequestType
     */
    public function setRecipients($Recipients)
    {
        $this->Recipients = $Recipients;

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
     * @return DualDeliveryPreAddressingRequestType
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
     * @return DualDeliveryPreAddressingRequestType
     */
    public function setDeliveryChannels($DeliveryChannels)
    {
        $this->DeliveryChannels = $DeliveryChannels;

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
     * @return DualDeliveryPreAddressingRequestType
     */
    public function setVersion($version)
    {
        $this->version = $version;

        return $this;
    }
}
