<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types;

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
     * @var \DateTime
     */
    protected $DeliveryTimestamp = null;

    /**
     * @var SignatureType
     */
    protected $Signature = null;

    /**
     * @param string255     $DeliveryService
     * @param token255      $AppDeliveryID
     * @param string        $GZ
     * @param token255      $MZSDeliveryID
     * @param token255      $ZSDeliveryID
     * @param Sender        $Sender
     * @param Receiver      $Receiver
     * @param SignatureType $Signature
     */
    public function __construct($DeliveryService, $AppDeliveryID, $GZ, $MZSDeliveryID, $ZSDeliveryID, $Sender, $Receiver, \DateTime $DeliveryTimestamp, $Signature)
    {
        parent::__construct($DeliveryService, $AppDeliveryID, $GZ, $MZSDeliveryID, $ZSDeliveryID);
        $this->Sender = $Sender;
        $this->Receiver = $Receiver;
        $this->DeliveryTimestamp = $DeliveryTimestamp->format(\DateTime::ATOM);
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
     * @return DeliveryConfirmationType
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
     * @return DeliveryConfirmationType
     */
    public function setReceiver($Receiver)
    {
        $this->Receiver = $Receiver;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getDeliveryTimestamp()
    {
        if ($this->DeliveryTimestamp === null) {
            return null;
        } else {
            try {
                return new \DateTime($this->DeliveryTimestamp);
            } catch (\Exception $e) {
                return false;
            }
        }
    }

    /**
     * @return DeliveryConfirmationType
     */
    public function setDeliveryTimestamp(\DateTime $DeliveryTimestamp)
    {
        $this->DeliveryTimestamp = $DeliveryTimestamp->format(\DateTime::ATOM);

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
     * @return DeliveryConfirmationType
     */
    public function setSignature($Signature)
    {
        $this->Signature = $Signature;

        return $this;
    }
}
