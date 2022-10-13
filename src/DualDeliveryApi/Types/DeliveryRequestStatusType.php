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

    /**
     * @return DeliveryAnswerType
     */
    public function getSuccess()
    {
        return $this->Success;
    }

    /**
     * @param DeliveryAnswerType $Success
     *
     * @return DeliveryRequestStatusType
     */
    public function setSuccess($Success)
    {
        $this->Success = $Success;

        return $this;
    }

    /**
     * @return DeliveryConfirmationType
     */
    public function getDeliveryConfirmation()
    {
        return $this->DeliveryConfirmation;
    }

    /**
     * @param DeliveryConfirmationType $DeliveryConfirmation
     *
     * @return DeliveryRequestStatusType
     */
    public function setDeliveryConfirmation($DeliveryConfirmation)
    {
        $this->DeliveryConfirmation = $DeliveryConfirmation;

        return $this;
    }

    /**
     * @return DeliveryAnswerType
     */
    public function getPartialSuccess()
    {
        return $this->PartialSuccess;
    }

    /**
     * @param DeliveryAnswerType $PartialSuccess
     *
     * @return DeliveryRequestStatusType
     */
    public function setPartialSuccess($PartialSuccess)
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

    /**
     * @param Error $Error
     *
     * @return DeliveryRequestStatusType
     */
    public function setError($Error)
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
     *
     * @return DeliveryRequestStatusType
     */
    public function setVersion($version)
    {
        $this->version = $version;

        return $this;
    }
}
