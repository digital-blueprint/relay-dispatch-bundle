<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\Zuse;

class DeliveryRequestStatusType extends DeliveryAnswerType
{
    /**
     * @var DeliveryAnswerType
     */
    protected $Success;

    /**
     * @var DeliveryConfirmationType
     */
    protected $DeliveryConfirmation;

    /**
     * @var DeliveryAnswerType
     */
    protected $PartialSuccess;

    /**
     * @var Error
     */
    protected $Error;

    /**
     * @var string
     */
    protected $version;

    public function __construct(string $DeliveryService, string $AppDeliveryID, ?string $GZ, ?string $MZSDeliveryID, string $ZSDeliveryID, DeliveryAnswerType $Success, DeliveryConfirmationType $DeliveryConfirmation, DeliveryAnswerType $PartialSuccess, Error $Error, string $version)
    {
        parent::__construct($DeliveryService, $AppDeliveryID, $GZ, $MZSDeliveryID, $ZSDeliveryID);
        $this->Success = $Success;
        $this->DeliveryConfirmation = $DeliveryConfirmation;
        $this->PartialSuccess = $PartialSuccess;
        $this->Error = $Error;
        $this->version = $version;
    }

    public function getSuccess(): DeliveryAnswerType
    {
        return $this->Success;
    }

    public function setSuccess(DeliveryAnswerType $Success): void
    {
        $this->Success = $Success;
    }

    public function getDeliveryConfirmation(): DeliveryConfirmationType
    {
        return $this->DeliveryConfirmation;
    }

    public function setDeliveryConfirmation(DeliveryConfirmationType $DeliveryConfirmation): void
    {
        $this->DeliveryConfirmation = $DeliveryConfirmation;
    }

    public function getPartialSuccess(): DeliveryAnswerType
    {
        return $this->PartialSuccess;
    }

    public function setPartialSuccess(DeliveryAnswerType $PartialSuccess): void
    {
        $this->PartialSuccess = $PartialSuccess;
    }

    public function getError(): Error
    {
        return $this->Error;
    }

    public function setError(Error $Error): void
    {
        $this->Error = $Error;
    }

    public function getVersion(): string
    {
        return $this->version;
    }

    public function setVersion($version): void
    {
        $this->version = $version;
    }
}
