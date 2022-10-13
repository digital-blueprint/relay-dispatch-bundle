<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types;

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
     * @return ErrorCustom
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
     * @return ErrorCustom
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
     * @return ErrorCustom
     */
    public function setNotificationsPerformed($NotificationsPerformed)
    {
        $this->NotificationsPerformed = $NotificationsPerformed;

        return $this;
    }

    /**
     * @return ErrorInfo
     */
    public function getErrorInfo()
    {
        return $this->ErrorInfo;
    }

    /**
     * @param ErrorInfo $ErrorInfo
     *
     * @return ErrorCustom
     */
    public function setErrorInfo($ErrorInfo)
    {
        $this->ErrorInfo = $ErrorInfo;

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
     * @return ErrorCustom
     */
    public function setSignature($Signature)
    {
        $this->Signature = $Signature;

        return $this;
    }
}
