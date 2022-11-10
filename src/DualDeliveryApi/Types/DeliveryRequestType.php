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
     */
    public function setZbPK($ZbPK): self
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
     */
    public function setEdID($edID): self
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

    public function setIdentification(Identification $Identification): self
    {
        $this->Identification = $Identification;

        return $this;
    }

    public function getNotificationAddress(): NotificationAddress
    {
        return $this->NotificationAddress;
    }

    public function setNotificationAddress(NotificationAddress $NotificationAddress): self
    {
        $this->NotificationAddress = $NotificationAddress;

        return $this;
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

    public function getReceiver(): Receiver
    {
        return $this->Receiver;
    }

    public function setReceiver(Receiver $Receiver): self
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
     */
    public function setMetaData($MetaData): self
    {
        $this->MetaData = $MetaData;

        return $this;
    }

    public function getDocumentReference(): DocumentReference
    {
        return $this->DocumentReference;
    }

    public function setDocumentReference(DocumentReference $DocumentReference): self
    {
        $this->DocumentReference = $DocumentReference;

        return $this;
    }

    public function getCustomNotificationIntervals(): CustomNotificationIntervals
    {
        return $this->CustomNotificationIntervals;
    }

    public function setCustomNotificationIntervals(CustomNotificationIntervals $CustomNotificationIntervals): self
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
     */
    public function setVersion($version): self
    {
        $this->version = $version;

        return $this;
    }
}
