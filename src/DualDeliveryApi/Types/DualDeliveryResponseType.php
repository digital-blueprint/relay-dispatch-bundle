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
     * @var ?string
     */
    protected $DualDeliveryID = null;

    /**
     * @var ?AdditionalMetaData
     */
    protected $AdditionalMetaData = null;

    /**
     * @var UsedDeliveryChannels
     */
    protected $UsedDeliveryChannels = null;

    /**
     * @var ?ManipulatedPayloadsType
     */
    protected $ManipulatedPayloads = null;

    /**
     * @var ?ErrorsType
     */
    protected $Errors = null;

    /**
     * @var string
     */
    protected $version = null;

    public function __construct(string $AppDeliveryID, StatusType $Status, ?string $DualDeliveryID, ?AdditionalMetaData $AdditionalMetaData, ?ErrorsType $Errors, string $version)
    {
        $this->AppDeliveryID = $AppDeliveryID;
        $this->Status = $Status;
        $this->DualDeliveryID = $DualDeliveryID;
        $this->AdditionalMetaData = $AdditionalMetaData;
        $this->Errors = $Errors;
        $this->version = $version;
    }

    public function getAppDeliveryID(): string
    {
        return $this->AppDeliveryID;
    }

    public function setAppDeliveryID(string $AppDeliveryID): void
    {
        $this->AppDeliveryID = $AppDeliveryID;
    }

    public function getStatus(): StatusType
    {
        return $this->Status;
    }

    public function setStatus(StatusType $Status): void
    {
        $this->Status = $Status;
    }

    public function getDualDeliveryID(): ?string
    {
        return $this->DualDeliveryID;
    }

    public function setDualDeliveryID(string $DualDeliveryID): void
    {
        $this->DualDeliveryID = $DualDeliveryID;
    }

    public function getAdditionalMetaData(): ?AdditionalMetaData
    {
        return $this->AdditionalMetaData;
    }

    public function setAdditionalMetaData(AdditionalMetaData $AdditionalMetaData): void
    {
        $this->AdditionalMetaData = $AdditionalMetaData;
    }

    public function getUsedDeliveryChannels(): UsedDeliveryChannels
    {
        return $this->UsedDeliveryChannels;
    }

    public function setUsedDeliveryChannels(UsedDeliveryChannels $UsedDeliveryChannels): void
    {
        $this->UsedDeliveryChannels = $UsedDeliveryChannels;
    }

    public function getManipulatedPayloads(): ?ManipulatedPayloadsType
    {
        return $this->ManipulatedPayloads;
    }

    public function setManipulatedPayloads(ManipulatedPayloadsType $ManipulatedPayloads): void
    {
        $this->ManipulatedPayloads = $ManipulatedPayloads;
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
