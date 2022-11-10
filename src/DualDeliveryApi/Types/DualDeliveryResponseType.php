<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types;

class DualDeliveryResponseType
{
    /**
     * @var string
     */
    protected $AppDeliveryID = null;

    /**
     * @var StatusType
     */
    protected $Status = null;

    /**
     * @var string
     */
    protected $DualDeliveryID = null;

    /**
     * @var AdditionalMetaData
     */
    protected $AdditionalMetaData = null;

    /**
     * @var UsedDeliveryChannels
     */
    protected $UsedDeliveryChannels = null;

    /**
     * @var ManipulatedPayloadsType
     */
    protected $ManipulatedPayloads = null;

    /**
     * @var ErrorsType
     */
    protected $Errors = null;

    /**
     * @var string
     */
    protected $version = null;

    /**
     * @param string             $AppDeliveryID
     * @param StatusType         $Status
     * @param string             $DualDeliveryID
     * @param AdditionalMetaData $AdditionalMetaData
     * @param ErrorsType         $Errors
     * @param string             $version
     */
    public function __construct($AppDeliveryID, $Status, $DualDeliveryID, $AdditionalMetaData, $Errors, $version)
    {
        $this->AppDeliveryID = $AppDeliveryID;
        $this->Status = $Status;
        $this->DualDeliveryID = $DualDeliveryID;
        $this->AdditionalMetaData = $AdditionalMetaData;
        $this->Errors = $Errors;
        $this->version = $version;
    }

    /**
     * @return string
     */
    public function getAppDeliveryID()
    {
        return $this->AppDeliveryID;
    }

    /**
     * @return DualDeliveryResponseType
     */
    public function setAppDeliveryID(string $AppDeliveryID)
    {
        $this->AppDeliveryID = $AppDeliveryID;

        return $this;
    }

    /**
     * @return StatusType
     */
    public function getStatus()
    {
        return $this->Status;
    }

    /**
     * @return DualDeliveryResponseType
     */
    public function setStatus(StatusType $Status)
    {
        $this->Status = $Status;

        return $this;
    }

    /**
     * @return string
     */
    public function getDualDeliveryID()
    {
        return $this->DualDeliveryID;
    }

    /**
     * @return DualDeliveryResponseType
     */
    public function setDualDeliveryID(string $DualDeliveryID)
    {
        $this->DualDeliveryID = $DualDeliveryID;

        return $this;
    }

    /**
     * @return AdditionalMetaData
     */
    public function getAdditionalMetaData()
    {
        return $this->AdditionalMetaData;
    }

    /**
     * @return DualDeliveryResponseType
     */
    public function setAdditionalMetaData(AdditionalMetaData $AdditionalMetaData)
    {
        $this->AdditionalMetaData = $AdditionalMetaData;

        return $this;
    }

    /**
     * @return UsedDeliveryChannels
     */
    public function getUsedDeliveryChannels()
    {
        return $this->UsedDeliveryChannels;
    }

    /**
     * @return DualDeliveryResponseType
     */
    public function setUsedDeliveryChannels(UsedDeliveryChannels $UsedDeliveryChannels)
    {
        $this->UsedDeliveryChannels = $UsedDeliveryChannels;

        return $this;
    }

    /**
     * @return ManipulatedPayloadsType
     */
    public function getManipulatedPayloads()
    {
        return $this->ManipulatedPayloads;
    }

    /**
     * @return DualDeliveryResponseType
     */
    public function setManipulatedPayloads(ManipulatedPayloadsType $ManipulatedPayloads)
    {
        $this->ManipulatedPayloads = $ManipulatedPayloads;

        return $this;
    }

    /**
     * @return ErrorsType
     */
    public function getErrors()
    {
        return $this->Errors;
    }

    /**
     * @return DualDeliveryResponseType
     */
    public function setErrors(ErrorsType $Errors)
    {
        $this->Errors = $Errors;

        return $this;
    }

    /**
     * @return string
     */
    public function getVersion()
    {
        return $this->version;
    }

    /**
     * @return DualDeliveryResponseType
     */
    public function setVersion(string $version)
    {
        $this->version = $version;

        return $this;
    }
}
