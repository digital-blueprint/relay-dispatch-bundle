<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types;

class PostalDeliveryType extends DeliveryChannelSetType
{
    /**
     * @var Priority
     */
    protected $Priority = null;

    /**
     * @var string
     */
    protected $EnvelopeFormat = null;

    /**
     * @var PrintType
     */
    protected $PrintType = null;

    /**
     * @var string
     */
    protected $PaperFormat = null;

    /**
     * @var bool
     */
    protected $Color = null;

    /**
     * @var PrintedEnvelope
     */
    protected $PrintedEnvelope = null;

    /**
     * @var AdditionalPrintParameter
     */
    protected $AdditionalPrintParameter = null;

    /**
     * @param Priority                 $Priority
     * @param string                   $EnvelopeFormat
     * @param AdditionalPrintParameter $AdditionalPrintParameter
     */
    public function __construct($Priority, $EnvelopeFormat, $AdditionalPrintParameter)
    {
        $this->Priority = $Priority;
        $this->EnvelopeFormat = $EnvelopeFormat;
        $this->AdditionalPrintParameter = $AdditionalPrintParameter;
    }

    /**
     * @return Priority
     */
    public function getPriority()
    {
        return $this->Priority;
    }

    /**
     * @param Priority $Priority
     */
    public function setPriority($Priority): self
    {
        $this->Priority = $Priority;

        return $this;
    }

    public function getEnvelopeFormat(): string
    {
        return $this->EnvelopeFormat;
    }

    public function setEnvelopeFormat(string $EnvelopeFormat): self
    {
        $this->EnvelopeFormat = $EnvelopeFormat;

        return $this;
    }

    /**
     * @return PrintType
     */
    public function getPrintType()
    {
        return $this->PrintType;
    }

    /**
     * @param PrintType $PrintType
     */
    public function setPrintType($PrintType): self
    {
        $this->PrintType = $PrintType;

        return $this;
    }

    public function getPaperFormat(): string
    {
        return $this->PaperFormat;
    }

    public function setPaperFormat(string $PaperFormat): self
    {
        $this->PaperFormat = $PaperFormat;

        return $this;
    }

    public function getColor(): bool
    {
        return $this->Color;
    }

    public function setColor(bool $Color): self
    {
        $this->Color = $Color;

        return $this;
    }

    public function getPrintedEnvelope(): PrintedEnvelope
    {
        return $this->PrintedEnvelope;
    }

    public function setPrintedEnvelope(PrintedEnvelope $PrintedEnvelope): self
    {
        $this->PrintedEnvelope = $PrintedEnvelope;

        return $this;
    }

    public function getAdditionalPrintParameter(): AdditionalPrintParameter
    {
        return $this->AdditionalPrintParameter;
    }

    public function setAdditionalPrintParameter(AdditionalPrintParameter $AdditionalPrintParameter): self
    {
        $this->AdditionalPrintParameter = $AdditionalPrintParameter;

        return $this;
    }
}
