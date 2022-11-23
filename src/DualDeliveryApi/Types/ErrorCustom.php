<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types;

use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\XMLDsig\SignatureType;

class ErrorCustom
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
     * @var ErrorInfo
     */
    protected $ErrorInfo = null;

    /**
     * @var SignatureType
     */
    protected $Signature = null;

    /**
     * @param Sender                 $Sender
     * @param Receiver               $Receiver
     * @param NotificationsPerformed $NotificationsPerformed
     * @param ErrorInfo              $ErrorInfo
     * @param SignatureType          $Signature
     */
    public function __construct($Sender, $Receiver, $NotificationsPerformed, $ErrorInfo, $Signature)
    {
        $this->Sender = $Sender;
        $this->Receiver = $Receiver;
        $this->NotificationsPerformed = $NotificationsPerformed;
        $this->ErrorInfo = $ErrorInfo;
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

    public function getErrorInfo(): ErrorInfo
    {
        return $this->ErrorInfo;
    }

    public function setErrorInfo(ErrorInfo $ErrorInfo): self
    {
        $this->ErrorInfo = $ErrorInfo;

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
