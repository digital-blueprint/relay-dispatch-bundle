<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualDelivery;

class StatusType
{
    /**
     * @var string
     */
    protected $Code;

    /**
     * @var ?string
     */
    protected $Text;

    /**
     * @var ?string
     */
    protected $Timestamp;

    public function __construct(string $Code, ?string $Text = null, ?\DateTimeInterface $Timestamp = null)
    {
        $this->Code = $Code;
        $this->Text = $Text;
        if ($Timestamp !== null) {
            $this->setTimestamp($Timestamp);
        } else {
            $this->Timestamp = null;
        }
    }

    public function getCode(): string
    {
        return $this->Code;
    }

    public function setCode(string $Code): void
    {
        $this->Code = $Code;
    }

    public function getText(): ?string
    {
        return $this->Text;
    }

    public function setText(string $Text): void
    {
        $this->Text = $Text;
    }

    public function getTimestamp(): ?\DateTimeInterface
    {
        if ($this->Timestamp === null) {
            return null;
        } else {
            return new \DateTimeImmutable($this->Timestamp);
        }
    }

    public function setTimestamp(\DateTimeInterface $Timestamp): void
    {
        $this->Timestamp = $Timestamp->format(\DateTime::ATOM);
    }
}
