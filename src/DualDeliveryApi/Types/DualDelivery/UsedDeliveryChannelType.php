<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualDelivery;

class UsedDeliveryChannelType
{
    /**
     * @var string
     */
    protected $Name = null;

    /**
     * @var StatusType
     */
    protected $Status = null;

    /**
     * @var ?ParametersType
     */
    protected $Parameters = null;

    /**
     * @var ?ErrorsType
     */
    protected $Errors = null;

    public function __construct(string $Name, StatusType $Status, ?ParametersType $Parameters, ?ErrorsType $Errors)
    {
        $this->Name = $Name;
        $this->Status = $Status;
        $this->Parameters = $Parameters;
        $this->Errors = $Errors;
    }

    public function getName(): string
    {
        return $this->Name;
    }

    public function setName(string $Name): void
    {
        $this->Name = $Name;
    }

    public function getStatus(): StatusType
    {
        return $this->Status;
    }

    public function setStatus(StatusType $Status): void
    {
        $this->Status = $Status;
    }

    public function getParameters(): ?ParametersType
    {
        return $this->Parameters;
    }

    public function setParameters(ParametersType $Parameters): void
    {
        $this->Parameters = $Parameters;
    }

    public function getErrors(): ?ErrorsType
    {
        return $this->Errors;
    }

    public function setErrors(ErrorsType $Errors): void
    {
        $this->Errors = $Errors;
    }
}
