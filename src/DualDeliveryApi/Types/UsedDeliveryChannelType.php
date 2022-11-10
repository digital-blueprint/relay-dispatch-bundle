<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types;

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
     * @var ParametersType
     */
    protected $Parameters = null;

    /**
     * @var ErrorsType
     */
    protected $Errors = null;

    /**
     * @param string         $Name
     * @param StatusType     $Status
     * @param ParametersType $Parameters
     * @param ErrorsType     $Errors
     */
    public function __construct($Name, $Status, $Parameters, $Errors)
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

    public function setName(string $Name): self
    {
        $this->Name = $Name;

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

    public function getParameters(): ParametersType
    {
        return $this->Parameters;
    }

    public function setParameters(ParametersType $Parameters): self
    {
        $this->Parameters = $Parameters;

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
}
