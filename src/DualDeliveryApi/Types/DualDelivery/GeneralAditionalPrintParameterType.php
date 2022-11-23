<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualDelivery;

class GeneralAditionalPrintParameterType extends AdditionalPrintParameterSetType
{
    /**
     * @var ?string
     */
    protected $PostageRange = null;

    /**
     * @var ?string
     */
    protected $PrinterName = null;

    /**
     * @var ?string
     */
    protected $Auflieferort = null;

    /**
     * @var ?string
     */
    protected $Auflieferdatum = null;

    public function __construct(?string $PostageRange)
    {
        parent::__construct();
        $this->PostageRange = $PostageRange;
    }

    public function getPostageRange(): ?string
    {
        return $this->PostageRange;
    }

    public function setPostageRange(string $PostageRange): void
    {
        $this->PostageRange = $PostageRange;
    }

    public function getPrinterName(): ?string
    {
        return $this->PrinterName;
    }

    public function setPrinterName(string $PrinterName): void
    {
        $this->PrinterName = $PrinterName;
    }

    public function getAuflieferort(): ?string
    {
        return $this->Auflieferort;
    }

    public function setAuflieferort(string $Auflieferort): void
    {
        $this->Auflieferort = $Auflieferort;
    }

    public function getAuflieferdatum(): ?string
    {
        return $this->Auflieferdatum;
    }

    public function setAuflieferdatum(string $Auflieferdatum): void
    {
        $this->Auflieferdatum = $Auflieferdatum;
    }
}
