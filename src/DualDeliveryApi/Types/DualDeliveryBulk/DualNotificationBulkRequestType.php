<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualDeliveryBulk;

use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\ErrorsType;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\StatusType;

class DualNotificationBulkRequestType
{
    /**
     * @var string
     */
    protected $ApplicationDeliveryID = null;

    /**
     * @var int
     */
    protected $DualZSID = null;

    /**
     * @var BulkElements
     */
    protected $BulkElements = null;

    /**
     * @var StatusType
     */
    protected $Status = null;

    /**
     * @var ErrorsType
     */
    protected $Errors = null;

    /**
     * @var string
     */
    protected $version = null;

    /**
     * @param string       $ApplicationDeliveryID
     * @param BulkElements $BulkElements
     * @param StatusType   $Status
     * @param ErrorsType   $Errors
     * @param string       $version
     */
    public function __construct($ApplicationDeliveryID, $BulkElements, $Status, $Errors, $version)
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

    public function setApplicationDeliveryID(string $ApplicationDeliveryID): self
    {
        $this->ApplicationDeliveryID = $ApplicationDeliveryID;

        return $this;
    }

    public function getDualZSID(): int
    {
        return $this->DualZSID;
    }

    public function setDualZSID(int $DualZSID): self
    {
        $this->DualZSID = $DualZSID;

        return $this;
    }

    public function getBulkElements(): BulkElements
    {
        return $this->BulkElements;
    }

    public function setBulkElements(BulkElements $BulkElements): self
    {
        $this->BulkElements = $BulkElements;

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
