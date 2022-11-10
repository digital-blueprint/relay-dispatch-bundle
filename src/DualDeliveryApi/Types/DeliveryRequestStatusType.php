<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types;

class DeliveryRequestStatusType extends DeliveryAnswerType
{
    /**
     * @var DeliveryAnswerType
     */
    protected $Success = null;

    /**
     * @var DeliveryConfirmationType
     */
    protected $DeliveryConfirmation = null;

    /**
     * @var DeliveryAnswerType
     */
    protected $PartialSuccess = null;

    /**
     * @var Error
     */
    protected $Error = null;

    /**
     * @var anonymous273
     */
    protected $version = null;

    /**
     * @param string255                $DeliveryService
     * @param token255                 $AppDeliveryID
     * @param string                   $GZ
     * @param token255                 $MZSDeliveryID
     * @param token255                 $ZSDeliveryID
     * @param DeliveryAnswerType       $Success
     * @param DeliveryConfirmationType $DeliveryConfirmation
     * @param DeliveryAnswerType       $PartialSuccess
     * @param Error                    $Error
     * @param anonymous273             $version
     */
    public function __construct($DeliveryService, $AppDeliveryID, $GZ, $MZSDeliveryID, $ZSDeliveryID, $Success, $DeliveryConfirmation, $PartialSuccess, $Error, $version)
    {
        parent::__construct($DeliveryService, $AppDeliveryID, $GZ, $MZSDeliveryID, $ZSDeliveryID);
        $this->Success = $Success;
        $this->DeliveryConfirmation = $DeliveryConfirmation;
        $this->PartialSuccess = $PartialSuccess;
        $this->Error = $Error;
        $this->version = $version;
    }

    public function getSuccess(): DeliveryAnswerType
    {
        return $this->Success;
    }

    public function setSuccess(DeliveryAnswerType $Success): self
    {
        $this->Success = $Success;

        return $this;
    }

    public function getDeliveryConfirmation(): DeliveryConfirmationType
    {
        return $this->DeliveryConfirmation;
    }

    public function setDeliveryConfirmation(DeliveryConfirmationType $DeliveryConfirmation): self
    {
        $this->DeliveryConfirmation = $DeliveryConfirmation;

        return $this;
    }

    public function getPartialSuccess(): DeliveryAnswerType
    {
        return $this->PartialSuccess;
    }

    public function setPartialSuccess(DeliveryAnswerType $PartialSuccess): self
    {
        $this->PartialSuccess = $PartialSuccess;

        return $this;
    }

    /**
     * @return Error
     */
    public function getError()
    {
        return $this->Error;
    }

    public function setError(\Error $Error): self
    {
        $this->Error = $Error;

        return $this;
    }

    /**
     * @return anonymous273
     */
    public function getVersion()
    {
        return $this->version;
    }

    /**
     * @param anonymous273 $version
     */
    public function setVersion($version): self
    {
        $this->version = $version;

        return $this;
    }
}
