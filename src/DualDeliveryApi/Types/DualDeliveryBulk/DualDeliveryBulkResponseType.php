<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualDeliveryBulk;

use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualDelivery\AdditionalMetaData;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualDelivery\ErrorsType;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualDelivery\StatusType;

class DualDeliveryBulkResponseType
{
    /**
     * @var StatusType
     */
    protected $Status;

    /**
     * @var ?int
     */
    protected $BulkId;

    /**
     * @var ?AdditionalMetaData
     */
    protected $AdditionalMetaData;

    /**
     * @var ?ErrorsType
     */
    protected $Errors;

    /**
     * @var string
     */
    protected $version;

    public function __construct(StatusType $Status, ?int $BulkId, ?AdditionalMetaData $AdditionalMetaData, ?ErrorsType $Errors, string $version)
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

    public function setStatus(StatusType $Status): void
    {
        $this->Status = $Status;
    }

    public function getBulkId(): ?int
    {
        return $this->BulkId;
    }

    public function setBulkId(int $BulkId): void
    {
        $this->BulkId = $BulkId;
    }

    public function getAdditionalMetaData(): ?AdditionalMetaData
    {
        return $this->AdditionalMetaData;
    }

    public function setAdditionalMetaData(AdditionalMetaData $AdditionalMetaData): void
    {
        $this->AdditionalMetaData = $AdditionalMetaData;
    }

    public function getErrors(): ?ErrorsType
    {
        return $this->Errors;
    }

    public function setErrors(ErrorsType $Errors): void
    {
        $this->Errors = $Errors;
    }

    public function getVersion(): string
    {
        return $this->version;
    }

    public function setVersion(string $version): void
    {
        $this->version = $version;
    }
}
