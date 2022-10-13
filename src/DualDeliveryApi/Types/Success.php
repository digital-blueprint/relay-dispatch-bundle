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
     * @return Success
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
     * @return Success
     */
    public function setReceiver($Receiver)
    {
        $this->Receiver = $Receiver;

        return $this;
    }

    /**
     * @return NotificationsPerformed
     */
    public function getNotificationsPerformed()
    {
        return $this->NotificationsPerformed;
    }

    /**
     * @param NotificationsPerformed $NotificationsPerformed
     *
     * @return Success
     */
    public function setNotificationsPerformed($NotificationsPerformed)
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

    /**
     * @return Success
     */
    public function setConfirmationTimestamp(\DateTime $ConfirmationTimestamp)
    {
        $this->ConfirmationTimestamp = $ConfirmationTimestamp->format(\DateTime::ATOM);

        return $this;
    }

    /**
     * @return AssertionType
     */
    public function getAuthBlock()
    {
        return $this->AuthBlock;
    }

    /**
     * @param AssertionType $AuthBlock
     *
     * @return Success
     */
    public function setAuthBlock($AuthBlock)
    {
        $this->AuthBlock = $AuthBlock;

        return $this;
    }

    /**
     * @return BinaryConfirmation
     */
    public function getBinaryConfirmation()
    {
        return $this->BinaryConfirmation;
    }

    /**
     * @param BinaryConfirmation $BinaryConfirmation
     *
     * @return Success
     */
    public function setBinaryConfirmation($BinaryConfirmation)
    {
        $this->BinaryConfirmation = $BinaryConfirmation;

        return $this;
    }

    /**
     * @return SignatureType
     */
    public function getSignature()
    {
        return $this->Signature;
    }

    /**
     * @param SignatureType $Signature
     *
     * @return Success
     */
    public function setSignature($Signature)
    {
        $this->Signature = $Signature;

        return $this;
    }
}
