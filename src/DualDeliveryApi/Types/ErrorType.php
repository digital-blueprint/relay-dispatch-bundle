<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types;

class ErrorType
{
    /**
     * @var string
     */
    protected $Info = null;

    /**
     * @var string
     */
    protected $Code = null;

    /**
     * @var string
     */
    protected $Severity = null;

    /**
     * @param string $Info
     * @param string $Code
     */
    public function __construct($Info, $Code)
    {
        $this->Info = $Info;
        $this->Code = $Code;
    }

    public function getInfo(): string
    {
        return $this->Info;
    }

    public function setInfo(string $Info): self
    {
        $this->Info = $Info;

        return $this;
    }

    public function getCode(): string
    {
        return $this->Code;
    }

    public function setCode(string $Code): self
    {
        $this->Code = $Code;

        return $this;
    }

    public function getSeverity(): string
    {
        return $this->Severity;
    }

    public function setSeverity(string $Severity): self
    {
        $this->Severity = $Severity;

        return $this;
    }
}
