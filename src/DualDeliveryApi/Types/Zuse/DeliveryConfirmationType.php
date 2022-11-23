<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\Zuse;

use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\Receiver;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\Sender;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\XMLDsig\SignatureType;

class DeliveryConfirmationType extends DeliveryAnswerType
{
    /**
     * @var Sender
     */
    protected $Sender = null;

    /**
     * @var Receiver
     */
    protected $Receiver = null;

    /**
     * @var string
     */
    protected $DeliveryTimestamp = null;

    /**
     * @var SignatureType
     */
    protected $Signature = null;

    public function __construct(string $DeliveryService, string $AppDeliveryID, ?string $GZ, ?string $MZSDeliveryID, string $ZSDeliveryID, Sender $Sender, Receiver $Receiver, \DateTimeInterface $DeliveryTimestamp, SignatureType $Signature)
    {
        parent::__construct($DeliveryService, $AppDeliveryID, $GZ, $MZSDeliveryID, $ZSDeliveryID);
        $this->Sender = $Sender;
        $this->Receiver = $Receiver;
        $this->DeliveryTimestamp = $DeliveryTimestamp->format(\DateTime::ATOM);
        $this->Signature = $Signature;
    }

    public function getSender(): Sender
    {
        return $this->Sender;
    }

    public function setSender(Sender $Sender): void
    {
        $this->Sender = $Sender;
    }

    public function getReceiver(): Receiver
    {
        return $this->Receiver;
    }

    public function setReceiver(Receiver $Receiver): void
    {
        $this->Receiver = $Receiver;
    }

    public function getDeliveryTimestamp(): \DateTimeInterface
    {
        assert($this->DeliveryTimestamp !== null);

        return new \DateTimeImmutable($this->DeliveryTimestamp);
    }

    public function setDeliveryTimestamp(\DateTimeInterface $DeliveryTimestamp): void
    {
        $this->DeliveryTimestamp = $DeliveryTimestamp->format(\DateTime::ATOM);
    }

    public function getSignature(): SignatureType
    {
        return $this->Signature;
    }

    public function setSignature(SignatureType $Signature): void
    {
        $this->Signature = $Signature;
    }
}
