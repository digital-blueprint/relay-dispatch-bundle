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

    /**
     * @return string
     */
    public function getPostageRange()
    {
        return $this->PostageRange;
    }

    /**
     * @param string $PostageRange
     *
     * @return GeneralAditionalPrintParameterType
     */
    public function setPostageRange($PostageRange)
    {
        $this->PostageRange = $PostageRange;

        return $this;
    }

    /**
     * @return string
     */
    public function getPrinterName()
    {
        return $this->PrinterName;
    }

    /**
     * @param string $PrinterName
     *
     * @return GeneralAditionalPrintParameterType
     */
    public function setPrinterName($PrinterName)
    {
        $this->PrinterName = $PrinterName;

        return $this;
    }

    /**
     * @return string
     */
    public function getAuflieferort()
    {
        return $this->Auflieferort;
    }

    /**
     * @param string $Auflieferort
     *
     * @return GeneralAditionalPrintParameterType
     */
    public function setAuflieferort($Auflieferort)
    {
        $this->Auflieferort = $Auflieferort;

        return $this;
    }

    /**
     * @return string
     */
    public function getAuflieferdatum()
    {
        return $this->Auflieferdatum;
    }

    /**
     * @param string $Auflieferdatum
     *
     * @return GeneralAditionalPrintParameterType
     */
    public function setAuflieferdatum($Auflieferdatum)
    {
        $this->Auflieferdatum = $Auflieferdatum;

        return $this;
    }
}
