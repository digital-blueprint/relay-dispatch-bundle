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
     * @var string
     */
    protected $DualDeliveryID = null;

    /**
     * @var AddressingResults
     */
    protected $AddressingResults = null;

    /**
     * @var ErrorsType
     */
    protected $Errors = null;

    /**
     * @var string
     */
    protected $version = null;

    /**
     * @param string     $AppDeliveryID
     * @param StatusType $Status
     * @param string     $DualDeliveryID
     * @param ErrorsType $Errors
     * @param string     $version
     */
    public function __construct($AppDeliveryID, $Status, $DualDeliveryID, $Errors, $version)
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

    public function setAppDeliveryID(string $AppDeliveryID): self
    {
        $this->AppDeliveryID = $AppDeliveryID;

        return $this;
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

    public function getDualDeliveryID(): string
    {
        return $this->DualDeliveryID;
    }

    public function setDualDeliveryID(string $DualDeliveryID): self
    {
        $this->DualDeliveryID = $DualDeliveryID;

        return $this;
    }

    public function getAddressingResults(): AddressingResults
    {
        return $this->AddressingResults;
    }

    public function setAddressingResults(AddressingResults $AddressingResults): self
    {
        $this->AddressingResults = $AddressingResults;

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
