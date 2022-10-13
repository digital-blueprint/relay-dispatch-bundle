<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types;

class PayloadAttributesType
{
    /**
     * @var string
     */
    protected $Id = null;

    /**
     * @var string
     */
    protected $FileName = null;

    /**
     * @var string
     */
    protected $MIMEType = null;

    /**
     * @var int
     */
    protected $Size = null;

    /**
     * @var int
     */
    protected $PageCount = null;

    /**
     * @var Checksum
     */
    protected $Checksum = null;

    /**
     * @var int
     */
    protected $Index = null;

    /**
     * @var ParametersType
     */
    protected $Parameters = null;

    /**
     * @var PrintParameter
     */
    protected $PrintParameter = null;

    /**
     * @param string         $FileName
     * @param string         $MIMEType
     * @param ParametersType $Parameters
     * @param PrintParameter $PrintParameter
     */
    public function __construct($FileName, $MIMEType, $Parameters, $PrintParameter)
    {
        $this->FileName = $FileName;
        $this->MIMEType = $MIMEType;
        $this->Parameters = $Parameters;
        $this->PrintParameter = $PrintParameter;
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->Id;
    }

    /**
     * @param string $Id
     *
     * @return PayloadAttributesType
     */
    public function setId($Id)
    {
        $this->Id = $Id;

        return $this;
    }

    /**
     * @return string
     */
    public function getFileName()
    {
        return $this->FileName;
    }

    /**
     * @param string $FileName
     *
     * @return PayloadAttributesType
     */
    public function setFileName($FileName)
    {
        $this->FileName = $FileName;

        return $this;
    }

    /**
     * @return string
     */
    public function getMIMEType()
    {
        return $this->MIMEType;
    }

    /**
     * @param string $MIMEType
     *
     * @return PayloadAttributesType
     */
    public function setMIMEType($MIMEType)
    {
        $this->MIMEType = $MIMEType;

        return $this;
    }

    /**
     * @return int
     */
    public function getSize()
    {
        return $this->Size;
    }

    /**
     * @param int $Size
     *
     * @return PayloadAttributesType
     */
    public function setSize($Size)
    {
        $this->Size = $Size;

        return $this;
    }

    /**
     * @return int
     */
    public function getPageCount()
    {
        return $this->PageCount;
    }

    /**
     * @param int $PageCount
     *
     * @return PayloadAttributesType
     */
    public function setPageCount($PageCount)
    {
        $this->PageCount = $PageCount;

        return $this;
    }

    /**
     * @return Checksum
     */
    public function getChecksum()
    {
        return $this->Checksum;
    }

    /**
     * @param Checksum $Checksum
     *
     * @return PayloadAttributesType
     */
    public function setChecksum($Checksum)
    {
        $this->Checksum = $Checksum;

        return $this;
    }

    /**
     * @return int
     */
    public function getIndex()
    {
        return $this->Index;
    }

    /**
     * @param int $Index
     *
     * @return PayloadAttributesType
     */
    public function setIndex($Index)
    {
        $this->Index = $Index;

        return $this;
    }

    /**
     * @return ParametersType
     */
    public function getParameters()
    {
        return $this->Parameters;
    }

    /**
     * @param ParametersType $Parameters
     *
     * @return PayloadAttributesType
     */
    public function setParameters($Parameters)
    {
        $this->Parameters = $Parameters;

        return $this;
    }

    /**
     * @return PrintParameter
     */
    public function getPrintParameter()
    {
        return $this->PrintParameter;
    }

    /**
     * @param PrintParameter $PrintParameter
     *
     * @return PayloadAttributesType
     */
    public function setPrintParameter($PrintParameter)
    {
        $this->PrintParameter = $PrintParameter;

        return $this;
    }
}
