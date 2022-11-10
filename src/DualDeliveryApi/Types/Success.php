<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types;

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
     * @var \DateTime
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

    /**
     * @param Sender                 $Sender
     * @param Receiver               $Receiver
     * @param NotificationsPerformed $NotificationsPerformed
     * @param AssertionType          $AuthBlock
     * @param BinaryConfirmation     $BinaryConfirmation
     * @param SignatureType          $Signature
     */
    public function __construct($Sender, $Receiver, $NotificationsPerformed, \DateTime $ConfirmationTimestamp, $AuthBlock, $BinaryConfirmation, $Signature)
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

    public function getNotificationsPerformed(): NotificationsPerformed
    {
        return $this->NotificationsPerformed;
    }

    public function setNotificationsPerformed(NotificationsPerformed $NotificationsPerformed): self
    {
        $this->NotificationsPerformed = $NotificationsPerformed;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getConfirmationTimestamp()
    {
        if ($this->ConfirmationTimestamp === null) {
            return null;
        } else {
            try {
                return new \DateTime($this->ConfirmationTimestamp);
            } catch (\Exception $e) {
                return false;
            }
        }
    }

    public function setConfirmationTimestamp(\DateTime $ConfirmationTimestamp): self
    {
        $this->ConfirmationTimestamp = $ConfirmationTimestamp->format(\DateTime::ATOM);

        return $this;
    }

    public function getAuthBlock(): AssertionType
    {
        return $this->AuthBlock;
    }

    public function setAuthBlock(AssertionType $AuthBlock): self
    {
        $this->AuthBlock = $AuthBlock;

        return $this;
    }

    public function getBinaryConfirmation(): BinaryConfirmation
    {
        return $this->BinaryConfirmation;
    }

    public function setBinaryConfirmation(BinaryConfirmation $BinaryConfirmation): self
    {
        $this->BinaryConfirmation = $BinaryConfirmation;

        return $this;
    }

    public function getSignature(): SignatureType
    {
        return $this->Signature;
    }

    public function setSignature(SignatureType $Signature): self
    {
        $this->Signature = $Signature;

        return $this;
    }
}
