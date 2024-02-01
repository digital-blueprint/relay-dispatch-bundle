<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\Zuse;

class DeliveryRequestType
{
    /**
     * @var ?string
     */
    protected $ZbPK;

    /**
     * @var ?string
     */
    protected $edID;

    /**
     * @var ?Identification
     */
    protected $Identification;

    /**
     * @var NotificationAddress
     */
    protected $NotificationAddress;

    /**
     * @var Sender
     */
    protected $Sender;

    /**
     * @var ?Receiver
     */
    protected $Receiver;

    /**
     * @var MetaData
     */
    protected $MetaData;

    /**
     * @var ?DocumentReference
     */
    protected $DocumentReference;

    /**
     * @var ?CustomNotificationIntervals
     */
    protected $CustomNotificationIntervals;

    /**
     * @var string
     */
    protected $version;

    public function __construct(?string $ZbPK, ?string $edID, ?Identification $Identification, NotificationAddress $NotificationAddress, Sender $Sender, ?Receiver $Receiver, MetaData $MetaData, string $version)
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

    public function getZbPK(): ?string
    {
        return $this->ZbPK;
    }

    public function setZbPK(string $ZbPK): void
    {
        $this->ZbPK = $ZbPK;
    }

    public function getEdID(): ?string
    {
        return $this->edID;
    }

    public function setEdID(string $edID): void
    {
        $this->edID = $edID;
    }

    public function getIdentification(): ?Identification
    {
        return $this->Identification;
    }

    public function setIdentification(Identification $Identification): void
    {
        $this->Identification = $Identification;
    }

    public function getNotificationAddress(): NotificationAddress
    {
        return $this->NotificationAddress;
    }

    public function setNotificationAddress(NotificationAddress $NotificationAddress): void
    {
        $this->NotificationAddress = $NotificationAddress;
    }

    public function getSender(): Sender
    {
        return $this->Sender;
    }

    public function setSender(Sender $Sender): void
    {
        $this->Sender = $Sender;
    }

    public function getReceiver(): ?Receiver
    {
        return $this->Receiver;
    }

    public function setReceiver(Receiver $Receiver): void
    {
        $this->Receiver = $Receiver;
    }

    public function getMetaData(): MetaData
    {
        return $this->MetaData;
    }

    public function setMetaData(MetaData $MetaData): void
    {
        $this->MetaData = $MetaData;
    }

    public function getDocumentReference(): ?DocumentReference
    {
        return $this->DocumentReference;
    }

    public function setDocumentReference(DocumentReference $DocumentReference): void
    {
        $this->DocumentReference = $DocumentReference;
    }

    public function getCustomNotificationIntervals(): ?CustomNotificationIntervals
    {
        return $this->CustomNotificationIntervals;
    }

    public function setCustomNotificationIntervals(CustomNotificationIntervals $CustomNotificationIntervals): void
    {
        $this->CustomNotificationIntervals = $CustomNotificationIntervals;
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
