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

    public function setDeliveryTimestamp(\DateTime $DeliveryTimestamp): self
    {
        $this->DeliveryTimestamp = $DeliveryTimestamp->format(\DateTime::ATOM);

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
