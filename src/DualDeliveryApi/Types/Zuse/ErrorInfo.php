<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\Zuse;

class ErrorInfo
{
    /**
     * @var int
     */
    protected $Code;

    /**
     * @var string
     */
    protected $Text;

    public function __construct(int $Code, string $Text)
    {
        $this->Code = $Code;
        $this->Text = $Text;
    }

    public function getCode(): int
    {
        return $this->Code;
    }

    public function setCode(int $Code): void
    {
        $this->Code = $Code;
    }

    public function getText(): string
    {
        return $this->Text;
    }

    public function setText(string $Text): void
    {
        $this->Text = $Text;
    }
}
