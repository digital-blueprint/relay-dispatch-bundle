<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\Zuse;

use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\Receiver;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\SAML\AssertionType;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\Sender;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\XMLDsig\SignatureType;

class Success
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
     * @var NotificationsPerformed
     */
    protected $NotificationsPerformed = null;

    /**
     * @var string
     */
    protected $ConfirmationTimestamp = null;

    /**
     * @var AssertionType
     */
    protected $AuthBlock = null;

    /**
     * @var BinaryConfirmation
     */
    protected $BinaryConfirmation = null;

    /**
     * @var SignatureType
     */
    protected $Signature = null;

    public function __construct(Sender $Sender, Receiver $Receiver, NotificationsPerformed $NotificationsPerformed, \DateTimeInterface $ConfirmationTimestamp, AssertionType $AuthBlock, BinaryConfirmation $BinaryConfirmation, SignatureType $Signature)
    {
        $this->Sender = $Sender;
        $this->Receiver = $Receiver;
        $this->NotificationsPerformed = $NotificationsPerformed;
        $this->ConfirmationTimestamp = $ConfirmationTimestamp->format(\DateTime::ATOM);
        $this->AuthBlock = $AuthBlock;
        $this->BinaryConfirmation = $BinaryConfirmation;
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

    public function getNotificationsPerformed(): NotificationsPerformed
    {
        return $this->NotificationsPerformed;
    }

    public function setNotificationsPerformed(NotificationsPerformed $NotificationsPerformed): void
    {
        $this->NotificationsPerformed = $NotificationsPerformed;
    }

    public function getConfirmationTimestamp(): \DateTimeInterface
    {
        return new \DateTimeImmutable($this->ConfirmationTimestamp);
    }

    public function setConfirmationTimestamp(\DateTimeInterface $ConfirmationTimestamp): void
    {
        $this->ConfirmationTimestamp = $ConfirmationTimestamp->format(\DateTime::ATOM);
    }

    public function getAuthBlock(): AssertionType
    {
        return $this->AuthBlock;
    }

    public function setAuthBlock(AssertionType $AuthBlock): void
    {
        $this->AuthBlock = $AuthBlock;
    }

    public function getBinaryConfirmation(): BinaryConfirmation
    {
        return $this->BinaryConfirmation;
    }

    public function setBinaryConfirmation(BinaryConfirmation $BinaryConfirmation): void
    {
        $this->BinaryConfirmation = $BinaryConfirmation;
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
