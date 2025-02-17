<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualDelivery;

class PrintParameter
{
    /**
     * Farbdruck (Default=false).
     *
     * @var ?bool
     */
    protected $Color;

    /**
     * Papierformat: A4, A3, Dynamic (Default=A4).
     *
     * @var ?string
     */
    protected $PaperFormat;

    /**
     * Art des Druckes  (DUP - Duplex, SIM - Simplex).
     *
     * @var ?string
     */
    protected $PrintType;

    /**
     * Nicht abfallender (OverPrint=false, Defaultwert) oder Abfallender Druck (true).
     *
     * @var ?bool
     */
    protected $OverPrint;

    /**
     * @var ?ParametersType
     */
    protected $Parameters;

    public function __construct(string $PrintType, bool $Color = false, string $PaperFormat = 'A4', bool $OverPrint = false, ?ParametersType $Parameters = null)
    {
        $this->Color = $Color;
        $this->PaperFormat = $PaperFormat;
        $this->PrintType = $PrintType;
        $this->OverPrint = $OverPrint;
        $this->Parameters = $Parameters;
    }

    public function getColor(): bool
    {
        return $this->Color ?? false;
    }

    public function setColor(bool $Color): void
    {
        $this->Color = $Color;
    }

    public function getPaperFormat(): ?string
    {
        return $this->PaperFormat;
    }

    public function setPaperFormat(string $PaperFormat): void
    {
        $this->PaperFormat = $PaperFormat;
    }

    /**
     * @return ?string
     */
    public function getPrintType()
    {
        return $this->PrintType;
    }

    public function setPrintType(string $PrintType): void
    {
        $this->PrintType = $PrintType;
    }

    public function getOverPrint(): bool
    {
        return $this->OverPrint ?? false;
    }

    public function setOverPrint(bool $OverPrint): void
    {
        $this->OverPrint = $OverPrint;
    }

    public function getParameters(): ?ParametersType
    {
        return $this->Parameters;
    }

    public function setParameters(ParametersType $Parameters): void
    {
        $this->Parameters = $Parameters;
    }
}
