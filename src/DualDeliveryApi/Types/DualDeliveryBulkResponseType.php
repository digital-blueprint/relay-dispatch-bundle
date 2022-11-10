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

    public function getStatus(): StatusType
    {
        return $this->Status;
    }

    public function setStatus(StatusType $Status): self
    {
        $this->Status = $Status;

        return $this;
    }

    public function getBulkId(): int
    {
        return $this->BulkId;
    }

    public function setBulkId(int $BulkId): self
    {
        $this->BulkId = $BulkId;

        return $this;
    }

    public function getAdditionalMetaData(): AdditionalMetaData
    {
        return $this->AdditionalMetaData;
    }

    public function setAdditionalMetaData(AdditionalMetaData $AdditionalMetaData): self
    {
        $this->AdditionalMetaData = $AdditionalMetaData;

        return $this;
    }

    public function getErrors(): ErrorsType
    {
        return $this->Errors;
    }

    public function setErrors(ErrorsType $Errors): self
    {
        $this->Errors = $Errors;

        return $this;
    }

    public function getVersion(): string
    {
        return $this->version;
    }

    public function setVersion(string $version): self
    {
        $this->version = $version;

        return $this;
    }
}
