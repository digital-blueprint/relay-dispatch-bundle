<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types;

class DualDeliveryBulkResponseType
{
    /**
     * @var StatusType
     */
    protected $Status = null;

    /**
     * @var int
     */
    protected $BulkId = null;

    /**
     * @var AdditionalMetaData
     */
    protected $AdditionalMetaData = null;

    /**
     * @var ErrorsType
     */
    protected $Errors = null;

    /**
     * @var string
     */
    protected $version = null;

    /**
     * @param StatusType         $Status
     * @param int                $BulkId
     * @param AdditionalMetaData $AdditionalMetaData
     * @param ErrorsType         $Errors
     * @param string             $version
     */
    public function __construct($Status, $BulkId, $AdditionalMetaData, $Errors, $version)
    {
        $this->Status = $Status;
        $this->BulkId = $BulkId;
        $this->AdditionalMetaData = $AdditionalMetaData;
        $this->Errors = $Errors;
        $this->version = $version;
    }

    /**
     * @return StatusType
     */
    public function getStatus()
    {
        return $this->Status;
    }

    /**
     * @param StatusType $Status
     *
     * @return DualDeliveryBulkResponseType
     */
    public function setStatus($Status)
    {
        $this->Status = $Status;

        return $this;
    }

    /**
     * @return int
     */
    public function getBulkId()
    {
        return $this->BulkId;
    }

    /**
     * @param int $BulkId
     *
     * @return DualDeliveryBulkResponseType
     */
    public function setBulkId($BulkId)
    {
        $this->BulkId = $BulkId;

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
     * @param AdditionalMetaData $AdditionalMetaData
     *
     * @return DualDeliveryBulkResponseType
     */
    public function setAdditionalMetaData($AdditionalMetaData)
    {
        $this->AdditionalMetaData = $AdditionalMetaData;

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
     * @param ErrorsType $Errors
     *
     * @return DualDeliveryBulkResponseType
     */
    public function setErrors($Errors)
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
     * @param string $version
     *
     * @return DualDeliveryBulkResponseType
     */
    public function setVersion($version)
    {
        $this->version = $version;

        return $this;
    }
}
