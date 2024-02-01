<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\Zuse;

use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\XMLDsig\SignatureType;

class Error
{
    /**
     * @var Sender
     */
    protected $Sender;

    /**
     * @var Receiver
     */
    protected $Receiver;

    /**
     * @var NotificationsPerformed
     */
    protected $NotificationsPerformed;

    /**
     * @var ErrorInfo
     */
    protected $ErrorInfo;

    /**
     * @var SignatureType
     */
    protected $Signature;

    public function __construct(Sender $Sender, Receiver $Receiver, NotificationsPerformed $NotificationsPerformed, ErrorInfo $ErrorInfo, SignatureType $Signature)
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

    public function getErrorInfo(): ErrorInfo
    {
        return $this->ErrorInfo;
    }

    public function setErrorInfo(ErrorInfo $ErrorInfo): void
    {
        $this->ErrorInfo = $ErrorInfo;
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
