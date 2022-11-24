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
     * @var ?AddressingResults
     */
    protected $AddressingResults = null;

    /**
     * @var ?ErrorsType
     */
    protected $Errors = null;

    /**
     * @var string
     */
    protected $version = null;

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
