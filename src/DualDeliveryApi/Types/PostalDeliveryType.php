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
     *
     * @return PostalDeliveryType
     */
    public function setPriority($Priority)
    {
        $this->Priority = $Priority;

        return $this;
    }

    /**
     * @return string
     */
    public function getEnvelopeFormat()
    {
        return $this->EnvelopeFormat;
    }

    /**
     * @param string $EnvelopeFormat
     *
     * @return PostalDeliveryType
     */
    public function setEnvelopeFormat($EnvelopeFormat)
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
     *
     * @return PostalDeliveryType
     */
    public function setPrintType($PrintType)
    {
        $this->PrintType = $PrintType;

        return $this;
    }

    /**
     * @return string
     */
    public function getPaperFormat()
    {
        return $this->PaperFormat;
    }

    /**
     * @param string $PaperFormat
     *
     * @return PostalDeliveryType
     */
    public function setPaperFormat($PaperFormat)
    {
        $this->PaperFormat = $PaperFormat;

        return $this;
    }

    /**
     * @return bool
     */
    public function getColor()
    {
        return $this->Color;
    }

    /**
     * @param bool $Color
     *
     * @return PostalDeliveryType
     */
    public function setColor($Color)
    {
        $this->Color = $Color;

        return $this;
    }

    /**
     * @return PrintedEnvelope
     */
    public function getPrintedEnvelope()
    {
        return $this->PrintedEnvelope;
    }

    /**
     * @param PrintedEnvelope $PrintedEnvelope
     *
     * @return PostalDeliveryType
     */
    public function setPrintedEnvelope($PrintedEnvelope)
    {
        $this->PrintedEnvelope = $PrintedEnvelope;

        return $this;
    }

    /**
     * @return AdditionalPrintParameter
     */
    public function getAdditionalPrintParameter()
    {
        return $this->AdditionalPrintParameter;
    }

    /**
     * @param AdditionalPrintParameter $AdditionalPrintParameter
     *
     * @return PostalDeliveryType
     */
    public function setAdditionalPrintParameter($AdditionalPrintParameter)
    {
        $this->AdditionalPrintParameter = $AdditionalPrintParameter;

        return $this;
    }
}
