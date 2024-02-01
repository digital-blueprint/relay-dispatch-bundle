<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualDeliveryBulk;

use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualDelivery\ErrorsType;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualDelivery\StatusType;

class DualNotificationBulkRequestType
{
    /**
     * @var string
     */
    protected $ApplicationDeliveryID;

    /**
     * @var ?int
     */
    protected $DualZSID;

    /**
     * @var ?BulkElements
     */
    protected $BulkElements;

    /**
     * @var StatusType
     */
    protected $Status;

    /**
     * @var ?ErrorsType
     */
    protected $Errors;

    /**
     * @var string
     */
    protected $version;

    public function __construct(string $ApplicationDeliveryID, ?BulkElements $BulkElements, StatusType $Status, ?ErrorsType $Errors, string $version)
    {
        $this->ApplicationDeliveryID = $ApplicationDeliveryID;
        $this->BulkElements = $BulkElements;
        $this->Status = $Status;
        $this->Errors = $Errors;
        $this->version = $version;
    }

    public function getApplicationDeliveryID(): string
    {
        return $this->ApplicationDeliveryID;
    }

    public function setApplicationDeliveryID(string $ApplicationDeliveryID): void
    {
        $this->ApplicationDeliveryID = $ApplicationDeliveryID;
    }

    public function getDualZSID(): ?int
    {
        return $this->DualZSID;
    }

    public function setDualZSID(int $DualZSID): void
    {
        $this->DualZSID = $DualZSID;
    }

    public function getBulkElements(): ?BulkElements
    {
        return $this->BulkElements;
    }

    public function setBulkElements(BulkElements $BulkElements): void
    {
        $this->BulkElements = $BulkElements;
    }

    public function getStatus(): StatusType
    {
        return $this->Status;
    }

    public function setStatus(StatusType $Status): void
    {
        $this->Status = $Status;
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
