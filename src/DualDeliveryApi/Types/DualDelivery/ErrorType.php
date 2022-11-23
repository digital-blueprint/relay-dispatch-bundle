<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualDelivery;

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
     * @var ?string
     */
    protected $Severity = null;

    public function __construct(string $Info, string $Code)
    {
        $this->Info = $Info;
        $this->Code = $Code;
    }

    public function getInfo(): string
    {
        return $this->Info;
    }

    public function setInfo(string $Info): void
    {
        $this->Info = $Info;
    }

    public function getCode(): string
    {
        return $this->Code;
    }

    public function setCode(string $Code): void
    {
        $this->Code = $Code;
    }

    public function getSeverity(): ?string
    {
        return $this->Severity;
    }

    public function setSeverity(string $Severity): void
    {
        $this->Severity = $Severity;
    }
}
