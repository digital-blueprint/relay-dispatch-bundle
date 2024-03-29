<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualDelivery;

class PostalDeliveryType extends DeliveryChannelSetType
{
    /**
     * @var ?int
     */
    protected $Priority;

    /**
     * @var ?string
     */
    protected $EnvelopeFormat;

    /**
     * @var ?string
     */
    protected $PrintType;

    /**
     * @var string
     */
    protected $PaperFormat = 'A4';

    /**
     * @var bool
     */
    protected $Color = false;

    /**
     * @var ?PrintedEnvelope
     */
    protected $PrintedEnvelope;

    /**
     * @var ?AdditionalPrintParameter
     */
    protected $AdditionalPrintParameter;

    public function __construct(?int $Priority, ?string $EnvelopeFormat, ?AdditionalPrintParameter $AdditionalPrintParameter)
    {
        parent::__construct();
        $this->Priority = $Priority;
        $this->EnvelopeFormat = $EnvelopeFormat;
        $this->AdditionalPrintParameter = $AdditionalPrintParameter;
    }

    public function getPriority(): ?int
    {
        return $this->Priority;
    }

    public function setPriority(int $Priority): void
    {
        $this->Priority = $Priority;
    }

    public function getEnvelopeFormat(): ?string
    {
        return $this->EnvelopeFormat;
    }

    public function setEnvelopeFormat(string $EnvelopeFormat): void
    {
        $this->EnvelopeFormat = $EnvelopeFormat;
    }

    public function getPrintType(): ?string
    {
        return $this->PrintType;
    }

    public function setPrintType(string $PrintType): void
    {
        $this->PrintType = $PrintType;
    }

    public function getPaperFormat(): string
    {
        return $this->PaperFormat;
    }

    public function setPaperFormat(string $PaperFormat): void
    {
        $this->PaperFormat = $PaperFormat;
    }

    public function getColor(): bool
    {
        return $this->Color;
    }

    public function setColor(bool $Color): void
    {
        $this->Color = $Color;
    }

    public function getPrintedEnvelope(): ?PrintedEnvelope
    {
        return $this->PrintedEnvelope;
    }

    public function setPrintedEnvelope(PrintedEnvelope $PrintedEnvelope): void
    {
        $this->PrintedEnvelope = $PrintedEnvelope;
    }

    public function getAdditionalPrintParameter(): ?AdditionalPrintParameter
    {
        return $this->AdditionalPrintParameter;
    }

    public function setAdditionalPrintParameter(AdditionalPrintParameter $AdditionalPrintParameter): void
    {
        $this->AdditionalPrintParameter = $AdditionalPrintParameter;
    }
}
