<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\Zuse;

class DeliveryNotificationType extends DeliveryAnswerType
{
    /**
     * @var Success
     */
    protected $Success;

    /**
     * @var Error
     */
    protected $Error;

    /**
     * @var AdditionalFormat[]
     */
    protected $AdditionalFormat;

    /**
     * @var string
     */
    protected $version;

    public function __construct(string $DeliveryService, string $AppDeliveryID, ?string $GZ, ?string $MZSDeliveryID, string $ZSDeliveryID, Success $Success, Error $Error, string $version)
    {
        parent::__construct($DeliveryService, $AppDeliveryID, $GZ, $MZSDeliveryID, $ZSDeliveryID);
        $this->Success = $Success;
        $this->Error = $Error;
        $this->version = $version;
    }

    public function getSuccess(): Success
    {
        return $this->Success;
    }

    public function setSuccess(Success $Success): void
    {
        $this->Success = $Success;
    }

    public function getError(): Error
    {
        return $this->Error;
    }

    public function setError(Error $Error): void
    {
        $this->Error = $Error;
    }

    /**
     * @return AdditionalFormat[]
     */
    public function getAdditionalFormat(): array
    {
        return $this->AdditionalFormat;
    }

    /**
     * @param AdditionalFormat[] $AdditionalFormat
     */
    public function setAdditionalFormat(array $AdditionalFormat): void
    {
        $this->AdditionalFormat = $AdditionalFormat;
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
