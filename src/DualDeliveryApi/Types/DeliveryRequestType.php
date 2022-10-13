<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types;

class DeliveryRequestType
{
    /**
     * @var token255
     */
    protected $ZbPK = null;

    /**
     * @var token255
     */
    protected $edID = null;

    /**
     * @var stringentification
     */
    protected $Identification = null;

    /**
     * @var NotificationAddress
     */
    protected $NotificationAddress = null;

    /**
     * @var Sender
     */
    protected $Sender = null;

    /**
     * @var Receiver
     */
    protected $Receiver = null;

    /**
     * @var MetaData
     */
    protected $MetaData = null;

    /**
     * @var DocumentReference
     */
    protected $DocumentReference = null;

    /**
     * @var CustomNotificationIntervals
     */
    protected $CustomNotificationIntervals = null;

    /**
     * @var anonymous267
     */
    protected $version = null;

    /**
     * @param token255            $ZbPK
     * @param token255            $edID
     * @param Identification      $Identification
     * @param NotificationAddress $NotificationAddress
     * @param Sender              $Sender
     * @param Receiver            $Receiver
     * @param MetaData            $MetaData
     * @param anonymous267        $version
     */
    public function __construct($ZbPK, $edID, $Identification, $NotificationAddress, $Sender, $Receiver, $MetaData, $version)
    {
        $this->ZbPK = $ZbPK;
        $this->edID = $edID;
        $this->Identification = $Identification;
        $this->NotificationAddress = $NotificationAddress;
        $this->Sender = $Sender;
        $this->Receiver = $Receiver;
        $this->MetaData = $MetaData;
        $this->version = $version;
    }

    /**
     * @return token255
     */
    public function getZbPK()
    {
        return $this->ZbPK;
    }

    /**
     * @param token255 $ZbPK
     *
     * @return DeliveryRequestType
     */
    public function setZbPK($ZbPK)
    {
        $this->ZbPK = $ZbPK;

        return $this;
    }

    /**
     * @return token255
     */
    public function getEdID()
    {
        return $this->edID;
    }

    /**
     * @param token255 $edID
     *
     * @return DeliveryRequestType
     */
    public function setEdID($edID)
    {
        $this->edID = $edID;

        return $this;
    }

    /**
     * @return stringentification
     */
    public function getIdentification()
    {
        return $this->Identification;
    }

    /**
     * @param Identification $Identification
     *
     * @return DeliveryRequestType
     */
    public function setIdentification($Identification)
    {
        $this->Identification = $Identification;

        return $this;
    }

    /**
     * @return NotificationAddress
     */
    public function getNotificationAddress()
    {
        return $this->NotificationAddress;
    }

    /**
     * @param NotificationAddress $NotificationAddress
     *
     * @return DeliveryRequestType
     */
    public function setNotificationAddress($NotificationAddress)
    {
        $this->NotificationAddress = $NotificationAddress;

        return $this;
    }

    /**
     * @return Sender
     */
    public function getSender()
    {
        return $this->Sender;
    }

    /**
     * @param Sender $Sender
     *
     * @return DeliveryRequestType
     */
    public function setSender($Sender)
    {
        $this->Sender = $Sender;

        return $this;
    }

    /**
     * @return Receiver
     */
    public function getReceiver()
    {
        return $this->Receiver;
    }

    /**
     * @param Receiver $Receiver
     *
     * @return DeliveryRequestType
     */
    public function setReceiver($Receiver)
    {
        $this->Receiver = $Receiver;

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
     * @return DeliveryRequestType
     */
    public function setMetaData($MetaData)
    {
        $this->MetaData = $MetaData;

        return $this;
    }

    /**
     * @return DocumentReference
     */
    public function getDocumentReference()
    {
        return $this->DocumentReference;
    }

    /**
     * @param DocumentReference $DocumentReference
     *
     * @return DeliveryRequestType
     */
    public function setDocumentReference($DocumentReference)
    {
        $this->DocumentReference = $DocumentReference;

        return $this;
    }

    /**
     * @return CustomNotificationIntervals
     */
    public function getCustomNotificationIntervals()
    {
        return $this->CustomNotificationIntervals;
    }

    /**
     * @param CustomNotificationIntervals $CustomNotificationIntervals
     *
     * @return DeliveryRequestType
     */
    public function setCustomNotificationIntervals($CustomNotificationIntervals)
    {
        $this->CustomNotificationIntervals = $CustomNotificationIntervals;

        return $this;
    }

    /**
     * @return anonymous267
     */
    public function getVersion()
    {
        return $this->version;
    }

    /**
     * @param anonymous267 $version
     *
     * @return DeliveryRequestType
     */
    public function setVersion($version)
    {
        $this->version = $version;

        return $this;
    }
}
