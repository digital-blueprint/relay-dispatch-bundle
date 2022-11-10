<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types;

class GeneralAditionalPrintParameterType extends AdditionalPrintParameterSetType
{
    /**
     * @var string
     */
    protected $PostageRange = null;

    /**
     * @var string
     */
    protected $PrinterName = null;

    /**
     * @var string
     */
    protected $Auflieferort = null;

    /**
     * @var string
     */
    protected $Auflieferdatum = null;

    /**
     * @param string $PostageRange
     */
    public function __construct($PostageRange)
    {
        $this->PostageRange = $PostageRange;
    }

    public function getPostageRange(): string
    {
        return $this->PostageRange;
    }

    public function setPostageRange(string $PostageRange): self
    {
        $this->PostageRange = $PostageRange;

        return $this;
    }

    public function getPrinterName(): string
    {
        return $this->PrinterName;
    }

    public function setPrinterName(string $PrinterName): self
    {
        $this->PrinterName = $PrinterName;

        return $this;
    }

    public function getAuflieferort(): string
    {
        return $this->Auflieferort;
    }

    public function setAuflieferort(string $Auflieferort): self
    {
        $this->Auflieferort = $Auflieferort;

        return $this;
    }

    public function getAuflieferdatum(): string
    {
        return $this->Auflieferdatum;
    }

    public function setAuflieferdatum(string $Auflieferdatum): self
    {
        $this->Auflieferdatum = $Auflieferdatum;

        return $this;
    }
}
