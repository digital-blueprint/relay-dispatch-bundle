<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualDeliveryNotification;

use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualDelivery\ManipulatedPayloadsType;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualDelivery\StatusType;

class DualNotificationRequestType
{
    /**
     * @var string
     */
    protected $AppDeliveryID;

    /**
     * @var ?string
     */
    protected $DualDeliveryID;

    /**
     * @var ?Result
     */
    protected $Result;

    /**
     * @var ?AdditionalResults
     */
    protected $AdditionalResults;

    /**
     * @var ?ManipulatedPayloadsType
     */
    protected $ManipulatedPayloads;

    /**
     * @var StatusType
     */
    protected $Status;

    /**
     * @var string
     */
    protected $version;

    public function __construct(string $AppDeliveryID, string $DualDeliveryID, AdditionalResults $AdditionalResults, StatusType $Status, string $version)
    {
        $this->AppDeliveryID = $AppDeliveryID;
        $this->DualDeliveryID = $DualDeliveryID;
        $this->AdditionalResults = $AdditionalResults;
        $this->Status = $Status;
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

    public function getDualDeliveryID(): ?string
    {
        return $this->DualDeliveryID;
    }

    public function setDualDeliveryID(string $DualDeliveryID): void
    {
        $this->DualDeliveryID = $DualDeliveryID;
    }

    public function getResult(): ?Result
    {
        return $this->Result;
    }

    public function setResult(Result $Result): void
    {
        $this->Result = $Result;
    }

    public function getAdditionalResults(): ?AdditionalResults
    {
        return $this->AdditionalResults;
    }

    public function setAdditionalResults(AdditionalResults $AdditionalResults): void
    {
        $this->AdditionalResults = $AdditionalResults;
    }

    public function getManipulatedPayloads(): ?ManipulatedPayloadsType
    {
        return $this->ManipulatedPayloads;
    }

    public function setManipulatedPayloads(ManipulatedPayloadsType $ManipulatedPayloads): void
    {
        $this->ManipulatedPayloads = $ManipulatedPayloads;
    }

    public function getStatus(): StatusType
    {
        return $this->Status;
    }

    public function setStatus(StatusType $Status): void
    {
        $this->Status = $Status;
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
