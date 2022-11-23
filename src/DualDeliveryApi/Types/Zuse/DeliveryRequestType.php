<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\Zuse;

use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualDelivery\CustomNotificationIntervals;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualDeliveryBulk\Sender;

class DeliveryRequestType
{
    /**
     * @var ?string
     */
    protected $ZbPK = null;

    /**
     * @var ?string
     */
    protected $edID = null;

    /**
     * @var ?Identification
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
     * @var ?Receiver
     */
    protected $Receiver = null;

    /**
     * @var MetaData
     */
    protected $MetaData = null;

    /**
     * @var ?DocumentReference
     */
    protected $DocumentReference = null;

    /**
     * @var ?CustomNotificationIntervals
     */
    protected $CustomNotificationIntervals = null;

    /**
     * @var string
     */
    protected $version = null;

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
