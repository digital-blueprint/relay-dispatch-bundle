<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualDeliveryPreAddressing;

use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualDelivery\ErrorsType;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualDelivery\StatusType;

class DualDeliveryPreAddressingResponseType
{
    /**
     * @var string
     */
    protected $AppDeliveryID;

    /**
     * @var StatusType
     */
    protected $Status;

    /**
     * @var ?string
     */
    protected $DualDeliveryID;

    /**
     * @var ?AddressingResults
     */
    protected $AddressingResults;

    /**
     * @var ?ErrorsType
     */
    protected $Errors;

    /**
     * @var string
     */
    protected $version;

    public function __construct(string $AppDeliveryID, StatusType $Status, ?string $DualDeliveryID, ?ErrorsType $Errors, string $version)
    {
        $this->AppDeliveryID = $AppDeliveryID;
        $this->Status = $Status;
        $this->DualDeliveryID = $DualDeliveryID;
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

    public function getAddressingResults(): ?AddressingResults
    {
        return $this->AddressingResults;
    }

    public function setAddressingResults(AddressingResults $AddressingResults): void
    {
        $this->AddressingResults = $AddressingResults;
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
